<?php
session_start();
require_once '../../commons/utils.php';
checkLogin(USER_ROLES['moderator']);
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'slide-show');
	die;
}
$tt = $_POST['tt'];
$status = $_POST['status'];
$img = $_FILES['image'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'img/slideshow/'.uniqid() . '.' . $ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);

$sql= "insert into slideshows (image, tt, status)
		values 
		(:image, :tt, :status)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":image", $filename);
$stmt->bindParam(":tt", $tt);
$stmt->bindParam(":status", $status);
$stmt->execute();
header('location: ' . $adminUrl . 'slide-show?success=true');
 ?>
