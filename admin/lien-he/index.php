<?php 
// hien thi danh sach phan hoi cua he thong
session_start();
$path = "../";
require_once $path.$path."commons/utils.php";

checkLogin(USER_ROLES['moderator']);

$sql=" SELECT * FROM `contact`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$contact = $stmt->fetchAll();

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
        <small>Liên Hệ Của Khác Hàng</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $adminUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Liên Hệ</li>
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
                    <th style="width: auto;">Name</th>
                    <th style="width: auto;">Email</th>
                    <th style="width: auto;">Số điện thoại</th>
                    <th style="width: 350px;">Nội dung</th>
                    <th >Khác</th>
                  </tr>
                  <?php foreach ($contact as $p ): ?>
                    <tr>
                      <td><?= $p['name']?></td>
                      <td><?= $p['email']?></td>
                      <td><?= $p['phone']?></td>
                      <td><div style="overflow: scroll;height: 70px;"><?= $p['nd']?></div></td>
                       <td>
                        <a href="javascript:;"
                          linkurl="<?= $adminUrl?>lien-he/remove.php?id=<?= $p['id']?>"
                          class="btn btn-xs btn-danger btn-remove"
                        >
                          <i class="fa fa-trash"></i> Xoá
                        </a>
                        <a href="https://mail.google.com/mail/u/0/#inbox?compose=new"
                        >
                          <button class="btn btn-xs btn-info">Trả lời</button>
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
  $('.btn-remove').on('click', function(){
    var removeUrl = $(this).attr('linkurl');
    // var conf = confirm('Bạn có chắc chắn muốn xoá danh mục này không?');
    // if(conf){
    //  window.location.href = removeUrl;
    // }
    swal({
      title: "Cảnh báo",
      text: "Bạn có chắc chắn muốn xoá liên hệ này không?",
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