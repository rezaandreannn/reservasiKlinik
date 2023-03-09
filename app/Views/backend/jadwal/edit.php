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
                        <form action="<?= base_url('masterdata/jadwal/'. $jadwal->id); ?>" method="post"
                            autocomplete="off">
                            <input type="hidden" name="_method" value="PUT">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="row">
                                        <!-- input hari buka -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Hari Buka<span class="text-danger">*</span></label>
                                                <select
                                                    class="form-control selectric <?= session('errors.hari_buka') ? 'is-invalid' : '' ?>"
                                                    name="hari_buka">
                                                    <option value="">--Pilih Hari--</option>
                                                    <?php foreach ($hari as $value) : ?>
                                                    <option value="<?= $value ?>"
                                                        <?= old('hari_buka', $jadwal->hari_buka) == $value ? 'selected' : '' ?>>
                                                        <?= $value ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.hari_buka') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input jam buka -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Jam Buka</label>
                                                <input type="time" id="jam_buka"
                                                    class="form-control <?= session('errors.jam_buka') ? 'is-invalid' : '' ?>"
                                                    name="jam_buka" value="<?= old('jam_buka', $jadwal->jam_buka) ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.jam_buka') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input jam tutup -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Jam Tutup</label>
                                                <input type="time" id="jam_tutup"
                                                    class="form-control <?= session('errors.jam_tutup') ? 'is-invalid' : '' ?>"
                                                    name="jam_tutup" value="<?= old('jam_buka', $jadwal->jam_tutup) ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.jam_tutup') ?>
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
<link rel="stylesheet" href="<?= base_url('stisla/node_modules/selectric/public/selectric.css') ?>">
<?= $this->endSection() ?>

<!-- JS Libraies -->
<?= $this->section('jsLibrary') ?>

<script src="<?= base_url('stisla/node_modules/selectric/public/jquery.selectric.min.js') ?>"></script>
<?= $this->endSection() ?>

<!-- Page Specific JS File -->
<?= $this->section('jsSpesific') ?>
<script src="<?= base_url('stisla/assets/js/page/forms-advanced-forms.js') ?>"></script>

<?= $this->endSection() ?>