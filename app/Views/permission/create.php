<?= $this->extend('layout/app'); ?>

<!-- Content -->
<?= $this->section('main') ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title ?></h1>
        <div class="section-header-breadcrumb">
            <?php foreach ($breadcrumbs as $value => $url) : ?>
            <div class="breadcrumb-item"><a href="<?= $url ?>"><?= $value ?></a></div>
            <?php endforeach ?>
            <div class="breadcrumb-item"><?= $title ?></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('admin/permission'); ?>" method="post" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="row">
                                        <!-- input permission name -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Permission Name<span
                                                        class="text-danger">*</span></label>
                                                <input
                                                    class="form-control <?= $validation->hasError('name') ? 'is-invalid' : null ?>"
                                                    type="text" name="name" value="<?= old('name') ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('name'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input permission description -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Description</label>
                                                <textarea name="description" class="form-control " id="description"
                                                    cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>