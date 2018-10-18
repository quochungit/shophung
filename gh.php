	<?php 
    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart']= [];
    }

    if (isset($_POST['btn_add'])) {
		$id_product = $_POST['id_pd'];
        $img_product = $_POST['img_pd'];
        $name_product = $_POST['name_pd'];
        $price_product = $_POST['price_pd'];
        $_SESSION['cart'][$id_product]=['nameproduct' => $name_product, 'priceproduct'=> $price_product, 'imgproduct'=>$img_product];
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>GIỎ HÀNG</title>
</head>
<body>
<div id="wp">
	<div id="header">
		<img src="img/logo.jpg" width="500px">
	</div>
	<div id="menu">
		<ul>
			<li><a href="index.php">Trang chủ</a></li>
		</ul>
		<div id="cart">
			<a href="gh.php"><img src="img/mua.png"/></a>
		</div>
	</div>
	<div id="content">
		<div class="boxcart">
			<table>
				<tr>
					<td style="width:200px">Tên sản phẩm</td>
					<td style="width:150px">Ảnh sản phẩm</td>
					<td style="width:100px">Giá</td>
					<td style="width:50px"></td>
				</tr>
				<?php include './_share/client_assets.php';
					foreach ($_SESSION['cart'] as $key => $row) {
					?>
				<tr>
					<td><?php echo $row['nameproduct']?></td>
					<td><img src="img/<?php echo $row['imgproduct']?>"/></td>
					<td><?php echo $row['priceproduct'] ?></td>
					<td>
					<form action="get">	
					<a href="del_cart.php?product_id=<?php echo $key?>"><img src="img/del.jpg" style="width:28px; height: 28px"/></a></td>
					</form>
				</tr>
				<?php }?>
			</table>
		</div>
		<div class="khachang">
			<p class="danhmuc">THÔNG TIN KHÁCH HÀNG</p>
			<form method="POST" action="giohang.php">
				<p>Tên khách hàng</p> <input type="text" name="tenkh">
				<p>Email</p> <input type="text" name="emailkh">
				<p>Số điện thoại</p> <input type="text" name="sdtkh">
				<p>Địa chỉ nhận hàng</p> <textarea rows="5" name="diachikh"></textarea>
				<p>Ghi chú</p> <textarea rows="5" name="ghichu"></textarea><br>
				<input type="submit" name="btn_gui" value="THANH TOÁN">
			</form>
		</div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<style type="text/css">
	*{margin: 0; padding: 0; box-sizing: border-box;}
#wp{width: 980px; margin: auto;font-family: Tahoma}
#header{width: 980px; height: 160px; background: #000;text-align: center; padding-top: 40px}
#menu{height: 40px; background: #bf6533}
#menu ul li{float: left; list-style: none; line-height: 40px; font-size: 14px; padding: 0 20px;}
#menu ul li a{color: #fff; text-decoration: none}
#cart{color: #FFF; font-size: 12px}
#cart span{position: relative; top:-20px; left: -10px; background: #000; border-radius: 50%; padding: 5px }
#menu img{width: 40px; height: 40px;}
#content{border:1px solid #cdcdcd; padding: 20px; overflow: auto;}
#footer{height: 50px; background: #000; clear: both; color: #FFF; text-align: center;line-height: 50px; font-size: 15px}
.sp{width: 200px; height: 350px; border: 1px solid #cdcdcd; float: left; padding: 5px; margin:10px 30px 10px 0; text-align: center;  }
.sp img{ margin-right: 5px; width: 140px; height: auto; margin-top:20px  }
.td{font-weight: bold; font-size: 15px; margin-top: 20px}
.td a{color: #bf6533; text-decoration: none}
.td a:hover{text-decoration: underline;}
#anhtin{text-align: center; margin: 20px}
#anhtin img{ width: 500px}
.gia{ margin-top: 20px; font-size: 20px; color: #F00}
.danhmuc{font-size: 18px; margin:20px 0; font-weight: bold;}
#qc{text-align: center;}
.sp input{height: 40px; width: 100px; margin: 10px 0; background: #000; color: #FFF}
/*css gio hang*/
.boxcart{width: 67%;float: left; border:1px solid #cdcdcd; padding: 20px; overflow: auto; margin-right: 3%}
.khachang{width: 30%;float: left; border:1px solid #cdcdcd; padding: 20px; overflow: auto;}
.boxcart img{width: 150px; height: auto}
.boxcart input{width: 50px}
table tr td{text-align: center; border: 1px solid #cdcdcd}
.tongtien{margin-top:30px; font-weight: bold; }
.tongtien span{color:#F00;}
.khachang input{width: 100%; height: 30px; margin: 10px 0}
.khachang textarea{width: 100%; margin: 10px 0}


</style>