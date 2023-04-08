<?php
require 'connection.php';
session_start();


if(isset($_POST['flag']) and $_POST['flag']=='listview'){
    $_SESSION['listview']=1;
}
if(isset($_POST['flag']) and $_POST['flag']=='gridview'){
    unset($_SESSION['listview']);
}

// timezone functions
function time_Ago($time) {
    $date1 = new DateTime($time, new DateTimeZone('Asia/Kolkata'));
    $date2 = new DateTime();
    $diff = $date2->diff($date1);
    
    $years = $diff->format("%y");
    $months = $diff->format("%m");
    $days = $diff->format("%d");
    $hours = $diff->format("%H");
    $minutes = $diff->format("%I");
    $seconds = $diff->format("%s");
    // $weeks = $diff->format("%u");
    
	if($years != 0) {
		return "$years years ago";
	}
	else if($months != 0) {
		return "$months month ago";
	}
	else if($days != 0) {
		return "$days days ago";
	}
	else if($hours != 0) {
		return "$hours hours ago";
	}
	else if($minutes != 0) {
		return "$minutes minutes ago";
	}
	else if($seconds != 0){
		return "$seconds seconds ago";
    }else{
        return "now";
    }
}

    // pagination
    $limit = 4; 
    $start_from = 1;
    if(isset($_SESSION['start_from'])){
        $start_from = $_SESSION['start_from'];
    }

//get cookie
if(isset($_POST['flag']) and $_POST['flag']=='getCookie')
{
    if(isset($_COOKIE['email']))
    {
        $email=hex2bin($_COOKIE['email']);
        echo $email;
    }
}

// login
if(isset($_POST['flag']) and $_POST['flag']=='login'){
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    if (!$token || $token !== $_SESSION['token']) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pwd =  $_POST['password'];
        $remember = $_POST['remember'];
        $sql = "SELECT * FROM employeetb WHERE email = '" . $email . "' and BINARY password = '" . $pwd . "'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['email'] = bin2hex($email);
                $_SESSION['lock_screen'] = "false";

                if ($remember == 'true') {
                    setcookie('email', bin2hex($email), time() + 86400 * 30, '/');
                }
                while($row = mysqli_fetch_assoc($result)){
                    $_SESSION['name'] = $row['firstname'];
                    $_SESSION['emp_code'] = $row['emp_code'];
                    $_SESSION['role'] = $row['role'];
                    echo $row['role'];
                }
            } else {
                echo 'error';
            }
        }
    }
}

// logout
if (isset($_POST["flag"]) && $_POST["flag"] == "logout") {
    session_destroy();
    echo 'logout';
}

//Signup Register data
if (isset($_POST["flag"]) and $_POST["flag"] == "registerdata") {
    $emp_code = substr(uniqid("emp"), 0, 10);
    $email = mysqli_real_escape_string($conn, $_POST['email_id-field']);
    $fname=mysqli_real_escape_string($conn, $_POST['username-field']);
    $mname = mysqli_real_escape_string($conn, $_POST['middel_name-field']);
    $lname=mysqli_real_escape_string($conn, $_POST['last_name-field']);
    $pass = mysqli_real_escape_string($conn, $_POST['password-field']);
    $fname = $_FILES["customer-image-input"]["name"];


    $sqlcheck = " SELECT * FROM `employeetb` where `email`='{$email}'";
    $result = mysqli_query($conn, $sqlcheck);
    $data=mysqli_fetch_array($result);
    if (!empty($data["email"]))
    {
        if ($data["email"] != $email) 
        {
            if($fname)
            {
                $fileinfo = @getimagesize($_FILES["customer-image-input"]["tmp_name"]);
                $size = $fileinfo['bits'];
                if ($size < 16000000) {
                    $filename   = $_FILES["customer-image-input"]["name"];
                    $extension  = pathinfo($_FILES["customer-image-input"]["name"], PATHINFO_EXTENSION);
                    $basename   = $filename;
                    move_uploaded_file($_FILES['customer-image-input']['tmp_name'], "../img/profile/" . $basename);
                    $sql = "INSERT INTO `employeetb`(`emp_code`, `email`, `password`,`firstname`,`middlename`,`lastname`,`role`) VALUES ('{$emp_code}','{$email}','{$pass}','{$fname}','{$mname}','{$lname}','admin')";
                    $sql2 = "INSERT INTO `emp_extra_infotb`(`emp_code`) VALUES ('{$emp_code}')";
                    $sql3 = "INSERT INTO `emp_personal_infotb`(`emp_code`,`profile_picture`) VALUES ('{$emp_code}','{$basename}')";
                    $res = mysqli_query($conn, $sql);
                    $res2 = mysqli_query($conn, $sql2);
                    $res3 = mysqli_query($conn, $sql3);
                    if ($res && $res2 && $res3) {
                        echo 1;
                        // success
                    }   else{
                        echo 2;
                        // error for register
                    }
                }else{
                    echo 3;
                    // over size
                }
            } else {
                 $sql = "INSERT INTO `employeetb`(`emp_code`, `email`, `password`,`firstname`,`middlename`,`lastname`,`role`) VALUES ('{$emp_code}','{$email}','{$pass}','{$fname}','{$mname}','{$lname}','admin')";
                $sql2 = "INSERT INTO `emp_extra_infotb`(`emp_code`) VALUES ('{$emp_code}')";
                $sql3 = "INSERT INTO `emp_personal_infotb`(`emp_code`) VALUES ('{$emp_code}')";
                $res = mysqli_query($conn, $sql);
                $res2 = mysqli_query($conn, $sql2);
                $res3 = mysqli_query($conn, $sql3);
                if ($res && $res2 && $res3) {
                    echo 1;
                    // success
                }   else{
                    echo 2;
                    // error for register
                }
            }
        }else{
            echo 4;
            // User exist
           
        }
    }
    else
    {
        if($fname)
        {
            $fileinfo = @getimagesize($_FILES["customer-image-input"]["tmp_name"]);
            $size = $fileinfo['bits'];
            if ($size < 16000000) {
                $filename   = $_FILES["customer-image-input"]["name"];
                $extension  = pathinfo($_FILES["customer-image-input"]["name"], PATHINFO_EXTENSION);
                $basename   = $filename;
                move_uploaded_file($_FILES['customer-image-input']['tmp_name'], "../img/profile/" . $basename);
                $sql = "INSERT INTO `employeetb`(`emp_code`, `email`, `password`,`firstname`,`middlename`,`lastname`,`role`) VALUES ('{$emp_code}','{$email}','{$pass}','{$fname}','{$mname}','{$lname}','admin')";
                $sql2 = "INSERT INTO `emp_extra_infotb`(`emp_code`) VALUES ('{$emp_code}')";
                $sql3 = "INSERT INTO `emp_personal_infotb`(`emp_code`,`profile_picture`) VALUES ('{$emp_code}','{$basename}')";
                $res = mysqli_query($conn, $sql);
                $res2 = mysqli_query($conn, $sql2);
                $res3 = mysqli_query($conn, $sql3);
                if ($res && $res2 && $res3) {
                    echo 1;
                    // success
                }   else{
                    echo 2;
                    // error for register
                }
            }else{
                echo 3;
                // over size
            }
        } else {
             $sql = "INSERT INTO `employeetb`(`emp_code`, `email`, `password`,`firstname`,`middlename`,`lastname`,`role`) VALUES ('{$emp_code}','{$email}','{$pass}','{$fname}','{$mname}','{$lname}','admin')";
            $sql2 = "INSERT INTO `emp_extra_infotb`(`emp_code`) VALUES ('{$emp_code}')";
            $sql3 = "INSERT INTO `emp_personal_infotb`(`emp_code`) VALUES ('{$emp_code}')";
            $res = mysqli_query($conn, $sql);
            $res2 = mysqli_query($conn, $sql2);
            $res3 = mysqli_query($conn, $sql3);
            if ($res && $res2 && $res3) {
                echo 1;
                // success
            }   else{
                echo 2;
                // error for register
            }
        }
    }
}

// lockscreen
if (isset($_POST["flag"]) && $_POST["flag"] == "lockscreen") {
    $_SESSION['lock_screen'] = "true";
}

// lockscreen_load
if (isset($_POST["flag"]) && $_POST["flag"] == "lockscreen_load") {
    $email = hex2bin($_SESSION['email']);
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM employeetb WHERE email = '" . $email . "' and password = '" . $pass . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['lock_screen'] = "false";
            echo "valid";
        }
    } else {
        $_SESSION['lock_screen'] = "true";
        echo "invalid";
    }
}


function cnt($pid){
    $obj = array();
    $sql = "SELECT count(*) as cnt FROM task WHERE p_id='{$pid}'";
    $res = mysqli_query(mysqli_connect("localhost","root","","quanta1"),$sql);
    $result = mysqli_num_rows($res);
    if($result>0){
        while($row = mysqli_fetch_assoc($res)){
            $obj['total_task']=$row['cnt'];
        }
    }
    $sql1 = "SELECT count(*) as cnt1 FROM task WHERE p_id='{$pid}' and status='completed'";
    $res1 = mysqli_query(mysqli_connect("localhost","root","","quanta1"),$sql1);
    $result1 = mysqli_num_rows($res1);
    if($result1>0){
        while($row1 = mysqli_fetch_assoc($res1)){
            $obj['total_comp_task']=$row1['cnt1'];
        }
    }
    return $obj;
}

//load Project Data

if (isset($_POST["flag"]) && $_POST["flag"] == "loadProjectData") {
   
        $comp_task = 0;
        $total_task =0;
        $per_total_task =0;
        $cnt = 0;
        $user_icon = '';
        $sql = "SELECT * FROM `projecttb` p,`clienttb` c WHERE p.client_id=c.client_id ";
        $res = mysqli_query($conn, $sql);
    
        $output = "";
        
        $output1 =" <div class='card w-100'>
            
    
        <table class='table table-borderless align-middle mb-0 w-100'>
        <thead class='table-light'>
            <tr>
                <th scope='col'>No.</th>
                <th scope='col'>Project name</th>
                <th scope='col'>Status</th>
                <th scope='col'>Start date</th>
                <th scope='col'>Team</th>
                <th scope='col'>Task</th>
                <th scope='col'>Client name</th>
                <th scope='col'></th>
            </tr>
        </thead>
        <tbody>";
        if ($res) {
            while ($data = mysqli_fetch_assoc($res)) {
                $cnt +=1;
                $user_icon ='';
                $a = cnt($data['project_code']);
                if($a['total_task']==0){
                    $comp_task = 0;
                    $total_task = 0;
                    $per_total_task = 0;
                }else{
                    $comp_task = $a['total_comp_task'];
                    $total_task = $a['total_task'];
                    $per_total_task = round(($a['total_comp_task']/$a['total_task'])*100);
                }
                $sql1 = "select * FROM employeetb e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code in ( select emp_code FROM projectteamtb where project_code='{$data['project_code']}')";
                $res1 = mysqli_query($conn,$sql1);
                $result1 = mysqli_num_rows($res1);
                if($result1>0){
                    while($data1 = mysqli_fetch_assoc($res1)){
                       
                        if($data1['profile_picture'] == ''){
                            $user_icon .= "
                            <a href='javascript: void(0);' class='avatar-group-item '   data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='{$data1['firstname']}' >
                                    <div class='avatar-xxs'>
                                    <img src='../assets/img/profile/proc.jpg' alt=''
                                            class='rounded-circle img-fluid'>
                                    </div>
                                </a>
                            ";
                        }else{
                            $user_icon .= "
                            <a href='javascript: void(0);' class='avatar-group-item' data-bs-toggle='tooltip'
                                    data-bs-trigger='hover' data-bs-placement='top' title='{$data1['firstname']}'>
                                    <div class='avatar-xxs'>
                                        <img src='../assets/img/profile/{$data1['profile_picture']}' alt=''
                                            class='rounded-circle img-fluid'>
                                    </div>
                                </a>
                            ";
                        }
                    }
                }else{
                    $user_icon ='';
                }

                if($data['status']=='started'){
                    $signal = 'primary';
                }
                else if($data['status']=='onhold'){
                    $signal = 'warning';
                }
                else if($data['status']=='inprogress'){
                    $signal = 'info';
                }
                else if($data['status']=='cancelled'){
                    $signal = 'danger';
                }
                else if($data['status']=='completed'){
                    $signal = 'success';
                }
                else if($data['status']=='deffered'){
                    $signal = 'secondary';
                }
               
                $output .= "
                <div class='col  project-card'>
            <div class='card'>
                <div class='card-body'>
                    <div class='p-3 mt-n3 mx-n3 bg-soft-warning rounded-top'>
                        <div class='d-flex align-items-center'>
                            <div class='flex-grow-1'>
                                <h2 class='mb-0 fs-17'><a href='#'
                                        class='text-dark redirect_overview_page' id='{$data['project_code']}'>{$data['project_name']}</a></h2>
                            </div>
                            <div class='flex-shrink-0'>
                                <a href='javascript:void(0);' class='text-muted' id='dropdownMenuLink4' data-bs-toggle='dropdown' aria-expanded='false'><i class='ri-more-fill'></i></a>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenuLink4'>
                                
                                    <li> <a class='dropdown-item edit_project_btn'  data-bs-toggle='modal' href='#' id='{$data['project_code']}'><i
                                    class='ri-edit-2-line align-bottom me-2 text-dark ' 
                                    ></i>
                                Edit</a></li>
                                    <li><a class='dropdown-item delete-project' data-bs-toggle='modal' href='#deleteRecordModal' id='{$data['project_code']}'><i
                                    class='ri-delete-bin-5-line align-bottom me-2 text-dark'></i>
                                Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class='py-3'>
                        <div class='row gy-3'>
                            <div class='col-6'>
                                <div>
                                    <p class='text-muted mb-1'>Status</p>
                                    <div class='badge badge-soft-{$signal} fs-12'>{$data['status']}</div>
                                </div>
                            </div>
                            <div class='col-6'>
                                <div>
                                    <p class='text-muted mb-1'>Start Date</p>
                                    <h5 class='fs-14'>{$data['start_date']}</h5>
                                </div>
                            </div>
                        </div>
                        

                        <div class='d-flex align-items-center mt-3'>
                                <p class='text-muted mb-0 me-2'>Team :</p>
                                    <div class='avatar-group'>
                                        {$user_icon}
                                        <a href='javascript: void(0);' class='avatar-group-item addEmpToProjTeam' data-bs-toggle='tooltip'
                                            data-bs-trigger='hover' data-bs-placement='top' title='Add Members' id='{$data['project_code']}'>
                                            <div class='avatar-xxs'>
                                                <div
                                                    class='avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary'>
                                                    +
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            </div>
                        
                    </div>

                    <div class='mt-auto'>
                        <div class='d-flex mb-2'>
                            <div class='flex-grow-1'>
                                <div>Tasks</div>
                            </div>
                            <div class='flex-shrink-0'>
                                <div><i class='ri-list-check align-bottom me-1 text-muted'></i>
                                    {$comp_task }/{$total_task}</div>
                            </div>
                        </div>
                        <div class='progress progress-sm animated-progress'>
                            <div class='progress-bar bg-success' role='progressbar'
                                aria-valuemin='0' aria-valuemax='100'
                                style='width: {$per_total_task}%;'></div>
                        </div>
                    </div>

                </div>
                <!-- end card body -->

                <div class='card-footer bg-transparent border-top-dashed py-2'>
                    <div class='d-flex align-items-center'>
                        <div class='flex-grow-1'>
                            
                        </div>
                        <div class='flex-shrink-0'>
                            <div class='text-muted'>
                               By , {$data['client_name']}
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
                ";  

                $output1.="
                <tr>
                    <td>{$cnt}</td>
                    <td><a href='#'
                    class='text-dark redirect_overview_page' id='{$data['project_code']}'>{$data['project_name']}</a></td>
                    <td><div class='badge badge-soft-{$signal} fs-12'>{$data['status']}</div></td>
                    <td>{$data['start_date']}</td>
                    <td><div class='avatar-group'>
                    {$user_icon}
                    <a href='javascript: void(0);' class='avatar-group-item addEmpToProjTeam' data-bs-toggle='tooltip'
                        data-bs-trigger='hover' data-bs-placement='top' title='Add Members' id='{$data['project_code']}'>
                        <div class='avatar-xxs'>
                            <div
                                class='avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary'>
                                +
                            </div>
                        </div>
                    </a>
                </div>
                </td>
                    <td><div class='mt-auto'>
                    <div class='d-flex mb-2'>
                        <div class='flex-grow-1'>
                            <div>Tasks</div>
                        </div>
                        <div class='flex-shrink-0'>
                            <div><i class='ri-list-check align-bottom me-1 text-muted'></i>
                                {$comp_task }/{$total_task}</div>
                        </div>
                    </div>
                    <div class='progress progress-sm animated-progress'>
                        <div class='progress-bar bg-success' role='progressbar'
                            aria-valuemin='0' aria-valuemax='100'
                            style='width: {$per_total_task}%;'></div>
                    </div>
                </div></td>
                    <td>{$data['client_name']}</td>
                    <td><div class='flex-shrink-0'>
                    <a href='javascript:void(0);' class='text-muted' id='dropdownMenuLink4' data-bs-toggle='dropdown' aria-expanded='false'><i class='ri-more-fill'></i></a>
                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuLink4'>
                    
                        <li> <a class='dropdown-item edit_project_btn'  data-bs-toggle='modal' href='#' id='{$data['project_code']}'><i
                        class='ri-edit-2-line align-bottom me-2 text-dark ' 
                        ></i>
                    Edit</a></li>
                        <li><a class='dropdown-item delete-project' data-bs-toggle='modal' href='#deleteRecordModal' id='{$data['project_code']}'><i
                        class='ri-delete-bin-5-line align-bottom me-2 text-dark'></i>
                    Delete</a></li>
                    </ul>
                </div></td>
                </tr>
                ";
               
            }
            $output1 .= "</tbody></table></div>";
            if(isset($_SESSION['listview'])){
                echo $output1;
            }else{
                echo $output;
            }
        }
}


if (isset($_POST["flag"]) && $_POST["flag"] == "test_table") {
   
    $comp_task = 0;
    $total_task =0;
    $per_total_task =0;
    $cnt = 0;
    $user_icon = '';
    $sql = "SELECT * FROM `projecttb` p,`clienttb` c WHERE p.client_id=c.client_id ";
    $res = mysqli_query($conn, $sql);
    $myobj = (object)[];
    $output = "";
    $myarr = array();
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $cnt +=1;
            $user_icon ='';
            $a = cnt($data['project_code']);
            if($a['total_task']==0){
                $comp_task = 0;
                $total_task = 0;
                $per_total_task = 0;
            }else{
                $comp_task = $a['total_comp_task'];
                $total_task = $a['total_task'];
                $per_total_task = round(($a['total_comp_task']/$a['total_task'])*100);
            }
            $sql1 = "select * FROM employeetb e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code in ( select emp_code FROM projectteamtb where project_code='{$data['project_code']}')";
            $res1 = mysqli_query($conn,$sql1);
            $result1 = mysqli_num_rows($res1);
            if($result1>0){
                while($data1 = mysqli_fetch_assoc($res1)){
                   
                    if($data1['profile_picture'] == ''){
                        $user_icon .= "
                        <a href='javascript: void(0);' class='avatar-group-item '   data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='{$data1['firstname']}' >
                                <div class='avatar-xxs'>
                                <img src='../assets/img/profile/proc.jpg' alt=''
                                        class='rounded-circle img-fluid'>
                                </div>
                            </a>
                        ";
                    }else{
                        $user_icon .= "
                        <a href='javascript: void(0);' class='avatar-group-item' data-bs-toggle='tooltip'
                                data-bs-trigger='hover' data-bs-placement='top' title='{$data1['firstname']}'>
                                <div class='avatar-xxs'>
                                    <img src='../assets/img/profile/{$data1['profile_picture']}' alt=''
                                        class='rounded-circle img-fluid'>
                                </div>
                            </a>
                        ";
                    }
                }
            }else{
                $user_icon ='';
            }

            if($data['status']=='started'){
                $signal = 'primary';
            }
            else if($data['status']=='onhold'){
                $signal = 'warning';
            }
            else if($data['status']=='inprogress'){
                $signal = 'info';
            }
            else if($data['status']=='cancelled'){
                $signal = 'danger';
            }
            else if($data['status']=='completed'){
                $signal = 'success';
            }
            else if($data['status']=='deffered'){
                $signal = 'secondary';
            }
            
            $myobj->cnt = $cnt;
            $myobj->name = "<a href='#' class='text-dark redirect_overview_page' id='{$data['project_code']}'>{$data['project_name']}</a>";
            $myobj->status = "<div class='badge badge-soft-{$signal} fs-12'>{$data['status']}</div>";
            $myobj->edate = $data['end_date'];
            $myobj->members = "<div class='avatar-group'>{$user_icon}<a href='javascript: void(0);' class='avatar-group-item addEmpToProjTeam' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Add Members' id='{$data['project_code']}'><div class='avatar-xxs'><div class='avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary'>+</div></div></a></div>";
            $myobj->task = "<div class='mt-auto'><div class='d-flex mb-2'><div class='flex-grow-1'><div>Tasks</div></div><div class='flex-shrink-0'><div><i class='ri-list-check align-bottom me-1 text-muted'></i>{$comp_task }/{$total_task}</div></div>
            </div><div class='progress progress-sm animated-progress'><div class='progress-bar bg-success' role='progressbar' aria-valuemin='0' aria-valuemax='100' style='width: {$per_total_task}%;'></div></div></div>";
            $myobj->client = $data['client_name'];
            $myobj->detail = "<div class='flex-shrink-1'><a href='javascript:void(0);' class='text-muted' id='dropdownMenuLink4' data-bs-toggle='dropdown' aria-expanded='false'><i class='ri-more-fill'></i></a><ul class='dropdown-menu' aria-labelledby='dropdownMenuLink4'><li> <a class='dropdown-item edit_project_btn'  data-bs-toggle='modal' href='#' id='{$data['project_code']}'><i class='ri-edit-2-line align-bottom me-2 text-dark'></i>Edit</a></li><li><a class='dropdown-item delete-project' data-bs-toggle='modal' href='#deleteRecordModal' id='{$data['project_code']}'><i class='ri-delete-bin-5-line align-bottom me-2 text-dark'></i>Delete</a></li></ul></div>";
            
            array_push($myarr,$myobj);
            $myobj = (object)[];
        }
        echo json_encode($myarr);
    }
}

