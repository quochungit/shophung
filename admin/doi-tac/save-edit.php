<?php 
require_once '../../commons/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'doi-tac');
	die;
}
$id = $_POST['id'];
$old_filename = $_POST['old_filename'];
$name = $_POST['name'];
$img = $_FILES['image'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'img/doitac/'.uniqid() . '.' . $ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);
if ($img['name'] === "" || $img['size'] === 0 ) {
	$filename = $old_filename;
} 
$imageFileType = strtolower($ext);
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	$filename = $old_filename;
	
}
$sql = "update " . TABLE_BRANDS . " 
		set
			name = :name, 
			image= :image
		where id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":image", $filename, PDO::PARAM_STR);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
header('location: ' . $adminUrl . 'doi-tac');
 ?>