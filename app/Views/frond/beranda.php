<?= $this->extend('layout/landingpage') ?>

<?= $this->section('main') ?>
<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="https://via.placeholder.com/800x400?text=Slide+1" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://via.placeholder.com/800x400?text=Slide+2" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://via.placeholder.com/800x400?text=Slide+3" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only"> Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- About Section -->
<section class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>About Us</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam porttitor mauris sit amet lacus
                    lobortis posuere. Aliquam interdum facilisis mauris, sed maximus nunc. Sed vel convallis magna.
                    Nunc eget felis vitae magna congue rutrum.</p>
            </div>
            <div class="col-md-6">
                <img src="https://via.placeholder.com/500x300?text=About+Us" class="img-fluid" alt="About Us Image">
            </div>
        </div>
    </div>
</section>

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
                            <a href="#" class="btn btn-primary">Reservasi</a>
                        </div>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Payment Method Section -->
<section class="my-5">
    <div class="container">
        <h2>Metode Pembayaran</h2>
        <div class="row">
            <div class="col-md-12 mb-3">
                <?php foreach($banks as $bank) : ?>
                <img src="<?= base_url('bank/images/'. $bank->logo_bank) ?>" height="70" witdh="50"
                    alt="<?= $bank->nama_bank ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection('main') ?>