//load Project Data on dashboard
if (isset($_POST["flag"]) && $_POST["flag"] == "test_table2") {
    $cnt1 = 0;
    $comp_task = 0;
    $total_task =0;
    $per_total_task =0;
    $user_icon = '';
    $sql = "SELECT * FROM `projecttb` p,`clienttb` c WHERE p.client_id=c.client_id ";
    $res = mysqli_query($conn, $sql);
    $myobj = (object)[];
    $output = "";
    $myarr = array();
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $cnt1 +=1;
            $user_icon ='';
            $user_icon1 ='';
            $chk_lead = 0;
            $a = cnt($data['project_code']);
            if($a['total_task']==0){
                $comp_task = 0;
                $total_task = 0;
                $per_total_task = 0;
            }else{
                $comp_task = $a['total_comp_task'];
                $total_task = $a['total_task'];
                $per_total_task = round(($a['total_comp_task']/$a['total_task'])*100);
            }

            $sql1="SELECT DISTINCT * FROM `employeetb` e,emp_personal_infotb ep,projectteamtb p WHERE `role`!='admin'  and ep.emp_code=e.emp_code and e.emp_code=p.emp_code AND p.project_code='{$data['project_code']}'";

            $res1 = mysqli_query($conn,$sql1);
            $result1 = mysqli_num_rows($res1);
            if($result1>0){
                while($data1 = mysqli_fetch_assoc($res1)){
                   if($data1['isTeamLeader']){
                    $chk_lead =1;
                        if($data1['profile_picture'] == '')
                        {
                            $user_icon1 .= "<img src='../assets/img/profile/proc.jpg' width='25px' class='rounded-circle img-fluid'><span class='text-reset mx-2'>{$data1['firstname']}</span>";
                        }else{
                            $user_icon1 .= "<img src='../assets/img/profile/{$data1['profile_picture']}' width='25px' class='rounded-circle img-fluid'><span class='text-reset mx-2'>{$data1['firstname']}</span>";
                        }
                    }
                    
                    
                    else{
                        if($data1['profile_picture'] == ''){
                            $user_icon .= "
                            <a href='javascript: void(0);' class='avatar-group-item '  data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='{$data1['firstname']}' > <div class='avatar-xxs'><img src='../assets/img/profile/proc.jpg' alt='' class='rounded-circle img-fluid'></div></a>";
                        }else{
                            $user_icon .= "
                            <a href='javascript: void(0);' class='avatar-group-item' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='{$data1['firstname']}'><div class='avatar-xxs'><img src='../assets/img/profile/{$data1['profile_picture']}' alt='' class='rounded-circle img-fluid'></div></a>";
                        }
                    }
                }
            }else{
                $user_icon ='';
            }

            if($chk_lead==0){
                    $user_icon1 .= "
                            <a href='javascript: void(0);' data-bs-toggle='modal' data-bs-target='#addManagerToProject' class='avatar-group-item addLeaderToProjTeam' data-bs-toggle='tooltip'
                    data-bs-trigger='hover' data-bs-placement='top' title='Add Members' id='{$data['project_code']}'>
                    <div class=' d-flex'>
                        <div class='avatar-xxs'>
                            <div
                                class='avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary'>
                                +
                            </div>
                        </div>
                        <div class='mx-1 mt-1'>
                            Add leader
                        </div>
                    </div>
                </a>
                    ";
            }

            if($data['status']=='started'){
                $signal = 'primary';
            }
            else if($data['status']=='onhold'){
                $signal = 'warning';
            }
            else if($data['status']=='inprogress'){
                $signal = 'info';
            }
            else if($data['status']=='cancelled'){
                $signal = 'danger';
            }
            else if($data['status']=='completed'){
                $signal = 'success';
            }
            else if($data['status']=='deffered'){
                $signal = 'secondary';
            }
            
            $myobj->cnt = $cnt1;
            $myobj->name = "<a href='#' class='text-dark redirect_overview_page' id='{$data['project_code']}'>{$data['project_name']}</a>";
            $myobj->status = "<div class='badge badge-soft-{$signal} fs-12'>{$data['status']}</div>";
            $myobj->edate = $data['end_date'];
            $myobj->members = "<div class='avatar-group'>{$user_icon}<a href='javascript: void(0);' class='avatar-group-item addEmpToProjTeam' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='Add Members' id='{$data['project_code']}'><div class='avatar-xxs'><div class='avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary'>+</div></div></a></div>";
            $myobj->Progress = "<div class='d-flex align-items-center'><div class='flex-shrink-0 me-1 text-muted fs-13'>{$per_total_task}%</div><div class='progress progress-sm  flex-grow-1' style='width: 68%;'><div class='progress-bar bg-primary rounded' role='progressbar' style='width: {$per_total_task}%' aria-valuenow='{$per_total_task}' aria-valuemin='0' aria-valuemax='100'></div></div></div>";
            $myobj->plead = $user_icon1;
            
            array_push($myarr,$myobj);
            $myobj = (object)[];
            
        }
        echo json_encode($myarr);
    }
}


//load client into project insert
if (isset($_POST["flag"]) and $_POST["flag"] == "loadClientDataInpro") {
    $sql = "SELECT * FROM `clienttb`";
    $res = mysqli_query($conn, $sql);
    $output = "<option value=''>Select Client </option>";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output .= "
					<option value='{$data['client_id']}'>{$data['client_name']}</option>
                  ";
        }
        echo $output;
    } else {
        echo 0;
    }
}

//insert project
if (isset($_POST["flag"]) and $_POST["flag"] == "insertProj") {
    $id=substr(uniqid("p"), 0, 10);
    $p_title=mysqli_real_escape_string($conn, $_POST['project_title']);
    $p_status=mysqli_real_escape_string($conn, $_POST['project_status']);
    $p_sdate=mysqli_real_escape_string($conn, $_POST['project_sdate']);
    $p_edate=mysqli_real_escape_string($conn, $_POST['project_deadline']);
    $p_desc=mysqli_real_escape_string($conn, $_POST['project_desc']);
    $p_client=mysqli_real_escape_string($conn, $_POST['clientdata']);
    
    $sql = "INSERT INTO `projecttb`(`project_id`, `project_name`, `status`, `start_date`, `end_date`,  `project_desc`, `client_id`) VALUES ('{$id}','{$p_title}','{$p_status}','{$p_sdate}','{$p_edate}','{$p_desc}','{$p_client}')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $sql1 = "select project_code from `projecttb` where `project_id`='{$id}'";
        $res1 = mysqli_query($conn, $sql1);
        while($row1=mysqli_fetch_assoc($res1)){
            $pid = $row1['project_code'];
        }
        $eid = $_SESSION['emp_code'];
        foreach ($_FILES['project_files']['tmp_name'] as $key => $value) { 
            if($_FILES['project_files']['name'][$key]!=''){
                $file_name  = $_FILES['project_files']['name'][$key];
                $file_type = explode(".",$_FILES['project_files']['name'][$key]);
                $file_tmp   = $_FILES['project_files']['tmp_name'][$key];
            
                $file_size  = round(($_FILES["project_files"]["size"][$key]/8000000),3);
                $ftype = $file_type[1] . " File";
            
                $file_size  .= " MB";
                
                $file_target = '../img/Project_files/'. $file_name;
                $check = move_uploaded_file($file_tmp, $file_target);
                
                $sql = "INSERT INTO `filetb`( `p_id`, `e_id`, `file_name`, `type`, `size`) VALUES ('{$pid}','{$eid}','{$file_name}','{$ftype}','{$file_size}')";
                $res = mysqli_query($conn,$sql);
            }               
        }    
    } else {
        echo 0;
    }
}


//del project
if (isset($_POST['flag']) && $_POST['flag'] == 'delProjectData') {
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $sql = "DELETE FROM `projecttb` WHERE project_code='{$id}'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}

// load project data in chart
if(isset($_POST['flag']) and $_POST['flag']=='load_chart_data_status'){
    $status = $_POST['status'];
    $sql = "SELECT COUNT(*) as cnt FROM `projecttb` WHERE status='{$status}'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0)
    {
        while($row = mysqli_fetch_assoc($res)){
            echo $row['cnt'];
        }
    }
}


// session of edit project clear
if(isset($_POST['flag']) and $_POST['flag']=='clear_session_id'){
    unset($_SESSION['edit_project_id']);
    if(!isset($_SESSION['edit_project_id'])){
        echo 1;
    }
} 

//load project data on project edit
if (isset($_POST['flag']) and $_POST['flag'] == 'load_project_edit_data') {
    $id = $_POST['id'];
    $_SESSION['edit_project_id']=$id;
    echo 1;
}
if (isset($_POST['flag']) and $_POST['flag'] == 'load_dynamic_edit_project_data') {
    // $id = $_POST['id'];
    if(isset($_SESSION['edit_project_id'])){
        $id=$_SESSION['edit_project_id'];
        $sql = "SELECT * FROM `projecttb` WHERE project_code='{$id}'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        echo json_encode($row);
    }
}
if (isset($_POST['flag']) and $_POST['flag'] == 'Update_project_data') {
    // $id = $_POST['id'];
    if(isset($_SESSION['edit_project_id'])){
        $id=$_SESSION['edit_project_id'];
        $p_title=mysqli_real_escape_string($conn, $_POST['project_title']);
        $p_status=mysqli_real_escape_string($conn, $_POST['project_status']);
        $p_sdate=mysqli_real_escape_string($conn, $_POST['project_sdate']);
        $p_edate=mysqli_real_escape_string($conn, $_POST['project_deadline']);
        $p_desc=mysqli_real_escape_string($conn, $_POST['project_desc']);
        $p_client=mysqli_real_escape_string($conn, $_POST['clientdata']);

        $sql = "UPDATE `projecttb` SET `project_name`='{$p_title}',`status`='{$p_status}',`start_date`='{$p_sdate}',`end_date`='{$p_edate}',`project_desc`='{$p_desc}',`client_id`='{$p_client}' WHERE `project_code`='{$id}'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
           
            $eid = $_SESSION['emp_code'];
            foreach ($_FILES['project_files']['tmp_name'] as $key => $value) { 
                if($_FILES['project_files']['name'][$key]!=''){
                    $file_name  = $_FILES['project_files']['name'][$key];
                    $file_type = explode(".",$_FILES['project_files']['name'][$key]);
                    $file_tmp   = $_FILES['project_files']['tmp_name'][$key];
                
                    $file_size  = round(($_FILES["project_files"]["size"][$key]/8000000),3);
                    $ftype = $file_type[1] . " File";
                
                    $file_size  .= " MB";
                    
                    $file_target = '../img/Project_files/'. $file_name;
                    $check = move_uploaded_file($file_tmp, $file_target);
                    
                    $sql = "INSERT INTO `filetb`( `p_id`, `e_id`, `file_name`, `type`, `size`) VALUES ('{$id}','{$eid}','{$file_name}','{$ftype}','{$file_size}')";
                    $res = mysqli_query($conn,$sql);
                }               
            }    
        } else {
            echo 0;
        }
    }
}

// =====================================================================================7/feb/2023




//load Client Name in Project edit
if (isset($_POST["flag"]) && $_POST["flag"] == "loadClientNameProjectEdit") {
    $sql = "select * from clienttb";
    $res = mysqli_query($conn, $sql);
    $output = "<option value='' selected >None</option>";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output .= "
                    <option value='{$data['client_id']}'>{$data['client_name']}</option>
                  ";
        }
        echo $output;
    } else {
        echo 0;
    }
}


//update basic information in project edit 
if(isset($_POST['flag'])&& $_POST['flag']=='basic_info') {
    $id=$_POST['id'];
    $client_id=$_POST['cname'];
    $proj_name=$_POST['pname'];
    $proj_status=$_POST['pstatus'];
    $s_date=$_POST['pStartDate'];
    $e_date=$_POST['pEndDate'];

    $sql="UPDATE `projecttb` SET `client_id`='{$client_id}',`project_name`='{$proj_name}',`status`='{$proj_status}',`start_date`='{$s_date}',`end_date`='{$e_date}' WHERE project_code='{$id}' ";
    $res=mysqli_query($conn,$sql);

    if($res)
    {
        echo 1;
    }else{
        echo 0;
    }
}

//update advance Option information in project edit 
if(isset($_POST['flag'])&& $_POST['flag']=='advanceOption_info') {
    $id=$_POST['id'];
    $duration=$_POST['duration'];
    $cost=$_POST['cost'];
    $sql="UPDATE `projecttb` SET `duration`='{$duration}',`estimate_cost`='{$cost}' WHERE project_code='{$id}' ";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        echo 1;
    }else{
        echo 0;
    }
}

//load team leader in project edit
// if(isset($_POST['flag']) and $_POST['flag']=="load_leader_projEdit")
// {
//     $pid=$_POST['pid'];
//     $sql="SELECT p.*,e.firstname FROM `projectteamtb` p,`employeetb` e WHERE project_code='{$pid}' AND isTeamLeader=TRUE AND p.emp_code=e.emp_code";
//     $res=mysqli_query($conn,$sql);
//     if(mysqli_num_rows($res)==1)
//     {
//         $data=mysqli_fetch_assoc($res);
//         echo json_encode($data);
//     }
// }


//update attchments information in project edit 
if(isset($_POST['flag'])&& $_POST['flag']=='attachments_information') {
    $id=$_POST['id'];
    $attchmentname = $_POST['attach'];
    $file =$_FILES["Fpath"]["name"];
    if(!empty($file) and !empty($attchmentname))
    {
        $filename   = $attchmentname; 
        $extension  = pathinfo( $file, PATHINFO_EXTENSION );
        $basename   = $filename . "." . $extension; 
        if(move_uploaded_file($_FILES['Fpath']['tmp_name'], "../img/projectAttachments/" . $basename))
        {
            $sql="UPDATE `projecttb` SET `attach_name`='{$attchmentname}',`file_name`='{$basename}' WHERE project_code='{$id}' ";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    else if(!empty($attchmentname))
    {
        $sql="UPDATE `projecttb` SET `attach_name`='{$attchmentname}' WHERE project_code='{$id}' ";
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            echo 1;
        }else{
            echo 0;
        }
    }
}

//update other information of project
if(isset($_POST['flag']) and $_POST['flag']=="addOtherInfo")
{
    $pid=$_POST['id'];
    $proj_desc=$_POST['pDesc'];
    $proj_type=$_POST['ptype'];
    $client_dept=$_POST['clientDept'];
    $Timesheet=$_POST['Timesheet'];
    $expense=$_POST['expense'];
    $ptid=$_POST['Pmanager'];
    $is_disable=$_POST['isCom'];
    if($is_disable=="TRUE")
    {
        $sql="UPDATE `projecttb` SET `project_desc`='{$proj_desc}',`project_type`='{$proj_type}',`timesheet_approval`='{$Timesheet}',`expense_approval`='{$expense}',`isActive`=TRUE,`client_dept`='{$client_dept}' WHERE `project_code`='{$pid}'";
    }
    else{
        $sql="UPDATE `projecttb` SET `project_desc`='{$proj_desc}',`project_type`='{$proj_type}',`timesheet_approval`='{$Timesheet}',`expense_approval`='{$expense}',`isActive`=FALSE,`client_dept`='{$client_dept}' WHERE `project_code`='{$pid}'";
    }
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        $sql1="UPDATE `projectteamtb` SET `isTeamLeader`=FALSE WHERE project_code='{$pid}'";
        $res1=mysqli_query($conn,$sql1);
        $sql2="UPDATE `projectteamtb` SET `isTeamLeader`=TRUE WHERE id='{$ptid}'";
        $res2=mysqli_query($conn,$sql2);
        if($res2)
        {
            echo 1;
        }
    }
}


// country data
if(isset($_POST['flag']) and $_POST['flag']=='load_country'){
    $output = '<option value="">Select country</option>';
    $sql = "SELECT * FROM `country`";
    $res = mysqli_query($conn1,$sql);
    $cnt = mysqli_num_rows($res);
    if($cnt>0){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "<option value='{$row['C_id']}' id='{$row['C_id']}'>{$row['C_name']}</option>";
        }
    }
    echo $output;
}


if(isset($_POST['flag']) and $_POST['flag']=='load_city'){
    $city_id = mysqli_real_escape_string($conn,$_POST['id']);
    $output = '<option value="">Select </option>';
    $sql = "SELECT * FROM `city` WHERE `S_id`='$city_id'";
    $res = mysqli_query($conn1,$sql);
    $cnt = mysqli_num_rows($res);
    if($cnt>0){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "<option value='{$row['City_id']}' id='{$row['City_id']}'>{$row['C_name']}</option>";
        }
    }
    echo $output;
}

if(isset($_POST['flag']) and $_POST['flag']=='load_state'){
    $c_id = mysqli_real_escape_string($conn,$_POST['id']);
    $output = '<option value="">Select </option>';
    $sql = "SELECT * FROM `state` WHERE `C_id`='$c_id'";
    $res = mysqli_query($conn1,$sql);
    $cnt = mysqli_num_rows($res);
    if($cnt>0){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "<option value='{$row['S_id']}' id='{$row['S_id']}'>{$row['S_name']}</option>";
        }
    }
    echo $output;
}

// load manager
if(isset($_POST['flag']) and $_POST['flag']=='load_manager'){
    $empId=mysqli_real_escape_string($conn,$_POST['id']);
    $sql1="SELECT dept_id FROM `employeetb` WHERE `emp_code`='{$empId}'";
    $res1 = mysqli_query($conn,$sql1);
    $data = mysqli_fetch_assoc($res1);
    $deptId=mysqli_real_escape_string($conn,$data['dept_id']);
    $output = "<option value='none'>None</option>";
    $sql="SELECT * FROM `employeetb` WHERE `role`='manager' AND `dept_id`={$deptId}";
    $res = mysqli_query($conn,$sql);
    $cnt = mysqli_num_rows($res);
    if($cnt>0){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "<option value='{$row['firstname']}'>{$row['firstname']}</option>";
        }
    }
    echo $output;   
}


// load_events for calendar
if(isset($_POST['flag']) and $_POST['flag']=='load_events'){
    $sql="SELECT * FROM `calendar`";
    $res= mysqli_query($conn,$sql);
    $output="";
    while($row = mysqli_fetch_object($res)){
        $output.=json_encode($row)."*";
    }
    echo $output;
}


// delete for event
if(isset($_POST['flag']) and $_POST['flag']=='delete_event'){
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $sql="DELETE FROM `calendar` WHERE `title`='{$title}'";
    $res= mysqli_query($conn,$sql);
    if($res){
        echo 1;
    }else{
        echo 0;
    }
}


// unique_title for event
if(isset($_POST['flag']) and $_POST['flag']=='unique_title'){
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $sql="SELECT * FROM `calendar` WHERE `title`='{$title}'";
    $res= mysqli_query($conn,$sql);
    $result = mysqli_num_rows($res);
    if($result>0){
        echo 1;
    }else{ 
        echo 0;
    }
}

