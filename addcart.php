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
 if (!isset($_SESSION['cart'])) {
        $_SESSION['cart']= [];
    }
    if (isset($_POST['btn_add'])) {
		$id_product = $_POST['id_product'];
        $img_product = $_POST['img_product'];
        $name_product = $_POST['name_product'];
        $price_product = $_POST['price_product'];
        $_SESSION['cart'][$id_product]=['nameproduct' => $name_product, 'priceproduct'=> $price_product, 'imgproduct'=>$img_product];
    }
else
{
	//cập nhật giỏ hàng
		$_SESSION['cart'][$id]['qty'] += 1;
	}
	echo "<script>alert('Thêm vào giỏ hàng thành công'); location.href='giohang.php'</script>";
 ?>