<?php session_start(); ?><!DOCTYPE html><html><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><title>Inventory System</title><meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"><link rel="icon" href="vistas/img/plantilla/icono-negro.png"><link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css"><link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css"><link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css"><link rel="stylesheet" href="vistas/dist/css/AdminLTE.css"><link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css"><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"><link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"><link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css"><link rel="stylesheet" href="vistas/plugins/iCheck/all.css"><link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css"><link rel="stylesheet" href="vistas/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"><link rel="stylesheet" href="vistas/plugins/timepicker/bootstrap-timepicker.min.css"><script src="vistas/bower_components/jquery/dist/jquery.min.js"></script><script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script><script src="vistas/bower_components/fastclick/lib/fastclick.js"></script><script src="vistas/dist/js/adminlte.min.js"></script><script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script><script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script><script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script><script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script><script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script><script src="vistas/plugins/iCheck/icheck.min.js"></script><script src="vistas/plugins/input-mask/jquery.inputmask.js"></script><script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script><script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script><script src="vistas/bower_components/select2/dist/js/select2.full.min.js"></script><script src="vistas/plugins/jQueryNumber/jQueryNumber.min.js"></script><script src="vistas/bower_components/moment/min/moment.min.js"></script><script src="vistas/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script><script src="vistas/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js" charset="UTF-8"></script><script src="vistas/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script></head><body class="hold-transition skin-green sidebar-collapse sidebar-mini login-page"><?php

  if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok') {
    
    echo '<div class="wrapper">';

    /*=============================================
    =                  CABEZOTE                  =
    =============================================*/    
    include "modulos/cabezote.php";  

    /*=============================================
    =                  MENU                     =
    =============================================*/ 
    include "modulos/menu.php";

    /*=============================================
    =                CONTENIDO                   =
    =============================================*/ 
    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "equipos" ||
        $_GET["ruta"] == "calendario" ||
        $_GET["ruta"] == "jugadores" ||
        $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";

      } else{

        include "modulos/404.php";

      }

    } else{

      include "modulos/inicio.php";

    }

    /*=============================================
    =                FOOTER                   =
    =============================================*/ 
    include "modulos/footer.php";


    echo '</div>';

  } else {

    include "modulos/login.php";

  }

  ?><script src="vistas/js/plantilla.js"></script><script src="vistas/js/usuarios.js"></script><script src="vistas/js/calendario.js"></script><script src="vistas/js/equipos.js"></script><script src="vistas/js/jugadores.js"></script></body></html>