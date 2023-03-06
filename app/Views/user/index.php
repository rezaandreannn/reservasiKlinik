<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title ?>
            <!-- <a href="<?= base_url('role/new') ?>" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Create
            </a> -->
        </h1>

        <div class="section-header-breadcrumb">
            <?php foreach($breadcrumbs as $value => $url) : ?>
            <div class="breadcrumb-item active"><a href="#"><?= $value ?></a></div>
            <?php endforeach ?>
            <div class="breadcrumb-item">Data Pengguna</div>
        </div>
    </div>


    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="align-middle">
                                            No
                                        </th>
                                        <th class="align-middle">Email</th>
                                        <th class="align-middle">Nama Pengguna</th>
                                        <th class="">No Telp</th>
                                        <th class="">Status</th>
                                        <th class="align-middle text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ; ?>
                                    <?php foreach($users as $user) : ?>
                                    <tr>
                                        <td class="">
                                            <?= $no++ ?>
                                        </td>
                                        <td><?= $user->email ?></td>
                                        <td>
                                            <?= $user->username ?>
                                        </td>
                                        <td>
                                            <?= $user->no_telp ?>
                                        </td>
                                        <td>
                                            <?php if ($user->deleted_at == null) : ?>
                                            <div class="badge badge-success">
                                                Aktif
                                            </div>
                                            <?php else : ?>
                                            <div class="badge badge-danger">
                                                Tidak aktif
                                            </div>
                                            <?php endif; ?>

                                        </td>

                                        <td class="text-center">
                                            <?php if ($user->deleted_at == null) : ?>
                                            <a href="<?= base_url('admin/pengguna/show/'. $user->id) ?>"
                                                class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i></a>
                                            <a href="<?= base_url('admin/pengguna/edit/'. $user->id) ?>"
                                                class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            <form method="post" action="<?= base_url('admin/pengguna/'. $user->id) ?>"
                                                class="d-inline">
                                                <?= csrf_field()?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <?php else : ?>
                                            <a href="<?= base_url('admin/pengguna/restore/'. $user->id) ?>"
                                                class="btn btn-sm btn-success"><i class="fas fa-trash-restore"></i></a>
                                            <form method="post"
                                                action="<?= base_url('admin/pengguna/force/'. $user->id) ?>"
                                                class="d-inline delete">
                                                <?= csrf_field()?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
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
<link rel="stylesheet"
    href="<?= base_url('stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet"
    href="<?= base_url('stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') ?>">
<?= $this->endSection() ?>

<!-- JS Libraies -->
<?= $this->section('jsLibrary') ?>
<script src="<?= base_url('stisla/node_modules/izitoast/dist/js/iziToast.min.js') ?>"></script>
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

<!-- flashdata message data -->
<?php if (session()->getFlashdata('error')) : ?>
<?php $message = session()->getFlashdata('error'); ?>
<script>
    Swal.fire(
        'Error!',
        '<?= $message ?>',
        'error'
    )
</script>
<?php endif; ?>

<script>
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
</script>

<!-- <script>
    $(document).ready(function () {
        $('.custom-control-input').on('change', function () {
            var roleId = $(this).data('role');
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
                    roleId: roleId,
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
</script> -->





<?= $this->endSection() ?>