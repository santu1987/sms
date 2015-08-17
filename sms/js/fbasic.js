// JavaScript Document
////////////////////////////////////////////////////////////////
//Declaro la variable intervalo... la cual será global
var intervalo;
////////////////////////////////////////////////////////////////
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
////////////////////////////////////////////////////////////////
function ucwords (str) {
  // http://kevin.vanzonneveld.net
  // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // +   improved by: Waldo Malqui Silva
  // +   bugfixed by: Onno Marsman
  // +   improved by: Robin
  // +      input by: James (http://www.james-bell.co.uk/)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // *     example 1: ucwords('kevin van  zonneveld');
  // *     returns 1: 'Kevin Van  Zonneveld'
  // *     example 2: ucwords('HELLO WORLD');
  // *     returns 2: 'HELLO WORLD'
  return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function ($1) {
    return $1.toUpperCase();
  });
}
////////////////////////////////////////////////////////////////
function IsNumeric(valor) 
{ 
var log=valor.length; var sw="S"; 
for (x=0; x<log; x++) 
{ v1=valor.substr(x,1); 
v2 = parseInt(v1); 
//Compruebo si es un valor num?rico 
if (isNaN(v2)) { sw= "N";} 
} 
if (sw=="S") {return true;} else {return false; } 
} 

var primerslap=false; 
var segundoslap=false; 
function formateafecha(fecha) 
{ 
var long = fecha.length; 
var dia; 
var mes; 
var ano; 

if ((long>=2) && (primerslap==false)) { dia=fecha.substr(0,2); 
if ((IsNumeric(dia)==true) && (dia<=31) && (dia!="00")) { fecha=fecha.substr(0,2)+"/"+fecha.substr(3,7); 

primerslap=true; } 
else { fecha=""; primerslap=false;} 
} 
else 
{ dia=fecha.substr(0,1); 
if (IsNumeric(dia)==false) 
{fecha="";} 
if ((long<=2) && (primerslap=true)) {fecha=fecha.substr(0,1); primerslap=false; } 
} 
if ((long>=5) && (segundoslap==false)) 
{ mes=fecha.substr(3,2); 
if ((IsNumeric(mes)==true) &&(mes<=12) && (mes!="00")) { fecha=fecha.substr(0,5)+"/"+fecha.substr(6,4); 

segundoslap=true; } 
else { fecha=fecha.substr(0,3);; segundoslap=false;} 
} 
else { if ((long<=5) && (segundoslap=true)) { fecha=fecha.substr(0,4); segundoslap=false; } } 
if (long>=7) 
{ ano=fecha.substr(6,4); 
if (IsNumeric(ano)==false) { fecha=fecha.substr(0,6); } 
else { if (long==10){ if ((ano==0) || (ano<1900) || (ano>2100)) { fecha=fecha.substr(0,6); } } } 
} 

if (long>=10) 
{ 
fecha=fecha.substr(0,10); 
dia=fecha.substr(0,2); 
mes=fecha.substr(3,2); 
ano=fecha.substr(6,4); 
// A?o no viciesto y es febrero y el dia es mayor a 28 
if ( 
((ano%4 != 0) && (mes ==02) && (dia > 28)) || 
((mes ==02) && (dia >= 30)) || 
((mes ==02) && (dia >= 31)) || 
((mes ==04) && (dia >= 31)) || 
((mes ==06) && (dia >= 31)) || 
((mes ==09) && (dia >= 31)) || 
((mes ==11) && (dia >= 31)) 
)

{ fecha=fecha.substr(0,2)+"/";} 
} 

return (fecha); 
} 
//fin de validacion de fechas
//validar que una fecha no sea mayor a otra
function fecha_mayor(fecha,valor2)
{
   var fecha_actual=new Date();
   var dia2=fecha_actual.getDate();
   var mes2=parseInt(fecha_actual.getMonth())+1;
   var ano2=fecha_actual.getFullYear();
   var fecha_ac=dia2+"/"+mes2+"/"+ano2; 
   /////////////////////////////////
   var anio = parseInt(fecha.substring(6,10));
   var mes = fecha.substring(3,5);
   var dia = fecha.substring(0,2);
    ///////////////////////////////////////
    if(anio>ano2)
    {
       document.getElementById(valor2).value=""; 
       return("true");
    }else
    {
         if(anio==ano2)
        {
            if(mes>mes2)
            {
               document.getElementById(valor2).value=""; 
              return("true");
            }else
            if(mes==mes2)
            {
                if(dia>dia2)
                {
                   document.getElementById(valor2).value="";
                  return("true");
                }
                    
            }    
        }
    }
   
}
/////////////////////////////////////////////
function fecha_long(valor,valor2)
{
    if(valor.length<10)
    {
            document.getElementById(valor2).value="";
    }    
}
/////////////////////////////////////////funciones q crean los tips
//////////////////////////////////////////////////////////////////////////////////////////////
//funcion que crea los tooltips
function getList(objSelect, onlySelect)
{
	var cadArray='';
	var spl='';
	var j=0;
	for(var i=0;i<document.getElementById(objSelect).options.length;i++) 
	{		
		if (onlySelect)
		{
			if (j!=0) spl=',';			
			if (document.getElementById(objSelect).options[i].selected) 
			{
				cadArray=cadArray+spl+document.getElementById(objSelect).options[i].value;
				j++;
			}
		}
		else
		{
			if (i!=0) spl=',';
			cadArray=cadArray+spl+document.getElementById(objSelect).options[i].value;
		}
	}
	return cadArray;
}
function dataForm(nombre_form)
{
	
	var NumCampos = nombre_form.length;
	//alert(NumCampos);
	var i = 0;
	var post_to_get='';
	while (i <= (NumCampos-1))
	{
		if (i != 0)
		{
			post_to_get += "&";
		}
		if (nombre_form.elements[i].tagName=='SELECT' && nombre_form.elements[i].multiple)
		{
			post_to_get += nombre_form.elements[i].name + "=";
			post_to_get += getList(nombre_form.elements[i].name);
		
		}
		else if (nombre_form.elements[i].type=='checkbox')
		{
			post_to_get += nombre_form.elements[i].name + "=";
			post_to_get +=nombre_form.elements[i].checked;
		}		
		else
		{
			if(!nombre_form.elements[i].disabled){
				post_to_get += nombre_form.elements[i].name + "=";
				post_to_get += nombre_form.elements[i].value; 
			}
		}
		i++; 
	}
	return post_to_get;
}
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//crea tiop para los mensajes de error
/*jQuery.fn.creaTip2= function(textoTip, opciones,xa,ya,clase){
		//opciones por defecto
		var configuracion={
			velocidad:1500,
			animacionMuestra: {opacity: "show"},
			animacionOculta: {opacity: "hide"},
			claseTip: clase
		}	
       jQuery.extend(configuracion, opciones);
		this.each(function(){
			elem=$(this);
			var miTip = $('<div class="' + configuracion.claseTip + '"><img align="left" id="cancel" src=imagenes/iconos/cancel.ico>' + textoTip +'</div>');
			$(document.body).append(miTip);
			elem.data("capatip", miTip);
			//asigno el valor q guarde a la var mi tip
					var miTip = $(this).data("capatip");
			
			miTip.css({

				left: ya,
				top: xa

			});
			miTip.animate(configuracion.animacionMuestra, configuracion.velocidad);
			var miTip = $(this).data("capatip");
			miTip.animate(configuracion.animacionOculta, configuracion.velocidad);
			//});
		});
		//			
			return this;
	};*/

