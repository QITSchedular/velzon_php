<?php
require 'connection.php';
session_start();

// pagination
// $limit = 4; 
// if(isset($_SESSION['start_from'])){
//     $start_from = $_SESSION['start_from'];
// }

//load Project Data
// if (isset($_POST["flag"]) && $_POST["flag"] == "load_project_for_manager") {
//     if(isset($_POST['row_no']))
//     {
//         $row=$_POST['row_no'];
//         $row=($row-1)* $limit;
//         $empCode=$_SESSION['emp_code'];
//         $sql = "SELECT p.*,c.* FROM `projecttb` p,`clienttb` c,`projectteamtb` pt WHERE p.client_id=c.client_id AND `emp_code`='{$empCode}' AND pt.project_code=p.project_code LIMIT $row, $limit";
//         $res = mysqli_query($conn, $sql);

//         $output = "";
//         if ($res) {
//             while ($data = mysqli_fetch_assoc($res)) {
//                 if($data['status']=='started'){
//                     $signal = 'primary';
//                 }
//                 else if($data['status']=='onhold'){
//                     $signal = 'warning';
//                 }
//                 else if($data['status']=='inprogress'){
//                     $signal = 'info';
//                 }
//                 else if($data['status']=='cancelled'){
//                     $signal = 'danger';
//                 }
//                 else if($data['status']=='completed'){
//                     $signal = 'success';
//                 }
//                 else if($data['status']=='deffered'){
//                     $signal = 'secondary';
//                 }

//                 $output .= "
//                     <tr >
//                         <td class='table-plus pt-4 pb-4'>{$data['project_code']}</td>
//                         <td>{$data['project_name']}</td>
//                         <td>{$data['client_name']}</td>
//                         <td>{$data['start_date']}</td>
//                         <td><span class='badge bg-label-{$signal} me-1'>{$data['status']}</span></td>";
//                         if($data['isActive']=="1")
//                         {
//                             $output.="<td><a href='projectTask.php?id={$data['project_code']}'><i class='fa-solid fa-pen-to-square projectTask' id='{$data['project_code']}'></i></a></td>";
//                         }
//                         else{
//                             $output.="<td><a href='' id='pTask'><i class='fa-solid fa-pen-to-square projectTask'></i></a></td>";
//                         }

//                         if($data['file_name']==NULL)
//                         {
//                             $output.="<td><a href='#'>No attachment</a></td>";
//                         }
//                         else{
//                             $output.="<td><a href='../assets/img/projectAttachments/{$data['file_name']}' target='blank'>Open attachment</a></td>";
//                         }

//                         if($data['isActive']=="1")
//                         {
//                             $output.="<td><a href='ProjectTeamlist.php?id={$data['project_code']}'>Team</a></td>
//                             </tr>";
//                         }
//                         else{
//                             $output.="<td><a href='' id='pTeam'>Team</a></td>
//                             </tr>";
//                         }

//                 // echo $output;
//             }
//             echo $output;
//         } else {
//             echo 0;
//         }
//     }
// }

function cnt($pid)
{
    $obj = array();
    $sql = "SELECT count(*) as cnt FROM task WHERE p_id='{$pid}'";
    $res = mysqli_query(mysqli_connect("localhost", "root", "", "quanta1"), $sql);
    $result = mysqli_num_rows($res);
    if ($result > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $obj['total_task'] = $row['cnt'];
        }
    }
    $sql1 = "SELECT count(*) as cnt1 FROM task WHERE p_id='{$pid}' and status='completed'";
    $res1 = mysqli_query(mysqli_connect("localhost", "root", "", "quanta1"), $sql1);
    $result1 = mysqli_num_rows($res1);
    if ($result1 > 0) {
        while ($row1 = mysqli_fetch_assoc($res1)) {
            $obj['total_comp_task'] = $row1['cnt1'];
        }
    }
    return $obj;
}


// ====================================================== my task

