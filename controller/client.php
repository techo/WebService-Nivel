<?php

    header('Content-Type: application/json; charset=UTF-8',true);
    $cAcao    = $_POST['acao'];
   
    switch ($cAcao)
      {
        case 'Login'          : LoginUsuario($_POST);
        break; 
        
        case 'GrabarUsuario'  : GrabarUsuario($_POST);
        break;
        
        case 'GrabarPais'     : GrabarPais($_POST);
        break;
        
        case 'GrabarArea'     : GrabarArea($_POST);
        break;
        
        case 'GrabarCargo'    : GrabarCargo($_POST);
        break;
        
        case 'ListArea'       : ListArea();
        break;
        
        case 'ListCargo'      : ListCargo();
        break;
        
        case 'ListPais'       : ListPais();
        break;
        
        case 'ListJefe'       : ListJefe();
        break;
        
        case 'ListContactAFF' : ListContactAFF();
        break;
        
        case 'ListContactCONT': ListContactCONT();
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
		        "redirect" => $aPost['redirect'],
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
          $area     = $aPost['area'];
          $cargo    = $aPost['cargo'];
          $pais     = $aPost['pais'];
          $jefe     = $aPost['jefe'];
          $status   = $aPost['status'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->CheckUser($email);
          
          if(empty($aRet))
          {
              $lGraba = $oBj->GrabarUsuario($nombre, $paterno, $materno, $email, $password, $area, $cargo, $pais, $jefe, $status, $_SESSION['Id']);
              
              if($lGraba)
              {
                  $message = 'Usuario registrado con Exito.';
                  $sucess  = 'true';
                  $result  = '';
                  
                  $aRet = array('Message' => $message,
                                'Success' => $sucess,
                                'Result'  => $result);
                  
                  echo(json_encode($aRet));
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
          $status = $aPost['status'];
          
          require_once '../model/Model.php';
          $oBj = new Model();
          
          $aRet = $oBj->CheckUser($_SESSION['Mail']);
          $_SESSION['Id'] = $aRet[0]['id'];
          
          $lGraba = $oBj->GrabarCargo($nombre, $status, $_SESSION['Id']);
          
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
		
?>                    

                      
                    
                  
                

                
                  
                    
                    
                      
                        
                        
                      

                      
                        
                        
                      
                   
                  
                