/////////////////////////////////////////validaciones
function letras(campo,mensaje)
{
//alert("entro");
  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú";
  var checkStr = campo.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  //en caso de q no sea un caracter valido
 if (!allValid) { 
					$("#cuadro_mensaje").fadeIn();
					$(mensaje).html("Campo invalido, ingrese solo caracteres texto");
					campo.value="";
					//$(formu).creaTip2("Campo invalido, ingrese solo caracteres texto","",px,py,clase);
  					} 
}
function letras_numeros(campo,mensaje)
{
//alert("entro");
  var checkOK = "ABCDEFGHIJKLMN�OPQRSTUVWXYZ" + "abcdefghijklmn�opqrstuvwxyz" + "1234567890";
  var checkStr = campo.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  //en caso de q no sea un caracter valido
 if (!allValid) { 
			$("#cuadro_mensaje").fadeIn();
			$(mensaje).html("Campo invalido, ingrese solo caracteres texto o n&uacute;mericos");
//$(formu).mensaje("Campo invalido, ingrese solo caracteres texto o n&uacute;mericos","",px,py,clase);
			campo.value="";
			}
			
}
/////////////////////////////////

////////////////////////////funcion letras/numeros con espacios
function letras_numeros_blanco(campo,px,py,clase,formu)
{
//alert("entro");
  var checkOK = "ABCDEFGHIJKLMN�OPQRSTUVWXYZ " + "abcdefghijklmn�opqrstuvwxyz " + "1234567890 " + " ";
  var checkStr = campo.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  //en caso de q no sea un caracter valido
 if (!allValid) { 
					campo.value="";
					$("#cuadro_mensaje").fadeIn();
					$(formu).creaTip2("Campo invalido, ingrese solo caracteres texto o n&uacute;mericos","",px,py,clase);
  					} 
}
////////////////////////////funcion para fatos numericos
function numeros(campo,mensaje)
{
//alert("entro");
  var checkOK = "1234567890";
  var checkStr = campo.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  //en caso de q no sea un caracter valido
 if (!allValid) { 
					campo.value="";
					$("#cuadro_mensaje").fadeIn();
					$(mensaje).html("Campo invalido, ingrese solo caracteres n&uacute;mericos");
					//$(formu).creaTip2("Campo invalido, ingrese solo caracteres n&uacute;mericos","",px,py,clase);
  					} 
}
////////////////////////////funcion para valida email
function correo(campo)
{
var exr = /^\w+[a-z_0-9\-\.]+@\w+[0-9a-z\-\.]+\.[a-z]{2,4}$/i;
  if(!(exr.test(campo.value)))
  {
		campo.value="";
		//$(mensaje).html("Email invalido, ingrese una direcci�n de correo valida");
		//$(formu).creaTip2("Email invalido, ingrese una direcci�n de correo valida ","",px,py,clase);  	
  }

}
function correo2(campo)
{
var exr = /^\w+[a-z_0-9\-\.]+@\w+[0-9a-z\-\.]+\.[a-z]{2,4}$/i;
  if(!(exr.test(campo.value)))
  {
		campo.value="";
		 	
  }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//funcion para gestionar claves
function claves(campo,mensaje)
{
	var checkStr = campo.value;
		if((checkStr.length>=10)||(checkStr.length<5))
		{
  		campo.value="";
  		$("#cuadro_mensaje").fadeIn();
  		$(mensaje).html("Ingrese m&iacute;nimo 5 caracteres M&aacute;ximo 10");
  		//$(formu).creaTip2("Ingrese minimo 5 caracteres maximo 10 ","",px,py,clase);
		}
}

//funcion que elimina espacion en blanco
function trim (myString)
{
	return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}

//limpiar cuadro de informacion llaad mensaje principal
function limpiar_cuadro(mensaje,principal)
{
	//alert("a");
	$(principal).fadeOut();
	//	$(mensaje).html("");
}
//					Obtener el valor de un combo
function getSelect(id_objeto)
{
	return document.getElementById(id_objeto).options[document.getElementById(id_objeto).selectedIndex].value;	
}
////////////////////////// funcion que valida sin mensaje y sin borrar
////////////////////////letras:
function letras2(campo)
{
//alert("entro");
  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú"+ " ";
  var checkStr = campo.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  //en caso de q no sea un caracter valido
 if (!allValid) { 
					//$("#cuadro_mensaje").fadeIn();
					//$(mensaje).html("Campo invalido, ingrese solo caracteres texto");
					var cadena=campo.value;
					var longitud=cadena.length-1;
					var valor=cadena.substring(0,longitud);
					//alert(valor);
					campo.value=valor;
					//$(formu).creaTip2("Campo invalido, ingrese solo caracteres texto","",px,py,clase);
  					} 
}
/////////////////////////////////////////////////////////////
function letra_s(campo)
{
//alert("entro");
  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú"+ "_";
  var checkStr = campo.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  //en caso de q no sea un caracter valido
 if (!allValid) { 
					//$("#cuadro_mensaje").fadeIn();
					//$(mensaje).html("Campo invalido, ingrese solo caracteres texto");
					var cadena=campo.value;
					var longitud=cadena.length-1;
					var valor=cadena.substring(0,longitud);
					//alert(valor);
					campo.value=valor;
					//$(formu).creaTip2("Campo invalido, ingrese solo caracteres texto","",px,py,clase);
  					} 
}
//////////letras numeros2
function letras_numeros2(campo)
{
//alert("entro");
  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ " + "abcdefghijklmnñopqrstuvwxyzáéíóú " + "1234567890 " + " " + "_"+ ","+ ".";
  var checkStr = campo.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  //en caso de q no sea un caracter valido
 if (!allValid) { 
					var cadena=campo.value;
					var longitud=cadena.length-1;
					var valor=cadena.substring(0,longitud);
					//alert(valor);
					campo.value=valor;
  				} 
}
//letras_numers pero sin espacio vacios
function letras_numeros3(campo)
{
//alert("entro");
  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ " + "abcdefghijklmnñopqrstuvwxyzaeiou " + "1234567890 " + "_";
  var checkStr = campo.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  //en caso de q no sea un caracter valido
 if (!allValid) { 
					var cadena=campo.value;
					var longitud=cadena.length-1;
					var valor=cadena.substring(0,longitud);
					//alert(valor);
					campo.value=valor;
  				} 
}
///////////////////////////
function numeros2(campo)
{
	
//alert("entro");
  var checkOK = "1234567890";
  var checkStr = campo.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  //en caso de q no sea un caracter valido
 if (!allValid) { 
					var cadena=campo.value;
					var longitud=cadena.length-1;
					var valor=cadena.substring(0,longitud);
					//alert(valor);
					campo.value=valor;
  					} 
}
//////////////////////////////////////////////////

//////////////////////////////////////////////////
function numeros_dec(campo)
{
	
//alert("entro");

      var checkOK = "1234567890,";
      var checkStr = campo.value;
      var allValid = true; 
      for (i = 0; i < checkStr.length; i++) {
        ch = checkStr.charAt(i); 
        for (j = 0; j < checkOK.length; j++)
          if (ch == checkOK.charAt(j))
            break;
        if (j == checkOK.length) { 
          allValid = false; 
          break; 
        }
      }
      //en caso de q no sea un caracter valido
     if (!allValid) { 
                                            var cadena=campo.value;
                                            var longitud=cadena.length-1;
                                            var valor=cadena.substring(0,longitud);
                                            //alert(valor);


                                                campo.value=valor;
                                            } 
     
}

//////////////////////////////////////////////////
//funcion para validar longitud
function longitud(campo, valorMax, valorMin)
{
	var cadena= campo.value;
	var longitud= cadena.length;
	if((longitud > valorMax)||(longitud < valorMin))
	{
		campo.value="";
	}
}
//////////////////////////////////////////////////
//// esta funcion permite colocar la edad en los campos requeridos:proviene de vista_registrar_historia.php
/////
function fecha_edad(fecha)
{
	//
	actual=document.getElementById("hoy").value;
	arreglo_hoy=actual.split("/");
	arreglo_fecha=fecha.split("/");
	var ano=parseInt(arreglo_fecha[2]);
	if(isNaN(ano))
	{
		return false;
	}
	var mes=parseInt(arreglo_fecha[1]);
	if(isNaN(mes))
	{
		return false;
	}
	var dia=parseInt(arreglo_fecha[0]);
	if(isNaN(dia))
	{
		return false;
	}
	edad= arreglo_hoy[2]-ano-1;
	//
	if(arreglo_hoy[1]+1-mes<0)
	{
		return edad;
	}
	if(arreglo_hoy[1]+1-mes>20)
	{
		edad=edad+1;
		return edad;
	}
	if(arreglo_hoy[0]-actual>=0)
	{
		edad=edad+1;
		return edad;
	}
	/////////////////////////////////////
	return edad;
}
/////
function colocar_edad()
{
	
	//
	 var edad= fecha_edad(document.getElementById("fecha_n_paciente").value);
	//alert(edad);
	 document.getElementById("edad_paciente").value=edad;	
	//	
}
///
function colocar_edad2()
{
	//
	 var edad= fecha_edad(document.getElementById("fecha_n_pareja").value);
	 document.getElementById("edad_pareja").value=edad;	
	//	
}
////
function mensajes_emergentes(div,mensaje,titulo)
{
   // $(div).removeATTR("title",titulo);
    $(div).attr("title",titulo);
    $(div).html(mensaje);
    //$(div).dialog();
    $(div).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });  
}
/////////////
//
function salir_sistema(div)
{
   $(div).attr("title","Información:");
    $(div).html("Desea realmente salir del Sistema");
    //$(div).dialog();
    $(div).dialog({
      modal: true,
      buttons: {
        Si: function()
        {
          $( this ).dialog( "close" );
          window.location = "../sis_preescolar/";
        },
        No:function()
        {
            $(this).dialog("close");
        }
      }  
    });   
    
}
/////////////////////////////////////////////////////////////////////////////////////////
function salir_sistema2(div)
{
   $(div).attr("title","Información:");
    $(div).html("Se debe dirigir al preescolar con todos los requisitos necesarios del 03 al 07 de junio de 2013(alumnos nuevo ingreso) y de 10 al 21 de junio de 2013(alumnos regulares), para formalizar la inscripción.No es necesario hacer colas ya que disponemos de suficientes cupos");
    //$(div).dialog();
    $(div).dialog({
      modal: true,
      buttons: {
        Salir: function()
        {
          $( this ).dialog( "close" );
          window.location = "../sis_preescolar/";
        },
        Cancelar :function()
        {
            $(this).dialog("close");
        }
      }  
    });   
    
}
/////////////////////////////////////////////////////////////////////////////////////////
///* ------------------ Sub-Mascara jquery_moneda   ---------------------------*/
documentall = document.all;


