<html>
<style>

body{
	text-align:center;
}

#imgButton{
	width:25%;
}
</style>
<body>
	<div id="cameraBox">
		<form method="post" action="receiver.php" enctype="multipart/form-data">
			<input name="sendFile" id="sendFile" type="file" accept="application/pdf,image/*" style="display:none;" onchange="sendBottle()">
			<input id="submitBtn" type="submit" style="display:none;" />
		</form>

		<image id="imgButton" onclick="getFile();" src="assets/upload.png" />
		<div>
			<br>Haga clic en la c&aacute;mara para cargar el documento...
		</div>
	</div>
	<div id="loading" style="display:none;">
		<br><br><br><br>Cargando...
	</div>
<script src="jquery.min.js"></script>
<script>
function sendBottle(){
	$('#cameraBox').hide();
	$('#loading').show();
	document.getElementById('submitBtn').click();
}

function getFile(){
	document.getElementById('sendFile').click();
}
</script>
</body>
</html>