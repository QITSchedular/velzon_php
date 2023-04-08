<?php
$page = "myTask";
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Manager | My Task page</title>
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
                <h4 class="mb-sm-0">Projects</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="index">Dashboards</a></li>
                        <li class="breadcrumb-item active">My Task</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="tasks-board  mb-3 pb-3" id="kanbanboard" style="max-height: 40.5rem; ">
        <div class="tasks-list px-1 py-1">
            <div class="d-flex mb-3 p-2" style="background-color: #e1ebfd;">
                <div class="flex-grow-1">
                    <h6 class="fs-14 text-uppercase fw-semibold mb-0">Unassigned <small
                            class="badge bg-success float-end align-bottom ms-1 totaltask-badge unassigned">0</small>
                    </h6>
                </div>
            </div>

            <div style="max-height:90%;" data-simplebar data-simplebar-track="dark">
                <div id="unassigned-task" class="overflow-auto tasks unassigned-task" style="max-height:405px;">

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
                            class="badge bg-secondary float-end align-bottom ms-1 totaltask-badge todo">0</small></h6>
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

    <!-- <div class="row row-cols-1 row-cols-md-4" id="projectData">

      
    </div> -->



    <script src="../assets/libs/dragula/dragula.min.js"></script>

    <!-- dom autoscroll -->
    <script src="../assets/libs/dom-autoscroller/dom-autoscroller.min.js"></script>

    <!--taks-kanban-->
    <script src="../assets/js/pages/tasks-kanban-employee.init.js"></script>

    <!-- App js -->

    <?php require 'static/footer.php'; ?>
</body>

</html>