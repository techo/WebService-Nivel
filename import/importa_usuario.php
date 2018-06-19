<?php

//Link da Importacao e de onde por o Arquivo:

// http://herramientas.techo.org/aff/ws_soap/import/importa_usuario.php


$content = file_get_contents('http://herramientas.techo.org/aff/ws_soap/import/OrgData.csv');
$lines = array_map("rtrim", explode("\n", $content));

require_once '../model/Model.php';
$oBj = new Model();

for($i=0; $i < count($lines); $i++)
{
	if($i != 0)
	{
		$dados = explode(";",$lines[$i]);
		
		$aParam[0]['nome']      = utf8_encode($dados[0]);
		$aParam[0]['paterno']   = utf8_encode($dados[1]);
		$aParam[0]['materno']   = utf8_encode($dados[2]);
		$aParam[0]['mail']      = utf8_encode($dados[3]);
		$aParam[0]['password']  = utf8_encode($dados[4]);
		$aParam[0]['cargo']     = utf8_encode($dados[5]);
		$aParam[0]['pais']      = utf8_encode($dados[6]);
		$aParam[0]['jefe']      = utf8_encode($dados[7]);
		$aParam[0]['netsuite']  = utf8_encode($dados[8]);
		$aParam[0]['status']    = utf8_encode($dados[9]);
		$aParam[0]['criador']   = utf8_encode($dados[10]);
		$aParam[0]['alterador'] = utf8_encode($dados[11]);
		$aParam[0]['inclusao']  = utf8_encode($dados[12]);
		$aParam[0]['alteracao'] = utf8_encode($dados[13]);
		
		$aRet = $oBj->ImportaUsuario($aParam);
	}
}

if($aRet)
{
    die(print_r('Importado con Exito'));
}
else
{
    die(print_r('Error al Importar'));
}
		
?>   


 