function formatamoney(c) {
    var t = this; if(c == undefined) c = 2;		
    var p, d = (t=t.split("."))[1].substr(0, c);
    for(p = (t=t[0]).length; (p-=3) >= 1;) {
	        t = t.substr(0,p) + "." + t.substr(p);
    }
    return t+","+d+Array(c+1-d.length).join(0);
}

String.prototype.formatCurrency=formatamoney

function demaskvalue(valor, currency){

var val2 = '';
var strCheck = '0123456789';
var len = valor.length;
	if (len== 0){
		return 0.00;
	}

	if (currency ==true){	

		
		for(var i = 0; i < len; i++)
			if ((valor.charAt(i) != '0') && (valor.charAt(i) != ',')) break;
		
		for(; i < len; i++){
			if (strCheck.indexOf(valor.charAt(i))!=-1) val2+= valor.charAt(i);
		}

		if(val2.length==0) return "0.00";
		if (val2.length==1)return "0.0" + val2;
		if (val2.length==2)return "0." + val2;
		
		var parte1 = val2.substring(0,val2.length-2);
		var parte2 = val2.substring(val2.length-2);
		var returnvalue = parte1 + "." + parte2;
		return returnvalue;
		
	}
	else{
			val3 ="";
			for(var k=0; k < len; k++){
				if (strCheck.indexOf(valor.charAt(k))!=-1) val3+= valor.charAt(k);
			}			
	return val3;
	}
}

