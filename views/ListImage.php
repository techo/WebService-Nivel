<?php

session_start();

if(!isset($_SESSION['id']))
{
    header("Location: http://login.techo.org");
}

$pasta = "../imagenes/repository/".$_SESSION['id']."/";

if(is_dir($pasta))
{
    $diretorio = dir($pasta);
    $html.= "<ul>";
    while(($arquivo = $diretorio->read()) != false )
    {
        if($arquivo == '.' || $arquivo == '..' )
        {
            
        }
        else
        {
            $html .= "<li><img src=".$pasta . $arquivo." /></li>";
        }
        
    }
    $html.= "</ul>";
    $diretorio->close();
}
else
{
    echo 'A pasta não existe.';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Listado de Im&aacute;genes</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/simple-line-icons.css" rel="stylesheet">
    <style>
            body{
                padding:0;
            }
            ul{
                list-style: none;
            }
            li2{
                float:left;
                margin-right: 10px;
            }
            li img{
                cursor: pointer;
                width:200px;
                height:200px;
                padding:5px;
                border:1px solid gray;
                background-color: white;
                margin-right: 5px;
                box-shadow:1px 1px 5px black;
            	float:left;
                margin-right: 10px;
            }
            .container2{
                width:960px;
                height: 1000px;
                margin:0 auto;

            }
            #results{
                margin: 0 auto;
                position: relative;
                margin-top:250px;
            }
            .section{
                margin-bottom: 5px;
                box-shadow:1px 1px 3px black;
            }
            h1{
               border-bottom: 2px solid gray;
                color: black;
                font-family: Comic Sans MS;
                padding-bottom: 8px;
                padding-left: 50px;
                text-shadow: 1px 1px black;
                margin-top:0;
            }
            .button{
                background-color: silver;
                border: 1px solid black;
                border-radius: 5px 5px 5px 5px;
                box-shadow: 1px 1px 5px black;
                color: black;
                float: right;
                padding: 8px;
                text-decoration: none;
            }
        </style>
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
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/usuario.php"><i></i>Usuarios</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/paises.php"><i></i>Paises</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="http://herramientas.techo.org/aff/ws_soap/views/areas.php"><i></i>Areas</a>
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
					<a class="nav-link" id="sair" href="#"><i class="fa fa-sign-out"></i>Salir</a>
				</li>	
            </ul>
        </nav>
    </div>
    <!-- Main content -->
    <main class="main">
        <div class="container2">
        <h1>Listado de Im&aacute;genes</h1>
            <div class="imgParts">
                <?php echo($html)?>
            </div>
            <div id="results">
            </div>
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
    <script>
    $("#sair").on("click", function() 
    		{
    		    window.close();
    		});

    </script>
</body>

</html>
