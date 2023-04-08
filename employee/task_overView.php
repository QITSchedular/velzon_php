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
    <!-- <div class="row">
        <div class="card">
            <div class="card-body">
               
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div>
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#profile-1" role="tab">
                                Time Entries (<span id="total_time"></span>)
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                Attachments File (<span id="total_file"></span>)
                            </a>
                        </li>
                    </ul>

                    <!--end nav-->
                </div>
                <form method='post'>
                    <input type="file" class="btn btn-soft-info btn-sm upload_file" id='task_multiple_files'
                        name="file[]" multiple hidden>
                </form>
                <div class="float-end" style="margin-top: -1rem;">
                    <button type="file" class="btn btn-soft-info btn-sm upload_btn fs-6"><i class="ri-upload-2-fill me-1 align-bottom"></i>Upload</button>

                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="profile-1" role="tabpanel">
                        <div class="d-flex flex-row-reverse w-100">
                            <div class=" mx-3">
                                <button class="btn btn-success btn-sm start fs-5" id=""><i class="ri-play-circle-line align-bottom me-1"></i>
                                    Start</button>
                                <!-- <button class="btn btn-warning btn-sm" id="stop"><i class="ri-pause-mini-line align-bottom me-1"></i> -->
                                <!-- Pause</button> -->
                                <button class="btn btn-danger btn-sm reset fs-5" id=""><i class="ri-stop-circle-line align-bottom me-1"></i>
                                    Stop</button>
                                <!-- <button type="button" class="btn btn-success btn-label waves-effect waves-light" id="start"><i class="ri-play-circle-line label-icon align-middle fs-16 me-2"></i> Start</button> -->
                            </div>
                            <div class="mx-3 my-2">
                                <h4 class="mb-1" id="timer">00 : 00 : 00</h4>
                            </div>
                            <div>
                                <span></span>
                            </div>
                            <div class="w-25">
                                <input type="text" class="form-control mb-2 " id="subTask_Title" placeholder="Sub Task Title...">
                            </div>

                        </div>
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
                                        <th scope="col-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="timeSheetData">

                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="submitTimesheet btn btn-secondary bg-gradient waves-effect waves-light float-end mt-4">Submit</button>
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
                                <tbody id="file_load">
                            
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
    </div>

    <div class="row ">
        <div class="col-xxl-3">
            <div class="card mb-3">
                <div class="card-body">
                    <!-- <div class="mb-4">
                        <select class="form-control" id="select_status" name="choices-single-default">
                            <option value="">Select Task board</option>
                            <option value="unassigned">Unassigned</option>
                            <option value="todo">To Do</option>
                            <option value="inprogress">Inprogress</option>
                            <option value="reviews">In Reviews</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div> -->
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

            <!--end card-->
            <!-- </div> -->
            <div class="row">
                <div class="col-xxl-7">
                    <div class="card" style="height:16.5rem">
                        <div class="card-body">
                            <div class="text-muted">
                                <h6 class="mb-3 fw-semibold">Task Description</h6>
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


    <!-- remove file task Modal -->
    <div id="delTaskFileModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                            <p class="text-muted mx-4 mb-0">You will not be able to recover this data!</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal" id="removeTaskFileclose">Close</button>
                        <button type="button" class="btn w-sm btn-danger removeTaskFile" id="">Yes, Delete It!</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



        
    <!-- Toggle Between Modals -->
    <button type="button" id="warning_btn" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#firstmodal" hidden>Open First Modal</button>
    <!-- First modal dialog -->
    <div class="modal fade" id="firstmodal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-3">
                    <lord-icon
                        src="https://cdn.lordicon.com/tdrtiskw.json"
                        trigger="loop"
                        colors="primary:#f7b84b,secondary:#405189"
                        style="width:130px;height:130px">
                    </lord-icon>
                    <div class="mt-3 pt-3">
                        <h4>Warning..!!</h4>
                        <p id="show_message_dialog"></p>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require 'static/footer.php'; ?>
    <script src="../assets/javascript/timesheet.js"></script>
</body>

</html>