<?php 
 session_start();
require_once './commons/utils.php';
 $newBrandsQuery = "	select * 
						from ".TABLE_BRANDS." 
						order by id desc limit 4
						";
$stmt = $conn->prepare($newBrandsQuery);
$stmt->execute();

$newBrands = $stmt->fetchAll();

var_dump($_SESSION['cart']);
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
	<div class="container" style="background: #FFFFCC	">
		<div class="col-md-12"><center><h2>Giỏ hàng của bạn</h2></center></div>
		<div class="col-md-9">
			<table class="table table-hover" style="margin-top: 25px;">
				<tr>
					<th>STT</th>
					<th>Tên sản phẩm</th>
					<th>Ảnh sản phẩm</th>
					<th>Giá</th>
					<th></th>
				</tr>
				<tbody>
					
				</tbody>
				<?php $stt=1; foreach ($_SESSION['cart'] as $key => $item): ?>
					<tr>
						<td><?php echo $stt; ?></td>
						<td><?php $item['product_name'] ?></td>
						<td>
						</td>
						<td><?php $item['sell_price'] ?></td>
						<td></td>
					</tr>
				<?php $stt ++; endforeach ?>
			</table>
		</div>
		<div class="col-md-3" style="float: right;">
			<center><h3>THÔNG TIN KHÁCH HÀNG</h3></center><br>
			<form method="POST" action="giohang.php" id="vali">
				<b>Tên khách hàng</b> 
				<input class="form-control" type="text" name="tenkh" required><br>
				<b>Email</b> 
				<input  class="form-control" type="text" name="emailkh" required><br>
				<b>Số điện thoại</b> 
				<input class="form-control" type="text" name="sdtkh" required><br>
				<b>Địa chỉ nhận hàng</b> 
				<textarea class="form-control" rows="5" name="diachikh" required></textarea><br>
				<b>Ghi chú</b> 
				<textarea class="form-control" rows="5" name="ghichu" required></textarea><br>
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