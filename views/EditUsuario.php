<?php 
$id = $_GET['id'];

require_once '../model/Model.php';
$oBj = new Model();
$aRet = $oBj->InfoUser($id); // Usuario

$aCargos = $oBj->ListCargo();
$aPais   = $oBj->ListPais();
$aChefe  = $oBj->ListJefe();

//Searche Jefe
$aJefe  = $oBj->checkJefe($aRet[0]['email']);
$aJefe  = $oBj->OhmyGod($aJefe[0]['id_jefe']);


//ComboBox Cargos
$comboBoxCargo = "<div class='form-group col-sm-3'>";
$comboBoxCargo.= "<label for='ccmonth'>Cargo</label>";
$comboBoxCargo.= "<select class='form-control' id='cargo'>";
$comboBoxCargo.= "<option value='0'>-- SELECCIONE--</option>";

foreach ($aCargos as $k => $v)
{
    if($aRet[0]['idcargo'] == $v['id'])
    {
        $comboBoxCargo.= "<option selected value='" . $v['id']."'>" . $v['nombre']."</option>";
    }
    else
    {
        $comboBoxCargo.= "<option value='" . $v['id']."'>" . $v['nombre']."</option>";
    }
}

$comboBoxCargo.= "</select>";
$comboBoxCargo.= "</div>";
//Fim ComboBox Cargos

//ComboBox Pais
$comboBoxPais = "<div class='form-group col-sm-3'>";
$comboBoxPais.= "<label for='ccmonth'>Pais</label>";
$comboBoxPais.= "<select class='form-control' id='pais'>";
$comboBoxPais.= "<option value='0'>-- SELECCIONE--</option>";

foreach ($aPais as $k => $v)
{
    if($aRet[0]['codpais'] == $v['id'])
    {
        $comboBoxPais.= "<option selected value='" . $v['id']."'>" . $v['nombre']."</option>";
    }
    else
    {
        $comboBoxPais.= "<option value='" . $v['id']."'>" . $v['nombre']."</option>";
    }
}

$comboBoxPais.= "</select>";
$comboBoxPais.= "</div>";
//Fim ComboBox Pais

//ComboBox Jefe
$comboBoxJefe = "<div class='form-group col-sm-3'>";
$comboBoxJefe.= "<label for='ccmonth'>Jefe</label>";
$comboBoxJefe.= "<select class='form-control' id='jefe'>";
$comboBoxJefe.= "<option value='0'>-- SELECCIONE--</option>";

foreach ($aChefe as $k => $v)
{
    if($aJefe[0]['id'] == $v['id'])
    {
        $comboBoxJefe.= "<option selected value='" . $v['id']."'>" . $v['nombre']."</option>";
    }
    else
    {
        $comboBoxJefe.= "<option value='" . $v['id']."'>" . $v['nombre']."</option>";
    }
}

$comboBoxJefe.= "</select>";
$comboBoxJefe.= "</div>";
//Fim ComboBox Jefe

//ComboBox Status
$p = '';

$comboBoxStatus = "<div class='form-group col-sm-3'>";
$comboBoxStatus.= "<label for='ccmonth'>Status</label>";
$comboBoxStatus.= "<select class='form-control' id='status'>";
$comboBoxStatus.= "<option $p value='0'>-- SELECCIONE--</option>";

if($aRet[0]['status'] == 1)
{
    $comboBoxStatus.= "<option selected value='1'>Activo</option>";
    $comboBoxStatus.= "<option value='2'>Inactivo</option>";
}

if($aRet[0]['status'] == 2)
{
    $comboBoxStatus.= "<option value='1'>Activo</option>";
    $comboBoxStatus.= "<option selected value='2'>Inactivo</option>";
}
if($aRet[0]['status'] == 0)
{
    $p = 'selected';
    $comboBoxStatus.= "<option value='1'>Activo</option>";
    $comboBoxStatus.= "<option value='2'>Inactivo</option>";
}

$comboBoxStatus.= "</select>";
$comboBoxStatus.= "</div>";
//Fim ComboBox Status

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Editar Usuario</title>
    <link href="http://herramientas.techo.org/aff/ws_soap//css/style.css" rel="stylesheet">
    <link href="http://herramientas.techo.org/aff/ws_soap/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://herramientas.techo.org/aff/ws_soap/css/simple-line-icons.css" rel="stylesheet">
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
				 <a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/home.php"><i class="fa fa-home"></i> Home</a>
				 
				<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user-plus"></i>Registros</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/usuario.php"><i></i>Usuarios</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/paises.php"><i></i>Paises</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/cargos.php"><i></i>Cargos</a>
							</li>
						</ul>
					</li>
					
					<li class="nav-item nav-dropdown">
						<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-users"></i>Listas</a>
						<ul class="nav-dropdown-items">
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/ListUsuario.php"><i></i>Usuarios</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/ListPais.php"><i></i>Paises</a>
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
					 <a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/ListImage.php"><i class="fa fa-cloud-upload"></i> Listado Imagenes</a>
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
					<a class="nav-link" id="sair" href="#"><i class="fa fa-sign-out"></i>Salir</a>
				</li>	
            </ul>
        </nav>
    </div>
    <!-- Main content -->
    <main class="main">
               <div class="card-header">
                        <strong>Editar Usuario</strong> 
                    </div>
                    <div class="card-block">
                        <form action="" method="post" class="form-horizontal ">
                             <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" value="<?php echo($aRet[0]['nombre']);?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Apellido Paterno</label>
                                            <input type="text" class="form-control" id="paterno" value="<?php echo($aRet[0]['apellido_paterno']);?>">
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Apellido Materno</label>
                                            <input type="text" class="form-control" id="materno" value="<?php echo($aRet[0]['apellido_materno']);?>">
                                        </div>
                                    </div>
                                </div>
                             <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Email</label>
                                            <input type="text" class="form-control" id="email" value="<?php echo($aRet[0]['email']);?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <?php echo($comboBoxCargo);?>
                                   <?php echo($comboBoxPais);?>
                                   <?php echo($comboBoxJefe);?>
                                   <?php echo($comboBoxStatus);?>
                                   <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">ID Interno (NetSuite)</label>
                                            <input type="text" class="form-control" id="id_netsuite" value="<?php echo($aRet[0]['id_netsuite']);?>">
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="card-footer" align="center">
                        <button type="button" class="btn btn-sm btn-success" onclick="EditarUsuario(<?php echo($id);?>);"><i class="fa fa-dot-circle-o"></i> Grabar</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="SalirUsuario();"><i class="fa fa-ban"></i> Salir</button>
                    </div>
    </main>

    <footer class="footer">
        <span class="text-left">
            <a href="#">Nivel</a> &copy; 2017.
        </span>
    </footer>
    <!-- Bootstrap and necessary plugins -->
    <script src="http://herramientas.techo.org/aff/ws_soap/js/libs/jquery.min.js"></script>
    <script src="http://herramientas.techo.org/aff/ws_soap/js/libs/bootstrap.min.js"></script> 
    <script src="http://herramientas.techo.org/aff/ws_soap/js/app.js"></script>
	<script src="http://herramientas.techo.org/aff/ws_soap/js/main.js"></script>
	<script>
    $("#sair").on("click", function() 
    		{
    		    window.close();
    		});

    </script>
	<!-- Lista dados dos ComboBoxs -->
</body>

</html>
