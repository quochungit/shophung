<?php 
session_start();
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin();
$cateId = $_GET['id'];
$sql = "select * from " . TABLE_CATEGORY . " where id = $cateId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetch();
if(!$cate){
  header('location: ' . $adminUrl . 'danh-muc');
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Sửa danh mục</title>

  <?php include_once $path.'_share/top_asset.php'; ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include_once $path.'_share/header.php'; ?> 

  <?php include_once $path.'_share/sidebar.php'; ?>  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Sửa danh mục</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Danh mục</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <form action="<?= $adminUrl ?>danh-muc/save-edit.php" method="post">
            <input type="hidden" name="id" value="<?= $cate['id']?>">
            <div class="form-group">
              <b>Tên danh mục</b>
              <input type="text" name="name" class="form-control" value="<?= $cate['name']?>">
              <?php 
              if(isset($_GET['errName']) && $_GET['errName'] != ""){
               ?>
               <label class="text-danger"><?= $_GET['errName'] ?></label>
              <?php } ?>
            </div>
            <div class="form-group">
              <b>Mô tả</b>
              <textarea class="form-control" name="description" rows="5"><?= $cate['description']?></textarea>
            </div>
            <div class="text-center">
              <a href="<?= $adminUrl?>danh-muc" class="btn btn-danger btn-xs">Huỷ</a>
              <button type="submit" class="btn btn-primary btn-xs">Cập nhật</button>
            </div>
          </form>
        </div>
      </div>
    </section>
    <style type="text/css">
        label{
          height: auto; background: #FFCCCC; color: black; border: 1px red solid; width: auto; margin-top: 10px;

          }
      </style>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once $path.'_share/sidebar.php'; ?>  

</div>
<!-- ./wrapper -->
<?php include_once $path.'_share/bottom_asset.php'; ?>  

</body>
</html>