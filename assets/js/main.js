var jq = jQuery.noConflict();

jq(document).ready(function(){

	// Altura dinamica del sidebar
	var main_height = jq('.main').height()+40;
	jq('#left_sidebar').height(main_height);

	// Ventana de confirmación antes de borrar un registro
	jq('.delete').click(function(){
		var text = jq(this).attr('title');
		var borrar = confirm('Estas apunto de '+ text + '\n¿Estas seguro?');
		// si devuelve true el registro sera borrado.
		return borrar;
	});

	// Mostrar campos de contraseña si el checkbox esta marcado
	jq('#checkbox_passwd').click(function(){
		// si el checkbox esta marcado
		if (jq('#change_passwd').is(':checked')){
			jq("#change_passwd").attr('checked', true);		// activar el checkbox poniendo el atributo checked
			jq('.show_passwd').css('display','block');	// muestra los campos contraseña
		}else {
			jq("#change_passwd").attr('checked', false);
			jq('.show_passwd').css('display','none');
		}
	});

	//Botón de acción del acordeón
	jq('.show-list').click(function() {

		//Elimina la clase on de todos los botones
		jq('.show-list').removeClass('on');

		jq('button .glyphicon').removeClass('glyphicon-menu-up');
		jq('button .glyphicon').addClass('glyphicon-menu-down');

		//Plegamos todo el contenido que este abierto
	 	jq('.list').slideUp('slow');

		//If el siguiente slide no esta abierto lo abrimos
		if(jq(this).next().is(':hidden') == true) {

			//Añade la clase on en el botón
			jq(this).addClass('on');
			jq('button.on .glyphicon').removeClass('glyphicon-menu-down');
			jq('button.on .glyphicon').addClass('glyphicon-menu-up');

			//Abre el slide
			jq(this).next().slideDown('slow');
		 }

	 });

	// Lightbox
	jq("[data-fancybox]").fancybox({
		toolbar: false,
		smallBtn: true
	});

}); // Fin document ready


// Busca el valor dentro de la opción de un select y devuelve el indice donde se encuentra
function buscarIndice(id, value){
	var select = document.getElementById(id);

	// recorremos todos los valores del select
	for(var i=1; i<select.length; i++)
	{
		if(select.options[i].text == value) {
			return i;
		}
	}

	return 0;
}

