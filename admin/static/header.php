<?php
session_start();
require('../assets/server/chk_connection.php');
require('../assets/server/chk_lockscreen.php');
$chk_var = "";
if (!isset($_SESSION['name'])) {
    header('location:../index.php');
}

?>
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-md-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="">
                            <span class="mdi mdi-magnify search-widget-icon"></span>
                            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                            <div data-simplebar style="max-height: 320px;">

                                <!-- item-->
                                <div class="dropdown-header mt-2">
                                    <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                                </div>

                                <!-- item-->
                                <a href="index.php" class="dropdown-item notify-item">
                                    <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                    <span>My Dashboard</span>
                                </a>

                                <!-- item-->
                                <a href="profile.php" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-circle align-middle fs-18 text-muted me-2"></i>
                                    <span>Profile</span>
                                </a>

                                <!-- item-->
                                <a href="edit-profile.php" class="dropdown-item notify-item">
                                    <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                    <span>My account settings</span>
                                </a>

                                <!-- item-->
                                <!-- <div class="dropdown-header mt-2">
                                    <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                                </div>

                                <div class="notification-list">
                                    <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                        <div class="d-flex">
                                            <img src="../assets/images/users/avatar-2.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="m-0">Angela Bernier</h6>
                                                <span class="fs-11 mb-0 text-muted">Manager</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                        <div class="d-flex">
                                            <img src="../assets/images/users/avatar-3.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="m-0">David Grasso</h6>
                                                <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                        <div class="d-flex">
                                            <img src="../assets/images/users/avatar-5.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="m-0">Mike Bunch</h6>
                                                <span class="fs-11 mb-0 text-muted">React Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </div> -->
                            </div>

                            <!-- <div class="text-center pt-3 pb-1">
                                <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results
                                    <i class="ri-arrow-right-line ms-1"></i></a>
                            </div> -->
                        </div>
                    </form>
                </div>


                <div class="d-flex align-items-center">

                    <div class="dropdown d-md-none topbar-head-dropdown header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-search fs-22"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                            <i class='bx bx-fullscreen fs-22'></i>
                        </button>
                    </div>
                    <!-- <div role="alert" style="z-index:9;position: absolute;margin-top:2rem;display:none"
                        id="myspecialalert">

                    </div> -->

                    <button type="button" id="borderedToast1Btn" hidden></button>
                    <div role="alert" style="z-index: 9;position: absolute;margin-left:-5rem;margin-top:5rem;">
                        <div id="borderedToast1" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2" id="addicontoast">

                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0" id="message"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">

                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-bell fs-22'></i>
                            <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger" id="cnt_notification"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                            <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                        </div>

                                    </div>
                                </div>

                                <div class="px-2 pt-2">
                                    <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                                                All
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-content position-relative" id="notificationItemsTabContent">
                                <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                    <div data-simplebar style="max-height: 300px;" class="pe-2">
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="dropdown-notifications-list scrollable-container">
                                                <div class="d-flex">

                                                    <ul class="list-group list-group-flush" id="notification_suggestion">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row my-3 mx-3 text-center view-all ">
                                        <button type="button" class="btn btn-soft-success waves-effect waves-light" id="mark_all_read_suggestion">Mark All As Read<i class="ri-arrow-right-line align-middle"></i></button>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!-- photo on the header side -->
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" id="h_profile" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text" id="h_name"></span>
                                        <span
                                            class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text" id="h_type"></span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome </h6>
                                <a class="dropdown-item" href="profile.php"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                                <a class="dropdown-item" href="chat_user.php"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Messages</span></a>
                                <a class="dropdown-item" href="apps-tasks-kanban.php"><i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Taskboard</span></a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="edit-profile.php"><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>

                                <a class="dropdown-item" href="#" id="logout"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <button type="button" id="borderedToast1" data-toast data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" class="btn btn-light w-xs " hidden>Default</button>

    <div id="loader"></div>