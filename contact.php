<?php 
require_once './commons/utils.php';
$newBrandsQuery = "	select * 
						from ".TABLE_BRANDS." 
						order by id desc limit 4
						";
$stmt = $conn->prepare($newBrandsQuery);
$stmt->execute();

$newBrands = $stmt->fetchAll();


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Liên Hệ</title>
</head>
<body>
 	 <?php 
   		 include './_share/client_assets.php';
     ?>
     <?php 
    include './_share/header.php';
     ?>
<div id="content">
	<div class="container">
		<div class="col-md-6 left">
            <div style="background: #FFFFCC; border: 1px red solid; height: 50px; margin-top: 10px; position: relative;">
                  <h2 style="position: absolute;left: 10px ; bottom: -1px;" class="title-product">Liện hệ với chúng tôi</h2>               
            </div><br>  
			<form action="submit_contact.php" method="post" id="vali">
				<div>
					<b>Tên khách hàng</b>
					<input  type="text" class="form-control" name="name" required>
				</div>
				<div>
					<b>Email</b>
					<input type="email" class="form-control" name="email" required>
				</div>
				<div>
					<b>Số điện thoại</b>
					<input type="tel" class="form-control" name="phone" required>
				</div>
				 <div>
                    <b>Nội Dung</b>
                    <textarea class="content-sub" name="nd" required></textarea>
                </div>
				<br>
				<button type="submit" value="upload" style="width: 200px; height: 50px; font-size: 25px; background: #66FFCC; color: #C0c">Gửi</button>
				<button style="width: 70px; height: 50px;background: #66FFCC; font-size: 25px"><a href="index.php">Back</a></button>
			</form>
			<style type="text/css">
				button a{color:#C0c }
				label{
					height: auto; background: #FFCCCC; color: black; border: 1px red solid; width: auto; margin-top: 10px;

					}
			</style>
		</div>
		<div class="col-md-6 right">
                <div style="background: #FFFFCC; border: 1px red solid; height: 50px; margin-top: 10px; position: relative;">
                  <h2 style="position: absolute;left: 10px ; bottom: -1px;" class="title-product">Địa chỉ của chúng tôi</h2>               
                 </div><br> 
               <iframe style="margin-top: 10px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8276297077555!2d105.80170781486915!3d21.039581885992526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab3e6416efc7%3A0x808741175914b86b!2zMTUgxJDDtG5nIFF1YW4sIFF1YW4gSG9hLCBD4bqndSBHaeG6pXksIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1537678713724" width="100%" height="430" frameborder="0" style="border:0" allowfullscreen></iframe>
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
</div>
 <?php 
    include './_share/footer.php';
     ?>
</body>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script>
	$("#vali").validate({
            rules: {
            	phone:{
                    required: true,
                    minlength: 10
                },
                name: "required",
                email: {
                    required: true,
                    minlength: 1
                },
                nd: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
            	phone: {
                            required: "Vui lòng nhập số điện thoại",
                            minlength: "Mời nhập SĐT, ít nhất 10 chữ số"
                        },
                name: "Vui lòng nhập tên",
                email:{
                    required: "Vui lòng nhập email",
                   
                },	
                nd: {
                    required: "Vui lòng nhập nội dung",
                    minlength: "Nội dung ngắn vậy?"
                }
            }
        });
</script>
</html>