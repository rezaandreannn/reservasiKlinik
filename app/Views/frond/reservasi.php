<?= $this->extend('layout/landingpage') ?>

<?= $this->section('main') ?>
<section class="my-5 mb-5">
    <div class="container">
        <h2>Reservasi Treatment</h2>
        <div class="row">

            <div class="col-12">
                <div class="card border-light mb-3">
                    <div class="card-header">Reservasi Saya</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Treatment</th>
                                    <th>Tipe Bayar</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($authReservasi as  $value) : ?>
                                <tr>
                                    <td><?= $value->tanggal_reservasi ?></td>
                                    <td><?= $value->nama_treatment ?></td>
                                    <td><?= $value->type_pembayaran ?></td>
                                    <td><?= $value->jam_mulai ?></td>
                                    <td><?= $value->jam_selesai ?></td>
                                    <td>
                                        <!-- <a href="http://" class="btn btn-info btn-sm">Cetak</a> -->
                                        <?php if($value->type_pembayaran == 'bayar online') : ?>
                                        <?php if($value->bukti_bayar != null) : ?>
                                        <a href="<?= base_url('reservasi/detail/'. $value->id) ?>"
                                            class="btn btn-warning btn-sm">Detail</a>
                                        <?php else : ?>
                                        <a href="<?= base_url('bayar/'. $value->id) ?>"
                                            class="btn btn-success btn-sm">Bayar</a>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <form method="post" action="<?= base_url('reservasi/batal/'. $value->id) ?>"
                                            class="d-inline">
                                            <input type="hidden" name="_method" value="PUT">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-sm btn-danger">Batal</button>
                                        </form>
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