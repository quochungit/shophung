<?php 
require_once './commons/utils.php';

$sql = "select * from " . TABLE_WEBSETTING;
$stmt = $conn->prepare($sql);
$stmt->execute();

$data = $stmt->fetch();

 ?>

 <div id="footer">
	<div class="container">
			<div class="col-md-8" style="margin-top: 20px;">
				<?= $data['map']?>
			</div>
			<div class="col-md-4 footer-main">
				<div class="ft">
					<a href="<?= $siteUrl?>khach-hang/register.php"><p style="font-size: 20; color: red; margin-top: 20px;">Đăng ký thành viên để nhận đc ưu đãi</p></a>
				</div>
				<div>
					<label>Gmail:</label>
					<a href="#"><?= $data['email']?></a>
				</div>
				<div>
					<label>Số điện thoại:</label>
					<a href="#"><?= $data['hotline']?></a>
				</div>
				<div>
					<label>Facebook:</label>
					<a href="#"><?= $data['fb']?></a>
				</div>
				<div style="margin-top: 20px; margin-bottom: 20px;">	
					<a href="index.php"><img src="<?= $siteUrl . $data['logo'] ?>" alt="logo" >
				</div>
			</div>
	</div>
</div>