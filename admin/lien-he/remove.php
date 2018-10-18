<?php 
require_once '../../commons/utils.php';
$contactId = $_GET['id'];
$sql = "select * from ".TABLE_CONTACT." where id = $contactId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$contact = $stmt->fetch();
if(!$contact){
	header('location: ' . $adminUrl . "lien-he");
	die;
}

$sql = "delete from ".TABLE_CONTACT." where id = $contactId";
$stmt = $conn->prepare($sql);
$stmt->execute();

header('location: ' . $adminUrl . "lien-he");
 ?>
