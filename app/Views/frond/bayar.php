<?= $this->extend('layout/landingpage') ?>

<?= $this->section('main') ?>
<section class="my-5 mb-5">
    <div class="container">
        <h2>Pembayaran</h2>
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="card border-light mb-3">
                    <div class="card-header">Nama Treatment : <strong><?= $reservasi->nama_treatment ?? '' ?></strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">Nama</div>
                            <div class="col-7">: <?= user()->username ?></div>
                            <div class="col-5">Tgl. Reservasi</div>
                            <div class="col-7">: <?= $reservasi->tanggal_reservasi ?? '' ?></div>
                            <!-- <div class="col-5">Tipe Bayar</div>
                            <div class="col-7">: <?= $reservasi->type_pembayaran ?? '' ?></div> -->
                            <div class="col-5">Kode Bank</div>
                            <div class="col-7">: <?= $reservasi->kode_bank ??'' ?></div>
                            <div class="col-5">No. Rekening</div>
                            <div class="col-7">: <?= $reservasi->no_rekening ??'' ?> </div>
                            <div class="col-5">Total Bayar</div>
                            <div class="col-7">: Rp. <?= format_rupiah($reservasi->jumlah_bayar) ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="card border-light mb-3">
                    <div class="card-header">Lakukan Pembayaran kemudian upload bukti</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="post" action="<?= base_url('bayar/'. $reservasi->id); ?>"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="_method" value="PUT">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="bukti_bayar">Upload bukti</label>
                                        <input type="file"
                                            class="form-control <?= session('errors.bukti_bayar') ? 'is-invalid' : '' ?>"
                                            name="bukti_bayar">
                                        <div class="invalid-feedback">
                                            <?= session('errors.bukti_bayar') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
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