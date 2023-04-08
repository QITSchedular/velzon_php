<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<head>
    <title>Admin | project create</title>
    <?php require 'static/head.php'; ?>
    <style>
           

    </style>
</head>

<body>
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 changeable_text"></h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="projectList.php">Projects</a></li>
                        <li class="breadcrumb-item active changeable_text"></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <form class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Privacy</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <label for="choices-privacy-status-input" class="form-label">Client name </label>
                            <select class="form-select" data-choices-search-false id="clientLoad" name="clientdata">
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <!-- <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tags</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-categories-input" class="form-label">Categories</label>
                        <select class="form-select" data-choices data-choices-search-false
                            id="choices-categories-input">
                            <option value="Designing" selected>Designing</option>
                            <option value="Development">Development</option>
                        </select>
                    </div>

                    <div>
                        <label for="choices-text-input" class="form-label">Skills</label>
                        <input class="form-control" id="choices-text-input" data-choices
                            data-choices-limit="Required Limit" placeholder="Enter Skills" type="text"
                            value="UI/UX, Figma, HTML, CSS, Javascript, C#, Nodejs" />
                    </div>
                </div>
            </div> -->
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Members</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-lead-input" class="form-label">Team Lead</label>
                            <select class="form-select" data-choices data-choices-search-false id="choices-lead-input">
                                <option value="Brent Gonzalez" selected>Brent Gonzalez</option>
                                <option value="Darline Williams">Darline Williams</option>
                                <option value="Sylvia Wright">Sylvia Wright</option>
                                <option value="Ellen Smith">Ellen Smith</option>
                                <option value="Jeffrey Salazar">Jeffrey Salazar</option>
                                <option value="Mark Williams">Mark Williams</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="choices-lead-input" class="form-label">Team Manager</label>
                            <select class="form-select" data-choices data-choices-search-false id="choices-lead-input">
                                <option value="Brent Gonzalez" selected>Brent Gonzalez</option>
                                <option value="Darline Williams">Darline Williams</option>
                                <option value="Sylvia Wright">Sylvia Wright</option>
                                <option value="Ellen Smith">Ellen Smith</option>
                                <option value="Jeffrey Salazar">Jeffrey Salazar</option>
                                <option value="Mark Williams">Mark Williams</option>
                            </select>
                        </div>

                        <div>
                            <label class="form-label">Team Members</label>
                            <div class="avatar-group">
                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Brent Gonzalez">
                                    <div class="avatar-xs">
                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid">
                                    </div>
                                </a>
                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Sylvia Wright">
                                    <div class="avatar-xs">
                                        <div class="avatar-title rounded-circle bg-secondary">
                                            S
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Ellen Smith">
                                    <div class="avatar-xs">
                                        <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle img-fluid">
                                    </div>
                                </a>
                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Add Members">
                                    <div class="avatar-xs" data-bs-toggle="modal" data-bs-target="#inviteMembersModal">
                                        <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                            +
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="project-title-input">Project Title</label>
                            <input type="text" class="form-control" id="project_title" name="project_title" placeholder="Enter project title" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="project-thumbnail-img">Attach files </label>
                            <input class="form-control" id="project_files" name="project_files[]" type="file" multiple required>
                        </div>
                        <div id="file_load_edit">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Project Description</label>
                            <textarea class="form-control" id="project_desc" name="project_desc" rows="4" required></textarea>

                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-4">
                                <div class="mb-3 mb-lg-0">
                                    <label for="choices-status-input" class="form-label">Status</label>
                                    <select class="form-control" id="project_status" name="project_status" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value="started">Started</option>
                                        <option value="onhold">On Hold</option>
                                        <option value="inprogress">In Progress</option>
                                        <option value="cancelled">Cancelles</option>
                                        <option value="completed">Completed</option>
                                        <option value="deffered">Deffered</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="datepicker-deadline-input" class="form-label">Start date </label>
                                    <input type="date"  class="form-control " data-provider="flatpickr" id="project_sdate" name="project_sdate" placeholder="Enter start date" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="datepicker-deadline-input" class="form-label ">Deadline</label>
                                    <input type="date" class="form-control" id="project_deadline" name="project_deadline" placeholder="Enter due date" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mb-4 mx-4 mt-3">
                        <button class="btn btn-primary" type="submit" id="insertProj">Submit</button>
                        <button class="btn btn-primary" type="submit" id="updateProj">Update</button>
                    </div>
                </div>

            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
    </form>


    <!-- Modal -->
    <div class="modal fade" id="inviteMembersModal" tabindex="-1" aria-labelledby="inviteMembersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="inviteMembersModalLabel">Members</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="search-box mb-3">
                        <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                        <i class="ri-search-line search-icon"></i>
                    </div>

                    <div class="mb-4 d-flex align-items-center">
                        <div class="me-2">
                            <h5 class="mb-0 fs-13">Members :</h5>
                        </div>
                        <div class="avatar-group justify-content-center">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Brent Gonzalez">
                                <div class="avatar-xs">
                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Sylvia Wright">
                                <div class="avatar-xs">
                                    <div class="avatar-title rounded-circle bg-secondary">
                                        S
                                    </div>
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Ellen Smith">
                                <div class="avatar-xs">
                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="mx-n4 px-4" data-simplebar style="max-height: 225px;">
                        <div class="vstack gap-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0 me-3">
                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="img-fluid rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">Nancy Martino</a></h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                </div>
                            </div>
                            <!-- end member item -->
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0 me-3">
                                    <div class="avatar-title bg-soft-danger text-danger rounded-circle">
                                        HB
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">Henry Baird</a></h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                </div>
                            </div>
                            <!-- end member item -->
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0 me-3">
                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="img-fluid rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">Frank Hook</a></h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                </div>
                            </div>
                            <!-- end member item -->
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0 me-3">
                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="img-fluid rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">Jennifer Carter</a>
                                    </h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                </div>
                            </div>
                            <!-- end member item -->
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0 me-3">
                                    <div class="avatar-title bg-soft-success text-success rounded-circle">
                                        AC
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">Alexis Clarke</a></h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                </div>
                            </div>
                            <!-- end member item -->
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs flex-shrink-0 me-3">
                                    <img src="assets/images/users/avatar-7.jpg" alt="" class="img-fluid rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fs-13 mb-0"><a href="#" class="text-body d-block">Joseph Parker</a></h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-light btn-sm">Add</button>
                                </div>
                            </div>
                            <!-- end member item -->
                        </div>
                        <!-- end list -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light w-xs" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success w-xs">Invite</button>
                </div>
            </div>
            <!-- end modal-content -->
        </div>
        <!-- modal-dialog -->
    </div>
    <!-- end modal -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->



    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>



    <!-- JAVASCRIPT -->

    <script src="../assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

    <script src="../assets/js/pages/project-create.init.js"></script>


    <?php require 'static/footer.php'; ?>
    <script>
        $(document).ready(function() {

            


            $(document).on("change", "#project_sdate", function() {
                var disableFuturedate1 = $("#project_sdate").val();
                var todaysDate = new Date(disableFuturedate1);
                var year = todaysDate.getFullYear();
                var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);
                var day = ("0" + todaysDate.getDate()).slice(-2);
                var dtToday = (year + "-" + month + "-" + day);
                $("#project_deadline").attr('min', dtToday);

            })

        })
    </script>
</body>



</html>