// dynamic_load_kanban_cards
if (isset($_POST['flag']) and $_POST['flag'] == 'dynamic_load_kanban_cards') {
    $empCode = $_SESSION['emp_code'];
    $status = $_POST['status'];
    $arr_taskId = array();
    $sql = "SELECT * FROM task  where status='{$status}'";
    $res = mysqli_query($conn, $sql);
    $flag2 = 0;
    if (mysqli_num_rows($res) > 0) {
        $flag2 = 1;
        while ($data = mysqli_fetch_assoc($res)) {
            $emp_code = $data['emp_code'];
            $emp_arr = explode(",", $emp_code);
            $emp_arr_length = count($emp_arr);
            for ($i = 0; $i < $emp_arr_length; $i++) {
                if ($empCode == $emp_arr[$i]) {
                    array_push($arr_taskId, $data['id']);
                    break;
                }
            }
        }
    }
    // echo json_encode($arr_taskId);

    $output = "";
    $user_icon = "";
    for ($in = 0; $in < count($arr_taskId); $in++) {
        $sql = "SELECT * FROM `task` where status='{$status}' AND id='{$arr_taskId[$in]}'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $user_icon = "";
                $string = $row['emp_code'];
                $str_arr = explode(",", $string);
                $n = count($str_arr);
                for ($i = 0; $i < $n; $i++) {
                    $sql1 = "select * FROM employeetb e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code='{$str_arr[$i]}'";
                    $res1 = mysqli_query($conn, $sql1);
                    $result1 = mysqli_num_rows($res1);
                    if ($result1 > 0) {
                        while ($data1 = mysqli_fetch_assoc($res1)) {
                            if ($data1['profile_picture'] == '') {
                                $user_icon .= "
                                <a href='javascript: void(0);' class='avatar-group-item '  data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top'
                                title='{$data1['firstname']}' >
                                        <div class='avatar-xxs'>
                                        <img src='../assets/img/profile/proc.jpg' alt=''
                                                class='avatar-title fs-16 rounded-circle bg-light border-dashed border '>
                                        </div>
                                    </a>
                                ";
                            } else {
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
                    } else {
                        $user_icon = '';
                    }
                }
                if ($row['priority'] == 'Important') {
                    $signal = 'primary';
                } else if ($row['priority'] == 'Urgent') {
                    $signal = 'warning';
                } else if ($row['priority'] == 'Important and urgent') {
                    $signal = 'info';
                } else if ($row['priority'] == 'Neither') {
                    $signal = 'danger';
                }

                $output .= "
                <div class='card tasks-box' id='{$row['id']}' style='cursor:pointer;'>
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
    }
    echo $output;
}

// dynamic_load_kanban_cards_count
if (isset($_POST['flag']) and $_POST['flag'] == 'dynamic_load_kanban_cards_count') {
    $empCode = $_SESSION['emp_code'];
    $status = $_POST['status'];
    $arr_taskId = array();
    $sql = "SELECT * FROM task  where status='{$status}'";
    $res = mysqli_query($conn, $sql);
    $flag2 = 0;
    if (mysqli_num_rows($res) > 0) {
        $flag2 = 1;
        while ($data = mysqli_fetch_assoc($res)) {
            $emp_code = $data['emp_code'];
            $emp_arr = explode(",", $emp_code);
            $emp_arr_length = count($emp_arr);
            for ($i = 0; $i < $emp_arr_length; $i++) {
                if ($empCode == $emp_arr[$i]) {
                    array_push($arr_taskId, $data['id']);
                    break;
                }
            }
        }
    }
    echo count($arr_taskId);
}

//update kanban_cards status
if (isset($_POST['flag']) and $_POST['flag'] == 'update_kanban_cards') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $sql = "UPDATE `task` SET `status`='{$status}' WHERE `id`='{$id}'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}

//redirect to task overview page and store task id in session
if (isset($_POST['flag']) and $_POST['flag'] == 'redirect_task_overview') {
    $tid = $_POST['tid'];
    $_SESSION['task_id'] = $tid;
    echo 1;
}


//load task summury
if (isset($_POST['flag']) and $_POST['flag'] == "load_task_summary") {
    if (isset($_SESSION['task_id'])) {
        $tid = $_SESSION['task_id'];
        $sql = "SELECT t.*,p.project_name FROM `task` t,projecttb p WHERE id='{$tid}' AND t.p_id=p.project_code";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $data = mysqli_fetch_assoc($res);
            echo json_encode($data);
        }
    }
}

//load task team mate
if (isset($_POST['flag']) and $_POST['flag'] == "load_team_mate") {
    $tid = $_SESSION['task_id'];
    $sql = "SELECT t.* FROM `task` t WHERE id='{$tid}'";
    $res = mysqli_query($conn, $sql);
    $output = "";
    if ($res) {
        // $data=mysqli_fetch_assoc($res);
        while ($data = mysqli_fetch_assoc($res)) {
            $emp_code = $data['emp_code'];
            $emp_arr = explode(",", $emp_code);
            $emp_arr_length = count($emp_arr);
            for ($i = 0; $i < $emp_arr_length; $i++) {
                $sql2 = "SELECT e.*,ep.profile_picture FROM employeetb e,emp_personal_infotb ep WHERE e.emp_code='{$emp_arr[$i]}' AND e.emp_code=ep.emp_code";
                $res2 = mysqli_query($conn, $sql2);
                if ($res2) {
                    $row = mysqli_fetch_assoc($res2);
                    $output .= "
                    <li class='mb-3 w-100'>
                    <div class='d-flex align-items-center'>
                        <div class='flex-shrink-0'>";
                    if ($row['profile_picture'] == "") {
                        $output .= "<img src='../assets/img/profile/proc.jpg' alt='' class='avatar-xs rounded-circle' />";
                    } else {
                        $output .= "<img src='../assets/img/profile/{$row['profile_picture']}' alt='' class='avatar-xs rounded-circle' />";
                    }

                    $output .= "</div>
                        <div class='flex-grow-1 ms-2'>
                            <h6 class='mb-1'>{$row['firstname']}</h6>
                            <p class='text-muted mb-0'>{$row['email']}</p>
                        </div>
                       
                    </div>
                </li>
                    ";
                }
            }
        }
    }
    echo $output;
}


//insert timesheet of employee
if (isset($_POST["flag"]) and $_POST["flag"] == "insert_timesheet") {
    if (isset($_SESSION['emp_code']) and isset($_SESSION['task_id'])) {
        // $hours=$_POST["timeStr"];
        // $decrip=$_POST["decrip"];
        $empId = $_SESSION['emp_code'];
        $tid = $_SESSION['task_id'];
        $id = $_POST['tid'];
        $title = $_POST['title'];
        // echo $tid;
        $sql = "SELECT * FROM `task` WHERE `id`='{$tid}'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) == 1) {
            $data = mysqli_fetch_assoc($res);
            $pid = $data['p_id'];
            // $title=$data['title'];
            $date = date("Y-m-d");
            // echo $date;
            // $sql2="INSERT INTO `timesheet`(`emp_code`, `p_code`, `p_task`, `date`, `approve_type`) VALUES ('{$empId}','{$pid}','{$tid}','{$date}','{$hours}','Saved')";
            $sql2 = "INSERT INTO `timesheet`(`id`,`title`, `emp_code`, `p_code`, `p_task`, `date`, `hour`, `approve_type`, `is_pause`) VALUES ('{$id}','{$title}','{$empId}','{$pid}','{$tid}','{$date}','00:00:00','Saved','start')";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }
}

// display timesheet 
if (isset($_POST["flag"]) and $_POST["flag"] == "display_timesheet") {
    if (isset($_SESSION['emp_code']) and isset($_SESSION['task_id'])) {
        $empId = $_SESSION['emp_code'];
        $tid = $_SESSION['task_id'];
        $sql = "SELECT t.* FROM `timesheet` t WHERE t.emp_code='{$empId}' AND t.p_task='{$tid}' AND week(date)=week(now())";
        $res = mysqli_query($conn, $sql);
        $output = "";
        if ($res) {
            while ($data = mysqli_fetch_assoc($res)) {
                $output .= "
                <tr>
                <td>{$data['title']}</td>
                <td>{$data['date']}</td>
                <td>{$data['hour']}</td>";

                if($data['approve_type']=="Saved")
                {
                    $output.="<td><span class='badge badge-soft-warning fs-6' id='status12'>{$data['approve_type']}</span></td>";
                }else if($data['approve_type']=="Submitted"){
                    $output.="<td><span class='badge badge-soft-secondary fs-6' id='status12'>{$data['approve_type']}</span></td>";
                }else if($data['approve_type']=="Approved"){
                    $output.="<td><span class='badge badge-soft-success fs-6' id='status12'>{$data['approve_type']}</span></td>";
                }else if($data['approve_type']=="Rejected"){
                    $output.="<td><span class='badge badge-soft-danger fs-6' id='status12'>{$data['approve_type']}</span></td>";
                }
                $output.="<td class='accordion-header'>
                    <div class='flex-shrink-0'>
                        <a href='javascript:void(0);' class='text-muted descriTimeSheet' id='{$data['id']}' data-bs-toggle='dropdown' aria-expanded='false'><i class='ri-chat-new-line fs-5 fw-bold'></i></a>
                        <div class='dropdown-menu w-50 p-3 overflow-auto h-50' aria-labelledby='dropdownMenuLink4'>
                            <textarea class='form-control h-100 scroll mytextarea mytextarea12{$data['id']}' id='{$data['id']}' >{$data['description']}</textarea>
                        </div>
                    </div>

                </td>
                <td>
                    <a class='dropdown-item delete-timesheet' data-bs-toggle='modal' href='#deleteTimeSheetModal' id='{$data['id']}'><i class='ri-delete-bin-5-line align-bottom me-2 text-danger fs-5'></i></a>
                </td>";
                if ($data["is_pause"] == "start") {
                    $output .= "<td>
                    <a class='stop-timesheet' href='' id='{$data['id']}'><i class='ri-stop-circle-line align-bottom me-2 text-danger fs-5'></i>Stop</a>
                </td>";
                } else {
                    $output .= "<td>
                    <a class='restart-timesheet' href='' id='{$data['id']}'><i class='ri-restart-fill align-bottom me-2 text-primary fs-5'></i>Restart</a>
                </td>";
                }
                $output . "</tr>
                ";
            }
            echo $output;
        }
    }
    // echo $_SESSION['emp_code'];
}

//delete timesheet
if (isset($_POST["flag"]) and $_POST["flag"] == "delete_timesheet") {
    $timeSheetId = $_POST["timeSheetId"];
    $sql = "DELETE FROM `timesheet` WHERE id='{$timeSheetId}'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}


//update timesheet description
if (isset($_POST["flag"]) and $_POST["flag"] == "update_timesheet_desc") {
    $timeSheetId = $_POST["timeSheetId"];
    $txt = $_POST["txt"];
    $sql = "UPDATE `timesheet` SET `description`='{$txt}' WHERE `id`='$timeSheetId'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}


//get_timeStamp of current time stamp
if (isset($_POST["flag"]) and $_POST["flag"] == "get_timeStamp") {
    $timeSheetId = $_POST["id"];
    $sql = "SELECT * FROM `timesheet` WHERE `id`='$timeSheetId' AND is_pause='start'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $data = mysqli_fetch_assoc($res);
        echo json_encode($data);
    } else {
        echo 0;
    }
}


//get_timeStamp of current time stamp on load
if (isset($_POST["flag"]) and $_POST["flag"] == "get_timeStamp_onLoad") {
    // $timeSheetId=$_POST["id"];
    $empId = $_SESSION['emp_code'];
    $tid = $_SESSION['task_id'];
    $sql = "SELECT * FROM `timesheet` WHERE `p_task`='{$tid}' AND `is_pause`='start' AND `emp_code`='{$empId}'";
    // echo $sql;
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $data = mysqli_fetch_assoc($res);
        echo json_encode($data);
    } else {
        echo 0;
    }
}


// stop timesheet
if (isset($_POST["flag"]) and $_POST["flag"] == "stop_timesheet") {
    $timeSheetId = $_POST["timeSheetId"];
    $hours = $_POST["hours"];
    $title = $_POST["title"];
    $sql = "UPDATE `timesheet` SET `hour`='{$hours}',`title`='{$title}',`is_pause`='pause' WHERE `id`='{$timeSheetId}'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo 0;
    } else {
        echo 1;
    }
}


