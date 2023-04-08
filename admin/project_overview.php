<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">


<head>
    <title>Admin | project overview</title>
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
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Project Overview</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="projectList.php">Projects</a></li>
                        <li class="breadcrumb-item active">Project Details</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-n4 mx-n4">
                <div class="bg-soft-warning">
                    <div class="card-body pb-0 px-4">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="row align-items-center g-3">
                                    <div class="col-md">
                                        <div>
                                            <h4 class="fw-bold" id="project_title"></h4>
                                            <div class="hstack gap-3 flex-wrap">

                                                <div>Create Date : <span class="fw-medium"
                                                        id="project_start_date"></span></div>
                                                <div class="vr"></div>
                                                <div>Due Date : <span class="fw-medium" id="project_end_date"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#project-overview"
                                    role="tab">
                                    Overview
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-documents"
                                    role="tab">
                                    Documents
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-team" role="tab">
                                    Team
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-task" role="tab">
                                    Task
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content text-muted">
                <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="card " style="height: 24rem;">
                                <div class="card-body">
                                    <div class="text-dark">
                                        <h6 class=" text-uppercase">Summary</h6>
                                        <div class="mb-0">
                                            <h5 id="summary" class=""></h5>
                                        </div>

                                        <div class="py-3 border-top border-top-dashed" style="margin-top: 12rem;">
                                            <div class="row">

                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium">CLIENT NAME :</p>
                                                        <h5 class="fs-15 mb-0" id="cliname"></h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium">Status :
                                                        </p>
                                                        <div id="pstatus"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->


                        </div>
                        <!-- ene col -->
                        <div class="col-xl-3 col-lg-4">

                            <!-- end card -->

                            <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h4 class="card-title mb-0 flex-grow-1">Members</h4>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#addEmpToProject" id="addMemberOverview">+ Add
                                            Member</button>
                                    </div>
                                </div>



                                <div class="card-body">
                                    <div data-simplebar style="height: 290px;" class="mx-n3 px-3">
                                        <div class="vstack gap-3" id="loadEmpDataOverview">

                                        </div>
                                        <!-- end list -->
                                    </div>
                                </div>

                                <div class="text-center" role="tablist">
                                    <ul class="nav nav-tabs-custom border-bottom-0 text-center" role="tablist">
                                        <li class="nav-item" hidden>
                                            <a class="nav-link active fw-semibold" data-bs-toggle="tab"
                                                href="#project-overview" role="tab">
                                                Overview
                                            </a>
                                        </li>
                                        <a data-bs-toggle="tab" href="#project-team" role="tab"
                                            class="text-success m-auto"><i
                                                class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i>
                                            Load more </a>
                                    </ul>
                                </div>
                                <!-- end card body -->
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end tab pane -->
                <form method='post'>
                    <input type="file" class="btn btn-soft-info btn-sm upload_file" id='project_multiple_files'
                        name="file[]" multiple hidden>
                </form>
                <div class="tab-pane fade" id="project-documents" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center mb-4">
                                    <h5 class="card-title flex-grow-1">Documents</h5>
                                </div>

                                <div class="col-1 offset-5 flex-shrink-0">
                                    <button type="file" class="btn btn-soft-info btn-sm upload_btn"><i
                                            class="ri-upload-2-fill me-1 align-bottom"></i>Upload</button>

                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-lg-12">
                                    <div id="file_load">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end tab pane -->

                <!-- end tab pane -->
                <div class="tab-pane fade" id="project-team" role="tabpanel">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <label for="" class="text-dark mt-2 fs-5">Select Team Leader : </label>
                            <!-- <select name="" id="load_magnager_leader" class="form-select col-sm">
                                
                            </select> -->
                        </div>
                        <div class="col-sm-auto">
                            <!-- <label for="" class="text-dark">Select Team Leader : </label> -->
                            <select name="" id="load_magnager_leader" class="form-select col-sm">

                            </select>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-end">
                                <div class="search-box me-2">
                                    <input type="text" class="form-control" placeholder="Search client...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div>
                                <button type="button" class="btn btn-soft-success" data-bs-toggle="modal"
                                    data-bs-target="#addMangerToProject" id="addManagerOverviewTeam">+ Add
                                    Manager</button>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div>
                                <button type="button" class="btn btn-soft-secondary" data-bs-toggle="modal"
                                    data-bs-target="#addEmpToProject" id="addMemberOverviewTeam">+ Add
                                    Member</button>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <!-- Vertical alignment (align-items-start) -->
                    <div class="team-list list-view-filter" id="loadEmpOverTeam">

                    </div>
                    <!-- end team list -->
                </div>
                <div class="tab-pane fade" id="project-task" role="tabpanel">
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
                                <div id="unassigned-task" class="overflow-auto tasks unassigned-task_project"
                                    style="max-height:400px;">

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
                                            class="badge bg-secondary float-end align-bottom ms-1 totaltask-badge todo"></small>
                                    </h6>
                                </div>
                            </div>
                            <div style="max-height:79%;" data-simplebar data-simplebar-track="dark">
                                <div id="todo-task" class="overflow-auto tasks todo-task_project "
                                    style="max-height:400px;">

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
                                <div id="inprogress-task" class="overflow-auto tasks inprogress-task_project"
                                    style="max-height:400px;">

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
                                            class="badge float-end bg-info align-bottom ms-1 totaltask-badge reviews"></small>
                                    </h6>
                                </div>
                            </div>
                            <div style="max-height:79%;" data-simplebar data-simplebar-track="dark">
                                <div id="reviews-task" class="overflow-auto tasks reviews-task_project"
                                    style="max-height:400px;">

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
                                            class="badge bg-success float-end align-bottom ms-1 totaltask-badge completed"></small>
                                    </h6>
                                </div>
                            </div>
                            <div style="max-height:79%;" data-simplebar data-simplebar-track="dark">
                                <div id="completed-task" class="overflow-auto tasks completed-task_project"
                                    style="max-height:400px;">

                                </div>
                            </div>
                            <div class="my-3">
                                <button class="btn btn-soft-dark w-100"></button>
                            </div>
                        </div>
                        <!--end tasks-list-->

                    </div>
                    <!--end task-board-->




                    <div class="modal fade" data-bs-backdrop='static' data-bs-keyboard='false' id="creatertaskModal"
                        tabindex="-1" aria-labelledby="creatertaskModalLabel" aria-hidden="true">
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
                                            <input type="text" name="pname"
                                                value="<?php echo $_SESSION['overview_page_id'];  ?>" hidden>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <label for="sub-tasks" class="form-label">Task Title</label>
                                                <input type="text" class="form-control" id="sub-tasks" name="TName"
                                                    placeholder="Task title">
                                                <input type="text" class="form-control" id="tid" name="tid" hidden>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <label for="task-description" class="form-label">Task
                                                    Description</label>
                                                <textarea class="form-control" id="task-description" name="Tdescription"
                                                    rows="3" placeholder="Task description"></textarea>
                                            </div>

                                            <div class="col-md-12 light-style">
                                                <label for="select2Primary" class="form-label">Select Employee</label>
                                                <div class="select2-info">
                                                    <select id="select2Primary" class="empLoad select2 form-control "
                                                        name="empLoad" multiple>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="start-date" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" id="start-date" name="sdate" placeholder="Select date">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="due-date" class="form-label">Due Date</label>
                                                <input type="" class="form-control" id="due-date" name="duedate" placeholder="Select date">
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
                                                    <button type="submit" class="btn btn-success"
                                                        id="insertProjTask">Add Task</button>
                                                    <button type="submit" class="btn btn-success"
                                                        id="updateProjTask">Update
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
                                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                                        </lord-icon>
                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                            <h4>Are you sure ?</h4>
                                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this tasks ?
                                            </p>
                                            <input type="text" class="btn_delete" hidden>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                        <button type="button" class="btn w-sm btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete
                                            It!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="modal fade" data-bs-backdrop='static' data-bs-keyboard='false' id="addEmpToProj"
                        tabindex="-1" aria-labelledby="creatertaskModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content border-0">
                                <div class="modal-header p-3 bg-soft-info">
                                    <h5 class="modal-title" id="creatertaskModalLabel">Select employee</h5>
                                    <button type="button" class="btn-close" id="closeProjTask" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <!-- <div class="modal-header p-3 bg-soft-info">
                                        <h5 class="modal-title" id="creatertaskModalLabel">Create New Task</h5>
                                        
                                    </div> -->
                                <div class="modal-body">
                                    <div class="col-12 text-end pt-2 px-4">
                                        <div class="input-group col-6 mb-3">
                                            <div class="input-group-text">
                                                <i class="bx bx-search-alt bx-sm"></i>
                                            </div>
                                            <input type="text" class="form-control" id="live_search_proj_emp"
                                                placeholder="Search by employee first name...">
                                            <div class="input-group-text p-0">
                                                <select class="form-select" id="load_depart">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive text-nowrap" id="employeeData" style="height: 360px;">
                                        <!-- <table class="table table-striped table-hover">
                                                <thead class="bg-white">
                                                    <tr>
                                                        <th class='fs-6'>EMPLOYEE NAME</th>
                                                        <th class='fs-6'>DEPARTMENT</th>
                                                        <th class='fs-6'>LOCATION</th>
                                                        <th class='fs-6'>SELECT</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0 overflow-hidden" >

                                                </tbody>
                                            </table> -->
                                    </div>

                                </div>
                                <div class=" mb-3 col-11 text-end">
                                    <button type="button" class="btn btn-primary" id="saveEmpP" data-bs-dismiss="modal"
                                        aria-label="Close">SAVE</button>
                                    <button type="button" class="btn btn-primary" id="cancelEmpP"
                                        data-bs-dismiss="modal" aria-label="Close">CANCLE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->

    <!--start add manager modal-->
    <div class="modal fade" id="addMangerToProject" tabindex="-1" aria-labelledby="inviteMembersModalProj"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="inviteMembersModalLabel">Add Managers</h5>
                    <button type="button" class="btn-close cancelEmpModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 ">
                    <div class="d-flex row">
                        <div class="search-box mb-3 col-7">
                            <input type="text" class="form-control bg-light border-light" id="live_search_proj_manager"
                                placeholder="Search by name...">
                            <i class="ri-search-line search-icon m-auto ms-2"></i>
                        </div>
                        <div class="col-5 ">
                            <select class="col-lg-3 col-md-3 form-select bg-light" id="load_depart_proj_manager">
                                <option value="All">Department</option>
                            </select>
                        </div>
                    </div>

                    <div class="mx-n4 px-4" data-simplebar style="max-height: 400px;">
                        <div class="vstack gap-3" id="managerDataOverview">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addEmpToProject" tabindex="-1" aria-labelledby="inviteMembersModalProj"
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
                            <input type="text" class="form-control bg-light border-light" id="live_search_proj_overview"
                                placeholder="Search by name...">
                            <i class="ri-search-line search-icon m-auto ms-2"></i>
                        </div>
                        <div class="col-5 ">
                            <select class="col-lg-3 col-md-3 form-select bg-light" id="load_depart_proj_overview">
                                <option value="All">Department</option>
                            </select>
                        </div>
                    </div>

                    <div class="mx-n4 px-4" data-simplebar style="max-height: 225px;">
                        <div class="vstack gap-3" id="employeeDataOverview">

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

    <!-- removeEmployeeModal -->
    <div id="removeEmployeeFromProjModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="text" id="removeEmpFromProj" hidden>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                        </lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove
                                this Employee From Project Team ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal"
                            id="remove-Employee-projOve-close">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="remove-Employee-projOve">Yes,
                            Delete It!</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- end modal -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->


    <script src="../assets/libs/dragula/dragula.min.js"></script>

    <!-- dom autoscroll -->
    <script src="../assets/libs/dom-autoscroller/dom-autoscroller.min.js"></script>

    <!--taks-kanban-->
    <script src="../assets/js/pages/tasks-kanban-project_overView.init.js"></script>
    <?php require 'static/footer.php'; ?>
    <script>
    $(document).ready(function() {
        // kanban cards count load_by_project
        function dynamic_load_kanban_cards_count_by_project(status1) {
            $.ajax({
                url: "../assets/server/ajax.php",
                method: "POST",
                data: {
                    flag: "dynamic_load_kanban_cards_count_by_project",
                    status: status1,
                },
                success: function(data) {
                    $("." + status1).html(data);
                },
            });
        }

        dynamic_load_kanban_cards_count_by_project("unassigned");
        dynamic_load_kanban_cards_count_by_project("todo");
        dynamic_load_kanban_cards_count_by_project("inprogress");
        dynamic_load_kanban_cards_count_by_project("reviews");
        dynamic_load_kanban_cards_count_by_project("completed");


        function loadEmployee(id) {
            $.ajax({
                url: "../assets/server/ajax.php",
                method: "POST",
                data: {
                    flag: "loadEmployee",
                    id: id
                },
                success: function(data) {
                    // $("#empLoad").html(data);
                    $(".empLoad").html(data);
                },
            });
        }
        loadEmployee(<?php echo $_SESSION['overview_page_id'];  ?>);
    })
    </script>
     <script>
        $(document).ready(function() {
            $("#due-date").attr('readonly', true);
            $(document).on("change", "#start-date", function() {
                $("#due-date").attr('readonly', false);
                var disableFuturedate1 = $("#start-date").val();
                var todaysDate = new Date(disableFuturedate1);
                var year = todaysDate.getFullYear();
                var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);
                var day = ("0" + todaysDate.getDate()).slice(-2);
                var dtToday = (year + "-" + month + "-" + day);
                $("#due-date").attr('type', "date");
                $("#due-date").attr('min', dtToday);

            })

        })
    </script>
</body>



</html>