// update event
if(isset($_POST['flag']) and $_POST['flag']=='update_event'){
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $sql="SELECT * FROM `calendar` WHERE `title`='{$title}'";
    $res= mysqli_query($conn,$sql);
    $result = mysqli_num_rows($res);
    if($result>0){
        while($row = mysqli_fetch_assoc($res)){
            $id=$row['id'];

            $title=$_POST['title'];
            $eventLabel=$_POST['category'];
            $eventStartDate=$_POST['eventStartDate'];
            $eventEndDate=$_POST['eventEndDate'];
            $allday=$_POST['allday'];
            // $eventURL=$_POST['eventURL'];
            $eventLocation=$_POST['event-location'];
            $eventDescription=$_POST['event-description'];

            if(empty($title) || empty($eventStartDate) || empty($eventEndDate))
            {
                echo "Please enter data";
            }else{
                // if(empty($eventURL))
                // {
                //     $eventURL=NULL;
                // }
                if(empty($eventLocation))
                {
                    $eventLocation=NULL;
                }
                if(empty($eventDescription))
                {
                    $eventDescription=NULL;
                }
        
                $sql1="UPDATE `calendar` SET `title`='{$title}',`start`='{$eventStartDate}',`end`='{$eventEndDate}',`extendedProps`='{$eventLabel}',`allDay`='{$allday}',`location`='{$eventLocation}',`description`='{$eventDescription}' WHERE `id`='{$id}'";
                $res1= mysqli_query($conn,$sql1);
                if($res1){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }
}


// add event
if(isset($_POST['flag']) and $_POST['flag']=='addEvent'){
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $eventLabel=mysqli_real_escape_string($conn,$_POST['category']);
    $eventStartDate=mysqli_real_escape_string($conn,$_POST['eventStartDate']);
    $eventEndDate=mysqli_real_escape_string($conn,$_POST['eventEndDate']);
    $allday=mysqli_real_escape_string($conn,$_POST['allday']);
    // $eventURL=mysqli_real_escape_string($conn,$_POST['eventURL']);
    $eventLocation=mysqli_real_escape_string($conn,$_POST['event-location']);
    $eventDescription=mysqli_real_escape_string($conn,$_POST['event-description']);
    if(empty($title) || empty($eventStartDate) || empty($eventEndDate))
    {
        echo "Please enter data";
    }else{
        // if(empty($eventURL))
        // {
        //     $eventURL=NULL;
        // }
        if(empty($eventLocation))
        {
            $eventLocation=NULL;
        }
        if(empty($eventDescription))
        {
            $eventDescription=NULL;
        }
        $sql="INSERT INTO `calendar`( `title`, `start`, `end`, `extendedProps`, `allDay`, `location`, `description`) VALUES ('{$title}','{$eventStartDate}','{$eventEndDate}','{$eventLabel}','{$allday}','{$eventLocation}','{$eventDescription}')";
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }
}


// birthday loading
if(isset($_POST['flag']) and $_POST['flag']=='load_birthdate'){
    $output = "
    ";
    $chk =0;

    $sql = "SELECT e.firstname as fname,e1.emp_birthdate as bdate,e2.profile_picture as eprof FROM `employeetb` e,emp_extra_infotb e1,emp_personal_infotb e2 where e.emp_code=e1.emp_code and e.emp_code = e2.emp_code and  DATE_FORMAT(e1.emp_birthdate,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')";
    $res= mysqli_query($conn,$sql);
    $result = mysqli_num_rows($res);
    $i=1;
    $user_icon = "";
    $act = "";
    if($result>0){
        while($row = mysqli_fetch_assoc($res)){
            if($row['eprof'] == ''){
                $user_icon .= "<img src='../assets/img/profile/proc.jpg' alt=''
                                class='avatar-sm object-cover rounded'>";
            }else{
                $user_icon .= "<img src='../assets/img/profile/{$row['eprof']}' alt=''
                            class='avatar-sm object-cover rounded'>";
            }
            if($i==1){
                $act = "active";
            }else{
                $act = "";
            }
            $i += 2;
                $output .="
                <div class='carousel-item {$act}'  data-bs-interval='3000'>
                    <div class='d-flex'>
                        <div class='flex-shink-0'>
                            {$user_icon}
                        </div>
                        <div class='ms-3 flex-grow-1'>
                            <a href='pages-profile.html'>
                                <h5 class='mb-1'>{$row['fname']}</h5>
                            </a>
                            <p class='text-muted mb-0'>Happy birthday ..🎂🎊🎈🥳</p>
                        </div>
                    </div>
                </div>
                ";
                
                $chk =1 ;
                $user_icon ="";
        }
    }
    if($chk == 1){
        $output.="";
        echo $output;
    }else{
        echo 1;
    }
}

// event loading
if(isset($_POST['flag']) and $_POST['flag']=='load_event'){
    $output = "";
    $sql = "SELECT * FROM `calendar` WHERE start >=CURRENT_DATE";
    $res= mysqli_query($conn,$sql);
    $result = mysqli_num_rows($res);
    if($result>0){
        $output = "<div class='card-body overflow-auto' data-simplebar data-simplebar-track='dark' style='height: 250px;'><ul class='list-group list-group-flush border-dashed'>";
        while($row = mysqli_fetch_assoc($res)){
                $mydate=getdate(date(strtotime($row['start'])));
                $eday = "$mydate[weekday]";
                switch($eday){
                    case "Sunday":
                        $eday1 = "Sun";
                        break;
                    case "Monday":
                        $eday1 = "Mon";
                        break;
                    case "Tuesday":
                        $eday1 = "Tue";
                        break;
                    case "Wednesday":
                        $eday1 = "Wed";
                        break;
                    case "Thursday":
                        $eday1 = "Thu";
                        break;
                    case "Friday":
                        $eday1 = "Fri";
                        break;
                    case "Saturday":
                        $eday1 = "Sat";
                        break;
                }
                $edate = "$mydate[mday]";
                $output .= "
                <li class='list-group-item ps-0'>
                            <div class='row align-items-center g-3'>
                                <div class='col-auto'>
                                    <div class='avatar-sm p-1 py-2 h-auto bg-light rounded-3'>
                                        <div class='text-center'>
                                            <h5 class='mb-0'>{$edate}</h5>
                                            <div class='text-muted'>{$eday1}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col'>
                                    <h5 class='text-muted mt-0 mb-1 fs-13'>{$row['title']}</h5>
                                    <a href='#' class='text-reset fs-14 mb-0'>{$row['description']}</a>
                                </div>
                            </div>
                        </li>
                        ";
                
            }
            $output .="</ul></div>";
    }else{
        $output .="
        <div class='card-body d-flex justify-content-center' style='height: 250px;' >
            <div class='mt-4'>
                <img src='../assets/GIF/no-events.gif' width='120px'>
                <h4>No events..!!</h4>
            </div>
        </div>
        ";
    }
    echo $output;
}



//load employee data in add project team
if (isset($_POST["flag"]) and $_POST["flag"] == "loadEmployeeData") {
    // if(isset($_POST['row_no']))
    // {
        // $row=$_POST['row_no'];
        // $row=($row-1)* $limit;
        $taskId=$_POST['tid'];
        $sql="SELECT `p_id` FROM `task` WHERE `id`='{$taskId}'";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)==1)
        {
            $data=mysqli_fetch_assoc($res);

            $projectId=$data['pid'];
            $sql = "SELECT DISTINCT e.emp_code,d.name,d.location,e.firstname,e.email FROM `employeetb` e,`departmenttb` d WHERE e.emp_code NOT IN(SELECT emp_code FROM projectteamtb WHERE project_code='{$projectId}')and `role`!='admin' AND e.dept_id=d.dept_id";
            $res = mysqli_query($conn, $sql);
            $output = "";
            if ($res) {
                while ($data = mysqli_fetch_assoc($res)) {
                    $output .= "
                        <tr>
                            <td>
                                <div class='d-flex'>
                                        <div>
                                        <i class='fa-solid fa-circle-user fs-1 text-dark img-fluid rounded-circle p-2'></i>
                                        </div>
                                        <div
                                        class='d-flex flex-column justify-content-center'>
                                        <h6 class='mb-0 text-sm'>{$data['firstname']}</h6>
                                        <p class='text-xs text-secondary mb-0'>
                                        {$data['email']}
                                        </p>
                                        </div>
                                </div>
                            </td>
                            
                            <td> <p class='text-xs text-secondary mb-0'>{$data['name']}</p></td>
                            <td>{$data['location']}</td>
                            <td class='text-center'><input class='form-check-input m-3 addempChk' type='checkbox' id='{$data['emp_code']}' ></td>
                        </tr>";
                        
                }
        }

            echo $output;
        } else {
            echo 0;
        }
        echo $sql;
    // }
}

//load employee data in project 
if (isset($_POST["flag"]) and $_POST["flag"] == "loadEmployeeData1") {
    $projectId=$_POST['id'];
    $sql = "SELECT pt.*,e.firstname,e.email,d.name,d.location FROM `projectteamtb` pt,`employeetb` e,`departmenttb` d WHERE pt.project_code='{$projectId}' AND pt.emp_code=e.emp_code AND e.dept_id=d.dept_id";
    $res = mysqli_query($conn, $sql);
    $output = "";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output .= "
                <tr>
                    <td>
                        <div class='d-flex'>
                            <div>
                                <i class='fa-solid fa-circle-user fs-1 text-dark img-fluid rounded-circle p-2'></i>
                            </div>
                            <div
                                class='d-flex flex-column justify-content-center'>
                                <h6 class='mb-0 text-sm'>{$data['firstname']}</h6>
                                <p class='text-xs text-secondary mb-0'>
                                {$data['email']}
                                </p>
                            </div>
                        </div>
                    </td>
					<td> <p class='text-xs text-secondary mb-0'>{$data['name']}</p></td>
					<td>{$data['location']}</td>
                    <td class='text-center'><input class='form-check-input m-3 empChk' type='checkbox' id='{$data['id']}' checked></td>";
                    if($data['isManager'])
                    {
                        $output.="<td class='text-center'><input class='form-check-input m-3 empManChk' type='checkbox' id='{$data['id']}' checked></td>
                        </tr>";
                    }
                    else
                    {
                        $output.="<td class='text-center'><input class='form-check-input m-3 empManChk' type='checkbox' id='{$data['id']}'></td>
                        </tr>";
                    }
                    
        }

        echo $output;
    } else {
        echo 0;
    }
}

//live searched employee data in project team
if(isset($_POST["flag"]) and $_POST["flag"]=="live_search_proj_emp")
{
    $data = $_POST['data'];
    $projectId=$_POST['id'];
    $sql="SELECT DISTINCT e.emp_code,d.name,d.location,e.firstname,e.email FROM `employeetb` e ,`departmenttb` d WHERE e.emp_code NOT IN(SELECT emp_code FROM projectteamtb WHERE project_code='{$projectId}')and `role`!='admin' AND e.dept_id=d.dept_id and e.firstname like '{$data}%'";
    $res= mysqli_query($conn,$sql);
    $output = "";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output .= "
                <tr>
                    <td>
                        <div class='d-flex'>
                            <div>
                                <i class='fa-solid fa-circle-user fs-1 text-dark img-fluid rounded-circle p-2'></i>
                            </div>
                            <div
                                class='d-flex flex-column justify-content-center'>
                                <h6 class='mb-0 text-sm'>{$data['firstname']}</h6>
                                <p class='text-xs text-secondary mb-0'>
                                {$data['email']}
                                </p>
                            </div>
                        </div>
                    </td>
					<td> <p class='text-xs text-secondary mb-0'>{$data['name']}</p></td>
					<td>{$data['location']}</td>
                    <td class='text-center'><input class='form-check-input m-3 empChk' type='checkbox' id='{$data['emp_code']}'></td>
                     </tr>";
        }

        echo $output;
    } else {
        echo 0;
    }
}

if(isset($_POST["flag"]) and $_POST["flag"]=="live_search_depart_proj")
{
    $data = $_POST['id'];
    $projectId=$_POST['pid'];
    $sql="";
    if($data=="")
    {
        $sql="SELECT DISTINCT e.emp_code,d.name,d.location,e.firstname,e.email FROM `employeetb` e ,`departmenttb` d WHERE e.emp_code NOT IN(SELECT emp_code FROM projectteamtb WHERE project_code='{$projectId}')and `role`!='admin' AND e.dept_id=d.dept_id";
    }
    else{
        $sql="SELECT DISTINCT e.emp_code,d.name,d.location,e.firstname,e.email FROM `employeetb` e ,`departmenttb` d WHERE e.emp_code NOT IN(SELECT emp_code FROM projectteamtb WHERE project_code='{$projectId}')and `role`!='admin' AND e.dept_id=d.dept_id AND d.dept_id='$data'";
    }
    // echo $data;
    
    $res=mysqli_query($conn,$sql);
    $output = "";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output .= "
                <tr>
                    <td>
                        <div class='d-flex'>
                            <div>
                                <i class='fa-solid fa-circle-user fs-1 text-dark img-fluid rounded-circle p-2'></i>
                            </div>
                            <div
                                class='d-flex flex-column justify-content-center'>
                                <h6 class='mb-0 text-sm'>{$data['firstname']}</h6>
                                <p class='text-xs text-secondary mb-0'>
                                {$data['email']}
                                </p>
                            </div>
                        </div>
                    </td>
					<td> <p class='text-xs text-secondary mb-0'>{$data['name']}</p></td>
					<td>{$data['location']}</td>
                    <td class='text-center'><input class='form-check-input m-3 empChk' type='checkbox' id='{$data['emp_code']}'></td>
                </tr>
            ";
        }

        echo $output;
    } else {
        echo 0;
    }
}


//delete employee from project team
if (isset($_POST["flag"]) and $_POST["flag"] == "deletEmpProj") {
    $ptId=$_POST['ptid'];
    $sql="DELETE FROM `projectteamtb` WHERE id='{$ptId}'";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        echo 1;
    }
    else{
        echo 0;
    }
}


//on save butoon transfer project team temp data to project team table
if (isset($_POST["flag"]) and $_POST["flag"] == "addEmpProjTeam") {
    $pId=$_POST['pid'];
    $sql="SELECT * FROM `projectteamtb_temp` WHERE `project_code`='{$pId}'";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        while($row=mysqli_fetch_assoc($res))
        {
            $pcode=$row['project_code'];
            $ecode=$row['emp_code'];
            $sql1="INSERT INTO `projectteamtb`(`project_code`, `emp_code`) VALUES ('{$pcode}','{$ecode}')";
            $res1=mysqli_query($conn,$sql1);
        }
        $sql="DELETE FROM `projectteamtb_temp` WHERE `project_code`='{$pId}'";
        $res=mysqli_query($conn,$sql); 
        echo 1;
    }
    else
    {
        echo 0;
    }
    
}

//add employee into project team temp table
if (isset($_POST["flag"]) and $_POST["flag"] == "addEmpProjTeamTemp") {
    $pId=$_POST['pid'];
    $eId=$_POST['eid'];
    // $sql="SELECT * FROM `projectteamtb` WHERE `project_code`='{$pId}' AND  `emp_code`='{$eId}'";
    // $res=mysqli_query($conn,$sql);
    // if(mysqli_num_rows($res)<=0){
        $sql1="INSERT INTO `projectteamtb_temp`(`project_code`, `emp_code`) VALUES ('{$pId}','{$eId}')";
        $res1=mysqli_query($conn,$sql1);
        if($res1)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    // }
    
}

//delete employee from project team temp table
if (isset($_POST["flag"]) and $_POST["flag"] == "delEmpProjTeamTemp") {
    $pId=$_POST['pid'];
    $eId=$_POST['eid'];
    // $sql="SELECT * FROM `projectteamtb` WHERE `project_code`='{$pId}' AND  `emp_code`='{$eId}'";
    // $res=mysqli_query($conn,$sql);
    // if(mysqli_num_rows($res)<=0){
        $sql1="DELETE FROM `projectteamtb_temp` WHERE `project_code`='{$pId}' AND `emp_code`='{$eId}'";
        $res1=mysqli_query($conn,$sql1);
        if($res1)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    // }
    
}



//dtrucate project team temp table
if (isset($_POST["flag"]) and $_POST["flag"] == "truncateEmpProjTeam") {
    $pId=$_POST['pid'];
    $sql1="DELETE FROM `projectteamtb_temp` WHERE `project_code`='{$pId}'";
    $res1=mysqli_query($conn,$sql1);
    if($res1)
    {
        echo 1;
    }
    else{
        echo 0;
    }
}

//add manager to project team list
if(isset($_POST["flag"]) and $_POST["flag"]=="addProjManager")
{
    $ptid=$_POST["ptid"];
    $sql="UPDATE `projectteamtb` SET `isManager`=TRUE WHERE id='{$ptid}'";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        // echo 1;
        $sql2="SELECT emp_code FROM `projectteamtb` WHERE id='{$ptid}'";
        $res2=mysqli_query($conn,$sql2);
        if(mysqli_num_rows($res2))
        {
            $data=mysqli_fetch_assoc($res2);
            $empCode=$data['emp_code'];
            $sql3="UPDATE `employeetb` SET `role`='manager' WHERE `emp_code`='{$empCode}'";
            $res3=mysqli_query($conn,$sql3);
            if($res3)
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        }
    }
    else{
        echo 0;
    }
}

//remove manager to project team list
if(isset($_POST["flag"]) and $_POST["flag"]=="removeProjManager")
{
    $ptid=$_POST["ptid"];
    $sql="UPDATE `projectteamtb` SET `isManager`=FALSE WHERE id='{$ptid}'";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        $sql2="SELECT emp_code FROM `projectteamtb` WHERE id='{$ptid}'";
        $res2=mysqli_query($conn,$sql2);
        if(mysqli_num_rows($res2))
        {
            $data=mysqli_fetch_assoc($res2);
            $empCode=$data['emp_code'];
            $sql3="UPDATE `employeetb` SET `role`='user' WHERE `emp_code`='{$empCode}'";
            $res3=mysqli_query($conn,$sql3);
            if($res3)
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        }
    }
    else{
        echo 0;
    }
}


//load manager for select team leader
// if(isset($_POST['flag']) and $_POST['flag']=="load_magnager_leader")
// {
//     $output = "<option value=''>None</option>";
//     $pId=$_POST['pid'];
//     $sql="SELECT p.id,e.* FROM projectteamtb p,employeetb e WHERE project_code=$pId AND isManager=TRUE AND e.emp_code=p.emp_code";
//     $res=mysqli_query($conn,$sql);
//     if($res)
//     {
//         while($data=mysqli_fetch_assoc($res))
//         {
//             $output.="
//             <option value='{$data['id']}'>{$data['firstname']}</option>
//             ";
//         }
//         echo $output;
//     }
// }


//add team leader
// if(isset($_POST['flag']) and $_POST['flag']=="add_teamLeader")
// {

//     $ptid=$_POST['ptid'];
    
//     $sql="UPDATE `projectteamtb` SET `isTeamLeader`=FALSE";
//     $res=mysqli_query($conn,$sql);
//     $sql="UPDATE `projectteamtb` SET `isTeamLeader`=TRUE WHERE id='{$ptid}'";
//     $res=mysqli_query($conn,$sql);
//     if($res)
//     {
//         echo 1;
//     }
// }

//load team leader
// if(isset($_POST['flag']) and $_POST['flag']=="load_leader")
// {

//     $ptid=$_POST['ptid'];
//     $sql="SELECT * FROM `projectteamtb` WHERE `isTeamLeader`=TRUE AND project_code='{$ptid}'";
//     $res=mysqli_query($conn,$sql);
//     if(mysqli_num_rows($res)==1)
//     {
//         $data=mysqli_fetch_assoc($res);
//         echo $data['id'];
//     }
// }


 
//live search Project Data
if (isset($_POST["flag"]) && $_POST["flag"] == "live_search_project") {
    $field=mysqli_real_escape_string($conn,$_POST['data']);
    $sql = "SELECT * FROM `projecttb` p,`clienttb` c WHERE p.client_id=c.client_id and project_name like '{$field}%' LIMIT $start_from, $limit";
    $res = mysqli_query($conn, $sql);

    $output = "";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            if($data['status']=='started'){
                $signal = 'primary';
            }
            else if($data['status']=='onhold'){
                $signal = 'warning';
            }
            else if($data['status']=='inprogress'){
                $signal = 'info';
            }
            else if($data['status']=='cancelled'){
                $signal = 'danger';
            }
            else if($data['status']=='completed'){
                $signal = 'success';
            }
            else if($data['status']=='deffered'){
                $signal = 'secondary';
            }
            $output .= "
            <tr >
                <td class='table-plus pt-4 pb-4'>{$data['project_code']}</td>
                <td>{$data['project_name']}</td>
                <td>{$data['client_name']}</td>
                <td>{$data['start_date']}</td>
                <td><span class='badge bg-label-{$signal} me-1'>{$data['status']}</span></td>
                <td><a href='ProjectEdit.php?id={$data['project_code']}'><i class='fa fa-pen cursor-pointer EditProject' id='{$data['project_code']}'></i></a></td>
                <td style='color: red;'><i class='fa-solid fa-trash-can cursor-pointer delProject'  id='{$data['project_code']}'></i></td>";
                if($data['isActive']=="1")
                {
                    $output.="<td><a href='projectTask.php?id={$data['project_code']}'><i class='fa-solid fa-pen-to-square projectTask' id='{$data['project_code']}'></i></a></td>";
                }
                else{
                    $output.="<td><a href='' id='pTask'><i class='fa-solid fa-pen-to-square projectTask'></i></a></td>";
                }
                
                if($data['file_name']==NULL)
                {
                    $output.="<td><a href='#'>No attachment</a></td>";
                }
                else{
                    $output.="<td><a href='../assets/img/projectAttachments/{$data['file_name']}' target='blank'>Open attachment</a></td>";
                }

                if($data['isActive']=="1")
                {
                    $output.="<td><a href='ProjectTeamlist.php?id={$data['project_code']}'>Team</a></td>
                    </tr>";
                }
                else{
                    $output.="<td><a href='' id='pTeam'>Team</a></td>
                    </tr>";
                }
        }
        echo $output;
    } else {
        echo 0;
    }
}
 
//load Project Data using status
if (isset($_POST["flag"]) && $_POST["flag"] == "project_data") {
    $field=mysqli_real_escape_string($conn,$_POST['id']);
    if($field == 'All'){
        $sql = "SELECT * FROM `projecttb` p,`clienttb` c WHERE p.client_id=c.client_id LIMIT $start_from, $limit";
    }else{
        $sql = "SELECT * FROM `projecttb` p,`clienttb` c WHERE p.client_id=c.client_id and p.status='{$field}' LIMIT $start_from, $limit";
    }
    $res = mysqli_query($conn, $sql);

    $output = "";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            if($data['status']=='started'){
                $signal = 'primary';
            }
            else if($data['status']=='onhold'){
                $signal = 'warning';
            }
            else if($data['status']=='inprogress'){
                $signal = 'info';
            }
            else if($data['status']=='cancelled'){
                $signal = 'danger';
            }
            else if($data['status']=='completed'){
                $signal = 'success';
            }
            else if($data['status']=='deffered'){
                $signal = 'secondary';
            }
            $output .= "
            <tr >
                <td class='table-plus pt-4 pb-4'>{$data['project_code']}</td>
                <td>{$data['project_name']}</td>
                <td>{$data['client_name']}</td>
                <td>{$data['start_date']}</td>
                <td><span class='badge bg-label-{$signal} me-1'>{$data['status']}</span></td>
                <td><a href='ProjectEdit.php?id={$data['project_code']}'><i class='fa fa-pen cursor-pointer EditProject' id='{$data['project_code']}'></i></a></td>
                <td style='color: red;'><i class='fa-solid fa-trash-can cursor-pointer delProject'  id='{$data['project_code']}'></i></td>";
                if($data['isActive']=="1")
                {
                    $output.="<td><a href='projectTask.php?id={$data['project_code']}'><i class='fa-solid fa-pen-to-square projectTask' id='{$data['project_code']}'></i></a></td>";
                }
                else{
                    $output.="<td><a href='' id='pTask'><i class='fa-solid fa-pen-to-square projectTask'></i></a></td>";
                }
                
                if($data['file_name']==NULL)
                {
                    $output.="<td><a href='#'>No attachment</a></td>";
                }
                else{
                    $output.="<td><a href='../assets/img/projectAttachments/{$data['file_name']}' target='blank'>Open attachment</a></td>";
                }

                if($data['isActive']=="1")
                {
                    $output.="<td><a href='ProjectTeamlist.php?id={$data['project_code']}'>Team</a></td>
                    </tr>";
                }
                else{
                    $output.="<td><a href='' id='pTeam'>Team</a></td>
                    </tr>";
                }
        }
        echo $output;
    } else {
        echo 0;
    }
}

