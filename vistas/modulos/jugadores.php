
<div class="content-wrapper">

<section class="content-header">

  <h1>

    Administrar plantilla de jugadores

  </h1>

  <ol class="breadcrumb">

    <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

    <li class="active">Administrar plantilla de jugadores</li>

  </ol>

</section>

<section class="content">

  <div class="box">

    <div class="box-header with-border">

      <button class="btn btn-success" id="btnAgregarJugador" data-toggle="modal" data-target="#modalAgregarJugador">Agregar jugador</button>

    </div>

    <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead> 

          <tr>
              
            <th style="width: 10px">#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Número</th>
            <th>Posición</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>

          <?php 

            $item = null;
            $valor = null;

            $jugadores = ControladorPlantillaJugadores::ctrMostrarPlantilla($item, $valor);

            // var_dump($jugadores);

            foreach ($jugadores as $key => $value) {

              echo 
                '<tr>
                  
                  <td>'.($key+1).'</td>';

                  if ($value["foto"] != "") {
                      
                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

                  }else {

                    echo '<td><img src="vistas/img/plantillaJugadores/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                  }

            echo  '<td>'.$value["nombre"].'</td>
                  <td>'.$value["apellido"].'</td>
                  <td>'.$value["numero"].'</td>
                  <td>'.$value["posicion"].'</td>
                  <td>

                    <div class="btn-group">
                      
                      <button class="btn btn-warning btnEditarJugador" idJugador="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarJugador"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarJugador" idJugador="'.$value["id"].'" foto="'.$value["foto"].'"><i class="fa fa-times"></i></button>

                    </div>

                  </td> 

                </tr>';

            }

          ?>

        </tbody>
          
      </table>

    </div>

  </div><!-- /.box -->

</section><!-- /.content -->

</div><!-- /.content-wrapper -->


<!--=====================================
MODAL AGREGAR JUGADOR
======================================-->

<div id="modalAgregarJugador" class="modal fade" role="dialog">

<div class="modal-dialog">

  <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" style="background:#00a65a; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar jugador</h4>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!-- ENTRADA PARA EL NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">
            
              <span class="input-group-addon"><i class="fa fa-user"></i></span> 

              <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" placeholder="Ingresar nombre" required>

            </div>

          </div>

          <!-- ENTRADA PARA EL APELLIDO -->

           <div class="form-group">
            
            <div class="input-group">
            
              <span class="input-group-addon"><i class="fa fa-key"></i></span> 

              <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellido" required>

            </div>

          </div>

          <div class="form-group row">

            <div class="input-group">

              <!-- ENTRADA PARA EL NÚMERO DEL JUGADOR -->

              <div class="col-xs-6">

                <div class="form-group">
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                    <input type="text" class="form-control input-lg" name="nuevoNumero" placeholder="Ingresar número" required>

                  </div>

                </div>

              </div>

              <!-- ENTRADA PARA LA POSICIÓN -->

              <div class="col-xs-6">

                <div class="form-group">
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                    <input type="text" class="form-control input-lg" name="nuevaPosicion" placeholder="Ingresar posición" required>

                  </div>

                </div>

              </div>

            </div><!-- .input-group -->

          </div><!-- .form-group row -->

          <!-- ENTRADA PARA SUBIR FOTO DEL JUGADOR -->

          <div class="form-group">
            
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevaFoto" name="nuevaFoto">

            <p class="help-block">Peso máximo de la foto 2MB</p>

            <img src="vistas/img/plantillaJugadores/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

          </div>

        </div><!-- .box-body-->

      </div><!-- .modal-body-->

      <!--=====================================
      PIE DEL MODAL
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-success">Guardar Jugador</button>

      </div>

      <?php 

        $registrarJugador = new ControladorPlantillaJugadores();
        $registrarJugador -> ctrRegistrarJugador();

      ?>

    </form>

  </div>

</div>

</div>


<!--=====================================
MODAL EDITAR JUGADOR
======================================-->

<div id="modalEditarJugador" class="modal fade" role="dialog">

<div class="modal-dialog">

  <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" style="background:#00a65a; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar jugador</h4>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!-- ENTRADA PARA EL NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">
            
              <span class="input-group-addon"><i class="fa fa-user"></i></span> 

              <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" required>
              <input type="hidden" id="idJugador" name="idJugador">

            </div>

          </div>

          <!-- ENTRADA PARA EL APELLIDO -->

           <div class="form-group">
            
            <div class="input-group">
            
              <span class="input-group-addon"><i class="fa fa-key"></i></span> 

              <input type="text" class="form-control input-lg" id="editarApellido" name="editarApellido" required>

            </div>

          </div>

          <div class="form-group row">

            <div class="input-group">

              <!-- ENTRADA PARA EL NÚMERO DEL JUGADOR -->

              <div class="col-xs-6">

                <div class="form-group">
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                    <input type="text" class="form-control input-lg" id="editarNumero" name="editarNumero" required>

                  </div>

                </div>

              </div>

              <!-- ENTRADA PARA LA POSICIÓN -->

              <div class="col-xs-6">

                <div class="form-group">
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                    <input type="text" class="form-control input-lg" id="nuevaPosicion" name="nuevaPosicion" required>

                  </div>

                </div>

              </div>

            </div><!-- .input-group -->

          </div><!-- .form-group row -->

          <!-- ENTRADA PARA SUBIR FOTO DEL JUGADOR -->

          <div class="form-group">
            
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevaFoto" name="editarFoto">

            <p class="help-block">Peso máximo de la foto 2MB</p>

            <img src="vistas/img/plantillaJugadores/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            <input type="hidden" id="fotoActual" name="fotoActual">

          </div>

        </div><!-- .box-body-->

      </div><!-- .modal-body-->

      <!--=====================================
      PIE DEL MODAL
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-success">Modificar Jugardor</button>

      </div>

        <?php 

          //$editarEquipo = new ControladorEquipos();
          //$editarEquipo -> ctrEditarEquipo();
          
         ?>

    </form>

  </div>

</div>

</div>

<?php 

  //$borrarEquipo = new ControladorEquipos();
  //$borrarEquipo -> ctrBorrarEquipo();

?>