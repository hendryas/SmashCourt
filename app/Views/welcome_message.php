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

                                        <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                                        <p class="text-muted">Sign in to continue</p>
                                    </div>

                                    <div class="p-2 mt-5">
                                        <form class="" action="<?= base_url('/auth/processLogin') ?>" method="post">

                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                                            </div>

                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" placeholder="Enter password">
                                            </div>

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customControlInline">
                                                <label class="form-check-label" for="customControlInline">Remember me</label>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <!-- <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button> -->
                                                <button type="submit" class="btn btn-primary w-md waves-effect waves-light">Log In</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <p>Don't have an account ? <a href="<?= base_url('auth/register') ?>" class="fw-medium text-primary"> Register </a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="authentication-bg">
                    <div class="bg-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Here -->
<?= $this->include('layouts/auth/footer') ?>