<?php 
// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";
session_start();
// dem ton so record trong bang danh muc
$id = $_GET['id'];
$sql = "select * from slideshows where id='$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$slideshows = $stmt->fetch();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Shop Hung | Sửa thông tin SlideShow</title>

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
        <small>Sửa thông tin SlideShow</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sửa thông tin SlideShow</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <form enctype="multipart/form-data" action="<?= $adminUrl?>slide-show/save-edit.php" method="post">
          <input type="hidden" value="<?= $slideshows['id']?>" name="id">
          <input type="hidden" name="old_filename" value="<?= $slideshows['image']?>">
          <div class="col-md-6">
             <div class="form-group">
              <label>Thông tin</label>
              <input type="text" name="tt" class="form-control" value="<?= $slideshows['tt']?>">
            </div>
            <div class="form-group">
              <label>Trạng thái</label>
                  <select name="status">
                    <option value="1">Hiển thị</option>
                      <option value="0">Ẩn</option>
                  </select>
               
            </div>
            
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12 col-md-offset-0">
                <img id="imageTarget" src="<?= $siteUrl?>/<?= $slideshows['image'] ?>" class="img-responsive" >
              </div>
            </div>
            <div class="form-group">
              <label>Ảnh</label>
              <input type="file" id="product_image" name="image" class="form-control" style="max-width: 640px;">
            </div>
          </div>
          
          <div class="col-md-6 text-right">
            <a href="<?= $adminUrl?>slide-show" class="btn btn-danger">Huỷ</a>
            <button type="submit" class="btn  btn-primary">Lưu</button>
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
      $('#imageTarget').attr('src', "<?= $siteUrl ?>$slideshow['image']");
    }else{
      getBase64(file, '#imageTarget');
    }
  }
</script>

</body>
</html>