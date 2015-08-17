<?php
//ARCHIVO CREADO POR GIANNI SANTUCCI 02/10/2014
//FUNCION QUE VALIDA QUE TODOS LOS CAMPOS DEL FORMULARIO ESTEN LLENOS
function validar_campos()
{
	foreach($_POST as $campos => $valores)
	{
		if((empty($valores))||($valores==-1))
		{
			$mensaje[0]="campos_blancos";
			die(json_encode($mensaje));
		}
	}
}
//FUNCION QUE TRANSFORMA UN ARREGLO PHP A UNO EN PL/PGSQL
function to_pg_array($set) {
    settype($set, 'array'); // can be called with a scalar or array
    $result = array();
    foreach ($set as $t) {
        if (is_array($t)) {
            $result[] = to_pg_array($t);

        } else {
            $t = str_replace('"', '\\"', $t); // escape double quote
            /*if (! is_numeric($t)) // quote only non-numeric values
                $t = '"' . $t . '"';*/
            $result[] = $t;
        }
    }
    return '{' . implode(",", $result) . '}'; // format
}
//FUNCION PARA VALIDAR LOS POST DE LA PAGINACIÓN
function validar_post_paginacion()
{
    if((!((isset($_POST["offset"]))||(isset($_POST["limit"]))))||(($_POST["limit"]=="")||($_POST["offset"]=="")))
    {
        
        $mensaje[0]="campos_blancos";
       //$mensaje[0]=$_POST["offset"]."-".$_POST["limit"];
        die(json_encode($mensaje));
    }
}
function curar_cadena($cadena)
{
    $valor=str_replace("'"," ",$cadena);
    $valor=trim(str_replace("/"," ",$valor));
    $valor=trim(str_replace("ñ","n",$valor));
    $valor=trim(str_replace("Ñ","N",$valor));
    $valor=trim(str_replace("-","",$valor));
    $valor=trim(str_replace("'","",$valor));
    $valor=trim(str_replace("'","",$valor));
    //$valor=str_replace("(","", $valor);
//    $valor=str_replace("");
    return $valor;
}
function curar_cadena_letras($cadena)
{
    $valor=str_replace("'","",$cadena);
    $valor=trim(str_replace("/"," ",$valor));
    $valor=trim(str_replace("ñ","n",$valor));
    $valor=trim(str_replace("Ñ","N",$valor));
    $valor=trim(str_replace("'","",$valor));
    $valor=trim(str_replace("'","",$valor));
    $valor=trim(str_replace(",","",$valor));
    $valor=trim(str_replace(".","",$valor));
    $valor=trim(str_replace("´","",$valor));
    $valor=trim(str_replace("`","",$valor));
    //$valor=valida($cadena,0);
    $valor=utf8_encode($cadena);
    //$valor=str_replace("(","", $valor);
//    $valor=str_replace("");
    return $valor;
}
function curar_tlf($cadena)
{
     $valor=trim(str_replace("(","",$cadena));
     $valor=trim(str_replace(")","",$valor));
     $valor=trim(str_replace("-","",$valor));
     $valor=trim(str_replace("/","",$valor)); 
     $valor=trim(str_replace("_","",$valor));
     $valor=trim(str_replace(".","",$valor)); 
     $valor=trim(str_replace(",","",$valor));
     $valor=trim(str_replace(".","",$valor));     
     return $valor;
}
?>