function validateUserForm(){
	var expreg_email = /^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
	var expreg_especial_chars = /[@\+\*\?\¿\]\[\}\{\=\!\¡\)\(\/\&\%\$\#\'\"\;\\\<\>]/;

	var user = jq('#user_name').val();
	var email = jq('#email').val();
	var passwd = jq('#password').val();
	var passwd2 = jq('#password_confirm').val();

	if(user == ''){
		alert('El usuario es obligatorio.');
		jq('#user_name').focus();
		return false;
	} else if(expreg_especial_chars.test(user)){
		alert('El usuario no es valido.\nSolo puedes usar: letras, números, ., _ y -');
		jq('#user_name').val('');
		jq('#user_name').focus();
		return false;
	}

	if(!expreg_email.test(email) && email  == ''){
		alert('El email no es valido.\nEjemplo de eamil valido: mail@server.es');
		jq('#email').val('');
		jq('#email').focus();
		return false;
	}

	if(passwd != ''){
		if(passwd !== passwd2){
			alert('Las contraseñas no coinciden. Vuelve a escribirlas.');
			jq('#password').val('');
			jq('#password_confirm').val('');
			jq('#password').focus();
			return false;
		}

	}

	return true;
}

function validateAlbumForm(){
	var expreg_especial_chars = /[\+\*\]\[\}\{\=\|\$\#\;\\\<\>]/;
	var expreg_fecha = /^[0-9]{4}$/;

	var artista = jq('#artista').val();
	var album = jq('#album').val();
	var fecha = jq('#fecha').val();

	if(artista == ''){
		alert('El artista es obligatorio.');
		jq('#artista').focus();
		return false;
	} else if(expreg_especial_chars.test(artista)){
		alert('Carácteres invalidos.\n +, *, [], {}, =, |, \\, $, #, ;, < >');
		jq('#artista').focus();
		return false;
	}

	if(album == ''){
		alert('El album es obligatorio.');
		jq('#album').focus();
		return false;
	} else if(expreg_especial_chars.test(album)){
		alert('Carácteres invalidos.\n +, *, [], {}, =, |, \\, $, #, ;, < >');
		jq('#album').focus();
		return false;
	}

	if(!expreg_fecha.test(fecha) || fecha == ''){
		alert('La fecha no es valida. Debes escribir el año con 4 dígitos.\nEjemplo 2018');
		jq('#fecha').val('');
		jq('#fecha').focus();
		return false;
	}

	return true;
}

function validateConfig(){
	var expreg_especial_chars = /[@\+\*\?\¿\]\[\}\{\=\!\¡\&\%\$\#\'\"\;\\\<\>]/;
	var expreg_num = /^([0-9])*$/;

	var url_base = jq('#url_base').val();
	var reg_page = jq('#reg_page').val();
	var last_reg = jq('#last_reg').val();
	var select_gen = document.getElementById('genero');
	var add_gen = jq('#add_gen').val();

	if(url_base == ''){
		jq('#url_base').val('/');
	} else if(expreg_especial_chars.test(url_base)){
		alert('El url_base no es valida.\nSolo puedes usar: letras, números, ., _, /, y -');
		jq('#url_base').val('');
		jq('#url_base').focus();
		return false;
	}


	if(!expreg_num.test(reg_page) || reg_page == ''){
		alert('Valor para items por página invalido. Debe ser un número.');
		jq('#reg_page').val('20');
		jq('#reg_page').focus();
		return false;
	}

	if(!expreg_num.test(last_reg) || last_reg == ''){
		alert('Valor para mostrar últimos registros invalido. Debe ser un número.');
		jq('#last_reg').val('5');
		jq('#last_reg').focus();
		return false;
	}

	if (!expreg_especial_chars.test(add_gen) && add_gen != '') {
		// recorremos todos los valores del select
		for(var i=1; i < select_gen.length; i++)
		{
			console.log(select_gen.options[i]);
			if(select_gen.options[i].text.toLowerCase() == add_gen.toLowerCase()) {
				alert('El género '+add_gen+' ya existe.');
				jq('#add_gen').val('');
				jq('#add_gen').focus();
				return false;
			}
		}
	}

	return true;
}

function changeSortIco(elem,cdir){
	// reiniciar las clases
	// removeClass elimina si existen, cualquiera de las clases que se le pasan
	jq("#artista").removeClass('glyphicon-sort-by-alphabet glyphicon-sort-by-alphabet-alt');
    jq("#artista").addClass('glyphicon-sort');

    jq("#album").removeClass('glyphicon-sort-by-alphabet glyphicon-sort-by-alphabet-alt');
    jq("#album").addClass('glyphicon-sort');

    jq("#fecha").removeClass('glyphicon-sort-by-alphabet glyphicon-sort-by-alphabet-alt');
    jq("#fecha").addClass('glyphicon-sort');

    if(cdir == "ASC"){
      jq(elem).removeClass('glyphicon-sort glyphicon-sort-by-alphabet-alt');
      jq(elem).addClass('glyphicon-sort-by-alphabet');
    }else {
      jq(elem).removeClass('glyphicon-sort glyphicon-sort-by-alphabet');
      jq(elem).addClass('glyphicon-sort-by-alphabet-alt');
    }
}

///////////////////// COOKIES ///////////////////////////
function setCookie(cname, cvalue, exhours) {
    var d = new Date();
    d.setTime(d.getTime() + (exhours*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
}

function getCookie(cname) {

  var name = cname + "=";
  var ca = document.cookie.split(';');

  for(var i=0; i < ca.length; i++) {

    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(name) == 0) {
      return decodeURIComponent( c.substring(name.length,c.length) );
    }

  }

  return null;
}


