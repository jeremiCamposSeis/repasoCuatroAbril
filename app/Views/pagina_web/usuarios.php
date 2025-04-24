<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
            <button type="button" onclick="Addusuario()" class="btn btn-primary">Agregar usuario</button>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
         
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>USU_NOMBRE</th>
                    <th>USU_APELLIDO</th>
                    <th>USU_IDENTIFICACION</th>
                    <th>USU_CORREO</th>
                    <th>ROL_NOMBRE</th>
                    <th>accion</th>

                  </tr>
                  </thead>
                  <tbody>
                        <?php foreach ($usu as $usuario): ?>
                                    <tr>
                                        <td><?= esc($usuario->USU_NOMBRE) ?></td>
                                        <td><?= esc($usuario->USU_APELLIDO) ?></td>
                                        <td><?= esc($usuario->USU_IDENTIFICACION) ?></td>
                                        <td><?= esc($usuario->USU_CORREO) ?></td>
                                        <td><?= esc($usuario->ROL_NOMBRE) ?></td>

                                        <td><button type="button" data-toggle="modal"  data-target="#exampleModal" onClick="updateGetU(<?= esc($usuario->USU_ID) ?>);"  value="" class="btn btn-success">Success</button>
                                        
                                        <button type="button" onClick="eliminarU(<?= esc($usuario->USU_ID) ?>);" class="btn btn-danger">eliminar</button>
                                      </td>


                                    </tr>
                        <?php endforeach; ?>

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>USU_NOMBRE</th>
                    <th>USU_APELLIDO</th>
                    <th>USU_IDENTIFICACION</th>
                    <th>USU_CORREO</th>
                    <th>ROL_NOMBRE</th>
                    <th>accion</th>

                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card" id="seccionFormulario" style= "display:none">
              <div class="card-header">
                <h3 class="card-title">Formulario Registro</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-3">
                <input type="text" id="urlBase" value="<?php echo base_url(); ?>" style= "display:none">

                    <form  method="POST" action="<?php echo base_url(); ?>registro" >
                        <div class="form-group">
                            <label for="exampleInputEmail1">nombre</label>
                            <input type="text" class="form-control" oninput="verificarTexto(this)" id="exampleInputEmail1" aria-describedby="emailHelp" name="nombre" placeholder="Nombre:" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">apellido</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"  oninput="verificarTexto(this)" aria-describedby="emailHelp" name="apellido" placeholder="apellido:" required>
                        </div><div class="form-group">
                            <label for="exampleInputEmail1">cedula</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" oninput="verificarCedulaingreso(this)" aria-describedby="emailHelp" name="cedula" placeholder="cedula:" required>
                        </div><div class="form-group">
                            <label for="exampleInputEmail1">correo</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="correo" placeholder="correo:" required>
                        </div>
                       
                        <div >


                        <select class="form-select" name="rol" aria-label="Default select example">


                        <?php foreach ($rol as $usuario): ?>
                            <option value="<?= esc($usuario->ROL_ID) ?>"><?= esc($usuario->ROL_NOMBRE) ?></option>

                        <?php endforeach; ?>
                            
                        </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="guardar">

                    </form>
                </div>



              </div>
              <!-- /.card-body -->


              <!-- /.modaly -->


              
               <!-- /.modal -->
            </div>




            <!-- /.card -->


          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

     <!-- /.modaly -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombreMod" required>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Apellido:</label>
                        <input type="text" class="form-control" id="apellidoMod" required>
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Identificación:</label>
                        <input type="text" class="form-control" id="cedulaMod">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Correo:</label>
                        <input type="mail" class="form-control" id="correoMod" required>
                      </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button"  class="btn btn-primary" onClick="actualizarU()">Actualizar</button>
                      </div>
                  </div>
                </div>
              </div>

              
               <!-- /.modal -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->