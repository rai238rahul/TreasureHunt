<?php
require "connection.php";
session_start();
$sql = "update login set curhint = curhint+1, wrong_hit = wrong_hit+1, total_hit = total_hit+1 where email ='".$_SESSION['username']."' ";
// echo $sql;
$res = $conn->query($sql);
$sql = "select * from login where  email = '".$_SESSION['username']."'";
$res = $conn->query($sql);
$data = $res->fetch_assoc();
echo json_encode($data);
?>