function reais(obj,event){

var whichCode = (window.Event) ? event.which : event.keyCode;

if (whichCode == 8 && !documentall) {	

	if (event.preventDefault){ //standart browsers
			event.preventDefault();
		}else{ // internet explorer
			event.returnValue = false;
	}
	var valor = obj.value;
	var x = valor.substring(0,valor.length-1);
	obj.value= demaskvalue(x,true).formatCurrency();
	return false;
}

FormataReais(obj,'.',',',event);
} // end reais


function backspace(obj,event){


var whichCode = (window.Event) ? event.which : event.keyCode;
if (whichCode == 8 && documentall) {	
	var valor = obj.value;
	var x = valor.substring(0,valor.length-1);
	var y = demaskvalue(x,true).formatCurrency();

	obj.value =""; 
	obj.value += y;
	
	if (event.preventDefault){ 
			event.preventDefault();
		}else{ // internet explorer
			event.returnValue = false;
	}
	return false;

	}		
}

function FormataReais(fld, milSep, decSep, e) {
var sep = 0;
var key = '';
var i = j = 0;
var len = len2 = 0;
var strCheck = '0123456789';
var aux = aux2 = '';
var whichCode = (window.Event) ? e.which : e.keyCode;

if (whichCode == 0 ) return true;
if (whichCode == 9 ) return true; //tecla tab
if (whichCode == 13) return true; //tecla enter
if (whichCode == 16) return true; //shift internet explorer
if (whichCode == 17) return true; //control no internet explorer
if (whichCode == 27 ) return true; //tecla esc
if (whichCode == 34 ) return true; //tecla end
if (whichCode == 35 ) return true;//tecla end
if (whichCode == 36 ) return true; //tecla home


if (e.preventDefault){ 
		e.preventDefault()
	}else{ 
		e.returnValue = false
}

var key = String.fromCharCode(whichCode);  
if (strCheck.indexOf(key) == -1) return false;  

fld.value += key;

var len = fld.value.length;
var bodeaux = demaskvalue(fld.value,true).formatCurrency();
fld.value=bodeaux;

  if (fld.createTextRange) {
    var range = fld.createTextRange();
    range.collapse(false);
    range.select();
  }
  else if (fld.setSelectionRange) {
    fld.focus();
    var length = fld.value.length;
    fld.setSelectionRange(length, length);
  }
  return false;

}
////////////////////////////////////////////
////para codificar los parametros que paso por url
function base64_encode (data) {
  // http://kevin.vanzonneveld.net
  // +   original by: Tyler Akins (http://rumkin.com)
  // +   improved by: Bayron Guevara
  // +   improved by: Thunder.m
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   bugfixed by: Pellentesque Malesuada
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Rafał Kukawski (http://kukawski.pl)
  // *     example 1: base64_encode('Kevin van Zonneveld');
  // *     returns 1: 'S2V2aW4gdmFuIFpvbm5ldmVsZA=='
  // mozilla has this native
  // - but breaks in 2.0.0.12!
  //if (typeof this.window['btoa'] == 'function') {
  //    return btoa(data);
  //}
  var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    enc = "",
    tmp_arr = [];

  if (!data) {
    return data;
  }

  do { // pack three octets into four hexets
    o1 = data.charCodeAt(i++);
    o2 = data.charCodeAt(i++);
    o3 = data.charCodeAt(i++);

    bits = o1 << 16 | o2 << 8 | o3;

    h1 = bits >> 18 & 0x3f;
    h2 = bits >> 12 & 0x3f;
    h3 = bits >> 6 & 0x3f;
    h4 = bits & 0x3f;

    // use hexets to index into b64, and append result to encoded string
    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
  } while (i < data.length);

  enc = tmp_arr.join('');

  var r = data.length % 3;

  return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);

}
////
function base64_decode (data) {
  // http://kevin.vanzonneveld.net
  // +   original by: Tyler Akins (http://rumkin.com)
  // +   improved by: Thunder.m
  // +      input by: Aman Gupta
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   bugfixed by: Onno Marsman
  // +   bugfixed by: Pellentesque Malesuada
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // *     example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==');
  // *     returns 1: 'Kevin van Zonneveld'
  // mozilla has this native
  // - but breaks in 2.0.0.12!
  //if (typeof this.window['atob'] == 'function') {
  //    return atob(data);
  //}
  var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    dec = "",
    tmp_arr = [];

  if (!data) {
    return data;
  }

  data += '';

  do { // unpack four hexets into three octets using index points in b64
    h1 = b64.indexOf(data.charAt(i++));
    h2 = b64.indexOf(data.charAt(i++));
    h3 = b64.indexOf(data.charAt(i++));
    h4 = b64.indexOf(data.charAt(i++));

    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

    o1 = bits >> 16 & 0xff;
    o2 = bits >> 8 & 0xff;
    o3 = bits & 0xff;

    if (h3 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1);
    } else if (h4 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1, o2);
    } else {
      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
    }
  } while (i < data.length);

  dec = tmp_arr.join('');

  return dec;
}
//////////////////////////////////////////// funciones para manejar los modal BOOTSTRAP

