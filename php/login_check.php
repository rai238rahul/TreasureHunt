<?php
require "connection.php";
session_start();
$data = array("is_logged"=>0, "user"=>array(), "solution"=>array());
if(!isset($_SESSION['_is_logged']))
    $_SESSION['_is_logged'] = 0;
else{
    $sql = "select * from login where  email = '".$_SESSION['username']."'";
    $res = $conn->query($sql);
    $data['user'] = $res->fetch_assoc();
    $sql = "select * from solution where id = ".$data['user']['piid']."";
    // echo $sql;
    $res = $conn->query($sql);
    $data['solution'] = $res->fetch_assoc();


}
$data['is_logged'] = $_SESSION['_is_logged'];
echo json_encode($data);
?>
