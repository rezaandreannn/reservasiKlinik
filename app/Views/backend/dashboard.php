<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Reservasi</h4>
                        </div>
                        <div class="card-body">
                            <?= $countAll ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-sync"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Selesai</h4>
                        </div>
                        <div class="card-body">
                            <?= $countPending ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pending</h4>
                        </div>
                        <div class="card-body">
                            <?= $countPending ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-window-close"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Batal</h4>
                        </div>
                        <div class="card-body">
                            <?= $countBatal ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Reservasi</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-info">Pending <i class="fas fa-clock"></i></a>
                        </div>
                    </div>
                    <div class="card-body  p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="align-middle">No</th>
                                        <th class="align-middle">Nama</th>
                                        <th class="align-middle">Treatment</th>
                                        <th class="align-middle">Status Bayar</th>
                                        <th class="align-middle">Jam Mulai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($reservasis as $reservasi) : ?>
                                    <tr>
                                        <td class="align-middle"><?= $no++ ?></td>
                                        <td class="align-middle"><?= $reservasi->username ?></td>
                                        <td class="align-middle"><?= $reservasi->nama_treatment ?></td>
                                        <td class="align-middle">
                                            <div
                                                class="badge badge-<?= $reservasi->status_bayar == 'belum lunas' ? 'danger' : 'success'  ?>">
                                                <?= $reservasi->status_bayar ?></div>
                                        </td>
                                        <td class="align-middle">
                                            <?= $reservasi->jam_mulai ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection('main') ?>