<?php
$page = "dashboard";
require '../assets/server/connection.php';
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Admin | index page</title>
    <?php require 'static/head.php'; ?>
    <style>
        ::-webkit-scrollbar {
        display:none;
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
                <h4 class="mb-sm-0">Employee List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">All lists</a></li>
                        <li class="breadcrumb-item active">Employee List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row g-4 mb-3">

        <div class="col-sm">
            <div class="d-flex justify-content-sm-end gap-2">
                <div class="search-box ms-2 w-100">
                    <input type="text" class="form-control" placeholder="Search..." id="live_search">
                    <i class="ri-search-line search-icon"></i>
                </div>

                <select class="form-control w-25" id="load_depart" data-choices data-choices-search-false>
                    <option value="All">All</option>

                </select>
            </div>
        </div>
        <div class="col-sm-auto">
            <div>
                <a class="btn btn-success" href='#' data-bs-toggle='modal' data-bs-target='#addEmployeeModal'><i
                        class="ri-add-line align-bottom me-1"></i> Add New Employee</a>
            </div>
        </div>
    </div>


    <!-- add employee modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light p-3 bg-soft-success">
                    <h5 class="modal-title" id="exampleModalLabel">ADD EMPLOYEE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>

                
                <form class="tablelist-form needs-validation" method="post" id="addEmpForm" novalidate>
                    <div class="modal-body">
                        <input type="hidden" id="id-field" />

                        <!-- Outlined Styles -->
                        <div class="hstack flex-wrap">

                            <div class=" w-50 d-flex justify-content-end">
                                <input type="radio" class="btn-check isAdmin" name="options" id="primary-outlined"
                                    value="admin">
                                <label
                                    class="btn btn-outline-primary w-50 gap-2 p-2 mx-2 fw-bold fs-5 d-flex justify-content-center align-items-center p-1"
                                    for="primary-outlined">
                                    <span> <i class=" ri-user-settings-line fs-3"></i> </span>
                                    <span>ADMIN</span>
                                </label>
                            </div>

                            <div class=" w-50">
                                <input type="radio" class="btn-check isAdmin" name="options" id="success-outlined"
                                    value="user" checked>
                                <label
                                    class="btn btn-outline-success gap-2 w-50 p-2 mx-2 fw-bold fs-5 d-flex justify-content-center align-items-center p-1"
                                    for="success-outlined">
                                    <span><i class=" ri-user-3-line fs-3"></i> </span>
                                    <span>USER</span></label>
                            </div>
                        </div>


                        <div class="row gy-4 mb-3 mt-2">
                            <div class="col-md-6">
                                <div>
                                    <label for="amount-field" class="form-label">Email
                                        <span class="text-danger" id="err_email">*</span>

                                    </label>
                                    <input type="text" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" class="form-control emp_input"
                                        placeholder="Total amount" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="payment-field" class="form-label">Select Department
                                        <span class="text-danger" id="err_depaertment">*</span>
                                    </label>
                                    <select class="form-control emp_input" name="depaertment" id="depaertment" required>
                                        <option value="">ALL</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row gy-4 mb-3 ">
                            <div class="col-md-4">
                                <div>
                                    <label for="amount-field" class="form-label">First Name
                                        <span class="text-danger" id="err_fname">*</span>
                                    </label>
                                    <input type="text" id="fname" name="fname" class="form-control emp_input"
                                        placeholder="Total amount" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <label for="amount-field" class="form-label">Middle Name
                                        <span class="text-danger" id="err_mname">*</span>
                                    </label>
                                    <input type="text" id="mname" name="mname" class="form-control emp_input"
                                        placeholder="Total amount" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <label for="amount-field" class="form-label">Last Name
                                        <span class="text-danger" id="err_lname">*</span>
                                    </label>
                                    <input type="text" id="lname" name="lname" class="form-control emp_input"
                                        placeholder="Total amount" required />
                                </div>
                            </div>
                        </div>


                        <div class="row gy-4 mb-3">
                            <div class="col-md-6">
                                <div>
                                    <label for="amount-field" class="form-label">Password
                                        <span class="text-danger" id="err_pass">*</span>
                                    </label>
                                    <input type="password" id="pass" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{6,}$" name="pass" class="form-control emp_input" placeholder=""
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="amount-field" class="form-label">Confirm Password
                                        <span class="text-danger" id="err_pass1">*</span></label>

                                    </label>
                                    <input type="password" id="pass1" name="pass1" class="form-control emp_input" placeholder=""
                                        required />
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn bg-soft-secondary" data-bs-dismiss="modal"
                                id="cancle">Close</button>
                            <button type="submit" class="btn btn-success" id="add-emp">Add Employee</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add employee modal finish -->

    <!-- display employee data -->
    <div class="table-responsive" id="empData">
       


        <!-- end table -->
    </div>
    <!-- <div class="d-flex justify-content-end mt-0 pb-2 pe-3" style="background-color:#e1ebfd;" id="empPagi">
        <div class="pagination-wrap hstack gap-2" style="display: flex;">
            <ul class="pagination listjs-pagination mb-0"> -->
                <?php
                // $limit = 5;
                // $result_db = mysqli_query($conn, "SELECT COUNT(emp_id) FROM employeetb where role!='admin'");
                // $row_db = mysqli_fetch_row($result_db);
                // $total_records = $row_db[0];
                // $total_pages = ceil($total_records / $limit);
                // $pagLink = "";
                // for ($i = 1; $i <= $total_pages; $i++) {
                //     $pagLink .= "<li class='page cursor-pointer'><a class='page' data-i='1' data-page='8' onclick='get_data(".$i.")'>" . $i . "</a></li>";
                // }
                // echo $pagLink;
                ?>
            <!-- </ul>
        </div>
    </div> -->
    <!-- end table responsive -->
    <!-- end row -->

    <!-- removeEmployeeModal -->
    <div id="removeEmployeeModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="text" id="removeEmp" hidden>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Project ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal"
                            id="remove-Employee-close">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="remove-Employee">Yes, Delete It!</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- add employee extra personal modal -->
    <div class="modal fade" id="addEmployeeExtraPersonalModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light p-3 bg-soft-success">
                    <h5 class="modal-title" id="exampleModalLabel">ADD EMPLOYEE EXTRA PERSONAL INFORMATION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>

                <form class="tablelist-form" autocomplete="off" method="post" id="addEmpForm">
                    <div class="modal-body">
                        <input type="hidden" id="empIdEP" />

                        <div class="row gy-4 mb-3 mt-2">

                            <div class="col-md-6">
                                <div>
                                    <label for="amount-field" class="form-label">Eployee Gender : </label>
                                    <!-- Base Radios -->
                                    <input type="radio" class="form-check-input ml-1 gender ms-2" name="gender"
                                        id="male" value="male">
                                    <label class="form-check-label ml-4	" for="male">Male</label>
                                    <input type="radio" class="form-check-input ml-1 gender" name="gender" id="female"
                                        value="female">
                                    <label class="form-check-label ml-4" for="female">Female</label>
                                </div>
                            </div>

                        </div>

                        <div class="row gy-4 mb-3">
                            <div class="col-md-6">
                                <div>
                                    <label for="amount-field" class="form-label">Spouse Name
                                    </label>
                                    <input type="text" id="spouse_name" name="spouse_name" class="form-control"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="amount-field" class="form-label">Spouse Birthdate : </label>
                                    <input type="date" class="form-control" id="spouse_bd" name="spouse_bd">

                                </div>
                            </div>

                        </div>

                        <div class="row gy-4 mb-3">
                            <div class="col-md-6">
                                <div>
                                    <label for="amount-field" class="form-label">Employee Birthdate :
                                    </label>
                                    <input type="date" class="form-control" id="emp_bd" name="emp_bd">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="amount-field" class="form-label">Anniversary Birthdate : </label>
                                    <input type="date" class="form-control" id="anni_date" name="anni_date">

                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-12 mt-2">
                                <label class="fw-bold ">Child Information :</label>
                            </div>
                            <div class="col-12 text-center">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Child Name</th>
                                        <th>Child BirthDate</th>
                                        <th>Child Gender</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" id="cid" name="cid" hidden>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" id="cbd" name="cbd">
                                        </td>
                                        <td class="w-25">
                                            <input type="radio" class="form-check-input mt-2 cgender" name="cgender"
                                                id="boy" value="boy">
                                            <label class="form-check-label mt-2" for="boy">Boy</label>
                                            <input type="radio" class="form-check-input mt-2 cgender" name="cgender"
                                                id="girl" value="girl" checked>
                                            <label class="form-check-label mt-2 " for="girl">Girl</label>
                                        </td>
                                        <td>
                                            <input type="button" class="btn btn-primary" id="cInsert" name="cInsert"
                                                value="ADD">
                                            <input type="button" class="btn btn-primary " id="cUpdate" name="cUpdate"
                                                value="UPDATE" style="display: none;">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="mb-3 col-12 text-center">
                                <table class="table table-bordered" id="childInfo">

                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn bg-soft-secondary" data-bs-dismiss="modal"
                                id="cancle">Close</button>
                            <button type="submit" class="btn btn-success" id="updateEmp">Save</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add employee modal finish -->


    <?php require 'static/footer.php'; ?>
    <script>
    // $(".emp_input").on('focusout', function() {
    //     onfocusout_validation($(this).attr('id'));
    // });

    // $(".emp_input").on('input', function() {
    //     oninput_validation($(this).attr('id'));
    // });

    function get_data(no) {
        $.ajax({
            type: 'post',
            url: '../assets/server/ajax.php',
            data: {
                row_no: no,
                flag: "loadEmpData"
            },
            success: function(data) {
                $("#empData").html(data);
            }
        });
    }
    </script>
</body>

</html>