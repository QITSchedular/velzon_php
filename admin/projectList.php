<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Admin | index page</title>
    <?php require 'static/head.php'; ?>
</head>

<body>
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Project List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                        <li class="breadcrumb-item active">Project List</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row g-4 mb-3">
        <div class="col-sm-4">
            <div>
                <a href="#" class="btn btn-success clear_session_id"><i class="ri-add-line align-bottom me-1"></i>
                    Add New</a>
            </div>

        </div>
        <div class="col-sm-4 offset-md-4 ">
            <div class="d-flex justify-content-sm-end gap-2">
                <div class="hover">
                    <a href="#" class="listview"><i class="ri-list-check-2 fs-2"></i></a>
                </div>
                <div>
                    <a href="#" class="gridview"><i class="ri-grid-fill fs-2"></i></a>
                </div>

                <div class="search-box ms-2">
                    <input type="text" class="form-control" placeholder="Search...">
                    <i class="ri-search-line search-icon"></i>
                </div>

                <select class="form-control w-md" data-choices data-choices-search-false>
                    <option value="All">All</option>
                    <option value="Today">Today</option>
                    <option value="Yesterday" selected>Yesterday</option>
                    <option value="Last 7 Days">Last 7 Days</option>
                    <option value="Last 30 Days">Last 30 Days</option>
                    <option value="This Month">This Month</option>
                    <option value="Last Year">Last Year</option>
                </select>
            </div>
        </div>
    </div>


    <div class="row row-cols-1 row-cols-md-4" id="projectData">
<!-- 
<div class="card">
        <div class="card-body">
            <div class="table-responsive table-card" id="table-gridjs"></div>
        </div>
    </div> -->
    </div>
    
        
    <!-- end row -->





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
                            <input type="text" class="form-control bg-light border-light" id="live_search_proj"
                                placeholder="Search by name...">
                            <i class="ri-search-line search-icon m-auto ms-2"></i>
                        </div>
                        <div class="col-5 ">
                            <select class="col-lg-3 col-md-3 form-select bg-light" id="load_depart_proj">
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

    <?php require 'static/footer.php'; ?>
</body>

</html>