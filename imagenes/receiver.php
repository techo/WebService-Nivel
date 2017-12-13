<?php 
session_start();

require_once '../model/Model.php';
$oBj = new Model();
$aReturn = $oBj->LoginUser($_SESSION['Mail'], $_SESSION['Password']);

if($aReturn)
{
    $returnUrl = '';
    if(@$_FILES['sendFile']['tmp_name'])
    {
        $filename = str_replace(' ', '_', $_FILES['sendFile']['name']) ;
        
        $filename = str_replace('.jpg', '', $filename);
        $filename = str_replace('.JPG', '', $filename);
        
        $filename = str_replace('.jpeg', '', $filename);
        $filename = str_replace('.JPEG', '', $filename);
        
        $filename = str_replace('.png', '', $filename);
        $filename = str_replace('.PNG', '', $filename);
        
        $filename = time().'-'.$filename;
        
        if( substr(strrev( strtolower($filename)), 0, 3) =='fdp')
        {
            $filename = str_replace('.pdf', '', $filename);
            $filename = str_replace('.PDF', '', $filename);
            $filename = $filename.'.pdf';
        }
        else
        {
            $filename = $filename.'.jpeg';
        }
        
        $diretorio = __DIR__.'/repository/'.$_SESSION['Id'];
        
        if (!file_exists($diretorio))
        {
            mkdir("$diretorio", 0777);
        }
        
        $returnUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."/repository/".$_SESSION['Id']."/".$filename;
        
        if(!file_exists(dirname(__FILE__)."/repository"))
        {
            mkdir(dirname(__FILE__)."/repository");
        }
        
        $filename = dirname(__FILE__)."/repository/".$_SESSION['Id']."/".$filename;
        copy($_FILES['sendFile']['tmp_name'],$filename);
        
        $returnUrl = str_replace('/receiver.php', '', $returnUrl);
    }
}
else
{
    die(print_r('Access denied'));
}

?>
<html>
<style>

body{
	text-align:center;
}

#imgButton{
	width:25%;
}
</style>
<script>
<?php
	if(!$returnUrl){
		?>
		alert('Por favor intentar otra vez.	');
		<?php
	}
?>

   window.parent.postMessage({message: '<?php echo $returnUrl; ?>'}, 'http://52.11.91.248:8080');
   window.parent.postMessage({message: '<?php echo $returnUrl; ?>'}, 'http://herramientas.techo.org');
</script>
<body>
	<b>Utilice el siguiente texto en el campo "NOTA" de NIVEL:</b><br><br>
<?php
echo $returnUrl;
 ?>
</body>
</html>