<?php 
require_once './commons/utils.php';
$id = $_GET['id'];

$commentSql = "select * from " . TABLE_COMMENT
				. " where product_id = $id order by id desc";

$stmt = $conn->prepare($commentSql);
$stmt->execute();
$comments = $stmt->fetchAll();

$newProductsQuery = "	select * 
						from ".TABLE_PRODUCT." 
						where id = $id";
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
?><head>
	<?php 
	include './_share/client_assets.php';
	 ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	<title>Chi Tiết Sản Phẩm</title>
</head>

 <style type="text/css">
#tt{
		overflow: scroll;
    	height: auto;
    	height: 400px;
		}	
#cm{
    overflow: scroll;
    height: 270px;
    margin-top: 45px; 
    margin-bottom: 50px;
    border: #ccc 1px solid;
    border-radius: 2px;
}
a{
		color: black;
}
.link i{
	margin-left: 10px;
}
</style>
<body>
	<?php 
	include './_share/header.php';
	 ?>
	<div id="product">
		<div class="container">
			<div class="tittle-product">
				<center><h1>Thông tin sản phẩm</h1></center>
				<?php foreach ($newProducts as $tt ): ?>
					<div class="col-md-7 left" style="margin-top: 12px;">
						<img src="<?= $tt['image'] ?>">
					</div>
					<div class="col-md-5 right" style="border: 2px solid yellow; margin-top: 10px; border-radius:10px; color: #000">
						<div>
							<p style="font-size: 35; color: red; font-style: italic;"><?= $tt['product_name'] ?></p>	
						</div>
						<div>
							<b style="font-size: 25">Giá bán:  </b>
								<strike style="font-size: 25">
									<?= $tt['list_price'] ?> Đ
								</strike>
						</div>
						<div>
							<b style="font-size: 25">Giá khuyến mại: </b> 
							<span style="color: red; font-size: 25"><?= $tt['sell_price'] ?> Đ</span>
						</div>
						<div>
							<b style="font-size: 25">Mô tả:</b>
							<p  id="tt" style="font-size: 25"><?= $tt['detail'] ?></p>
						</div>
						<div>
							<b style="font-size: 25">Size</b>
							<select style="font-size: 20; margin-left: 20px;">
								<option>L</option>
								<option>M</option>
								<option>XL</option>
							</select>
						</div><br>
						<div>
							
							<form action="chitiet.php?id=<?=$np['id']?>" method="post">
								<button style="background: #FF3333;width: 300px; height: 50px; font-size: 30px;" name="btn_add"><a href="gh.php?id=<?=$tt['id']?>">Thêm Vào Giỏ Hàng</a></button>
							<input type="submit" name="btn_add" value="Giỏ hàng" class="details">
							<input type="hidden" name="id_pd" value="<?php echo $np['id']?>">
							<input type="hidden" name="img_pd" value="<?php echo $np['image']?>">
           					<input type="hidden" name="name_pd" value="<?php echo $np['product_name']?>">
           					<input type="hidden" name="price_pd" value="<?php echo $np['sell_price']?>">			
							</form>			
						</div>
						<div id="dm" style="margin-top: 40px; margin-bottom: 20px;">
							<h3>Từ Khóa</h3><br>
							<div class="link"> 
								<i class="fas fa-link"></i><a href="danhmuc.php?id=<?= $c['id']=3?>"> Áo  Nam</a>
								<i class="fas fa-link"></i><a href="danhmuc.php?id=<?= $c['id']=4?>"> Quần Nam</a>
								<i class="fas fa-link"></i><a href="danhmuc.php?id=<?= $c['id']=5?>"> Áo Thể Thao</a>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<div id="hot-product">
		<div class="container" style="border: 1px solid red; margin-top: 10px; border-radius:15px; color: #000">
			<div class="row">
				<div class="col-md-6">
					<h2 style="margin-left: 30px;">Phản hồi</h2>
					<form action="submit_comment.php" method="post">
						<input type="hidden" name="id" value="<?= $id?>">
						<div class="form-group">
							<label style="color: #000">Email</label>
							<input type="text" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label style="color: #000"3>Nội dung</label>
							<textarea class="form-control" rows="5" name="content" required></textarea>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-sm btn-primary" style="width: 300px; height: 50px; font-size: 15px;">Gửi phản hồi</button>
						</div>
					</form>
				</div>
				<center><h2>Các phản hồi trước</h2></center>
				<div class="col-md-6" id="cm">
				<?php foreach ($comments as $c): ?>
						<div style="max-width: 500px; height: auto;">
							<div style="border: 1px solid black; background:MintCream ; width: 100%; float: left;  max-height: all; margin-bottom:20px">
								<b style="font-size: 20; margin-left: 5PX;"><?= $c['email']?> </b>:
								<span style="font-size: 20; margin-left: 5PX;"> <?= $c['content']?></span>
							</div>
						</div>		
				<?php endforeach ?>
				</div>	
			</div>
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