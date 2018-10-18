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
if($password != $cfPassword){
	header('location: ' . $adminUrl . 'tai-khoan/add.php?msg=Xác nhận mật khẩu không đúng!');
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