// restart timesheet
if (isset($_POST["flag"]) and $_POST["flag"] == "restart_timesheet") {
    $empId = $_SESSION['emp_code'];
    $task_id = $_SESSION["task_id"];
    $timeSheetId = $_POST["timeSheetId"];
    $sql = "SELECT * FROM `timesheet` WHERE `p_task`='{$task_id}' AND `is_pause`='start' AND approve_type!='Submitted' AND emp_code='{$empId}'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        echo 0;
    } else {
        $sql4 = "SELECT * FROM `timesheet` WHERE `p_task`='{$task_id}' AND approve_type!='Submitted' AND emp_code='{$empId}'";
        $res4 = mysqli_query($conn, $sql4);

        if(mysqli_num_rows($res4)==0)
        {
            echo 1;
        }else{
            $sql2 = "UPDATE `timesheet` SET `is_pause`='start' WHERE `p_task`='{$task_id}' AND `id`='{$timeSheetId}'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2) {
                $sql3 = "SELECT * FROM `timesheet` WHERE `id`='{$timeSheetId}' AND `is_pause`='start'";
                $res3 = mysqli_query($conn, $sql3);
                $data = mysqli_fetch_assoc($res3);
                echo json_encode($data);
            }
        }

        
    }
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


// load_total_time
if (isset($_POST['flag']) and $_POST["flag"] == "load_total_time") {
    $empId = $_SESSION['emp_code'];
    $tid = $_SESSION['task_id'];
    $sql = "SELECT t.* FROM `timesheet` t WHERE t.emp_code='{$empId}' AND t.p_task='{$tid}'";
    $res = mysqli_query($conn, $sql);
    $output = "00:00:00";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output=toHr(toSec($output) + toSec($data["hour"]));
        }
        echo $output;
    }
}



// multiple file upload
if(isset($_POST['flag']) and $_POST['flag']=="task_multiplefile"){
    $tid = $_SESSION['task_id'];
    $eid = $_SESSION['emp_code'];
    $sql="SELECT * FROM `task` WHERE `id`='{$tid}'";
    $res = mysqli_query($conn,$sql);
    $data=mysqli_fetch_assoc($res);
    $pid=$data['p_id'];
	foreach ($_FILES['file']['tmp_name'] as $key => $value) { 
        if($_FILES['file']['name'][$key]!=''){
            $file_name  = $_FILES['file']['name'][$key];
            $file_type = explode(".",$_FILES['file']['name'][$key]);
            $file_tmp   = $_FILES['file']['tmp_name'][$key];
           
            $file_size  = round(($_FILES["file"]["size"][$key]/8000000),3);
            $ftype = $file_type[1] . " File";
           
            $file_size  .= " MB";
            
            $file_target = '../employee/task_file/'. $file_name;
            $check = move_uploaded_file($file_tmp, $file_target);
            
            $sql = "INSERT INTO `task_filetb`( `p_id`,`t_id`, `e_id`, `file_name`, `type`, `size`) VALUES ('{$pid}','{$tid}','{$eid}','{$file_name}','{$ftype}','{$file_size}')";
            $res = mysqli_query($conn,$sql);
            if($res)
            {
                echo 1;
            }else{
                echo 0;
            }
        }               
	}     
    
}


// task file show on page
if(isset($_POST['flag']) and $_POST['flag']=="task_file_show"){
    $id = $_SESSION['task_id'];
    $output="";                      
    $ftype= '';
    $sql = "SELECT * FROM `task_filetb` WHERE t_id='{$id}'";
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
                                        href='../assets/employee/task_file/{$row['file_name']}' target='_blank'><i
                                            class='ri-eye-fill me-2 align-bottom text-muted'></i>View</a>
                                </li>
                                <li><a class='dropdown-item'
                                href='../assets/img/Project_files/{$row['file_name']}' id='{$row['file_id']}' download='{$row['file_name']}'><i
                                            class='ri-download-2-fill me-2 align-bottom text-muted'></i>Download</a>
                                </li>
                                <li class='dropdown-divider'></li>
                                <li><a class='dropdown-item del_file' data-bs-toggle='modal'
                                data-bs-target='#delTaskFileModal'
                                        href='' id='{$row['file_id']}'><i
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
    echo $output;
}


// delete task file
if(isset($_POST['flag']) and $_POST['flag']=='del_task_file'){
    $id = $_POST['id'];
    $sql = "DELETE FROM `task_filetb` WHERE file_id='{$id}'";
    $res = mysqli_query($conn,$sql);
    if($res)
    {
        echo 1;
    }else{
        echo 0;
    }
}


// load_total_time
if (isset($_POST['flag']) and $_POST["flag"] == "load_total_file") {
    // $empId = $_SESSION['emp_code'];
    $tid = $_SESSION['task_id'];
    $sql = "SELECT * FROM `task_filetb` WHERE t_id='{$tid}'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        // echo $sql;
        echo mysqli_num_rows($res);
    }
}


