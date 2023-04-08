<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <title>Admin | index page</title>
    <?php require 'static/head.php'; ?>
    <link rel="stylesheet" href="../assets/libs/dragula/dragula.min.css" />
    <style>
    .tasks::-webkit-scrollbar {
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
                <h4 class="mb-sm-0">Task Board</h4>

                <div class="page-title-right ">
                    <button class="btn btn-soft-info w-100" data-bs-toggle="modal"
                        data-bs-target="#creatertaskModal">Add Task</button>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="tasks-board  mb-3 pb-3" id="kanbanboard" style="max-height: 32.5rem;">
        <div class="tasks-list px-1 py-1">
            <div class="d-flex mb-3 p-2" style="background-color: #e1ebfd;">
                <div class="flex-grow-1">
                    <h6 class="fs-14 text-uppercase fw-semibold mb-0">Unassigned <small
                            class="badge bg-success float-end align-bottom ms-1 totaltask-badge unassigned"></small>
                    </h6>
                </div>
            </div>

            <div style="max-height:79%;" data-simplebar data-simplebar-track="dark">
                <div id="unassigned-task" class="overflow-auto tasks unassigned-task" style="max-height:400px;">

                </div>

            </div>
            <div class="my-3">
                <button class="btn btn-soft-dark w-100"></button>
            </div>
        </div>

        <!--end tasks-list-->
        <div class="tasks-list px-1 py-1">
            <div class="d-flex mb-3 p-2" style="background-color: #e2e5ed;">
                <div class="flex-grow-1">
                    <h6 class="fs-14 text-uppercase fw-semibold mb-0">To Do <small
                            class="badge bg-secondary float-end align-bottom ms-1 totaltask-badge todo"></small></h6>
                </div>
            </div>
            <div style="max-height:79%;" data-simplebar data-simplebar-track="dark">
                <div id="todo-task" class="overflow-auto tasks todo-task " style="max-height:400px;">

                </div>
            </div>
            <div class="my-3">
                <button class="btn btn-soft-dark w-100"></button>
            </div>
        </div>
        <!--end tasks-list-->
        <div class="tasks-list px-1 py-1">
            <div class="d-flex mb-3 p-2" style="background-color: #fde8e4;">
                <div class="flex-grow-1">
                    <h6 class="fs-14 text-uppercase fw-semibold mb-0">Inprogress <small
                            class="badge bg-warning float-end align-bottom ms-1 totaltask-badge inprogress"></small>
                    </h6>
                </div>
            </div>
            <div style="max-height:79%;" data-simplebar data-simplebar-track="dark">
                <div id="inprogress-task" class="overflow-auto tasks inprogress-task" style="max-height:400px;">

                </div>
            </div>
            <div class="my-3">
                <button class="btn btn-soft-dark w-100"></button>
            </div>
        </div>
        <!--end tasks-list-->
        <div class="tasks-list px-1 py-1">
            <div class="d-flex mb-3 p-2" style="background-color: #dededf;">
                <div class="flex-grow-1">
                    <h6 class="fs-14 text-uppercase fw-semibold mb-0">In Reviews <small
                            class="badge float-end bg-info align-bottom ms-1 totaltask-badge reviews"></small></h6>
                </div>
            </div>
            <div style="max-height:79%;" data-simplebar data-simplebar-track="dark">
                <div id="reviews-task" class="overflow-auto tasks reviews-task" style="max-height:400px;">

                </div>
            </div>
            <div class="my-3">
                <button class="btn btn-soft-dark w-100"></button>
            </div>
        </div>
        <!--end tasks-list-->
        <div class="tasks-list px-1 py-1">
            <div class="d-flex mb-3 p-2" style="background-color: #daf4f0;">
                <div class="flex-grow-1">
                    <h6 class="fs-14 text-uppercase fw-semibold mb-0">Completed <small
                            class="badge bg-success float-end align-bottom ms-1 totaltask-badge completed"></small></h6>
                </div>
            </div>
            <div style="max-height:79%;" data-simplebar data-simplebar-track="dark">
                <div id="completed-task" class="overflow-auto tasks completed-task" style="max-height:400px;">

                </div>
            </div>
            <div class="my-3">
                <button class="btn btn-soft-dark w-100"></button>
            </div>
        </div>
        <!--end tasks-list-->

    </div>
    <!--end task-board-->

    <div class="modal fade" id="addmemberModal" tabindex="-1" aria-labelledby="addmemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-warning">
                    <h5 class="modal-title" id="addmemberModalLabel">Add Member</h5>
                    <button type="button" class="btn-close" id="btn-close-member" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label for="submissionidInput" class="form-label">Submission ID</label>
                                <input type="number" class="form-control" id="submissionidInput"
                                    placeholder="Submission ID">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="profileimgInput" class="form-label">Profile Images</label>
                                <input class="form-control" type="file" id="profileimgInput">
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="firstnameInput" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstnameInput"
                                    placeholder="Enter firstname">
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="lastnameInput" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastnameInput" placeholder="Enter lastname">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="designationInput" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="designationInput" placeholder="Designation">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="titleInput" class="form-label">Title</label>
                                <input type="text" class="form-control" id="titleInput" placeholder="Title">
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="numberInput" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="numberInput" placeholder="Phone number">
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="joiningdateInput" class="form-label">Joining Date</label>
                                <input type="text" class="form-control" id="joiningdateInput" data-provider="flatpickr"
                                    placeholder="Select date">
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="emailInput" class="form-label">Email ID</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="Email">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><i
                            class="ri-close-line align-bottom me-1"></i> Close</button>
                    <button type="button" class="btn btn-success" id="addMember">Add Member</button>
                </div>
            </div>
        </div>
    </div>
    <!--end add member modal-->


    <div class="modal fade" data-bs-backdrop='static' data-bs-keyboard='false' id="creatertaskModal" tabindex="-1"
        aria-labelledby="creatertaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="creatertaskModalLabel">Create New Task</h5>
                    <button type="button" class="btn-close" id="closeProjTask" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="frmtask">
                        <div class="row g-3">

                            <div class="col-lg-12">
                                <label for="projectName" class="form-label">Project Name</label>
                                <select class="form-select mb-3" id="pname" name="pname"
                                    aria-label="Default select example">
                                </select>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="sub-tasks" class="form-label">Task Title</label>
                                <input type="text" class="form-control" id="sub-tasks" name="TName"
                                    placeholder="Task title">
                                <input type="text" class="form-control" id="tid" name="tid" hidden>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <label for="task-description" class="form-label">Task Description</label>
                                <textarea class="form-control" id="task-description" name="Tdescription" rows="3"
                                    placeholder="Task description"></textarea>
                            </div>

                            <div class="col-md-12 light-style">
                                <label for="select2Primary" class="form-label">Select Employee</label>
                                <div class="select2-info">
                                    <select id="select2Primary" class="empLoad select2 form-control " name="empLoad"
                                        multiple>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="due-date" class="form-label">Start Date</label>
                                <input type="text" class="form-control" id="start-date" name="sdate"
                                    data-provider="flatpickr" placeholder="Select date">
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <label for="categories" class="form-label">Priority</label>
                                <select class="form-select mb-3" id="Priority" name="Priority"
                                    aria-label="Default select example">
                                    <option value="" selected disabled>Select Project Priority</option>
                                    <option value="Important">Important</option>
                                    <option value="Urgent">Urgent</option>
                                    <option value="Important and urgent">Important and urgent</option>
                                    <option value="Neither">Neither</option>
                                </select>
                            </div>

                            <!--end col-->
                            <div class="mt-4">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                                        id="closeProjTask">Close</button>
                                    <button type="submit" class="btn btn-success" id="insertProjTask">Add Task</button>
                                    <button type="submit" class="btn btn-success" id="updateProjTask">Update
                                        Task</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end add board modal-->

    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="delete-btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this tasks ?</p>
                            <input type="text" class="btn_delete" hidden>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete
                            It!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- Modal -->
<div class="modal fade" id="addEmpToProj" tabindex="-1" aria-labelledby="inviteMembersModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="inviteMembersModalLabel">Add Members</h5>
                    <button type="button" class="btn-close cancelEmpModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 ">
                    <div class="d-flex row">
                        <div class="search-box mb-3 col-7">
                            <input type="text" class="form-control bg-light border-light" id="live_search1"
                                placeholder="Search by name...">
                            <i class="ri-search-line search-icon m-auto ms-2"></i>
                        </div>
                        <div class="col-5 ">
                            <select class="col-lg-3 col-md-3 form-select bg-light" id="load_depart1">
                                <option value="All">Department</option>
                            </select>
                        </div>
                    </div>

                    <div class="mx-n4 px-4" data-simplebar style="max-height: 225px;">
                        <div class="vstack gap-3" id="employeeData">

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
    <!--end add board modal-->
    <!--end modal -->

    </div>
    <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    </div><!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>



    <script src="../assets/libs/dragula/dragula.min.js"></script>

    <!-- dom autoscroll -->
    <script src="../assets/libs/dom-autoscroller/dom-autoscroller.min.js"></script>

    <!--taks-kanban-->
    <script src="../assets/js/pages/tasks-kanban.init.js"></script>

    <!-- App js -->

    <?php require 'static/footer.php'; ?>
</body>

</html>