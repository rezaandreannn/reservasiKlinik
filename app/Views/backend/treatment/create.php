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
                        <form action="<?= base_url('masterdata/treatment'); ?>" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="row">
                                        <!-- input nama bank -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Nama Treatment<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="nama_treatment"
                                                    class="form-control <?= session('errors.nama_treatment') ? 'is-invalid' : '' ?>"
                                                    name="nama_treatment" value="<?= old('nama_treatment') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.nama_treatment') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input kategori -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Kategori<span class="text-danger">*</span></label>
                                                <select
                                                    class="form-control selectric <?= session('errors.kategori_id') ? 'is-invalid' : '' ?>"
                                                    name="kategori_id">
                                                    <option value="">-- Pilih kategori --</option>
                                                    <?php foreach ($kategori as $value) : ?>
                                                    <option value="<?= $value->id ?>"
                                                        <?= old('kategori_id') == $value->id ? 'selected' : '' ?>>
                                                        <?= $value->nama_kategori ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.kategori_id') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input harga -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Harga<span class="text-danger">*</span></label>
                                                <input type="text" id="harga"
                                                    class="form-control <?= session('errors.harga') ? 'is-invalid' : '' ?>"
                                                    name="harga" value="<?= old('harga') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.harga') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input durasi -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Durasi<span class="text-danger">*</span></label>
                                                <input type="time" id="durasi"
                                                    class="form-control <?= session('errors.durasi') ? 'is-invalid' : '' ?>"
                                                    name="durasi" value="<?= old('durasi') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.durasi') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input Deskripsi -->
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
                                        <!-- input gambar -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Gambar</label>
                                                <img class="img-preview" witdh="90" height="90">
                                                <input type="file" id="gambar"
                                                    class="form-control <?= session('errors.gambar') ? 'is-invalid' : '' ?>"
                                                    name="gambar" onchange="Preview()">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.gambar') ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="<?= base_url('stisla/node_modules/selectric/public/jquery.selectric.min.js') ?>"></script>


<?= $this->endSection() ?>

<!-- Page Specific JS File -->
<?= $this->section('jsSpesific') ?>

<script>
    $(document).ready(function () {
        $('#harga').mask('###.###.###.###', {
            reverse: true
        });
    });
</script>


<script>
    function Preview() {
        const image = document.querySelector('#gambar');
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