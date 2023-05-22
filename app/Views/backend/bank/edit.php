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
                        <form action="<?= base_url('masterdata/bank/'. $bank->id); ?>" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="row">
                                        <!-- input kode bank -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Kode Bank<span class="text-danger">*</span></label>
                                                <input type="text" id="kode_bank"
                                                    class="form-control <?= session('errors.kode_bank') ? 'is-invalid' : '' ?>"
                                                    name="kode_bank" value="<?= old('kode_bank', $bank->kode_bank) ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.kode_bank') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input nama bank -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Nama Bank<span class="text-danger">*</span></label>
                                                <input type="text" id="nama_bank"
                                                    class="form-control <?= session('errors.nama_bank') ? 'is-invalid' : '' ?>"
                                                    name="nama_bank" value="<?= old('nama_bank', $bank->nama_bank) ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.nama_bank') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input no rekening -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">No Rekening</label>
                                                <input type="number" id="no_rekening"
                                                    class="form-control <?= session('errors.no_rekening') ? 'is-invalid' : '' ?>"
                                                    name="no_rekening"
                                                    value="<?= old('no_rekening', $bank->no_rekening) ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.no_rekening') ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-check-inline">
                                                    <input class="form-check-input " type="radio" name="status"
                                                        id="aktif" value="aktif"
                                                        <?= $bank->status == 'aktif' ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="aktif">
                                                        Aktif
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="tidak_aktif" value="tidak aktif"
                                                        <?= $bank->status == 'tidak aktif' ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="tidak_aktif">
                                                        Tidak aktif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- input logo -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Logo</label>
                                                <?php if($bank->logo_bank) : ?>
                                                <img src="<?= base_url('bank/images/'. $bank->logo_bank) ?>"
                                                    class="img-preview mb-3" witdh="90" height="90"
                                                    style="display: block;">
                                                <?php else : ?>
                                                <img class="img-preview" witdh="90" height="90">
                                                <?php endif; ?>
                                                <input type="file" id="logo_bank"
                                                    class="form-control <?= session('errors.logo_bank') ? 'is-invalid' : '' ?>"
                                                    name="logo_bank" onchange="Preview()">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.logo_bank') ?>
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


<script>
    function Preview() {
        const image = document.querySelector('#logo_bank');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);


        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

<?= $this->endSection() ?>