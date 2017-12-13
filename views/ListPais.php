<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Lista Pais</title>
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
								<a class="nav-link" href="usuario.php"><i></i>Usuarios</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="paises.php"><i></i>Paises</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="areas.php"><i></i>Areas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="cargos.php"><i></i>Cargos</a>
							</li>
						</ul>
					</li>
					
					<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-users"></i>Listas</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="ListUsuario.php"><i></i>Usuarios</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/ListPais.php"><i></i>Paises</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/ListArea.php"><i></i>Areas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/ListCargo.php"><i></i>Cargos</a>
							</li>
						</ul>
					</li>
					
					 <li class="nav-item">
					 <a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/upload.php"><i class="fa fa-cloud-upload"></i> Upload Imagenes</a>
					</li>
					
					 <li class="nav-item">
					 <a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/ListImage.php"><i class="fa fa-picture-o"></i> Listado Imagenes</a>
					</li>
					
					<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-check"></i>Ejemplos</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/GetLogin.php"><i></i>GetLogin</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/GetCheckToken.php"><i></i>GetCheckToken</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/GetJefeDirecto.php"><i></i>GetJefeDirecto</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/GetContactAFF.php"><i></i>GetContactAFF</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/GetContactCONT.php"><i></i>GetContactCONT</a>
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
       <div class="row">
                    <div id="listagem">
                    <!--/col-->
                </div>
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
    <script src="../js/main.js?"></script>
    <script>
	$(document).ready(function() {
		ListaPais();
	});
	</script>
</body>

</html>
