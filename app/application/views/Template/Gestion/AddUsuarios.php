<?php
/*
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$row=$data;
//pre($row);
?>
<?php echo form_open_multipart(current_url(),array('ajaxS' => 'true',"class"=>"form-signin"),array("usuario_id"=>$this->uri->segment(4)));	?>
<div class="container">
	<div class="card p-5">
		<div class="row mb-3 justify-content-md-center">
			<div class="col-6 h6">
				<div class="btn-group btn-block" role="group" aria-label="Basic example">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-upload"></i> <?php echo (!isset($row->tarea_id))?'Crear':'Actualizar'?> </button>
					<a href="<?php echo base_url("Gestion/Usuarios")?>" class="btn btn-danger text-white"><i class="fas fa-ban mr-2"></i> Cancelar</a>
				</div>
			</div>
		</div>
		<div class="row ">
			<div class="col-4">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-user mr-2"></i> Tipo de Usuario</label>
					</div>
					<?php echo MakeTipoUsuarios("tipo_id",@$row->tipo_id);?>
				</div>
			</div>
			<div class="col-4">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-user mr-2"></i> Nombres</label>
					</div>
					<?php echo set_input("nombres",@$row,$placeholder='Nombres',true,' text-secondary ',array("maxlength"=>"50"));?>
				</div>
			</div>
			<div class="col-4">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text text-white" for="inputGroupSelect02"><i class="fas fa-user mr-2"></i> Apellidos</label>
					</div>
					<?php echo set_input("apellidos",@$row,$placeholder='Apellidos',true,' text-secondary ',array("maxlength"=>"50"));?>
				</div>
			</div>
		</div>
		<div class="row ">
			<div class="col-4">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-user mr-2"></i> Teléfono</label>
					</div>
					<?php echo set_input("telefono",@$row,$placeholder='Teléfono',true,' text-secondary ',array());?>
				</div>
			</div>
			<div class="col-4">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-user mr-2"></i> Email</label>
					</div>
					<?php echo set_input("email",@$row,$placeholder='Correo electrónico',true,' text-secondary ',array("maxlength"=>"150"));?>
				</div>
			</div>
			<div class="col-4">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text text-white" for="inputGroupSelect02"><i class="fas fa-user mr-2"></i> Estatus</label>
					</div>
					<?php echo MakeEstado("estatus",@$row->estatus,array("class"=>"custom-select mb-2 mr-sm-2 mb-sm-0 browser-default"));?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close();?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$(document).ready(function(){
		$( "#fecha_inicio" ).datepicker({ 	minDate: "+1M",
																				maxDate: "+1M +20D",
																				beforeShowDay: function(date) {
																					var day = date.getDay();
    																			return [(day != 6 && day != 0), ''];
  																			}}
																		);
		$( "#fecha_inicio" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#fecha_inicio" ).val("<?php echo @$row->fecha_inicio;?>");
		submit_via_ajax();
		$("body").css("background-color","#ffffff");
	})
</script>
