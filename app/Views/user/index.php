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
            <div class="breadcrumb-item">Table</div>
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
                                        <th class="text-center align-middle" rowspan="2">
                                            No
                                        </th>
                                        <th rowspan="2" class="align-middle">Email</th>
                                        <th rowspan="2" class="align-middle">Username</th>
                                        <th colspan="<?= $sumGroup ?>" class="text-center">Role</th>
                                        <th rowspan="2" class="align-middle text-center">Action</th>
                                    </tr>
                                    <tr>
                                        <?php foreach($groups as $group) : ?>
                                        <th class="text-center"><?= $group->name ?> </th>
                                        <?php endforeach ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ; ?>
                                    <?php foreach($users as $user) : ?>
                                    <tr d>
                                        <td class="text-center">
                                            <?= $no++ ?>
                                        </td>
                                        <td><?= $user->email ?></td>
                                        <td>
                                            <?= $user->username ?>
                                        </td>
                                        <?php
                                        $roles = explode(', ', $user->name);
                                        ?>
                                        <?php foreach($groups as $group) : ?>
                                        <td class="text-center" id="user<?= $user->userId ?>">
                                            <div class="custom-checkbox custom-control">
                                                <?php if(has_permission('edit-user')) : ?>
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    data-role="<?= $group->id ?>" data-user="<?= $user->userId ?>"
                                                    class="custom-control-input <?= $user->userId ?>"
                                                    name="<?= $group->name ?>"
                                                    id="checkbox-<?= $group->id ?>-<?= $user->userId ?>"
                                                    value="<?= $group->id ?>"
                                                    <?= in_array($group->name, $roles) ? 'checked' : '' ?>>
                                                <label for="checkbox-<?= $group->id ?>-<?= $user->userId ?>"
                                                    class="custom-control-label">&nbsp;</label>
                                                <?php else : ?>
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    data-role="<?= $group->id ?>" data-user="<?= $user->userId ?>"
                                                    class="custom-control-input <?= $user->userId ?>"
                                                    name="<?= $group->name ?>"
                                                    id="checkbox-<?= $group->id ?>-<?= $user->userId ?>"
                                                    value="<?= $group->id ?>"
                                                    <?= in_array($group->name, $roles) ? 'checked' : '' ?> disabled>
                                                <label for="checkbox-<?= $group->id ?>-<?= $user->userId ?>"
                                                    class="custom-control-label">&nbsp;</label>
                                                <?php endif ?>
                                            </div>
                                        </td>
                                        <?php endforeach ?>
                                        <td class="text-center">
                                            <?php if(has_permission('delete-user')) : ?>
                                            <form method="post" action="<?= base_url('admin/user/'. $user->userId) ?>"
                                                class="d-inline">
                                                <?= csrf_field()?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <?php else : ?>
                                            <form method="post" action="<?= base_url('admin/user/'. $user->userId) ?>"
                                                class="d-inline">
                                                <?= csrf_field()?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-sm btn-danger" disabled><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <?php endif ?>
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
    iziToast.success({
        title: 'Success!',
        message: '<?= $message ?>',
        position: 'bottomRight'
    });
</script>
<?php endif; ?>

<script>
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
</script>





<?= $this->endSection() ?>