<?php 
session_start();
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['admin']);
// dem ton so record trong bang danh muc
$sql = "select * from users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();
// dd($cates);
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ShopHung | Quản lý tài khoản</title>

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
        <table class="table table-stripped">
          <thead>
            <th>ID</th>
            <th>Email</th>
            <th>Tên</th>
            <th>Quyền</th>
            <th>Số điện thoại</th>
            <th>
              <a href="<?= $adminUrl ?>tai-khoan/add.php" 
                  class="btn btn-sm btn-success">Thêm mới</a>
            </th>
          </thead>   
          <tbody>
            <?php foreach ($users as $u): ?>
              <tr>
                <td><?= $u['id'] ?></td>
                <td><?= $u['email'] ?></td>
                <td><?= $u['fullname'] ?></td>
                <td>
                  <?php if ($u['role'] == USER_ROLES['admin']): ?>
                    <span>Quản trị</span>  
                  <?php elseif($u['role'] == USER_ROLES['moderator']): ?>
                    <span>Quản trị viên</span> 
                  <?php else: ?>
                    <span>Thành viên</span>  
                  <?php endif ?>
                  </td>
                <td><?= $u['phone_number'] ?></td>
                <td>
                  <a href="<?= $adminUrl ?>tai-khoan/edit.php?id=<?= $u['id'] ?>" 
                  class="btn btn-sm btn-primary">Sửa</a>
                  <a href="javascript:;"
                          linkurl="<?= $adminUrl?>tai-khoan/remove.php?id=<?= $u['id']?>"
                          class="btn btn-sm btn-danger btn-remove"
                        >
                          <i class="fa fa-trash"></i> Xoá
                        </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>       
        </table>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once $path.'_share/sidebar.php'; ?>  

</div>
<!-- ./wrapper -->
<?php include_once $path.'_share/bottom_asset.php'; ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  <?php 
  if(isset($_GET['success']) && $_GET['success'] == 'true'){
    ?>
    swal('Thêm đối tác thành công!');
  <?php
  }
   ?>
  $('.btn-remove').on('click', function(){
    var removeUrl = $(this).attr('linkurl');
    // var conf = confirm('Bạn có chắc chắn muốn xoá đối tác này không?');
    // if(conf){
    //  window.location.href = removeUrl;
    // }
    swal({
      title: "Cảnh báo",
      text: "Bạn có chắc chắn muốn xoá đối tác này không?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = removeUrl;
      } 
    });
  });
</script>
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