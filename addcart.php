<?php 
session_start();
require_once './commons/utils.php';
$id = $_GET['id'];
$newProductsQuery = "	select * 
						from ".TABLE_PRODUCT." 
						";
$stmt = $conn->prepare($newProductsQuery);
$stmt->execute();


$product = $stmt->fetchAll();
//ktra nếu tồn tại giỏ hàng thì cập nhật giỏ hàng
//ngược lại thì tạo mới
if (! isset($_SESSION['cart'][$id])) {
	//tạo mới giỏ hàng
	$_SESSION['cart'][$id]['product_name']= $product['product_name'];
	$_SESSION['cart'][$id]['image']= $product['image'];
	$_SESSION['cart'][$id]['sell_price']= $product['sell_price'];
	$_SESSION['cart'][$id]['qty']= 1;
}
else
{
	//cập nhật giỏ hàng
		$_SESSION['cart'][$id]['qty'] += 1;
	}
	echo "<script>alert('Thêm vào giỏ hàng thành công'); location.href='giohang.php'</script>";
 ?>