<?= $this->extend('layout/auth') ?>

<?= $this->section('main') ?>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">



                <div class="card card-primary">
                    <div class="card-header">
                        <h4><?=lang('Auth.loginAction')?></h4>
                    </div>


                    <div class="card-body">
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <form action="<?= url_to('login') ?>" method="post" novalidate="">
                            <?= csrf_field() ?>
                            <!-- <form method="POST" action="#" class="needs-validation" novalidate=""> -->

                            <?php if ($config->validFields === ['email']): ?>
                            <div class="form-group">
                                <label for="login"><?=lang('Auth.email')?></label>
                                <input type="email"
                                    class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                    name="login" placeholder="<?=lang('Auth.email')?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="form-group">
                                <label for="login"><?=lang('Auth.emailOrUsername')?></label>
                                <input type="text"
                                    class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                    name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label"><?=lang('Auth.password')?></label>
                                    <?php if ($config->activeResetter): ?>
                                    <div class="float-right">
                                        <a href="<?= url_to('forgot') ?>" class="text-small">
                                            Forgot Password?
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <input type="password" name="password"
                                    class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                                    placeholder="<?=lang('Auth.password')?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>
                            <?php if ($config->allowRemembering): ?>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>
                            <?php endif; ?>



                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    <?=lang('Auth.loginAction')?>
                                </button>
                            </div>
                        </form>


                    </div>
                </div>
                <?php if ($config->allowRegistration) : ?>
                <div class="mt-5 text-muted text-center">
                    Belum Punya akun. <a href="<?= url_to('register') ?>"><?=lang('Auth.needAnAccount')?></a>
                </div>
                <?php endif; ?>
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