//load Project Task
if (isset($_POST["flag"]) && $_POST["flag"] == "loadProjectTaskData") {
    if(isset($_POST['row_no']))
    {
        $row=$_POST['row_no'];
        $row=($row-1)* $limit;

    
        $id = $_POST["id"];
        $sql = "SELECT p.* FROM `projecttask` p where p.project_code = '{$id}' LIMIT $row, $limit";
        $res = mysqli_query($conn, $sql);
        $output = "";
        if ($res) {
            while ($data = mysqli_fetch_assoc($res)) {
                $sql1 = "SELECT e.firstname FROM `projecttask` p,`employeetb` e where p.taskCode = '{$data['taskCode']}' AND p.assignedBy=e.emp_code";
                $res1 = mysqli_query($conn, $sql1);
                $data1=mysqli_fetch_assoc($res1);
                $sql2 = "SELECT e.firstname FROM `projecttask` p,`employeetb` e where p.taskCode = '{$data['taskCode']}' AND p.emp_name=e.emp_code";
                $res2 = mysqli_query($conn, $sql2);
                $data2=mysqli_fetch_assoc($res2);
                $output .= "
                <tr>
                    <td class='pt-4 pb-4'>{$data['taskCode']}</td>
                    <td class='table-plus'>{$data['name']}</td>
                    <td>{$data2['firstname']}</td>

                    <td>
                    <div class='d-flex'>
                    <div>
                    <i class='fa-solid fa-circle-user fs-1 text-dark img-fluid rounded-circle p-2'></i>
                    </div>
                    <div
                    class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>{$data1['firstname']}</h6>
                    
                    </div>
                </div>
                </td>

                    <td>{$data['start_date']}</td>
                    <td>{$data['Priority']}</td>

                    <td>
                        <a class='dropdown-item edit_task' id='{$data['taskCode']}' data-bs-toggle='modal' data-bs-target='#editTask' href='#'>
                            <i class='fa-solid fa-pen '></i> 
                        </a>
                    </td>
                    <td style='color: red;'>
                        <a class='dropdown-item deltask' id='{$data['taskCode']}' >
                            <i class='fa-solid fa-trash-can'></i>
                        </a>
                    </td>
                </tr>";
            }
            echo $output;
        } else {
            echo 0;
        }
    }
}

//load employee in project task
if (isset($_POST['flag']) && $_POST['flag'] == 'loadEmployee') {
    $p_code=$_POST['id'];
    $sql = "SELECT * FROM employeetb WHERE emp_code IN(SELECT emp_code FROM projectteamtb WHERE project_code='{$p_code}')";
    $res = mysqli_query($conn, $sql);
    $output = "<option value='none' disabled>Select Employee</option>";
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $output .= "<option value='{$row['emp_code']}'>{$row['firstname']}</option>";
        }
    }
    echo $output;
}

//load employee in project task
if (isset($_POST['flag']) && $_POST['flag'] == 'loadEmployee_task') {
    $p_code=$_POST['id'];
    $flag=0;
    $empid=$_POST['empid'];
    $emparr=explode(",",$empid);
    $emparr_length= count($emparr);
   
    $sql = "SELECT * FROM employeetb WHERE emp_code IN(SELECT emp_code FROM projectteamtb WHERE project_code='{$p_code}')";
    $res = mysqli_query($conn, $sql);
    $output = "<option value='none' disabled>Select Employee</option>";
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $flag =0;
            for($i=0;$i<$emparr_length;$i++)
            {
                if($row['emp_code']==$emparr[$i])
                {
                    $flag = 1;
                    break;
                }
            }
            if($flag==1){
                 $output .= "<option value='{$row['emp_code']}' selected>{$row['firstname']}</option>";
            }else{
                    $output .= "<option value='{$row['emp_code']}'>{$row['firstname']}</option>";
            }
        }
    }
    echo $output;
}




//delete Project Task
if (isset($_POST['flag']) && $_POST['flag'] == "deleteProjectTaskData") {
    $id = $_POST['id'];
    $sql = "DELETE FROM `projecttask` WHERE `taskCode`='{$id}'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}


//load employee in project task Edit
if (isset($_POST['flag']) && $_POST['flag'] == 'loadEmployeeInEdit') {
    $sql = "SELECT * FROM `employeetb` ";
    $res = mysqli_query($conn, $sql);
    $output = "<option value='none' disabled>Select Employee</option>";
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $output .= "<option value='{$row['firstname']}'>{$row['firstname']}</option>";
        }
    }
    echo $output;
}

//load project Task data
if (isset($_POST['flag']) and $_POST['flag'] == 'load_task_data') {
    $id = $_POST['id'];
    // echo $id;
    $sql = "SELECT * FROM `projecttask` WHERE  `taskCode`='{$id}'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);
}

//Update Project Task
if (isset($_POST['flag']) && $_POST['flag'] == "update_task_data") {
    $id = $_POST['editTaskcode'];
    // echo "<script>alert($id);</script>";

    $name=$_POST['editTName'];
    $empName=$_POST['editempLoad'];
    $sDate=$_POST['editSdate'];
    $priority=$_POST['editPriority'];
    $sql = "UPDATE `projecttask` SET `name`='{$name}',`emp_name`='{$empName}',`start_date`='{$sDate}',`Priority`='{$priority}' WHERE `taskCode`='{$id}'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}



// suggestion
if(isset($_POST['flag']) and $_POST['flag']=='suggestion'){
    $emp_code = mysqli_real_escape_string($conn,$_POST['id']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $sbody = mysqli_real_escape_string($conn,$_POST['suggestion_body']);
    $sid=substr(uniqid("sid"), 0, 10);
    $sql = "INSERT INTO `suggestion`(`s_id`, `title`, `s_body`, `e_id`) VALUES ('$sid','$title','$sbody','$emp_code')";
    $res = mysqli_query($conn,$sql);
    if($res){
        echo 1;
    }else{
        echo 0;
    }
}

// loading suggestion
if(isset($_POST['flag']) and $_POST['flag']=='load_suggestion'){
    $v =$_POST['v']; 
    $i=0;
    $output = "";
    $sql = "SELECT * FROM `suggestion`";
    $res = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($res);
    $cnt = 0;
    $idofdiv ='';
    if($result>0){
        while($row = mysqli_fetch_assoc($res)){
            if($cnt==3){
                $cnt +=1;
                $idofdiv = "leadDiscovered".$cnt;
            }else{
                $cnt =0;
            }
            $sql1 = "select * from employeetb e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code='{$row['e_id']}'";
            $res1 = mysqli_query($conn,$sql1);
            $result1 = mysqli_num_rows($res1);
            if($result1>0){
                
                while($row1 = mysqli_fetch_assoc($res1)){
                    $i++;
                    if($row1['profile_picture']==''){
                        $img = 'userIcon.jpg';
                    }else{
                        $img = $row1['profile_picture'];
                    }
                    $mytimeutc = time_Ago($row['date_time']);
                    if($v==$i){
                        $output .= "
                            <div class='  card'>
                                <div class='card-body'>
                                    <a class='d-flex align-items-center' data-bs-toggle='collapse'
                                        href='#{$row['s_id']}'
                                        aria-controls='{$row1['emp_code']}'>
                                        <div class='flex-shrink-0'>
                                            <img src='../assets/img/profile/{$img}' alt=''
                                                class='avatar-xs rounded-circle' />
                                        </div>
                                        <div class='flex-grow-1 ms-3'>
                                            <h6 class='fs-14 mb-1'>{$row1['firstname']}</h6>
                                        </div>
                                        <small class='badge badge-soft-info load_time'><i
                                                class=' ri-history-fill align-bottom me-1'></i>{$mytimeutc}</small>
                                    </a>
                                </div>
                                <div class='collapse border-top border-top-dashed' id='{$row['s_id']}'>
                                    <div class='card-body'>
                                        <h6 class='fs-14 mb-1'>{$row['title']}</h6>
                                        <p class='text-muted'>{$row['s_body']}</p>
                                        
                                    </div>
                                    <div class='card-footer hstack gap-2 justify-content-end'>  
                                        <button class='btn btn-soft-danger btn-sm w-50 del_suggestion'  id='{$row['s_id']}'><i
                                                class='ri-delete-bin-6-fill align-bottom me-1'></i>
                                            Delete</button>
                                    </daiv>
                                </div>
                            </div> 
                            </div>
                    </div>
                    ";
                        $v+=3;
                    }
                    
                }
            }
        }
    }
    echo $output;
}

// loading suggestion using department
if(isset($_POST['flag']) and $_POST['flag']=='live_search_depart12'){
    $data = mysqli_real_escape_string($conn,$_POST['id']);
    $output = " ";
    if($data == '')
    {
        $sql1="SELECT * FROM suggestion s,employeetb e WHERE s.e_id=e.emp_code ";
    }else{
        $sql1="SELECT * FROM suggestion s,employeetb e WHERE s.e_id=e.emp_code and e.dept_id='$data'";
    }
    $res1 = mysqli_query($conn,$sql1);
    $result1 = mysqli_num_rows($res1);
    if($result1>0){
        while($row1 = mysqli_fetch_assoc($res1)){
            $output .= "
            <div class='col'>
                <div class='card m-1'>
                    <div class='card-header fw-bold fs-4'>{$row1['title']}</div>
                    <div class='card-body'>
                        <p class='card-text text-dark fs-5'>{$row1['s_body']}</p>
                    </div>
                    <div class='row mb-2'>
                        <div class='col-8 text-dark px-4'>~ suggested by {$row1['firstname']}</div>
                        <div class='col-4'><i class='fa-solid fa-trash-can cursor-pointer mx-5 fs-4 text-danger del_suggestion' id='{$row1['s_id']}'></i></div>
                    </div>
                </div>
            </div>
            ";
        }
    }
    echo $output;
}

// loading suggestion using department title
if(isset($_POST['flag']) and $_POST['flag']=='live_search_suggestion'){
    $title = mysqli_real_escape_string($conn,$_POST['data']);
    $output = " ";
    $sql1="SELECT * FROM suggestion s,employeetb e WHERE s.e_id=e.emp_code and title like '{$title}%'";
    $res1 = mysqli_query($conn,$sql1);
    $result1 = mysqli_num_rows($res1);
    if($result1>0){
        while($row1 = mysqli_fetch_assoc($res1)){
            $output .= "
            <div class='col'>
                <div class='card m-1'>
                    <div class='card-header fw-bold fs-4'>{$row1['title']}</div>
                    <div class='card-body'>
                        <p class='card-text text-dark fs-5'>{$row1['s_body']}</p>
                    </div>
                    <div class='row mb-2'>
                        <div class='col-8 text-dark px-4'>~ suggested by {$row1['firstname']}</div>
                        <div class='col-4'><i class='fa-solid fa-trash-can cursor-pointer mx-5 fs-4 text-danger del_suggestion' id='{$row1['s_id']}'></i></div>
                    </div>
                </div>
            </div>
            ";
        }
    }
    echo $output;
}

// delete suggestion
if(isset($_POST['flag']) and $_POST['flag']=='del_suggestion'){
    $id =  mysqli_real_escape_string($conn,$_POST['id']);
    $sql = "DELETE FROM `suggestion` WHERE s_id='{$id}'";
    $res = mysqli_query($conn,$sql);
    if($res){
        echo 1;
    }else{
        echo 0;
    }
}

// load_profile
if(isset($_POST['flag']) and $_POST['flag']=='load_profile'){
    $emp_code = $_SESSION['emp_code'];
    $sql = "SELECT e1.firstname,e1.middlename,e1.lastname,e1.role,d.name,e2.e_status,e2.personal_phoneNO,e1.email,e2.profile_picture FROM employeetb e1,emp_personal_infotb e2,departmenttb d WHERE e1.emp_code=e2.emp_code and e1.dept_id=d.dept_id and e1.emp_code='{$emp_code}'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);
}

// remove profile pictur
if(isset($_POST['flag']) and $_POST['flag']=='del_proc_picture'){
    $emp_code = $_SESSION['emp_code'];
    $sql = "UPDATE `emp_personal_infotb` SET `profile_picture`='' WHERE `emp_code`='{$emp_code}'";
    $res = mysqli_query($conn,$sql);
    if($res){
        echo 1;
    }else{
        echo 0;
    }

}

// // notification_suggestion
// if(isset($_POST['flag']) and $_POST['flag']=='notification_suggestion'){
//     $output = " ";
//     $sql = "SELECT * FROM suggestion s,emp_personal_infotb e where chk_read='0' and s.e_id=e.emp_code";
//     $res1 = mysqli_query($conn,$sql);
//     $result1 = mysqli_num_rows($res1);
//     if($result1>0){
//         while($row1 = mysqli_fetch_assoc($res1)){
//             if($row1['profile_picture']==''){
//                 $pic = "<i class='fa fa-user w-px-40 mt-3 mx-3 rounded-circle' aria-hidden='true'></i>";
//             }else{
//                 $pic =  "<img src='../assets/img/profile/{$row1['profile_picture']}' class='w-px-40 h-auto rounded-circle'>";
//             }
//             $output .= "

//             <li class='list-group-item list-group-item-action dropdown-notifications-item notification_card' id='{$row1['s_id']}'>
//                 <div class='d-flex'>
//                     <div class='flex-shrink-0 me-3'>
//                         <div class='avatar'>
//                             {$pic}
//                         </div>
//                     </div>
//                     <div class='flex-grow-1'>
//                         <h6 class='mb-1'>{$row1['title']}</h6>
//                         <p class='mb-0'>{$row1['s_body']}</p>
//                         <small class='text-muted'>1h ago</small>
//                     </div>
//                     <div class='flex-shrink-0 dropdown-notifications-actions'>
//                         <a href='javascript:void(0)' class='dropdown-notifications-read'><span
//                                 class='badge badge-dot'></span></a>
//                         <a href='javascript:void(0)'
//                             class='dropdown-notifications-archive'><span
//                                 class='bx bx-x'></span></a>
//                     </div>
//                 </div>
//             </li>
//             ";
//         }
//     }else{
//         $output .= "

//         <li class='list-group-item list-group-item-action dropdown-notifications-item notification_card'>
//             Horry no Notification
//         </li>

//         ";
//     }
//     echo $output;
// }

// // read_notification_suggestion
// if(isset($_POST['flag']) and $_POST['flag']=='read_notification_suggestion'){
//     $id = $_POST['id'];
//     $sql = "UPDATE `suggestion` SET `chk_read`='1' WHERE `s_id`='{$id}'";
//     $res1 = mysqli_query($conn,$sql);
// }

// // cnt_notification
// if(isset($_POST['flag']) and $_POST['flag']=='cnt_notification'){
//     $sql = "SELECT count(*) as cnt FROM suggestion s,emp_personal_infotb e where chk_read='0' and s.e_id=e.emp_code";
//     $res1 = mysqli_query($conn,$sql);
//     if(mysqli_num_rows($res1)>0){
//         while($row = mysqli_fetch_assoc($res1)){
//             echo $row['cnt'];
//         }
//     }
// }
//==================================Notifications======================================================
// notification_suggestion
if(isset($_POST['flag']) and $_POST['flag']=='notification_suggestion'){
    $output = " ";
    $sql = "SELECT * FROM suggestion s,emp_personal_infotb e ,employeetb emp where chk_read='0' and e.emp_code=emp.emp_code and s.e_id=emp.emp_code and s.e_id=e.emp_code";
    $res1 = mysqli_query($conn,$sql);
    $result1 = mysqli_num_rows($res1);
    if($result1>0){
        while($row1 = mysqli_fetch_assoc($res1)){
            if($row1['profile_picture']==''){
                $pic = "<i class='fa fa-user w-px-40 mt-3 mx-3 rounded-circle' aria-hidden='true'></i>";
            }else{
                $pic =  "<img src='../assets/img/profile/{$row1['profile_picture']}' style='height: 50px; width:50px;' class='rounded-circle'>";
            }
            $output .= "

            <li class='list-group-item list-group-item-action dropdown-notifications-item notification_card '  id='{$row1['s_id']}'>
                <div class='d-flex'>
                    <div class='flex-shrink-0 me-3 '>
                        <div class='avatar'>
                            {$pic}
                        </div>
                    </div>
                    <div class='flex-grow-1'>
                        <h6 class='mb-1'>{$row1['title']}</h6>
                        <p class='mb-0'>{$row1['s_body']}</p>
                        <small class='text-muted'>1h ago</small>
                    </div>
                    <div class='flex-shrink-0 dropdown-notifications-actions justify-content-end'>
                        <a href='javascript:void(0)' class='dropdown-notifications-read'><span
                                class='badge badge-dot'></span></a>
                        <a href='javascript:void(0)'
                            class='dropdown-notifications-archive'><span
                                class='bx bx-x'></span></a>
                    </div>
                </div>
            </li>
            ";
        }
    }else{
        $output .= "

        <li class='list-group-item list-group-item-action dropdown-notifications-item notification_card '>
          😟 Opps No Notification...!
        </li>

        ";
    }
    echo $output;
}

//mark all as read suggestion

if(isset($_POST['flag']) and $_POST['flag']=='mark_all_read_suggestion'){
    $sql = "UPDATE `suggestion` SET `chk_read`='1' ";
    $res1 = mysqli_query($conn,$sql);
}

// read_notification_suggestion
if(isset($_POST['flag']) and $_POST['flag']=='read_notification_suggestion'){
    $id = $_POST['id'];
    $sql = "UPDATE `suggestion` SET `chk_read`='1' WHERE `s_id`='{$id}'";
    $res1 = mysqli_query($conn,$sql);
}

// cnt_notification
if(isset($_POST['flag']) and $_POST['flag']=='cnt_notification'){
    $sql = "SELECT count(*) as cnt FROM suggestion s,emp_personal_infotb e where chk_read='0' and s.e_id=e.emp_code";
    $res1 = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res1)>0){
        while($row = mysqli_fetch_assoc($res1)){
            echo $row['cnt'];
        }
    }
}



// notification_suggestion_employee
if(isset($_POST['flag']) and $_POST['flag']=='notification_tasks_employee'){
    $output = " ";
    $empId=$_SESSION['emp_code'];
    $sql = "SELECT * FROM notification n,emp_personal_infotb e,task t where chk_read='0' and n.empId=e.emp_code and t.id=n.taskId and empId='{$empId}'";
    $res1 = mysqli_query($conn,$sql);
    $result1 = mysqli_num_rows($res1);
    if($result1>0){
        while($row1 = mysqli_fetch_assoc($res1)){
            if($row1['profile_picture']==''){
                $pic = "<i class='fa fa-user w-px-40 mt-3 mx-3 rounded-circle' aria-hidden='true'></i>";
            }else{
                $pic =  "<img src='../assets/img/profile/{$row1['profile_picture']}' style='height: 50px; width:50px;' class='rounded-circle'>";
            }
            $output .= "

            <li class='list-group-item list-group-item-action dropdown-notifications-item notification_card_employee '  id='{$row1['notifiy_id']}'>
                <div class='d-flex'>
                    <div class='flex-shrink-0 me-3 '>
                        <div class='avatar'>
                            {$pic}
                        </div>
                    </div>
                    <div class='flex-grow-1'>
                        <h6 class='mb-1'>{$row1['title']}</h6>
                        <p class='mb-0'>{$row1['description']}</p>
                        <small class='text-muted'>1h ago</small>
                    </div>
                    <div class='flex-shrink-0 dropdown-notifications-actions justify-content-end'>
                        <a href='javascript:void(0)' class='dropdown-notifications-read'><span
                                class='badge badge-dot'></span></a>
                        <a href='javascript:void(0)'
                            class='dropdown-notifications-archive'><span
                                class='bx bx-x'></span></a>
                    </div>
                </div>
            </li>
            ";
        }
    }else{
        $output .= "

        <li class='list-group-item list-group-item-action dropdown-notifications-item notification_card_employee '>
          😟 Opps No Notification...!
        </li>

        ";
    }
    echo $output;
}

// cnt_notification_employee
if(isset($_POST['flag']) and $_POST['flag']=='cnt_notification_employee'){
    $empId=$_SESSION['emp_code'];
    $sql = "SELECT count(*) as cnt FROM notification n,emp_personal_infotb e where chk_read='0' and n.empId=e.emp_code and empId='{$empId}'";
    $res1 = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res1)>0){
        while($row = mysqli_fetch_assoc($res1)){
            echo $row['cnt'];
        }
    }
}

// read_notification_tasks
if(isset($_POST['flag']) and $_POST['flag']=='read_notification_tasks'){
    $id = $_POST['id'];
    $sql = "UPDATE `notification` SET `chk_read`='1' WHERE `notifiy_id`='{$id}'";
    $res1 = mysqli_query($conn,$sql);
}

//mark all as read tasks notification employee side
if(isset($_POST['flag']) and $_POST['flag']=='mark_all_read_emp_tasks')
{
    $empId=$_SESSION['emp_code'];
    $sql = "UPDATE `notification` SET `chk_read`='1' WHERE  empId='{$empId}'";
    $res1 = mysqli_query($conn,$sql);
}

