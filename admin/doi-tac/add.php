<?php 
session_start();
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['moderator']);
// dem ton so record trong bang danh muc

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ShopHung| Quản lí Đối tác</title>

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
        <small>Quản lí Đối tác</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quản lí Đối tác</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <form enctype="multipart/form-data" method="post" action="<?= $adminUrl ?>doi-tac/save-add.php" id="vali">
         <div class="col-md-9">
             <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <img id="imageTarget" src="<?= $siteUrl?>img/default/default.png" class="img-responsive" required>
              </div>
            </div>
            <div class="form-group">
              <b>Ảnh đối tác</b>
              <input type="file" id="brand_image" name="image" class="form-control">
            </div>
          </div>
        <div class="col-md-9" center>
             <div class="form-group">
              <b>Tên Đối Tác</b>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="text-center">
              <a href="<?= $adminUrl?>doi-tac" class="btn btn-danger btn-xs">Huỷ</a>
              <button type="submit" class="btn btn-primary btn-xs" value="upload">Tạo mới</button>
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
  var img = document.querySelector('#brand_image');
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
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script>
  $("#vali").validate({
            rules: {
                name: "required",
                image: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                name: "Vui lòng nhập tên",
 
                image: {
                    required: "Vui lòng chọn ảnh",

                }
            }
        });
</script>
</html>