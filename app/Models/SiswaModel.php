<?php 

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model 
{
    protected $table = 'siswa';
    protected $allowedFields = ['foto','nama','slug','nis','jenis_kelamin','jurusan'];
    protected $useTimestamps = true;

    public function getSiswa($slug = false) 
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
