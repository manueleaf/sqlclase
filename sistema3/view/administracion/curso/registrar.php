
<!-- Content Header (Page header) -->
<?php 
require_once 'controller/persona.controller.php';

$persona = new PersonaController;	
$personas = $persona->ListarPersonalTI(1); 
 ?>
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Origen">Origen de Información</a></li>
            <li class="active">Registrar</li>
          </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Registrar Curso</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmRegistrarCurso"  action="?c=Curso&a=Registrar" method="post" enctype="multipart/form-data" role="form">	   				

					    <div class="form-group col-md-3 formulario__grupo formulario__grupo-correcto" id="grupo__nombre" >
					        <label for="nombre" class="formulario__label">Nombre del curso</label>
					        	<div class="formulario__grupo-input">
					        		<input type="text" id="nombre" name="nombre" value="" class="form-control  formulario__input" placeholder=""  required />
					        	</div> 	
					    </div>


					    <div class="form-group col-md-3">
					        <label for="profesor">Nombre profesor</label>
					        <input type="text" id="profesor" name="profesor" value="" class="form-control formulario__input" placeholder=""  required />
					    </div>					   
					  	<div class="col-md-12" style="margin-top:2em;">
					  		<div class="col-md-6 col-sm-12">
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12" disable><i class="fa fa-save"></i> Registrar</button>    		      
					    </div>
					     <div class="col-md-6 col-sm-12">					    
					        <a href="index.php?c=Curso" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle"></i> Cancelar</a>
					    </div>  
					  </div>
					</form> 
                </div>      
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script>
          
	$(document).ready(function() {
		$("#btnSubmit").click(function(event) {



			bootbox.dialog({
	            message: "¿Estas seguro de Registrar?",
	            title: "Registrar Curso",
	            buttons: {
	                main: {
	                    label: "Registrar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmRegistrarCurso" ).submit();
	                    }
	                },
	                danger: {
	                    label: "Cancelar",
	                    className: "btn-danger",
	                    callback: function() {
	                        bootbox.hideAll();
	                    }
	                }
	            }
        	}); 
		});

		$("#nombre").focusout(function() {
			$(this).val(PrimeraLetraMayuscula($(this).val()))
  		});
  		$("#profesor").focusout(function() {
  			$(this).val(PrimeraLetraMayuscula($(this).val()))
  		});







	});

	function PrimeraLetraMayuscula(string){
		var capitalize=string.toLowerCase();
  		return capitalize.charAt(0).toUpperCase() + capitalize.slice(1);
	}

</script>

