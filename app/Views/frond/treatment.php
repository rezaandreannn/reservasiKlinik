<?= $this->extend('layout/landingpage') ?>

<?= $this->section('main') ?>
<!-- Treatment Cards Section -->
<section class="my-5">
    <div class="container">
        <h2>Treatment</h2>
        <div class="row">

            <?php foreach($treatments as $treatment) : ?>
            <div class="col-md-4">
                <div class="card my-3">
                    <?php if($treatment->gambar) : ?>
                    <img src="<?= base_url('images/treatment/' .$treatment->gambar) ?>" alt="treatment"
                        class="img-fluid">
                    <?php else : ?>
                    <img src="https://via.placeholder.com/350x200?text=Treatment+3" class="card-img-top"
                        alt="Treatment">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $treatment->nama_treatment ?></h5>
                        <p class="card-text"><?= $treatment->deskripsi ?>.</p>
                        <small class="card-text">durasi treatment &plusmn;
                            <?= format_time($treatment->durasi) ?></small>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-text mb-0">
                                <strong><?= format_rupiah($treatment->harga) ?></strong>
                            </p>
                            <a href="<?= base_url('reservasi/' . $treatment->id) ?>"
                                class="btn btn-primary">Reservasi</a>
                        </div>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?= $this->endSection('main') ?>