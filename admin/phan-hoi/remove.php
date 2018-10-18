<?php 
require_once '../../commons/utils.php';
$commenId = $_GET['id'];
$sql = "select * from ".TABLE_COMMENT." where id = $commenId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$commen = $stmt->fetch();
if(!$commen){
	header('location: ' . $adminUrl . "phan-hoi");
	die;
}

$sql = "delete from ".TABLE_COMMENT." where id = $commenId";
$stmt = $conn->prepare($sql);
$stmt->execute();

header('location: ' . $adminUrl . "phan-hoi");
 ?>