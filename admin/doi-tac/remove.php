<?php 
require_once '../../commons/utils.php';
$brandId = $_GET['id'];
$sql = "select * from ".TABLE_BRANDS." where id = $brandId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$brand = $stmt->fetch();
if(!$brand){
	header('location: ' . $adminUrl . "doi-tac");
	die;
}

$sql = "delete from ".TABLE_BRANDS." where id = $brandId";
$stmt = $conn->prepare($sql);
$stmt->execute();

header('location: ' . $adminUrl . "doi-tac");
 ?>