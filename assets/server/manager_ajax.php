<?php
require 'connection.php';
session_start();

// pagination
$limit = 4; 
if(isset($_SESSION['start_from'])){
    $start_from = $_SESSION['start_from'];
}

//load Project Data
if (isset($_POST["flag"]) && $_POST["flag"] == "load_project_for_manager") {
    if(isset($_POST['row_no']))
    {
        $row=$_POST['row_no'];
        $row=($row-1)* $limit;
        $empCode=$_SESSION['emp_code'];
        $sql = "SELECT p.*,c.* FROM `projecttb` p,`clienttb` c,`projectteamtb` pt WHERE p.client_id=c.client_id AND `emp_code`='{$empCode}' AND pt.project_code=p.project_code LIMIT $row, $limit";
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
                        <td><span class='badge bg-label-{$signal} me-1'>{$data['status']}</span></td>";
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
                        
                // echo $output;
            }
            echo $output;
        } else {
            echo 0;
        }
    }
}


?>