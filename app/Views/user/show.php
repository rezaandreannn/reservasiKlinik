<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>
<section class="section">
    <div class="section-header">
        <h1>Pengguna</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">User</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Pengguna</h2>
        <p class="section-lead">Data Pengguna <?= ucfirst($user->username) ?> </p>

        <div class="row">
            <div class="col-12 col-sm-12 col-lg-7">
                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="author-box-left">
                            <img alt="image" src="<?= base_url($user->foto) ?>"
                                class="rounded-circle author-box-picture">
                            <div class="clearfix"></div>
                            <div class="btn btn-success mt-3">Aktif</div>


                        </div>
                        <div class="author-box-details">
                            <div class="author-box-name">
                                <a href="#"><?= ucfirst($user->username) ?></a>
                            </div>
                            <div class="author-box-job"><?= $user->email ?></div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-3">No Telp</div>
                                    <div class="col-3"><?= $user->no_telp ?></div>
                                </div>
                            </div>


                            <div class="w-100 d-sm-none "></div>
                            <div class="float-right mt-sm-0 mt-3">
                                <a href="<?= base_url('admin/pengguna/edit/'. $user->id) ?>"
                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form method="post" action="<?= base_url('admin/pengguna/'. $user->id) ?>"
                                    class="d-inline">
                                    <?= csrf_field()?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-5">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Grup</th>
                                        <th class="align-middle text-center p-2">Dimiliki</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach($grups as $grup) : ?>
                                    <tr>
                                        <td><?= ucfirst($grup->name) ?></td>
                                        <td class="align-middle text-center p-2">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    class="custom-control-input" data-grup="<?= $grup->id ?>"
                                                    data-user="<?= $user->id ?>" id="checkbox-<?= $grup->id ?>"
                                                    <?= users_has_groups($user->id , $grup->id) ? 'checked' : '' ?>>
                                                <label for="checkbox-<?= $grup->id ?>"
                                                    class="custom-control-label">&nbsp;</label>
                                            </div>
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
<link rel="stylesheet" href="<?= base_url('stisla/node_modules/izitoast/dist/css/iziToast.min.css') ?>">
<?= $this->endSection() ?>

<!-- JS Libraies -->
<?= $this->section('jsLibrary') ?>
<script src="<?= base_url('stisla/node_modules/izitoast/dist/js/iziToast.min.js') ?>"></script>

<?= $this->endSection() ?>

<!-- Page Specific JS File -->
<?= $this->section('jsSpesific') ?>

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



<!-- <script>
    $(document).ready(function () {
        $('.delete').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "data ini akan terhapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script> -->

<script>
    $(document).ready(function () {
        $('.custom-control-input').on('change', function () {
            var grupId = $(this).data('grup');
            var userId = $(this).data('user');
            var status = $(this).is(':checked');
            var action = ""


            if (status) {
                action = "insert"
            } else {
                action = "delete"
            }

            $.ajax({
                url: "<?= base_url('admin/manage_role') ?>",
                type: "POST",
                data: {
                    userId: userId,
                    roleId: grupId,
                    action: action
                },
                success: function (data) {
                    iziToast.success({
                        title: 'Success!',
                        message: data,
                        position: 'bottomRight'
                    });

                }
            });
        });
    });
</script>





<?= $this->endSection() ?>