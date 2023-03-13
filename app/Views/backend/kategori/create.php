<?= $this->extend('layout/app'); ?>

<!-- Content -->
<?= $this->section('main') ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title ?></h1>
        <div class="section-header-breadcrumb">
            <?php foreach ($breadcrumbs as $value => $url) : ?>
            <div class="breadcrumb-item"><a href="<?= $url ?>"><?= $value ?></a></div>
            <?php endforeach ?>
            <div class="breadcrumb-item"><?= $title ?></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('masterdata/kategori'); ?>" method="post" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="row">
                                        <!-- input nama kategori -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Nama kategori<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="nama_kategori"
                                                    class="form-control <?= session('errors.nama_kategori') ? 'is-invalid' : '' ?>"
                                                    name="nama_kategori" value="<?= old('nama_kategori') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.nama_kategori') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input deskripsi -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Deskripsi<span class="text-danger">*</span></label>
                                                <textarea name="deskripsi" id="deskripsi"
                                                    class="form-control  <?= session('errors.deskripsi') ? 'is-invalid' : '' ?>"
                                                    cols="30" rows="10"></textarea>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.deskripsi') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<!-- CSS Libraries -->
<?= $this->section('cssLibrary') ?>

<?= $this->endSection() ?>

<!-- JS Libraies -->
<?= $this->section('jsLibrary') ?>


<?= $this->endSection() ?>

<!-- Page Specific JS File -->
<?= $this->section('jsSpesific') ?>


<?= $this->endSection() ?>