<?php 
session_start();
//lấy id
$id= isset($GET['id']) ? $_GET['id'] : '';