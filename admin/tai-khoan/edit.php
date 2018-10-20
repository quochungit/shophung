<?php 
session_start();

// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['admin']);
$id = $_GET['id'];
$sql = "select * from " . TABLE_USERS . " where id = $id";
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
          <div class="col-md-6">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group">
              <label>Email</label>
              <!-- /.error -->
              <?php 
              if(isset($_GET['msg1']) && $_GET['msg1'] != ""){
               ?>
               <div class="form-group"  style="height: 25px; border: 1px solid red; background: #FFCCCC"> | <?= $_GET['msg1'] ?></div>
              <?php } 
              ?>
              <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>">
            </div>
            <div class="form-group">
              <label>Tên đầy đủ</label>
              <input type="text" name="fullname" class="form-control" value="<?= $user['fullname'] ?>">
            </div>
            <div class="form-group">
              <label>Mật khẩu mới</label>
              <input type="password" name="password" class="form-control">
            </div>
            <!-- /.error -->
              <?php 
              if(isset($_GET['msg']) && $_GET['msg'] != ""){
               ?>
               <div class="form-group" style="height: 30px; border: 1px solid red; background: #FFCCCC"><?= $_GET['msg'] ?></div>
              <?php } 
              ?>
            <div class="form-group">
              <label>Xác nhận mật khẩu mới</label>
              <input type="password" name="cfPassword" class="form-control">
            </div>
            <div class="form-group">
              <label>Quyền</label>
              <select name="role" class="form-control">
                <?php foreach (USER_ROLES as $key => $value): ?>
                  <option value="<?= $value ?>"><?= $key ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="col-md-12 text-right">
              <a href="<?= $adminUrl?>tai-khoan" class="btn  btn-danger">Huỷ</a>
              <button type="submit" class="btn  btn-primary">Lưu</button>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#editor').wysihtml5();
  });
  function getBase64(file, selector) {
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function () {
      $(selector).attr('src', reader.result);
     };
     reader.onerror = function (error) {
       console.log('Error: ', error);
     };
  }
  var img = document.querySelector('#product_image');
  img.onchange = function(){
    var file = this.files[0];
    if(file == undefined){
      $('#imageTarget').attr('src', "<?= $siteUrl ?>img/default/default-picture.jpg");
    }else{
      getBase64(file, '#imageTarget');
    }
  }
</script>
</body>
</html>