<?php 
session_start();
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['moderator']);
$brandId = $_GET['id'];
$sql = "select * from " . TABLE_BRANDS . " where id = $brandId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$brand = $stmt->fetch();
if(!$brand){
  header('location: ' . $adminUrl . 'danh-muc');
}
 ?>
 <style type="text/css">
   img{
    width: 350px;
    height: auto;
   }
 </style>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ShopHung| Sửa đối tác</title>

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
        <small>Quản lí đối tác</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sửa đối tác</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <div class="row">
        <div class="col-md-8">
          <form action="<?= $adminUrl ?>doi-tac/save-edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $brand['id']?>">
            <div class="form-group">
              <label>Tên đối tác</label>
              <input type="text" name="name" class="form-control" value="<?= $brand['name']?>">
              <?php 
              if(isset($_GET['errName']) && $_GET['errName'] != ""){
               ?>
               <span class="text-danger"><?= $_GET['errName'] ?></span>
              <?php } ?>
            </div>
            <div class="form-group">
              <label>Ảnh đối tác</label>
              <input type="hidden" name="old_filename" value="<?= $brand['image'] ?>">
               <img id="imageTarget" src="<?= $siteUrl?><?= $brand['image']?>" class="img-responsive" >
              <input type="file" id="product_image" name="image" class="form-control" >
            </div>
            <div class="text-center">
              <a href="<?= $adminUrl?>doi-tac" class="btn btn-danger btn-xs">Huỷ</a>
              <button type="submit" class="btn btn-primary btn-xs">Cập nhật</button>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
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
      $('#imageTarget').attr('src', "<?= $siteUrl ?>img/default/default.png");
    }else{
      getBase64(file, '#imageTarget');
    }
  }
</script>
</body>
</html>