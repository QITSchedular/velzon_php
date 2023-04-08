<?php
$page = "Profile";
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Admin | profile page</title>

    <?php require 'static/head.php'; ?>
</head>

<body>
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>

    <div class="d-flex">
        <label for="filter_by_date" class="pt-2 fs-5">Filter : </label>
        <select class="form-select mb-3 ms-2 w-50" id="filter_by_date" aria-label="Default select example">
            <option value="0" selected>All</option>
            <option value="1">Current Week</option>
            <option value="2">Current Month</option>
            <option value="3">Last Week</option>
            <option value="4">Last Month</option>
        </select>
    </div>


    <div class="row row-cols-xxl-4 row-cols-lg-3 row-cols-md-2 row-cols-1">

        <!--end col-->

        <div class="col pt-3">
            <div class="card">
                <a class="card-body bg-soft-warning" data-bs-toggle="collapse" href="#saveSheet" role="button" aria-expanded="false" aria-controls="saveSheet">
                    <h5 class="card-title text-uppercase fw-semibold mb-1 fs-15">Saved Sheet</h5>
                    <p class="text-muted mb-0"><span class="fw-medium load-total-hour-saved"></span></p>
                </a>
            </div>
            <!--end card-->
            <div class="collapse show" id="saveSheet">
                <div style="height: 26rem;" class="overflow-auto load-saved-sheet pb-3" data-simplebar data-simplebar-track="dark">

                </div>
                <!-- <button type="button" class="submitTimesheet mb-0 btn btn-secondary bg-gradient waves-effect waves-light float-end mt-3">Submit</button> -->

                <!--end card-->

            </div>
        </div>
        <!--end col-->

        <div class="col pt-3">
            <div class="card">
                <a class="card-body bg-soft-primary" data-bs-toggle="collapse" href="#submitSheet" role="button" aria-expanded="false" aria-controls="saveSheet">
                    <h5 class="card-title text-uppercase fw-semibold mb-1 fs-15">Submitted Sheet</h5>
                    <p class="text-muted mb-0"><span class="fw-medium load-total-hour-submitted"></span></p>
                </a>
            </div>
            <!--end card-->
            <div class="collapse show pb-3" id="submitSheet">
                <div style="height: 26rem;" class="overflow-auto load-submitted-sheet" data-simplebar data-simplebar-track="dark">



                </div>

            </div>
        </div>
        <!--end col-->

        <div class="col pt-3">
            <div class="card">
                <a class="card-body bg-soft-success" data-bs-toggle="collapse" href="#approveSheet" role="button" aria-expanded="false" aria-controls="approveSheet">
                    <h5 class="card-title text-uppercase fw-semibold mb-1 fs-15">Approved Sheet</h5>
                    <p class="text-muted mb-0"><span class="fw-medium load-total-hour-approved"></span></p>
                </a>
            </div>
            <!--end card-->
            <div class="collapse show pb-3" id="approveSheet">
                <div style="height: 26rem;" class="overflow-auto load-approved-sheet " data-simplebar data-simplebar-track="dark">

                </div>

            </div>
        </div>
        <!--end col-->

        <div class="col pt-3">
            <div class="card">
                <a class="card-body bg-soft-danger" data-bs-toggle="collapse" href="#rejectSheet" role="button" aria-expanded="false" aria-controls="rejectSheet">
                    <h5 class="card-title text-uppercase fw-semibold mb-1 fs-15">Rejected Sheet</h5>
                    <p class="text-muted mb-0"><span class="fw-medium load-total-hour-rejected"></span></p>
                </a>
            </div>
            <!--end card-->
            <div class="collapse show pb-3" id="rejectSheet">
                <div style="height: 26rem;" class="overflow-auto load-rejected-sheet " data-simplebar data-simplebar-track="dark">

                </div>

            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <?php require 'static/footer.php'; ?>
    <script src="../assets/javascript/timesheet.js"></script>

</body>

</html>