<?php 
session_start();

// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";

checkLogin();
$id = $_GET['id'];
$sql = "select * from " . TABLE_WEBSETTING . " where id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$web_settings = $stmt->fetch();

if(!$web_settings){
  header('location: ' . $adminUrl . 'thong-tin/index.php');
}
 
 
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ShopHung | Thông tin</title>

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
        <small>Thông tin</small>

      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Thông tin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <form action="<?= $adminUrl ?>thong-tin/save-edit.php" method="post" enctype="multipart/form-data">

        <div class="col-md-6">
            <h2>Thay đổi thông tin</h2>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="old_filename" value="<?= $web_settings['logo'] ?>">
            <br>
            <div class="form-group">
              <label>Hot Line</label>
              <input type="text" name="hotline" class="form-control" value="<?= $web_settings['hotline']?>">
            </div>
                    <span>
                <!-- /.error -->
              <i>
                <?php 
              if(isset($_GET['errName']) && $_GET['errName'] != ""){
               ?>
               <span class="text-danger">( Cảnh báo: <?= $_GET['errName'] ?>)</span>
              <?php } 
              ?>
              </i>
              </span>
            <!-- Danh mục -->
            <div class="form-group">
                <label>Email</label>
                  <input type="text" name="email" class="form-control" value="<?= $web_settings['email']?>"
            </div>

            <!-- Mô tả -->
           
            <div class="form-group">
              <label>Facebook</label>
              <input type="text" name="fb" class="form-control" value="<?= $web_settings['fb']?>">
            </div>
                  
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-offset-3">

              <img  id="imageTarget" width="70%" src="<?= $siteUrl . $web_settings['logo'] ?> " class="img-reponsive">
              
            </div>

          </div>
          <div class="form-group">
            <label>Logo</label>
            <input id="web_settings_image" type="file" name="image" class="form-control">
          </div>
        </div>

        <div class="col-md-12">
           <div class="form-group">
              <label>Mô tả</label>
              <textarea class="form-control" name="map" rows="8">
                <?= $web_settings['map']?>
                  
                </textarea>
            </div>
        </div>
        <div class="col-md-12">
          <div class="text-center">
              <a href="<?= $adminUrl?>thong-tin/index.php" class="btn btn-danger btn-xs">Huỷ</a>
              <button type="submit" class="btn btn-primary btn-xs">Tạo mới</button>
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
  })


  function getBase64(file, selector) {
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function () {
      $(selector).attr('src', reader.result);
       // return reader.result;
     };
     reader.onerror = function (error) {
       console.log('Error: ', error);
     };
  }

  var img = document.querySelector('#web_settings_image');
  img.onchange = function(){
    var file = this.files[0];
    if (file == undefined) {
      $('#imageTarget').attr('src', "<?= $siteUrl . $web_settings['logo'] ?>" )
    }
    getBase64(file, '#imageTarget');
  }
</script>
</body>
</html>
