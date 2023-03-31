
//// VARIABLES PARA REGISTRO DE CONTRIBUYENTE ////

// VARIABLE PARA TABLA QUE MUESTRA AL CONTRIBUYENTE DESPUES DE SER REGISTRADO.
var tabla1;


//// VARIABLES PARA ACTULIZAR CONTRIBUYENTE ////

// VARIABLE PARA TABLA QUE MUESTRA AL CONTRIBUYENTE PARA ACTUALIZAR INFORMACIÓN.
var tabla2;




// FUNCIÓN QUE SE CARGA AL INICIO
function init()
{	

	// FUNCIONES PARA REGISTRO Y ACTUALIZACIÓN DE CONTRIBUYENTES .

	//FUNCIÓN PARA GUARDAR REGISTROS.
	$("#registro_form").on("submit",function(e)
	{
		guardardatoscontribuyente(e);	
	})

	// LISTADO DE CONTRIBUYENTES DESPUÉS DE SER INGRESADO AL SISTEMA.
	listadocontribuyente_registro();


	// FUNCIONES PARA ACTUALIZAR.   

	// FUNCIÓN PARA ACTUALIZAR INFORMACIÓN AL CONTRIBUYENTE
	$("#actualizar_form").on("submit",function(e)
	{
		actualizarinformacioncontribuyente(e);	
	})

	
	// LISTADO DE CONTRIBUYENTE PARA ACTUALIZAR INFORMACIÓN
	listadocontribuyente_actualizar();


	

}



/* 1. FUNCIONES PARA REGISTRO DE CONTRIBUYENTE. */

// REGISTRO DE CONTRIBUYENTE 

/* Función para hacer registros de contribuyente. */
function guardardatoscontribuyente(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#registro_form")[0]);

	$.ajax({
		url: "../ajax/contribuyente.php?op=guardaryactualizarcontribuyente",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	        bootbox.alert(datos);	          
	        $('#registro_form')[0].reset();
			$('#contribuyenteregistromodal').modal('hide');
			$('#resultados_ajax').html(datos);
            limpiar();
	        tabla1.ajax.reload();
	        //tabla2.ajax.reload();
	        setTimeout ("explode();", 1500);
	    }

	});

}


// MOSTRAMOS REGISTROS

/* Función que muestra los registros después de ser ingresados. */
function listadocontribuyente_registro()
{
    tabla1=$('#listado_registro').dataTable(
    {
        "lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
        "aProcessing": true,//Activamos el procesamiento del datatables
        "aServerSide": true,//Paginación y filtrado realizados por el servidor
        "ajax":
        {
            url: '../ajax/contribuyente.php?op=listadocontribuyente_registro',
            type : "get",
            dataType : "json",                      
            error: function(e)
            {
               console.log(e.responseText);    
            }
        },

        "language": 
        {
        	"sProcessing":"PROCESANDO...",
            "sEmptyTable":"NO HAY CONTRIBUYENTE REGISTRADO EL DÍA DE HOY.",
            "lengthMenu": "Mostrar : _MENU_ registros",
            "sSearch":    "Buscar:",
            "buttons": 
            {
            	"copyTitle": "Tabla Copiada",
            	"copySuccess": 
            {
                 _: '%d líneas copiadas',
                1: '1 línea copiada'
            }
            },

            "oPaginate": 
            {
			 
			    "sFirst":    "Primero",
			 	"sLast":     "Último",
			 	"sNext":     "Siguiente",
			 	"sPrevious": "Anterior"
			 
			},

			"sInfo":         "Mostrando un total de _TOTAL_ registros",
			"sZeroRecords":  "NO SE ENCONTRO NINGUN RESULTADO",
        },

        "bDestroy": true,
        "iDisplayLength": 5,//Paginación
        "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
    }).DataTable();
}


/* 2. FUNCIONES PARA ACTUALIZAR A CONTRIBUYENTE. */


// MOSTRAMOS CONTRIBUYENTES

