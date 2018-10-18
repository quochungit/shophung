<?php
session_start();
$path = "../";
require_once $path.$path."commons/utils.php";
checkLogin(USER_ROLES['moderator']);
//lay san pham
$sql="select count(*) as total_product from products ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$countproduct = $stmt->fetch();

$pageNumber = isset($_GET['page']) == true ? $_GET['page'] : 1;
$pageSize = 4;
$offset = ($pageNumber-1)*$pageSize;

$newProductsQuery = "select 
      p.*,
      c.`name` as cate_name 
    from categories c
    join products p
      on c.id = p.cate_id
    group by p.id limit $offset, $pageSize";
$stmt = $conn->prepare($newProductsQuery);
$stmt->execute();

$newProducts = $stmt->fetchAll();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ShopHung| Quản lý Sản Phẩm</title>

  

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
        <li><a href="<?= $adminUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sản Phẩm</li>
      </ol>
      <style > 
          .img img{ 
           width: 220px; height: 300px;}
      </style>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-body">
                <table class="table table-bordered bo" > 
                  <body>
                  <tr class="bo">
                    <th style="width: 10px;">Id</th>
                    <th style="width: auto;">Tên Sản phẩm</th>
                    <th style="width: auto;">Danh Mục</th>
                    <th style="width: auto;">Giá</th>
                    <th style="width: auto;">Giá khuyến mãi</th>
                    <th style="width: auto;">Ảnh sản phẩm</th>
                    <th style="width: auto;">Mô tả</th>
                    <th style="width: auto;">Lượt xem</th>
                    <th >
                        <a href="<?= $adminUrl?>san-pham/add.php"
                           class="btn btn-xs btn-success"
                        >
                            <i class="fa fa-plus"></i> Thêm mới
                        </a>
                    </th>
                  </tr>
                  <?php foreach ($newProducts as $p ): ?>
                    
                    <tr>
                      <td><?= $p['id']?></td>
                      <td><?= $p['product_name']?></td>
                      <td><?= $p['cate_name']?></td>
                      <td>
                        <?= $p['list_price']?>
                      </td>
                      <td>
                        <?= $p['sell_price']?>
                      </td>
                      <td class="img"><img src="  <?= $siteUrl.$p['image'] ?>"></td>
                      <td><div style="overflow: scroll;height: auto;"><?= $p['detail']?></div></td>
                      <td><?= $p['views']?></td>
                      <td>
                        <br>
                        <a href="<?= $adminUrl?>san-pham/edit.php?id=<?= $p['id']?>"
                        class="btn btn-xs btn-info"
                        >
                          <i class="fa fa-pencil"></i> Cập nhật
                        </a>
                          <a href="javascript:;"
                             linkurl="<?= $adminUrl?>san-pham/remove.php?id=<?= $p['id']?>"
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
        
    </section>
      </div>

    </section>
    <!-- /.content -->
    <?php include_once $path.'_share/footer.php'; ?>
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
    swal('Thêm sản phẩm thành công!');
    <?php
    }
    ?>
    $('.btn-remove').on('click', function(){
        var removeUrl = $(this).attr('linkurl');
        // var conf = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?');
        // if(conf){
        //  window.location.href = removeUrl;
        // }
        swal({
            title: "Cảnh báo",
            text: "Bạn có chắc chắn muốn xoá sản phẩm này không?",
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
     var pageUrl = '<?= $adminUrl. "san-pham/index.php?"?>'; 
    $('.paginate').pagination({
          items: <?= $countproduct['total_product']?>,
          currentPage: <?= $pageNumber?>, 
          itemsOnPage: <?= $pageSize?>,
          cssStyle: 'light-theme',
          onPageClick: function(val){
            window.location.href = pageUrl+`&page=${val}`;
          }
      }); 
   </script> 


</body>
</html>