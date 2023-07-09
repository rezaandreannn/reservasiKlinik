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
                        <form action="<?= base_url('admin/pengguna/'. $user->id); ?>" method="post" autocomplete="off">
                            <input type="hidden" name="_method" value="PUT">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="row">
                                        <!-- input nama kategori -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Nama<span class="text-danger">*</span></label>
                                                <input type="text" id="username"
                                                    class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>"
                                                    name="username" value="<?= old('username', $user->username) ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.username') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">No Telp<span class="text-danger">*</span></label>
                                                <input type="text" id="no_telp"
                                                    class="form-control <?= session('errors.no_telp') ? 'is-invalid' : '' ?>"
                                                    name="no_telp" value="<?= old('no_telp', $user->no_telp) ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.no_telp') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input deskripsi -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Email<span class="text-danger">*</span></label>
                                                <input type="text" id="email"
                                                    class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                                                    name="email" value="<?= old('email', $user->email) ?>" readonly>
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