function crear_modal(numero)
{
  var vector= new Array(19);
  vector[0]="<i class='fa fa-check fa-2x' style='color:#16E91D'></i> Operaci&oacute;n realizada de manera exitosa";
  vector[1]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, los valores suministrados no concuerdan con el usuario";
  vector[2]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E91616'></i> Disculpe, ha ocurrido un error inesperado de base de datos";
  vector[3]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, ha ocurrido un error desconocido";
  vector[4]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, debe ingresar todos los campos del formulario";
  vector[5]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Debe ingresar un n&uacute;mero de tlf con 11 d&iacute;gitos, considerando el c&oacute;digo de cada operadora";  
  vector[6]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E91616'></i> Disculpe ha ocurrido un error en el procesamiento de la consulta";
  vector[7]="<i class='fa fa-check fa-2x' style='color:#16E91D'></i> EL archivo se ha guardado correctamente";
  vector[8]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe el archivo no se ha podido subir..";
  vector[9]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe el archivo debe tener el formato .scv";
  vector[10]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe la contraseña no es igual a la contraseña de verificacion..";
  vector[11]="<i class='fa fa-check fa-2x' style='color:#16E91D'></i> Se ha actualizado la informacion con exito"; 
  vector[12]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, no puede seleccionar mas de un modem";
  vector[13]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, no existe el sms seleccionado en la bandeja de entrada";
  vector[14]="<i class='fa fa-check fa-2x' style='color:#16E91D'></i> Eliminaci&oacute;n de sms procesada de manera exitosa";
  vector[15]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, no puede eliminar todas las filas";
  vector[16]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, ha ocurrido un error en el proceso de auditoria";
  vector[17]="<i class='fa fa-exclamation-triangle fa-2x' style='color:#E9E216'></i> Disculpe, debe seleccionar al menos un sms";
  var cuerpo='<h4>'+vector[numero]+'</h4>';
  var cabecera='<h3 class="modal-title" id="myModalLabel" name="myModalLabel" >Informaci&oacute;n:</h3>';
  $("#cabecera_mensaje").html(cabecera);
  $("#cuerpo_mensaje").html(cuerpo);
}
//////////////////////////////////////////////////////////
//funcion para crear estructura modal preconfigurado por el usuario
function crear_modal2(numero)
{
  
  var cuerpo='<h4>'+numero+'</h4>';
  var cabecera='<h3 class="modal-title" id="myModalLabel" name="myModalLabel" >Informaci&oacute;n:</h3>';
  $("#cabecera_mensaje").html(cabecera);
  $("#cuerpo_mensaje").html(cuerpo);
}
function mensajes2(numero)
{
  //alert("entro");
  crear_modal2(numero);
  $("#modal_mensaje").modal("show");
}
///////////////////////////////////////////////////////////////////////
//funcion para crear modal con cuerpo de mensaje creado por el usuario
function mensajes_configurado(cuerpo_mensaje)
{
  //alert("entro");
  crear_modal_configurado(cuerpo_mensaje);
  $("#modal_mensaje").modal('hide');
 
}
///////////////////////////////////////////////////////
//funcion inicial de mensajes modal
function mensajes(numero)
{
  //alert("entro");
  crear_modal(numero);
  $("#modal_mensaje").modal("show");
}
////////////////////////////////////////////////funcion que retorna a la pag de consulta
function volver_buscar(valor)
{
   var tipo_consulta=valor;
   $('#titleh1').html('B&uacute;squeda:');
   $('#cuerpo_centro').load('./modulos/busquedas/db/buscar_tipos.php?tipo_consulta='+tipo_consulta);
}
/////////////////////////////////////////////////////////////////////////////////////////
//funciones de validaciones
function valida(e,s,i,l)
{   
  tecla = (document.all) ? e.keyCode : e.which; 
  
  if (tecla==8 || tecla==0 || tecla==13) return true;
  if (s.value.length>=l) return false;
        
  if (i==0) patron = /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz]/;  // 0 Solo acepta letras
  if (i==1) patron = /[0123456789,.%]/;     // 1 Solo acepta n�meros
  if (i==2) patron = /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789]/;      // 2 Acepta n�meros y letras
  if (i==3) patron = /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789��������������\s]/;
  if (i==4) patron=  /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz��������������\s]/;
  if (i==5) patron=  /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@._-]/; // Formato Correo Electronico
  if (i==6) patron=  /[ABCDEFabcdef0123456789]/;
  if (i==7) patron = /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789��������������()@:;_\-.,/\s]/;
  if (i==8) patron = /[01]/;
  if (i==9) patron = /[GJV0123456789]/; //Formato de RIF
  if (i==10)patron = /[0123456789]/;
  if (i==11)patron = /[abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789. %()_-]/; 
  if (i==12)patron = /[gjveGJVE0123456789]/;  //RIF
  if (i==13) patron = /[0123456789,]/; 
  if (i==14) patron=  /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789._-]/; // Formato Nick Correo Electronico
  if (i==15) patron=  /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@.]/; // Formato direccion manual Correo Electronico
  if (i==16) patron = /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz\s,]/;  // 0 Solo acepta letras y comas
  if (i==17) patron = /[ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz0123456789\s,.]/; // 2 Acepta n�meros, letras, espacios ,.
  if (i==18) patron = /[ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz0123456789\s,.@#$]/; // 2 Acepta n�meros, letras, espacios ,.
      
  te = String.fromCharCode(tecla);
  return patron.test(te);
} 

