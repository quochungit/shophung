<?php 
session_start();
require_once '../../commons/utils.php';
checkLogin(USER_ROLES['moderator']);
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'san-pham');
	die;
}
$product_name = $_POST['product_name'];
$detail = $_POST['detail'];
$list_price = $_POST['list_price'];
$sell_price = $_POST['sell_price'];
$cate_id = $_POST['cate_id'];
$img = $_FILES['image'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'img/products/'.uniqid() . '.' . $ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);
$sql = "insert into products
			(product_name, 
			cate_id, 
			list_price, 
			sell_price, 
			image, 
			detail)
		values 
			(:product_name, 
			:cate_id, 
			:list_price, 
			:sell_price, 
			:image, 
			:detail)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":product_name", $product_name);
$stmt->bindParam(":cate_id", $cate_id);
$stmt->bindParam(":list_price", $list_price);
$stmt->bindParam(":sell_price", $sell_price);
$stmt->bindParam(":image", $filename);
$stmt->bindParam(":detail", $detail);
$stmt->execute();
header('location: ' . $adminUrl . 'san-pham');
 ?>