<?php 

  //session_start();


 ?>



<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">

  <!--=====================================
  =            Plugins css                =
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css">

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="vistas/plugins/timepicker/bootstrap-timepicker.min.css">
  
  <!--=====================================
  =            Plugins js                 =
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

    <!-- Sweetalert2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- Select2 -->
  <script src="vistas/bower_components/select2/dist/js/select2.full.min.js"></script>

  <!-- jQueryNumber -->
  <script src="vistas/plugins/jQueryNumber/jQueryNumber.min.js"></script>

  <!-- bootstrap datepicker-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="vistas/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"  charset="UTF-8"></script> 

  <!-- bootstrap time picker -->
  <script src="vistas/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

</head>

  <!--=====================================
  =           CUERPO DOCUMENTO            =
  ======================================-->

<body class="hold-transition skin-green sidebar-collapse sidebar-mini login-page">


  <?php

//  if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok') {
    
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
        $_GET["ruta"] == "equipos" ||
        $_GET["ruta"] == "calendario" ||
        $_GET["ruta"] == "noticias" ||
        $_GET["ruta"] == "jugadores" ||
        $_GET["ruta"] == "notificaciones" ||
        $_GET["ruta"] == "juego" ||
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

/*  } else {

    include "modulos/login.php";

  }*/

  ?>



  <!-- enlaces a js -->
  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/equipos.js"></script>
  <script src="vistas/js/calendario.js"></script>
  <script src="vistas/js/noticias.js"></script>
  <script src="vistas/js/jugadores.js"></script>
  <script src="vistas/js/notificaciones.js"></script>

</body>
</html>
