<?php 
session_start();
require_once '../../commons/utils.php';
checkLogin(USER_ROLES['admin']);
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'tai-khoan');
	die;
}
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$fullname = $_POST['fullname'];
$password = $_POST['password'];
$cfPassword = $_POST['cfPassword'];
$role = $_POST['role'];

$sql = "select * from users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$us = $stmt->fetchAll();
foreach ($us as $u) {
	if ($email == $u['email']) {
		header('location: ' . $adminUrl . 'tai-khoan/add.php?msg2=Email đã được sử dụng!');
	die;
	}
	}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		header('location: ' . $adminUrl . 'tai-khoan/add.php?msg2=Mời nhập email!');
	die; 
}
// email xem có tồn tại không
// mật khẩu có nằm trong khoảng từ 6-20 ký tự không
$password = password_hash($password, PASSWORD_DEFAULT);
$sql = "insert into users
			(email, 
			phone_number,
			fullname, 
			password, 
			role)
		values 
			(:email, 
			:phone_number,
			:fullname, 
			:password, 
			:role)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":phone_number", $phone_number);
$stmt->bindParam(":fullname", $fullname);
$stmt->bindParam(":password", $password);
$stmt->bindParam(":role", $role);
$stmt->execute();
header('location: ' . $adminUrl . 'tai-khoan');
 ?>