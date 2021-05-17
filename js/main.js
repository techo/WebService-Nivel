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
	oData.cargo    = $('#cargo').val();
	oData.pais     = $('#pais').val();
	oData.jefe     = $('#jefe').val();
	oData.status   = $('#status').val();
	oData.netsuite = $('#id_netsuite').val();
	oData.subsidiaria = $('#subsidiaria').val();
	
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

function GrabarRegion()
{
	oData          = new Object();	
	oData.acao     = "GrabarRegion";
	oData.nombre   = $('#nombre').val(); 
	oData.codigo   = $('#codigo').val();
	oData.pais     = $('#pais').val();
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

function ListRegion()
{
	oData       = new Object();	
	oData.acao  = "ListRegion";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#regiones').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Regiones!');
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
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/EditUsuario.php/?id="+ id);
}

function SalirUsuario()
{
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/ListUsuario.php?");
}

function EditarUsuario(id)
{
	oData          = new Object();	
	oData.acao     = "EditarUsuario";
	oData.nombre   = $('#nombre').val(); 
	oData.paterno  = $('#paterno').val(); 
	oData.materno  = $('#materno').val();
	oData.mail     = $('#email').val(); 
	oData.cargo    = $('#cargo').val();
	oData.pais     = $('#pais').val();
	oData.jefe     = $('#jefe').val();
	oData.status   = $('#status').val();
	oData.netsuite = $('#id_netsuite').val();
	oData.subsidiaria = $('#subsidiaria').val();
	oData.id       = id;
	
	$.ajax({
				type: "POST",
				url: "http://herramientas.techo.org/aff/ws_soap/controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['Success'] == 'true')
					{
						alert(oData['Message']);
						window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/ListUsuario.php");
					}
					else
					{
						alert(oData['Message']);
					}
				}
			});	
}

function ListaArea()
{
	oData       = new Object();	
	oData.acao  = "ListaArea";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#listagem').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Areas');
			}
		}
	});	
}

function RedirectArea(id)
{
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/EditArea.php/?id="+ id);
}

function SalirArea()
{
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/ListArea.php?");
}

function EditarArea(id)
{
	oData          = new Object();	
	oData.acao     = "EditarArea";
	oData.nombre   = $('#nombre').val(); 
	oData.codigo   = $('#codigo').val(); 
	oData.status   = $('#status').val();
	oData.id       = id;
	$.ajax({
				type: "POST",
				url: "http://herramientas.techo.org/aff/ws_soap/controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['Success'] == 'true')
					{
						alert(oData['Message']);
						window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/ListArea.php");
					}
					else
					{
						alert(oData['Message']);
					}
				}
			});	
}

function ListaCargo()
{
	oData       = new Object();	
	oData.acao  = "ListaCargo";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#listagem').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Cargos');
			}
		}
	});	
}

function RedirectCargo(id)
{
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/EditCargo.php/?id="+ id);
}

function SalirCargo()
{
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/ListCargo.php?");
}

function EditarCargo(id)
{
	oData          = new Object();	
	oData.acao     = "EditarCargo";
	oData.nombre   = $('#nombre').val(); 
	oData.status   = $('#status').val();
	oData.id       = id;
	$.ajax({
				type: "POST",
				url: "http://herramientas.techo.org/aff/ws_soap/controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['Success'] == 'true')
					{
						alert(oData['Message']);
						window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/ListCargo.php");
					}
					else
					{
						alert(oData['Message']);
					}
				}
			});	
}

function ListaPais()
{
	oData       = new Object();	
	oData.acao  = "ListaPais";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#listagem').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Paises');
			}
		}
	});	
}

function ListaRegion()
{
	oData       = new Object();	
	oData.acao  = "ListaRegion";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#listagem').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Regiones');
			}
		}
	});	
}

function RedirectPais(id)
{
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/EditPais.php/?id="+ id);
}

function RedirectRegion(id)
{
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/EditRegion.php/?id="+ id);
}

function SalirPais()
{
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/ListPais.php?");
}

function SalirRegion()
{
	window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/ListRegion.php");
}

function EditarPais(id)
{
	oData          = new Object();	
	oData.acao     = "EditarPais";
	oData.nombre   = $('#nombre').val(); 
	oData.codigo   = $('#codigo').val();
	oData.aff      = $('#aff').val();
	oData.cont     = $('#cont').val();
	oData.status   = $('#status').val();
	oData.id       = id;
	$.ajax({
				type: "POST",
				url: "http://herramientas.techo.org/aff/ws_soap/controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['Success'] == 'true')
					{
						alert(oData['Message']);
						window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/ListPais.php");
					}
					else
					{
						alert(oData['Message']);
					}
				}
			});	
}

function EditarRegion(id)
{
	oData          = new Object();	
	oData.acao     = "EditarRegion";
	oData.nombre   = $('#nombre').val(); 
	oData.codigo   = $('#codigo').val();
	oData.id_pais  = $('#pais').val();
	oData.id       = id;
	$.ajax({
				type: "POST",
				url: "http://herramientas.techo.org/aff/ws_soap/controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['Success'] == 'true')
					{
						alert(oData['Message']);
						window.location.assign("http://herramientas.techo.org/aff/ws_soap/views/ListRegion.php");
					}
					else
					{
						alert(oData['Message']);
					}
				}
			});	
}

function EnviaSenha()
{
	oData          = new Object();	
	oData.acao     = "EnviarSenha";
	oData.correo   = $('#correo').val(); 
	
	$.ajax({
				type: "POST",
				url: "controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['results'])
					{
						alert('Enviada con Exito');
					}
					else
					{
							alert('Error correo no encontrado');
					}
				}
			});	
}

function NovaSenha()
{
	oData          = new Object();	
	oData.acao     = "NovaSenha";
	oData.senha    = $('#newpass').val(); 
	oData.id       = $('#id1').val(); 
	oData.correo   = $('#correo1').val(); 
	
	$.ajax({
				type: "POST",
				url: "controller/client.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['results'])
					{
						alert('Grabado con Exito');
						window.location.href = "http://techo.ecloudapp.site:8084/Nivel";
					}
					else
					{
							alert('Error al Grabar');
					}
				}
			});	
}

function ListaSubsidiaria()
{
	oData       = new Object();	
	oData.acao  = "ComboSubsidiaria";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#combosubsidiaria').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Subsidiaria!');
			}
		}
	});	
}

function TelaSubsidiaria()
{
	oData       = new Object();	
	oData.acao  = "ListaSubsidiaria";
	
	$.ajax({
		type: "POST",
		url: "../controller/client.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$('#combosubsidiaria').html(oData['results']);
			}

			else
			{
				alert('Error al Cargar Subsidiaria!');
			}
		}
	});	
}

