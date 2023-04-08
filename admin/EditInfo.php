<?php
$empId= $_GET['id'];
$page = "employeeList";
require '../assets/server/connection.php';
if(isset($_GET['id'])){
    $cid = $_GET['id'];
}else{
    header('location:EmployeeList.php');
}
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


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
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Employee Personal Information</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">All lists</a></li>
                        <li class="breadcrumb-item ">Employee List</li>
                        <li class="breadcrumb-item active">Employee personal info</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-n4 mx-n4">
                <div class="card-body pb-0 px-4 fs-16">

                    <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                Personal Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#logininfo" role="tab">
                                Login Information
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#signatureinfo" role="tab">
                                Signature Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#profileinfo" role="tab">
                                Profile Information
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content text-muted">
                <div class="tab-pane fade show active" id="personalDetails" role="tabpanel">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <form class="">
                                    <div class="row mt-3">
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <div class="d-flex">
                                                <label for="fname">
                                                    First Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div id="err_fname" class="err mx-2"></div>
                                            </div>
                                            <input type="text" class="form-control fs-6" id="fname" name="fname" />
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <div class="d-flex">
                                                <label for="mname">
                                                    Middel Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div id="err_mname" class="err mx-2"></div>
                                            </div>
                                            <input type="text" class="form-control" id="mname" name="mname" />
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <div class="d-flex">
                                                <label for="lname">
                                                    Last Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div id="err_lname" class="err mx-2"></div>
                                            </div>
                                            <input type="text" class="form-control" id="lname" name="lname" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-lg-8 col-md-8 col-sm-12">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label for="zipcode">Zip Code</label>
                                            <input type="number" class="form-control" id="zipcode" name="zipcode">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label for="country">Country</label>
                                            <select class="country form-control" id="countryId" name="countryId"></select>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label for="state">State</label>
                                            <select name="state" class="states form-control" id="stateId">
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label for="city">City</label>
                                            <select name="city" class="cities form-control" id="cityId">
                                                <option value="">Select City</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <div class="d-flex">
                                                <label for="mobileno">
                                                    Mobile Number
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div id="err_mobileno" class="err mx-2"></div>
                                            </div>
                                            <input type="number" class="form-control" id="mobileno" name="mobileno">
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <div class="d-flex">
                                                <label for="workno">
                                                    Work Number
                                                </label>
                                                <div id="err_workno" class="err mx-2"></div>
                                            </div>
                                            <input type="number" class="form-control" id="workno" name="workno" />
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <div class="d-flex">
                                                <label for="homeno">
                                                    Home Number
                                                </label>
                                                <div id="err_homeno" class="err mx-2"></div>
                                            </div>
                                            <input type="number" class="form-control" id="homeno" name="homeno" />
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-9 col-md-9 col-sm-12 d-flex align-items-center">
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 text-end">
                                            <input type="button" class="btn btn-primary fs-6" id="personalDetails_btn" name="libtn" value="Save" />
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
                <!-- end tab pane -->

                <div class="tab-pane fade" id="logininfo" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="row mt-3">
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="email">Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" />
                                    </div>
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="floatingInput">
                                                Verify Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <input type="password" class="form-control" id="pwd" name="pwd1" placeholder="********">
                                    </div>
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="conpwd">Confirm Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <input type="password" class="form-control" id="conpwd" name="pwd2" placeholder="********">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="jobtitle">Job Title
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <input type="text" class="form-control" id="jobtitle" name="jobtitle" />
                                    </div>
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="dept">Department :
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <select class="form-control" id="dept" name="dept">
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="location">Location
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <select class="form-control" id="location" name="location">
                                            <option value="none" disabled selected>None</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="empstatus">Employee Status
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <select class="form-control" id="empstatus" name="empstatus">
                                            <option value="none">None</option>
                                            <option value="active">Active</option>
                                            <option value="deactive">Deactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="empmanager">Employee Manager
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <select class="form-control" id="empmanager" name="empmanager">
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="emptype">Employee Type
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <select class="form-control" id="emptype" name="emptype">
                                            <option value="none">None</option>
                                            <option value="admin">admin</option>
                                            <option value="user">employee</option>
                                            <option value="manager">manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="workingDaytype">Working Day Type
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <select class="form-control" id="workingDaytype" name="workingDaytype">
                                            <option value="none">None</option>
                                            <option value="fulltime">Full Time</option>
                                            <option value="parttime">Part Time</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="hiredDate"> Hired Date
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <input type="date" class="form-control date-picker" id="hiredDate" name="hiredDate" placeholder="Enter Your hiredDate">
                                    </div>
                                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex">
                                            <label for="terminationDate"> Termination Date
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div id="err" class="mx-2"></div>
                                        </div>
                                        <input type="date" class="form-control date-picker" id="terminationDate" name="terminationDate" placeholder="Enter Your terminationDate">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-12 d-flex align-items-center">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 text-end">
                                        <input type="button" class="btn btn-primary fs-6" id="logininfo_editBtn" name="libtn" value="Save" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end tab pane -->

                <div class="tab-pane fade" id="signatureinfo" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-4 mb-3">
                                <form>
                                    <!-- <div class="px-3 collapse" id="es"> -->
                                    <div class="row my-3 mx-2">
                                        <div class="text-danger mb-2">
                                            Electronic Signature Size(Width 180px height 100px)
                                        </div>
                                        <div class="custom-file col-sm-9">
                                            <div class="row margin-auto ">
                                                <div class="col-6">
                                                    <input type="file" class="form-control mt-4" id="signupload" name="file">
                                                </div>
                                                <div class="col-3">
                                                    <img id="previewImg" class="border border-dark" style="width:180px;height:80px" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-12 text-end mt-4">
                                            <input type="button" class="btn btn-primary fs-6" id="esbtn" name="esbtn" value="Save" />
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end tab pane -->

                <div class="tab-pane fade" id="profileinfo" role="tabpanel">
                    <!-- start page title -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <form>
                                    <div class="row ">
                                        <div class="text-danger mb-2">
                                            Profile picture must be 2 MB
                                        </div>
                                        <div class="custom-file col-sm-9">
                                            <div class="row margin-auto ">
                                                <div class="col-6">
                                                    <input type="file" class="form-control mt-2" id="profile_picture" name="proc">
                                                </div>
                                                <div class="col-3">
                                                    <img width="100" height="100" class="border border-dark img-fluid" id="previewProfile" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-12 text-end mt-2">
                                            <input type="button" class="btn btn-primary fs-6" id="ppbtn" name="ppbtn" value="Save" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end tab pane -->
            </div>
        </div>
    </div>
    <!-- end col -->












    <script src="../assets/libs/dragula/dragula.min.js"></script>

    <!-- dom autoscroll -->
    <script src="../assets/libs/dom-autoscroller/dom-autoscroller.min.js"></script>

    <!--taks-kanban-->
    <script src="../assets/js/pages/tasks-kanban-project_overView.init.js"></script>
    <?php require 'static/footer.php'; ?>

    <script>
    $("#previewProfile").hide();
    $("#previewImg").hide();
    var id = "<?php echo $empId; ?>";
    // alert(id);

    function load_data() {
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: {
                "flag": "load_emp_data",
                "id": id
            },
            success: function(val) {
                value = JSON.parse(val);
                $("#fname").val(value.firstname);
                $("#mname").val(value.middlename);
                $("#lname").val(value.lastname);
                $("#email").val(value.email);
                $("#pwd").val(value.password);
                $("#conpwd").val(value.password);
                $("#hiredDate").val(value.hiredate);
                $("#address").val(value.address);
                

            }
        })
    }
    load_data();

    $("#personalDetails_btn").on("click", function() {
        var data = new FormData(this.form);
        data.append("flag", "personalDetails_btn");
        data.append("id", id);
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            success: function(val) {
                // alert(val);
                if (val == 1) {
                    // location.reload();
                    alert("updated successfully");
                }
            }
        })
    })

    function load_manager() {
        var id = "<?php echo $empId; ?>";
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: {
                "flag": "load_manager",
                "id": id
            },
            success: function(val) {
                $("#empmanager").html(val);
            }
        })
    }
    load_manager();

    // chk emp status
    $(document).on("change", "#empstatus", function() {
        if ($("#empstatus").val() != 'deactive') {
            $("#terminationDate").prop('disabled', true);
        } else {
            $("#terminationDate").prop('disabled', false);
        }
    })


    function load_state2(id, sid) {
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: {
                "flag": "load_state",
                "id": id
            },
            success: function(data) {
                $("#stateId").html(data);
                $("#stateId").val(sid);

            }
        })
    }

    function load_city2(sid, cid) {
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: {
                "flag": "load_city",
                "id": sid
            },
            success: function(data) {
                $("#cityId").html(data);
                $("#cityId").val(cid);
            }
        })
    }


    // load dynamic data
        function load_personaldata(){
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: {
                "flag": "load_dynamic_data",
                "id": id
            },
            success: function(val) {
                value = JSON.parse(val);
                $("#address").val(value.address);
                $("#zipcode").val(value.zip_code);
                $("#countryId").val(value.country);
                load_state2(value.country, value.state);
                load_city2(value.state, value.city);
                $("#mobileno").val(value.personal_phoneNO);
                $("#homeno").val(value.home_phoneNO);
                $("#workno").val(value.work_phoneNO);
            }
        })
    }
    load_personaldata();

    $("#logininfo_editBtn").on("click", function() {
        var data = new FormData(this.form);
        var terminationDate = $("#terminationDate").val();
        data.append("flag", "logininfo_editBtn");
        data.append("id", id);
        data.append("terminationDate", terminationDate);
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            success: function(val) {
                if (val == 1) {
                    // location.reload();
                    alert("updated");
                }
            }
        })
    })

    // function of dynamic location
    function load_location_dynamic(id, id1) {
        $.ajax({
            url: "../assets/server/ajax.php",
            method: "POST",
            data: {
                "flag": "loadLocation",
                "id": id
            },
            success: function(data) {
                $("#location").html(data);
                $("#location").val(id1);
            }
        })
    }

    // load dynamic data1
    function load_dataAnother() {
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: {
                "flag": "load_dynamic_data1",
                "id": id
            },
            success: function(val) {
                value = JSON.parse(val);
                $("#jobtitle").val(value.job_title);
                $("#dept").val(value.dept_id);
                load_location_dynamic(value.dept_id, value.dept_location);
                $("#empstatus").val(value.e_status);
                $("#empmanager").val(value.e_manager);
                $("#emptype").val(value.role);

                $("#workingDaytype").val(value.working_day_type);
                if (value.e_status == 'active') {
                    $("#terminationDate").prop('disabled', true);
                } else {
                    $("#terminationDate").val(value.termination_date);
                }
            }
        })
    }
    load_dataAnother();

    // signature upload
    $("#esbtn").on("click", function() {
        var fname = $("#signupload").val().split("\\").pop();
        var data = new FormData(this.form);
        data.append("flag", "signature_upload");
        data.append("fname", fname);
        data.append("id", id);

        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            success: function(value) {
                if (value == 1) {
                    swal({
                        type: 'success',
                        title: 'success',
                        text: 'Signature upoaded..!!',
                    })
                } else if (value == 2) {
                    swal({
                        type: 'info',
                        title: 'info',
                        text: 'Please size is 2 MB...!!',
                    })
                } else if (value == 3) {
                    swal({
                        type: 'info',
                        title: 'info',
                        text: 'Signature Size(Width 180px height 100px)..!!',
                    })
                }
            }
        })
    })


    // profile upload
    $("#ppbtn").on("click", function() {
        var fname = $("#profile_picture").val().split("\\").pop();
        var data = new FormData(this.form);
        data.append("flag", "profile_upload");
        data.append("fname", fname);
        data.append("id", id);
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            success: function(value) {
                if (value == 1) {
                    swal({
                        type: 'success',
                        title: 'success',
                        text: 'Profile uploaded..!!',
                    })
                } else if (value == 2) {
                    swal({
                        type: 'info',
                        title: 'info',
                        text: 'Please size is 2 MB..!!',
                    })
                } else {
                    swal({
                        type: 'error',
                        title: 'error',
                        text: 'Something wrong..!!',
                    })
                }
            }
        })
    })

    // preview signature
    $("#signupload").on('change', function() {
        var img = URL.createObjectURL(this.files[0]);
        $("#previewImg").attr("src", img);
        $("#previewImg").show();
    })

    // preview profile
    $("#profile_picture").on('change', function() {
        var img = URL.createObjectURL(this.files[0]);
        $("#previewProfile").attr("src", img);
        $("#previewProfile").show();
    })


    // load dynamic signature
    function load_sign() {
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: {
                "flag": "load_dynamic_data3",
                "id": id
            },
            success: function(val) {
                value = JSON.parse(val);
                if (value.signature != "") {
                    var img = "../assets/img/signature/" + value.signature;
                    $("#previewImg").attr("src", img);
                    $("#previewImg").show();
                } else {
                    $("#previewImg").hide();
                }
            }
        });
    };
    load_sign();

    // load dynamic profile
  function load_profile() {
        $.ajax({
            url: "../assets/server/ajax.php",
            type: "POST",
            data: {
                "flag": "load_dynamic_data4",
                "id": id
            },
            success: function(val) {
                value = JSON.parse(val);
                if (value.profile_picture != "") {
                    var img = "../assets/img/profile/" + value.profile_picture;
                    $("#previewProfile").attr("src", img);
                    $("#previewProfile").show();
                } else {
                    $("#previewProfile").hide();
                }
            }
        });
    };
    load_profile();
    </script>

</body>



</html>