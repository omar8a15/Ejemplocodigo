

<div class="modal fade" id="contribuyenteregistromodal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
           	
           	<div class="modal-header bg-danger" >
              <h4 class="modal-title">INGRESAR DATOS DEL CONTRIBUYENTE <i class="fa fa-edit"></i> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             
            <form method="post" id="registro_form" name="registro_form" autocomplete="off" style="height: 450px;">

	            <div class="col-md-12" style="margin-top: -2%;">

	            	<div class="card-body">

	            		<div class="row">

	            			<div class="col-8">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">NOMBRE DEL CONTRIBUYENTE</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-building-circle-check"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="contribuyente" id="contribuyente" placeholder="INTRODUCIR NOMBRE."  required style="color: black;text-transform:uppercase;"  title="INTRODUCIR NOMBRE DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>

			                <div class="col-4">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">IDENTIFICADOR</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
					                </div>
				                    <input type="text" value="<?php $codigo=$cod->identificador_numerodecontribuyente();?>" class="form-control" name="identificador" id="identificador" title="N° IDENTIFICADOR DEL CONTRIBUYENTE EN EL SISTEMA." readonly="">
				                  </div>
				                </div>
			                </div>

			                
			                <div class="col-3">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">N° MUNICIPIO</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-arrow-up-1-9"></i></span>
					                </div>

					                <?php 

					                if ($_SESSION["Controltotaldelsistema"]==1) 
					                {
					                	echo 
					                	'
					                	<input type="text" class="form-control" name="numerocontri" id="numerocontri" placeholder="INTRODUCIR N°."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR N° DE MUNICIPIO." autocomplete="off">

					                	';
					                }

					                if ($_SESSION["ModuloAdministradorInspecciones"]==1  OR $_SESSION["ModuloInspector"]==1) 
					                {
					                	echo 
					                	'
					                	<input type="text" class="form-control" name="numerocontri" id="numerocontri" placeholder=""   style="color: black;text-transform:uppercase;" readonly  title="" autocomplete="off">
					                	
					                	';
					                }

					                ?>



				                    
				                  </div>
				                </div>
			                </div>

			                <div class="col-3">
				                <div class="form-group" style="color: black;">
				                  <label style="color: black;">RFC</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-list"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="rfc" id="rfc" placeholder="INTRODUCIR RFC."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR RFC DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>
			                
			                <div class="col-6">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">CIUDAD DEL CONTRIBUYENTE</label>
				                  <div class="input-group">
				                    
				                    <select class="select2" id="ciudaduno" name="ciudadbd" id="ciudadbd" style="border-color: black;color: black;width: 100%;height: 15%;"  data-live-search="true">
					                    <option  value="0" style="border-color: black;color: black;">SELECCIONE CIUDAD</option>
					                    <?php
					                      for($i=0; $i<sizeof($ciu);$i++)
					                      {
					                    ?>
					                        <option style="border-color: black;color: black;" value="<?php echo $ciu[$i]["ciudad"]?>"><?php echo $ciu[$i]["ciudad"];?></option>
					                    <?php
					                      }
					                    ?>
					                </select> 
				                  </div>
				                </div>
			                </div>
			                
			                <div class="col-8">
				                <div class="form-group" style="color: black;">
				                  <label style="color: black;">DIRECCIÓN FISCAL</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="INTRODUCIR DIRECCIÓN."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR DIRECCIÓN FISCAL DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>
			                

			                <div class="col-4">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">COLONIA</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="colonia" id="colonia" placeholder="INTRODUCIR COLONIA."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR COLONIA DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>

			                <div class="col-12">
			                    <hr>
			                    <p style="color: black;font-size: 12pt;"><b>INFORMACIÓN ADICIONAL</b></p>
			                </div>

			                <div class="col-5">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">SI LA CIUDAD NO APARECE AGREGARLA</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="INTRODUCIR CIUDAD."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR CIUDAD SI NO APARECE EN LOS REGISTROS." autocomplete="off">
				                  </div>
				                </div>
			                </div>

			                <div class="col-3">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">N° TELEFÓNICO</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-fax"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="INTRODUCIR N° TELEFONO."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR N° TELEFONO DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>

			                <div class="col-4">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">CORREO ELECTRÓNICO</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="correo" id="correo" placeholder="INTRODUCIR CORREO ELECTRÓNICO."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR CORREO ELECTRÓNICO DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>

			            </div>
	            	</div>

	           	</div>

            </div>

            <div class="modal-footer bg-danger">
              <input type="hidden" name="id_personal" id="id_personal" value="<?php echo $_SESSION["id_personal"];?>" />
              <input type="hidden" name="fecha" id="fecha" readonly=""    class="form-control" value="<?php  echo date('d-m-Y'); ?>" style="outline: none; background-color:#f56954;border: 0;color: white;font-size: 12pt;"  >
              <input type="hidden" name="id_contribuyente" id="id_contribuyente" >
              <button type="submit" id="btnGuardar" class="btn btn-primary">GUARDAR</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
            </div>

          </div>
          <!-- /.modal-content -->

          </form>

    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<div class="modal fade" id="contribuyenteactualizarmodal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
           	
           	<div class="modal-header bg-danger" >
              <h4 class="modal-title">INFORMACIÓN DEL CONTRIBUYENTE <i class="fa fa-edit"></i> </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             
            <form method="post" id="actualizar_form" name="actualizar_form" autocomplete="off" style="height: 450px;">

	            <div class="col-md-12" style="margin-top: -2%;">

	            	<div class="card-body">

	            		<div class="row">

	            			<div class="col-8">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">NOMBRE DEL CONTRIBUYENTE</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-building-circle-check"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="contribuyente" id="contribuyenteA" placeholder="INTRODUCIR NOMBRE."  required style="color: black;text-transform:uppercase;"  title="INTRODUCIR NOMBRE DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>

			                <div class="col-4">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">IDENTIFICADOR</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
					                </div>
				                    <input type="text" value="" class="form-control"  id="identificadorA"  readonly="">
				                  </div>
				                </div>
			                </div>

			                
			                <div class="col-3">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">N° MUNICIPIO</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-arrow-up-1-9"></i></span>
					                </div>

					                <?php 

					                if ($_SESSION["Controltotaldelsistema"]==1) 
					                {
					                	echo 
					                	'
					                	<input type="text" class="form-control" name="numerocontri" id="numerocontriA" placeholder="INTRODUCIR N°."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR N° DE MUNICIPIO." autocomplete="off">

					                	';
					                }

					                if ($_SESSION["ModuloAdministradorInspecciones"]==1  OR $_SESSION["ModuloInspector"]==1) 
					                {
					                	echo 
					                	'
					                	<input type="text" class="form-control" name="numerocontri" id="numerocontriA" placeholder=""   style="color: black;text-transform:uppercase;" readonly  title="" autocomplete="off">
					                	
					                	';
					                }

					                ?>



				                    
				                  </div>
				                </div>
			                </div>
			                <div class="col-3">
				                <div class="form-group" style="color: black;">
				                  <label style="color: black;">RFC</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-list"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="rfc" id="rfcA" placeholder="INTRODUCIR RFC."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR RFC DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>
			                
			                <div class="col-3">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">SELECCIONAR CONTRIBUYENTE</label>
				                  <div class="input-group">
				                    
				                    <select class="select2" id="ciudaddos" name="ciudadbd" id="ciudadbd" style="border-color: black;color: black;"  data-live-search="true">
					                    <option  value="" style="border-color: black;color: black;">SELECCIONE CIUDAD</option>
					                    <?php
					                      for($i=0; $i<sizeof($ciu);$i++)
					                      {
					                    ?>
					                        <option style="border-color: black;color: black;" value="<?php echo $ciu[$i]["ciudad"]?>"><?php echo $ciu[$i]["ciudad"];?></option>
					                    <?php
					                      }
					                    ?>
					                </select> 
				                  </div>
				                </div>
			                </div>

			                <div class="col-3">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">CIUDAD QUE PERTENECE</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="ciudadmostrar" id="ciudadmostrar"  readonly=""  style="color: black;text-transform:uppercase;"  title="CIUDAD QUE PERTENECE EL CONTRIBUYENTE." autocomplete="off"> 
				                  </div>
				                  
				                </div>
			                </div>
			                
			                <div class="col-8">
				                <div class="form-group" style="color: black;">
				                  <label style="color: black;">DIRECCIÓN FISCAL</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="direccion" id="direccionA" placeholder="INTRODUCIR DIRECCIÓN."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR DIRECCIÓN FISCAL DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>
			                

			                <div class="col-4">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">COLONIA</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="colonia" id="coloniaA" placeholder="INTRODUCIR COLONIA."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR COLONIA DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>

			                <div class="col-12">
			                    <hr>
			                    <p style="color: black;font-size: 12pt;"><b>INFORMACIÓN ADICIONAL</b></p>
			                </div>

			                <div class="col-5">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">SI LA CIUDAD NO APARECE AGREGARLA</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="INTRODUCIR CIUDAD."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR CIUDAD SI NO APARECE EN LOS REGISTROS." autocomplete="off">
				                  </div>
				                </div>
			                </div>

			                <div class="col-3">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">N° TELEFÓNICO</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-fax"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="telefono" id="telefonoA" placeholder="INTRODUCIR N° TELEFONO."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR N° TELEFONO DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>

			                <div class="col-4">
			                    <div class="form-group" style="color: black;">
				                  <label style="color: black;">CORREO ELECTRÓNICO</label>
				                  <div class="input-group">
				                    <div class="input-group-append">
					                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
					                </div>
				                    <input type="text" class="form-control" name="correo" id="correoA" placeholder="INTRODUCIR CORREO ELECTRÓNICO."   style="color: black;text-transform:uppercase;"  title="INTRODUCIR CORREO ELECTRÓNICO DEL CONTRIBUYENTE." autocomplete="off">
				                  </div>
				                </div>
			                </div>

			            </div>
	            	</div>

	           	</div>

            </div>

            <div class="modal-footer bg-danger">
              
              <input type="hidden" name="id_contribuyente" id="id_contribuyenteA" >
              <button type="submit" id="btnActualizar" class="btn btn-primary">GUARDAR</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
            </div>

          </div>
          <!-- /.modal-content -->

          </form>

    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
