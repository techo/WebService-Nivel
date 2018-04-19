<?php

/**
 * Servidor NuSoap
 * Arquivo responsavel pelos Metodos de Consumo do Sistema.
 * @version 1.0
 * @package Server_Nivel
 * @author Elias Lima
 * @param
 * @param
 * @return
 */

//Server Nusoap
require_once '../lib/nusoap.php';

$server = new nusoap_server();

//Configuracao WSDL
$server->configureWSDL('WS_Nivel', 'http://herramientas.techo.org/aff/ws_soap/server');
$server->wsdl->schemaTargetNamespace = 'http://herramientas.techo.org/aff/ws_soap/server';

//GetLogin

$server->register(
    'GetLogin',
    array('token'            => 'xsd:string'),
    
    array('nombre'           => 'xsd:string'
         ,'email'            => 'xsd:string'
         ,'apellido_paterno' => 'xsd:string'
         ,'apellido_materno' => 'xsd:string'
         ,'area'             => 'xsd:string'
         ,'codarea'          => 'xsd:string'
         ,'cargo'            => 'xsd:string'
         ,'codcargo'         => 'xsd:string'
         ,'pais'             => 'xsd:string'
         ,'codigoPais'       => 'xsd:string'
         ,'id_netsuite'      => 'xsd:string'
		 ,'codigoRegion'     => 'xsd:string'
    ),
    'WS_Nivel.GetLogin',
    'WS_Nivel.GetLogin',
    'rpc',
    'encoded',
    'Metodo de autenticacion de los usuarios');

    
function GetLogin($token)
{
    require_once '../model/Model.php';
    $oBj = new Model();
    $aReturn = $oBj->checkToken($token);
    
    $array = json_decode(json_encode($aReturn), True);
    
    if(!empty($aReturn))
    {
        $aUser = $oBj->InfoUser($array[0]['id_usuario']);
        $aUser = $aUser[0];
        return $aUser;
    }
    else
    {
        $message = 'Invalid Token.';
        $aDados['Error'] = $message;
        return $aDados;
    }
}

//GetJefeDirecto
$server->register(
    'GetJefeDirecto',
    array('token'     => 'xsd:string',
          'mail'      => 'xsd:string'),
    array('nombre'   => 'xsd:string'
        ,'apellido_paterno' => 'xsd:string'
        ,'apellido_materno' => 'xsd:string'
        ,'mail'             => 'xsd:string'
        ,'cargo'            => 'xsd:string'
    ),
          'WS_Nivel.GetJefeDirecto',
          'WS_Nivel.GetJefeDirecto',
          'rpc',
          'encoded',
          'Metodo que devuelve el Jefe Directo del Empleado');

function GetJefeDirecto($token, $mail)
{
    require_once '../model/Model.php';
    $oBj = new Model();
    $aReturn = $oBj->checkToken($token);
    date_default_timezone_set('America/Santiago');
    $today  = date('Y-m-d H:i:s');
    
    if(!empty($aReturn))
    {
        //Id do Empleado(Usuario), depois busco o Jefe que tambien esta em usuarios
        $aDados = $oBj->checkJefe($mail);
        
        //Dados Jefe
        $aJefe = $oBj->SearchJefe($aDados[0]['id_jefe']);
        
        if(!empty($aJefe))
        {
           
            $result  = $aJefe[0];
            
            return $result;
        }
        else
        {
            $message = 'Invalid Mail';
            $aDados['Error'] = $message;
            return $aDados;
        }
    }
    else
    {
        $message = 'Invalid Token.';
        $aDados['Error'] = $message;
        return $aDados;
    }
}

//GetContactAFF
$server->register(
    'GetContactAFF',
    array('token'     => 'xsd:string',
          'codPais'   => 'xsd:string'),
    array('nombre'   => 'xsd:string'
         ,'apellido_paterno' => 'xsd:string'
         ,'apellido_materno' => 'xsd:string'
         ,'mail'             => 'xsd:string'
         ,'cargo'            => 'xsd:string'
    ),
          'WS_Nivel.GetContactAFF',
          'WS_Nivel.GetContactAFF',
          'rpc',
          'encoded',
          'Metodo que devuelve el Contacto de la AFF');
    
function GetContactAFF($token, $CodPais)
{
    require_once '../model/Model.php';
    $oBj = new Model();
    $aReturn = $oBj->checkToken($token);
    date_default_timezone_set('America/Santiago');
    $today  = date('Y-m-d H:i:s');
    
    if(!empty($aReturn))
    {
        //Resgata id do Pais
        require_once '../model/Model.php';
        $oBj = new Model();
        $aRet = $oBj->CheckPais($CodPais);
        
        if(!empty($aRet))
        {
            $aDados = $oBj->ListContactAFF($CodPais);
            $result = $aDados[0];
            
            return $result;
           
        }
        else 
        {
            $message = 'Invalid CodPais';
            $aDados['Error'] = $message;
            return $aDados;
        }
    }
    else
    {
        $message = 'Invalid Token.';
        $aDados['Error'] = $message;
        return $aDados;
    }
}

//GetContactCONT
$server->register(
    'GetContactCONT',
    array('token'            => 'xsd:string',
          'codPais'          => 'xsd:string'),
    array('nombre'           => 'xsd:string'
         ,'apellido_paterno' => 'xsd:string'
         ,'apellido_materno' => 'xsd:string'
         ,'mail'             => 'xsd:string'
         ,'cargo'            => 'xsd:string'
    ),
    'WS_Nivel.GetContactCONT',
    'WS_Nivel.GetContactCONT',
    'rpc',
    'encoded',
    'Metodo que devuelve el Contacto de la CONT');
    
function GetContactCONT($token, $CodPais)
{
    require_once '../model/Model.php';
    $oBj = new Model();
    $aReturn = $oBj->checkToken($token);
    date_default_timezone_set('America/Santiago');
    $today  = date('Y-m-d H:i:s');
    
    if(!empty($aReturn))
    {
        //Resgata id do Pais
        require_once '../model/Model.php';
        $oBj = new Model();
        $aRet = $oBj->CheckPais($CodPais);
        
        if(!empty($aRet))
        {
            $aDados = $oBj->ListContactCONT($CodPais);
            
            $result  = $aDados[0];
            return $result;
        }
        else
        {
            $message = 'Invalid CodPais';
            $aDados['Error'] = $message;
            return $aDados;
        }
    }
    else
    {
        $message = 'Invalid Token.';
        $aDados['Error'] = $message;
        return $aDados;
    }
}

$server->register(
    'GetCheckToken',
    array('token'          => 'xsd:string'),
    array(
         'token'           => 'xsd:string'
        ,'ip_request'      => 'xsd:string'
        ,'start_session'   => 'xsd:string'
        ,'timeout_session' => 'xsd:string'
        
    ),
    'WS_Nivel.GetCheckToken',
    'WS_Nivel.GetCheckToken',
    'rpc',
    'encoded',
    'Metodo que devuelve la info del Token');
    

function GetCheckToken($token)
{
    require_once '../model/Model.php';
    $oBj = new Model();
    $lReturn = $oBj->checkToken($token);
    
    if($lReturn)
    {
        $aDados = $oBj->InfoToken($token);
        $result = $aDados[0];
        
        return ($result);
    }
    else
    {
        $message = 'Invalid Token.';
        $aDados['Error'] = $message;
        return $aDados;
    }
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
// $server->service($HTTP_RAW_POST_DATA); 
$server->service(file_get_contents("php://input"));
