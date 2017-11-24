function Login()
{
	oData          = new Object();	
	oData.acao     = "Login";
	oData.mail     = $('#mail').val(); 
	oData.password = $('#password').val();
	oData.redirect = $('#redirect').val();
	oData.appid    = $('#appid').val();
	$.ajax({
				type: "POST",
				url: "controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['results'])
					{
						$('#teste').attr('action',oData['redirect']);
						$('#token').val(oData['token']);
						$('#teste').submit();
					}
					else
					{
							alert('Invalid User or Password');
					}
				}
			});	
}


function GrabarUsuario()
{
	oData          = new Object();	
	oData.acao     = "GrabarUsuario";
	oData.nombre   = $('#nombre').val(); 
	oData.paterno  = $('#paterno').val(); 
	oData.materno  = $('#materno').val();
	oData.mail     = $('#email').val(); 
	oData.password = $('#password').val();
	oData.area     = $('#area').val();
	oData.cargo    = $('#cargo').val();
	oData.pais     = $('#pais').val();
	oData.jefe     = $('#jefe').val();
	oData.status   = $('#status').val();
	$.ajax({
				type: "POST",
				url: "../controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['Success'] == 'true')
					{
						alert(oData['Message']);
						location.reload();
					}
					else
					{
						alert(oData['Message']);
					}
				}
			});	
}

function GrabarPais()
{
	oData          = new Object();	
	oData.acao     = "GrabarPais";
	oData.nombre   = $('#nombre').val(); 
	oData.codigo   = $('#codigo').val();
	oData.aff      = $('#aff').val();
	oData.cont     = $('#cont').val();
	oData.status   = $('#status').val();
	$.ajax({
				type: "POST",
				url: "../controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['Success'] == 'true')
					{
						alert(oData['Message']);
						window.location.reload();
					}
					else
					{
						alert(oData['Message']);
					}
				}
			});	
}

function GrabarArea()
{
	oData          = new Object();	
	oData.acao     = "GrabarArea";
	oData.nombre   = $('#nombre').val(); 
	oData.codigo   = $('#codigo').val();
	oData.status   = $('#status').val();
	$.ajax({
				type: "POST",
				url: "../controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['Success'] == 'true')
					{
						alert(oData['Message']);
						window.location.reload();
					}
					else
					{
						alert(oData['Message']);
					}
				}
			});	
}

function LimpiarGenerico()
{
	 $('#nombre').val("");
	 $('#codigo').val("");
	 $("#status").val(0);
}

function LimpiarCargo()
{
	 $('#nombre').val("");
	 $("#status").val(0);
}

function GrabarCargo()
{
	oData          = new Object();	
	oData.acao     = "GrabarCargo";
	oData.nombre   = $('#nombre').val(); 
	oData.status   = $('#status').val();
	$.ajax({
				type: "POST",
				url: "../controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['Success'] == 'true')
					{
						alert(oData['Message']);
						window.location.reload();
					}
					else
					{
						alert(oData['Message']);
					}
				}
			});	
}

function LimpiarUsuario()
{
	 $('#nombre').val("");
	 $('#email').val("");
	 $('#password').val("");
	 $('#paterno').val("");
	 $('#materno').val("");
	 $('#email').val("");
	 $("#area").val(0);
	 $("#cargo").val(0);
	 $("#area").val(0);
	 $("#jefe").val(0);
	 $("#status").val(0);
}

function ListArea()
{
	oData       = new Object();	
	oData.acao  = "ListArea";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#areas').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Areas!');
			}
		}
	});	
}

function ListCargo()
{
	oData       = new Object();	
	oData.acao  = "ListCargo";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#cargos').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Cargos!');
			}
		}
	});	
}

function ListPais()
{
	oData       = new Object();	
	oData.acao  = "ListPais";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#paises').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Pais!');
			}
		}
	});	
}

function ListJefe()
{
	oData       = new Object();	
	oData.acao  = "ListJefe";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#jefes').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Jefes!');
			}
		}
	});	
}

function ListContactAFF()
{
	oData       = new Object();	
	oData.acao  = "ListContactAFF";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#contactAff').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar ContatctAFF!');
			}
		}
	});	
}

function ListContactCONT()
{
	oData       = new Object();	
	oData.acao  = "ListContactCONT";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#contactCont').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Contact CONT!');
			}
		}
	});	
}

function ListUsuarios()
{
	oData       = new Object();	
	oData.acao  = "ListUsuarios";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#usuario').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Usuarios');
			}
		}
	});	
}

function EditarUser(id)
{
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/EditUsuario.php/?id="+ id)
}


