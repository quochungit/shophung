<?php
require_once '../../commons/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'danh-muc');
	die;
}
$name = $_POST['name'];
$desc = $_POST['desc'];
if(!$name){
	header('location: ' . $adminUrl . 'danh-muc/add.php?errName=Vui lòng nhập tên danh mục');
	die;
}
$sql = "insert into " . TABLE_CATEGORY . " 
		values
			(null, :name, :desc)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":desc", $desc, PDO::PARAM_STR);
$stmt->execute();
header('location: ' . $adminUrl . 'danh-muc?success=true');
 ?>