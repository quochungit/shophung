<?php
require_once './commons/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . '');
	die;
}
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$nd = $_POST['nd'];

$sql= "insert into contact (name, email, phone, nd)
		values 
		(:name, :email, :phone, :nd)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":phone", $phone);
$stmt->bindParam(":nd", $nd);
$stmt->execute();
 ?>
<div style="width: 100%; height: 40px; background: #000; color: white;">
	  <center><H1>Đã gửi!</H1></center>
</div>
 <script type="text/javascript">
 	setTimeout(function(){
 		window.location.href = '<?= $siteUrl ?>';
 	}, 1000);
 </script>