/* Función que muestra al contribuyente para actualizar información. */
function listadocontribuyente_actualizar()
{
    tabla2=$('#listado_actualizar').dataTable(
    {
        "lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
        "aProcessing": true,//Activamos el procesamiento del datatables
        "aServerSide": true,//Paginación y filtrado realizados por el servidor
        "ajax":
        {
            url: '../ajax/contribuyente.php?op=listadocontribuyente_actualizar',
            type : "get",
            dataType : "json",                      
            error: function(e)
            {
               console.log(e.responseText);    
            }
        },

        "language": 
        {
        	"sProcessing":"PROCESANDO...",
            "sEmptyTable":"NO HAY CONTRIBUYENTES PARA ACTUALIZAR INFORMACIÓN.",
            "lengthMenu": "Mostrar : _MENU_ registros",
            "sSearch":    "Buscar:",
            "buttons": 
            {
            	"copyTitle": "Tabla Copiada",
            	"copySuccess": 
            {
                 _: '%d líneas copiadas',
                1: '1 línea copiada'
            }
            },

            "oPaginate": 
            {
			 
			    "sFirst":    "Primero",
			 	"sLast":     "Último",
			 	"sNext":     "Siguiente",
			 	"sPrevious": "Anterior"
			 
			},

			"sInfo":         "Mostrando un total de _TOTAL_ registros",
			"sZeroRecords":  "NO SE ENCONTRO NINGUN RESULTADO",
        },
        
        "bDestroy": true,
        "iDisplayLength": 5,//Paginación
        "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
    }).DataTable();
}





// ACTUALIZAR INFORMACIÓN DEL CONTRIBUYENTE

/* Función para colocar cada dato del registro en un input en el formulario. */
function mostrardatos_contribuyente(id_contribuyente)
{
	$.post("../ajax/contribuyente.php?op=mostrardatos_contribuyente",{id_contribuyente : id_contribuyente}, function(data, status)
	{
		data = JSON.parse(data);		
		$('#contribuyenteactualizarmodal').modal('show');
		
		$("#identificadorA").val(data.identificador);
		$("#contribuyenteA").val(data.contribuyente);
		$("#rfcA").val(data.rfc);
		$("#numerocontriA").val(data.numerocontri);
		$("#ciudadmostrar").val(data.ciudad);
		$("#direccionA").val(data.direccion);
		$("#coloniaA").val(data.colonia);
		$("#telefonoA").val(data.telefono);
		$("#correoA").val(data.correo);
		
		$('#id_contribuyenteA').val(id_contribuyente);

 	});
 	
}

/* Función para actualizar información del contribuyente. */
function actualizarinformacioncontribuyente(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnActualizar").prop("disabled",true);
	var formData = new FormData($("#actualizar_form")[0]);

	$.ajax({
		url: "../ajax/contribuyente.php?op=guardaryactualizarcontribuyente",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	        bootbox.alert(datos);	          
	        $('#actualizar_form')[0].reset();
			$('#contribuyenteactualizarmodal').modal('hide');
			$('#resultados_ajax').html(datos);
            limpiar();
	        tabla2.ajax.reload();
	        //tabla2.ajax.reload();
	        setTimeout ("explode();", 1500);
	    }

	});

}



/* 2. FUNCIONES PARA CAMBIAR EL ESTADO */

/* Función para inactivar al contribuyente (estado igual a 0). */
function cambiarestado_inactivar(id_contribuyente, est)
{
    bootbox.confirm("¿ESTA SEGURO DE INACTIVAR AL CONTRIBUYENTE?", function(result)
    {
        if(result)
        {
            $.ajax({
                url:"../ajax/contribuyente.php?op=cambiarestado_contribuyente",
                method:"POST",
                //data:dataString,
                //toma el valor del id y del estado
                data:{id_contribuyente:id_contribuyente, est:est},
                cache: false,
                success:function(data)
                {
                    //alert(data);
                    tabla2.ajax.reload();
                    setTimeout ("explode();", 50);
                    
                }
            });
        }

    });//bootbox
}


/* Función para activar al contribuyente (estado igual a 1). */
function cambiarestado_activar(id_contribuyente, est)
{
    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR NUEVAMENTE AL CONTRIBUYENTE?", function(result)
    {
        if(result)
        {
            $.ajax({
                url:"../ajax/contribuyente.php?op=cambiarestado_contribuyente",
                method:"POST",
                //data:dataString,
                //toma el valor del id y del estado
                data:{id_contribuyente:id_contribuyente, est:est},
                cache: false,
                success:function(data)
                {
                    //alert(data);
                    tabla2.ajax.reload();
                    setTimeout ("explode();", 50);
                    
                }
            });
        }

    });//bootbox
}










//Función limpiar
function limpiar()
{
	$("#contribuyente").val("");
    $("#rfc").val("");
    $("#numerocontri").val("");
    $("#direccion").val("");
    $("#colonia").val("");
    $("#ciudad").val("");
    $("#telefono").val("");
    $("#correo").val("");
    $("#id_contribuyente").val("");
}



//Función para recargar la ventana.
function explode()
{
	location.reload();
}






init();
