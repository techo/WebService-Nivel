<!DOCTYPE html>
<html lang="en">
<head>
	<title>Nivel - TECHO</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="template_login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="template_login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template_login/css/util.css">
	<link rel="stylesheet" type="text/css" href="template_login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="">
				Nueva Contrase&ntilde;a<br><br>
							<span class="login100-form-title">
						<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
    						<input class="input100" type="password" name="senha" id="newpass" placeholder="password">
    						<input class="input100" type="hidden" name="id1" id="id1" value="<?php echo($_GET['register']);?>">
    						<input class="input100" type="hidden" name="correo1" id="correo1" value="<?php echo($_GET['mail']);?>">
    						<span class="focus-input100"></span>
    						<span class="symbol-input100">
    							<i class="fa fa-envelope" aria-hidden="true"></i>
    						</span>
						</div>

					 <button class="login100-form-btn" type="button" id="novasenha" onclick="NovaSenha();">Grabar Contrase&ntilde;a</button>
					<div class="container-login100-form-btn" onclick="EnviaSenha();">
					</div>

					</span>
<!-- 						<button class="login100-form-btn"> -->
<!-- 							Login -->
<!-- 						</button> -->
<!-- 					</div> -->
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="template_login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="template_login/vendor/bootstrap/js/popper.js"></script>
	<script src="template_login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="template_login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="template_login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		});
		
	</script>
	 <script src="js/main.js"></script>
<!--===============================================================================================-->
	<script src="template_login/js/principal.js"></script>
<script src="js/libs/jquery.min.js"></script>
</body>
</html>