// dynamic_load_kanban_cards
if(isset($_POST['flag']) and $_POST['flag']=='dynamic_load_kanban_cards'){
    $output ="";
    $user_icon= "";
    $status = $_POST['status'];
    $sql = "SELECT * FROM `task` where status='{$status}'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
        while($row = mysqli_fetch_assoc($res)){
            $user_icon= "";
            $string = $row['emp_code'];
            $str_arr = explode (",", $string); 
            $n = count($str_arr);
            for($i=0;$i<$n;$i++){
                $sql1 = "select * FROM employeetb e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code='{$str_arr[$i]}'";
                $res1 = mysqli_query($conn,$sql1);
                $result1 = mysqli_num_rows($res1);
                if($result1>0){
                    while($data1 = mysqli_fetch_assoc($res1)){
                        if($data1['profile_picture'] == ''){
                            $user_icon .= "
                            <a href='javascript: void(0);' class='avatar-group-item '  data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top'
                            title='{$data1['firstname']}' >
                                    <div class='avatar-xxs'>
                                    <img src='../assets/img/profile/proc.jpg' alt=''
                                            class='avatar-title fs-16 rounded-circle bg-light border-dashed border '>
                                    </div>
                                </a>
                            ";
                        }else{
                            $user_icon .= "
                            <a href='javascript: void(0);' class='avatar-group-item' data-bs-toggle='tooltip'
                                    data-bs-trigger='hover' data-bs-placement='top' title='{$data1['firstname']}'>
                                    <div class='avatar-xxs'>
                                        <img src='../assets/img/profile/{$data1['profile_picture']}' alt=''
                                            class='rounded-circle img-fluid'>
                                    </div>
                                </a>
                            ";
                        }
                    }
                }else{
                    $user_icon ='';
                }
            }
            if($row['priority']=='Important'){
                $signal = 'primary';
            }
            else if($row['priority']=='Urgent'){
                $signal = 'warning';
            }
            else if($row['priority']=='Important and urgent'){
                $signal = 'info';
            }
            else if($row['priority']=='Neither'){
                $signal = 'danger';
            }
               
            $output .="
            <div class='card tasks-box' id='{$row['id']}'>
                <div class='card-body'>
                    <div class='d-flex '>
                        <div class='flex-grow-1'>
                        <h6 class='fs-15 mb-0 text-truncate task-title'><a href='#' class='d-block'>{$row['title']}</a></h6>
                        </div>
                        <div class='flex-shrink-0'>
                            <a href='javascript:void(0);' class='text-muted' id='dropdownMenuLink4' data-bs-toggle='dropdown' aria-expanded='false'><i class='ri-more-fill'></i></a>
                            <ul class='dropdown-menu' aria-labelledby='dropdownMenuLink4'>
                            
                                <li> <a class='dropdown-item edit_task_btn'  data-bs-toggle='modal' href='#creatertaskModal' id='{$row['id']}'><i
                                class='ri-edit-2-line align-bottom me-2 text-dark ' 
                                ></i>
                            Edit</a></li>
                                <li><a class='dropdown-item delete-task' data-bs-toggle='modal' href='#deleteRecordModal' id='{$row['id']}'><i
                                class='ri-delete-bin-5-line align-bottom me-2 text-dark'></i>
                            Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <p class='text-muted'>{$row['description']}</p>
                    <div class='d-flex align-items-center'>
                        <div class='flex-grow-1'>
                            <span>Team : </span>
                        </div>
                        <div class='flex-shrink-0'>
                            <div class='avatar-group'>
                            {$user_icon}
                            <a id='{$row['id']}' class='add-member avatar-group-item' data-bs-toggle='modal' href='#addEmpToProj' 
                                data-bs-trigger='hover' data-bs-placement='top' title='Add Members'>
                                <div class='avatar-xxs'>
                                    <div
                                        class='avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary'>
                                        +
                                    </div>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card-body-->
                <div class='card-footer border-top-dashed'>
                    <div class='d-flex'>
                        <div class='flex-grow-1'>
                            <span class='text-muted'><i class='ri-time-line align-bottom'></i> {$row['sdate']}</span>
                        </div>
                        <div class='flex-shrink-0'>
                        <div class='badge badge-soft-{$signal} fs-12'>{$row['priority']}</div>
                        </div>
                    </div>
                </div>
            </div>

    ";
        }
    }
    
    echo $output;
}
if(isset($_POST['flag']) and $_POST['flag']=='dynamic_load_kanban_cards_by_project'){
    $output ="";
    $user_icon= "";
    $status = $_POST['status'];
    $p_id = $_SESSION['overview_page_id'];
    $sql = "SELECT * FROM `task` where status='{$status}' and p_id='{$p_id}'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
        while($row = mysqli_fetch_assoc($res)){
            $user_icon= "";
            $string = $row['emp_code'];
            $str_arr = explode (",", $string); 
            $n = count($str_arr);
            for($i=0;$i<$n;$i++){
                $sql1 = "select * FROM employeetb e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code='{$str_arr[$i]}'";
                $res1 = mysqli_query($conn,$sql1);
                $result1 = mysqli_num_rows($res1);
                if($result1>0){
                    while($data1 = mysqli_fetch_assoc($res1)){
                        if($data1['profile_picture'] == ''){
                            $user_icon .= "
                            <a href='javascript: void(0);' class='avatar-group-item '  data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top'
                            title='{$data1['firstname']}' >
                                    <div class='avatar-xxs'>
                                    <img src='../assets/img/profile/proc.jpg' alt=''
                                            class='avatar-title fs-16 rounded-circle bg-light border-dashed border '>
                                    </div>
                                </a>
                            ";
                        }else{
                            $user_icon .= "
                            <a href='javascript: void(0);' class='avatar-group-item' data-bs-toggle='tooltip'
                                    data-bs-trigger='hover' data-bs-placement='top' title='{$data1['firstname']}'>
                                    <div class='avatar-xxs'>
                                        <img src='../assets/img/profile/{$data1['profile_picture']}' alt=''
                                            class='rounded-circle img-fluid'>
                                    </div>
                                </a>
                            ";
                        }
                    }
                }else{
                    $user_icon ='';
                }
            }
            if($row['priority']=='Important'){
                $signal = 'primary';
            }
            else if($row['priority']=='Urgent'){
                $signal = 'warning';
            }
            else if($row['priority']=='Important and urgent'){
                $signal = 'info';
            }
            else if($row['priority']=='Neither'){
                $signal = 'danger';
            }
               
            $output .="
            <div class='card tasks-box' id='{$row['id']}'>
                <div class='card-body'>
                    <div class='d-flex '>
                        <div class='flex-grow-1'>
                        <h6 class='fs-15 mb-0 text-truncate task-title'><a href='#' class='d-block'>{$row['title']}</a></h6>
                        </div>
                        <div class='flex-shrink-0'>
                            <a href='javascript:void(0);' class='text-muted' id='dropdownMenuLink4' data-bs-toggle='dropdown' aria-expanded='false'><i class='ri-more-fill'></i></a>
                            <ul class='dropdown-menu' aria-labelledby='dropdownMenuLink4'>
                            
                                <li> <a class='dropdown-item edit_task_btn'  data-bs-toggle='modal' href='#creatertaskModal' id='{$row['id']}'><i
                                class='ri-edit-2-line align-bottom me-2 text-dark ' 
                                ></i>
                            Edit</a></li>
                                <li><a class='dropdown-item delete-task' data-bs-toggle='modal' href='#deleteRecordModal' id='{$row['id']}'><i
                                class='ri-delete-bin-5-line align-bottom me-2 text-dark'></i>
                            Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <p class='text-muted'>{$row['description']}</p>
                    <div class='d-flex align-items-center'>
                        <div class='flex-grow-1'>
                            <span>Team : </span>
                        </div>
                        <div class='flex-shrink-0'>
                            <div class='avatar-group'>
                            {$user_icon}
                            <a id='{$row['id']}' class='add-member avatar-group-item' data-bs-toggle='modal' href='#addEmpToProj' 
                                data-bs-trigger='hover' data-bs-placement='top' title='Add Members'>
                                <div class='avatar-xxs'>
                                    <div
                                        class='avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary'>
                                        +
                                    </div>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card-body-->
                <div class='card-footer border-top-dashed'>
                    <div class='d-flex'>
                        <div class='flex-grow-1'>
                            <span class='text-muted'><i class='ri-time-line align-bottom'></i> {$row['sdate']}</span>
                        </div>
                        <div class='flex-shrink-0'>
                        <div class='badge badge-soft-{$signal} fs-12'>{$row['priority']}</div>
                        </div>
                    </div>
                </div>
            </div>

    ";
        }
    }
    
    echo $output;
}
// dynamic_load_kanban_cards_count
if(isset($_POST['flag']) and $_POST['flag']=='dynamic_load_kanban_cards_count'){
    $output = " ";
    $status = $_POST['status'];
    $sql = "SELECT count(*) as cnt FROM `task` WHERE status='{$status}'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
        while($row = mysqli_fetch_assoc($res)){
            $output = $row['cnt'];
        }
    }
    echo $output;
}

// dynamic_load_kanban_cards_count_by_project
if(isset($_POST['flag']) and $_POST['flag']=='dynamic_load_kanban_cards_count_by_project'){
    $output = " ";
    $status = $_POST['status'];
    $p_id = $_SESSION['overview_page_id'];
    $sql = "SELECT count(*) as cnt FROM `task` WHERE status='{$status}' and p_id='{$p_id}'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
        while($row = mysqli_fetch_assoc($res)){
            $output = $row['cnt'];
        }
    }
    echo $output;
}


//update kanban_cards status
if(isset($_POST['flag']) and $_POST['flag']=='update_kanban_cards'){
  $id=$_POST['id'];
  $status=$_POST['status'];
  $sql="UPDATE `task` SET `status`='{$status}' WHERE `id`='{$id}'";
  $res=mysqli_query($conn,$sql);
  if($res)
  {
    echo 1;
  }
  else{
    echo 0;
  }
}

// load project name
if(isset($_POST['flag']) and $_POST['flag']=='load_project'){
    $emp_code = $_SESSION['emp_code'];
    $output = " <option selected>Select project</option>";
    $sql = "SELECT * FROM projecttb WHERE status!='completed' ;";
    $res = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($res);
    if($result>0){
        while($row = mysqli_fetch_assoc($res)){
            $output .= "
            <option value='{$row['project_code']}'>{$row['project_name']}</option>
            ";
        }
    }
    echo $output;
}




//insert Project Task
if (isset($_POST['flag']) && $_POST['flag'] == 'insertProjTask') {
    $task_id = $_POST['tid'];
    $pname = $_POST['pname'];
    $empcode = $_POST['ids'];
    $task_name = $_POST['TName'];
    $Tdescription = $_POST['Tdescription'];
    $sdate = $_POST['sdate'];
    $due_date = $_POST['duedate'];
    $Priority = $_POST['Priority'];
    $sql1 = "INSERT INTO `task`(`id`, `p_id`,`emp_code`, `title`, `description`, `sdate`, `priority`,`due_date`) VALUES ('{$task_id}','{$pname}','{$empcode}','{$task_name}','{$Tdescription}','{$sdate}','{$Priority}','{$due_date}')";
    $res1 = mysqli_query($conn, $sql1);
    if ($res1) {
        echo "Added";
    } else {
        echo "something wrone";
    }
}


// delete task
if(isset($_POST['flag']) and $_POST['flag']=="delete_task"){
    $id = $_POST['id'];
    $sql = "DELETE FROM `task` WHERE id='{$id}'";
    $res = mysqli_query($conn,$sql);
    if($res){
        echo 1;
    }else{
        echo 0;
    }
}

// edit task
if(isset($_POST['flag']) and $_POST['flag']=="edit_task"){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $sql="SELECT * FROM task WHERE `id`='{$id}'";
    $res= mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);
}



//update Project Task
if (isset($_POST['flag']) && $_POST['flag'] == 'editProjTask') {
    $task_id = $_POST['tid'];
    $pname = $_POST['pname'];
    $empcode = $_POST['empLoad'];
    $task_name = $_POST['TName'];
    $Tdescription = $_POST['Tdescription'];
    $sdate = $_POST['sdate'];
    $due_date = $_POST['due_date'];
    $Priority = $_POST['Priority'];
    
    $sql1 = "UPDATE `task` SET `p_id`='{$pname}',`emp_code`='{$empcode}',`title`='{$task_name}',`description`='{$Tdescription}',`sdate`='{$sdate}',`priority`='{$Priority}',`due_date`='{$due_date}' WHERE `id`='{$task_id}'";
    $res1 = mysqli_query($conn, $sql1);
    if ($res1) {
        echo "updated";
    } else {
        echo "something wrone";
    }
}


//load employee data in add project team
if (isset($_POST["flag"]) and $_POST["flag"] == "loadProjectTeamData") {
    $id = $_POST['pid'];
    $_SESSION['overview_page_id']=$id;
    echo 1;
}

//load manager data in add project team
if (isset($_POST["flag"]) and $_POST["flag"] == "loadManagerInProject") {
    $p_id=$_POST['pid'];
    $flag=0;
    $output = "";
   
        $sql="SELECT DISTINCT e.emp_code,e.firstname,e.email,e.lastname,ep.profile_picture,p.isTeamLeader FROM `employeetb` e,emp_personal_infotb ep,projectteamtb p WHERE `role`!='admin' and ep.emp_code=e.emp_code and e.emp_code=p.emp_code and p.isManager='1' and project_code='{$p_id}'";
        $res=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
        $output.="<div class='d-flex align-items-center'>
        <div class='avatar-xs flex-shrink-0 me-3'>";
        if($row['profile_picture']=="")
        {
            $output.="<img src='../assets/img/profile/proc.jpg' alt='' class='img-fluid rounded-circle' />";
        }
        else
        {
            $output.="<img src='../assets/img/profile/{$row['profile_picture']}}' alt='' class='img-fluid rounded-circle' />";
        }
        $output.="</div>
        <div class='flex-grow-1'>
            <h5 class='fs-13 mb-0'><a href='#' class='text-body d-block'>{$row['firstname']} {$row['lastname']}</a></h5>
        </div>
        <div class='flex-shrink-0'>";
        if(!$row['isTeamLeader'])
        {
            $output.="<button type='button' class='btn btn-soft-primary btn-sm addLeaderProjChk px-3'  id='{$row['emp_code']}'>&nbsp;Leader&nbsp;</button>
            </div>
            </div>";
        }
        else{
            $output.="<button type='button' class='btn btn-soft-danger btn-sm delLeaderProjChk'  id='{$row['emp_code']}'>Remove</button>
            </div>
            </div>";
        }
    }
    echo $output;
}

// redirect_overview_page
if(isset($_POST['flag']) and $_POST['flag']=='redirect_overview_page'){
    $id = $_POST['id'];
    $_SESSION['overview_page_id']=$id;
    $sql = "SELECT * FROM `projecttb` where project_code='{$id}'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);
}


// load_project_overview_data
if(isset($_POST['flag']) and $_POST['flag']=='load_project_overview_data'){
    $id = $_POST['id'];
    $sql = "SELECT * FROM `projecttb` p,clienttb c where p.client_id=c.client_id and project_code='{$id}';";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);
}


// multiple file upload
if(isset($_POST['flag']) and $_POST['flag']=="multiplefile"){
    $pid = $_SESSION['overview_page_id'];
    $eid = $_SESSION['emp_code'];
	foreach ($_FILES['file']['tmp_name'] as $key => $value) { 
        if($_FILES['file']['name'][$key]!=''){
            $file_name  = $_FILES['file']['name'][$key];
            $file_type = explode(".",$_FILES['file']['name'][$key]);
            $file_tmp   = $_FILES['file']['tmp_name'][$key];
           
            $file_size  = round(($_FILES["file"]["size"][$key]/8000000),3);
            $ftype = $file_type[1] . " File";
           
            $file_size  .= " MB";
            
            $file_target = '../img/Project_files/'. $file_name;
            $check = move_uploaded_file($file_tmp, $file_target);
            
            $sql = "INSERT INTO `filetb`( `p_id`, `e_id`, `file_name`, `type`, `size`) VALUES ('{$pid}','{$eid}','{$file_name}','{$ftype}','{$file_size}')";
            $res = mysqli_query($conn,$sql);
        }               
	}     
    
}

// getting project id for project overview
if(isset($_POST['flag']) and $_POST['flag']=="get_project_id"){
    $id = $_SESSION['overview_page_id'];
    echo $id;
}

// file show on page
if(isset($_POST['flag']) and $_POST['flag']=="file_show"){
    if(isset($_SESSION['overview_page_id']))
    {
        $id = $_SESSION['overview_page_id'];
        fileshow($id,$conn);
    }
}
if(isset($_POST['flag']) and $_POST['flag']=="file_show_edit"){
    if(isset($_SESSION['edit_project_id']))
    {
        $id = $_SESSION['edit_project_id'];
        fileshow($id,$conn);
    }
}
function fileshow($id,$conn){
    
    $output =" <table class='table table-borderless align-middle mb-0'>
    <thead class='table-light'>
        <tr>
            <th scope='col'>File Name</th>
            <th scope='col'>Type</th>
            <th scope='col'>Size</th>
            <th scope='col'>Upload Date</th>
            <th scope='col' style='width: 120px;'>Action</th>
        </tr>
    </thead>
    <tbody >";
                                           
    $ftype= '';
    $sql = "SELECT * FROM `filetb` WHERE p_id={$id}";
    $res = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($res);
    if($result>0){
        while($row = mysqli_fetch_assoc($res)){
            switch($row['type']){
                case 'docx File':
                    $ftype = 'ri-file-word-2-line';
                    break;
                case 'xlsx File':
                    $ftype = 'ri-file-excel-2-line';
                    break;
                case 'pdf File':
                    $ftype = 'ri-file-pdf-line';
                break;
                case 'ppt File':
                    $ftype = 'ri-file-ppt-2-line';
                    break;
                case 'zip File':
                    $ftype = 'ri-folder-zip-line';
                    break;
                case 'mp4 File':
                    $ftyp = 'ri-video-line';
                    break;
                case 'png File':
                    $ftyp = 'ri-image-2-fill';
                    break;
                case 'jpeg File':
                    $ftyp = 'ri-image-2-fill';
                    break;
                case 'jpg File':
                    $ftyp = 'ri-image-2-fill';
                    break;
            }
            $output .= "
                <tr>
                    <td>
                        <div class='d-flex align-items-center'>
                            <div class='avatar-sm'>
                                <div
                                    class='avatar-title bg-light text-secondary rounded fs-24'>
                                    <i class='{$ftype}'></i>
                                </div>
                            </div>
                            <div class='ms-3 flex-grow-1'>
                                <h5 class='fs-14 mb-0'><a href='javascript:void(0)'
                                        class='text-dark'>{$row['file_name']}</a>
                                </h5>
                            </div>
                        </div>
                    </td>
                    <td>{$row['type']}</td>
                    <td>{$row['size']}</td>
                    <td>{$row['u_date']}</td>
                    <td>
                        <div class='dropdown'>
                            <a href='javascript:void(0);'
                                class='btn btn-soft-secondary btn-sm btn-icon'
                                data-bs-toggle='dropdown' aria-expanded='true'>
                                <i class='ri-more-fill'></i>
                            </a>
                            <ul class='dropdown-menu dropdown-menu-end'>
                                <li><a class='dropdown-item'
                                        href='../assets/img/Project_files/{$row['file_name']}' target='_blank'><i
                                            class='ri-eye-fill me-2 align-bottom text-muted'></i>View</a>
                                </li>
                                <li><a class='dropdown-item'
                                href='../assets/img/Project_files/{$row['file_name']}' id='{$row['file_id']}' download='{$row['file_name']}'><i
                                            class='ri-download-2-fill me-2 align-bottom text-muted'></i>Download</a>
                                </li>
                                <li class='dropdown-divider'></li>
                                <li><a class='dropdown-item del_file'
                                        href='javascript:void(0);' id='{$row['file_id']}'><i
                                            class='ri-delete-bin-5-fill me-2 align-bottom text-muted'></i>Delete</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            ";
        }
    }else{
        $output .= "
        <tr><td colspan='5'>No files are uploaded..!</td></tr>";
    }
    $output .=" </tbody>
    </table>";
    echo $output;
}



// delete file
if(isset($_POST['flag']) and $_POST['flag']=='del_file'){
    $id = $_POST['id'];
    $sql = "DELETE FROM `filetb` WHERE file_id='{$id}'";
    $res = mysqli_query($conn,$sql);
}



// load_profile
if (isset($_POST['flag']) and $_POST['flag'] == 'load_user_profile') {
    $emp_code = $_SESSION['emp_code'];
    $sql = "SELECT e1.firstname,e1.middlename,e1.lastname,e1.hiredate,e1.role,e2.personal_phoneNO,e1.email,e2.profile_picture,e2.city,e2.state,e2.address,e2.country,e2.profile_picture,p.description,p.skills,p.linkedin_portfolio,p.facebook_portfolio,p.instagram_portfolio,p.github_portfolio,p.bg_cover FROM employeetb e1,emp_personal_infotb e2,profile p WHERE e1.emp_code=e2.emp_code and e1.emp_code=p.emp_code and e2.emp_code=p.emp_code and e1.emp_code='{$emp_code}'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);
}

//load data in profile edit
if(isset($_POST['flag']) and $_POST['flag'] =="load_data_in_profile"){
    $id=$_SESSION['emp_code'];
    $sql = "SELECT e1.firstname,e1.middlename,e1.lastname,e1.hiredate,e1.role,e2.personal_phoneNO,e1.email,e2.city,e2.state,e2.address,e2.zip_code,e2.country,e2.profile_picture,p.description,p.skills,p.linkedin_portfolio,p.facebook_portfolio,p.instagram_portfolio,p.github_portfolio,p.bg_cover FROM employeetb e1,emp_personal_infotb e2,profile p WHERE e1.emp_code=e2.emp_code and e1.emp_code=p.emp_code and e2.emp_code=p.emp_code and e1.emp_code='{$id}'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);
}

// remove profile pictur
// if (isset($_POST['flag']) and $_POST['flag'] == 'del_proc_picture') {
//     $emp_code = $_SESSION['emp_code'];
//     $sql = "UPDATE `emp_personal_infotb` SET `profile_picture`='' WHERE `emp_code`='{$emp_code}'";
//     $res = mysqli_query($conn, $sql);
//     if ($res) {
//         echo 1;
//     } else {
//         echo 0;
//     }
// }

//update profile edit data 
if (isset($_POST['flag']) and $_POST['flag'] == 'UpdateEditProfileData'){
    $id=$_SESSION['emp_code'];

    //employee Data
    $email=$_POST['emailProfileInput'];
    $fname=$_POST['firstnameProfileInput'];
    $lname=$_POST['lastnameProfileInput'];
    $joindate=$_POST['JoiningdatProfileInput'];


    //personal info 
    
    $city=$_POST['cityProfileInput'];
    $zcode=$_POST['zipcodeProfileInput'];
    $country=$_POST['countryProfileInput'];
    $pno=$_POST['phonenumberProfileInput'];
    

    //portfolio data
    $insta=$_POST['insta'];
    $facebook=$_POST['facebook'];
    $github=$_POST['github'];
    $linkedin=$_POST['linkedin'];
    $skill=$_POST['skill'];
    $Desc=$_POST['descriptionProfileInput'];

    $sql1="UPDATE `employeetb` SET `email`='{$email}',`firstname`='{$fname}',`lastname`='{$lname}',`hiredate`='{$joindate}' WHERE `emp_code`='{$id}'";
    $res1=mysqli_query($conn,$sql1);

    $sql2="UPDATE `emp_personal_infotb` SET `city`='{$city}',`zip_code`='{$zcode}',`country`='{$country}',`personal_phoneNO`='{$pno}'WHERE `emp_code`='{$id}'";
    $res2=mysqli_query($conn,$sql2);

    $sql3="UPDATE `profile` SET `skills`='{$skill}',`description`='{$Desc}',`instagram_portfolio`='{$insta}',`github_portfolio`='{$github}',`facebook_portfolio`='{$facebook}',`linkedin_portfolio`='{$linkedin}' WHERE `emp_code`='{$id}'";
    $res3=mysqli_query($conn,$sql3);

    if($res1 && $res2 && $res3)
    {
        echo 1;
    }else{
        echo 0;
    }

}

