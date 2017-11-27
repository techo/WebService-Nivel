<?php
// session_start();

// if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
// {
// 	unset($_SESSION['login']);
// 	unset($_SESSION['senha']);
// 	header('location:../index.php');
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/simple-line-icons.css" rel="stylesheet">
</head>
<body class="navbar-fixed sidebar-nav fixed-nav">
    <header class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
            <a class="navbar-brand" href="#"></a>
            <ul class="nav navbar-nav hidden-md-down pull-xs-left">
                <li class="nav-item b-r-1">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                </li>
            </ul>
            <form class="form-inline pull-xs-left b-r-1 p-x-2 hidden-md-down">
                <i class="fa fa-search"></i>
                <input class="form-control" type="text" placeholder="Search...">
            </form>
        </div>
    </header>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title text-xs-center">
                    <span>Menu</span>
                </li>
				 <li class="nav-item">
				 <a class="nav-link" href="home.php"><i class="fa fa-home"></i> Home</a>
				 
				 <li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user-plus"></i>Registros</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/usuario.php"><i class="fa fa-arrow-right"></i>Usuarios</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/paises.php"><i class="fa fa-arrow-right"></i>Paises</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/areas.php"><i class="fa fa-arrow-right"></i>Areas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/cargos.php"><i class="fa fa-arrow-right"></i>Cargos</a>
							</li>
						</ul>
					</li>
					
					<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-users"></i>Listas</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/ListUsuario.php"><i class="fa fa-arrow-right"></i>Usuarios</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/ListArea.php"><i class="fa fa-arrow-right"></i>Areas</a>
							</li>
						</ul>
					</li>
					
					<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-check"></i>Ejemplos</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/GetLogin.php"><i class="fa fa-arrow-right"></i>GetLogin</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/GetCheckToken.php"><i class="fa fa-arrow-right"></i>GetCheckToken</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/GetJefeDirecto.php"><i class="fa fa-arrow-right"></i>GetJefeDirecto</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/GetContactAFF.php"><i class="fa fa-arrow-right"></i>GetContactAFF</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/GetContactCONT.php"><i class="fa fa-arrow-right"></i>GetContactCONT</a>
							</li>
						</ul>
					</li>
				<li class="nav-item">				
					<a class="nav-link" href="../index.php"><i class="fa fa-sign-out"></i>Salir</a>
				</li>	
            </ul>
        </nav>
    </div>
    <!-- Main content -->
    <main class="main">
         <?php 
           session_start();
           echo('<br>');
           echo('<pre>');
           echo(print_r($_SESSION, true));
         ?>   
    </main>

    <footer class="footer">
        <span class="text-left">
            <a href="#">Nivel</a> &copy; 2017.
        </span>
    </footer>
    <!-- Bootstrap and necessary plugins -->
    <script src="../js/libs/jquery.min.js"></script>
    <script src="../js/libs/bootstrap.min.js"></script> 
    <script src="../js/app.js"></script>
</body>

</html>
