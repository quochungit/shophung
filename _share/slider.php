<?php 
require_once './commons/utils.php';

$sqlSlides = "select * from " . TABLE_SLIDESHOW . "
				where status = 1 
				 order by order_number";

$stmt = $conn->prepare($sqlSlides);
$stmt->execute();

$dataSlides = $stmt->fetchAll();

 ?>

<div id="slideShow">
	<div class="container-fluid">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php 
				for($i = 0; $i < count($dataSlides); $i++){
					$act = $i == 0 ? "active" : "";
				?>					
					<li data-target="#myCarousel" data-slide-to="<?=$i?>" class="<?= $act?>"></li>
				<?php } ?>
			</ol>
			<div class="carousel-inner">
				<?php 
					$count = 0;
				 ?>
				<?php foreach ($dataSlides as $slide): ?>
					<?php
						$active = $count === 0 ? "active" : "";
					?>
					<div class="item <?= $active ?>">
						<img src="<?= $siteUrl . $slide['image']?>">
					</div>
					<?php 
						$count++;
					 ?>
				<?php endforeach ?>
				
			</div>
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>