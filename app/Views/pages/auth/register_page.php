<?= $this->include('layouts/auth/header') ?>
<!-- Start Here -->
<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-lg-4">
                <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                    <div class="w-100">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <div>
                                    <div class="text-center">
                                        <div>
                                            <a href="index.html" class="">
                                                <img src="assets/images/logo-dark.png" alt="" height="20" class="auth-logo logo-dark mx-auto">
                                                <img src="assets/images/logo-light.png" alt="" height="20" class="auth-logo logo-light mx-auto">
                                            </a>
                                        </div>

                                        <h4 class="font-size-18 mt-4">Register account</h4>
                                    </div>

                                    <div class="p-2 mt-5">
                                        <form method="post" action="<?= base_url('auth/processRegister'); ?>">
                                            <?= csrf_field() ?>

                                            <div class="auth-form-group-custom mb-4">
                                                <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                                            </div>

                                            <div class="auth-form-group-custom mb-4">
                                                <i class="ri-mail-line auti-custom-input-icon"></i>
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                            </div>

                                            <div class="auth-form-group-custom mb-4">
                                                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                            </div>

                                            <div class="auth-form-group-custom mb-4">
                                                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
                                            </div>

                                            <div class="text-center">
                                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                            </div>

                                            <!-- Tampilkan pesan error atau sukses -->
                                            <?php if (session()->getFlashdata('error')) : ?>
                                                <div class="alert alert-danger mt-3"><?= session()->getFlashdata('error') ?></div>
                                            <?php endif; ?>

                                            <?php if (session()->getFlashdata('success')) : ?>
                                                <div class="alert alert-success mt-3"><?= session()->getFlashdata('success') ?></div>
                                            <?php endif; ?>
                                        </form>

                                    </div>

                                    <div class="mt-5 text-center">
                                        <p>Already have an account ? <a href="<?= base_url('auth/login'); ?>" class="fw-medium text-primary"> Login</a> </p>
                                        <p>© <script>
                                                document.write(new Date().getFullYear())
                                            </script> Crafted with <i class="mdi mdi-heart text-danger"></i> by Smash Court</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="authentication-bg position-relative">
                    <div class="bg-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Here -->
<?= $this->include('layouts/auth/footer') ?>