function valida2(s,i,l)
{
  
  
  if (i==0) patron = /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz]/;  // 0 Solo acepta letras
  if (i==1) patron = /[0123456789,.%]/;     // 1 Solo acepta n�meros
  if (i==2) patron = /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789]/;      // 2 Acepta n�meros y letras
  if (i==3) patron = /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789��������������\s]/;
  if (i==4) patron=  /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz��������������\s]/;
  if (i==5) patron=  /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@._-]/;
  if (i==6) patron=  /[ABCDEFabcdef0123456789]/;
  if (i==7) patron = /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789��������������()@:;_\-.,/\s]/;
  if (i==8) patron = /[01]/;
  if (i==9) patron = /[GJV0123456789]/;
  if (i==10)patron = /[0123456789]/;
  if (i==11)patron = /[abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789. %()_-]/;   
  if (i==12)patron = /[gjveGJVE0123456789]/;  //RIF
  if (i==13) patron = /[0123456789,]/; 
  if (i==14) patron =  /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789._-]/; // Formato Nick Correo Electronico
  if (i==15) patron =  /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@.]/; // Formato direccion manual Correo Electronico
  if (i==16) patron = /[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz,]/;  // 0 Solo acepta letras y comas
  if (i==17) patron = /[ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz0123456789\s,.]/; // 2 Acepta n�meros, letras, espacios ,.
  if (i==18) patron = /[ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz0123456789\s,.@#$]/; // 2 Acepta n�meros, letras, espacios ,.
  
  r="";
  ll=0;
  for (i=0;i<s.value.length;i++)
  {
    if (patron.test(s.value.charAt(i)))
    {
      r=r+s.value.charAt(i);
      ll++;
      if (ll==l) break;
    }
  }
  
  return s.value=r;
}

