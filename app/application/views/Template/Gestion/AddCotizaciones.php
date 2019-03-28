<?php
/*
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$row=$data;
?>
<?php echo form_open_multipart(current_url(),array('ajasx' => 'true',"class"=>"form-signin"),array("id"=>$this->uri->segment(4)));	?>
<div class="container">
	<div class="card p-5">
		<div class="row mb-3 justify-content-md-center">
			<div class="col-6 h6">
				<div class="btn-group btn-block" role="group" aria-label="Basic example">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-upload"></i> <?php echo (!isset($row->tarea_id))?'Crear':'Actualizar'?> </button>
					<a href="<?php echo (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:base_url("Gestion/Citas")?>" class="btn btn-danger text-white"><i class="fas fa-ban mr-2"></i> Cancelar</a>
				</div>
			</div>
		</div>
		<div class="row ">
			<div class="col-4 border-primary-right">
				<h3>Datos del Solicitante</h3>
				<div class="row ">
					<div class="col-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-user mr-2"></i> Solicitante</label>
							</div>
							<?php if(empty($row)){?>
							<?php echo MakeUsers("usuario_solicitante",@$row->usuario_solicitante,$extra=array("require"=>"require","class"=>"custom-select"));?>
						<?php }else{
								$user_solicitante	=	usuarios_x_id($row->usuario_solicitante);
								echo set_input("",@$user_solicitante->nombres.' '.@$user_solicitante->apellidos,'',true,' text-secondary ',array("readonly"=>"readonly"));
							}
						?>
		        </div>
					</div>
	      </div>
				<div class="row ">
					<div class="col-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-id-card mr-2"></i> Placas 3 últimos dígitos</label>
							</div>
							 <?php echo set_input("placa",@$row,$placeholder='Placas 3 últimos dígitos',true,' text-secondary ',array("maxlength"=>"3"));?>
		        </div>
					</div>
	      </div>
				<div class="row ">
					<div class="col-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-id-card mr-2"></i> Estatus </label>
							</div>
							<?php echo MakeEstadoTarea("estatus",@$row->estatus,$extra=array("class"=>"custom-select"));?>
		        </div>
					</div>
	      </div>
	    </div>
			<div class="col-8">
				<div class="row ">
					<div class="col-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-id-card mr-2"></i> Trabajo a realizar</label>
							</div>
							 <?php echo set_input("tarea",@$row->tarea,$placeholder='Trabajo a realizar',true,' text-secondary ',array());?>
		        </div>
					</div>
	      </div>
				<div class="row ">
					<div class="col-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-calendar-alt mr-2"></i> Inicia</label>
							</div>
							<?php echo set_input("fecha_inicio",@$row,$placeholder='Fecha',true,' text-secondary ',array("id"=>"fecha_inicio","readonly"=>"readonly"));?>
		        </div>
					</div>
					<div class="col-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-calendar-alt mr-2"></i>Expira</label>
							</div>
							<?php echo set_input("fecha_final",@$row,$placeholder='Fecha',false,' text-secondary ',array("id"=>"fecha_final","readonly"=>"readonly"));?>
		        </div>
					</div>
	      </div>
				<div class="row ">
					<div class="col-12">
		        <div class="md-form mt-0 mb-0">
		          <?php
								$data = array('name' => 'descripcion_completa','value' =>@$row->descripcion_completa, 'class' => 'md-textarea form-control text-secondary' ,'rows' => '3','placeholder' => 'Descripción completa', 'cols' => '40','require'=>'true');
								echo form_textarea($data);
							?>
		        </div>
					</div>
	      </div>
			</div>
		</div>
	</div>
</div>
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


		$( "#fecha_final" ).datepicker({ 	minDate: "+1M",
																				maxDate: "+1M +20D",
																				beforeShowDay: function(date) {
																					var day = date.getDay();
    																			return [(day != 6 && day != 0), ''];
  																			}}
																		);
		$( "#fecha_final" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#fecha_final" ).val("<?php echo @$row->fecha_final;?>");
		submit_via_ajax();
	})
</script>
