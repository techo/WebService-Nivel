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
$server->configureWSDL('urn:Server');
$server->wsdl->schemaTargetNamespace = 'urn:Server';

//GetLogin

$server->register(
    'GetLogin',
    array('token'            => 'xsd:string'),
    array('Retorno'          => 'xsd:string'
    ),
          'urn:Server.GetLogin',
          'urn:Server.GetLogin',
          'rpc',
          'encoded',
          'Metodo de autenticación de los usuarios');

function GetLogin($token) 
{
    require_once '../model/Model.php';
    $oBj = new Model();
    $aReturn = $oBj->checkToken($token);
    
    $array = json_decode(json_encode($aReturn), True);
      
    if(!empty($aReturn))
    {
        $aUser = $oBj->InfoUser($array[0]['id_usuario']);
        
        $message = 'Request Success';
        $sucess  = 'true';
        $result  = $aUser;
        
        $aRet = array('Message' => $message,
                      'Success' => $sucess,
                      'Result'  => $result);
        
        return json_encode($aRet);
    }
    else
    {
        $message = 'Invalid Token.';
        $sucess  = 'false';
        $result  = '';
        
        $aRet = array('Message' => $message,
                      'Success' => $sucess,
                      'Result'  => $result);
        
        return json_encode($aRet);
    }
}

//GetJefeDirecto
$server->register(
    'GetJefeDirecto',
    array('token'     => 'xsd:string',
          'mail'      => 'xsd:string'),
    array('Retorno'   => 'xsd:string'),
          'urn:Server.GetJefeDirecto',
          'urn:Server.GetJefeDirecto',
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
    
    if(!empty($aReturn) && $aReturn[0]['timeout_session'] >= $today)
    {
        //Id do Empleado(Usuario), depois busco o Jefe que tambien esta em usuarios
        $aDados = $oBj->checkJefe($mail);
        
        //Dados Jefe
        $aJefe = $oBj->SearchJefe($aDados[0]['id_jefe']);
        
        if(!empty($aJefe))
        {
            $message = 'Request Success';
            $sucess  = 'true';
            $result  = $aJefe;
            
            $aRet = array('Message' => $message,
                          'Success' => $sucess,
                          'Result'  => $result);
            
            return json_encode($aRet);
        }
        else
        {
            $message = 'Invalid Mail';
            $sucess  = 'false';
            $result  = '';
            
            $aRet = array('Message' => $message,
                          'Success' => $sucess,
                          'Result'  => $result);
            
            return json_encode($aRet);
        }
    }
    else
    {
        $message = 'Invalid Token.';
        $sucess  = 'false';
        $result  = '';
        
        $aRet = array('Message' => $message,
                      'Success' => $sucess,
                      'Result'  => $result);
        
        return json_encode($aRet);
    }
}

//GetContactAFF
$server->register(
    'GetContactAFF',
    array('token'     => 'xsd:string',
          'codPais'   => 'xsd:string'),
    array('Retorno'   => 'xsd:string'),
          'urn:Server.GetContactAFF',
          'urn:Server.GetContactAFF',
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
    
    if(!empty($aReturn) && $aReturn[0]['timeout_session'] >= $today)
    {
        //Resgata id do Pais
        require_once '../model/Model.php';
        $oBj = new Model();
        $aRet = $oBj->CheckPais($CodPais);
        
        if(!empty($aRet))
        {
            $aDados = $oBj->ListContactAFF($CodPais);
            
            $message = 'Request Success';
            $sucess  = 'true';
            $result  = $aDados;
            
            $aRet = array('Message' => $message,
                          'Success' => $sucess,
                          'Result'  => $result);
            
            return json_encode($aRet);
        }
        else 
        {
            $message = 'Invalid CodPais';
            $sucess  = 'false';
            $result  = '';
            
            $aRet = array('Message' => $message,
                          'Success' => $sucess,
                          'Result'  => $result);
            
            return json_encode($aRet);
        }
    }
    else
    {
        $message = 'Invalid Token.';
        $sucess  = 'false';
        $result  = '';
        
        $aRet = array('Message' => $message,
                      'Success' => $sucess,
                      'Result'  => $result);
        
        return json_encode($aRet);
    }
}

//GetContactCONT
$server->register(
    'GetContactCONT',
    array('token'     => 'xsd:string',
          'codPais'   => 'xsd:string'),
    array('Retorno'   => 'xsd:string'),
    'urn:Server.GetContactCONT',
    'urn:Server.GetContactCONT',
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
    
    if(!empty($aReturn) && $aReturn[0]['timeout_session'] >= $today)
    {
        //Resgata id do Pais
        require_once '../model/Model.php';
        $oBj = new Model();
        $aRet = $oBj->CheckPais($CodPais);
        
        if(!empty($aRet))
        {
            $aDados = $oBj->ListContactCONT($CodPais);
            
            $message = 'Request Success';
            $sucess  = 'true';
            $result  = $aDados;
            
            $aRet = array('Message' => $message,
                          'Success' => $sucess,
                          'Result'  => $result);
            
            return json_encode($aRet);
        }
        else
        {
            $message = 'Invalid CodPais';
            $sucess  = 'false';
            $result  = '';
            
            $aRet = array('Message' => $message,
                          'Success' => $sucess,
                          'Result'  => $result);
            
            return json_encode($aRet);
        }
    }
    else
    {
        $message = 'Invalid Token.';
        $sucess  = 'false';
        $result  = '';
        
        $aRet = array('Message' => $message,
                      'Success'  => $sucess,
                      'Result'  => $result);
        
        return json_encode($aRet);
    }
}

//GetCheckToken
$server->register(
    'GetCheckToken',
    array('token'     => 'xsd:string'),
    array('Retorno'   => 'xsd:string'),
    'urn:Server.GetCheckToken',
    'urn:Server.GetCheckToken',
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
        
        $message = 'Request Success';
        $sucess  = 'true';
        $result  = $aDados;
        
        $aRet = array('Message' => $message,
                      'Success' => $sucess,
                      'Result'  => $result);
        
        return json_encode($aRet);
    }
    else
    {
        $message = 'Invalid Token.';
        $sucess  = 'false';
        $result  = '';
        
        $aRet = array('Message' => $message,
                      'Success' => $sucess,
                      'Result'  => $result);
        
        return json_encode($aRet);
    }
}


$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA); 
   
?>                    

                      
                    
                  
                

                
                  
                    
                    
                      
                        
                        
                      

                      
                        
                        
                      
                   
                  
                