//////////////////////////////////////////////////////////////////////////////////////////
//funcion que redirecciona al index...
function redireccionar()
{
   //window.location.href="../../../index.php";
   var dir='index.php';
   window.location.href=dir;
}
//funcion que valida que las cajas text no cuentes con comas al final de todas las cedulas
function validar_cuadro_cedulas(caja_cedulas)
{
  var obj_cedula=document.getElementById(caja_cedulas).value;
  var longitud=obj_cedula.length;
  var ultimo_caracter=obj_cedula.substr(longitud-1,1);
  if(ultimo_caracter==",")
  {
    document.getElementById(caja_cedulas).value=obj_cedula.substr(0,longitud-1);
  }  
}
//funcion que obliga al usuario que coincidan dos claves
function claves_coincidir(campo,campo2)
{
  if(campo.value!=campo2.value)
  {
    campo.value="";
    campo2.value="";
    campo2.focus();
    //$(formu).creaTip2("Las claves deben coincidir ","",px,py,clase);
  } 
}
//funcion que formatea el numero de tlf
function formato_tlf(tlf)
{
   var telefono=tlf.value.substring(0,4);
    var longitud=tlf.value.length;
    var telefono_local=tlf.value.substring(0,2);
    var longitud_local=tlf.value.length;
    if(((telefono!="0412")&&(telefono!="0414")&&(telefono!="0416")&&(telefono!="0426")&&(telefono!="0424"))||(longitud!=11))
    {
        mensajes(5);
        tlf.value="";
        return 0;
    }
}//FIN DE FUNCION formato_tlf
function validar_longitud_claves(campo)
{
  var longitud=campo.value.length;
  var exr = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,10})$/;
  //alert(campo.value.match(exr));
  if((campo.value.match(exr)==null)||((longitud<8)||(longitud>11)))
  {
    campo.value="";
    //alert(longitud);
    mensajes2("Las claves no deben ser menores a 8 caracteres y no deben exceder los 11 caracteres, deben estar compuesta por letras y números");
    return true;
  }
}
//FIN DE LA FUNCION validar_longitud_claves
function cambiar_color_btn(valor)
{
  $(valor).removeClass("btn-danger").addClass("btn-success");
}//FIN DE LA FUNCION cambiar_color_btn
function cambiar_color_btn2(valor)
{
  $(valor).removeClass("btn-success").addClass("btn-danger");
}
//funcion qu carga los grupos en checkbox
function cargar_varios_grupos(valor)
{ 
//var data=$("#form_carga_individual").serialize();
var data={
      valor:valor,
};
  $.ajax({
        url:"./controladores/controlador.generar_check_grupos.php",
        type:"POST",
        data:data,
        cache:false,
        error: function()
                  {
                        console.log(arguments);
                        mensajes(3);
                  },
              success: function(html)
              {
                var recordset=$.parseJSON(html);
                if(recordset=='error')
                {
                  mensajes(2);
                }
                else
                {
                  $("#contenedor_grupos").html(recordset);
                } 
              }
  });
}
//funcion qu carga modem en checkbox
function cargar_varios_modem(valor)
{ 
//var data=$("#form_carga_individual").serialize();
var data={
             valor:valor,
};
  $.ajax({
        url:"./controladores/controlador.generar_check_modem.php",
        type:"POST",
        data:data,
        cache:false,
        error: function()
                  {
                        console.log(arguments);
                        mensajes(3);
                  },
              success: function(html)
              {
                var recordset=$.parseJSON(html);
                if(recordset=='error')
                {
                  mensajes(2);
                }
                else
                {
                  $("#enviar_frame_modem").html(recordset);
                } 
              }
  });
}
//funcion que valida que almenos un chekcbox de un formulario este pulsado
function validar_checkbox(valor)
{
  var b = 0;
  var chk=document.getElementsByName(valor+'[]');
  //alert(chk.length);
    for(j=0;j<chk.length;j++) {
      //alert(chk.item(j).checked);
      if(chk.item(j).checked == false) {
        b++;
      }
  }
    if(b == chk.length) {
      chk='';
      //alert("Selecciones una o varias opciones");
      return 0;
    } 
    chk='';
    return 1;
}
//funcion que detiene el setinterval
function detener_interval()
{
  clearInterval(intervalo);
}
/////////////////////////////////////////////////////////////////////////////////////////
