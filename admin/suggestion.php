<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Admin | Suggestions</title>
    <?php require 'static/head.php'; ?>
</head>

<body>
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Suggestions</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                        <li class="breadcrumb-item active">Suggestions</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="search-box">
                        <input type="text" class="form-control search" placeholder="Search for deals...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <!--end col-->
                <div class="col-md-auto ms-auto">
                    <div class="d-flex hastck gap-2 flex-wrap">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted">Sort by: </span>
                            <select class="form-control mb-0" data-choices data-choices-search-false
                                id="choices-single-default">
                                <option value="Owner">Owner</option>
                                <option value="Company">Company</option>
                                <option value="Date">Date</option>
                            </select>
                        </div>

                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end card-->

    <div class="row row-cols-md-3 ">
        <div class='col collapse show' id='leadDiscovered1'>
        </div>
        <div class='col collapse show' id='leadDiscovered2'>
        </div>
        <div class='col collapse show' id='leadDiscovered3'>
        </div>
    </div>
    <!--end row-->


    <?php require 'static/footer.php'; ?>
    <script src="assets/libs/cleave.js/cleave.min.js"></script>

    <script src="assets/js/pages/crm-deals.init.js"></script>

</body>

</html>