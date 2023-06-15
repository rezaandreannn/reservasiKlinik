<?= $this->extend('layout/landingpage') ?>

<?= $this->section('main') ?>
<section class="my-5 mb-5">
    <div class="container">
        <h2>Histori Treatment</h2>
        <div class="row">

            <div class="col-12">
                <div class="card border-light mb-3">
                    <div class="card-header d-flex justify-content-between">
                        Histori Saya
                        <a href="<?= base_url('histori-cetak') ?>" target="blink" class="btn btn-success">Cetak</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Harga</th>
                                    <th>Jenis Treatment</th>
                                    <th>Tgl Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($authReservasi as  $value) : ?>
                                <tr>
                                    <td>Rp. <?= format_rupiah($value->jumlah_bayar) ?></td>
                                    <td><?= $value->nama_treatment ?></td>
                                    <td><?=date('d/m/Y', strtotime($value->updated_at)) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection('main') ?>

<!-- Page Specific JS File -->
<?= $this->section('jsSpesific') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>



<!-- flashdata message data -->
<?php if (session()->getFlashdata('message')) : ?>
<?php $message = session()->getFlashdata('message'); ?>
<script>
    Swal.fire(
        'Sukses! 😆',
        '<?= $message ?>',
        'success'
    )
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
<?php $error = session()->getFlashdata('error'); ?>
<script>
    Swal.fire(
        'Error! 😞',
        '<?= $error ?>',
        'error'
    )
</script>
<?php endif; ?>

<?= $this->endSection() ?>