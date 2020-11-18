<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="mt-5 mb-4 container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
</section>

<div class="container mt-5 mb-4">
    <div class="row">
        <div class="col-8">
            <h2 class="mb-4">Form Tambah Data Siswa</h2>

            <form action="/siswa/save/" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : ''); ?>" id="nama" name="nama" autofocus value="<?= old('nama'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nis') ? 'is-invalid' : ''); ?>" id="nis" name="nis" value="<?= old('nis'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nis'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenis-kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" class="custom-control-input <?= ($validation->hasError('jenis-kelamin') ? 'is-invalid' : ''); ?>" id="customControlValidation2" name="jenis-kelamin" value="Laki-laki">
                            <label class="custom-control-label" for="customControlValidation2">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input <?= ($validation->hasError('jenis-kelamin') ? 'is-invalid' : ''); ?>" id="customControlValidation3" name="jenis-kelamin" value="Perempuan">
                            <label class="custom-control-label" for="customControlValidation3">Perempuan</label>
                            <div class="invalid-feedback"><?= $validation->getError('jenis-kelamin'); ?></div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <select id="jurusan" name="jurusan" class="custom-select <?= ($validation->hasError('jurusan') ? 'is-invalid' : ''); ?>">
                            <option value="">Choose...</option>
                            <option value="RPL">RPL</option>
                            <option value="TKJ">TKJ</option>
                            <option value="TJA">TJA</option>
                        </select>
                        <div class="invalid-feedback"><?= $validation->getError('jurusan'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-2">
                        <img src="/assets/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <!-- <input type="text" class="form-control <?= ($validation->hasError('foto') ? 'is-invalid' : ''); ?>" id="foto" name="foto" value="<?= old('foto'); ?>"> -->

                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('foto') ? 'is-invalid' : ''); ?>" id="foto" name="foto" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('foto'); ?>
                            </div>
                            <label class="custom-file-label" for="foto" name="foto">Pilih Gambar..</label>
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