<?php 
require_once './commons/utils.php';
$id = $_GET['id'];

// 1. Kiem tra xem id danh muc co thuc su ton tai khong
$sql = "select 
				c.*,
				(select count(*) from products where cate_id = $id) as total_product
		from ".TABLE_CATEGORY." c
		where id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetch();
if(!$cate){
	header("location: $siteUrl" . "index.php");
	die;
}

$pageNumber = isset($_GET['page']) == true ? $_GET['page'] : 1;
$pageSize = 6;
$offset = ($pageNumber-1)*$pageSize;

// 2. lay danh sach san pham thuoc danh muc
$sql = "select * from " . TABLE_PRODUCT 
		. " where cate_id = $id limit $offset, $pageSize";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();

// lay du lieu tu csdl bang doi tac
$newBrandsQuery = "	select * 
						from ".TABLE_BRANDS." 
						order by id desc limit 4
						";
$stmt = $conn->prepare($newBrandsQuery);
$stmt->execute();

$newBrands = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php 
	include './_share/client_assets.php';
	 ?>
	<title>Danh mục <?= $cate['name']?></title>
	<link rel="stylesheet" type="text/css" href="plugins/simplePagination/simplePagination.css">
  <script src="plugins/simplePagination/jquery.simplePagination.js" type="text/javascript"></script>
</head>

<body>
	<?php 
	include './_share/header.php';
	 ?>
	<div id="product">
		<div class="container">
			<div class="tittle-product">
				<div class="hh">
					<h2 style="position: absolute; top: -13px; left: 10px; color: #333">Danh mục: <?= $cate['name']?></h2>
				</div>
			</div>
			<style type="text/css"> .hh{width: 100%; height: 50px; background: #FFFFCC; border: 1px red solid; margin-bottom: 10px; position: relative; margin-top: 10px;}</style>
			<div class="row">
				<?php foreach ($products as $np): ?>
					<div class="col-sm-4 col-xs-12">
						<div class="img-height">
							<a href="<?= $siteUrl?>chitiet.php?id=<?=$np['id']?>"><img src="<?= $siteUrl . $np['image']?>" alt=""></a>
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
						<div class="footer-product" style="margin-left: 50px; margin-bottom: 30px;">
							<a href="<?= $siteUrl?>chitiet.php?id=<?=$np['id']?>" class="details">Xem chi tiết</a>
						</div>
					</div>
				<?php endforeach ?>

			</div>
			<div class="row">
				<div class="paginate"></div>
			</div>
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
	<script type="text/javascript">
	 	var pageUrl = '<?= $siteUrl. "danhmuc.php?id=" . $id?>';
	 	$('.paginate').pagination({
	        items: <?=$cate['total_product']?>,
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