// profile_page_upload
if(isset($_POST['flag']) and $_POST['flag']=='change_profile_Image'){
    $id=$_SESSION['emp_code'];
    $fileinfo = @getimagesize($_FILES["profileimg"]["tmp_name"]);
    
    $size = $fileinfo['bits'];

    if($size < 16000000){
        // $filename   = 'profile' . "-" . $id; 
        $filename   = $_FILES["profileimg"]["name"]; 
        $extension  = pathinfo( $_FILES["profileimg"]["name"], PATHINFO_EXTENSION );
        $basename   = $filename; 
        // $basename   = $filename . "." . $extension; 
        move_uploaded_file($_FILES['profileimg']['tmp_name'],"../img/profile/" . $basename);
        $sql = "UPDATE `emp_personal_infotb` SET `profile_picture`='{$basename}' WHERE `emp_code`='{$id}'";
        $res = mysqli_query($conn,$sql);
        if($res){
            echo 1;
        }
    }else{
        echo 2;
    }       
}

// //change profile background images
if(isset($_POST["flag"]) && $_POST["flag"]=="change_background")
{
    $id=$_SESSION['emp_code'];
    $fileinfo = @getimagesize($_FILES["cover_bgbtn"]["tmp_name"]);
    
    $size = $fileinfo['bits'];

    if($size < 16000000){
        // $filename   = 'BgProfile' . "-" . $id; 
        $filename   = $_FILES["cover_bgbtn"]["name"]; 
        $extension  = pathinfo( $_FILES["cover_bgbtn"]["name"], PATHINFO_EXTENSION );
        $basename   = $filename; 
        // $basename   = $filename . "." . $extension; 
        move_uploaded_file($_FILES['cover_bgbtn']['tmp_name'],"../img/profile_background/" . $basename);
        $sql = "UPDATE `profile` SET `bg_cover`='{$basename}' WHERE `emp_code`='{$id}'";
        $res = mysqli_query($conn,$sql);
        if($res){
            echo $basename;
        }
    }else{
        echo 2;
    }   
}

//Load progress bar
if(isset($_POST['flag']) && $_POST['flag']=="load_progressbar"){
    $id=$_SESSION['emp_code'];
    $sql="SELECT e1.firstname,e1.middlename,e1.lastname,e1.hiredate,e1.role,e2.personal_phoneNO,e1.email,e2.city,e2.state,e2.address,e2.zip_code,e2.country,e2.profile_picture,p.description,p.skills,p.linkedin_portfolio,p.facebook_portfolio,p.instagram_portfolio,p.github_portfolio,p.bg_cover FROM employeetb e1,emp_personal_infotb e2,profile p WHERE e1.emp_code=e2.emp_code and e1.emp_code=p.emp_code and e2.emp_code=p.emp_code and e1.emp_code='{$id}'";
    $res=mysqli_query($conn,$sql);

    $data=mysqli_fetch_array($res);
    $i=0;
    if($data['firstname']=="" && $data['lastname']=="" )
    {
        $i++;
    }
    if($data['personal_phoneNO']=="")
    {
        $i++;
    }
    if($data['email']=="")
    {
        $i++;
    }
    if($data['city']=="")
    {
        $i++;
    }
    if($data['role']=="")
    {
        $i++;
    }
    if($data['hiredate']=="")
    {
        $i++;
    }
    if($data['description']=="")
    {
        $i++;
    }
    if($data['skills']=="")
    {
        $i++;
    }
    if($data['linkedin_portfolio']=="")
    {
        $i++;
    }
    if($data['facebook_portfolio']=="")
    {
        $i++;
    }
    if($data['instagram_portfolio']=="")
    {
        $i++;
    }
    if($data['github_portfolio']=="")
    {
        $i++;
    }
    if($data['profile_picture']=="")
    {
        $i++;
    }

    $i=13-$i;
    $per=($i*100)/13;
    echo round($per);
}

//edit profile progressbar 
if(isset($_POST['flag']) && $_POST['flag']=="edit_profile_progress")
{
    $id=$_SESSION['emp_code'];
    $sql="SELECT e1.firstname,e1.middlename,e1.lastname,e1.hiredate,e1.role,e2.personal_phoneNO,e1.email,e2.city,e2.state,e2.address,e2.zip_code,e2.country,e2.profile_picture,p.description,p.skills,p.linkedin_portfolio,p.facebook_portfolio,p.instagram_portfolio,p.github_portfolio,p.bg_cover FROM employeetb e1,emp_personal_infotb e2,profile p WHERE e1.emp_code=e2.emp_code and e1.emp_code=p.emp_code and e2.emp_code=p.emp_code and e1.emp_code='{$id}'";
    $res=mysqli_query($conn,$sql);
    $data=mysqli_fetch_array($res);
    $i=0;

    if($data['firstname']=="")
    {
        $i++;
    }

    if($data['lastname']=="")
    {
        $i++;
    }

    if($data['personal_phoneNO']=="")
    {
        $i++;
    }
    if($data['email']=="")
    {
        $i++;
    }
    if($data['hiredate']=="")
    {
        $i++;
    }
    if($data['skills']=="")
    {
        $i++;
    }
    if($data['city']=="")
    {
        $i++;
    }
    if($data['country']=="")
    {
        $i++;
    }
    if($data['zip_code']=="")
    {
        $i++;
    }
    if($data['description']=="")
    {
        $i++;
    }

    if($data['profile_picture']=="")
    {
        $i++;
    }
    if($data['linkedin_portfolio']=="")
    {
        $i++;
    }
    if($data['facebook_portfolio']=="")
    {
        $i++;
    }
    if($data['instagram_portfolio']=="")
    {
        $i++;
    }
    if($data['github_portfolio']=="")
    {
        $i++;
    }

    $i=15-$i;
    $per=($i*100)/15;
    echo round($per);
}



//load Client Data
if (isset($_POST["flag"]) && $_POST["flag"] == "loadClientData") {
    $cnt = 0;
    $myobj = (object)[];
    $output = "";
    $user_icon = "";
    $myarr = array();

    $sql="SELECT * FROM `clienttb`";
    $res = mysqli_query($conn, $sql);
    
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $cnt +=1;
            if($data['img'] == ''){
                $user_icon .= "
                    <img src='../assets/img/Clients/proc.jpg' alt='' class='avatar-sm rounded-circle' />
                ";
            }else{
                $user_icon .= "
                    <img src='../assets/img/Clients/{$data['img']}' alt='' class='avatar-sm rounded-circle' />
                ";
            }



            $myobj->cnt = $cnt;
            $myobj->name = $data['client_name'];
            $myobj->profile = $user_icon;
            $myobj->email = $data['email'];
            $myobj->conatct = $data['phone_number1'];
            $myobj->edit = "<a class='dropdown-item edit_client fs-4' id='{$data['client_id']}' href='#' data-bs-toggle='modal' id='' data-bs-target='#EditClientModal'><i class='ri-pencil-fill align-bottom me-2 text-dark'></i></a>";
            $myobj->delete = "<a class='dropdown-item delClient fs-4'  id='{$data['client_id']}' href='#' data-bs-toggle='modal'  data-bs-target='#removeClientModal' ><i class='ri-delete-bin-fill align-bottom me-2 text-danger'></i></a>";
            array_push($myarr,$myobj);
            $myobj = (object)[];


            $user_icon = "";
        }
        echo json_encode($myarr);
    } 
}




//Delete client
if (isset($_POST['flag']) && $_POST['flag'] == 'delClientData') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    // echo $id;
    $sql = "DELETE FROM `clienttb` WHERE client_id='{$id}'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}


//update client
if (isset($_POST['flag']) and $_POST['flag'] == 'clientDataUpdate') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['editclient_name']);
    $email = mysqli_real_escape_string($conn, $_POST['editemail']);
    $address = mysqli_real_escape_string($conn, $_POST['editaddress']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['editzipcode']);
    $phone_number1 = mysqli_real_escape_string($conn, $_POST['editcontact1']);
    $phone_number2 = mysqli_real_escape_string($conn, $_POST['editcontact2']);
    $client_nick_name = mysqli_real_escape_string($conn, $_POST['editnick_name']);
    $billing_rate = mysqli_real_escape_string($conn, $_POST['editbillrate']);
    $fax = mysqli_real_escape_string($conn, $_POST['editfax']);
    $website = mysqli_real_escape_string($conn, $_POST['editwebsite']);
    $notes = mysqli_real_escape_string($conn, $_POST['editnotes']);
    $profile = mysqli_real_escape_string($conn, $_POST['img']);
    $basename   = $profile;
    move_uploaded_file($_FILES['editprofileimg']['tmp_name'], "../img/Clients/" . $basename);


    $sql = "UPDATE `clienttb` SET `client_name`='{$name}',`email`='{$email}',`address`='{$address}',`zipcode`='{$zipcode}',`phone_number1`='{$phone_number1}',`phone_number2`='{$phone_number2}',`client_nick_name`='{$client_nick_name}',`billing_rate`='{$billing_rate}',`fax`='{$fax}',`website`='{$website}',`notes`='{$notes}',`img`='{$profile}' WHERE `client_id`='{$id}'";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}

//add client
if (isset($_POST['flag']) && $_POST['flag'] == 'addclient') {

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $phone_number1 = mysqli_real_escape_string($conn, $_POST['contact1']);
    $phone_number2 = mysqli_real_escape_string($conn, $_POST['contact2']);
    $client_nick_name = mysqli_real_escape_string($conn, $_POST['nick_name']);
    $billing_rate = mysqli_real_escape_string($conn, $_POST['billrate']);
    $fax = mysqli_real_escape_string($conn, $_POST['fax']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);



    $profile = mysqli_real_escape_string($conn, $_POST['img']);


    $basename   = $profile;
    move_uploaded_file($_FILES['profileimg']['tmp_name'], "../img/Clients/" . $basename);

    $sql = "INSERT INTO `clienttb`(`client_id`, `client_name`, `email`, `address`, `country`, `state`, `city`, `zipcode`, `phone_number1`, `phone_number2`, `client_nick_name`, `billing_rate`, `fax`, `website`, `notes`,`img`) VALUES ('{$id}','{$name}','{$email}','{$address}','{$country}','{$state}','{$city}','{$zipcode}','{$phone_number1}','{$phone_number2}','{$client_nick_name}','{$billing_rate}','{$fax}','{$website}','{$notes}','{$profile}')";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}

//client edit data
if (isset($_POST['flag']) && $_POST['flag'] == "load_edit_client") {
    $cid = mysqli_real_escape_string($conn, $_POST['cid']);
    $sql = "SELECT * FROM `clienttb` where `client_id`='{$cid}'";
    $res = mysqli_query($conn, $sql);
    $cnt = mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);
    $data = json_encode($row);
    echo $data;
}


// ========================================================= employee data
//add employee
if(isset($_POST["flag"]) and $_POST["flag"]=="addEmp")
{
    $emp_code=substr(uniqid("emp"),0,10);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $fname=mysqli_real_escape_string($conn,$_POST['fname']);
    $mname=mysqli_real_escape_string($conn,$_POST['mname']);
    $lname=mysqli_real_escape_string($conn,$_POST['lname']);
    $pass=mysqli_real_escape_string($conn,$_POST['pass']);
    $pass1=mysqli_real_escape_string($conn,$_POST['pass1']);
    $role=mysqli_real_escape_string($conn,$_POST['options']);
    $depaertment=mysqli_real_escape_string($conn,$_POST['depaertment']);
    if($pass==$pass1)
    {
        $sql="INSERT INTO `employeetb`(`emp_code`, `email`, `password`, `firstname`, `middlename`, `lastname`, `role`,  `dept_id`) VALUES ('{$emp_code}','{$email}','{$pass}','{$fname}','{$mname}','{$lname}','{$role}','{$depaertment}')";
        $sql2="INSERT INTO `emp_extra_infotb`(`emp_code`) VALUES ('{$emp_code}')";
        $sql3="INSERT INTO `emp_personal_infotb`(`emp_code`) VALUES ('{$emp_code}')";
        $sql4="INSERT INTO `profile`(`emp_code`) VALUES ('{$emp_code}')";
        $res=mysqli_query($conn,$sql);
        $res2=mysqli_query($conn,$sql2);
        $res3=mysqli_query($conn,$sql3);
        $res4=mysqli_query($conn,$sql4);

        if($res && $res2 && $res3 && $res4)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }
    echo $email;
}


// //load personal info table
// if(isset($_POST["flag"]) and $_POST["flag"]=="load_personal_details")
// {
//     $id=mysqli_real_escape_string($conn,$_POST['id']);
//     $sql="SELECT * FROM `emp_extra_infotb` WHERE `emp_code`='{$id}'";
//     $res=mysqli_query($conn,$sql);
//     if(mysqli_num_rows($res)==1)
//     {
//         $data=mysqli_fetch_assoc($res);
//         echo json_encode($data);
//     }
// }

// //load child table
// if(isset($_POST["flag"]) and $_POST["flag"]=="load_personal_child_details")
// {
//     $id=mysqli_real_escape_string($conn,$_POST['id']);
//     $sql="SELECT * FROM `childtb` WHERE `emp_code`='{$id}'";
//     $res=mysqli_query($conn,$sql);
//     $output="";
//     $c=0;
//     if($res)
//     {
//         $output="
//         <tr>
//             <th>Sr No.</th>
//             <th>Child Name</th>
//             <th>Child BirthDate</th>
//             <th>Child Age</th>
//             <th>Child Gender</th>
//             <th>Edit</th>
//             <th>Delete</th>
//         </tr>
//         ";
//         while($data=mysqli_fetch_assoc($res))
//         {
//             $c++;
//             $output.="
//             <tr>
//                 <td>
//                     {$c}
//                 </td>
//                 <td>
//                     {$data['name']}
//                 </td>
//                 <td>
//                     {$data['birthdate']}
//                 </td>
//                 <td>
//                     {$data['age']}
//                 </td>
//                 <td class='w-25'>
//                     {$data['gender']}
//                 </td>
//                 <td>
//                     <a href='#' id='{$data['child_id']}' class='cEdit'>EDIT</a>
//                 </td>
//                 <td>
//                     <a href='#' id='{$data['child_id']}' class='cDelete'>DELETE</a>
//                 </td>
//             </tr>
//             ";
//         }
//         echo $output;
//     }
// }


// //insert child table
// if(isset($_POST["flag"]) and $_POST["flag"]=="insertChild")
// {
//     $name=mysqli_real_escape_string($conn,$_POST['name']);
//     $cbd=mysqli_real_escape_string($conn,$_POST['cbd']);
//     $cage=mysqli_real_escape_string($conn,$_POST['cage']);
//     $gender=mysqli_real_escape_string($conn,$_POST['cgender']);
//     $id=mysqli_real_escape_string($conn,$_POST['id']);
//     $sql="INSERT INTO `childtb`( `name`, `birthdate`, `age`, `gender`, `emp_code`) VALUES ('{$name}','{$cbd}','{$cage}','{$gender}','{$id}')";
//     $res=mysqli_query($conn,$sql);
//     if($res)
//     {
//         echo 1;
//     }
//     else{
//         echo 0;
//     }
// }

// //delete child
// if(isset($_POST["flag"]) and $_POST["flag"]=="deleteChild")
// {
//     $id=mysqli_real_escape_string($conn,$_POST['id']);
//     $sql="DELETE FROM `childtb` WHERE `child_id`={$id}";
//     $res=mysqli_query($conn,$sql);
//     if($res)
//     {
//         echo 1;
//     }
//     else{
//         echo 0;
//     }
// }


// //reflect child
// if(isset($_POST["flag"]) and $_POST["flag"]=="reflectChild")
// {
//     $id=mysqli_real_escape_string($conn,$_POST['id']);
//     $sql="SELECT * FROM `childtb` WHERE `child_id`={$id}";
//     $res=mysqli_query($conn,$sql);
//     if(mysqli_num_rows($res)==1)
//     {
//         $data=mysqli_fetch_assoc($res);
//         echo json_encode($data);
//     }
// }   

// //update child
// if(isset($_POST["flag"]) and $_POST["flag"]=="updateChild")
// {
//     // echo 1;
//     $name=mysqli_real_escape_string($conn,$_POST['name']);
//     $cbd=mysqli_real_escape_string($conn,$_POST['cbd']);
//     $cage=mysqli_real_escape_string($conn,$_POST['cage']);
//     $gender=mysqli_real_escape_string($conn,$_POST['gender']);
//     $cid=mysqli_real_escape_string($conn,$_POST['cid']);
//     $sql="UPDATE `childtb` SET `name`='{$name}',`birthdate`='{$cbd}',`age`='{$cage}',`gender`='{$gender}' WHERE `child_id`='{$cid}'";
//     $res=mysqli_query($conn,$sql);
//     if($res)
//     {
//         echo 1;
//     }
//     else{
//         echo 0;
//     }
// }


//update employee extra personal info
// if(isset($_POST["flag"]) and $_POST["flag"]=="updateEPEmp")
// {
//     $id=mysqli_real_escape_string($conn,$_POST['empId']);
//     $sname=mysqli_real_escape_string($conn,$_POST['spouse_name']);
//     $sbd=mysqli_real_escape_string($conn,$_POST['spouse_bd']);
//     $ebd=mysqli_real_escape_string($conn,$_POST['emp_bd']);
//     $ad=mysqli_real_escape_string($conn,$_POST['anni_date']);
//     $gen=mysqli_real_escape_string($conn,$_POST['gender']);
//     $sql="UPDATE `emp_extra_infotb` SET `emp_gender`='{$gen}',`spouse_name`='{$sname}',`spouse_birthdate`='{$sbd}',`emp_birthdate`='{$ebd}',`anniversary_date`='{$ad}' WHERE `emp_code`='{$id}'";
//     echo $id;
//     $res=mysqli_query($conn,$sql);
//     if($res)
//     {
//         echo 1;
//     }
//     else{
//         echo 2;
//     }
// }




//load department
if(isset($_POST["flag"]) and $_POST["flag"]=="loadDept")
{
    $sql="SELECT * FROM `departmenttb`";
    $res= mysqli_query($conn,$sql);
    $output="<option value=''>All</option>";
    if($res)
    {
    while($data=mysqli_fetch_assoc($res))
    {
            $output.="<option value='{$data['dept_id']}'>{$data['name']}</option>";
    }
    echo $output;
    }
    else{
        echo 0;
    }
}

// load location according to department
if(isset($_POST["flag"]) and $_POST["flag"]=="loadLocation")
{
    $sql="SELECT DISTINCT `location` FROM `departmenttb`";
    $res= mysqli_query($conn,$sql);
    $output="<option value='none'>None</option>";
    if($res)
    {
    while($data=mysqli_fetch_assoc($res))
    {
            $output.="<option value='{$data['location']}'>{$data['location']}</option>";
    }
    echo $output;
    }
    else{
        echo 0;
    }
}

// update employee data1
// if(isset($_POST['flag']) and $_POST['flag']=='Per_det_edit1'){
//     $id = mysqli_real_escape_string($conn,$_POST['id']);
//     $email = mysqli_real_escape_string($conn,$_POST['email']);
//     $pwd1 = mysqli_real_escape_string($conn,$_POST['pwd1']);
//     $pwd2 = mysqli_real_escape_string($conn,$_POST['pwd2']);
//     $jobtitle = mysqli_real_escape_string($conn,$_POST['jobtitle']);
//     $dept = mysqli_real_escape_string($conn,$_POST['dept']);
//     $location = mysqli_real_escape_string($conn,$_POST['location']);
//     $empstatus = mysqli_real_escape_string($conn,$_POST['empstatus']);
//     $empmanager = mysqli_real_escape_string($conn,$_POST['empmanager']);
//     $emptype = mysqli_real_escape_string($conn,$_POST['emptype']);
//     $workingDaytype = mysqli_real_escape_string($conn,$_POST['workingDaytype']);
//     $hiredDate = mysqli_real_escape_string($conn,$_POST['hiredDate']);
//     if($empstatus == 'active'){
//         $terminationDate = NULL;
//     }else{
//         $terminationDate = mysqli_real_escape_string($conn,$_POST['terminationDate']);
//     }

//     $sql1 = "UPDATE `employeetb` SET `email`='{$email}',`password`='{$pwd1}',`role`='{$emptype}',`hiredate`='{$hiredDate}',`dept_id`='$dept' WHERE `emp_code`='{$id}'";
//     $res1 = mysqli_query($conn,$sql1);
//     $sql2 = "UPDATE `emp_personal_infotb` SET `job_title`='{$jobtitle}',`dept_location`='{$location}',`e_status`='{$empstatus}',`e_manager`='{$empmanager}',`working_day_type`='{$workingDaytype}',`termination_date`='{$terminationDate}' WHERE `emp_code`='{$id}'";
    
//     $res2 = mysqli_query($conn,$sql2);
//     if($res1 and $res2){
//         echo 1;
//     }else{
//         echo 0;
//     }    
// }
// update employee data1

if(isset($_POST['flag']) and $_POST['flag']=='logininfo_editBtn'){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pwd1 = mysqli_real_escape_string($conn,$_POST['pwd1']);
    $pwd2 = mysqli_real_escape_string($conn,$_POST['pwd2']);
    $jobtitle = mysqli_real_escape_string($conn,$_POST['jobtitle']);
    $dept = mysqli_real_escape_string($conn,$_POST['dept']);
    $location = mysqli_real_escape_string($conn,$_POST['location']);
    $empstatus = mysqli_real_escape_string($conn,$_POST['empstatus']);
    $empmanager = mysqli_real_escape_string($conn,$_POST['empmanager']);
    $emptype = mysqli_real_escape_string($conn,$_POST['emptype']);
    $workingDaytype = mysqli_real_escape_string($conn,$_POST['workingDaytype']);
    $hiredDate = mysqli_real_escape_string($conn,$_POST['hiredDate']);
    if($empstatus == 'active'){
        $terminationDate = NULL;
    }else{
        $terminationDate = mysqli_real_escape_string($conn,$_POST['terminationDate']);
    }

    $sql1 = "UPDATE `employeetb` SET `email`='{$email}',`password`='{$pwd1}',`role`='{$emptype}',`hiredate`='{$hiredDate}',`dept_id`='$dept' WHERE `emp_code`='{$id}'";
    $res1 = mysqli_query($conn,$sql1);
    $sql2 = "UPDATE `emp_personal_infotb` SET `job_title`='{$jobtitle}',`dept_location`='{$location}',`e_status`='{$empstatus}',`e_manager`='{$empmanager}',`working_day_type`='{$workingDaytype}',`termination_date`='{$terminationDate}' WHERE `emp_code`='{$id}'";
    
    $res2 = mysqli_query($conn,$sql2);
    if($res1 and $res2){
        echo 1;
    }else{
        echo 0;
    }    
}

