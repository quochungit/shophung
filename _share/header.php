<?php 
require_once './commons/utils.php';

$sql = "select * from " . TABLE_WEBSETTING;
$stmt = $conn->prepare($sql);
$stmt->execute();

$data = $stmt->fetch();

// var_dump($data);
$sqlCates = "select * from " . TABLE_CATEGORY;

$stmt = $conn->prepare($sqlCates);
$stmt->execute();

$dataCate = $stmt->fetchAll();


 ?>
<div id="header">
	<div class="container">
		<div class="col-md-2 col-xs-12 col-sm-4">
			<a href="index.php">
				<img src="<?= $siteUrl . $data['logo'] ?>" alt="logo" >
			</a>
		</div>
		<div class="col-md-10 col-xs-12 col-sm-8">
			<div class="header-time col-md-12 col-xs-12 col-sm-12">
				<a href="#" class="col-xs-12 col-md-3">Thời gian làm việc:8h30-17h</a>
				<a href="#" class="col-xs-12 col-md-3">Hotline: <?= $data['hotline'] ?></a>
				<a href="<?= $siteUrl?>khach-hang/login.php" class="col-xs-12 col-md-2">Đăng nhập</a>
				<a href="<?= $siteUrl?>khach-hang/register.php" class="col-xs-12 col-md-1">Đăng ký</a>
			</div>
			<div class="clear-fix" >
			</div>
			<div class="header-menu col-md-12" >
				<ul class="nav navbar-nav" >
					<li>
						<a href="<?= $siteUrl?>">Trang chủ</a>
					</li>
					<li>
						<a href="<?= $siteUrl?>gioithieu.php">Giới thiệu</a>
					</li>
					<!-- Danh sach danh muc -->
					<?php foreach ($dataCate as $c): ?>
						<li>
							<a href="danhmuc.php?id=<?= $c['id']?>"><?= $c['name']?></a>
						</li>
					<?php endforeach ?>
						<li>
							<a href="<?= $siteUrl?>contact.php">Liên hệ</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="aa" class=" col-md-12" style="margin: auto;">
				<div class="bb">
					<form method="get" action="<?= $siteUrl ?>search.php" class="form-inline my-2 my-lg-0">
         			 <input name="search" class="nav-item form-control mr-sm-2" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search">
        			  <button style=" float: right;" class="nav-item btn  my-2 my-sm-0 btn-search" type="submit">Tìm</button>
       				</form>
				</div>
       	</div>
	</div>
<style type="text/css">
	.aa{
		height: 36px;
		background: #222222;
		width: 100%;

	}
	.aa button{
		margin-right: 30px;
		position: absolute;
		top: 0px;
		right: -90px;
	}
	.aa form{
		margin-right: 30px;
		position: absolute;
		top: 0px;
		right: 30px;
	}
	.bb{
		max-width: 1100px;
		margin: auto;
		position: relative;
	}
</style>