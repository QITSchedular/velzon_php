<?php
$page = "Profile";
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Admin | profile page</title>

    <?php require 'static/head.php'; ?>
</head>

<body>
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>
    <!-- <div id="loader"></div> -->
    <div class="main">
        <div class="profile-foreground position-relative mx-n4 mt-n4">
            <div class="profile-wid-bg">
                <img class="profile-wid-img" id="loadbginprofile" />
            </div>
        </div>

        <div class="pt-2 mb-2 mb-lg-2 pb-lg-3 mt-2">
            <div class="row g-4">
                <div class="col-auto">
                    <div class="avatar-xl">
                        <img id="pictureInProfileHeading" class="img-thumbnail rounded-circle h-100 w-100" />
                    </div>
                </div><br>
                <!--end col-->
                <div class="col">
                    <div class="p-2">
                        <h3 class="text-white mb-1" id="unameProfileHeading"></h3>
                        <p class="text-white-75" id="user_role_profile"></p>
                        <div class="hstack text-white-50 gap-1">
                            <div class="me-2" id="locationProfile"><i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i></div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end row-->
        </div>

        <div class="row">
            <div class="col-lg-12 pb-3">
                <div class="d-flex">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Overview</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Documents</span>
                            </a>
                        </li>
                    </ul>
                    <div class="flex-shrink-0">
                        <a href="edit-profile.php" class="btn btn-success" id="editProfileBtn"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content pt-3 text-muted">
            <div class="tab-pane active" id="overview-tab" role="tabpanel">
                <div class="row">
                    <div class="col-xxl-3 pt-1">
                        <!--Progressbar -->
                        <div class="card h-35  ">
                            <div class="card-body">
                                <h5 class="card-title mb-5">Complete Your Profile</h5>
                                <div class="progress animated-progress custom-progress progress-label " >
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="progressbar" role="progressbar"  aria-valuemin="0" aria-valuemax="100">
                                        <div class="label" id="progresslabel"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end Progressbar -->

                        <!-- Portfolio -->
                        <div class="card h-35">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Portfolio</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    <div>
                                        <a  class="avatar-xs d-block" id="githubprofile" target="blank">
                                            <span class="avatar-title rounded-circle fs-16 bg-dark text-light">
                                                <i class="ri-github-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a  class="avatar-xs d-block" id="facebookprofile" target="blank">
                                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                <i class="ri-facebook-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a class="avatar-xs d-block" id="linkedinprofile" target="blank">
                                            <span class="avatar-title rounded-circle fs-16 bg-success">
                                                <i class="ri-linkedin-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a  class="avatar-xs d-block" id="instaprofile" target="blank">
                                            <span class="avatar-title rounded-circle fs-16 bg-danger">
                                                <i class="ri-instagram-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                        <!--end Portfolio -->

                        <!-- Skills -->
                        <div class="card h-25 ">
                            <div class="card-body overflow-auto">
                                <h5 class="card-title mb-2">Skills</h5>
                                <div class="d-flex flex-wrap gap-2 fs-15" id="skillsProfile">
                                    
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                        <!--end Skills -->


                    </div>

                    <div class="col-xxl-5 pt-1">
                        <div class="card h-100">
                            <div class="card-body overflow-auto pt-4  ">
                                <h5 class="card-title mb-2">Info</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <th class="ps-0" scope="row">Full Name :</th>
                                                <td class="text-muted" id="fullname"></td>

                                            </tr>
                                            <tr>
                                                <th class="ps-0" scope="row">Mobile :</th>
                                                <td class="text-muted" id="phonenumberprofile"></td> 

                                            </tr>

                                            <tr>
                                                <th class="ps-0" scope="row">E-mail :</th>
                                                <td class="text-muted" id="emailprofile"></td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0" scope="row">Location :</th>
                                                <td class="text-muted" id="locationprofile">
                                                </td>
                                            </tr>

                                            <tr>
                                                <th class="ps-0" scope="row">Role :</th>
                                                <td class="text-muted" id="roleprofile"></td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0" scope="row">Joining Date :</th>
                                                <td class="text-muted" id="joindateprofile"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end card body -->

                        </div><!-- end card -->

                    </div>

                    <div class="col-xxl-4 pt-1">
                        <div class="card h-100 ">
                            <div class="card-body pt-4 pb-3 ">
                                <h5 class="card-title mb-3">About</h5>
                                <p id="aboutProfile" ></p>
                            </div>

                        </div><!-- end card -->

                    </div>
                </div>
            </div>
        </div>



        <div class="tab-content text-muted ">
            <div class="tab-pane fade" id="documents" role="tabpanel">
                <div class="card ">
                    <div class="card-body ">
                        <div class="d-flex align-items-center mb-4">
                            <h5 class="card-title flex-grow-1 mb-0">
                                Documents
                            </h5>
                            <div class="flex-shrink-0">
                                <input class="form-control d-none" type="file" id="formFile" />
                                <label for="formFile" class="btn btn-danger"><i class="ri-upload-2-fill me-1 align-bottom"></i>
                                    Upload File</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle ">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">File Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Upload Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                                <i class="ri-file-pdf-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0">
                                                                <a href="javascript:void(0);">Bank Management System</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>PDF File</td>
                                                <td>8.89 MB</td>
                                                <td>24 Nov 2021</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="ri-equalizer-fill"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3">
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="text-center mt-3">
                                    <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-loading mdi-spin fs-20 align-middle"></i>
                                        Load more
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <?php require 'static/footer.php'; ?>

</body>

</html>