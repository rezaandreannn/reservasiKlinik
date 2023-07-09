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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('admin/report/cetak'); ?>" method="post" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="row">
                                        <!-- input jam buka -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="date" id="start_date" class="form-control"
                                                    name="start_date" value="<?= old('jam_buka') ?>">
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-group">
                                                <p>Sampai</p>
                                            </div>
                                        </div>
                                        <!-- input jam tutup -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="date" id="end_date" class="form-control" name="end_date">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-primary" type="submit">Cetak</button>
                                        </div>
                                    </div>
                                </div>
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