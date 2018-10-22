<?php 
// hien thi danh sach danh muc cua he thong
session_start();
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['moderator']);
// dem ton so record trong bang danh muc
$sql = "select 
           c.*
    from  ". TABLE_CATEGORY ." c";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cates = $stmt->fetchAll();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ShopHung | Quản lý sản phẩm</title>

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
        <small>Quản lý sản phẩm</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sản phẩm</li>
      </ol>
    </section>
    <style type="text/css">
      label{
          height: auto; background: #FFCCCC; color: black; border: 1px red solid; width: auto; margin-top: 10px;
}
    </style>
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <form enctype="multipart/form-data" action="<?= $adminUrl?>/san-pham/save-add.php" method="post" id="demoForm">
          <div class="col-md-6">
            <div class="form-group">
              <b>Tên sản phẩm</b>
              <input type="text" name="product_name" class="form-control">
              <?php 
              if(isset($_GET['errName']) && $_GET['errName'] != ""){
               ?>
               <span class="text-danger"><?= $_GET['errName'] ?></span>
              <?php } 
              ?>
            </div>
            <div class="form-group">
              <b>Danh mục</b>
              <select name="cate_id" class="form-control">
                <?php foreach ($cates as $c): ?>
                  <option value="<?= $c['id']?>" ><?= $c['name']?></option>
                <?php endforeach ?>
                <option selected value="none"></option>
              </select>
            </div>
            <div class="form-group">
              <b>Giá bán</b>
              <input type="text" name="list_price" class="form-control" required>
            </div>
            <div class="form-group">
              <b>Giá khuyến mại</b>
              <input type="text" name="sell_price" class="form-control" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <img id="imageTarget" src="<?= $siteUrl?>img/default/default.png" class="img-responsive" required>
              </div>
            </div>
            <div class="form-group">
              <b>Ảnh sản phẩm</b>
              <input type="file" id="product_image" name="image" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <b>Mô tả</b>
              <textarea id="editor" rows="5" class="form-control" name="detail"></textarea>
            </div>
          </div>
          <div class="col-md-12 text-left">
            <a href="<?= $adminUrl?>san-pham" class="btn  btn-danger">Huỷ</a>
            <button type="submit" class="btn btn-primary">Lưu</button>
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
      $('#imageTarget').attr('src', "<?= $siteUrl ?>img/default/default.png");
    }else{
      getBase64(file, '#imageTarget');
    }
  }
</script>
</body>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $().ready(function() {
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
        }, "Value must not equal arg.");
        $("#demoForm").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "product_name": {
                    required: true,
                },
                "list_price": {
                    required: true,
                    number: true
                },
                "sell_price": {
                    number: true
                },
                "cate_id": {
                    valueNotEquals: "none",
                }
            },
            messages: {
                "product_name": {
                    required: "<p class='mb-0' style='color: red;'>Nhập Tên Sản Phẩm</p>"
                },
                "list_price": {
                    required: "<p class='mb-0' style='color: red;'>Nhập giá...</p>",
                    number: "<p class='mb-0' style='color: red;'>Nhập số</p>"
                },
                "sell_price":{
                    required: "<p class='mb-0' style='color: red;'>Nhập giá khuyến mãi</p>",
                    number: "<p class='mb-0' style='color: red;'>Nhập số</p>"
                },
                "cate_id":{
                    valueNotEquals: "<p class='mb-0' style='color: red;'>Chọn danh mục</p>"
                }
            }
        });
    });
    <?php
    if(isset($_GET['err']) && $_GET['err'] != null){
    ?>
    swal('<?= $_GET['err']?>');
    <?php }
    ?>
</script>
</html>