<?php
$page = "Sign Up";
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="../assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="../assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />

    <link href="../assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

  
   
<style>

</style>
</head>

<body>
    <!-- Signin page bg -->
    <!-- <div class="main "> -->
    <div class="signin-page-wrapper pt-5">
        <div class="signup-bg bg1">
            <!-- <div class="bg1-overlay"> -->
            <div class="z-n1 shape ">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1400 80">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1400,40L1440 140L0 140z"></path>
                </svg>
            </div>
            <!-- </div> -->
        </div>

        <div class=" z-1 signup-page-content mt-5 ">
            <div class="container mt-5">
                <div class="row mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 mt-2 col-xl-5">
                            <div class="card mt-5">
                                <div class="card-body p-4">
                                    <div class="text-center mt-1">

                                        <h5 class="text-primary mt-1">Sign Up !</h5>
                                    </div>
                                    <div class="p-2 mt-3">
                                        <form class="tablelist-form" autocomplete="off">
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />
                                                <div class="row ">
                                                    <div class="col-lg-12">
                                                        <div class="text-center">
                                                            <div class="position-relative d-inline-block">
                                                                <div class="position-absolute  bottom-0 end-0">
                                                                    <label for="customer-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                                                        <div class="avatar-xs cursor-pointer">
                                                                            <div class="avatar-title bg-light border rounded-circle text-muted">
                                                                                <i class="ri-image-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                    <input class="form-control d-none" value="" id="customer-image-input" name="customer-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                                </div>
                                                                <div class="avatar-lg p-1">
                                                                    <div class="avatar-title bg-light rounded-circle">
                                                                        <img id="customer-img" src="../assets/images/users/user-dummy-img.jpg" class="avatar-md rounded-circle object-cover" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3 ">
                                                    <div class="col-lg-6 mt-1">
                                                        <div>
                                                            <label for="name-field" class="form-label">First Name</label><span class="text-danger" id="err_issue_fname">*</span>
                                                            <input type="text" id="username-field" name="username-field" class="form-control" placeholder="Enter First name" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 mt-1">
                                                        <div>
                                                            <label for="name-field" class="form-label">Middel Name</label><span class="text-danger" id="err_issue_mname">*</span>
                                                            <input type="text" id="middel_name-field" name="middel_name-field" class="form-control" placeholder="Enter Middel name" required />
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row mt-3 ">
                                                    <div class="col-lg-6 mt-1">
                                                        <div>
                                                            <label for="name-field" class="form-label">Last Name</label><span class="text-danger" id="err_issue_lname">*</span>
                                                            <input type="text" id="last_name-field" name="last_name-field" class="form-control" placeholder="Enter Last name" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 mt-1">

                                                        <label for="email_id-field" class="form-label">Email ID</label><span class="text-danger" id="err_issue_email">*</span>
                                                        <input type="text" id="email_id-field" name="email_id-field" class="form-control" placeholder="Enter email" required />

                                                    </div>


                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-lg-6 mt-1">
                                                        <label class="form-label" for="password-input">Password</label>
                                                        <span class="text-danger" id="err_issue_pass">*</span>
                                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" aria-describedby="password" id="password-field" name="password-field" required>
                                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 mt-1">
                                                        <label class="form-label" for="password-input">Confirm password</label>
                                                        <span class="text-danger" id="err_issue_cpass">*</span>
                                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" aria-describedby="password" id="cpassword-field" name="password-field" required>
                                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon conpwd" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer mt-3 d-flex justify-content-center">

                                                <button type="submit" class="btn btn-success w-100" id="signup-btn">Register</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>



        <!-- footer -->
        <footer class="footer ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Design & Developed By Quantum IT Solution<i class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- </div> -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/libs/feather-icons/feather.min.js"></script>
    <script src="../assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="../assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="../assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="../assets/js/pages/particles.app.js"></script>

<!-- <script src=""></script> -->
    <script src="../assets/javascript/jquery.js"></script>
    <script src="../assets/javascript/Apps.js"></script>
    <script src="../assets/js/pages/password-addon.init.js"></script>

    <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>