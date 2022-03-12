<?= $this->extend('auth/template/index'); ?>
<?= $this->section('content'); ?>
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">Login <b>BakeryAPP</b></h4>

                                <?php if (session()->getFlashData('login')) :
                                ?>
                                    <div class="alert alert-danger solid alert-dismissible fade show">
                                        <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                        </svg>
                                        <strong>Error!</strong> <?= session()->getFlashdata('login'); ?>
                                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashData('forgotSuccess')) : ?>
                                    <div class="alert alert-success solid alert-dismissible fade show">
                                        <strong>Success!</strong> <?= session()->getFlashdata('forgotSuccess');  ?>
                                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                        </button>
                                    </div>
                                <?php endif; ?>


                                <form method="POST" action="<?= base_url(); ?>/auth/loginSave">
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Username</strong></label>
                                        <input type="text" class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : ''); ?>" placeholder="Masukkan Username..." name="username">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>" placeholder="Masukkan Password..." name="password">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>

                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
                                                <label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a href="<?= base_url('auth/forgot_password'); ?>">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>