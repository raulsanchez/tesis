<?php
class Conectar{
	public static function conecta(){
		$conectar	= mysql_connect("localhost", "root", "252571") or die("problema en la coneccion ->" . mysql_error());
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db('agenda_online') or die("problema con la seleccion de la base de datos ->" . mysql_error());
		return $conectar;
	}
}
class Login{
	var $usuario;
	var $clave;
	var $id;
	var $nombre;
	public function __construct($usuario,$clave){
		$this -> usuario = $usuario;
		$this -> clave 	= $clave;
	}
	public function GetUsuario(){
		$consulta=mysql_query('SELECT `ad_rut`,`ad_nombre`,`ad_apaterno`,`ad_amaterno`
								FROM `administrador`
								WHERE `ad_rut`="'.$this->usuario.'"
								AND `ad_clave`="'.$this->clave.'"', Conectar::conecta());
		$resultado=mysql_num_rows($consulta);
		if($resultado==1):
			$dato=mysql_fetch_array($consulta);
			$this->id=$dato['ad_rut'];
			$this->nombre=$dato['ad_nombre']." ".$dato['ad_apaterno']." ".$dato['ad_amaterno'];
			return true;
			exit();
		else:
			return false;
			exit();
		endif;
	}
}
function validapost($valida){
	return trim(htmlentities(mysql_real_escape_string($valida)));
}
function dameURL(){
	$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	return $url;
}

function mysql_fechaentera($date) {
    $dia = explode("-", $date, 3);
    $year = $dia[0];
    $month = (string)(int)$dia[1];
    $day = (string)(int)$dia[2];

    $dias = array("domingo","lunes","martes","mi&eacute;rcoles" ,"jueves","viernes","s&aacute;bado");
    $tomadia = $dias[intval((date("w",mktime(0,0,0,$month,$day,$year))))];

    $meses = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

    return $tomadia.", ".$day." de ".$meses[$month]." de ".$year;
}
function cambiarfecha_mysql($fecha){
    list($dia,$mes,$ano)=explode("-",$fecha);
    $fecha="$ano-$mes-$dia";
    return $fecha;
}
function cambiarfecha_espanol($fecha){
    list($ano,$mes,$dia)=explode("-",$fecha);
    $fecha="$dia-$mes-$ano";
    return $fecha;
}