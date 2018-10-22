<?php 
require_once './commons/utils.php';
$id = $_GET['id'];

// 1. Kiem tra xem id danh muc co thuc su ton tai khong
$sql = "select * from products where cate_id =  cái cate_id sản phẩm đang xem";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetch();

 ?>
<style type="text/css">
	.sqlq{
		background: #ccc;

		margin-top: 10px;
}
</style>
<div class="container sqlq">
	
</div>