//submit data
if (isset($_POST['flag']) and $_POST["flag"] == "submit_timesheet") {
    $empId = $_SESSION['emp_code'];
    $tid = $_SESSION['task_id'];
    $date = date("Y-m-d");
    $sql = "UPDATE `timesheet` SET approve_type='Submitted',submit_date='{$date}' WHERE p_task='{$tid}' AND emp_code='{$empId}' AND approve_type='Saved'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo 1;
    }else{
        echo 0;
    }
}

// ================================================================= my timesheet =================================================

// display saved timesheet 
if (isset($_POST["flag"]) and $_POST["flag"] == "load_saved_sheet") {
    if (isset($_SESSION['emp_code'])) {
        $empId = $_SESSION['emp_code'];
        $sql = "SELECT * FROM `timesheet` WHERE `emp_code`='{$empId}' AND `approve_type`='Saved'";
        $res = mysqli_query($conn, $sql);
        $output = "";
        if ($res) {
            while ($data = mysqli_fetch_assoc($res)) {
                $output.="
                <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                <div class='card-body'>
                    <a class='d-flex align-items-center' data-bs-toggle='collapse' href='#submitSheet{$data['id']}' role='button' aria-expanded='false' aria-controls='submitSheet{$data['id']}'>
                        <div class='flex-grow-1 ms-3'>
                            <h6 class='fs-14 mb-1'>{$data['title']}</h6>
                            <p class='text-muted mb-0'>{$data['hour']}</p>
                        </div>
                    </a>
                </div>
                <div class='collapse border-top border-top-dashed' id='submitSheet{$data['id']}'>
                    <div class='card-body'>
                        <h6 class='fs-14 mb-1'>Task Description</h6>
                        <p class='text-muted'>{$data['description']}</p>
                        <div class='d-flex  gap-5 mt-2'>
                            <div class='d-flex'>
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Start Date</h6>
                                    <small class='text-muted'>{$data['date']}</small>
                                </div>
                            </div>
                            <div class='d-flex'>
                               
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Submitted Date</h6>";
                                    if($data['submit_date']=="")
                                    {
                                        $output.="--";
                                    }else{
                                        $output.="<small class='text-muted'>{$data['submit_date']}</small>";
                                    }
                                $output.="</div>
                            </div>
                        </div>
                    </div>
                    <div class='card-footer hstack gap-2'>
                      
                        <div class='d-flex  gap-0 '>
                            <div class='d-flex'>
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Approved_Type</h6>
                                    <small class='text-muted'><span class='badge badge-soft-secondary fs-6  mt-1' id='status12'>{$data['approve_type']}</span></small>
                                </div>
                            </div>
                            <button class='btn btn-soft-danger btn-sm w-50 ms-5 float-right' id='{$data['id']}'><i class='ri-delete-bin-5-line align-bottom me-1 text-danger'></i> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
                ";
           
            }
            if($output=="")
            {
                $output="
                <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                    <div class='card-body'>
                        <p class='text-muted'> No saved sheets are there..!!</p>
                    </div>
                </div>
               ";
                echo $output;
            }else{
                echo $output;

            }
        }
    }
}


// display submitted timesheet 
if (isset($_POST["flag"]) and $_POST["flag"] == "load_submitted_sheet") {
    if (isset($_SESSION['emp_code'])) {
        $empId = $_SESSION['emp_code'];
        $sql = "SELECT * FROM `timesheet` WHERE `emp_code`='{$empId}' AND `approve_type`='Submitted'";
        $res = mysqli_query($conn, $sql);
        $output = "";
        if ($res) {
            while ($data = mysqli_fetch_assoc($res)) {
                $output.="
                <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                <div class='card-body'>
                    <a class='d-flex align-items-center' data-bs-toggle='collapse' href='#submitSheet{$data['id']}' role='button' aria-expanded='false' aria-controls='submitSheet{$data['id']}'>
                        <div class='flex-grow-1 ms-3'>
                            <h6 class='fs-14 mb-1'>{$data['title']}</h6>
                            <p class='text-muted mb-0'>{$data['hour']}</p>
                        </div>
                    </a>
                </div>
                <div class='collapse border-top border-top-dashed' id='submitSheet{$data['id']}'>
                    <div class='card-body'>
                        <h6 class='fs-14 mb-1'>Task Description</h6>
                        <p class='text-muted'>{$data['description']}</p>
                        <div class='d-flex  gap-5 mt-2'>
                            <div class='d-flex'>
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Start Date</h6>
                                    <small class='text-muted'>{$data['date']}</small>
                                </div>
                            </div>
                            <div class='d-flex'>
                               
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Submitted Date</h6>";
                                    if($data['submit_date']=="")
                                    {
                                        $output.="--";
                                    }else{
                                        $output.="<small class='text-muted'>{$data['submit_date']}</small>";
                                    }
                                $output.="</div>
                            </div>
                        </div>
                    </div>
                    <div class='card-footer hstack gap-2'>
                      
                        <div class='d-flex  gap-5 '>
                            <div class='d-flex'>
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Approved_Type</h6>
                                    <small class='text-muted'><span class='badge badge-soft-secondary fs-6  mt-1' id='status12'>{$data['approve_type']}</span></small>
                                </div>
                            </div>
                            <button class='btn btn-soft-danger btn-sm w-100 ms-1 float-right' id='{$data['id']}'><i class='ri-delete-bin-5-line align-bottom me-1 text-danger'></i> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
                ";
           
            }
            if($output=="")
            {
                $output="
                <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                    <div class='card-body'>
                        <p class='text-muted'> No submitted sheets are there..!!</p>
                    </div>
                </div>
               ";
                echo $output;
            }else{
                echo $output;

            }
        }
    }
}



