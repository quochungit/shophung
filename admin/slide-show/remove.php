<?php 
require_once '../../commons/utils.php';
$slideshowId = $_GET['id'];
$sql = "select * from ".TABLE_SLIDESHOW." where id = $slideshowId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$slideshow = $stmt->fetch();
if(!$slideshow){
	header('location: ' . $adminUrl . "slide-show");
	die;
}

$sql = "delete from ".TABLE_SLIDESHOW." where id = $slideshowId";
$stmt = $conn->prepare($sql);
$stmt->execute();

header('location: ' . $adminUrl . "slide-show");
 ?>