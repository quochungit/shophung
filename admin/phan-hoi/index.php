<?php 
// hien thi danh sach phan hoi cua he thong
session_start();
$path = "../";
require_once $path.$path."commons/utils.php";

$pageNumber = isset($_GET['page']) == true ? $_GET['page'] : 1;
$pageSize = 5;
$offset = ($pageNumber-1)*$pageSize;

checkLogin(USER_ROLES['moderator']);
$newCommentQuery = "SELECT c.* , p.product_name
  FROM comments c  JOIN products p 
  ON c.product_id = p.id 
  ORDER BY product_id 
  limit $offset, 10";
  //limit $offset, $pageSize
$stmt = $conn->prepare($newCommentQuery);
$stmt->execute();
$Comment = $stmt->fetchAll();


$sql="select count(*) as total_product from comments ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$countcomment = $stmt->fetch();

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ShopHung| Phản Hồi Khách Hàng</title>

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
        <small>Phản Hồi Của Khác Hàng</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Phản Hồi</li>
      </ol>
    </section>
      <style >
          .img img{
              width: 220px; height: 300px;}
      </style>
    <!-- Main content -->
    <section class="content">
      <div class="row"> 
        <div class="col-xs-12">
          <div class="box">
              <div class="box-body">
                <table class="table table-bordered bo" > 
                  <body>
                  <tr class="bo">
                    <th style="width: 120px;">Email</th>
                    <th style="width: 800px;">Phản Hồi</th>
                    <th style="width: 150px;">Tên Sản Phẩm</th>
                    <th >Khác</th>
                  </tr>
                  <?php foreach ($Comment as $p ): ?>
                    <tr>
                      <td><?= $p['email']?></td>
                      <td><?= $p['content']?></td>
                      <td><?=$p['product_name'] ?></td>
                       <td>
                        <a href="javascript:;"
                          linkurl="<?= $adminUrl?>phan-hoi/remove.php?id=<?= $p['id']?>"
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
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                  <div class="paginate light-theme simple-pagination"></div>
              </div>
          </div>
        </div>
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
    swal('Thêm Comment thành công!');
  <?php
  }
   ?>
  $('.btn-remove').on('click', function(){
    var removeUrl = $(this).attr('linkurl');
    // var conf = confirm('Bạn có chắc chắn muốn xoá danh mục này không?');
    // if(conf){
    //  window.location.href = removeUrl;
    // }
    swal({
      title: "Cảnh báo",
      text: "Bạn có chắc chắn muốn xoá Comment này không?",
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
<script src="<?= $siteUrl?>plugins/simplePagination/jquery.simplePagination.js" type="text/javascript"></script>
 <script type="text/javascript">
     var pageUrl = '<?= $adminUrl. "phan-hoi/index.php?"?>'; 
    $('.paginate').pagination({
          items: <?= $countcomment['total_product']?>,
          currentPage: <?= $pageNumber?>, 
          itemsOnPage: <?= $pageSize?>,
          cssStyle: 'light-theme',
          onPageClick: function(val){
            window.location.href = pageUrl+`page=${val}`;
          }
      }); 
   </script> 
</body>
</html>