<?php 
 $request = \Config\Services::request();
?>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class=""><a class="nav-link" href="#"><i class="fas fa-chart-line"></i>
                    <span>Dashboard</span></a></li>
            <li class="menu-header">Master Data</li>
            <li class="nav-item dropdown <?= $request->uri->getSegment(1) == 'masterdata' ? 'active' : '' ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= $request->uri->getSegment(2) == 'kategori' ? 'active' : '' ?>"><a class="nav-link"
                            href="<?= base_url('masterdata/kategori') ?>">Kategori</a></li>
                    <li class="<?= $request->uri->getSegment(2) == 'treatment' ? 'active' : '' ?>"><a class="nav-link"
                            href="<?= base_url('masterdata/treatment') ?>">Treatment</a></li>
                    <li class="<?= $request->uri->getSegment(2) == 'bank' ? 'active' : '' ?>"><a class="nav-link"
                            href="<?= base_url('masterdata/bank') ?>">Bank</a></li>
                    <li class="<?= $request->uri->getSegment(2) == 'jadwal' ? 'active' : '' ?>"><a class="nav-link"
                            href="<?= base_url('masterdata/jadwal') ?>">Jadwal</a></li>
                </ul>
            </li>
            <li class=""><a class="nav-link" href="blank.html"><i class="far fa-square"></i>
                    <span>User Reservasi</span></a></li>


            <li class="menu-header">Kelola</li>
            <li class="nav-item dropdown 
            <?= $request->uri->getSegment(2) == 'pengguna' ? 'active' : '' ?>
            <?= $request->uri->getSegment(2) == 'grup' ? 'active' : '' ?>
            <?= $request->uri->getSegment(2) == 'perizinan' ? 'active' : '' ?>
            <?= $request->uri->getSegment(2) == 'perizinan-grup' ? 'active' : '' ?>
            ">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Kelola Pengguna</span></a>
                <ul class="dropdown-menu">

                    <li class="<?= $request->uri->getSegment(2) == 'pengguna' ? 'active' : '' ?>"><a
                            href="<?= base_url('admin/pengguna') ?>">Pengguna</a></li>


                    <li class="<?= $request->uri->getSegment(2) == 'grup' ? 'active' : '' ?>"><a
                            href="<?= base_url('admin/grup') ?>">Grup</a></li>


                    <li class="<?= $request->uri->getSegment(2) == 'perizinan' ? 'active' : '' ?>"><a
                            href="<?= base_url('admin/perizinan') ?>">Perizinan</a></li>


                    <li class="<?= $request->uri->getSegment(2) == 'perizinan-grup' ? 'active' : '' ?>"><a
                            href="<?= base_url('admin/perizinan-grup') ?>">Perizinan grup</a></li>

                </ul>
            </li>
        </ul>


    </aside>
</div>