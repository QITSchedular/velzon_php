<?php
$page = "dashboard";
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Admin | index page</title>
    <?php require 'static/head.php'; ?>
</head>

<body>
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>


    <div class="row mb-3 pb-1">
        <div class="col-12 " >  
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="flex-grow-1 ">
                    <h4 class="fs-16 mb-1 a placeholder"><span class="a placeholder" id="i_message"></span> , <span  class="a placeholder" id="i_name"></span>!</h4>
                </div>
                <div class="mt-3 mt-lg-0 a placeholder" id="box1">
                    
                    <form action="javascript:void(0);">
                        <div class="row g-3 mb-0 align-items-center ">
                            <div class="col-sm-auto">
                                <div class="input-group d-flex ">
                                    <div >
                                        <img id="wicon" src="" class="me-2 a placeholder" width="25rem">
                                    </div>

                                    <div class="text-dark fs-4  fw-bold a placeholder" id="temperature">

                                    </div>
                                </div>
                                <small class="weatherCondition text-mute a placeholder"></small>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div><!-- end card header -->
        </div>
        <!--end col-->
    </div>


    <div class="row project-wrapper">
        <div class="col-xxl-8">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                        <i data-feather="briefcase" class="text-primary"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Active
                                        Projects</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0 ">
                                            <span class="counter-value cnt-value" data-target="100000">0</span>
                                        </h4>
                                        <span class="badge badge-soft-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Projects this month</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                        <i data-feather="award" class="text-warning"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted mb-3">New Leads</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="7522">0</span></h4>
                                        <span class="badge badge-soft-success fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58
                                            %</span>
                                    </div>
                                    <p class="text-muted mb-0">Leads this month</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info text-info rounded-2 fs-2">
                                        <i data-feather="clock" class="text-info"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total
                                        Hours</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="150" id="total_hour">0</span>h <span class="counter-value" data-target="40" id="total_min">0</span>m</h4>
                                        <span class="badge badge-soft-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Work this month</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end col -->
    </div><!-- end row -->


    <div class="row">
        <div class="col-xxl-4 col-lg-6">
            <div class="card" style="height: 310px;">
                <div class="card-header d-flex align-items-center">
                    <h6 class="card-title flex-grow-1 mb-0">Up Coming Events..</h6>
                </div>
                <div id='load_event'>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Birthday</h5>
                </div>
                <div class="card-body">
                    <div class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="bd_div">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-xxl-8 col-lg-6 d-flex"> -->
            <div class="col-xxl-3 col-lg-2 ">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Project`s Status</h4>
                    </div><!-- end card header -->
                    <div class="card-body pt-0 pb-0">
                        <div id="dashboard_pie_charts" data-colors='["--vz-secondary","--vz-warning", "--vz-primary","--vz-danger","--vz-success","--vz-gray"]' class="" dir="ltr"></div>

                        <table class="table table-borderless table-sm table-centered align-middle table-nowrap mb-0">
                            <tbody class="border-0">
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-secondary me-2"></i>Started
                                        </h4>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-secondary fw-medium fs-12 mb-0" id="star"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-warning me-2"></i>On Hold
                                        </h4>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-warning fw-medium fs-12 mb-0" id="hold">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-primary me-2"></i>In
                                            Progress</h4>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-primary fw-medium fs-12 mb-0" id="prog">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-danger me-2"></i>Cancelles
                                        </h4>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-danger fw-medium fs-12 mb-0" id="can">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-success me-2"></i>Completed
                                        </h4>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-success fw-medium fs-12 mb-0" id="comp">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-gray me-2"></i>Deffered</h4>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-gray fw-medium fs-12 mb-0" id="deff">
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xxl-5 col-lg-4 ">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Project Lead</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Last 30 Days<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Yesterday</a>
                                    <a class="dropdown-item" href="#">Last 7 Days</a>
                                    <a class="dropdown-item" href="#">Last 30 Days</a>
                                    <a class="dropdown-item" href="#">This Month</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-nowrap align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Member</th>
                                        <th scope="col">Hours</th>
                                        <th scope="col">Tasks</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-flex">
                                            <img src="../assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Donald Risher</h5>
                                                <p class="fs-12 mb-0 text-muted">Product Manager</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">110h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            258
                                        </td>

                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="../assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Jansh Brown</h5>
                                                <p class="fs-12 mb-0 text-muted">Lead Developer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">83h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            105
                                        </td>

                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="../assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Carroll Adams</h5>
                                                <p class="fs-12 mb-0 text-muted">Lead Designer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">58h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            75
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_3" data-colors='["--vz-primary"]' data-chart-series="75" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="../assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">William Pinto</h5>
                                                <p class="fs-12 mb-0 text-muted">UI/UX Designer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">96h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            85
                                        </td>

                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="../assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Garry Fournier</h5>
                                                <p class="fs-12 mb-0 text-muted">Web Designer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">76h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            69
                                        </td>

                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="../assets/images/users/avatar-5.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Susan Denton</h5>
                                                <p class="fs-12 mb-0 text-muted">Lead Designer</p>
                                            </div>
                                        </td>

                                        <td>
                                            <h6 class="mb-0">123h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            658
                                        </td>

                                    </tr><!-- end tr -->
                                    
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->

            </div><!-- end col -->
        <!-- </div> -->

    </div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title flex-grow-1 mb-0">Active Projects</h4>
                <div class="flex-shrink-0">
                    <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Export Report</a>
                </div>
            </div>
            <div class="card-body">
                <div id="table-gridjs2"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addManagerToProject" tabindex="-1" aria-labelledby="inviteMembersModalProj" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="inviteMembersModalLabel">Add Leader</h5>
                    <button type="button" class="btn-close cancelLeaderModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 ">
                    <div class="d-flex row">
                        <div class="search-box mb-3 col-7">
                            <input type="text" class="form-control bg-light border-light" id="live_search_proj" placeholder="Search by name...">
                            <i class="ri-search-line search-icon m-auto ms-2"></i>
                        </div>
                        <div class="col-5 ">
                            <select class="col-lg-3 col-md-3 form-select bg-light" id="load_depart_proj">
                                <option value="All">Department</option>
                            </select>
                        </div>
                    </div>

                    <div class="mx-n4 px-4" data-simplebar style="max-height: 225px;">
                        <div class="vstack gap-3" id="ManagerData">

                            <!-- end member item -->

                            <!-- end list -->
                        </div>
                    </div>

                </div>
                <!-- end modal-content -->
            </div>
            <!-- modal-dialog -->
        </div>
        <!-- end modal -->

    </div>
    <?php require 'static/footer.php'; ?>


    <script src="../assets/js/pages/dashboard-nft.init.js"></script>
    <script src="../assets/libs/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/js/pages/analytic-charts.init.js"></script>

    <script>
        $(document).ready(function() {
            $("#toast").toast({
                delay: 3000
            });
            $("#toast").toast("show");
        });
    </script>
</body>

</html>