// update employee data
if(isset($_POST['flag']) and $_POST['flag']=='personalDetails_btn'){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $mname = mysqli_real_escape_string($conn,$_POST['mname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $zipcode = mysqli_real_escape_string($conn,$_POST['zipcode']);
    $country = mysqli_real_escape_string($conn,$_POST['countryId']);
    $state = mysqli_real_escape_string($conn,$_POST['state']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $mobileno = mysqli_real_escape_string($conn,$_POST['mobileno']);
    $workno = mysqli_real_escape_string($conn,$_POST['workno']);
    $homeno = mysqli_real_escape_string($conn,$_POST['homeno']);

    $sql1 = "UPDATE `employeetb` SET `firstname`='{$fname}',`middlename`='{$mname}',`lastname`='{$lname}' WHERE `emp_code`='{$id}'";
    $res1 = mysqli_query($conn,$sql1);
    $sql2 = "UPDATE `emp_personal_infotb` SET `address`='{$address}',`state`='{$state}',`city`='{$city}',`zip_code`='{$zipcode}',`country`='{$country}',`home_phoneNO`='{$homeno}',`work_phoneNO`='{$workno}',`personal_phoneNO`='{$mobileno}' WHERE `emp_code`='{$id}'";
    $res2 = mysqli_query($conn,$sql2);
    if($res1 and $res2){
        echo 1;
    }else{
        echo 0;
    }
    
}

// load more data of employee
if(isset($_POST['flag']) and $_POST['flag']=='load_dynamic_data'){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $sql12="SELECT * FROM `emp_personal_infotb` WHERE `emp_code`='{$id}'";
    $res12= mysqli_query($conn,$sql12);
    $row = mysqli_fetch_assoc($res12);
    echo json_encode($row);
}

// load more data of employee1
if(isset($_POST['flag']) and $_POST['flag']=='load_dynamic_data1'){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $sql12="SELECT * FROM `emp_personal_infotb` a,employeetb b WHERE a.emp_code=b.emp_code and a.emp_code='{$id}'";
    $res12= mysqli_query($conn,$sql12);
    $row = mysqli_fetch_assoc($res12);
    echo json_encode($row);
}



// update employee data
if(isset($_POST['flag']) and $_POST['flag']=='Per_det_edit'){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $mname = mysqli_real_escape_string($conn,$_POST['mname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $zipcode = mysqli_real_escape_string($conn,$_POST['zipcode']);
    $country = mysqli_real_escape_string($conn,$_POST['countryId']);
    $state = mysqli_real_escape_string($conn,$_POST['state']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $mobileno = mysqli_real_escape_string($conn,$_POST['mobileno']);
    $workno = mysqli_real_escape_string($conn,$_POST['workno']);
    $homeno = mysqli_real_escape_string($conn,$_POST['homeno']);

    $sql1 = "UPDATE `employeetb` SET `firstname`='{$fname}',`middlename`='{$mname}',`lastname`='{$lname}' WHERE `emp_code`='{$id}'";
    $res1 = mysqli_query($conn,$sql1);
    $sql2 = "UPDATE `emp_personal_infotb` SET `address`='{$address}',`state`='{$state}',`city`='{$city}',`zip_code`='{$zipcode}',`country`='{$country}',`home_phoneNO`='{$homeno}',`work_phoneNO`='{$workno}',`personal_phoneNO`='{$mobileno}' WHERE `emp_code`='{$id}'";
    $res2 = mysqli_query($conn,$sql2);
    if($res1 and $res2){
        echo 1;
    }else{
        echo 0;
    }
    
}

// edit data load
if(isset($_POST['flag']) and $_POST['flag']=='load_emp_data'){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $sql="SELECT * FROM `employeetb` e ,`departmenttb` d WHERE e.dept_id=d.dept_id and `emp_code`='{$id}'";
    $res= mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row);
}

// signature_upload
if(isset($_POST['flag']) and $_POST['flag']=='signature_upload'){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $target_dir="../img/signature/";
    $fileinfo = @getimagesize($_FILES["file"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];
    $size = $fileinfo['bits'];
    if($width <= 180 and $height <= 100){
        if($size < 16000000){
            $filename   = 'signature' . "-" . $id; 
            $extension  = pathinfo( $fname, PATHINFO_EXTENSION );
            $basename   = $filename . "." . $extension; 
            move_uploaded_file($_FILES['file']['tmp_name'],"../img/signature/" . $basename);
            $sql = "UPDATE `emp_personal_infotb` SET `signature`='{$basename}' WHERE `emp_code`='{$id}'";
            $res = mysqli_query($conn,$sql);
            if($res){
                echo 1;
            }
        }else{
            echo 2;
            // echo "Please size is 2 MB";
        }
    }else{
        // echo "Signature Size(Width 180px height 100px)";
        echo 3;
    }
}

// profile_upload
if(isset($_POST['flag']) and $_POST['flag']=='profile_upload'){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $target_dir="../img/profile/";
    $fileinfo = @getimagesize($_FILES["proc"]["tmp_name"]);
    
    $size = $fileinfo['bits'];

    if($size < 16000000){
        $filename   = 'profile' . "-" . $id; 
        $extension  = pathinfo( $fname, PATHINFO_EXTENSION );
        $basename   = $filename . "." . $extension; 
        move_uploaded_file($_FILES['proc']['tmp_name'],"../img/profile/" . $basename);
        $sql = "UPDATE `emp_personal_infotb` SET `profile_picture`='{$basename}' WHERE `emp_code`='{$id}'";
        $res = mysqli_query($conn,$sql);
        if($res){
            echo 1;
        }
    }else{
        echo 2;
    }       
}

// signature loading 
if(isset($_POST['flag']) and $_POST['flag']=='load_dynamic_data3'){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $sql12="SELECT signature FROM `emp_personal_infotb` WHERE `emp_code`='{$id}'";
    $res12= mysqli_query($conn,$sql12);
    $row = mysqli_fetch_assoc($res12);
    echo json_encode($row);
}

// profile loading 
if(isset($_POST['flag']) and $_POST['flag']=='load_dynamic_data4'){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $sql12="SELECT profile_picture FROM `emp_personal_infotb` WHERE `emp_code`='{$id}'";
    $res12= mysqli_query($conn,$sql12);
    $row = mysqli_fetch_assoc($res12);
    echo json_encode($row);
}

// ======================================================================================================================
// ======================================================================================================================
// 
//load employee data 
if(isset($_POST["flag"]) and $_POST["flag"]=="loadEmpData"){
    $limit = '6';
    $page = 1;
    if($_POST['page'] > 1)
    {
    $start = (($_POST['page'] - 1) * $limit);
    $page = $_POST['page'];
    }
    else
    {
    $start = 0;
    }

    $query = "
    SELECT * FROM `employeetb` e ,`departmenttb` d,`emp_personal_infotb` ep WHERE e.dept_id=d.dept_id and role!='admin' AND e.emp_code=ep.emp_code
    ";

    if($_POST['query1'] != '' or $_POST['query2'] != '') 
    {

    $data1=$_POST['query1'];
    $data2=$_POST['query2'];
    if($data1!="" AND $data2=="")
    {
        $query .= "
        AND firstname LIKE '{$data1}%'
        ";
    }
    else if($data1=="" AND $data2!="")
    {
        $query .= "
        AND  d.dept_id LIKE '{$data2}%'
        ";
    }
    else if($data1!="" AND $data2!="")
    {
        $query .= "
        AND  d.dept_id LIKE '{$data2}%' AND  firstname LIKE '{$data1}%'
        ";
    }

    }

    $filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

    $res=mysqli_query($conn,$query);
    $total_data=mysqli_num_rows($res);

    $res=mysqli_query($conn,$filter_query);
    $total_filter_data=mysqli_num_rows($res);
    $output = "

    <table class='table table-hover align-middle mb-0 fs-5'>
    <thead class='table bg-soft-secondary'>
        <tr>
            <th class='text-center' scope='col'>ID</th>
            <th class=' text-center' scope='col'>CODE</th>
            <th class=' text-center' scope='col'>EMPLOYEE</th>
            <th class=' text-center' scope='col'>DEPARTMENT</th>
            <th class=' text-center' scope='col'>LOCATION</th>
            <th class=' text-center' scope='col'>PERSONAL INFO</th>
            <th class=' text-center' scope='col'>EDIT</th>
            <th class=' text-center' scope='col'>REMOVE</th>
        </tr>
    </thead>
    <tbody id='empData' class='bg-white'>

    ";
    // $output .= '
    // <label>Total Records - '.$total_data.'</label>

    // ';
    $c=$start;
    if($total_data > 0)
    {
        foreach($res as $data)
        {
                        $c++;
                    
                            $output.="<tr class=''>
                            <td class='text-center'><a class='fw-semibold text-center'>{$c}</a></td>
                            <td class='text-center'>{$data['emp_code']}</td>
                            <td class='px-1'>
                                <div class='d-flex gap-2 align-items-center mx-2'>
                                <div class='d-flex gap-2 ms-5'>
                                    <div class='flex-shrink-0'>";
                                    if($data['profile_picture']=="")
                                    {
                                        $output.="<img src='../assets/img/profile/userIcon.jpg' alt='' class='avatar-xs rounded-circle' />";
                                    }
                                    else
                                    {
                                        $output.="<img src='../assets/img/profile/{$data['profile_picture']}}' alt='' class='avatar-xs rounded-circle' />";
                                    }
                                $output.="</div>
                                    <div
                                    class='d-flex flex-column justify-content-center'>
                                    <h5 class='mb-0 text-sm'>{$data['firstname']} {$data['lastname']}</h5>
                                    <p class='text-xs text-muted mb-0'>
                                    {$data['email']}
                                    </p>
                                </div>
                                </div>
                                </div>
                            </td>
                            <td class='text-center px-3'>{$data['name']}</td>
                            <td class='text-center px-4'>{$data['location']}</td>
                            <td class='text-center px-4'><a href='' class='ePersonalInfo text-primary text-decoration-underline' id='{$data['emp_code']}' data-bs-toggle='modal' data-bs-target='#addEmployeeExtraPersonalModal'>Personal Info</a></td>
                            <td class='text-center px-5 fs-4'><a href='EditInfo.php?id={$data['emp_code']}' id='{$data['emp_code']}' class='edit text-dark' ><i class='ri-edit-2-fill cursor-pointer'></i></a></td>
                            <td class='text-center px-4 fs-4' style='color: red;'><a id='{$data['emp_code']}' class='delete text-danger' href='#' data-bs-toggle='modal' data-bs-target='#removeEmployeeModal'><i class=' ri-delete-bin-5-line cursor-pointer'></i></a></td>
                        </tr> ";
        }

    $output .= '

    </tbody>
    </table>
    <div class="d-flex ">
    <div class="pagination-wrap hstack gap-2" style="display: flex;">
    <ul class="pagination listjs-pagination mb-0">
    ';
    
    $total_links = ceil($total_data/$limit);
    $previous_link = '';
    $next_link = '';
    $page_link = '';
    
    //echo $total_links;
    if($total_links > 4)
    {
        
        if($page < 5)
        {
        for($count = 1; $count < 5; $count++)
        {
            $page_array[] = $count;
        }
        $page_array[] = '...';
        $page_array[] = $total_links;
        }
        else
        {
        $end_limit = $total_links - 5;
        if($page > $end_limit)
        {
            $page_array[] = 1;
            $page_array[] = '...';
            for($count = $end_limit+2; $count <= $total_links; $count++)
            {
            $page_array[] = $count;
            }
        }
        else
        {
            $page_array[] = 1;
            $page_array[] = '...';
            for($count = $page - 1; $count <= $page + 1; $count++)
            {
            $page_array[] = $count;
            }
            $page_array[] = '...';
            $page_array[] = $total_links;
        }
        }
    }
    else
    {
        for($count = 1; $count <= $total_links; $count++)
        {
        $page_array[] = $count;
        
        }
    }
    
    for($count = 0; $count < count($page_array); $count++)
    {
        if($page == $page_array[$count])
        {
        $page_link .= '
        <li class="page-item active">
        <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
        </li>
        ';

        $previous_id = $page_array[$count] - 1;
        if($previous_id > 0)
        {
        $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
        }
        else
        {
        $previous_link = '
        <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
        </li>
        ';
        }
        $next_id = $page_array[$count] + 1;
        if($next_id >= $total_links+1)
        {
        $next_link = '
        <li class="page-item disabled">
            <a class="page-link" href="#">Next</a>
        </li>
            ';
        }
        else
        {
        $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
    }
    else
    {
        if($page_array[$count] == '...')
        {
        $page_link .= '
        <li class="page-item disabled">
            <a class="page-link" href="#">...</a>
        </li>
        ';
        }
        else
        {
        $page_link .= '
        <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
        ';
        }
    }
    }
    
    $output .= $previous_link . $page_link . $next_link;
    $output .= '
        </ul>
    </div>
    </div>
    ';

    }
    else
    {
    $output .= '
    <tr>
        <td colspan="8" align="center">No Data Found</td>
    </tr>
    ';
    }
    echo $output;
}
  

       // delete employee data
       if(isset($_POST["flag"]) and $_POST["flag"]=="deleteEmpData")
       {
           $id=mysqli_real_escape_string($conn,$_POST['id']);
           $sql="DELETE FROM `employeetb` WHERE `emp_code`='{$id}'";
           $res= mysqli_query($conn,$sql);
       }
       
   
   
   
       //load personal info table
       if(isset($_POST["flag"]) and $_POST["flag"]=="load_personal_details")
       {
           $id=mysqli_real_escape_string($conn,$_POST['id']);
           $sql="SELECT * FROM `emp_extra_infotb` WHERE `emp_code`='{$id}'";
           $res=mysqli_query($conn,$sql);
           if(mysqli_num_rows($res)==1)
           {
               $data=mysqli_fetch_assoc($res);
               echo json_encode($data);
           }
       }
   
       //load child table
       if(isset($_POST["flag"]) and $_POST["flag"]=="load_personal_child_details")
       {
           $id=mysqli_real_escape_string($conn,$_POST['id']);
           $sql="SELECT * FROM `childtb` WHERE `emp_code`='{$id}'";
           $res=mysqli_query($conn,$sql);
           $output="";
           $c=0;
           if($res)
           {
               $output="
               <tr class='bg-soft-primary'>
                   <th>Sr No.</th>
                   <th>Child Name</th>
                   <th>Child BirthDate</th>
                   <th>Child Age</th>
                   <th>Child Gender</th>
                   <th>Edit</th>
                   <th>Delete</th>
               </tr>
               ";
               while($data=mysqli_fetch_assoc($res))
               {
                   $c++;
                   $output.="
                   <tr class=''>
                       <td>
                           {$c}
                       </td>
                       <td>
                           {$data['name']}
                       </td>
                       <td>
                           {$data['birthdate']}
                       </td>
                       <td>
                           {$data['age']}
                       </td>
                       <td class='w-25'>
                           {$data['gender']}
                       </td>
                       <td>
                           <a href='#' id='{$data['child_id']}' class='cEdit'>EDIT</a>
                       </td>
                       <td>
                           <a href='#' id='{$data['child_id']}' class='cDelete'>DELETE</a>
                       </td>
                   </tr>
                ";
               }
               echo $output;
           }
       }
   
   
       //insert child table
       if(isset($_POST["flag"]) and $_POST["flag"]=="insertChild")
       {
           $name=mysqli_real_escape_string($conn,$_POST['name']);
           $cbd=mysqli_real_escape_string($conn,$_POST['cbd']);
           $cage=mysqli_real_escape_string($conn,$_POST['cage']);
           $gender=mysqli_real_escape_string($conn,$_POST['cgender']);
           $id=mysqli_real_escape_string($conn,$_POST['id']);
           $sql="INSERT INTO `childtb`( `name`, `birthdate`, `age`, `gender`, `emp_code`) VALUES ('{$name}','{$cbd}','{$cage}','{$gender}','{$id}')";
           $res=mysqli_query($conn,$sql);
           if($res)
           {
               echo 1;
           }
           else{
               echo 0;
           }
       }
   
       //delete child
       if(isset($_POST["flag"]) and $_POST["flag"]=="deleteChild")
       {
           $id=mysqli_real_escape_string($conn,$_POST['id']);
           $sql="DELETE FROM `childtb` WHERE `child_id`={$id}";
           $res=mysqli_query($conn,$sql);
           if($res)
           {
               echo 1;
           }
           else{
               echo 0;
           }
       }
   
   
       //reflect child
       if(isset($_POST["flag"]) and $_POST["flag"]=="reflectChild")
       {
           $id=mysqli_real_escape_string($conn,$_POST['id']);
           $sql="SELECT * FROM `childtb` WHERE `child_id`={$id}";
           $res=mysqli_query($conn,$sql);
           if(mysqli_num_rows($res)==1)
           {
               $data=mysqli_fetch_assoc($res);
               echo json_encode($data);
           }
       }   
   
       //update child
       if(isset($_POST["flag"]) and $_POST["flag"]=="updateChild")
       {
           // echo 1;
           $name=mysqli_real_escape_string($conn,$_POST['name']);
           $cbd=mysqli_real_escape_string($conn,$_POST['cbd']);
           $cage=mysqli_real_escape_string($conn,$_POST['cage']);
           $gender=mysqli_real_escape_string($conn,$_POST['gender']);
           $cid=mysqli_real_escape_string($conn,$_POST['cid']);
           $sql="UPDATE `childtb` SET `name`='{$name}',`birthdate`='{$cbd}',`age`='{$cage}',`gender`='{$gender}' WHERE `child_id`='{$cid}'";
           $res=mysqli_query($conn,$sql);
           if($res)
           {
               echo 1;
           }
           else{
               echo 0;
           }
       }
   
   
       //update employee extra personal info
       if(isset($_POST["flag"]) and $_POST["flag"]=="updateEPEmp")
       {
           $id=mysqli_real_escape_string($conn,$_POST['empId']);
           $sname=mysqli_real_escape_string($conn,$_POST['spouse_name']);
           $sbd=mysqli_real_escape_string($conn,$_POST['spouse_bd']);
           $ebd=mysqli_real_escape_string($conn,$_POST['emp_bd']);
           $ad=mysqli_real_escape_string($conn,$_POST['anni_date']);
           $gen=mysqli_real_escape_string($conn,$_POST['gender']);
           $sql="UPDATE `emp_extra_infotb` SET `emp_gender`='{$gen}',`spouse_name`='{$sname}',`spouse_birthdate`='{$sbd}',`emp_birthdate`='{$ebd}',`anniversary_date`='{$ad}' WHERE `emp_code`='{$id}'";
           $res=mysqli_query($conn,$sql);
           if($res)
           {
               echo 1;
           }
           else{
               echo 2;
           }
       }


//load employee data in add project task team
if (isset($_POST["flag"]) and $_POST["flag"] == "loadProjectTaskTeamData") {
    $task_id=$_POST['tid'];
    $c=0;
    $sql="SELECT emp_code,p_id FROM task WHERE id='{$task_id}'";
    $res=mysqli_query($conn,$sql);
    $flag=0;
    $flag2=0;
    $emp_arr=0;
    if(mysqli_num_rows($res)>0){
        $flag2=1;
    }
        $data=mysqli_fetch_assoc($res);
        $emp_code=$data['emp_code'];
        $p_id=$data['p_id'];
        $emp_arr=explode(",",$emp_code);
        $emp_arr_length=count($emp_arr);
        $output = "
       
        ";
        $sql2="
        SELECT DISTINCT e.emp_code,d.name,d.location,e.firstname,e.email,e.lastname,ep.profile_picture FROM `employeetb` e,`departmenttb` d,emp_personal_infotb ep WHERE e.emp_code IN(SELECT emp_code FROM projectteamtb WHERE project_code='{$p_id}')and `role`!='admin' AND e.dept_id=d.dept_id and ep.emp_code=e.emp_code";
        if($_POST['query1'] != '' or $_POST['query2'] != '') 
        {
    
            $data1=$_POST['query1'];
            $data2=$_POST['query2'];
            if($data1!="" AND $data2=="")
            {
                $sql2 .= "
                AND e.firstname LIKE '{$data1}%'
                ";
            }
            else if($data1=="" AND $data2!="")
            {
                $sql2 .= "
                AND  d.dept_id LIKE '{$data2}%'
                ";
            }
            else if($data1!="" AND $data2!="")
            {
                $sql2 .= "
                AND  d.dept_id LIKE '{$data2}%' AND  e.firstname LIKE '{$data1}%'
                ";
            }
        }
        $res2=mysqli_query($conn,$sql2);
        if($res2)
        {
            while($data=mysqli_fetch_assoc($res2))
            {
                if($flag2==1)
                {
                    for($i=0;$i<$emp_arr_length;$i++)
                    {
                        if($data['emp_code']==$emp_arr[$i])
                        {
                            $flag=1;
                            break;
                        }
                        else{
                            $flag=0;
                        }
                    }
                }
                
                    $c+=1;
                    $output.="<div class='d-flex align-items-center'>
                    <div class='avatar-xs flex-shrink-0 me-3'>";
                    if($data['profile_picture']=="")
                    {
                        $output.="<img src='../assets/img/profile/proc.jpg' alt='' class='img-fluid rounded-circle' />";
                    }
                    else
                    {
                        $output.="<img src='../assets/img/profile/{$data['profile_picture']}}' alt='' class='img-fluid rounded-circle' />";
                    }
                    $output.="</div>
                    <div class='flex-grow-1'>
                        <h5 class='fs-13 mb-0'><a href='#' class='text-body d-block'>{$data['firstname']} {$data['lastname']}</a></h5>
                    </div>
                    <div class='flex-shrink-0'>";
                    if($flag==0)
                    {
                        $output.="<button type='button' class='btn btn-soft-primary btn-sm addempTaskChk px-3'  id='{$data['emp_code']}'>&nbsp;Add&nbsp;</button>
                        </div>
                        </div>";
                    }
                    else{
                        $output.="<button type='button' class='btn btn-soft-danger btn-sm delempTaskChk'  id='{$data['emp_code']}'>Remove</button>
                        </div>
                        </div>";
                    }
                
                
            }
            echo $output;
        }
    // }
}

//add employee in task team
if(isset($_POST['flag']) and $_POST['flag']=="addTaskTeam"){
    $tid=$_POST['tid'];
    $empCode=$_POST['empCode'];
    $sql="SELECT `emp_code` FROM `task` WHERE `id`='{$tid}'";
    $res=mysqli_query($conn,$sql);
    $data=mysqli_fetch_assoc($res);
    $emp_code=$data['emp_code'];
    if($emp_code!="")
    {
        $emp_code.=",".$empCode;
    }
    else{
        $emp_code.=$empCode;
    }
    if($res)
    {
        $sql2="UPDATE `task` SET `emp_code`='{$emp_code}' WHERE `id`='{$tid}'";
        $res2=mysqli_query($conn,$sql2);
        if($res2)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
}

//del employee from task team
if(isset($_POST['flag']) and $_POST['flag']=="delTaskTeam"){
    $tid=$_POST['tid'];
    $empCode=$_POST['empCode'];
    $sql="SELECT `emp_code` FROM `task` WHERE `id`='{$tid}'";
    $res=mysqli_query($conn,$sql);
    $data=mysqli_fetch_assoc($res);
    $emp_code=$data['emp_code'];
    $emp_arr=explode(",",$emp_code);
    $emp_arr_length=count($emp_arr);
    $emp_codes="";
    for($i=0;$i<$emp_arr_length;$i++)
    {
        if($emp_arr[$i]!=$empCode)
        {
            $emp_codes.=$emp_arr[$i].",";
        } 
    }
    $emp_codes=rtrim($emp_codes, ",");
    if($res)
    {
        $sql2="UPDATE `task` SET `emp_code`='{$emp_codes}' WHERE `id`='{$tid}'";
        $res2=mysqli_query($conn,$sql2);
        if($res2)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
}


//add employee in project team
if(isset($_POST['flag']) and $_POST['flag']=="addProjTeam"){
    $pid=$_POST['pid'];
    $empCode=$_POST['empCode'];
    $sql="INSERT INTO `projectteamtb`( `project_code`, `emp_code`) VALUES ('{$pid}','$empCode')";
    $res=mysqli_query($conn,$sql);
    
    if($res)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
    
}

//del employee from project team
if(isset($_POST['flag']) and $_POST['flag']=="delProjTeam"){
    $pid=$_POST['pid'];
    $empCode=$_POST['empCode'];
    $sql="DELETE FROM `projectteamtb` WHERE `project_code`='{$pid}' AND `emp_code`='{$empCode}'";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        echo 1;
    }else{
        echo 0;
    }
}

//add leader in project team
if(isset($_POST['flag']) and $_POST['flag']=="addLeaderProjChk"){
    $pid=$_POST['pid'];
    $empCode=$_POST['empCode'];
    $sql="UPDATE `projectteamtb` SET `isTeamLeader`='0' WHERE `project_code`='{$pid}'";
    $res=mysqli_query($conn,$sql);
    $sql="UPDATE `projectteamtb` SET `isManager`='1',`isTeamLeader`='1' WHERE `project_code`='{$pid}' and `emp_code`='{$empCode}'";
    $res=mysqli_query($conn,$sql);
    
    if($res)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
    
}

//del Leader from project team
if(isset($_POST['flag']) and $_POST['flag']=="delLeaderProjChk"){
    $pid=$_POST['pid'];
    $empCode=$_POST['empCode'];
    $sql="UPDATE `projectteamtb` SET `isManager`='1',`isTeamLeader`='0' WHERE `project_code`='{$pid}' AND `emp_code`='{$empCode}'";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        echo 1;
    }else{
        echo 0;
    }
}


//load employee data in add project team overview page
if (isset($_POST["flag"]) and $_POST["flag"] == "loadProjectTeamDataOverview") {
    if(isset($_SESSION['overview_page_id']))
    {
        $p_id=$_SESSION['overview_page_id'];
    }
    // $p_id=$_POST['pid'];
    $flag=0;
    $output = "";
    $sql2="
    SELECT DISTINCT e.emp_code,d.name,d.location,e.firstname,e.email,e.lastname,ep.profile_picture FROM `employeetb` e,`departmenttb` d,emp_personal_infotb ep WHERE `role`!='admin' AND e.dept_id=d.dept_id and ep.emp_code=e.emp_code";
    if($_POST['query1'] != '' or $_POST['query2'] != '') 
    {

        $data1=$_POST['query1'];
        $data2=$_POST['query2'];
        if($data1!="" AND $data2=="")
        {
            $sql2 .= "
            AND e.firstname LIKE '{$data1}%'
            ";
        }
        else if($data1=="" AND $data2!="")
        {
            $sql2 .= "
            AND  d.dept_id LIKE '{$data2}%'
            ";
        }
        else if($data1!="" AND $data2!="")
        {
            $sql2 .= "
            AND  d.dept_id LIKE '{$data2}%' AND  e.firstname LIKE '{$data1}%'
            ";
        }
    }
    $res2=mysqli_query($conn,$sql2);
    while($data=mysqli_fetch_assoc($res2))
    {
        $sql="SELECT emp_code FROM projectteamtb WHERE project_code='{$p_id}'";
        $res=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
            if($data['emp_code']==$row['emp_code'])
            {
                $flag=1;
            }
        }
        $output.="<div class='d-flex align-items-center'>
        <div class='avatar-xs flex-shrink-0 me-3'>";
        if($data['profile_picture']=="")
        {
            $output.="<img src='../assets/img/profile/proc.jpg' alt='' class='img-fluid rounded-circle' />";
        }
        else
        {
            $output.="<img src='../assets/img/profile/{$data['profile_picture']}}' alt='' class='img-fluid rounded-circle' />";
        }
        $output.="</div>
        <div class='flex-grow-1'>
            <h5 class='fs-13 mb-0'><a href='#' class='text-body d-block'>{$data['firstname']} {$data['lastname']}</a></h5>
        </div>
        <div class='flex-shrink-0'>";
        if($flag==0)
        {
            $output.="<button type='button' class='btn btn-soft-primary btn-sm addempProjOverviewChk px-3'  id='{$data['emp_code']}'>&nbsp;Add&nbsp;</button>
            </div>
            </div>";
        }
        else{
            $output.="<button type='button' class='btn btn-soft-danger btn-sm delempProjOverviewChk'  id='{$data['emp_code']}'>Remove</button>
            </div>
            </div>";
        }
        $flag=0;
    }
    echo $output;
}


//load employeee for select manager on project overview
if(isset($_POST['flag']) and $_POST['flag']=='loadManagerTeamOverview'){
    if(isset($_SESSION['overview_page_id']))
    {
        $p_id=$_SESSION['overview_page_id'];
    }
    // $p_id=$_POST['pid'];
    $flag=0;
    $output = "";
    $sql2="SELECT DISTINCT e.emp_code,d.name,d.location,e.firstname,e.email,e.lastname,ep.profile_picture FROM `employeetb` e,`departmenttb` d,emp_personal_infotb ep,projectteamtb p WHERE `role`!='admin' AND e.dept_id=d.dept_id and ep.emp_code=e.emp_code and e.emp_code=p.emp_code AND p.project_code='{$p_id}'";
    if($_POST['query1'] != '' or $_POST['query2'] != '') 
    {

        $data1=$_POST['query1'];
        $data2=$_POST['query2'];
        if($data1!="" AND $data2=="")
        {
            $sql2 .= "
            AND e.firstname LIKE '{$data1}%'
            ";
        }
        else if($data1=="" AND $data2!="")
        {
            $sql2 .= "
            AND  d.dept_id LIKE '{$data2}%'
            ";
        }
        else if($data1!="" AND $data2!="")
        {
            $sql2 .= "
            AND  d.dept_id LIKE '{$data2}%' AND  e.firstname LIKE '{$data1}%'
            ";
        }
    }
    $res2=mysqli_query($conn,$sql2);
    while($data=mysqli_fetch_assoc($res2))
    {
        $sql="SELECT emp_code FROM projectteamtb WHERE project_code='{$p_id}' AND isManager=TRUE";
        $res=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
            if($data['emp_code']==$row['emp_code'])
            {
                $flag=1;
            }
        }
        $output.="<div class='d-flex align-items-center'>
        <div class='avatar-xs flex-shrink-0 me-3'>";
        if($data['profile_picture']=="")
        {
            $output.="<img src='../assets/img/profile/proc.jpg' alt='' class='img-fluid rounded-circle' />";
        }
        else
        {
            $output.="<img src='../assets/img/profile/{$data['profile_picture']}}' alt='' class='img-fluid rounded-circle' />";
        }
        $output.="</div>
        <div class='flex-grow-1'>
            <h5 class='fs-13 mb-0'><a href='#' class='text-body d-block'>{$data['firstname']} {$data['lastname']}</a></h5>
        </div>
        <div class='flex-shrink-0'>";
        if($flag==0)
        {
            $output.="<button type='button' class='btn btn-soft-primary btn-sm addManagerProjOverviewChk px-3'  id='{$data['emp_code']}'>Employee</button>
            </div>
            </div>";
        }
        else{
            $output.="<button type='button' class='btn btn-soft-danger btn-sm delManagerProjOverviewChk px-3'  id='{$data['emp_code']}'>&nbsp;Manager&nbsp;</button>
            </div>
            </div>";
        }
        $flag=0;
    }
    echo $output;
}


//add manager from project list
if(isset($_POST['flag']) and $_POST['flag']=='addManProjOverviewTeam'){
    $empid = $_POST['empCode'];
    if(isset($_SESSION['overview_page_id']))
    {
        $p_id=$_SESSION['overview_page_id'];
    }
    $sql = "UPDATE `projectteamtb` SET isManager=TRUE WHERE project_code='{$p_id}' AND emp_code='{$empid}'";
    $res = mysqli_query($conn,$sql);
    if($res)
    {
        $sql3 = "UPDATE `employeetb` SET role='manager' WHERE emp_code='{$empid}'";
        $res3 = mysqli_query($conn,$sql3);
        $sql2="SELECT id FROM `projectteamtb` WHERE project_code='{$p_id}' AND isTeamLeader=TRUE";
        $res2 = mysqli_query($conn,$sql2);
        $data=mysqli_fetch_assoc($res2);
        if(mysqli_num_rows($res2)>0)
        {
            echo $data['id'];
        }
        else{
            echo "";
        }
    }
    else{
        echo 0;
    }
}

//delete manager from project list
if(isset($_POST['flag']) and $_POST['flag']=='delManProjOverviewTeam'){
    $empid = $_POST['empCode'];
    if(isset($_SESSION['overview_page_id']))
    {
        $p_id=$_SESSION['overview_page_id'];
    }
    $sql = "UPDATE `projectteamtb` SET isManager=FALSE,isTeamLeader=FALSE WHERE project_code='{$p_id}' AND emp_code='{$empid}'";
    $res = mysqli_query($conn,$sql);
    if($res)
    {
        $sql3 = "UPDATE `employeetb` SET role='user' WHERE emp_code='{$empid}'";
        $res3 = mysqli_query($conn,$sql3);
        $sql2="SELECT id FROM `projectteamtb` WHERE project_code='{$p_id}' AND isTeamLeader=TRUE";
        $res2 = mysqli_query($conn,$sql2);
        $data=mysqli_fetch_assoc($res2);
        if(mysqli_num_rows($res2)>0)
        {
            echo $data['id'];

        }
        else{
            echo "";
        }
    }
    else{
        echo 0;
    }
}

//load manager for select team leader
if(isset($_POST['flag']) and $_POST['flag']=="load_magnager_leader")
{
    $output = "<option value='' disable selected>Select team leader</option>";
    $pId= $_SESSION['overview_page_id'];
    $sql="SELECT p.id,e.* FROM projectteamtb p,employeetb e WHERE project_code=$pId AND isManager=TRUE AND e.emp_code=p.emp_code";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        while($data=mysqli_fetch_assoc($res))
        {
            $output.="
            <option value='{$data['id']}'>{$data['firstname']}</option>
            ";
        }
        echo $output;
    }
}


//add team leader
if(isset($_POST['flag']) and $_POST['flag']=="add_teamLeader")
{

    $pid= $_SESSION['overview_page_id'];
    $ptid=$_POST['ptid'];
    $sql="UPDATE `projectteamtb` SET `isTeamLeader`=FALSE WHERE project_code='{$pid}'";
    $res=mysqli_query($conn,$sql);
    $sql="UPDATE `projectteamtb` SET `isTeamLeader`=TRUE WHERE id='{$ptid}'";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        echo 1;
    }
}

//load team leader
if(isset($_POST['flag']) and $_POST['flag']=="load_leader")
{
    $ptid= $_SESSION['overview_page_id'];
    $sql="SELECT * FROM `projectteamtb` WHERE `isTeamLeader`=TRUE AND project_code='{$ptid}'";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)==1)
    {
        $data=mysqli_fetch_assoc($res);
        echo $data['id'];
    }
}


//add employee in project team
if(isset($_POST['flag']) and $_POST['flag']=="addProjOverviewTeam"){
    if(isset($_SESSION['overview_page_id']))
    {
        $pid=$_SESSION['overview_page_id'];
    }
    $empCode=$_POST['empCode'];
    $sql="INSERT INTO `projectteamtb`( `project_code`, `emp_code`) VALUES ('{$pid}','$empCode')";
    $res=mysqli_query($conn,$sql);
    
    if($res)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
    
}

//del employee from project team
if(isset($_POST['flag']) and $_POST['flag']=="delProjOverviewTeam"){
    if(isset($_SESSION['overview_page_id']))
    {
        $pid=$_SESSION['overview_page_id'];
    }
    $empCode=$_POST['empCode'];
    $sql="DELETE FROM `projectteamtb` WHERE `project_code`='{$pid}' AND `emp_code`='{$empCode}'";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        echo 1;
    }else{
        echo 0;
    }
}

