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
		<div class="col-md-12">
			<table class="table table-hover" style="margin-top: 25px;">
				<tr>
					<th>STT</th>
					<th>Tên sản phẩm</th>
					<th>Ảnh sản phẩm</th>
					<th>Giá</th>
					<th>Xóa</th>
				</tr>
				<tbody>
					
				</tbody>
				<?php $stt=1; foreach ($_SESSION['cart'] as $key => $row): ?>
					<tr>
						<td><?php echo $stt; ?></td>
						<td><?php $row['nameproduct'] ?></td>
						<td><?php $row['imgproduct'] ?></td>
						<td><?php $row['priceproduct'] ?></td>
						<td><form action="get">
                            <a href="del_cart.php?product_id=<?php echo $key?>"><img src="img/del.jpg" style="width:28px; height: 28px"/></a></td>
                    </form></td>
					</tr>
				<?php $stt ++; endforeach ?>
			</table>
		</div>
		<hr>	
		<div class="col-md-12">
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
	<<div id="partner">
    <div class="container">
      <div class="tt">
        <h2 class="title-product">Các đối tác</h2>
      </div>
      <?php 
        include './_share/brand.php';
       ?>
    </div>
  </div><br>
	<?php 
	include './_share/footer.php';
	 ?>
</body>

</html>