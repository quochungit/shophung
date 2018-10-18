<?php
session_start();
require_once '../../commons/utils.php';
checkLogin(USER_ROLES['moderator']);
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'slide-show');
	die;
}
$tt = $_POST['tt'];
$order_number = $_POST['order_number'];
$img = $_FILES['image'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'img/slideshow/'.uniqid() . '.' . $ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);

$sql= "insert into slideshows (image, tt, order_number)
		values 
		(:image, :tt, :order_number)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":image", $filename);
$stmt->bindParam(":tt", $tt);
$stmt->execute();
header('location: ' . $adminUrl . 'slide-show?success=true');
 ?>
