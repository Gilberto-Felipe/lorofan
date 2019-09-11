
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar calendario

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar calendario</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCalendario">Agregar Jornada</button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas">

          <thead> 

            <tr>
                
              <th style="width: 10px">#</th>
              <th>Jornada</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Lugar</th>
              <th>Equipo local</th>
              <th>Equipo visitante</th>
              <th>Acciones</th> 

            </tr>

          </thead>

          <tbody>

            <?php 

              $item = null;
              $valor = null;

              $calendario = ControladorCalendario::ctrMostrarCalendario($item, $valor);

              foreach ($calendario as $key => $value) {

                // DIVIDIR FECHA Y HORA, Y FORMATEAR FECHA QUE VIENE DE BD

                $fechaBD = $calendario["fecha"][$value]; 
                $fechaSola = date('d-m-Y',strtotime($fechaBD));
                $horaSola = date('H:i:s',strtotime($fechaBD));
                
                echo '<tr>

                        <td>'.($key+1).'</td>
                        <td>'.$value["jornada"].'</td>
                        <td>'.$fechaSola.'</td>
                        <td>'.$horaSola.'</td>
                        <td>'.$value["lugar"].'</td>
                        <td>'.$value["equipo1"].'</td>
                        <td>'.$value["equipo2"].'</td>
                        <td>
                        
                          <div class="btn-group">
        
                            <button class="btn btn-warning btnEditarCalendario" idCalendario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCalendario"><i class="fa fa-pencil"></i></button>

                            <button class="btn btn-danger btnEliminarCalendario" idCalendario="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR JORNADA
======================================-->

<div id="modalAgregarCalendario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Jornada</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA JORNADA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaJornada" name="nuevaJornada" placeholder="Ingresa la jornada" required>

              </div>

            </div>

            <!-- ENTRADA PARA FECHA Y HORA -->
            
            <div class="form-group row">

              <div class="input-group">

                <!-- SELECCIONAR FECHA DATEPICKER -->

                <div class="col-xs-12 col-md-6">

                  <div class="form-group">

                    <div class="input-group date">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <input type="text" class="form-control pull-right input-lg" id="nuevaFecha" name="nuevaFecha" placeholder="Ingresa la fecha" required>

                    </div><!-- /.input group -->

                  </div><!-- /.form group -->

                </div><!-- .col-xs -->

                <!-- SELECCIONAR HORA TIMEPICKER -->

                <div class="col-xs-12 col-md-6">

                  <div class="bootstrap-timepicker">

                    <div class="form-group">

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>

                        <input type="text" class="form-control timepicker input-lg" id="nuevaHora" name="nuevaHora" placeholder="Ingresa la hora" required>

                      </div><!-- /.input group -->

                    </div><!-- /.form group -->

                  </div><!-- /.bootstrap-timepicker -->

                </div><!-- /.col -->

                <!-- SELECCIONAR EL ESTADIO -->

                <div class="col-xs-12">

                  <div class="form-group">
                
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                      <select class="form-control input-lg" id="nuevoEstadio" name="nuevoEstadio" required>
                        
                        <option value="">Selecionar estadio</option>

                        <?php 

                          $item = null;
                          $valor = null;

                          $estadios = ControladorEquipos::ctrMostrarEquipos($item, $valor);

                          foreach ($estadios as $key => $value) {
                            
                            echo '<option value="'.$value["id"].'">'.$value["estadio"].'</option>';

                          }

                        ?>

                      </select>

                    </div>

                  </div>

                </div><!-- .col -->

                <!-- SELECCIONAR EL EQUIPO1 -->

                <div class="col-xs-6">

                  <div class="form-group">
                
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                      <select class="form-control input-lg" id="nuevoAlias1" name="nuevoAlias1" required>
                        
                        <option value="">Selecionar equipo 1</option>

                        <?php 

                          $item = null;
                          $valor = null;

                          $equipo1 = ControladorEquipos::ctrMostrarEquipos($item, $valor);

                          foreach ($equipo1 as $key => $value) {
                            
                            echo '<option value="'.$value["id"].'">'.$value["alias"].'</option>';

                            '<input type="hidden" name="'.$value["escudo"].'">';

                          }

                        ?>

                      </select>

                    </div>

                  </div>

                </div><!-- .col -->

                <!-- SELECCIONAR EL EQUIPO2 -->

                <div class="col-xs-6">

                  <div class="form-group">
                
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                      <select class="form-control input-lg" id="nuevoAlias2" name="nuevoAlias2" required>
                        
                        <option value="">Selecionar equipo 2</option>

                        <?php 

                          $item = null;
                          $valor = null;

                          $equipo2 = ControladorEquipos::ctrMostrarEquipos($item, $valor);

                          foreach ($equipo2 as $key => $value) {
                            
                            echo '<option value="'.$value["id"].'">'.$value["alias"].'</option>';

                            '<input type="hidden" name="'.$value["escudo"].'">';

                          }

                        ?>

                      </select>

                    </div>

                  </div>

                </div><!-- .col -->

              </div><!-- .input-group -->

            </div><!-- .form-group row -->

          </div><!-- .form-group -->

        </div><!-- .box-body -->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar Jornada</button>

        </div>

          <?php 

            $crearJornada = new ControladorCalendario();
            $crearJornada -> ctrCrearJornada();
              
           ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg nuevaCategoria" name="editarCategoria" id="editarCategoria" required>

                <input type="hidden" name="idCategoria" id="idCategoria" required>
                

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar cambios</button>

        </div>

        <?php 



         ?>

      </form>

    </div>

  </div>

</div>

<?php 




 ?>

