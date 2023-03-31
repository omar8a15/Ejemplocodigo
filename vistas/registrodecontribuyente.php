<?php 

    require_once("../config/conexion.php");
    if(isset($_SESSION["id_personal"]))
    {


    require_once("../modelo/Contribuyente.php");
    $cod = new Contribuyente();
    $ciu = $cod->getciudad_formcontribuyente();

    require 'header.php';

?> 

  <?php if($_SESSION["Controltotaldelsistema"]==1 OR $_SESSION["ModuloAdministradorInspecciones"]==1  OR $_SESSION["ModuloInspector"]==1)
  {

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <div class="box">
        
        <br>
        <!-- Content Header (Page header) -->
        <div class="content-header bg-white">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">REGISTRAR A CONTRIBUYENTE <i  class="fa fa-building" ></i></h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="actualizarinformacioncontribuyente.php" class="btn btn-success" style="box-shadow: none;"><i class="fa fa-edit"></i> Actualizar</a></li>
                  <li class="breadcrumb-item active"><a href="consultarcontribuyente.php" class="btn btn-warning" style="box-shadow: none;color:white;"><i class="fa fa-search"></i>  Consultar</a></li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
     

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
              
              <!-- panel-body tabla -->
              <div class="panel-body table-responsive" id="listadoregistros">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"> <i title="Icono para abrir ventana con formulario" class="fa fa-plus" style="font-size: 18pt;cursor: pointer" onclick="limpiar()" type="button" class="btn btn-default" data-toggle="modal" data-target="#contribuyenteregistromodal"></i> Vista para ingresar a un nuevo contribuyente </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="listado_registro" class="table table-bordered table-striped" width="100%;">
                      <thead>
                      <tr>
                 
                        <th>NOMBRE</th>
                        <th>RFC</th>
                      </tr>
                      </thead>
                      <tbody>

                      <tr>
                       
                   
                      </tr>
                      
                      </tbody>
                      
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

              </div>
              <!-- /. panel-body tabla -->


              <!-- panel-body formulario -->
              <div class="panel-body table-responsive" id="listadoregistros">

              </div>
              <!-- /. panel-body formulario -->

            </div>
            <!-- /.row -->

          </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->

      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!--VISTA MODAL PARA VER FORMULARIO DE REGISTRO DE CONTRIBUYENTE-->
  <?php require_once("scripts/ventanamodal/registro/contribuyente.php");?>
  
  <?php  } else {

       require("noacceso.php");
  }

  ?><!--CIERRE DE SESSION DE PERMISO -->




<?php 
    require 'footer.php';
?> 
<script type="text/javascript" src="scripts/registro/contribuyente.js"></script>

<style type="text/css">
    
        ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
        color: black !important;/*!Important sirve para dar orden inmediata de cambiar el color*/
        }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        color: black !important;
        opacity: 1 /* esto es porque Firefox le reduce la opacidad por defecto */;
        }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */
        color: black !important;
        opacity: 1;
        }
        :-ms-input-placeholder { /* Internet Explorer 10-11 */
        color: black !important;
        }

        .colorn
        {
            background-color:red;
        }

</style>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 

  })
</script>





<?php
     
    } 
    else 
    {

        header("Location:".Conectar::ruta()."index.php");
        exit();
    }
?>
