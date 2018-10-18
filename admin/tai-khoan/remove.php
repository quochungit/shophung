<?php 
require_once '../../commons/utils.php';
$avatarId = $_GET['id'];
$sql = "select * from ".TABLE_USERS." where id = $avatarId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$avatar = $stmt->fetch();
if(!$avatar){
	header('location: ' . $adminUrl . "tai-khoan");
	die;
}

$sql = "delete from ".TABLE_USERS." where id = $avatarId";
$stmt = $conn->prepare($sql);
$stmt->execute();

header('location: ' . $adminUrl . "tai-khoan");
 ?>