// display approved timesheet 
if (isset($_POST["flag"]) and $_POST["flag"] == "load_approved_sheet") {
    if (isset($_SESSION['emp_code'])) {
        $empId = $_SESSION['emp_code'];
        $sql = "SELECT * FROM `timesheet` WHERE `emp_code`='{$empId}' AND `approve_type`='Approved'";
        $res = mysqli_query($conn, $sql);
        $output = "";
        if ($res) {
            while ($data = mysqli_fetch_assoc($res)) {
                $output.="
                <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                <div class='card-body'>
                    <a class='d-flex align-items-center' data-bs-toggle='collapse' href='#submitSheet{$data['id']}' role='button' aria-expanded='false' aria-controls='submitSheet{$data['id']}'>
                        <div class='flex-grow-1 ms-3'>
                            <h6 class='fs-14 mb-1'>{$data['title']}</h6>
                            <p class='text-muted mb-0'>{$data['hour']}</p>
                        </div>
                    </a>
                </div>
                <div class='collapse border-top border-top-dashed' id='submitSheet{$data['id']}'>
                    <div class='card-body'>
                        <h6 class='fs-14 mb-1'>Task Description</h6>
                        <p class='text-muted'>{$data['description']}</p>
                        <div class='d-flex  gap-5 mt-2'>
                            <div class='d-flex'>
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Start Date</h6>
                                    <small class='text-muted'>{$data['date']}</small>
                                </div>
                            </div>
                            <div class='d-flex'>
                               
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Submitted Date</h6>";
                                    if($data['submit_date']=="")
                                    {
                                        $output.="--";
                                    }else{
                                        $output.="<small class='text-muted'>{$data['submit_date']}</small>";
                                    }
                                $output.="</div>
                            </div>
                        </div>
                    </div>
                    <div class='card-footer hstack gap-2'>
                      
                        <div class='d-flex  gap-5 '>
                            <div class='d-flex'>
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Approved_Type</h6>
                                    <small class='text-muted'><span class='badge badge-soft-secondary fs-6  mt-1' id='status12'>{$data['approve_type']}</span></small>
                                </div>
                            </div>
                            <button class='btn btn-soft-danger btn-sm w-100 ms-5 float-right' id='{$data['id']}'><i class='ri-delete-bin-5-line align-bottom me-1 text-danger'></i> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
                ";
           
            }
            if($output=="")
            {
                $output="
                <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                    <div class='card-body'>
                        <p class='text-muted'> No approved sheets are there..!!</p>
                    </div>
                </div>
               ";
                echo $output;
            }else{
                echo $output;

            }
        }
    }
}


// display rejected timesheet 
if (isset($_POST["flag"]) and $_POST["flag"] == "load_rejected_sheet") {
    if (isset($_SESSION['emp_code'])) {
        $empId = $_SESSION['emp_code'];
        $sql = "SELECT * FROM `timesheet` WHERE `emp_code`='{$empId}' AND `approve_type`='Rejecteted'";
        $res = mysqli_query($conn, $sql);
        $output = "";
        if ($res) {
            while ($data = mysqli_fetch_assoc($res)) {
                $output.="
                <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                <div class='card-body'>
                    <a class='d-flex align-items-center' data-bs-toggle='collapse' href='#submitSheet{$data['id']}' role='button' aria-expanded='false' aria-controls='submitSheet{$data['id']}'>
                        <div class='flex-grow-1 ms-3'>
                            <h6 class='fs-14 mb-1'>{$data['title']}</h6>
                            <p class='text-muted mb-0'>{$data['hour']}</p>
                        </div>
                    </a>
                </div>
                <div class='collapse border-top border-top-dashed' id='submitSheet{$data['id']}'>
                    <div class='card-body'>
                        <h6 class='fs-14 mb-1'>Task Description</h6>
                        <p class='text-muted'>{$data['description']}</p>
                        <div class='d-flex  gap-5 mt-2'>
                            <div class='d-flex'>
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Start Date</h6>
                                    <small class='text-muted'>{$data['date']}</small>
                                </div>
                            </div>
                            <div class='d-flex'>
                               
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Submitted Date</h6>";
                                    if($data['submit_date']=="")
                                    {
                                        $output.="--";
                                    }else{
                                        $output.="<small class='text-muted'>{$data['submit_date']}</small>";
                                    }
                                $output.="</div>
                            </div>
                        </div>
                    </div>
                    <div class='card-footer hstack gap-2'>
                      
                        <div class='d-flex  gap-5 '>
                            <div class='d-flex'>
                                <div class='flex-grow-1'>
                                    <h6 class='mb-0'>Approved_Type</h6>
                                    <small class='text-muted'><span class='badge badge-soft-secondary fs-6  mt-1' id='status12'>{$data['approve_type']}</span></small>
                                </div>
                            </div>
                            <button class='btn btn-soft-danger btn-sm w-100 ms-5 float-right' id='{$data['id']}'><i class='ri-delete-bin-5-line align-bottom me-1 text-danger'></i> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
                ";
           
            }
            if($output=="")
            {
                $output="
                <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                    <div class='card-body'>
                        <p class='text-muted'> No rejected sheets are there..!!</p>
                    </div>
                </div>
               ";
                echo $output;
            }else{
                echo $output;

            }
        }
    }
}


// load_total_hours_saved
if (isset($_POST['flag']) and $_POST["flag"] == "load_total_hour_saved") {
    $empId = $_SESSION['emp_code'];
    $sql = "SELECT t.* FROM `timesheet` t WHERE t.emp_code='{$empId}' AND t.approve_type='Saved'";
    $res = mysqli_query($conn, $sql);
    $output = "00:00:00";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output=toHr(toSec($output) + toSec($data["hour"]));
        }
        echo $output;
    }
}


// load_total_hours_submitted
if (isset($_POST['flag']) and $_POST["flag"] == "load_total_hour_submitted") {
    $empId = $_SESSION['emp_code'];
    $sql = "SELECT t.* FROM `timesheet` t WHERE t.emp_code='{$empId}' AND t.approve_type='Submitted'";
    $res = mysqli_query($conn, $sql);
    $output = "00:00:00";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output=toHr(toSec($output) + toSec($data["hour"]));
        }
        echo $output;
    }
}


// load_total_hours_approved
if (isset($_POST['flag']) and $_POST["flag"] == "load_total_hour_approved") {
    $empId = $_SESSION['emp_code'];
    $sql = "SELECT t.* FROM `timesheet` t WHERE t.emp_code='{$empId}' AND t.approve_type='Approved'";
    $res = mysqli_query($conn, $sql);
    $output = "00:00:00";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output=toHr(toSec($output) + toSec($data["hour"]));
        }
        echo $output;
    }
}


// load_total_hours_rejected
if (isset($_POST['flag']) and $_POST["flag"] == "load_total_hour_rejected") {
    $empId = $_SESSION['emp_code'];
    $sql = "SELECT t.* FROM `timesheet` t WHERE t.emp_code='{$empId}' AND t.approve_type='Rejected'";
    $res = mysqli_query($conn, $sql);
    $output = "00:00:00";
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output=toHr(toSec($output) + toSec($data["hour"]));
        }
        echo $output;
    }
}



