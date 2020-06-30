<?php
require "connection.php";
session_start();
$data = json_decode(file_get_contents('php://input'));
$sql = "select piid from login where email = '".$_SESSION['username']."'";
$res = $conn->query($sql);
if(($res->fetch_assoc())['piid'] == $data){
    $sql = "SELECT TIMESTAMPDIFF(SECOND,  (SELECT first_time FROM solution WHERE id=(select piid from login where email = '".$_SESSION['username']."')),CURRENT_TIMESTAMP()) as timediff";
$res = $conn->query($sql);
$diff = (int)($res->fetch_assoc())['timediff'];
// echo json_encode($diff); 
$sql = "select flag from solution where id = (select piid from login where email = '".$_SESSION['username']."')+1";
$res = $conn->query($sql);
$flag = ($res->fetch_assoc())['flag'];
// echo $flag;
if($flag == 0){
    $sql = "update solution set first_time = CURRENT_TIMESTAMP(), flag = 1 where id = (select piid from login where email = '".$_SESSION['username']."')+1 ";
    $res = $conn->query($sql); 
}
$score = 0;
if ($diff <1800){
    $score = 100;
}else if($diff >=1800 && $diff <=7200)
    $score = 70;
else 
    $score = 50;

/*Update the piid of the user to get the next image.*/
$sql = "update login set score = score+'".$score."', curhint = 0, total_hit = total_hit+1, piid = piid+1, last_submit = CURRENT_TIMESTAMP() where email ='".$_SESSION['username']."' ";
// echo $sql;
$res = $conn->query($sql);
$data = array("is_logged"=>0, "user"=>array(), "solution"=>array());

    $sql = "select * from login where  email = '".$_SESSION['username']."'";
    $res = $conn->query($sql);
    $data['user'] = $res->fetch_assoc();
    $sql = "select * from solution where id = ".$data['user']['piid']."";
    // echo $sql;
    $res = $conn->query($sql);
    $data['solution'] = $res->fetch_assoc();



$data['is_logged'] = $_SESSION['_is_logged'];
echo json_encode($data);

}
?>
