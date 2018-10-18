<?php 
require_once $path.'../commons/utils.php';
 ?>
<header class="main-header">
	<!-- Logo -->
	<a href="<?= $adminUrl ?>" class="logo">
	  <!-- mini logo for sidebar mini 50x50 pixels -->
	  <span class="logo-mini"><b>S</b>H</span>
	  <!-- logo for regular state and mobile devices -->
	  <span class="logo-lg"><b>SHOP</b>HUNG</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
	  <!-- Sidebar toggle button-->
	  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
	    <span class="sr-only">Toggle navigation</span>
	  </a>

	  <div class="navbar-custom-menu">
	    <ul class="nav navbar-nav">
	      <!-- User Account: style can be found in dropdown.less -->
	      <li class="dropdown user user-menu">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	          <img src="<?= $adminAssetUrl?>dist/img/admin.jpg" class="user-image" alt="User Image">
	          <span class="hidden-xs"><?= $_SESSION['login']['fullname'] ?></span>
	        </a>
	        <ul class="dropdown-menu">
	          <!-- User image -->
	          <li class="user-header">
	            <img src="<?= $adminAssetUrl?>dist/img/admin.jpg" class="img-circle" alt="User Image">
	             	 <p>
	     				<?= $_SESSION['login']['fullname'] ?> - Web Developer
	              		<small>Member since Nov. 2018</small>
	            	</p>
	          </li>
	          <!-- Menu Footer-->
	          <li class="user-footer">
	            <div class="pull-left">
	              <a href="<?= $adminUrl?>tai-khoan" class="btn btn-default btn-flat">Profile</a>
	            </div>
	            <div class="pull-right">
	              <a href="<?= $siteUrl ?>logout.php" class="btn btn-default btn-flat">Sign out</a>
	            </div>
	          </li>
	        </ul>
	      </li>
	      <!-- Control Sidebar Toggle Button -->
	    </ul>
	  </div>
	</nav>
</header>
