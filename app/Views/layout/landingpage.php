<?php 
 $request = \Config\Services::request();
?>
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

    <!-- CSS Libraries -->
    <?= $this->renderSection('cssLibrary') ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css"
        integrity="sha256-sWZjHQiY9fvheUAOoxrszw9Wphl3zqfVaz1kZKEvot8=" crossorigin="anonymous">


    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .main-color {
            background-color: #6777ef;
        }

        .navbar-nav {
            display: flex;
            /* Menjadikan container sebagai flexbox */
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Membuat child element menjadi flexbox */
        }

        .nav-link.active {
            border-bottom: 1px solid white;
            /* Garis bawah warna hitam */
            width: 50%;
            /* Lebar garis bawah 80% dari lebar menu */
            display: flex;
            justify-content: center;
            /* Membuat garis bawah rata tengah */
        }

        footer {
            bottom: 0;
            left: 0;
            width: 100%;
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
                        <a class="nav-link text-white <?= $request->uri->getSegment(1) == '' ? 'active' : '' ?>"
                            href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white <?= $request->uri->getSegment(1) == 'treatment' ? 'active' : '' ?>"
                            href="<?= base_url('treatment') ?>">Layanan</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-white" href="#">Kontak Kami</a>
                    </li> -->
                    <?php if(logged_in()) : ?>
                    <li class="nav-item">
                        <a class="nav-link text-white <?= $request->uri->getSegment(1) == 'reservasi-saya' ? 'active' : '' ?>"
                            href="<?= base_url('reservasi-saya') ?>">Reservasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white <?= $request->uri->getSegment(1) == 'histori' ? 'active' : '' ?>"
                            href="<?= base_url('histori') ?>">Histori</a>
                    </li>
                    <?php endif; ?>
                </ul>


                <ul class="navbar-nav ml-auto">
                    <?php if(logged_in()) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hi, <?= user()->username ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Profil</a>
                            <?php if(in_groups('admin')) : ?>
                            <a class="dropdown-item" href="<?= base_url('dashboard')  ?>">Dashbaord</a>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('logout') ?>">Keluar</a>
                        </div>
                    </li>
                    <?php else : ?>
                    <li class="nav-item">
                        <a class="btn btn-warning" href="<?= base_url('login') ?>">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning ml-2" href="<?= base_url('register') ?>">Daftar</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('main') ?>



    <!-- Modal profile -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">Nama
                        </div>
                        <div class="col-6">: <?= user()->username ?? '' ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">Email
                        </div>
                        <div class="col-6">: <?= user()->email ?? '' ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>

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

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- JS Libraies -->
    <?= $this->renderSection('jsLibrary') ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"
        integrity="sha256-t0FDfwj/WoMHIBbmFfuOtZv1wtA977QCfsFR3p1K4No=" crossorigin="anonymous"></script>


    <!-- Page Specific JS File -->
    <?= $this->renderSection('jsSpesific') ?>
</body>

</html>