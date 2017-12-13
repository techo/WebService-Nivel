window.addEventListener('message', function(event) {
      if(event.origin === 'http://herramientas.techo.org')
      //if(event.origin === 'http://nivel.local:8080')
      {
		removeIFrameImageTecho();
      	document.getElementById('txt_nota').value = event.data.message;
      }
      else
      {
        //alert('Origin not allowed!');
      }

    }, false);



function removeIFrameImageTecho(){
	var objs = document.querySelectorAll('div');
	for (var i = 0; i < objs.length; i++) {
		if(objs[i].id == 'techoAppImagenesNivel_div'){
			objs[i].parentNode.removeChild(objs[i]);
		}
	}


	var objs = document.querySelectorAll('iframe');
	for (var i = 0; i < objs.length; i++) {
		if(objs[i].id == 'techoAppImagenesNivel_iframe'){
			objs[i].parentNode.removeChild(objs[i]);
		}
	}
}

function addIFrameImageTecho(){
	document.getElementById('txt_nota').blur();

	var iframe = document.createElement('iframe');
	iframe.id = 'techoAppImagenesNivel_iframe';
	iframe.src = 'http://herramientas.techo.org/aff/imagenes';
	//iframe.src = 'http://nivel.local:8080/aff/imagenes';

	iframe.width = window.innerWidth;
	iframe.height = window.innerHeight-20;
	iframe.style = 'border:0;';

	var closeButton = document.createElement('img');
	closeButton.src = 'http://herramientas.techo.org/aff/imagenes/assets/close.png';
	//closeButton.src = 'http://nivel.local:8080/aff/imagenes/assets/close.png';
	closeButton.width = '20';
	closeButton.height = '20';
	closeButton.style = 'margin-right:20px;cursor:pointer;';
	closeButton.onclick = removeIFrameImageTecho;

	var div = document.createElement('div');
	div.id = 'techoAppImagenesNivel_div';
	div.width = window.innerWidth;
	div.height = window.innerHeight;
	div.style = 'position:fixed; top:0; left:0;z-index:15412845425; background:#FFF; text-align:right;';
	
	div.appendChild(closeButton);
	div.appendChild(iframe);
	document.body.appendChild(div);
}

function iFrameImageTecho_onresize(){
	
	if(typeof window["techoAppImagenesNivel_div"] !== "undefined"){
		document.getElementById('techoAppImagenesNivel_div').width = window.innerWidth;
		document.getElementById('techoAppImagenesNivel_div').height = window.innerHeight;

		document.getElementById('techoAppImagenesNivel_iframe').width = window.innerWidth;
		document.getElementById('techoAppImagenesNivel_iframe').height = window.innerHeight-20;
	}
}

document.getElementById('txt_nota').onclick = addIFrameImageTecho;
window.onresize = iFrameImageTecho_onresize;



