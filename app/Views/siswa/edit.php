<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="mt-5 mb-4 container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit &nbsp;/&nbsp; Data</li>
        </ol>
    </nav>
</section>

<div class="container mt-5 mb-4">
    <div class="row">
        <div class="col-8">
            <h2 class="mb-4">Form Edit Data Siswa</h2>

            <form action="/siswa/update/<?= $siswa['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <input type="hidden" name="slug" value="<?= $siswa['slug']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $siswa['foto']; ?>">

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : ''); ?>" id="nama" name="nama" autofocus value="<?= (old('nama')) ? old('nama') : $siswa['nama']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nis') ? 'is-invalid' : ''); ?>" id="nis" name="nis" value="<?= (old('nis')) ? old('nis') : $siswa['nis']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nis'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenis-kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('jenis-kelamin') ? 'is-invalid' : ''); ?>" id="jenis-kelamin" name="jenis-kelamin" value="<?= (old('jenis-kelamin')) ? old('jenis-kelamin') : $siswa['jenis_kelamin']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jenis-kelamin'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('jurusan') ? 'is-invalid' : ''); ?>" id="jurusan" name="jurusan" value="<?= (old('jurusan')) ? old('jurusan') : $siswa['jurusan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jurusan'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-2">
                        <img src="/assets/img/<?= $siswa['foto']; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <!-- <input type="text" class="form-control <?= ($validation->hasError('foto') ? 'is-invalid' : ''); ?>" id="foto" name="foto" value="<?= old('foto'); ?>"> -->

                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('foto') ? 'is-invalid' : ''); ?>" id="foto" name="foto" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('foto'); ?>
                            </div>
                            <label class="custom-file-label" for="foto" name="foto"><?= $siswa['foto']; ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>