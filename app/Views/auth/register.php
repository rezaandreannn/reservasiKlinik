<?= $this->extend('layout/auth') ?>


<?= $this->section('main') ?>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>

                    <div class="card-body">
                        <form action="<?= url_to('register') ?>" method="post" novalidate="">
                            <?= csrf_field() ?>

                            <div class="form-group">
                                <label for="email"><?=lang('Auth.email')?></label>
                                <input type="email"
                                    class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                    name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>"
                                    value="<?= old('email') ?>">
                                <small id="emailHelp"
                                    class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
                                <div class="invalid-feedback">
                                    <?= session('errors.email') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username"><?=lang('Auth.username')?></label>
                                <input type="text"
                                    class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>"
                                    name="username" placeholder="<?=lang('Auth.username')?>"
                                    value="<?= old('username') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.username') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password"><?=lang('Auth.password')?></label>
                                <input type="password" name="password"
                                    class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                                    placeholder="<?=lang('Auth.password')?>" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                                <input type="password" name="pass_confirm"
                                    class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                                    placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= session('errors.pass_confirm') ?>
                                </div>
                            </div>

                            <br>

                            <button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.register')?></button>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Stisla 2018
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection('main') ?>

<!-- pageCssLibrary -->

<!-- pagesStyle -->

<!-- jsLibrary -->

<!-- pageSpesificJS -->