
<?php include('server.php') 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Đăng Nhập Thành Viên</title>
</head>
<body>
  <div class="header">
    <a href="http://localhost/shophung/index.php">
         <img src="../img/logo.jpg" width="100%">
    </a>
  	<h2>Đăng Nhập Thành Viên</h2>
  </div>
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
    <div class="aa">
      <p>
        Not yet a member? <a href="register.php">Sign in</a><button style="margin-left: 20px;width: 70px; height: 25px; background: #33FFFF"><a  href="http://localhost/shophung/index.php">Back</a></button>
      </p>
    </div>
  </form>
</body>
</html>
<style type="text/css">
  *{margin: 0px;
  padding: 0px;
}
.aa button a{
  color: black;
  text-decoration: none;
}
body {
  font-size: 120%;
  background: #F8F8FF;
}

.header {
  width: 30%;
  margin: 50px auto 0px;
  color: white;
  background: #5F9EA0;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
form, .content {
  width: 30%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
.input-group {
  margin: 10px 0px 10px 0px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}
.btn {
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #5F9EA0;
  border: none;
  border-radius: 5px;
}
.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #f2dede; 
  border-radius: 5px; 
  text-align: left;
}
.success {
  color: #3c763d; 
  background: #dff0d8; 
  border: 1px solid #3c763d;
</style>