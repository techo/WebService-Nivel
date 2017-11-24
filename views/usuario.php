<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Usuario</title>
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
               <div class="card-header">
                        <strong>Registro de Usuario</strong> 
                    </div>
                    <div class="card-block">
                        <form action="" method="post" class="form-horizontal ">
                             <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" placeholder="Enter Nombre">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Apellido Paterno</label>
                                            <input type="text" class="form-control" id="paterno" placeholder="Enter Apellido Paterno">
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Apellido Materno</label>
                                            <input type="text" class="form-control" id="materno" placeholder="Enter Apellido Materno">
                                        </div>
                                    </div>
                                </div>
                             <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Email</label>
                                            <input type="text" class="form-control" id="email" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Contrase&ntilde;a</label>
                                            <input type="password" class="form-control" id="password" placeholder="Enter Contrase&ntilde;a">
                                        </div>
                                    </div>
                                    <div id="areas">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                   <div id="cargos">
                                    </div>
                                    <div id="paises">                                       
                                    </div>
                                    <div id="jefes">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="ccmonth">Status</label>
                                        <select class="form-control" id="status">
                                        	<option value="0">-- SELECCIONE--</option>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="card-footer" align="center">
                        <button type="button" class="btn btn-sm btn-success" onclick="GrabarUsuario();"><i class="fa fa-dot-circle-o"></i> Grabar</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="LimpiarUsuario();"><i class="fa fa-ban"></i> Limpiar</button>
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
	<script src="../js/main.js"></script>
	<!-- Lista dados dos ComboBoxs -->
	<script>
	$(document).ready(function() {
	    ListArea();
	    ListCargo();
	    ListPais();
	    ListJefe();
	});
	</script>
</body>

</html>
