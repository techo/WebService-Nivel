<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Home</title>
      <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="pen-title">
  <p>Login Techo</p>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="">
  </div>
  <div class="form">
    <h2>Hacer Login</h2>
    <form  method="POST" action="">
    	
      <input type="text" id="mail" placeholder="Mail"/>
      <input type="hidden" id="redirect" value="<?php echo($_GET['redirect'])?>"/>
      <input type="hidden" id="appid" value="<?php echo($_GET['appid'])?>"/>
      <input type="password" id="password" placeholder="Password"/>
      <button type="button" id="login" onclick="Login();">Login</button>
     
    </form>
    
<form id="teste" style="display:none" method="POST">
  <input type="text" id="token" name="token" />
</form> 
  </div>
</div>
	  <script src="js/libs/jquery.min.js"></script>
	  <script src="js/main.js"></script>
</body>
</html>
