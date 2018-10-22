<?php 
require_once './commons/utils.php';

$sqlSlides = "select * from " . TABLE_BRANDS . "
				 
				 ";

$stmt = $conn->prepare($sqlSlides);
$stmt->execute();

$dataSlides = $stmt->fetchAll();

 ?>

<div id="brand">
	<div class="container-fluid">
		<div id="mybrand" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php 
				for($i = 0; $i < count($dataSlides); $i++){
					$act = $i == 0 ? "active" : "";
				?>					
					<li data-target="#mybrand" data-slide-to="<?=$i?>" class="<?= $act?>"></li>
				<?php } ?>
			</ol>
			<div class="carousel-inner ccc" >
				<?php 
					$count = 0;
				 ?>
				<?php foreach ($dataSlides as $slide): ?>
					<?php
						$active = $count === 0 ? "active" : "";
					?>
					<div class="item <?= $active ?>">
						<div class="cc"><img src="<?= $siteUrl . $slide['image']?>"></div>
					</div>
					<?php 
						$count++;
					 ?>
				<?php endforeach ?>
				
			</div>
			<a class="left carousel-control ccc" href="#mybrand" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control ccc" href="#mybrand" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>
<style type="text/css">
	.cc img{
		width: 300px; height: 300px;
	}
	.ccc{ height: 300px;
		}
</style>