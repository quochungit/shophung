<?php 
 session_start();
require_once './commons/utils.php';
$newProductsQuery = "	select * 
						from ".TABLE_PRODUCT." 
						";
$stmt = $conn->prepare($newProductsQuery);
$stmt->execute();

$newProducts = $stmt->fetchAll();
// lay du lieu tu csdl bang doi tac
$newBrandsQuery = "	select * 
						from ".TABLE_BRANDS." 
						order by id desc limit 4
						";
$stmt = $conn->prepare($newBrandsQuery);
$stmt->execute();

$newBrands = $stmt->fetchAll();

if (!isset($_SESSION['cart'])) {
        $_SESSION['cart']= [];
    }

    if (isset($_POST['btn_add'])) {
		$id_product = $_POST['id_pd'];
        $img_product = $_POST['img_pd'];
        $name_product = $_POST['name_pd'];
        $price_product = $_POST['price_pd'];
        $_SESSION['cart'][$id_product]=['nameproduct' => $name_product, 'priceproduct'=> $price_product, 'imgproduct'=>$img_product];
    }
?>
 <head>
	<?php 
	include './_share/client_assets.php';
	 ?>
	<title>Giỏ hàng của bạn</title>
</head>

</style>
<body>
	<?php 
	include './_share/header.php';
	 ?>
	<div class="container">
		<div class="col-md-12"><center><h2>Giỏ hàng của bạn</h2></center></div>
		<div class="col-md-8">
			<table class="table table-bordered bo" style="margin-top: 25px;">
				<tr>
					<th width="150px">Tên sản phẩm</th>
					<th width="150px">Ảnh sản phẩm</th>
					<th width="100px">Giá</th>
					<th width="100px"></th>
				</tr>
				<tr>
					<td>â</td>
					<td>a</td>
					<td>a</td>
					<td>Xóa</td>
					</form>
				</tr>
			</table>
		</div>
		<div class="col-md-4">
			<center><h3>THÔNG TIN KHÁCH HÀNG</h3></center><br>
			<form method="POST" action="giohang.php">
				
				<b>Tên khách hàng</b> 
				<input class="form-control" type="text" name="tenkh"><br>
				<b>Email</b> 
				<input  class="form-control" type="text" name="emailkh"><br>
				<b>Số điện thoại</b> 
				<input class="form-control" type="text" name="sdtkh"><br>
				<b>Địa chỉ nhận hàng</b> 
				<textarea class="form-control" rows="5" name="diachikh"></textarea><br>
				<b>Ghi chú</b> 
				<textarea class="form-control" rows="5" name="ghichu"></textarea><br>
				<input  type="submit" name="btn_gui" value="THANH TOÁN">
			</form>
		</div>
	</div>
	<div id="partner">
		<div class="container">
			<h2 class="title-product">Các đối tác</h2>
			<?php foreach ($newBrands as $dt ): ?>
				<div class="partner-img col-md-3 col-xs-6">
					<img src="<?= $siteUrl . $dt['image']?>" alt="">
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<?php 
	include './_share/footer.php';
	 ?>
</body>

</html>