// load filtered time sheet
if (isset($_POST['flag']) and $_POST["flag"] == "load_filtered_sheet") {
    $empId = $_SESSION['emp_code'];
    $id=$_POST["id"];
    $sqlSaved = "SELECT t.* FROM `timesheet` t WHERE t.emp_code='{$empId}' AND t.approve_type='Saved'";
    $sqlSubmitted = "SELECT t.* FROM `timesheet` t WHERE t.emp_code='{$empId}' AND t.approve_type='Submitted'";
    $sqlRejected = "SELECT t.* FROM `timesheet` t WHERE t.emp_code='{$empId}' AND t.approve_type='Rejected'";
    $sqlApproved = "SELECT t.* FROM `timesheet` t WHERE t.emp_code='{$empId}' AND t.approve_type='Approved'";
    $outputSaved="";
    $outputSubmitted="";
    $outputRejected="";
    $outputApproved="";
    $a=array();
    
    if($id==1)
    {
        $sqlSaved .= "AND week(date)=week(now())";
        $sqlSubmitted .= "AND week(date)=week(now())";
        $sqlRejected .= "AND week(date)=week(now())";
        $sqlApproved .= "AND week(date)=week(now())";
        $resSaved = mysqli_query($conn, $sqlSaved);
        $resSubmitted = mysqli_query($conn, $sqlSubmitted);
        $resRejected = mysqli_query($conn, $sqlRejected);
        $resApproved = mysqli_query($conn, $sqlApproved);
    }else if($id==2)
    {
        $sqlSaved .= "AND EXTRACT(YEAR_MONTH FROM date) = EXTRACT(YEAR_MONTH FROM CURDATE())";
        $sqlSubmitted .= "AND EXTRACT(YEAR_MONTH FROM date) = EXTRACT(YEAR_MONTH FROM CURDATE())";
        $sqlRejected .= "AND EXTRACT(YEAR_MONTH FROM date) = EXTRACT(YEAR_MONTH FROM CURDATE())";
        $sqlApproved .= "AND EXTRACT(YEAR_MONTH FROM date) = EXTRACT(YEAR_MONTH FROM CURDATE())";
        $resSaved = mysqli_query($conn, $sqlSaved);
        $resSubmitted = mysqli_query($conn, $sqlSubmitted);
        $resRejected = mysqli_query($conn, $sqlRejected);
        $resApproved = mysqli_query($conn, $sqlApproved);
    }else if($id==3)
    {
        $sqlSaved .= "AND WEEK(date, 0) = WEEK(NOW(), 0)-1";
        $sqlSubmitted .= "AND WEEK(date, 0) = WEEK(NOW(), 0)-1";
        // echo $sqlSubmitted ;
        $sqlRejected .= "AND WEEK(date, 0) = WEEK(NOW(), 0)-1";
        $sqlApproved .= "AND WEEK(date, 0) = WEEK(NOW(), 0)-1";
        $resSaved = mysqli_query($conn, $sqlSaved);
        $resSubmitted = mysqli_query($conn, $sqlSubmitted);
        $resRejected = mysqli_query($conn, $sqlRejected);
        $resApproved = mysqli_query($conn, $sqlApproved);
    }else if($id==4)
    {
        $sqlSaved .= " AND EXTRACT(YEAR_MONTH FROM date) = EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH)";
        $sqlSubmitted .= " AND EXTRACT(YEAR_MONTH FROM date) = EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH)";
        // echo $sqlSubmitted ;
        $sqlRejected .= " AND EXTRACT(YEAR_MONTH FROM date) = EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH)";
        $sqlApproved .= " AND EXTRACT(YEAR_MONTH FROM date) = EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH)";
        $resSaved = mysqli_query($conn, $sqlSaved);
        $resSubmitted = mysqli_query($conn, $sqlSubmitted);
        $resRejected = mysqli_query($conn, $sqlRejected);
        $resApproved = mysqli_query($conn, $sqlApproved);
    }


    if ($resSaved) {
        while ($data = mysqli_fetch_assoc($resSaved)) {
            $outputSaved.="
            <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
            <div class='card-body'>
                <a class='d-flex align-items-center' data-bs-toggle='collapse' href='#submitSheet{$data['id']}' role='button' aria-expanded='false' aria-controls='submitSheet{$data['id']}'>
                    <div class='flex-grow-1 ms-3'>
                        <h6 class='fs-14 mb-1'>{$data['title']}</h6>
                        <p class='text-muted mb-0'>{$data['hour']}</p>
                    </div>
                </a>
            </div>
            <div class='collapse border-top border-top-dashed' id='submitSheet{$data['id']}'>
                <div class='card-body'>
                    <h6 class='fs-14 mb-1'>Task Description</h6>
                    <p class='text-muted'>{$data['description']}</p>
                    <div class='d-flex  gap-5 mt-2'>
                        <div class='d-flex'>
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Start Date</h6>
                                <small class='text-muted'>{$data['date']}</small>
                            </div>
                        </div>
                        <div class='d-flex'>
                           
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Submitted Date</h6>";
                                if($data['submit_date']=="")
                                {
                                    $outputSaved.="--";
                                }else{
                                    $outputSaved.="<small class='text-muted'>{$data['submit_date']}</small>";
                                }
                            $outputSaved.="</div>
                        </div>
                    </div>
                </div>
                <div class='card-footer hstack gap-2'>
                  
                    <div class='d-flex  gap-0 '>
                        <div class='d-flex'>
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Approved_Type</h6>
                                <small class='text-muted'><span class='badge badge-soft-secondary fs-6  mt-1' id='status12'>{$data['approve_type']}</span></small>
                            </div>
                        </div>
                        <button class='btn btn-soft-danger btn-sm w-50 ms-5 float-right' id='{$data['id']}'><i class='ri-delete-bin-5-line align-bottom me-1 text-danger'></i> Delete</button>
                    </div>
                </div>
            </div>
            </div>
            ";
        }
        if($outputSaved=="")
        {
            $outputSaved="
            <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                <div class='card-body'>
                    <p class='text-muted'> No saved sheets are there..!!</p>
                </div>
            </div>
           ";
            array_push($a,$outputSaved);
            // echo $outputSaved;
        }else{
            array_push($a,$outputSaved);
        }
    }
    
    if ($resSubmitted) {
        while ($data = mysqli_fetch_assoc($resSubmitted)) {
            $outputSubmitted.="
            <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
            <div class='card-body'>
                <a class='d-flex align-items-center' data-bs-toggle='collapse' href='#submitSheet{$data['id']}' role='button' aria-expanded='false' aria-controls='submitSheet{$data['id']}'>
                    <div class='flex-grow-1 ms-3'>
                        <h6 class='fs-14 mb-1'>{$data['title']}</h6>
                        <p class='text-muted mb-0'>{$data['hour']}</p>
                    </div>
                </a>
            </div>
            <div class='collapse border-top border-top-dashed' id='submitSheet{$data['id']}'>
                <div class='card-body'>
                    <h6 class='fs-14 mb-1'>Task Description</h6>
                    <p class='text-muted'>{$data['description']}</p>
                    <div class='d-flex  gap-5 mt-2'>
                        <div class='d-flex'>
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Start Date</h6>
                                <small class='text-muted'>{$data['date']}</small>
                            </div>
                        </div>
                        <div class='d-flex'>
                           
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Submitted Date</h6>";
                                if($data['submit_date']=="")
                                {
                                    $outputSubmitted.="--";
                                }else{
                                    $outputSubmitted.="<small class='text-muted'>{$data['submit_date']}</small>";
                                }
                            $outputSubmitted.="</div>
                        </div>
                    </div>
                </div>
                <div class='card-footer hstack gap-2'>
                  
                    <div class='d-flex  gap-5 '>
                        <div class='d-flex'>
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Approved_Type</h6>
                                <small class='text-muted'><span class='badge badge-soft-secondary fs-6  mt-1' id='status12'>{$data['approve_type']}</span></small>
                            </div>
                        </div>
                        <button class='btn btn-soft-danger btn-sm w-100 ms-1 float-right' id='{$data['id']}'><i class='ri-delete-bin-5-line align-bottom me-1 text-danger'></i> Delete</button>
                    </div>
                </div>
            </div>
        </div>
            ";
       
        }
        if($outputSubmitted=="")
        {
            $outputSubmitted="
            <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                <div class='card-body'>
                    <p class='text-muted'> No submitted sheets are there..!!</p>
                </div>
            </div>
           ";
           array_push($a,$outputSubmitted);
        }else{
            array_push($a,$outputSubmitted);
        }
    }

    if ($resApproved) {
        while ($data = mysqli_fetch_assoc($resApproved)) {
            $outputApproved.="
            <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
            <div class='card-body'>
                <a class='d-flex align-items-center' data-bs-toggle='collapse' href='#submitSheet{$data['id']}' role='button' aria-expanded='false' aria-controls='submitSheet{$data['id']}'>
                    <div class='flex-grow-1 ms-3'>
                        <h6 class='fs-14 mb-1'>{$data['title']}</h6>
                        <p class='text-muted mb-0'>{$data['hour']}</p>
                    </div>
                </a>
            </div>
            <div class='collapse border-top border-top-dashed' id='submitSheet{$data['id']}'>
                <div class='card-body'>
                    <h6 class='fs-14 mb-1'>Task Description</h6>
                    <p class='text-muted'>{$data['description']}</p>
                    <div class='d-flex  gap-5 mt-2'>
                        <div class='d-flex'>
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Start Date</h6>
                                <small class='text-muted'>{$data['date']}</small>
                            </div>
                        </div>
                        <div class='d-flex'>
                           
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Submitted Date</h6>";
                                if($data['submit_date']=="")
                                {
                                    $outputApproved.="--";
                                }else{
                                    $outputApproved.="<small class='text-muted'>{$data['submit_date']}</small>";
                                }
                            $outputApproved.="</div>
                        </div>
                    </div>
                </div>
                <div class='card-footer hstack gap-2'>
                  
                    <div class='d-flex  gap-5 '>
                        <div class='d-flex'>
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Approved_Type</h6>
                                <small class='text-muted'><span class='badge badge-soft-secondary fs-6  mt-1' id='status12'>{$data['approve_type']}</span></small>
                            </div>
                        </div>
                        <button class='btn btn-soft-danger btn-sm w-100 ms-5 float-right' id='{$data['id']}'><i class='ri-delete-bin-5-line align-bottom me-1 text-danger'></i> Delete</button>
                    </div>
                </div>
            </div>
        </div>
            ";
       
        }
        if($outputApproved=="")
        {
            $outputApproved="
            <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                <div class='card-body'>
                    <p class='text-muted'> No approved sheets are there..!!</p>
                </div>
            </div>
           ";
           array_push($a,$outputApproved);
        }else{
            array_push($a,$outputApproved);
        }
    }

    if ($resRejected) {
        while ($data = mysqli_fetch_assoc($resRejected)) {
            $outputRejected.="
            <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
            <div class='card-body'>
                <a class='d-flex align-items-center' data-bs-toggle='collapse' href='#submitSheet{$data['id']}' role='button' aria-expanded='false' aria-controls='submitSheet{$data['id']}'>
                    <div class='flex-grow-1 ms-3'>
                        <h6 class='fs-14 mb-1'>{$data['title']}</h6>
                        <p class='text-muted mb-0'>{$data['hour']}</p>
                    </div>
                </a>
            </div>
            <div class='collapse border-top border-top-dashed' id='submitSheet{$data['id']}'>
                <div class='card-body'>
                    <h6 class='fs-14 mb-1'>Task Description</h6>
                    <p class='text-muted'>{$data['description']}</p>
                    <div class='d-flex  gap-5 mt-2'>
                        <div class='d-flex'>
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Start Date</h6>
                                <small class='text-muted'>{$data['date']}</small>
                            </div>
                        </div>
                        <div class='d-flex'>
                           
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Submitted Date</h6>";
                                if($data['submit_date']=="")
                                {
                                    $outputRejected.="--";
                                }else{
                                    $outputRejected.="<small class='text-muted'>{$data['submit_date']}</small>";
                                }
                            $outputRejected.="</div>
                        </div>
                    </div>
                </div>
                <div class='card-footer hstack gap-2'>
                  
                    <div class='d-flex  gap-5 '>
                        <div class='d-flex'>
                            <div class='flex-grow-1'>
                                <h6 class='mb-0'>Approved_Type</h6>
                                <small class='text-muted'><span class='badge badge-soft-secondary fs-6  mt-1' id='status12'>{$data['approve_type']}</span></small>
                            </div>
                        </div>
                        <button class='btn btn-soft-danger btn-sm w-100 ms-5 float-right' id='{$data['id']}'><i class='ri-delete-bin-5-line align-bottom me-1 text-danger'></i> Delete</button>
                    </div>
                </div>
            </div>
        </div>
            ";
       
        }
        if($outputRejected=="")
        {
            $outputRejected="
            <div class='card mb-1 ribbon-box ribbon-fill ribbon-sm'>
                <div class='card-body'>
                    <p class='text-muted'> No rejected sheets are there..!!</p>
                </div>
            </div>
           ";
            array_push($a,$outputRejected);
        }else{
            array_push($a,$outputRejected);
        }
    }
    echo json_encode($a);
}


