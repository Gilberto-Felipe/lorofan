
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar equipos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar equipos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" id="btnAgregarEquipo" data-toggle="modal" data-target="#modalAgregarEquipo">Registrar equipo</button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead> 

            <tr>
                
              <th style="width: 10px">#</th>
              <th>Escudo</th>
              <th>Alias</th>
              <th>Nombre</th>
              <th>Estadio</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php 

              $item = null;
              $valor = null;

              $equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor);
              //var_dump($equipos);

              foreach ($equipos as $key => $value) {

                echo 
                  '<tr>
                    
                    <td>'.($key+1).'</td>';

                    if ($value["escudo"] != "") {
                        
                      echo '<td><img src="'.$value["escudo"].'" class="img-thumbnail" width="40px"></td>';

                    }else {

                      echo '<td><img src="vistas/img/equipos/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                    }

              echo  '<td>'.$value["alias"].'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["estadio"].'</td>
                    <td>

                      <div class="btn-group">
                        
                        <button class="btn btn-warning btnEditarEquipo" idEquipo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarEquipo"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarEquipo" idEquipo="'.$value["id"].'" imagenEscudo="'.$value["escudo"].'" equipo="'.$value["alias"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR EQUIPO
======================================-->

<div id="modalAgregarEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL ALIAS -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoAlias" name="nuevoAlias" placeholder="Ingresar alias" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EQUIPO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoEquipo" placeholder="Ingresar equipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoEstadio" placeholder="Ingresar estadio" required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR ESCUDO -->

             <div class="form-group">
              
              <div class="panel">SUBIR ESCUDO</div>

              <input type="file" class="nuevoEscudo" name="nuevoEscudo">

              <p class="help-block">Peso máximo del escudo 2MB</p>

              <img src="vistas/img/equipos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar equipo</button>

        </div>

        <?php 

          $crearEquipo = new ControladorEquipos();
          $crearEquipo -> ctrRegistrarEquipo();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR EQUIPO
======================================-->

<div id="modalEditarEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL ALIAS -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span>                

                <input type="text" class="form-control input-lg" id="editarAlias" name="editarAlias" value="" required>
                <input type="hidden" id="idEquipo" name="idEquipo">

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="editarEquipo" name="editarEquipo" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADIO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" id="editarEstadio" name="editarEstadio" placeholder="Editar estadio" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR ESCUDO -->

             <div class="form-group">
              
              <div class="panel">SUBIR ESCUDO</div>

              <input type="file" class="nuevoEscudo" name="editarEscudo">

              <p class="help-block">Peso máximo del escudo 2MB</p>

              <img src="vistas/img/equipos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="escudoActual" id="escudoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Modificar equipo</button>

        </div>

          <?php 

            $editarEquipo = new ControladorEquipos();
            $editarEquipo -> ctrEditarEquipo();
            
           ?>

      </form>

    </div>

  </div>

</div>

<?php 

$borrarEquipo = new ControladorEquipos();
$borrarEquipo -> ctrBorrarEquipo();

?>