<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title ?>
            <?php if(has_permission('create-role')) : ?>
            <a href="<?= base_url('admin/role/new') ?>" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i>
                Create
            </a>
            <?php else : ?>
            <a href="<?= base_url('admin/role/new') ?>" class="btn btn-primary mb-2" style="pointer-events: none;"><i
                    class="fas fa-plus-circle"></i>
                Create
            </a>
            <?php endif ?>
        </h1>

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
                                <th class="align-middle text-center p-2">Action</th>
                            </tr>
                            <?php $no = 1; ?>
                            <?php foreach($roles as $role) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $role->name ?></td>
                                <td><?= $role->description ?></td>
                                <td class="align-middle text-center p-2">
                                    <?php if(has_permission('edit-role')) : ?>
                                    <a href="<?= base_url('admin/role/'.$role->id) ?>" class="btn btn-sm btn-warning"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <?php else : ?>
                                    <a href="<?= base_url('admin/role/'.$role->id) ?>" class="btn btn-sm btn-warning"
                                        style="pointer-events: none;"><i class="fas fa-pencil-alt"></i></a>
                                    <?php endif; ?>

                                    <?php if(has_permission('delete-role')) : ?>
                                    <form method="post" action="<?= base_url('admin/role/'. $role->id) ?>"
                                        class="d-inline">
                                        <?= csrf_field()?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    <?php else : ?>
                                    <form method="post" action="<?= base_url('admin/role/'. $role->id) ?>"
                                        class="d-inline">
                                        <?= csrf_field()?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-sm btn-danger" disabled><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                    <?php endif ?>
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


<?= $this->endSection() ?>