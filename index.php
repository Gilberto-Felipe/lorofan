<?php 

require_once "controladores/plantilla.controlador.php";
require_once "controladores/equipos.controlador.php";
require_once "controladores/calendario.controlador.php";
require_once "controladores/noticias.controlador.php";
require_once "controladores/jugadores.controlador.php";




require_once "modelos/equipos.modelo.php";
require_once "modelos/calendario.modelo.php";
require_once "modelos/noticias.modelo.php";
require_once "modelos/jugadores.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();