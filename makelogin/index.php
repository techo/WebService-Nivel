<?php

$sufix = '';
if(sizeof($_GET)){
	$sufix = array();
	foreach($_GET as $key => $value){
		$sufix[] = $key.'='.$value;
	}
	$sufix = '?'.implode('&', $sufix);
}

header("Location: ../".$sufix);