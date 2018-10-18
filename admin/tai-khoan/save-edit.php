<?php 
session_start();
require_once '../../commons/utils.php';
checkLogin(USER_ROLES['admin']);
if($_SERVER['REQUEST_METHOD'] != 'POST'){
  header('location: ' . $adminUrl . 'tai-khoan');
  die;
}
$id = $_POST['userid'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$fullname = $_POST['fullname'];
$role = $_POST['role'];


$sql = "update " . TABLE_USERS . " 
    set
      email = '$email', 
      phone_number= $phone_number,
      fullname = '$fullname',
      role= 'role'
    where id = $id";

$stmt = $conn->prepare($sql);
// $stmt->bindParam(":email", $email);
// $stmt->bindParam(":phone_number", $phone_number);
// $stmt->bindParam(":fullname", $fullname);
$stmt->execute();
header('location: ' . $adminUrl . 'tai-khoan');
 ?>