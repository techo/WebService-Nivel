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
				<div class="login100-pic js-tilt" data-tilt>
					<img src="template_login/images/img-01.png" alt="IMG">
					<br>
					<br>
					<br>
					Una plataforma de 
					
					<img src="template_login/images/techo.png" alt="IMG" height="20">
				</div>

				<form class="login100-form validate-form" method="POST" action="">
				
							<span class="login100-form-title">
						<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
    						<input class="input100" type="text" name="email" id="mail" placeholder="Email">
    						<span class="focus-input100"></span>
    						<span class="symbol-input100">
    							<i class="fa fa-envelope" aria-hidden="true"></i>
    						</span>
						</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" id="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="hidden" id="redirect" value="<?php echo($_GET['redirect'])?>"/>
    				    <input class="input100" type="hidden" id="appid" value="<?php echo($_GET['appid'])?>"/>
					</div>
					 <button class="login100-form-btn" type="button" id="login" onclick="Login();">Login</button>
					<div class="container-login100-form-btn" onclick="Login();">
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Olvidaste
						</span>
						<a class="txt2" href="#" onclick="myFunction()">
							tu contrase&ntilde;a
						</a>
					</div>
					</span>
<!-- 						<button class="login100-form-btn"> -->
<!-- 							Login -->
<!-- 						</button> -->
<!-- 					</div> -->
				</form>
				<form id="teste" style="display:none" method="POST">
                  <input type="text" id="token" name="token" />
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
		})

		$(document).on('keydown', function(event) {

		    if(event.keyCode === 13) {

		        // Sua fun��o aqui
		    	Login();

		    }

		});
		
	</script>
<!--===============================================================================================-->
	<script src="template_login/js/principal.js"></script>
<script src="js/libs/jquery.min.js"></script>
	  <script src="js/main.js"></script>
	  
	  <script>
function myFunction() {
    window.open("http://herramientas.techo.org/aff/ws_soap/senha.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=450,height=400");
}
</script>
</body>
</html>