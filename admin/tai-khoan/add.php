<?php 
session_start();
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['admin']);
 ?>
<!DOCTYPE html>
<html> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ShopHung | Quản lý Tài khoản</title>
  <?php include_once 
  $path.'_share/top_asset.php';?>

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
        <small>Quản lý tài khoản</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tài khoản</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <form action="<?= $adminUrl?>/tai-khoan/save-add.php" method="post" id="vali">
          <div class="col-md-6">
            <div class="form-group">
              <b>Email</b>
              <?php 
              if(isset($_GET['msg2']) && $_GET['msg2'] != ""){
               ?>
               <span class="text-danger"> | <?= $_GET['msg2'] ?></span>
              <?php } 
              ?>
              <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <b>Tên đầy đủ</b>
              <input type="text" name="fullname" class="form-control" required>
            </div>
            <div class="form-group">
              <b>Mật khẩu</b>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
              <b>Xác nhận mật khẩu</b>
              <input type="password" name="cfPassword" class="form-control" required>
            </div>
            <div class="form-group">
              <b>Quyền</b>
              <select name="role" class="form-control">
                <?php foreach (USER_ROLES as $key => $value): ?>
                  <option value="<?= $value ?>"><?= $key ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <b>Số điện thoại</b>
              <input type="text" name="phone_number" class="form-control" required>
            </div>
            <div class="col-md-12 text-right">
              <a href="<?= $adminUrl?>tai-khoan" class="btn btn-xs btn-danger">Huỷ</a>
              <button type="submit" class="btn btn-xs btn-primary">Lưu</button>
            </div>
          </div>
        </form>
      </div>
    </section>
    <style type="text/css">
      label{
          height: auto; background: #FFCCCC; color: black; border: 1px red solid; width: auto; margin-top: 10px;

          }
    </style>
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
  var img = document.querySelector('#avt');
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
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script>
  $("#vali").validate({
            rules: {
              phone_number:{
                    required: true,
                    minlength: 10
                },
                fullname: "required",
                email: {
                    required: true,
                    minlength: 1
                },
                password: {
                    required: true,
                    minlength: 5
                },
                cfPassword: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
              phone_number: {
                            required: "Vui lòng nhập số điện thoại",
                            minlength: "Mời nhập SĐT, ít nhất 10 chữ số"
                        },
                fullname: "Vui lòng nhập tên",
                email:{
                    required: "Vui lòng nhập email",
                   
                },  
                password: {
                    required: "Vui lòng nhập password",
                    minlength: "Ít nhất 5 ký tự"
                },
                cfPassword: {
                    required: "Xác nhận password",
                    minlength: "Không khớp"
                }
            }
        });
</script>
</html>