<?php
class Chat{
    private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "quanta1";      
    private $chatTable = 'chat';
	private $chatUsersTable = 'employeetb';
	private $chatLoginDetailsTable = 'chat_login_details';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: ');
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}	
	public function loginUsers($username, $password){
		$sqlQuery = "
			SELECT emp_code, firstname 
			FROM ".$this->chatUsersTable." 
			WHERE firstname='".$username."' AND password='".$password."'";		
        return  $this->getData($sqlQuery);
	}		
	public function chatUsers($userid){
		// $sqlQuery = "
		// 	SELECT * FROM ".$this->chatUsersTable." 
		// 	WHERE emp_code != '$userid'";
			$sqlQuery = "
		SELECT * FROM  ".$this->chatUsersTable." e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code != '$userid'";
		return  $this->getData($sqlQuery);
	}
	public function getUserDetails($userid){
		$sqlQuery = "
		SELECT * FROM  ".$this->chatUsersTable." e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code = '$userid'";
		return  $this->getData($sqlQuery);
	}
	public function getUserAvatar($userid){
		$sqlQuery = "
		SELECT * FROM  ".$this->chatUsersTable." e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code = '$userid'";
		$userResult = $this->getData($sqlQuery);
		$userAvatar = '';
		foreach ($userResult as $user) {
			$userAvatar = $user['profile_picture'];
		}	
		return $userAvatar;
	}	
	public function updateUserOnline($userId, $online) {		
		$sqlUserUpdate = "
			UPDATE ".$this->chatUsersTable." 
			SET online = '".$online."' 
			WHERE emp_code = '".$userId."'";			
		mysqli_query($this->dbConnect, $sqlUserUpdate);		
	}
	public function insertChat($reciever_userid, $user_id, $chat_message) {		
		$sqlInsert = "
			INSERT INTO ".$this->chatTable." 
			(reciever_userid, sender_userid, message, status) 
			VALUES ('".$reciever_userid."', '".$user_id."', '".$chat_message."', '1')";
		$result = mysqli_query($this->dbConnect, $sqlInsert);
		if(!$result){
			return ('Error in query: '. mysqli_error());
		} else {
			$conversation = $this->getUserChat($user_id, $reciever_userid);
			$data = array(
				"conversation" => $conversation			
			);
			echo json_encode($data);	
		}
	}
	public function getImage($id){
		$sqlQuery = "
		SELECT * FROM  ".$this->chatUsersTable." e,emp_personal_infotb e1 where e.emp_code=e1.emp_code and e.emp_code = '$id'";
		$userResult = $this->getData($sqlQuery);
		$userAvatar = '';
		foreach ($userResult as $user) {
			$userAvatar = $user['profile_picture'];
		}	
		if ($user['profile_picture'] == "") {
			$img = "<img src='../assets/img/profile/proc.jpg' width='22px' height='22px' class='rounded-circle me-2'/>";
		} else {
			$img = "<img src='../assets/img/profile/{$user['profile_picture']}'  width='22px' height='22px' class='rounded-circle ms-2'/>";
		}
		return $img;
	}
	public function getUserChat($from_user_id, $to_user_id) {
		$fromUserAvatar = $this->getUserAvatar($from_user_id);	
		$toUserAvatar = $this->getUserAvatar($to_user_id);			
		$sqlQuery = "
			SELECT * FROM ".$this->chatTable." 
			WHERE (sender_userid = '".$from_user_id."' 
			AND reciever_userid = '".$to_user_id."') 
			OR (sender_userid = '".$to_user_id."' 
			AND reciever_userid = '".$from_user_id."') 
			ORDER BY timestamp ASC";
		$userChat = $this->getData($sqlQuery);	
		$conversation = '<ul>';
		foreach($userChat as $chat){
			$del_type_c = "";
			$user_name = '';
			if($chat["sender_userid"] == $from_user_id) {
				$conversation .= '<li class="sent" id='.$chat["chatid"].'>';
				$conversation .= $this->getImage($from_user_id);
				$del_type_c = "del_type_c";
			} else {
				$conversation .= '<li class="replies">';
				$conversation .= $this->getImage($to_user_id);
			}			
			if(!$chat["id_deleted"])
			{
				$conversation .= '<p class="delme show-image" id='.$chat["chatid"].'>'.$chat["message"].'</p>
				<button class="'.$del_type_c.' border-0 chatid'.$chat["chatid"].'"  id='.$chat["chatid"].' style="display:none;background:none;" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="ri-more-2-fill"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item delmessage" id='.$chat["chatid"].' href="#"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>
						Delete</a>
				</div>
				';			
			}else{
				$conversation .= '<p class="delme show-image d-flex"><i class="ri-chat-delete-line fs-5 px-1"></i> message deleted. </p>';			
			}
			$conversation .= '</li>';
		}		
		$conversation .= '</ul>';
		return $conversation;
	}
	public function showUserChat($from_user_id, $to_user_id) {		
		$userDetails = $this->getUserDetails($to_user_id);
		foreach ($userDetails as $user) {
			if ($user['profile_picture'] == "") {
				$img = "<img src='../assets/img/profile/proc.jpg' widht='30px' height='30px' class='rounded-circle '/>";
			} else {
				$img = "<img src='../assets/img/profile/{$user['profile_picture']}' widht='25px' height='25px' class='rounded-circle '/>";
			}
			$userSection =' <div class="d-flex"><div class="px-2">'. $img .'</div><div class="fs-5 pt-1">
				'.$user['firstname'].'</div></div>';
		}		
		// get user conversation
		$conversation = $this->getUserChat($from_user_id, $to_user_id);	
		// update chat user read status		
		$sqlUpdate = "
			UPDATE ".$this->chatTable." 
			SET status = '0' 
			WHERE sender_userid = '".$to_user_id."' AND reciever_userid = '".$from_user_id."' AND status = '1'";
		mysqli_query($this->dbConnect, $sqlUpdate);		
		// update users current chat session
		$sqlUserUpdate = "
			UPDATE ".$this->chatUsersTable." 
			SET current_session = '".$to_user_id."' 
			WHERE emp_code = '".$from_user_id."'";
		mysqli_query($this->dbConnect, $sqlUserUpdate);		
		$data = array(
			"userSection" => $userSection,
			"conversation" => $conversation			
		 );
		 echo json_encode($data);		
	}	
	public function getUnreadMessageCount($senderUserid, $recieverUserid) {
		$sqlQuery = "
			SELECT * FROM ".$this->chatTable."  
			WHERE sender_userid = '$senderUserid' AND reciever_userid = '$recieverUserid' AND status = '1'";
		$numRows = $this->getNumRows($sqlQuery);
		$output = '';
		if($numRows > 0){
			$output = $numRows;
		}
		return $output;
	}	
	public function updateTypingStatus($is_type, $loginDetailsId) {		
		$sqlUpdate = "
			UPDATE ".$this->chatLoginDetailsTable." 
			SET is_typing = '".$is_type."' 
			WHERE id = '".$loginDetailsId."'";
		mysqli_query($this->dbConnect, $sqlUpdate);
	}		
	public function fetchIsTypeStatus($userId){
		$sqlQuery = "
		SELECT is_typing FROM ".$this->chatLoginDetailsTable." 
		WHERE userid = '".$userId."' ORDER BY last_activity DESC LIMIT 1"; 
		$result =  $this->getData($sqlQuery);
		$output = '';
		foreach($result as $row) {
			if($row["is_typing"] == 'yes'){
				$output = ' - <small><em>Typing...</em></small>';
			}
		}
		return $output;
	}		
	public function insertUserLoginDetails($userId) {	
		
		$sql_chk_last_login = "select * from ".$this->chatLoginDetailsTable." where userid='".$userId."'";
		$res_chk_last_login = mysqli_query($this->dbConnect, $sql_chk_last_login);
		$chk = mysqli_num_rows($res_chk_last_login);
		if($chk > 0){
			date_default_timezone_set('Asia/Kolkata');
			$date = date('Y/m/d H:i:s', time());
			while($res=mysqli_fetch_assoc($res_chk_last_login)){
				$sqlInsert = "update ".$this->chatLoginDetailsTable." set last_activity='".$date."' where id = {$res['id']}";
			}
		}else{
			$sqlInsert = "INSERT INTO ".$this->chatLoginDetailsTable."(userid) VALUES ('".$userId."')";
		}


		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
        return $lastInsertId;		
	}	
	public function updateLastActivity($loginDetailsId) {		
		$sqlUpdate = "
			UPDATE ".$this->chatLoginDetailsTable." 
			SET last_activity = now() 
			WHERE id = '".$loginDetailsId."'";
		mysqli_query($this->dbConnect, $sqlUpdate);
	}	
	public function delmessage($id) {		
		
		$sqlDelete = "UPDATE ".$this->chatTable." SET `id_deleted`=1 WHERE `chatid`='".$id."'";
		mysqli_query($this->dbConnect, $sqlDelete);
	}	
	public function reassign_user($id) {		
		$sqlUserUpdate = "
			UPDATE ".$this->chatUsersTable." 
			SET current_session = 0 
			WHERE emp_code = '".$id."'";
		mysqli_query($this->dbConnect, $sqlUserUpdate);
		return $sqlUserUpdate;	
	}	
	public function getUserLastActivity($userId) {
		$sqlQuery = "
			SELECT last_activity FROM ".$this->chatLoginDetailsTable." 
			WHERE userid = '$userId' ORDER BY last_activity DESC LIMIT 1";
		$result =  $this->getData($sqlQuery);
		foreach($result as $row) {
			return $row['last_activity'];
		}
	}	
}
?>