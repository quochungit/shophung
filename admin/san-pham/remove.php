<?php
require_once '../../commons/utils.php';
$productId = $_GET['id'];
$sql = "select * from ".TABLE_PRODUCT. " where id = $productId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$product = $stmt->fetch();
if(!$product){
    header('location: ' . $adminUrl . "san-pham");
    die;
}
// xoa san pham
$sql = " delete from ".TABLE_PRODUCT." where id = $productId";
$stmt = $conn->prepare($sql);
$stmt->execute();
header('location: ' . $adminUrl . "san-pham");
?>
