
<?php
session_start();
error_reporting(0);
require_once('DBConnection.php');

 extract($_POST);
 //$aa=$_GET['eid'];

 
 
         $eid = $_SESSION['eid'];

        $from_user = $_SESSION['id'];
        $to_user = $user_to;
        $type = 1;
        $message = $conn->real_escape_string(($message));
        $message = str_replace('/r','<br>',$message);
        $ins_message = $conn->query("INSERT INTO `messages` set from_user='{$from_user}', to_user='{$to_user}', `type` = '{$type}',`message` ='{$message}'");
        if($ins_message){
    header("Location:index.php?eid=$eid");
        }else{
            $resp['status'] = "failed";
            $resp['error'] = $conn->error;
        }
?>