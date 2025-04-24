<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>mejoresProductosVendidos</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">mejoresProductosVendidos</li>
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
                <h3 class="card-title">rmejoresProductosVendidos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>#</th>
                    <th>CAT_NOMBRE</th>
                    <th>Total_ventas</th>

                    <th>Ranking</th>

                  </tr>
                  </thead>
                  <tbody>
                        <?php
                         $cont=1;
                        foreach ($mjP as $mejorP): ?>
                                    <tr>
                                    <td><?= $cont ?></td>

                                        <td><?= esc($mejorP->nombre) ?></td>
                                        <td><?= esc($mejorP->totalVenta) ?></td>
                                        <td><?= esc($mejorP->ranking) ?></td>
                                   

                                        

                                    </tr>
                        <?php 
                    $cont++;
                    endforeach; ?>

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>#</th>
                    <th>CAT_NOMBRE</th>
                    <th>Total_ventas</th>

                    <th>Ranking</th>
                  

                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
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
         

              
               <!-- /.modal -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->