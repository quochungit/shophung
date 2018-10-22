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
  <title>ShopHung| Quản lí lideShow</title>

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
        <small>Quản lí lideShow</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quản lí SlideShow</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12" center>
          <form enctype="multipart/form-data" action="<?= $adminUrl ?>slide-show/save-add.php" method="post"  id="vali">
             <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <img id="imageTarget" src="<?= $siteUrl?>img/default/default.png" class="img-responsive" required>
              </div>
            </div>
            <div class="form-group">
              <b>Ảnh</b>
              <input type="file" id="product_image" name="image" class="form-control">
            </div>
            <div class="form-group">
              <b>Thông tin</b>
              <input class="form-control" name="tt" required></input>
            </div>
            <div class="form-group">
               <b>Status</b>
                  <select name="status">
                    <option value="1">Hiển thị</option>
                      <option value="0">Ẩn</option>
                  </select>
            </div>
            <div class="text-center">
              <a href="<?= $adminUrl?>slide-show" class="btn btn-danger btn-xs">Huỷ</a>
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
  <!-- /.content-wrapper -->
  <?php include_once $path.'_share/sidebar.php'; ?>  
<?php include_once $path.'_share/footer.php'; ?>
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
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script>
  $("#vali").validate({
            rules: {
              tt:{
                    required: true,
                },
                 image: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                tt: "Vui lòng nhập thông tin",
                 image: {
                    required: "Vui lòng chọn ảnh",
                   
                }

            }
        });
</script>
</html>