// notification_tasks_employee
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

// ===================================== load event
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

// =============================== load birthday

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

// load project data in chart
if(isset($_POST['flag']) and $_POST['flag']=='load_chart_data_status1'){
    $status = $_POST['status'];
    $empId = $_SESSION['emp_code'];
    $sql = "SELECT COUNT(*) as cnt FROM `timesheet` WHERE emp_code='{$empId}' AND approve_type='{$status}'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0)
    {
        while($row = mysqli_fetch_assoc($res)){
            echo $row['cnt'];
        }
    }
}


//load Project Data on dashboard
if (isset($_POST["flag"]) && $_POST["flag"] == "test_table4") {
    $myobj = (object)[];
    $myarr = array();
    $cnt1 = 0;
    $empCode = $_SESSION['emp_code'];
    $arr_taskId = array();
    $sql = "SELECT * FROM task ";
    $res = mysqli_query($conn, $sql);
    $flag2 = 0;
    if (mysqli_num_rows($res) > 0) {
        $flag2 = 1;
        while ($data = mysqli_fetch_assoc($res)) {
           
            $emp_code = $data['emp_code'];
            $emp_arr = explode(",", $emp_code);
            $emp_arr_length = count($emp_arr);
            for ($i = 0; $i < $emp_arr_length; $i++) {
                if ($empCode == $emp_arr[$i]) {
                    array_push($arr_taskId, $data['id']);
                    break;
                }
            }
        }
    }
    $output = "";
    $user_icon = "";
    for ($in = 0; $in < count($arr_taskId); $in++) {
        $sql = "SELECT * FROM `task` where id='{$arr_taskId[$in]}'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $cnt1 +=1;
                $user_icon = "";
                $string = $row['emp_code'];
                $str_arr = explode(",", $string);
                $n = count($str_arr);
                for ($i = 0; $i < $n; $i++) {
                    $sql1 = "select * FROM employeetb e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code='{$str_arr[$i]}'";
                    $res1 = mysqli_query($conn, $sql1);
                    $result1 = mysqli_num_rows($res1);
                    if ($result1 > 0) {
                        while ($data1 = mysqli_fetch_assoc($res1)) {
                            if ($data1['profile_picture'] == '') {
                                $user_icon .= "
                                <a href='javascript: void(0);' class='avatar-group-item '  data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='top'
                                title='{$data1['firstname']}' >
                                        <div class='avatar-xxs'>
                                        <img src='../assets/img/profile/proc.jpg' alt=''
                                                class='avatar-title fs-16 rounded-circle bg-light border-dashed border '>
                                        </div>
                                    </a>
                                ";
                            } else {
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
                    } else {
                        $user_icon = '';
                    }
                }
                if ($row['priority'] == 'Important') {
                    $signal = 'primary';
                } else if ($row['priority'] == 'Urgent') {
                    $signal = 'warning';
                } else if ($row['priority'] == 'Important and urgent') {
                    $signal = 'info';
                } else if ($row['priority'] == 'Neither') {
                    $signal = 'danger';
                }

                if ($row['status'] == 'unassigned') {
                    $signal1 = 'primary';
                } else if ($row['status'] == 'todo') {
                    $signal1 = 'warning';
                } else if ($row['status'] == 'inprogress') {
                    $signal1 = 'info';
                } else if ($row['status'] == 'reviews') {
                    $signal1 = 'danger';
                }else if ($row['status'] == 'completed') {
                    $signal1 = 'success';
                }
                
            $myobj->cnt = $cnt1;
            $myobj->name = "<a href='#' class='text-dark redirect_overview_page' id='{$row['id']}'>{$row['title']}</a>";
            $myobj->description = "<a href='#' class='text-dark redirect_overview_page' id='{$row['id']}'>{$row['description']}</a>";
            $myobj->priority = "<div class='badge badge-soft-{$signal} fs-12'>{$row['priority']}</div>";
            $myobj->status = "<div class='badge badge-soft-{$signal1} fs-12'>{$row['status']}</div>";
            $myobj->sdate = $row['sdate'];
            $myobj->edate = $row['due_date'];
            $myobj->members = "<div class='avatar-group'>{$user_icon}</div>";
            array_push($myarr,$myobj);
            $myobj = (object)[];
            }
        }
        echo json_encode($myarr);
    }

}


