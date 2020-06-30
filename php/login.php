<?php
require "connection.php";
session_start();
$_SESSION['_is_logged'] = 0;
$data = json_decode(file_get_contents('php://input'));
$user =  $conn->real_escape_string($data->username);
$pass =  $conn->real_escape_string($data->pass);
$sql = "select * from login where  email = '".$user."' and password = '".$pass."'";
// echo $sql;
$result = $conn->query($sql);
if($result->num_rows > 0){
    $json = $result->fetch_assoc();
    $_SESSION['username'] = $json['email'];
    $_SESSION['_is_logged'] = 1;
    echo json_encode($_SESSION);
    
}else{
    $_SESSION['username'] = "";
    $_SESSION['_is_logged'] = 0;
    echo json_encode($_SESSION);
    
}
?>
