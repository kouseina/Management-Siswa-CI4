<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="mt-5 mb-4 container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
</section>

<section class="container mt-5 mb-4 d-flex justify-content-between">
    <h2>Management Data Siswa</h2>
    <a href="/siswa/create/" class="btn btn-primary pt-2">Tambah Data Siswa</a>
</section>

<section class="container">
    <?php if (session()->getFlashData('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashData('pesan'); ?>
        </div>
    <?php endif ?>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Foto</th>
                <th scope="col">Nama</th>
                <th scope="col">NIS</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($siswa as $dataSiswa) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><img src="assets/img/<?= $dataSiswa["foto"]; ?>" alt=""></td>
                    <td><?= $dataSiswa["nama"]; ?></td>
                    <td><?= $dataSiswa["nis"]; ?></td>
                    <td><?= $dataSiswa["jenis_kelamin"]; ?></td>
                    <td><?= $dataSiswa["jurusan"]; ?></td>
                    <td class="action">
                        <a href="/siswa/edit/<?= $dataSiswa['slug']; ?>" class="btn btn-success">Edit</a>

                        <form action="/siswa/delete/<?= $dataSiswa['id']; ?>" method="POST" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('apakah Anda yakin?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?= $this->endSection(); ?>