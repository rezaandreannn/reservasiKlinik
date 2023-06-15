<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title ?>
            <!-- <a href="<?= base_url('masterdata/treatment/baru') ?>" class="btn btn-primary mb-2"><i
                    class="fas fa-plus-circle"></i>
                Tambah
            </a> -->

        </h1>

        <div class="section-header-breadcrumb">
            <?php foreach($breadcrumbs as $value => $url) : ?>
            <div class="breadcrumb-item active"><a href="#"><?= $value ?></a></div>
            <?php endforeach ?>
            <div class="breadcrumb-item">Data reservasi</div>
        </div>
    </div>


    <div class="section-body">
        <div class="col-12 col-md-12 col-lg-12">
            <p class="section-title">Menampilkan semua data reservasi yang bayar ditempat</p>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">No</th>
                                    <th rowspan="2" class="align-middle">Kode</th>
                                    <th rowspan="2" class="align-middle">Nama</th>
                                    <th rowspan="2" class="align-middle">Treatment</th>
                                    <th rowspan="2" class="align-middle">Tanggal</th>
                                    <th rowspan="2" class="align-middle">Jumlah</th>
                                    <!-- <th rowspan="2" class="align-middle">Tipe bayar</th> -->
                                    <th colspan="2" class="text-center">status</th>
                                    <th rowspan="2" class="align-middle text-center">Aksi</th>
                                </tr>
                                <tr>
                                    <!-- <th colspan="7"></th> -->
                                    <th>Pembayaran</th>
                                    <th>Reservasi</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($reservasis as $reservasi) : ?>
                                <tr>
                                    <td class="align-middle"><?= $no++ ?></td>
                                    <td class="align-middle"><?=$reservasi->kode_reservasi ?></td>
                                    <td class="align-middle"><?= $reservasi->username ?></td>
                                    <td class="align-middle">
                                        <?= $reservasi->nama_treatment ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $reservasi->tanggal_reservasi ?>
                                    </td>
                                    <td class="align-middle">
                                        Rp. <?= format_rupiah($reservasi->jumlah_bayar) ?>
                                    </td>
                                    <!-- <td class="align-middle">
                                        <?= $reservasi->type_pembayaran ?>
                                    </td> -->
                                    <td class="align-middle">
                                        <div
                                            class="badge badge-<?= $reservasi->status_bayar == 'belum lunas' ? 'danger' : 'success'  ?>">
                                            <?= $reservasi->status_bayar ?></div>
                                    </td>
                                    <td class="align-middle">
                                        <?php if($reservasi->status_reservasi == 'pending') : ?>
                                        <div class="badge badge-info"><?= $reservasi->status_reservasi ?></div>
                                        <?php elseif($reservasi->status_reservasi == 'selesai') : ?>
                                        <div class="badge badge-success"><?= $reservasi->status_reservasi ?></div>
                                        <?php else : ?>
                                        <div class="badge badge-danger"><?= $reservasi->status_reservasi ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle text-center p-2">
                                        <?php if($reservasi->status_reservasi == 'pending') : ?>
                                        <form method="post"
                                            action="<?= base_url('reservasi/bayar-offline/'. $reservasi->id) ?>"
                                            class="d-inline">
                                            <input type="hidden" name="_method" value="PUT">
                                            <?= csrf_field() ?>
                                            <!-- <input type="hidden" name="id_reservasi" value="<?= $reservasi->id ?>"> -->
                                            <button class="btn btn-sm btn-primary">Selesai</button>
                                        </form>
                                        <?php endif; ?>

                                        <?php if($reservasi->status_reservasi != 'selesai') : ?>
                                        <form method="post"
                                            action="<?= base_url('reservasi/delete/'. $reservasi->id) ?>"
                                            class="d-inline">
                                            <?= csrf_field()?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-sm btn-danger"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                        <?php endif; ?>

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

<!-- CSS Libraries -->
<?= $this->section('cssLibrary') ?>
<link rel="stylesheet"
    href="<?= base_url('stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet"
    href="<?= base_url('stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') ?>">
<?= $this->endSection() ?>

<!-- JS Libraies -->
<?= $this->section('jsLibrary') ?>
<script src="<?= base_url('stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') ?>"></script>
<?= $this->endSection() ?>

<!-- Page Specific JS File -->
<?= $this->section('jsSpesific') ?>
<script src="<?= base_url('stisla/assets/js/page/modules-datatables.js') ?>"></script>

<!-- flashdata message data -->
<?php if (session()->getFlashdata('message')) : ?>
<?php $message = session()->getFlashdata('message'); ?>
<script>
    Swal.fire(
        'Sukses!',
        '<?= $message ?>',
        'success'
    )
</script>
<?php endif; ?>


<?= $this->endSection() ?>