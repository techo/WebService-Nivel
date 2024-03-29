<?php


// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

    header('Content-Type: application/json; charset=UTF-8',true);
    $cAcao    = $_POST['acao'];
   
    switch ($cAcao)
      {
        case 'Login'          : LoginUsuario($_POST);
        break; 
        
        case 'EnviarSenha'     : EnviarSenha($_POST);
        break; 
        
        case 'NovaSenha'       : NovaSenha($_POST);
        break; 
        
        case 'GrabarUsuario'  : GrabarUsuario($_POST);
        break;
        
        case 'GrabarPais'     : GrabarPais($_POST);
        break;
        
        case 'GrabarArea'     : GrabarArea($_POST);
        break;
        
        case 'GrabarCargo'    : GrabarCargo($_POST);
        break;
        
        case 'GrabarRegion'   : GrabarRegion($_POST);
        break;
        
        case 'ListArea'       : ListArea();
        break;
        
        case 'ListCargo'      : ListCargo();
        break;
        
        case 'ListPais'       : ListPais();
        break;
        
        case 'ListRegion'     : ListRegion();
        break;
        
        case 'ListJefe'       : ListJefe();
        break;
        
        case 'ListContactAFF' : ListContactAFF();
        break;
        
        case 'ListContactCONT': ListContactCONT();
        break;
        
        case 'ListUsuarios'   : ListUsuarios();
        break;
        
        case 'EditarUsuario'  : EditarUsuario($_POST);
        break;
        
        case 'ListaArea'      : ListaArea($_POST);
        break;
        
        case 'EditarArea'     : EditarArea($_POST);
        break;
        
        case 'ListaCargo'     : ListaCargo($_POST);
        break;
        
        case 'EditarCargo'    : EditarCargo($_POST);
        break;
        
        case 'ListaPais'      : ListaPais($_POST);
        break;
        
        case 'ListaRegion'    : ListaRegion($_POST);
        break;
        
        case 'EditarPais'     : EditarPais($_POST);
        break;
        
        case 'EditarRegion'   : EditarRegion($_POST);
        break;
		
		case 'BuscaUsuario'      : BuscaUsuario($_POST);
        break;
        
		case 'ListaSubsidiaria'  : ListaSubsidiaria($_POST);
		break;
		
		case 'ComboSubsidiaria'  : ComboSubsidiaria($_POST);
		break;
        
      }
      
      //Login do Usuario
      function LoginUsuario($aPost)
      {
        //Inicia Session
		session_start();
        $_SESSION['Mail']     = $aPost['mail'];
		$_SESSION['Password'] = $aPost['password'];
		
		//Instancia Model para verificar usuario
		require_once '../model/Model.php';
        $oBj = new Model();
        $Logado = $oBj->LoginUser($_SESSION['Mail'], $_SESSION['Password']);
        
        //Retorna para View
		if($Logado)
		{
		    $aRet = $oBj->CheckUser($_SESSION['Mail']);
		    
		    $_SESSION['Id'] = $aRet[0]['id'];
		    
		    //Se o Usuario Existe, Gera um Token
		    $_SESSION['Token'] = GeraToken($_SESSION['Mail']);
		    
		    if(!$aPost['redirect'])
		    {
		        $aPost['redirect'] = "views/home.php";
		    }
		    else
		    {
		        if($aPost['appid'] == '91d03f846bb8b29b4e3c87d80363474b')
		        {
		            $aDados['redirect'] = $aPost['redirect'];
		        }
		        else
		        {
		            $message = 'AppID Invalid.';
		            $sucess  = 'false';
		            $result  = '';
		            
		            $aRet = array('Message' => $message,
        		                  'Success' => $sucess,
        		                  'Result'  => $result);
		            
		            echo(json_encode($aRet));
		        }
		    }
		    
		    echo json_encode(array(
		        "results"  => true,
		        "redirect" => $aPost['redirect'] . '?token='.$_SESSION['Token'].'&ID='. $_SESSION['Id'],
		        "token"    => $_SESSION['Token']
		    ));
		}
		else
		{
			echo json_encode(array("results" => false));
		}
      }
      
      //Cria Token
      function GeraToken($email)
      {
          $email = $email;
          $date  = date('d/m/y');
          
          //Resgata id do Usuario
          require_once '../model/Model.php';
          $oBj = new Model();
          
          date_default_timezone_set('America/Santiago');
          
          //Dados a serem enviados
          $token  = md5($email) . '-' . md5($date);
          $ip     = $_SERVER["REMOTE_ADDR"];
          $iduser = $_SESSION['Id'];
          $start  = date('Y-m-d H:i');
          $end    = date('Y-m-d H:i', strtotime('+1 day'));
          
          //comprueba si el token existe
          $aReturn = $oBj->checkToken($token);
          
          if(empty($aReturn))
          {
              GravaToken($token, $ip, $iduser, $start, $end);
          }
          
          return $token;
      }
      
      //Grava na Base de Dados a Autenticacao
      function GravaToken($token, $ip, $iduser, $start, $end)
      {
          require_once '../model/Model.php';
          $oBj     = new Model();
          $lGravou = $oBj->GravaToken($token, $ip, $iduser, $start, $end);
      }
      
      function GrabarUsuario($aPost)
      {
          session_start();
          $nombre   = $aPost['nombre'];
          $paterno  = $aPost['paterno'];
          $materno  = $aPost['materno'];
          $email    = $aPost['mail'];
          $password = $aPost['password'];
          $cargo    = $aPost['cargo'];
          $pais     = $aPost['pais'];
          $jefe     = $aPost['jefe'];
          $status   = $aPost['status'];
          $netsuite = $aPost['netsuite'];
          $subsidiaria = $aPost['subsidiaria'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->CheckUser($email);
          
          if(empty($aRet))
          {
              $lGraba = $oBj->GrabarUsuario($nombre, $paterno, $materno, $email, $password, $cargo, $pais, $jefe, $status, $_SESSION['Id'], $netsuite, $subsidiaria);
              
              if($lGraba)
              {
                  require_once("../lib/phpmailer/class.phpmailer.php");
                  $mail = new PHPMailer1;
                  
                  $mail->isSMTP();
                  
               //   $mail->SMTPDebug = 2;
                  
                  $mail->Host = 'smtp.gmail.com';
                  
                  $mail->Port = 587;
                  
                  $mail->SMTPSecure = 'tls';
                  
                  $mail->SMTPAuth = true;
                  
                  $mail->Username = "no-reply@techo.org";
                  
                  $mail->Password = "0CBiyyRg";
                  
                  $mail->setFrom($email);
                  
                  $mail->addAddress($email);
                  
                  $mail->Subject = 'Cadastro de Usuario';
                  
                  $mail->msgHTML('<!DOCTYPE html>
                        <html>
                        <head>
                        	<meta charset="utf-8">
                        	<meta http-equiv="X-UA-Compatible" content="IE=edge">
                        	<title>Cadastro de Usuario</title>
                        </head>
                        <body>
                        <style>
                        	* {
                        		font-size: 14px;
                        		line-height: 1.8em;
                        		font-family: arial;
                        	}
                        </style>
                        	<table style="margin:0 auto; max-width:660px;">
                        		<thead>
                        			<tr>
                        				<th><img src="https://crunchbase-production-res.cloudinary.com/image/upload/c_lpad,h_256,w_256,f_jpg/v1456028699/hmjywirmsbcl3frjdtsn.png" />  </th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr>
                        				<td><p style="padding-bottom:20px; text-align:center;">Abajo informaci&oacute;n sobre su Login en Nivel:</p>
                            				Email:<strong> '. $email .'</strong><br>
                            				Contrase&ntilde;a:<strong> '. $password .'</strong><br>
                                            Acceso al Sistema : <a href="http://techo.ecloudapp.site:8084/Nivel">Clic aqu&iacute;</a> 
                        				</td>
                        			</tr>
                        			<tr>
                        				<td>
                        				</td>
                        			</tr>
                        		</tbody>
                        	</table>
                        </body>
                        </html>');
                  
                  $mail->AltBody = 'This is a plain-text message body';
                  
                //  $mail->addAttachment('images/phpmailer_mini.png');
                  
                  if (!$mail->send()) {
                      echo "Mailer Error: " . $mail->ErrorInfo;
                  } else {
                      
                      $message = 'Usuario registrado con Exito.';
                      $sucess  = 'true';
                      $result  = '';
                      
                      $aRet = array('Message' => $message,
                          'Success' => $sucess,
                          'Result'  => $result);
                      
                      echo(json_encode($aRet));
                  }
              }
              else
              {
                  $message = 'Error al registrar Usuario.';
                  $sucess  = 'false';
                  $result  = '';
                  
                  $aRet = array('Message' => $message,
                                'Success' => $sucess,
                                'Result'  => $result);
                  
                  echo(json_encode($aRet));
              }
          }
          else
          {
              $message = 'Usuario ya registrado.';
              $sucess  = 'false';
              $result  = '';
              
              $aRet = array('Message' => $message,
                            'Success' => $sucess,
                            'Result'  => $result);
              
              echo(json_encode($aRet));
          }
      }
      
      function GrabarPais($aPost)
      {
          session_start();
          $nombre = $aPost['nombre'];
          $codigo = $aPost['codigo'];
          $status = $aPost['status'];
          $idAff  = $aPost['aff'];
          $idCont = $aPost['cont'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->CheckUser($_SESSION['Mail']);
          $_SESSION['Id'] = $aRet[0]['id'];
                   
          $lGraba = $oBj->GrabarPais($nombre, $codigo, $status, $idAff, $idCont, $_SESSION['Id']);
          
          if($lGraba)
          {
              $message = 'Pais registrado con Exito.';
              $sucess  = 'true';
              $result  = '';
              
              $aRet = array('Message' => $message,
                            'Success' => $sucess,
                            'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          else
          {
              $message = 'Error al registrar Pais.';
              $sucess  = 'false';
              $result  = '';
              
              $aRet = array('Message' => $message,
                            'Success' => $sucess,
                            'Result'  => $result);
              
              echo(json_encode($aRet));
          }
      }
      
      function GrabarArea($aPost)
      {
          session_start();
          $nombre = $aPost['nombre'];
          $codigo = $aPost['codigo'];
          $status = $aPost['status'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->CheckUser($_SESSION['Mail']);
          $_SESSION['Id'] = $aRet[0]['id'];
          
          $lGraba = $oBj->GrabarArea($nombre, $codigo, $status, $_SESSION['Id']);
          
          if($lGraba)
          {
              $message = 'Area registrada con Exito.';
              $sucess  = 'true';
              $result  = '';
              
              $aRet = array('Message' => $message,
                            'Success' => $sucess,
                            'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          else
          {
              $message = 'Error al registrar Area.';
              $sucess  = 'false';
              $result  = '';
              
              $aRet = array('Message' => $message,
                            'Success' => $sucess,
                            'Result'  => $result);
              
              echo(json_encode($aRet));
          }
      }
      
      function GrabarCargo($aPost)
      {
          
          session_start();
          $nombre = $aPost['nombre'];
          $codigo = $aPost['codigo'];
          $status = $aPost['status'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->CheckUser($_SESSION['Mail']);
          $_SESSION['Id'] = $aRet[0]['id'];
          
          $lGraba = $oBj->GrabarCargo($nombre, $codigo, $status, $_SESSION['Id']);
          
          if($lGraba)
          {
              $message = 'Cargo registrado con Exito.';
              $sucess  = 'true';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          else
          {
              $message = 'Error al registrar Cargo.';
              $sucess  = 'false';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
      }
      
      function GrabarRegion($aPost)
      {
          session_start();
          
          $nombre = $aPost['nombre'];
          $codigo = $aPost['codigo'];
          $status = $aPost['status'];
          $idPais = $aPost['pais'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->CheckUser($_SESSION['Mail']);
          $_SESSION['Id'] = $aRet[0]['id'];
          
          $lGraba = $oBj->GrabarRegion($nombre, $codigo, $status, $idPais, $_SESSION['Id']);
          
          if($lGraba)
          {
              $message = 'Region registrada con Exito.';
              $sucess  = 'true';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          else
          {
              $message = 'Error al registrar Region.';
              $sucess  = 'false';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
      }
      
      function ListArea()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->ListArea();
          
          if(!empty($aRet))
          {
              $html .= "<div class='form-group col-sm-3'>";
              $html .= "<label for='ccmonth'>Area</label>";
              $html .= "<select class='form-control' id='area'>";
              $html .= "<option value='0'>-- SELECCIONE--</option>";
              
              foreach ($aRet as $k=>$v)
              {
                  $html .= "<option value='" . $v['id']."'>" . $v['nombre']."</option>";
              }
              
              $html .= "</select>";
              $html .= " </div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function ListCargo()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->ListCargo();
          
          if(!empty($aRet))
          {
              $html .= "<div class='form-group col-sm-4'>";
              $html .= "<label for='ccmonth'>Cargo</label>";
              $html .= "<select class='form-control' id='cargo'>";
              $html .= "<option value='0'>-- SELECCIONE--</option>";
              
              foreach ($aRet as $k=>$v)
              
              {
                  $html .= "<option value='" . $v['id']."'>" . $v['nombre']."</option>";
              }
              
              $html .= "</select>";
              $html .= " </div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function ListPais()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->ListPais();
          
          if(!empty($aRet))
          {
              $html .= "<div class='form-group col-sm-3'>";
              $html .= "<label for='ccmonth'>Pais</label>";
              $html .= "<select class='form-control' id='pais'>";
              $html .= "<option value='0'>-- SELECCIONE--</option>";
              
              foreach ($aRet as $k=>$v)
              
              {
                  $html .= "<option value='" . $v['id']."'>" . $v['nombre']."</option>";
              }
              
              $html .= "</select>";
              $html .= " </div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function ListRegion()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->ListRegion();
          
          if(!empty($aRet))
          {
              $html .= "<div class='form-group col-sm-3'>";
              $html .= "<label for='ccmonth'>Regi&oacute;n</label>";
              $html .= "<select class='form-control' id='region'>";
              $html .= "<option value='0'>-- SELECCIONE--</option>";
              
              foreach ($aRet as $k=>$v)
              
              {
                  $html .= "<option value='" . $v['id']."'>" . $v['nombre']."</option>";
              }
              
              $html .= "</select>";
              $html .= " </div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function ListJefe()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->ListJefe();
          
          if(!empty($aRet))
          {
              $html .= "<div class='form-group col-sm-3'>";
              $html .= "<label for='ccmonth'>Jefe</label>";
              $html .= "<select class='form-control' id='jefe'>";
              $html .= "<option value='0'>-- SELECCIONE--</option>";
              
              foreach ($aRet as $k=>$v)
              
              {
                  $html .= "<option value='" . $v['id']."'>" . $v['nombre']."</option>";
              }
              
              $html .= "</select>";
              $html .= " </div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function ListContactAFF()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->ListJefe();
          
          if(!empty($aRet))
          {
              $html .= "<div class='form-group col-sm-3'>";
              $html .= "<label for='ccmonth'>Contact AFF</label>";
              $html .= "<select class='form-control' id='aff'>";
              $html .= "<option value='0'>-- SELECCIONE--</option>";
              
              foreach ($aRet as $k=>$v)
              
              {
                  $html .= "<option value='" . $v['id']."'>" . $v['nombre']."</option>";
              }
              
              $html .= "</select>";
              $html .= " </div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function ListContactCONT()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->ListJefe();
          
          if(!empty($aRet))
          {
              $html .= "<div class='form-group col-sm-3'>";
              $html .= "<label for='ccmonth'>Contact CONT</label>";
              $html .= "<select class='form-control' id='cont'>";
              $html .= "<option value='0'>-- SELECCIONE--</option>";
              
              foreach ($aRet as $k=>$v)
              
              {
                  $html .= "<option value='" . $v['id']."'>" . $v['nombre']."</option>";
              }
              
              $html .= "</select>";
              $html .= " </div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function ListUsuarios()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          $aRet = $oBj->ListUsuarios();
          $html = '';
          
          foreach ($aRet as $k=>$v)
          {
              $aJefe = $oBj->OhmyGod($v['jefe']);
              $aRet[$k]['jefe'] = $aJefe[0]['nombre'];
              $aRet[$k]['jefe_paterno'] = $aJefe[0]['apellido_paterno'];
              $aRet[$k]['jefe_materno'] = $aJefe[0]['apellido_materno'] ? $aJefe[0]['apellido_materno'] : '';
          }
          
          if(!empty($aRet))
          {
              $html .= "<div class='col-lg-12'>";
              $html .= "<div class='card'>";
              $html .= "<div class='card-header'>";
              $html .= "<i class='fa fa-align-justify'></i> Lista de Usuarios </br>";
              $html .= "</div>";
              $html .= "<div class='card-block'>";
              $html .= "<table class='table table-bordered table-striped table-condensed'>";
              $html .= "<thead>";
              $html .= "<tr>";
              $html .= "<th>Nombre</th>";
              $html .= "<th>Email</th>";
              $html .= "<th>Jefe</th>";
              $html .= "<th>ID NetSuite</th>";
              $html .= "<th>Pa&iacute;s</th>";
              $html .= "<th>Status</th>";
              $html .= "</tr>";
              foreach ($aRet as $k=>$v)
              {
                  $html .= "<tr>";
                  $html .= "<td>".$v['nombre']." ". $v['apellido_paterno']. " " .$v['apellido_materno']."</td>";
                  $html .= "<td>".$v['mail']."</td>";
                  $html .= "<td>".$v['jefe']." ". $v['jefe_paterno']. " " .$v['jefe_materno']."</td>";
                  $html .= "<td>".$v['id_netsuite']."</td>";
                  $html .= "<td>".$v['pais']."</td>";
                  $html .= "<td>";
                  if($v['status'] == 1)
                  {
                      $html .= "<span class='tag tag-success'>Activo</span>";
                  }
                  else 
                  {
                      $html .= "<span class='tag tag-danger'>Inactivo</span>";
                  }
                  $html .= '<td><a type="button" onclick="EditarUser('. $v['id'] .');" class="btn btn-secondary"><i class="fa fa-edit"></i> Editar</a>';
                  $html .= "</td>";
                  $html .= " </tr>";
              }
              $html .= "</thead>";
              $html .= "<tbody>";
              $html .= "</tbody>";
              $html .= "</table>";
              $html .= "</div>";
              $html .= "</div>";
              $html .= "</div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function EditarUsuario($aPost)
      {
          session_start();
          $nombre   = $aPost['nombre'];
          $paterno  = $aPost['paterno'];
          $materno  = $aPost['materno'];
          $email    = $aPost['mail'];
          $cargo    = $aPost['cargo'];
          $pais     = $aPost['pais'];
          $jefe     = $aPost['jefe'];
          $status   = $aPost['status'];
          $netsuite = $aPost['netsuite'];
          $subsidiaria = $aPost['subsidiaria'];
          $id       = $aPost['id'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $lGraba = $oBj->EditarUsuario($nombre, $paterno, $materno, $email, $cargo, $pais, $jefe, $status, $_SESSION['Id'], $id, $netsuite, $subsidiaria);
          if($lGraba)
          {
              $message = 'Usuario Cambiado con Exito.';
              $sucess  = 'true';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          else
          {
              $message = 'Error al Cambiar Usuario.';
              $sucess  = 'false';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          
      }
      
      function ListaArea()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          $aRet = $oBj->ListaArea();
          
          if(!empty($aRet))
          {
              $html .= "<div class='col-lg-12'>";
              $html .= "<div class='card'>";
              $html .= "<div class='card-header'>";
              $html .= "<i class='fa fa-align-justify'></i> Lista de Areas";
              $html .= "</div>";
              $html .= "<div class='card-block'>";
              $html .= "<table class='table table-bordered table-striped table-condensed'>";
              $html .= "<thead>";
              $html .= "<tr>";
              $html .= "<th>Nombre</th>";
              $html .= "<th>Codigo</th>";
              $html .= "<th>Status</th>";
              $html .= "</tr>";
              foreach ($aRet as $k=>$v)
              {
                  $html .= "<tr>";
                  $html .= "<td>".$v['nombre']."</td>";
                  $html .= "<td>".$v['codigo']."</td>";
                  $html .= "<td>";
                  if($v['status'] == 1)
                  {
                      $html .= "<span class='tag tag-success'>Activo</span>";
                  }
                  else
                  {
                      $html .= "<span class='tag tag-danger'>Inactivo</span>";
                  }
                  $html .= '<td><a type="button" onclick="RedirectArea('. $v['id'] .');" class="btn btn-secondary"><i class="fa fa-edit"></i> Editar</a>';
                  $html .= "</td>";
                  $html .= " </tr>";
              }
              $html .= "</thead>";
              $html .= "<tbody>";
              $html .= "</tbody>";
              $html .= "</table>";
              $html .= "</div>";
              $html .= "</div>";
              $html .= "</div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function EditarArea($aPost)
      {
          session_start();
          $nombre   = $aPost['nombre'];
          $codigo   = $aPost['codigo'];
          $status   = $aPost['status'];
          $id       = $aPost['id'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $lGraba = $oBj->EditarArea($nombre, $codigo, $status, $_SESSION['Id'], $id);
          if($lGraba)
          {
              $message = 'Area Cambiada con Exito.';
              $sucess  = 'true';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          else
          {
              $message = 'Error al Cambiar Area.';
              $sucess  = 'false';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          
      }
      
      function ListaCargo()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          $aRet = $oBj->ListaCargo();
          
          if(!empty($aRet))
          {
              $html .= "<div class='col-lg-12'>";
              $html .= "<div class='card'>";
              $html .= "<div class='card-header'>";
              $html .= "<i class='fa fa-align-justify'></i> Lista de Cargos";
              $html .= "</div>";
              $html .= "<div class='card-block'>";
              $html .= "<table class='table table-bordered table-striped table-condensed'>";
              $html .= "<thead>";
              $html .= "<tr>";
              $html .= "<th>Nombre</th>";
              $html .= "<th>Codigo</th>";
              $html .= "<th>Status</th>";
              $html .= "</tr>";
              foreach ($aRet as $k=>$v)
              {
                  $html .= "<tr>";
                  $html .= "<td>".$v['nombre']."</td>";
                  $html .= "<td>".$v['codigo']."</td>";
                  $html .= "<td>";
                  if($v['status'] == 1)
                  {
                      $html .= "<span class='tag tag-success'>Activo</span>";
                  }
                  else
                  {
                      $html .= "<span class='tag tag-danger'>Inactivo</span>";
                  }
                  $html .= '<td><a type="button" onclick="RedirectCargo('. $v['id'] .');" class="btn btn-secondary"><i class="fa fa-edit"></i> Editar</a>';
                  $html .= "</td>";
                  $html .= " </tr>";
              }
              $html .= "</thead>";
              $html .= "<tbody>";
              $html .= "</tbody>";
              $html .= "</table>";
              $html .= "</div>";
              $html .= "</div>";
              $html .= "</div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function EditarCargo($aPost)
      {
          
          session_start();
          $nombre   = $aPost['nombre'];
          $codigo   = $aPost['codigo'];
          $status   = $aPost['status'];
          $id       = $aPost['id'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $lGraba = $oBj->EditarCargo($nombre, $codigo, $status, $_SESSION['Id'], $id);
          if($lGraba)
          {
              $message = 'Cargo Cambiado con Exito.';
              $sucess  = 'true';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          else
          {
              $message = 'Error al Cambiar Cargo.';
              $sucess  = 'false';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          
      }
      
      function ListaPais()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          $aRet = $oBj->ListaPais();
          
          if(!empty($aRet))
          {
              $html .= "<div class='col-lg-12'>";
              $html .= "<div class='card'>";
              $html .= "<div class='card-header'>";
              $html .= "<i class='fa fa-align-justify'></i> Lista de Paises";
              $html .= "</div>";
              $html .= "<div class='card-block'>";
              $html .= "<table class='table table-bordered table-striped table-condensed'>";
              $html .= "<thead>";
              $html .= "<tr>";
              $html .= "<th>Nombre</th>";
              $html .= "<th>Codigo</th>";
              $html .= "<th>Contacto AFF</th>";
              $html .= "<th>Contacto CONT</th>";
              $html .= "<th>Status</th>";
              $html .= "</tr>";
              foreach ($aRet as $k=>$v)
              {
                  $html .= "<tr>";
                  $html .= "<td>".$v['nombre']."</td>";
                  $html .= "<td>".$v['codigo']."</td>";
                  $html .= "<td>".$v['nombre_aff'].' '.$v['paterno_aff'].' '.$v['materno_aff']."</td>";
                  $html .= "<td>".$v['nombre_cont'].' '.$v['paterno_cont'].' '.$v['materno_cont']."</td>";
                  $html .= "<td>";
                  if($v['status'] == 1)
                  {
                      $html .= "<span class='tag tag-success'>Activo</span>";
                  }
                  else
                  {
                      $html .= "<span class='tag tag-danger'>Inactivo</span>";
                  }
                  $html .= '<td><a type="button" onclick="RedirectPais('. $v['id'] .');" class="btn btn-secondary"><i class="fa fa-edit"></i> Editar</a>';
                  $html .= "</td>";
                  $html .= " </tr>";
              }
              $html .= "</thead>";
              $html .= "<tbody>";
              $html .= "</tbody>";
              $html .= "</table>";
              $html .= "</div>";
              $html .= "</div>";
              $html .= "</div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function ListaRegion()
      {
          require_once '../model/Model.php';
          $oBj = new Model();
          $aRet = $oBj->ListaRegion();
          
          if(!empty($aRet))
          {
              $html .= "<div class='col-lg-12'>";
              $html .= "<div class='card'>";
              $html .= "<div class='card-header'>";
              $html .= "<i class='fa fa-align-justify'></i> Lista de Regiones";
              $html .= "</div>";
              $html .= "<div class='card-block'>";
              $html .= "<table class='table table-bordered table-striped table-condensed'>";
              $html .= "<thead>";
              $html .= "<tr>";
              $html .= "<th>Nombre</th>";
              $html .= "<th>Codigo</th>";
              $html .= "<th>País</th>";
              $html .= "<th>Status</th>";
              $html .= "</tr>";
              foreach ($aRet as $k=>$v)
              {
                  $html .= "<tr>";
                  $html .= "<td>".$v['nombre']."</td>";
                  $html .= "<td>".$v['codigo']."</td>";
                  $html .= "<td>".$v['nombre_pais']."</td>";
                  $html .= "<td>";
                  if($v['status'] == 1)
                  {
                      $html .= "<span class='tag tag-success'>Activo</span>";
                  }
                  else
                  {
                      $html .= "<span class='tag tag-danger'>Inactivo</span>";
                  }
                  $html .= '<td><a type="button" onclick="RedirectRegion('. $v['id'] .');" class="btn btn-secondary"><i class="fa fa-edit"></i> Editar</a>';
                  $html .= "</td>";
                  $html .= " </tr>";
              }
              $html .= "</thead>";
              $html .= "<tbody>";
              $html .= "</tbody>";
              $html .= "</table>";
              $html .= "</div>";
              $html .= "</div>";
              $html .= "</div>";
              
              echo json_encode(array("results" => $html));
          }
      }
      
      function EditarPais($aPost)
      {
          session_start();
          $nombre   = $aPost['nombre'];
          $codigo   = $aPost['codigo'];
          $id_aff   = $aPost['aff'];
          $id_cont  = $aPost['cont'];
          $status   = $aPost['status'];
          $id       = $aPost['id'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $lGraba = $oBj->EditarPais($nombre, $codigo, $id_aff, $id_cont, $status, $_SESSION['Id'], $id);
          if($lGraba)
          {
              $message = 'Pais Cambiado con Exito.';
              $sucess  = 'true';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          else
          {
              $message = 'Error al Cambiar Pais.';
              $sucess  = 'false';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          
      }
      
      function EditarRegion($aPost)
      {
          session_start();
          $nombre   = $aPost['nombre'];
          $codigo   = $aPost['codigo'];
          $id_pais  = $aPost['id_pais'];
          $id       = $aPost['id'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $lGraba = $oBj->EditarRegion($nombre, $codigo, $id_pais, $_SESSION['Id'], $id);
          if($lGraba)
          {
              $message = 'Region Cambiado con Exito.';
              $sucess  = 'true';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          else
          {
              $message = 'Error al Cambiar Region.';
              $sucess  = 'false';
              $result  = '';
              
              $aRet = array('Message' => $message,
                  'Success' => $sucess,
                  'Result'  => $result);
              
              echo(json_encode($aRet));
          }
          
      }
      
      function EnviarSenha($aPost)
      {
          $email = $aPost['correo'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->BuscarSenha($email);
          
          $pass = $aRet[0]['PASSWORD'];
          $id   = $aRet[0]['id'];
          
          if($aRet)
          {
              require_once("../lib/phpmailer/class.phpmailer.php");
              $mail = new PHPMailer1;
              
              $mail->isSMTP();
              
              //   $mail->SMTPDebug = 2;
              
              $mail->Host = 'smtp.gmail.com';
              
              $mail->Port = 587;
              
              $mail->SMTPSecure = 'tls';
              
              $mail->SMTPAuth = true;
              
              $mail->Username = "no-reply@techo.org";
              
              $mail->Password = "0CBiyyRg";
              
              $mail->setFrom($email);
              
              $mail->addAddress($email);
              
              $mail->Subject = 'Recuperar contrase�a';
              
              $mail->msgHTML('<!DOCTYPE html>
                        <html>
                        <head>
                        	<meta charset="utf-8">
                        	<meta http-equiv="X-UA-Compatible" content="IE=edge">
                        	<title>Recuperar contrase�a</title>
                        </head>
                        <body>
                        <style>
                        	* {
                        		font-size: 14px;
                        		line-height: 1.8em;
                        		font-family: arial;
                        	}
                        </style>
                        	<table style="margin:0 auto; max-width:660px;">
                        		<thead>
                        			<tr>
                        				<th><img src="https://crunchbase-production-res.cloudinary.com/image/upload/c_lpad,h_256,w_256,f_jpg/v1456028699/hmjywirmsbcl3frjdtsn.png" />  </th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr>
                        				<td><p style="padding-bottom:20px; text-align:center;">Abajo informaci&oacute;n sobre su Login en Nivel:</p>
                            				Email:<strong> '. $email .'</strong><br>
                            				Contrase&ntilde;a:<strong> '. $pass.'</strong><br>
                                            Acceso al Sistema : <a href="http://techo.ecloudapp.site:8084/Nivel">Clic aqu&iacute;</a><br>
                                            Si desea modificar su contrase�a: <a href="http://herramientas.techo.org/aff/ws_soap/newpass.php?register='.$id. '&mail='.$email.'">Clic aqu&iacute;</a><br>
                        				</td>
                        			</tr>
                        			<tr>
                        				<td>
                        				</td>
                        			</tr>
                        		</tbody>
                        	</table>
                        </body>
                        </html>');
              
              $mail->AltBody = 'This is a plain-text message body';
              
              //  $mail->addAttachment('images/phpmailer_mini.png');
              
              if (!$mail->send()) {
                  echo "Mailer Error: " . $mail->ErrorInfo;
              } else {
                  
                  $message = 'Correo Enviado con Exito.';
                  $sucess  = 'true';
                  $result  = '';
                  
                  echo json_encode(array("results" => $message));
              }
          }
      }
      
      function NovaSenha($aPost)
      {
          $email = $aPost['correo'];
          $id    = $aPost['id'];
          $senha = $aPost['senha'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->AlterarSenha($email, $id, $senha);
          
          if($aRet)
          {
              $message = 'Contrasena cambiada con Exito.';
              
              echo json_encode(array("results" => $message));
          }
          else
          {
              $message = 'Error al cambiada contrasena.';
              
              echo json_encode(array("results" => $message));
          }
      }
	  
	  function BuscaUsuario($aPost)
	  {
		  $tipo  = $aPost['tipo'];				
		  $valor = $aPost['valor'];
		  
		  require_once '../model/Model.php';
          $oBj = new Model();
		  		  
		  if(!empty($valor))
		  {
			  $aRet = $oBj->BuscaUsuario($tipo, $valor);
		  }
		  else
		  {
			  $aRet = $oBj->ListUsuarios();
		  }
		  
		  
          $html = '';
		  		  
          foreach ($aRet as $k=>$v)
          {
              $aJefe = $oBj->OhmyGod($v['jefe']);
              $aRet[$k]['jefe'] = $aJefe[0]['nombre'];
              $aRet[$k]['jefe_paterno'] = $aJefe[0]['apellido_paterno'];
              $aRet[$k]['jefe_materno'] = $aJefe[0]['apellido_materno'] ? $aJefe[0]['apellido_materno'] : '';
          }
          
          if(!empty($aRet))
          {
              $html .= "<div class='col-lg-12'>";
              $html .= "<div class='card'>";
              $html .= "<div class='card-header'>";
              $html .= "<i class='fa fa-align-justify'></i> Lista de Usuarios </br>";
              $html .= "</div>";
              $html .= "<div class='card-block'>";
              $html .= "<table class='table table-bordered table-striped table-condensed'>";
              $html .= "<thead>";
              $html .= "<tr>";
              $html .= "<th>Nombre</th>";
              $html .= "<th>Email</th>";
              $html .= "<th>Jefe</th>";
              $html .= "<th>ID NetSuite</th>";
              $html .= "<th>Pa&iacute;s</th>";
              $html .= "<th>Status</th>";
              $html .= "</tr>";
              foreach ($aRet as $k=>$v)
              {
                  $html .= "<tr>";
                  $html .= "<td>".$v['nombre']." ". $v['apellido_paterno']. " " .$v['apellido_materno']."</td>";
                  $html .= "<td>".$v['mail']."</td>";
                  $html .= "<td>".$v['jefe']." ". $v['jefe_paterno']. " " .$v['jefe_materno']."</td>";
                  $html .= "<td>".$v['id_netsuite']."</td>";
                  $html .= "<td>".$v['pais']."</td>";
                  $html .= "<td>";
                  if($v['status'] == 1)
                  {
                      $html .= "<span class='tag tag-success'>Activo</span>";
                  }
                  else 
                  {
                      $html .= "<span class='tag tag-danger'>Inactivo</span>";
                  }
                  $html .= '<td><a type="button" onclick="EditarUser('. $v['id'] .');" class="btn btn-secondary"><i class="fa fa-edit"></i> Editar</a>';
                  $html .= "</td>";
                  $html .= " </tr>";
              }
              $html .= "</thead>";
              $html .= "<tbody>";
              $html .= "</tbody>";
              $html .= "</table>";
              $html .= "</div>";
              $html .= "</div>";
              $html .= "</div>";
              
              echo json_encode(array("results" => $html));
          }
	  }
	  
	  function ListaSubsidiaria()
	  {
	      require_once '../model/Model.php';
	      $oBj = new Model();
	      $aRet = $oBj->ListaSubsidiaria();
	      
	      if(!empty($aRet))
	      {
	          $html .= "<div class='col-lg-12'>";
	          $html .= "<div class='card'>";
	          $html .= "<div class='card-header'>";
	          $html .= "<i class='fa fa-align-justify'></i> Lista de Paises";
	          $html .= "</div>";
	          $html .= "<div class='card-block'>";
	          $html .= "<table class='table table-bordered table-striped table-condensed'>";
	          $html .= "<thead>";
	          $html .= "<tr>";
	          $html .= "<th>Subsidiaria</th>";
	          $html .= "<th>Codigo En NetSuite</th>";
	        //  $html .= "<th></th>";
	          $html .= "</tr>";
	          foreach ($aRet as $k=>$v)
	          {
	              $html .= "<tr>";
	              $html .= "<td>".$v['subsidiaria']."</td>";
	              $html .= "<td>".$v['subsidiaria_id_netsuite']."</td>";
	           //   $html .= '<td><a type="button" onclick="RedirectSubsidiaria('. $v['id'] .');" class="btn btn-secondary"><i class="fa fa-edit"></i> Editar</a>';
	           //   $html .= "</td>";
	              $html .= " </tr>";
	          }
	          $html .= "</thead>";
	          $html .= "<tbody>";
	          $html .= "</tbody>";
	          $html .= "</table>";
	          $html .= "</div>";
	          $html .= "</div>";
	          $html .= "</div>";
	          
	          echo json_encode(array("results" => $html));
	      }
	  }
	  
	  function ComboSubsidiaria()
	  {
	      require_once '../model/Model.php';
	      $oBj = new Model();
	      
	      $aRet = $oBj->ComboSubsidiaria();
	      
	      if(!empty($aRet))
	      {
	          $html .= "<div class='form-group col-sm-3'>";
	          $html .= "<label for='ccmonth'>Subsidiaria</label>";
	          $html .= "<select class='form-control' id='subsidiaria'>";
	          $html .= "<option value='0'>-- SELECCIONE--</option>";
	          
	          foreach ($aRet as $k=>$v)
	          {
	              $html .= "<option value='" . $v['subsidiaria_id_netsuite']."'>" . $v['subsidiaria']."</option>";
	          }
	          
	          $html .= "</select>";
	          $html .= " </div>";
	          
	          echo json_encode(array("results" => $html));
	      }
	  }
		
?>                    

                      
                    
                  
                

                
                  
                    
                    
                      
                        
                        
                      

                      
                        
                        
                      
                   
                  
                