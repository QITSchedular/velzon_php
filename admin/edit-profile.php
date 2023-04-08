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

    <div class="main">
        <form id="editProfileData">
            <div class="position-relative mx-n4 mt-n4 abcfd">
                <div class="profile-wid-bg profile-setting-img">
                    <img src="" class="profile-wid-img" id="bgimgload">
                    <div class="overlay-content">
                        <div class="text-end p-3">
                            <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                <form id="bgForm" >
                                    <input id="profile-foreground-img-file-input" type="file" name="cover_bgbtn" class="profile-foreground-img-file-input cover_bgbtn">
                                </form>
                                <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-3">
                    <!-- user profile picture -->
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <img src="../assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <form id="myFormimg" >
                                            <input id="profile-img-file-input" type="file" name="profileimg" class="profile-img-file-input profileimg">
                                        </form>
                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                <i class="ri-camera-fill"></i>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <h5 class="fs-16 mb-1" id="uname"></h5>
                                <p class="text-muted mb-0" id="userrole"></p>
                            </div>
                        </div>
                    </div>
                    <!--end user profile picture -->

                    <!-- profile progressbar -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-5">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Complete Your Profile</h5>
                                </div>
                            </div>
                            <div class="progress animated-progress custom-progress progress-label">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"  id="editprogressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="label" id="editprogresslbl"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- profile progressbar -->

                    <!-- portfolio -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Portfolio</h5>
                                </div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-dark text-light">
                                        <i class="ri-github-fill"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="gitUseridUrl" name="gitUseridUrl" placeholder="Enter Your Github URL">
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-primary">
                                        <i class="ri-facebook-fill"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="facebookidUrl" name="facebookidUrl" placeholder="Enter Your Facebook URL">
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-success">
                                        <i class="ri-linkedin-fill"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="linkedinidUrl" name="linkedinidUrl" placeholder="Enter Your Linkedin URL">
                            </div>
                            <div class="d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                    <span class="avatar-title rounded-circle fs-16 bg-danger">
                                        <i class="ri-instagram-fill"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="instaidUrl" name="instaidUrl" placeholder="Enter Your Instagram URL">
                            </div>
                        </div>
                    </div>
                    <!--end portfolio -->
                </div>
                <!--user info -->
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fas fa-home"></i> Personal Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                        <i class="far fa-user"></i> Change Password
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                                        <i class="far fa-envelope"></i> Privacy Policy
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <form action="javascript:void(0);">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="firstnameProfileInput" name="firstnameProfileInput" placeholder="Enter your firstname">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="lastnameInput" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="lastnameProfileInput" name="lastnameProfileInput" placeholder="Enter your lastname">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" id="phonenumberProfileInput" name="phonenumberProfileInput" placeholder="Enter your phone number">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" id="emailProfileInput" name="emailProfileInput" placeholder="Enter your email">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="JoiningdatInput" class="form-label">Joining Date</label>
                                                    <input type="date" class="form-control" data-provider="flatpickr" id="JoiningdatProfileInput" name="JoiningdatProfileInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <div class="col-md-6 mb-4 light-style layout-navbar-fixed layout-menu-fixed ">
                                                        <label for="select2Primary" class="form-label">Skills</label>
                                                        <div class="select2-info">
                                                            <select id="select2Primary" name="skillsProfile" class="select2 form-select" multiple>
                                                                <option value="illustrator">Illustrator</option>
                                                                <option value="photoshop">Photoshop</option>
                                                                <option value="css">CSS</option>
                                                                <option value="html">HTML</option>
                                                                <option value="javascript">Javascript</option>
                                                                <option value="python">Python</option>
                                                                <option value="php">PHP</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="cityInput" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="cityProfileInput" name="cityProfileInput" placeholder="City" />
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="countryInput" class="form-label">Country</label>
                                                    <input type="text" class="form-control" id="countryProfileInput" name="countryProfileInput" placeholder="Country" />
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="zipcodeInput" class="form-label">Zip Code</label>
                                                    <input type="text" class="form-control" minlength="5" maxlength="6" id="zipcodeProfileInput" name="zipcodeProfileInput" placeholder="Enter zipcode">
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-lg-12">
                                                <div class="mb-3 pb-2">
                                                    <label for="exampleFormControlTextarea" class="form-label">Description</label>
                                                    <textarea class="form-control" id="descriptionProfileInput" name="descriptionProfileInput" placeholder="Enter your description" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary" id="updateProfileData">Updates</button>
                                                    <button type="button" class="btn btn-soft-success">Cancel</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane" id="changePassword" role="tabpanel">
                                    <form action="javascript:void(0);">
                                        <div class="row g-2">
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                    <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="newpasswordInput" class="form-label">New Password*</label>
                                                    <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                    <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-success">Change Password</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                    <div class="mt-4 mb-3 border-bottom pb-2">
                                        <div class="float-end">
                                            <a href="javascript:void(0);" class="link-primary">All Logout</a>
                                        </div>
                                        <h5 class="card-title">Login History</h5>
                                    </div>

                                </div>
                                <!--end tab-pane-->


                                <div class="tab-pane" id="privacy" role="tabpanel">
                                    <div class="mb-4 pb-2">
                                        <h5 class="card-title text-decoration-underline mb-3">Security:</h5>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Two-factor Authentication</h6>
                                                <p class="text-muted">Two-factor authentication is an enhanced security meansur. Once enabled, you'll be required to give two types of identification when you log into Google Authentication and SMS are Supported.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Enable Two-facor Authentication</a>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Secondary Verification</h6>
                                                <p class="text-muted">The first factor is a password and the second commonly includes a text with a code sent to your smartphone, or biometrics using your fingerprint, face, or retina.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Set up secondary method</a>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                            <div class="flex-grow-1">
                                                <h6 class="fs-14 mb-1">Backup Codes</h6>
                                                <p class="text-muted mb-sm-0">A backup code is automatically generated for you when you turn on two-factor authentication through your iOS or Android Twitter app. You can also generate a backup code on twitter.com.</p>
                                            </div>
                                            <div class="flex-shrink-0 ms-sm-3">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Generate backup codes</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="card-title text-decoration-underline mb-3">Application Notifications:</h5>
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex">
                                                <div class="flex-grow-1">
                                                    <label for="directMessage" class="form-check-label fs-14">Direct messages</label>
                                                    <p class="text-muted">Messages from people you follow</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="directMessage" checked />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="desktopNotification">
                                                        Show desktop notifications
                                                    </label>
                                                    <p class="text-muted">Choose the option you want as your default setting. Block a site: Next to "Not allowed to send notifications," click Add.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="desktopNotification" checked />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="emailNotification">
                                                        Show email notifications
                                                    </label>
                                                    <p class="text-muted"> Under Settings, choose Notifications. Under Select an account, choose the account to enable notifications for. </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="emailNotification" />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="chatNotification">
                                                        Show chat notifications
                                                    </label>
                                                    <p class="text-muted">To prevent duplicate mobile notifications from the Gmail and Chat apps, in settings, turn off Chat notifications.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="chatNotification" />
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mt-2">
                                                <div class="flex-grow-1">
                                                    <label class="form-check-label fs-14" for="purchaesNotification">
                                                        Show purchase notifications
                                                    </label>
                                                    <p class="text-muted">Get real-time purchase alerts to protect yourself from fraudulent charges.</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="purchaesNotification" />
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5 class="card-title text-decoration-underline mb-3">Delete This Account:</h5>
                                        <p class="text-muted">Go to the Data & Privacy section of your profile Account. Scroll to "Your data & privacy options." Delete your Profile Account. Follow the instructions to delete your account :</p>
                                        <div>
                                            <input type="password" class="form-control" id="passwordInput" placeholder="Enter your password" style="max-width: 265px;">
                                        </div>
                                        <div class="hstack gap-2 mt-3">
                                            <a href="javascript:void(0);" class="btn btn-soft-danger">Close & Delete This Account</a>
                                            <a href="javascript:void(0);" class="btn btn-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end user info -->


            </div>
        </form>
    </div>
    <?php require 'static/footer.php'; ?>

</body>

</html>