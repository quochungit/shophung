<?php 
require_once './commons/utils.php';
$mostViewsQuery = " select * 
                        from ".TABLE_PRODUCT."  
                        order by views desc
                        limit 4";
$stmt = $conn->prepare($mostViewsQuery);
$stmt->execute();

$mostViewsProducts = $stmt->fetchAll();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    include './_share/client_assets.php';
     ?>
    <title>Giới thiệu</title>
</head>

<body>
    <?php 
    include './_share/header.php';
     ?>
    <div id="content">
        <div class="container">
            <div class="col-md-8 col-sm-6 col-xs-12">
               <h3>TRANG CHỦ SHOPHUNG - WEBSITE CUNG CẤP QUẦN ÁO BÓNG ĐÁ UY TÍN</h3>
    </section>
</section>
<section class="b4">
        <p>Chào mừng quý khách đến với Shophung.VN, website mua sắm trang phục thể thao online hàng đầu tại Việt Nam. Shophung.vn là website chuyên cung cấp các mặt hàng quần áo bóng đá và dịch vụ in ấn quần áo bóng đá.</p>
        <img src="./img/nd.jpg" width="1000"><br>
</section>
<section class="nd1">
     <span class="chu1"><br>    ShopHung là đơn vị kinh doanh trong lĩnh vực may mặc quần áo thể thao, chúng tôi chuyên sỉ lẻ quần áo bóng đá trên toàn quốc với nhiều mẫu mã đa dạng. Hiện nay, ShopHung có cơ sở may tại Thành Phố Nam Định, với thế mạnh về nguồn nhân lực nhiều năm kinh nghiệm trong lĩnh lực may mặc quần áo thể thao, được phân phối trên toàn quốc. ShopHung tự tin là nhà cung cấp quần áo thể thao với buôn sỉ tốt nhất trên thị trường hiện nay.</span> 
</section>
<section class="nd2" style="margin-top: 15px">
    <center><img src="./img/nd2.jpg" width="1000"></center>
    <br><p>Trong lĩnh vực kinh doanh, việc lựa chọn cho mình nguồn hàng uy tín để kinh doanh lâu dài là một việc vô cùng quan trọng. Nó ảnh hưởng đến toàn bộ chiến lực kinh doanh và sự thành công của bạn sau này. Do đó, bạn nên dành nhiều thời gian tìm kiếm các thông tin về xưởng may bỏ sỉ uy tín để hạn chế tối thiểu các rủi ro. Đồng thời, bạn cần phải rút kinh nghiệm qua những lần nhập hàng để hạn chế lượng hàng tồn kho, tránh tình trạng tồn đọng vốn, và ‘tăng’ số vòng thu hồi vốn.<br><br>
Thực chất nếu là người chưa có kinh nghiệm về chọn mua quần áo, bạn sẽ rất khó để tìm thấy lời khuyên đích thực, hay một địa chỉ tin cậy từ những người cũng đang có cùng mặt hàng kinh doanh giống mình, vì đó là “cần câu cơm” của họ nên chẳng ai dại mà đi chia sẻ với đối thủ của mình. Còn nếu bạn chân ướt chân ráo tìm đến những chợ đầu mối lớn sẽ rất dễ bị người ta hét với cái giá trên trời không thấp hơn so với việc mua lẻ là mấy. Chúng tôi nhà cung cấp trang phục thể thao hiện đang cung cấp hàng trăm mẫu quần áo bóng đá đến tất cả cửa hàng trên toàn quốc là lựa chọn uy tín dành cho bạn. Với mong muốn mang đến những sản phẩm may mặc hàng Việt Nam chất lượng và đặc biệt là lấy cảm hứng từ nhu cầu thực tế của người tiêu dùng Việt Nam, Bulbal cho ra những mẫu sản phẩm vừa độc đáo vừa phù hợp với xu hướng thời trang.
<br><br>Website mua bán quần áo thể thao online uy tín, chất lượng. Đặc biệt dịch vụ giao hàng hóa nhanh trong ngày. Shop giao hàng và thu tiền tận nơi trên toàn quốc, hỗ trợ đổi trả miễn phí trong 7 ngày.
<img <img src="./img/HT.jpg" width="1000">
<br><br>
Nếu bạn đang quan tâm đến những mẫu quần áo thể thao để nhập về bán sỉ hoặc bán lẻ vui lòng liên hệ với chúng tôi để nhận được tư vấn về chính sách phân phối hấp dẫn dành cho các Đại Lý - Cộng tác viên và chọn mẫu ưng ý, dễ bán.
</p>
</section>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12" >
                 <h2>Các Sản Phẩm Mới</h2>
                <?php foreach ($mostViewsProducts as $np): ?>
                    <div class="img-height">
                        <a href="<?= $siteUrl?>chitiet.php?id=<?=$np['id']?>"><img src="<?= $siteUrl . $np['image']?>" alt=""></a>
                        <div class="footer-product">
                            <a href="<?= $siteUrl?>chitiet.php?id=<?=$np['id']?>" class="details"" class="details">Xem chi tiết</a>
                            <a href="#" class="buying">Mua hàng</a>
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
            <?php endforeach ?>

            </div>
        </div>
    </div>
    <div id="partner">
        <div class="container">
            <div class="tt">
                <h2 class="title-product">Các đối tác</h2>
            </div>
            
            <div class="partner-img col-md-3 col-xs-6">
                <img src="img/just.png" alt="">
            </div>
            <div class="partner-img col-md-3 col-xs-6">
                <img src="img/35.jpg" alt="">
            </div>
            <div class="partner-img col-md-3 col-xs-6">
                <img src="img/37.jpg" alt="">
            </div>
            <div class="partner-img col-md-3 col-xs-6">
                <img src="img/36.png" alt="">
            </div>
        </div>
    </div>
    <?php 
    include './_share/footer.php';
     ?>
</body>

</html>