// counting total hours and minutes on dashboard
if(isset($_POST['flag']) and $_POST['flag']=="load_hm")
{
    // select * from timesheet where MONTH(date) = MONTH(now()) and YEAR(date) = YEAR(now());
    $empCode = $_SESSION['emp_code'];
    $sql = "select * from timesheet where MONTH(date) = MONTH(now()) and YEAR(date) = YEAR(now()) and emp_code='{$empCode}'";
    $res = mysqli_query($conn,$sql);
    $output = "00:00:00";
    if (mysqli_num_rows($res)>0) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output=toHr(toSec($output) + toSec($data["hour"]));
        }
    }
    echo $output;
}

if(isset($_POST['flag']) and $_POST['flag']=="load_hm_compare")
{
    $ch = 0;
    $ph = 0;
    $empCode = $_SESSION['emp_code'];
    $sql = "select * from timesheet where MONTH(date) = MONTH(now())-1 and YEAR(date) = YEAR(now()) and emp_code='{$empCode}'";
    $res = mysqli_query($conn,$sql);
    $output = "00:00:00";
    if (mysqli_num_rows($res)>0) {
        while ($data = mysqli_fetch_assoc($res)) {
            $output=toHr(toSec($output) + toSec($data["hour"]));
        }
    }
    $sql1 = "select * from timesheet where MONTH(date) = MONTH(now()) and YEAR(date) = YEAR(now()) and emp_code='{$empCode}'";
    $res1 = mysqli_query($conn,$sql1);
    $output1 = "00:00:00";
    if (mysqli_num_rows($res1)>0) {
        while ($data1 = mysqli_fetch_assoc($res1)) {
            $output1=toHr(toSec($output1) + toSec($data1["hour"]));
        }
    }
    $ph =  explode(":",$output)[0];
    $ch =  explode(":",$output1)[0];
    if($ph == 0)
    {
        $ph = 1;
    }
    $th = (($ch * 100) / $ph ) - 100;

    echo $th;
}

// calculate the task with previous month
if(isset($_POST['flag']) and $_POST['flag']=="load_campare_task")
{
    $ch = 0;
    $ph = 0;
    $empCode = $_SESSION['emp_code'];
    $sql = "select count(*) as cnt from timesheet where MONTH(date) = MONTH(now())-1 and YEAR(date) = YEAR(now()) and emp_code='{$empCode}' and approve_type='Submitted'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0)
    {
        while($row = mysqli_fetch_assoc($res)){
            $ph =  $row['cnt'];
        }
    }
    $sql1 = "select count(*) as cnt1 from timesheet where MONTH(date) = MONTH(now()) and YEAR(date) = YEAR(now()) and emp_code='{$empCode}' and approve_type='Submitted'";
    $res1 = mysqli_query($conn,$sql1);
    if(mysqli_num_rows($res1)>0)
    {
        while($row = mysqli_fetch_assoc($res1)){
            $ch =  $row['cnt1'];
        }
    }
    if($ph == 0)
    {
        $ph = 1;
    }
    $th = (($ch * 100) / $ph ) - 100;

    echo $th;
}



// calculate the remaining task with previous month
if(isset($_POST['flag']) and $_POST['flag']=="load_remain_task")
{
    $ch = 0;
    $ph = 0;
    $empCode = $_SESSION['emp_code'];
    $sql = "select count(*) as cnt from timesheet where MONTH(date) = MONTH(now())-1 and YEAR(date) = YEAR(now()) and emp_code='{$empCode}' and approve_type!='Submitted'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0)
    {
        while($row = mysqli_fetch_assoc($res)){
            $ph =  $row['cnt'];
        }
    }
    $sql1 = "select count(*) as cnt1 from timesheet where MONTH(date) = MONTH(now()) and YEAR(date) = YEAR(now()) and emp_code='{$empCode}' and approve_type!='Submitted'";
    $res1 = mysqli_query($conn,$sql1);
    if(mysqli_num_rows($res1)>0)
    {
        while($row = mysqli_fetch_assoc($res1)){
            $ch =  $row['cnt1'];
        }
    }
    if($ph == 0)
    {
        echo $ch*100;
    }else{
        $th = (($ch * 100) / $ph ) - 100;
    
        echo $th;
    }
}



// load total remaining tasks
if(isset($_POST['flag']) and $_POST['flag']=="load_total_remain_tasks")
{
    $empCode = $_SESSION['emp_code'];
    $sql = "select count(*) as cnt from timesheet where emp_code='{$empCode}' and approve_type!='Submitted'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0)
    {
        while($row = mysqli_fetch_assoc($res)){
            echo $row['cnt'];
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
    $sql = "SELECT * FROM employeetb WHERE email = '" . $email . "' and BINARY password = '" . $pass . "'";
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
?>