<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Reservasi Klinik</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Nunito Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .main-color {
            background-color: #6777ef;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light main-color">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Klinik Reservasi</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Kontak Kami</a>
                    </li>
                </ul>


                <ul class="navbar-nav ml-auto">
                    <?php if(logged_in()) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hi, <?= user()->username ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Profil</a>
                            <a class="dropdown-item" href="#">Reservasi</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('logout') ?>">Keluar</a>
                        </div>
                    </li>
                    <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url('login') ?>">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url('register') ?>">Daftar</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

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
                <div class="col-md-4">
                    <div class="card my-3">
                        <img src="https://via.placeholder.com/350x200?text=Treatment+1" class="card-img-top"
                            alt="Treatment 1">
                        <div class="card-body">
                            <h5 class="card-title">Treatment 1</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                porttitor mauris sit amet lacus lobortis posuere.</p>
                            <a href="#" class="btn btn-primary">Reserve</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card my-3">
                        <img src="https://via.placeholder.com/350x200?text=Treatment+2" class="card-img-top"
                            alt="Treatment 2">
                        <div class="card-body">
                            <h5 class="card-title">Treatment 2</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                porttitor mauris sit amet lacus lobortis posuere.</p>
                            <a href="#" class="btn btn-primary">Reserve</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card my-3">
                        <img src="https://via.placeholder.com/350x200?text=Treatment+3" class="card-img-top"
                            alt="Treatment 3">
                        <div class="card-body">
                            <h5 class="card-title">Treatment 3</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                porttitor mauris sit amet lacus lobortis posuere.</p>
                            <a href="#" class="btn btn-primary">Reserve</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card my-3">
                        <img src="https://via.placeholder.com/350x200?text=Treatment+3" class="card-img-top"
                            alt="Treatment 3">
                        <div class="card-body">
                            <h5 class="card-title">Treatment 3</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                porttitor mauris sit amet lacus lobortis posuere.</p>
                            <p class="card-text"><strong>Price: $50</strong></p>
                            <a href="#" class="btn btn-primary">Reserve</a>
                        </div>
                    </div>
                </div>
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

    <!-- Footer -->
    <footer class="text-white py-3 main-color">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5>Kontak</h5>
                    <p>Jl. Jend. Sudirman No.123<br>
                        Jakarta Selatan 12345<br>
                        Indonesia<br>
                        (021) 123-4567</p>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5>Jam Buka</h5>
                    <p>Senin - Jumat: 08.00 - 17.00<br>
                        Sabtu: 08.00 - 13.00<br>
                        Minggu dan Hari Libur: Tutup</p>
                </div>
                <div class="col-md-4">
                    <h5>Tentang Kami</h5>
                    <p>Klinik XYZ menyediakan layanan kesehatan terbaik dengan fasilitas yang lengkap dan dokter yang
                        berpengalaman. Kami siap membantu Anda dalam menjaga kesehatan dan memberikan pengobatan terbaik
                        untuk Anda dan keluarga Anda.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>