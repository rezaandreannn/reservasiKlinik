<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title ?></h1>

        <div class="section-header-breadcrumb">
            <?php foreach($breadcrumbs as $value => $url) : ?>
            <div class="breadcrumb-item active"><a href="#"><?= $value ?></a></div>
            <?php endforeach ?>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>


    <div class="section-body">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th class="align-middle text-center p-2">Permission</th>
                            </tr>
                            <?php $no = 1; ?>
                            <?php foreach($permissions as $permission) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $permission->name ?></td>
                                <td><?= $permission->description ?></td>
                                <td class="align-middle text-center p-2">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                            data-role="<?= $role->id ?>" data-permission="<?= $permission->id ?>"
                                            id="checkbox-<?= $permission->id ?>"
                                            <?= groups_has_permission($role->id , $permission->id) ? 'checked' : '' ?>>
                                        <label for="checkbox-<?= $permission->id ?>"
                                            class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
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
    iziToast.success({
        title: 'Success!',
        message: '<?= $message ?>',
        position: 'bottomRight'
    });
</script>
<?php endif; ?>

<script>
    $(document).ready(function () {
        $(".custom-control-input").click(function () {
            var roleId = $(this).data('role');
            var permissionId = $(this).data('permission');
            var status = $(this).is(':checked');
            var action = ""


            if (status) {
                action = "insert"
            } else {
                action = "delete"
            }

            $.ajax({
                url: "<?= base_url('admin/changepermission') ?>",
                type: "POST",
                data: {
                    permissionId: permissionId,
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
        })
    })
</script>


<?= $this->endSection() ?>