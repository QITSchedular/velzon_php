<?php
$page = "myTask";
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Manager | My Task page</title>
    <?php require 'static/head.php'; ?>
    <link rel="stylesheet" href="../assets/libs/dragula/dragula.min.css" />
    <style>
        .tasks::-webkit-scrollbar {
            display: none;
        }

        .fixTableHead {
            overflow-y: auto;
            height: 17.4rem;
        }

        .fixTableHead thead th {
            position: sticky;
            top: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px 15px;
        }

        th {
            background: #ABDD93;
        }

        .scroll::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body>
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Projects</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="myTask">My Task</a></li>
                        <li class="breadcrumb-item active">Task Overview</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row ">
        <div class="col-xxl-3">
            <!-- <div class="col-xxl-12"> -->
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="card-title mb-3 flex-grow-1 text-start">Time Tracking</h6>
                    <div class="mb-2">
                        <img src="../assets/GIF/clock.gif" alt="" style="width:120px;height:120px">
                        <!-- <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="loop" colors="primary:#405189,secondary:#02a8b5" style="width:90px;height:90px"></lord-icon> -->
                    </div>
                    <h3 class="mb-1" id="timer">00 : 00 : 00</h3>
                    <!-- <h5 class="fs-14 mb-4">00</h5> -->
                    <div class="hstack gap-2 justify-content-center mt-4">
                        <button class="btn btn-success btn-sm" id="start"><i class="ri-play-circle-line align-bottom me-1"></i>
                            Start</button>
                        <button class="btn btn-warning btn-sm" id="stop"><i class="ri-pause-mini-line align-bottom me-1"></i>
                            Pause</button>
                        <button class="btn btn-danger btn-sm" id="reset"><i class="ri-stop-circle-line align-bottom me-1"></i>
                            Stop</button>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <!-- <div class="col-xxl-12"> -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="mb-4">
                        <select class="form-control" id="select_status" name="choices-single-default">
                            <option value="">Select Task board</option>
                            <option value="unassigned">Unassigned</option>
                            <option value="todo">To Do</option>
                            <option value="inprogress">Inprogress</option>
                            <option value="reviews">In Reviews</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="table-card">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-medium">Tasks No</td>
                                    <td id="task_no"></td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Tasks Title</td>
                                    <td id="task_title"></td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Project Name</td>
                                    <td id="project_name"></td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Priority</td>
                                    <td><span class="" id="priority"></span></td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Status</td>
                                    <td><span class="" id="status12"></span></td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Due Date</td>
                                    <td id="due_date"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!--end table-->
                    </div>
                </div>
            </div>
            <!--end card-->
            <!-- </div> -->
        </div>

        <div class="col-xxl-9">
            <!-- <div class="col-xxl-12" style="height:21.5rem;"> -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#profile-1" role="tab">
                                    Time Entries (9 hrs 13 min)
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                    Attachments File (4)
                                </a>
                            </li>

                        </ul>
                        <!--end nav-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">

                        <div class="tab-pane active" id="profile-1" role="tabpanel">
                            <div class="table-responsive fixTableHead " data-simplebar data-simplebar-track="dark">

                                <table class="table align-middle mb-0 text-center" class="accordion custom-accordionwithicon">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col-2">Tasks Title</th>
                                            <th scope="col-2">Date</th>
                                            <th scope="col-2">Duration</th>
                                            <th scope="col-2">Status</th>
                                            <th scope="col-2">Description</th>
                                            <th scope="col-2">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="timeSheetData">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--edn tab-pane-->
                        <div class="tab-pane " id="messages-1" role="tabpanel">
                            <div class="table-responsive table-card fixTableHead" style="height:17.3rem;" data-simplebar data-simplebar-track="dark">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light text-muted">
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
                                                        <div class="avatar-title bg-soft-primary text-primary rounded fs-20">
                                                            <i class="ri-file-zip-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0)">App
                                                                pages.zip</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Zip File</td>
                                            <td>2.22 MB</td>
                                            <td>21 Dec, 2021</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="ri-equalizer-fill"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink1" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                            <i class="ri-file-pdf-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Velzon
                                                                admin.ppt</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>PPT File</td>
                                            <td>2.24 MB</td>
                                            <td>25 Dec, 2021</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="ri-equalizer-fill"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-soft-info text-info rounded fs-20">
                                                            <i class="ri-folder-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Images.zip</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>ZIP File</td>
                                            <td>1.02 MB</td>
                                            <td>28 Dec, 2021</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="ri-equalizer-fill"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-soft-danger text-danger rounded fs-20">
                                                            <i class="ri-image-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-3 flex-grow-1">
                                                        <h6 class="fs-15 mb-0"><a href="javascript:void(0);">Bg-pattern.png</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>PNG File</td>
                                            <td>879 KB</td>
                                            <td>02 Nov 2021</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink4" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="ri-equalizer-fill"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink4" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>
                        </div>
                        <!--end tab-pane-->


                    </div>
                    <!--end tab-content-->
                </div>
            </div>
            <!--end card-->
            <!-- </div> -->
            <div class="row">
                <div class="col-xxl-7">
                    <div class="card" style="height:16.5rem">
                        <div class="card-body">
                            <div class="text-muted">
                                <h6 class="mb-3 fw-semibold text-uppercase">Summary</h6>
                                <div class='overflow-auto' style="height:12.5rem;" data-simplebar data-simplebar-track="dark">

                                    <p id="summary_txt"></p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-xxl-5">
                    <div class="card mb-3">
                        <div class="card-body" style="height:16.5rem">
                            <div class="d-flex mb-3">
                                <h6 class="card-title mb-0 flex-grow-1">Assigned To</h6>
                                <!-- <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#inviteMembersModal"><i class="ri-share-line me-1 align-bottom"></i>
                                        Assigned Member</button>
                                </div> -->
                            </div>
                            <div class="overflow-auto" data-simplebar data-simplebar-track="dark" style="height:12.2rem;">


                                <ul class="list-unstyled gap-3 mb-0 " id="load_team_mate">

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
            </div>
        </div>
    </div>
    <!-- removeTimeSheetModal -->
    <div id="deleteTimeSheetModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="text" id="removeTimeSheet" hidden>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this TimeSheet ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal" id="remove-Employee-close">Close</button>
                        <button type="button" class="btn w-sm btn-danger remove-timeSheet" id="">Yes, Delete It!</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php require 'static/footer.php'; ?>
    <script src="../assets/javascript/timesheet.js"></script>
</body>

</html>