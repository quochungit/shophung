<?php 
require_once '../../commons/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
  header('location: ' . $adminUrl . 'slide-show');
  die;
}
$slideshowId = $_POST['id'];
$tt = $_POST['tt'];
$status = $_POST['status'];
$img = $_FILES['image'];
$old_filename = $_POST['old_filename'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'img/slider/'.uniqid() . '.' . $ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);
if ($img['name'] == "") {
  $filename = $image;
}
if ($img['name'] === "" || $img['size'] === 0 ) {
  $filename = $old_filename;
}
$imageFileType = strtolower($ext);
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $filename = $old_filename;
  
}
$sql = "UPDATE slideshows SET tt=:tt,status=:status,image=:image WHERE id = '$slideshowId'";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":image", $filename);
$stmt->bindParam(":tt", $tt);
$stmt->bindParam(":status", $status);
$stmt->execute();
header('location: ' . $adminUrl . 'slide-show');
 ?>