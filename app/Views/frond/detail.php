<?= $this->extend('layout/landingpage') ?>

<?= $this->section('main') ?>
<section class="my-5 mb-5">
    <div class="container">
        <h2><?= $title ?? '' ?></h2>
        <div class="row">
            <div class="col-12">
                <div class="card border-light mb-3">
                    <div class="card-header">Nama Treatment : <strong><?= $reservasi->nama_treatment ?? '' ?></strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">Nama</div>
                            <div class="col-7">: <?= user()->username ?></div>
                            <div class="col-4">Tgl. Reservasi</div>
                            <div class="col-7">: <?= $reservasi->tanggal_reservasi ?></div>
                            <div class="col-4">Tipe Bayar</div>
                            <div class="col-7">: <?= $reservasi->type_pembayaran ?></div>
                            <div class="col-4">Kode Bank</div>
                            <div class="col-7">: <?= $reservasi->kode_bank ?></div>
                            <div class="col-4">No. Rekening</div>
                            <div class="col-7">: <?= $reservasi->no_rekening ?> </div>
                            <div class="col-4">Total Bayar</div>
                            <div class="col-7">: Rp. <?= format_rupiah($reservasi->jumlah_bayar) ?></div>
                            <div class="col-4">Status Pembayaran</div>
                            <div class="col-7">:
                                <?php if($reservasi->bukti_bayar != null & $reservasi->status_bayar != 'lunas') : ?>
                                menunggu konfirmasi
                                <?php else : ?>
                                <?= $reservasi->status_bayar ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-4">Bukti Pembayaran</div>
                            <div class="col-7"> <img
                                    src="<?= base_url('images/pembayaran/'. $reservasi->bukti_bayar) ?>" alt=""
                                    class="img-thumbnail img-fluid"> </div>
                        </div>
                    </div>
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