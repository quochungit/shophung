<?php 
// // tao ket noi den csdl
require_once './commons/utils.php';

$pageNumber = isset($_GET['page']) == true ? $_GET['page'] : 1;
$pageSize = 5;
$offset = ($pageNumber-1)*$pageSize;


$newProductsQuery = "	select * 
						from ".TABLE_PRODUCT." 
						order by id desc 
						limit $offset, 6";
$stmt = $conn->prepare($newProductsQuery);
$stmt->execute();

$newProducts = $stmt->fetchAll();

// lay du lieu tu csdl bang products cho sp xem nhieu nhat
$mostViewsQuery = "	select * 
						from ".TABLE_PRODUCT."  
						order by views desc
						limit 6";
$stmt = $conn->prepare($mostViewsQuery);
$stmt->execute();

$mostViewsProducts = $stmt->fetchAll();
// lay du lieu tu csdl bang doi tac
// $newBrandsQuery = "	select * 
// 						from ".TABLE_BRANDS." 
// 						order by id desc limit 4
// 						";
// $stmt = $conn->prepare($newBrandsQuery);
// $stmt->execute();

// $newBrands = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="plugins/simplePagination/simplePagination.css">
<head>
	<?php 
	include './_share/client_assets.php';
	 ?>

	<title>Trang chủ</title>
</head>

<body>
	<?php 
	include './_share/header.php';
	 ?>
	<?php 

	include './_share/slider.php';
	 ?>
	<div id="product">
		<div class="container">
			<div class="tittle-product">
				<div class="tt">
					<h2 style="float: left;">Sản phẩm mới</h2>
				</div>
			</div>
			<?php foreach ($newProducts as $np): ?>
				<div class="col-sm-4 col-xs-12">
					<div class="img-height">
						<a href="<?= $siteUrl?>chitiet.php?id=<?=$np['id']?>"><img src="<?= $siteUrl . $np['image']?>" alt=""></a>
						<div class="footer-product">							
							<a href="<?= $siteUrl?>chitiet.php?id=<?=$np['id']?>" class="details"" class="details">Xem chi tiết</a>
							<a href="addcart.php?id=<?=$np['id']?>" class="buying">Mua hàng</a>
						</div>
					</div>
					<div id="namesp">
						<a class="title-name" href="<?= $siteUrl?>chitiet.php?id=<?=$np['id']?>"><?= $np['product_name']?></a>
					</div>
					<div class="text-center">
						Giá bán <a class="">
							<strike>
								<?= $np['list_price']?>Đ
							</strike>
							</a>
						<br>
						Giá khuyến mại <a class=""><?= $np['sell_price']?>Đ</a>
					</div>
				</div>
			<?php endforeach ?>
		</div>
		<div class="box-footer clearfix">
            <div class="paginate light-theme simple-pagination">
            </div>
        </div>
	</div>
	<div id="hot-product">
		<div class="container">
			<div class="tittle-product">
				<div class="tt">
					<h2>Sản phẩm bán chạy</h2>
				</div>
			</div>
			<style type="text/css"> .tt1{width: 100%;}</style>
			<?php foreach ($mostViewsProducts as $np): ?>
				<div class="col-sm-4 col-xs-12">
					<div class="img-height">
						<a href="<?= $siteUrl?>chitiet.php?id=<?=$np['id']?>"><img src="<?= $siteUrl . $np['image']?>" alt=""></a>
						<div class="footer-product">							
							<a href="<?= $siteUrl?>chitiet.php?id=<?=$np['id']?>" class="details"" class="details">Xem chi tiết</a>
							<a href="addcart.php?id=<?=$np['id']?>" class="buying">Mua hàng</a>
						</div>
					</div>
					<a class="title-name"><?= $np['product_name']?></a>
					<div class="text-center">
						Giá bán <a class="">
							<strike>
								<?= $np['list_price']?>Đ
							</strike>
							</a>
						<br>
						Giá khuyến mại <a class=""><?= $np['sell_price']?>Đ</a>
					</div>
				</div>
			<?php endforeach ?>
		</div>
			<div class="box-footer clearfix">
                  <div class="paginate light-theme simple-pagination"></div>
       		</div>
	</div>
	<div id="partner">
    <div class="container">
      <div class="tt">
        <h2 class="title-product">Các đối tác</h2>
      </div>
      <?php 
        include './_share/brand.php';
       ?>
    </div>
  </div><br>
	<?php 
	include './_share/footer.php';
	 ?>
</body>
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
</html>