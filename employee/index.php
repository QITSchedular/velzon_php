<?php
$page = "dashboard";
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Admin | index page</title>
    <?php require 'static/head.php'; ?>
</head>

<body class="placeholder-glow">
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>


    <!-- start page title -->
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>
            </div>
        </div>
    </div> -->
    <!-- end page title -->

    <!-- start page title -->
    <!-- <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Projects</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboards</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div> -->
    <!-- end page title -->


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

    <div class="row project-wrapper" >
        <div class="col-xxl-8" >
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Completed Tasks
                                    </p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span id="total_comp_tasks" class="counter-value" data-target="825">0</span></h4>
                                        <span class=""  id="compare_comp_css"><i class=""  id="compare_comp_css1"></i><span  id="compare_comp_task">5.02</span>
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">completed tasks this month</p>
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
                                    <p class="text-uppercase fw-medium text-muted mb-3">Remaining Tasks</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span id="total_remain_tasks" class="counter-value" data-target="7522">0</span></h4>
                                        <span class="" id="compare_remain_css"><i class="" id="compare_remain_css1"></i><span id="compare_remain_task">3.58</span>
                                            %</span>
                                    </div>
                                    <p class="text-muted mb-0">remaining tasks this month</p>
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
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" id="load_hm_hour" data-target="168">0</span>h <span class="counter-value" id="load_hm_minute" data-target="40">0</span>m</h4>
                                        <span class="" id="compare_css"><i class="" id="compare_css1"></i><span id="load_hm_compare">10.35
                                            </span>%</span>
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

    <div class="row ">
        
        <div class="col-xxl-4 col-lg-6 ">
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
        <div class="col-xxl-3 col-lg-2">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 ">Timesheet`s Status</h4>
                </div><!-- end card header -->
                <div class="card-body pt-0 pb-0 ">
                    <div id="dashboard_pie_charts1" data-colors='["--vz-warning", "--vz-primary","--vz-success","--vz-danger"]' class="" dir="ltr">
                    </div>

                    <table class="table table-borderless table-sm table-centered align-middle table-nowrap mb-0">
                        <tbody class="border-0">
                            <tr>
                                <td>
                                    <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-warning me-2"></i>Saved
                                    </h4>
                                </td>
                                <td class="text-end">
                                    <p class="text-warning fw-medium fs-12 mb-0" id="Saved"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-primary me-2"></i>Submitted
                                    </h4>
                                </td>
                                <td class="text-end">
                                    <p class="text-primary fw-medium fs-12 mb-0" id="Submitted">
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-success me-2"></i>Approved</h4>
                                </td>
                                <td class="text-end">
                                    <p class="text-success fw-medium fs-12 mb-0" id="Approved">
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="text-truncate fs-14 fs-medium mb-0"><i class="ri-stop-fill align-middle fs-18 text-danger me-2"></i>Rejected
                                    </h4>
                                </td>
                                <td class="text-end">
                                    <p class="text-danger fw-medium fs-12 mb-0" id="Rejected">
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        <div class="col-xxl-5 col-lg-4">
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
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card card-height-100">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title flex-grow-1 mb-0">My tasks</h4>
                <div class="flex-shrink-0">
                    <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Export Report</a>
                </div>
            </div>
            <div class="card-body">
                <div id="table-gridjs4"></div>
            </div>
        </div>
    </div>
<!-- </div> -->
    <?php require 'static/footer.php'; ?>


</body>

</html>