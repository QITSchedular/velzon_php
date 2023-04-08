<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="../../assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="../../assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <link href="../../assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="signin-page-wrapper pt-5 mt-5">
        <!-- Signin page bg -->
        <div class="bg-position bg" id="auth-particles">

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- Signin page content -->
        <div class="signin-page-content mt-5 ">
            <div class="container mt-5">
                <div class="row mt-5">

                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8 col-lg-6 mt-3 col-xl-5">
                            <div class="card mt-5">

                                <div class="card-body p-4">
                                    <div class="text-center mt-1">
                                        <img src="../assets/images/Qit.jpg" alt="" height="60">

                                        <h5 class="text-primary mt-3">Welcome Back !</h5>
                                    </div>
                                    <div class="p-2 mt-3">
                                    <form>


                                        <div class="mb-3">
                                            <label class="form-label" for="confirm-password-input">Enter
                                                Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="lock_password" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="confirm-password-input"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" id="lockscreen_load" type="submit">ENTER</button>
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
        <!-- end Signin page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                document.write(new Date().getFullYear())
                                </script> Design & Developed By Quantum IT Solution<i
                                    class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- password-addon init -->
    <script src="../assets/js/pages/password-addon.init.js"></script>

    <script src="../assets/javascript/jquery.js"></script>
    <script src="../assets/javascript/main.js"></script>

    <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function(){
            // lock screen
            $("#lockscreen_load").on("click", function () {
            // e.preventDefault();
            // alert();
            pass = $("#lock_password").val();
            $.ajax({
              url: "../assets/server/ajax.php",
              method: "POST",
              data: { "flag": "lockscreen_load","pass" : pass },
              success: function (val) {
                if(val=="valid"){
                    location.reload(true);
                }else{
                    location.reload(true);
                }
              },
            });
        });
        })
        
    </script>
</body>


</html>