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
            <li class="nav-item dropdown <?= $request->uri->getSegment(2) == 'categories' ? 'active' : '' ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Treatment</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= $request->uri->getSegment(2) == 'categories' ? 'active' : '' ?>"><a class="nav-link"
                            href="<?= base_url('admin/category') ?>">Category</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Treatment</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Discount</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Schedule</a></li>
                </ul>
            </li>
            <li class=""><a class="nav-link" href="blank.html"><i class="far fa-square"></i>
                    <span>User Reservasi</span></a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                    <span>Bootstrap</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="bootstrap-alert.html">Alert</a></li>
                    <li><a class="nav-link" href="bootstrap-badge.html">Badge</a></li>
                    <li><a class="nav-link" href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
                    <li><a class="nav-link" href="bootstrap-buttons.html">Buttons</a></li>
                    <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
                    <li><a class="nav-link" href="bootstrap-carousel.html">Carousel</a></li>
                    <li><a class="nav-link" href="bootstrap-collapse.html">Collapse</a></li>
                    <li><a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a></li>
                    <li><a class="nav-link" href="bootstrap-form.html">Form</a></li>
                    <li><a class="nav-link" href="bootstrap-list-group.html">List Group</a></li>
                    <li><a class="nav-link" href="bootstrap-media-object.html">Media Object</a></li>
                    <li><a class="nav-link" href="bootstrap-modal.html">Modal</a></li>
                    <li><a class="nav-link" href="bootstrap-nav.html">Nav</a></li>
                    <li><a class="nav-link" href="bootstrap-navbar.html">Navbar</a></li>
                    <li><a class="nav-link" href="bootstrap-pagination.html">Pagination</a></li>
                    <li><a class="nav-link" href="bootstrap-popover.html">Popover</a></li>
                    <li><a class="nav-link" href="bootstrap-progress.html">Progress</a></li>
                    <li><a class="nav-link" href="bootstrap-table.html">Table</a></li>
                    <li><a class="nav-link" href="bootstrap-tooltip.html">Tooltip</a></li>
                    <li><a class="nav-link" href="bootstrap-typography.html">Typography</a></li>
                </ul>
            </li>

            <li class="menu-header">Kelola</li>
            <li class="nav-item dropdown 
            <?= $request->uri->getSegment(2) == 'user' ? 'active' : '' ?>
            <?= $request->uri->getSegment(2) == 'grup' ? 'active' : '' ?>
            <?= $request->uri->getSegment(2) == 'permission' ? 'active' : '' ?>
            <?= $request->uri->getSegment(2) == 'rolehaspermission' ? 'active' : '' ?>
            ">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Kelola Pengguna</span></a>
                <ul class="dropdown-menu">
                    <?php if (has_permission('read-user')) : ?>
                    <li class="<?= $request->uri->getSegment(2) == 'user' ? 'active' : '' ?>"><a
                            href="<?= base_url('admin/user') ?>">Pengguna</a></li>
                    <?php endif; ?>
                    <?php if (has_permission('read-role')) : ?>
                    <li class="<?= $request->uri->getSegment(2) == 'grup' ? 'active' : '' ?>"><a
                            href="<?= base_url('admin/grup') ?>">Grup</a></li>
                    <?php endif; ?>
                    <?php if (has_permission('read-permission')) : ?>
                    <li class="<?= $request->uri->getSegment(2) == 'permission' ? 'active' : '' ?>"><a
                            href="<?= base_url('admin/permission') ?>">Perizinan</a></li>
                    <?php endif; ?>
                    <?php if (has_permission('read-haspermission')) : ?>
                    <li class="<?= $request->uri->getSegment(2) == 'rolehaspermission' ? 'active' : '' ?>"><a
                            href="<?= base_url('admin/rolehaspermission') ?>">Role has permission</a></li>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>