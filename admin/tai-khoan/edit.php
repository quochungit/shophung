<?php 
session_start();

// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['admin']);
$userId = $_GET['id'];
$sql = "select * from " . TABLE_USERS . " where id = $userId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();
if(!$user){
  header('location: ' . $adminUrl . 'tai-khoan');
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Shop Hung | Sửa Tài khoản</title>

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
        <small>Sửa Tài khoản</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tài khoản</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <form action="<?= $adminUrl?>/tai-khoan/save-edit.php" method="post" >
          <input type="hidden" name="userid" value="<?=$userId?>">
          <div class="col-md-6">
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control" value="<?= $user['email']?>" required>
            </div>
            <div class="form-group">
              <label>Tên đầy đủ</label>
              <input type="text" name="fullname" class="form-control" value="<?= $user['fullname']?>" required>
            </div>
            <div class="form-group">
              <label>Quyền</label>
              <select name="role" class="form-control">
                <?php foreach (USER_ROLES as $key => $value): ?>
                  <option value="<?= $value ?>"><?= $key ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Số điện thoại</label>
              <input type="text" name="phone_number" class="form-control" required value="<?= $user['phone_number']?>">
            </div>
            <div class="col-md-12 text-right">
              <a href="<?= $adminUrl?>tai-khoan" class="btn btn-xs btn-danger">Huỷ</a>
              <button type="submit" class="btn btn-xs btn-primary">Lưu</button>
            </div>
          </div>
        </form>

      </div>
    </section>
    <!-- /.content -->
  </div>
   <?php include_once $path.'_share/footer.php'; ?>  
  <!-- /.content-wrapper -->
  <?php include_once $path.'_share/sidebar.php'; ?>  

</div>
<!-- ./wrapper -->
<?php include_once $path.'_share/bottom_asset.php'; ?>  


</body>
</html>