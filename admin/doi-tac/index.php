<?php 
session_start();
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['moderator']);
$sql=" SELECT * FROM `brands`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$doitac = $stmt->fetchAll();
 ?>
       <style > 
          .img img{ 
           width: 320px; height: 300px;}
      </style>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ShopHung| Quản lý Đối tác</title>

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
        <small>Các đối tác</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl ?>">
        <i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Các đối tác</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-body">
                <table class="table table-bordered">
                  <body>
                  <tr>
                    <th style="width: 10px">ID</th>
                    <th style="width: auto;">Tên Đối tác</th>
                    <th style="width: auto;">Ảnh</th>
                    <th>
                      <a href="<?= $adminUrl?>doi-tac/add.php"
                        class="btn btn-xs btn-success"
                        >
                        <i class="fa fa-plus"></i> Thêm mới
                      </a>
                    </th>
                  </tr>
                  <?php foreach ($doitac as $c): ?>
                    
                    <tr>
                      <td><?= $c['id']?></td>
                      <td><?= $c['name']?></td>
                      <td class="img"><img src="<?= $siteUrl.$c['image'] ?>"></td>
                      <td>
                         <a href="<?= $adminUrl?>doi-tac/edit.php?id=<?= $c['id']?>"
                        class="btn btn-xs btn-info"
                        >
                          <i class="fa fa-pencil"></i> Cập nhật
                        </a>
                        <a href="javascript:;"
                          linkurl="<?= $adminUrl?>doi-tac/remove.php?id=<?= $c['id']?>"
                          class="btn btn-xs btn-danger btn-remove"
                        >
                          <i class="fa fa-trash"></i> Xoá
                        </a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </body>
                </table>
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
</body>
</html>