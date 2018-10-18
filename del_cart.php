<?php
session_start();
$cart=$_SESSION['cart'];
$id=$_GET['product_id'];
unset($_SESSION['cart'][$id]);
header("location:gh.php");
exit();
?>