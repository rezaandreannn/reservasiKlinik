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
                        <form action="<?= base_url('admin/grup'); ?>" method="post" autocomplete="off">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="row">
                                        <!-- input role name -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Nama Grup<span class="text-danger">*</span></label>
                                                <input
                                                    class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>"
                                                    type="text" name="name" value="<?= old('name') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.name') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input role description -->
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Deskripsi</label>
                                                <textarea name="description"
                                                    class="form-control <?= session('errors.description') ? 'is-invalid' : '' ?>"
                                                    id="description" cols="30"
                                                    rows="10"><?= old('description') ?></textarea>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.description') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>