//load employeee on project overview
if(isset($_POST['flag']) and $_POST['flag']=='loadEmpDataOverview'){
    if(isset($_SESSION['overview_page_id']))
    {
        $p_id=$_SESSION['overview_page_id'];
    }
    $sql="SELECT DISTINCT e.emp_code,d.name,d.location,e.firstname,e.email,e.lastname,ep.profile_picture FROM `employeetb` e,`departmenttb` d,emp_personal_infotb ep,projectteamtb p WHERE `role`!='admin' AND e.dept_id=d.dept_id and ep.emp_code=e.emp_code and e.emp_code=p.emp_code AND p.project_code='{$p_id}' LIMIT 0, 5";
    $output="";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        while($data=mysqli_fetch_assoc($res))
        {
            $output.="
            <div class='d-flex align-items-center'>
                <div class='avatar-xs flex-shrink-0 me-3'>";

                if($data['profile_picture']=="")
                {
                    $output.="<img src='../assets/img/profile/proc.jpg' alt='' class='img-fluid rounded-circle' />";
                }
                else
                {
                    $output.="<img src='../assets/img/profile/{$data['profile_picture']}}' alt='' class='img-fluid rounded-circle' />";
                }
                    
                $output.="</div>
                <div class='flex-grow-1'>
                    <h5 class='fs-13 mb-0'><a href='#' class='text-body d-block'>{$data['firstname']}</a></h5>
                </div>
                <div class='flex-shrink-0'>
                    <div class='d-flex align-items-center gap-1'>
                        
                    <button type='button' class='btn btn-soft-danger btn-sm delempProjOverview'  data-bs-toggle='modal'
                    data-bs-target='#removeEmployeeFromProjModal' id='{$data['emp_code']}'>Remove</button>
                        
                    </div>
                </div>
            </div>
            ";
        }
        echo $output;
    }
}

//delete employee from project list
if(isset($_POST['flag']) and $_POST['flag']=='delempProjOverview'){
    $empid = $_POST['empid'];
    if(isset($_SESSION['overview_page_id']))
    {
        $p_id=$_SESSION['overview_page_id'];
    }
    $sql = "DELETE FROM `projectteamtb` WHERE project_code='{$p_id}' AND emp_code='{$empid}'";
    $res = mysqli_query($conn,$sql);
    if($res)
    {
        echo 1;
    }
    else{
        echo 0;
    }
}

// load employee on project overview data
if(isset($_POST['flag']) and $_POST['flag']=='loadProjectTeamOverview')
{
    if(isset($_SESSION['overview_page_id']))
    {
        $p_id=$_SESSION['overview_page_id'];
    }
    $sql="SELECT DISTINCT e.emp_code,d.name,d.location,e.firstname,e.email,e.lastname,ep.profile_picture,p.isManager,p.isTeamLeader FROM `employeetb` e,`departmenttb` d,emp_personal_infotb ep,projectteamtb p WHERE `role`!='admin' AND e.dept_id=d.dept_id and ep.emp_code=e.emp_code and e.emp_code=p.emp_code AND p.project_code='{$p_id}'";
    $output="<div class='row'>";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        while($data=mysqli_fetch_assoc($res))
        {
            $task_count=0;
            $que="SELECT * FROM `projectteamtb` WHERE `emp_code`='{$data['emp_code']}' GROUP BY project_code";
            $result=mysqli_query($conn,$que);
            $projectTotal=mysqli_num_rows($result);

            $que="SELECT `emp_code` FROM `task` WHERE emp_code!=''";
            $result=mysqli_query($conn,$que);
            
            while($response=mysqli_fetch_assoc($result))
            {
                // echo $que;
                $emp_code_task=$response['emp_code'];
                $emp_code_task_arr=explode(",",$emp_code_task);
                for($i=0;$i<count($emp_code_task_arr);$i++)
                {
                    if($emp_code_task_arr[$i]==$data['emp_code'])
                    {
                        $task_count++;
                        break;
                    }
                }
            }
            $output.="
            <div class='col-xxl-3'>
            <div class='card ribbon-box'>
                <div class='row g-0'>
                    <div class='col-lg-12'>

                        <div class='card-body  text-center '>";
                         if($data['isTeamLeader']==TRUE){
                            $output.="
                            <div class='ribbon ribbon-danger ribbon-shape'>Leader</div>
                            ";
                        }else if($data['isManager']==TRUE)
                        {
                            $output.="
                            <div class='ribbon ribbon-success ribbon-shape'>Manager</div>
                            ";
                        }
                            $output.="<div class='w-100 bg-soft-info fs-4' style='height:4rem'>
                            </div>
                            

                                <div class='avatar-md mb-3 mx-auto' style='margin-top:-3rem'>";
                                if($data['profile_picture']=="")
                                {
                                    $output.="<img src='../assets/img/profile/proc.jpg' alt='' class='img-fluid rounded-circle' />";
                                }
                                else
                                {
                                    $output.="<img src='../assets/img/profile/{$data['profile_picture']}}' alt='' class='img-fluid rounded-circle' />";
                                }
                                    
                            $output.="</div>


                            <h5 id='candidate-name' class='mb-0'>{$data['firstname']} {$data['lastname']}</h5>
                            <p id='candidate-position' class='text-muted'>{$data['email']}</p>

                            <div class='d-flex gap-2 justify-content-center mb-3'>
                                <div class='col-lg-12 col'>
                                    <div class='row text-muted text-center'>
                                        <div class='col-6 border-end border-end-dashed'>
                                            <h5 class='mb-1'>{$projectTotal}</h5>
                                            <p class='text-muted mb-0'>Projects</p>
                                        </div>
                                        <div class='col-6'>
                                            <h5 class='mb-1'>{$task_count}</h5>
                                            <p class='text-muted mb-0'>Tasks</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->        
            ";
        }
        $output .="</div>";
        echo $output;
    }
}



// ================================ load_dashboard_admin_data
if(isset($_POST['flag']) and $_POST['flag']=='load_dashboard_admin_data'){
    $sql = "select * from projecttb where status!='completed' and status!='cancelled' and status!='onhold' and MONTH(start_date) = MONTH(now())";
    $res = mysqli_query($conn,$sql);
    $cnt_proj = mysqli_num_rows($res);
    echo $cnt_proj;
}


// ======================================================== exporting data
if(isset($_POST['flag']) and $_POST['flag']=='btn-client-export'){

    $sql_query = "SELECT `client_id`, `client_name`, `email`, `address`, `zipcode`, `phone_number1`, `phone_number2` FROM `clienttb`";
    $result = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
    $fields = mysqli_fetch_fields($result);
    $columns = array();
    foreach ($fields as $field) {
        $columns[] = $field->name;
    }
    $csv = implode(',', $columns) . "\r\n";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $csv .= implode(',', $row) . "\r\n";
    }
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="client.csv"');
    
    echo $csv;
}






function toSec($t)
{
    $b = explode(":", $t);
    return +$b[0] * 60 * 60 + +$b[1] * 60 + +$b[2];
}

function toHr($s)
{
    $m = floor($s / 60);
    $h = floor($m / 60);
    if ($h <= 9) {
        $h = "0{$h}";
    }
    $m = floor($m % 60);
    if ($m <= 9) {
        $m = "0{$m}";
    }
    $s = floor($s % 60);
    if ($s <= 9) {
        $s = "0{$s}";
    }
    return "{$h}:{$m}:{$s}";
}

// load_total_hours on dashboard
if (isset($_POST['flag']) and $_POST["flag"] == "load_total_hour_dashboard") {
    $sql = "SELECT t.* FROM `timesheet` t";
    $res = mysqli_query($conn, $sql);
    $output = "00:00:00";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output=toHr(toSec($output) + toSec($data["hour"]));
        }
        echo $output;
    }
}

// weather api
if(isset($_POST['flag']) and $_POST['flag']=="load_api_data")
{
    $a = $_POST['longitude'];
    $b = $_POST['latitude'];
    $url = "https://api.openweathermap.org/data/2.5/weather?lat=$b&lon=$a&appid=30cf6cc07ec40c8673f04f7e3e549b49";
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    if($result['cod']==200){
        $status="yes";
    }else{
        $msg=$result['message'];
    }
    echo json_encode($result);
}
?>