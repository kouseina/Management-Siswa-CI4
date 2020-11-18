<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use CodeIgniter\Config\Config;
use CodeIgniter\HTTP\Request;

class Siswa extends BaseController
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        // $siswa = $this->siswaModel->findAll();
        // d($siswa);

        $data = [
            "title" => "Home",
            "siswa" => $this->siswaModel->getSiswa(),
        ];

        return view('siswa/index', $data);
    }

    public function create()
    {
        // $siswa = $this->siswaModel->where(['slug' => $slug])->first();

        $data = [
            'title' => 'Tambah',
            'validation' => \Config\Services::validation(),
        ];

        return view('siswa/create', $data);
    }

    public function save()
    {
        // input validation 
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[siswa.nama]',
                'errors' => [
                    'required' => 'Nama siswa harus diisi.',
                    'is_unique' => 'Nama siswa sudah ada.',
                ]
            ],
            'nis' => [
                'rules' => 'required|is_unique[siswa.nis]|numeric',
                'errors' => [
                    'required' => 'NIS siswa harus diisi.',
                    'is_unique' => 'NIS siswa sudah ada.',
                    'numeric' => 'NIS siswa harus bernilai angka.',
                ]
            ],
            'jenis-kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin siswa harus diisi.',
                ]
            ],
            'jurusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jurusan siswa harus diisi.',
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar harus kurang dari 1MB.',
                    'is_image' => 'Yang Anda pilih bukan gambar.',
                    'mime_in' => 'Yang Anda pilih bukan gambar.',
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/siswa/create')->withInput()->with('validation', $validation);
            return redirect()->to('/siswa/create')->withInput();
        }

        // get foto
        $fileFoto = $this->request->getFile('foto');

        // if foto not uploaded
        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.jpg';
        } else {
            // get file name
            $namaFoto = $fileFoto->getName();

            // move file to folder img
            $fileFoto->move('assets/img');
        }

        $slug = url_title($this->request->getVar('nama'), "-", true);

        $this->siswaModel->save([
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'nis' => $this->request->getVar('nis'),
            'jenis_kelamin' => $this->request->getVar('jenis-kelamin'),
            'jurusan' => $this->request->getVar('jurusan'),
            'foto' => $namaFoto,
        ]);

        session()->setFlashData('pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/');
    }

    public function delete($id)
    {
        // search foto 
        $siswa = $this->siswaModel->find($id);

        // check if foto = default
        if ($siswa['foto'] != 'default.jpg') {
            // delete foto
            unlink('assets/img/' . $siswa['foto']);
        }

        $this->siswaModel->delete($id);

        session()->setFlashData('pesan', 'Data Berhasil Dihapus.');

        return redirect()->to('/');
    }

    public function edit($slug)
    {
        // $siswa = $this->siswaModel->where(['slug' => $slug])->first();

        $data = [
            "title" => "Edit",
            'validation' => \Config\Services::validation(),
            "siswa" => $this->siswaModel->getSiswa($slug),
        ];

        // if siswa empty at table
        if (empty($data['siswa'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama siswa tidak ditemukan');
        }

        return view('siswa/edit', $data);
    }

    public function update($id)
    {
        // input validation 

        // check nama 
        $siswaLama = $this->siswaModel->getSiswa($this->request->getVar('slug'));

        if ($siswaLama['nama'] == $this->request->getVar('nama')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[siswa.nama]';
        }

        if ($siswaLama['nis'] == $this->request->getVar('nis')) {
            $rule_nis = 'required|numeric';
        } else {
            $rule_nis = 'required|is_unique[siswa.nis]|numeric';
        }

        if (!$this->validate([
            'nama' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} siswa harus diisi.',
                    'is_unique' => '{field} siswa sudah ada.',
                ]
            ],
            'nis' => [
                'rules' => $rule_nis,
                'errors' => [
                    'required' => '{field} siswa harus diisi.',
                    'is_unique' => '{field} siswa sudah ada.',
                    'numeric' => '{field} siswa harus bernilai angka.',
                ]
            ],
            'jenis-kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} siswa harus diisi.',
                ]
            ],
            'jurusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} siswa harus diisi.',
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar harus kurang dari 1MB.',
                    'is_image' => 'Yang Anda pilih bukan gambar.',
                    'mime_in' => 'Yang Anda pilih bukan gambar.',
                ]
            ],
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/siswa/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileFoto = $this->request->getFile('foto');

        // check foto, if old foto
        if($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            // generate file name
            $namaFoto = $fileFoto->getName();
            // move foto
            $fileFoto->move('assets/img');
            // delete file name
            unlink('assets/img/' . $this->request->getVar('fotoLama'));
        }


        $slug = url_title($this->request->getVar('nama'), "-", true);

        $this->siswaModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'nis' => $this->request->getVar('nis'),
            'jenis_kelamin' => $this->request->getVar('jenis-kelamin'),
            'jurusan' => $this->request->getVar('jurusan'),
            'foto' => $namaFoto,
        ]);

        session()->setFlashData('pesan', 'Data Berhasil Diedit.');

        return redirect()->to('/');
    }

    //--------------------------------------------------------------------

}
