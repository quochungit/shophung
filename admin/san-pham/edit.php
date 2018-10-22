<?php 
session_start();

// hien thi danh sach danh muc cua he thong
$path = "../";
require_once $path.$path."commons/utils.php";

checkLogin();
$productId = $_GET['id'];
$sql = "select * from " . TABLE_PRODUCT. " where id = $productId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$product = $stmt->fetch();
$sql = "select 
      c.id, c.name,
      (select count(*) from ".TABLE_PRODUCT." where cate_id = c.id) as totalProduct
    from ".TABLE_CATEGORY." c";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetchAll();
if(!$product){
  header('location: ' . $adminUrl . 'san-pham');
}

 
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ShopHung | Sửa thông tin sản phẩm</title>

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
        <small>Sửa thông tin sản phẩm</small>

      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quản lí sản phẩm</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <form action="<?= $adminUrl ?>san-pham/save-edit.php" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
            <!-- Tên sản phẩm -->
            <input type="hidden" name="id" value="<?= $productId ?>">
            <input type="hidden" name="old_filename" value="<?= $product['image'] ?>">
            <br>
            <div class="form-group">
              <b>Tên sản phẩm</b>
              <input type="text" name="product_name" class="form-control" value="<?= $product['product_name']?>">
            </div>
                <!-- /.error -->
              <span>
              <i>
                <?php 
              if(isset($_GET['errName']) && $_GET['errName'] != ""){
               ?>
               <label class="text-danger"> <?= $_GET['errName'] ?></span>
              <?php } 
              ?>
              </i>
              </span>
              <style type="text/css">
                label{
                  height: auto; background: #FFCCCC; color: black; border: 1px red solid; width: auto; margin-top: 10px;

                  }
      </style>
            <!-- Danh mục -->
            <div class="form-group">
                <b>Danh mục</b>
                  <select name="cate_id" class="form-control">
                    <option>---</option>
                    <?php foreach ($cate as $c) : ?>
                      <?php $selected = $c['id'] === $product['cate_id'] ? "selected" : "" ?>
                    <option <?= $selected ?> value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                    <?php endforeach ?>
                  </select>
            </div>

            <!-- Mô tả -->
           
            <div class="form-group">
              <b>Giá</b>
              <input type="text" name="list_price" class="form-control" value="<?= $product['list_price']?>">
            </div>
            <span>
              <i>
                <?php 
              if(isset($_GET['list_price']) && $_GET['list_price'] != ""){
               ?>
               <label class="text-danger"> <?= $_GET['list_price'] ?></span>
              <?php } 
              ?>
              </i>
              </span>
            <div class="form-group">
              <b>Giá KM</b>
              <input type="text" name="sell_price" class="form-control" value="<?= $product['sell_price']?>">
              <span>
              <i>
                <?php 
              if(isset($_GET['sell_price']) && $_GET['sell_price'] != ""){
               ?>
               <label class="text-danger"> <?= $_GET['sell_price'] ?></span>
              <?php } 
              ?>
              </i>
              </span>
            </div>       
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-offset-3">

              <img  id="imageTarget" width="70%" src="<?= $siteUrl . $product['image'] ?> " class="img-reponsive">
              
            </div>

          </div>
          <div class="form-group">
            <b>Ảnh sản phẩm</b>
            <input id="product_image" type="file" name="image" class="form-control">
          </div>
        </div>

        <div class="col-md-12">
           <div class="form-group">
              <b>Mô tả</b>
              <textarea id="editor" class="form-control" name="detail" rows="8">
                <?= $product['detail']?>
                  
                </textarea>
            </div>
        </div>
        <div class="col-md-12">
          <div class="text-center">
              <a href="<?= $adminUrl?>san-pham" class="btn btn-danger btn-xs">Huỷ</a>
              <button type="submit" class="btn btn-primary btn-xs">Thay đổi</button>
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

  var img = document.querySelector('#product_image');
  img.onchange = function(){
    var file = this.files[0];
    if (file == undefined) {
      $('#imageTarget').attr('src', "<?= $siteUrl ?>/img/default/image.png" )
    }
    getBase64(file, '#imageTarget');
  }







</script>
</body>
</html>
