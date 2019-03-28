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
<?php echo form_open_multipart(current_url(),array('ajaax' => 'true',"class"=>"form-signin"),array("tarea_id"=>$this->uri->segment(4)));	?>
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
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-user mr-2"></i> Asignado</label>
							</div>
							<?php echo MakeUsers("usignado_a_usuario_id",@$row->usignado_a_usuario_id,$extra=array("class"=>"custom-select","tipo_id"=>3));?>
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
				<h3>Servicio</h3>
				<div class="row ">
					<div class="col-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="far fa-money-bill-alt mr-2"></i> Tipo de Servicio</label>
							</div>
							<?php if(empty($row)){?>
							<?php echo MakeTipoServicio("tipo",@$row->tipo);?>
						<?php	}else{
								$tipo	=	getTipo($row->tipo);
								set_input_mix("tipo",@$row->tipo,@$tipo->servicio);
							}
						?>
		        </div>
					</div>
	      </div>
				<div class="row ">
					<div class="col-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="far fa-money-bill-alt mr-2"></i> Sub Servicio</label>
							</div>
							<?php if(empty($row)){?>
									<select name="sub_tipo"  class="custom-select mb-2 mr-sm-2 mb-sm-0 browser-default" id="sub_tipo">
										<option value="">Seleccione</option>
									</select>
							<?php	}else{
								$servicio	=	getServicio($row->sub_tipo);
								set_input_mix("sub_tipo",@$row->sub_tipo,@$servicio->sub_servicio);
							}?>
		        </div>
					</div>
	      </div>
				<div class="row ">
					<div class="col-12">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="far fa-money-bill-alt mr-2"></i> Servicio Final</label>
							</div>
							<?php if(empty($row)){?>
							<select name="sub_tipo_final"  class="custom-select mb-2 mr-sm-2 mb-sm-0 browser-default" id="sub_tipo_final">
								<option value="">Seleccione</option>
							</select>
						<?php	}else{
								$subserviServicio	=	getServicio($row->sub_tipo_final);
								set_input_mix("sub_tipo_final",@$row->sub_tipo_final,@$subserviServicio->sub_servicio);
							}
						?>
		        </div>
					</div>
	      </div>
				<div class="row ">
					<div class="col-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="far fa-money-bill-alt mr-2"></i> Marca</label>
							</div>
							<?php echo makeMarcas("marca_id",@$row->marca_id);?>
		        </div>
					</div>
					<div class="col-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="far fa-money-bill-alt mr-2"></i> Modelo</label>
							</div>
							<?php echo makeModelo("modelo_id",@$row->modelo_id);?>
		        </div>
					</div>
	      </div>
				<div class="row ">
					<div class="col-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-calendar-alt mr-2"></i> Inicio</label>
							</div>
							<?php echo set_input("fecha_inicio",@$row,$placeholder='Fecha',true,' text-secondary ',array("id"=>"fecha_inicio","readonly"=>"readonly"));?>
		        </div>
					</div>
					<div class="col-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text text-white" for="inputGroupSelect01"><i class="fas fa-calendar-alt mr-2"></i>Culminación</label>
							</div>
							<?php echo set_input("fecha_final",@$row,$placeholder='Fecha',false,' text-secondary ',array("id"=>"fecha_final","readonly"=>"readonly"));?>
		        </div>
					</div>
	      </div>
				<div class="row ">
					<div class="col-12">
		        <div class="md-form mt-0 mb-0">
		          <?php
								$data = array('name' => 'descripcion_completa','value' =>@$row->descripcion_completa, 'class' => 'text-secondary md-textarea form-control' ,'rows' => '3','placeholder' => 'Descripción completa', 'cols' => '40');
								echo form_textarea($data);
							?>
		        </div>
					</div>
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
		$("#sub_tipo").change(function(){
			if($(this).val()!=''){
				$.post("<?php echo base_url("ApiRest/Get/Subtipofinal/")?>",{q:$(this).val()},function(data){
					if(data.data){
						var html	=		'<option value="" selected="selected">Seleccione</option>';
						$.each(data.data,function(k,v){
							html	+=		'<option value="'+v.id+'">'+v.sub_servicio+'</option>';
						});
						$("#sub_tipo_final").html(html);
					}
				},'json');
			}
		});
		$("#tipo").change(function(){
			if($(this).val()!=''){
				$.post("<?php echo base_url("ApiRest/Get/Subtipo/")?>"+$(this).val(),function(data){
					if(data.data){
						var html	=		'<option value="" selected="selected">Seleccione</option>';
						$.each(data.data,function(k,v){
							html	+=		'<option value="'+v.id+'">'+v.sub_servicio+'</option>';
						});
						$("#sub_tipo").html(html);
					}
				},'json');
			}
		});
		$("#marca_id").change(function(){
			if($(this).val()!=''){
				$.post("<?php echo base_url("ApiRest/Get/Modelos/")?>"+$(this).val(),function(data){
					if(data.data){
						var html	=		'<option value="" selected="selected">Seleccione</option>';
						$.each(data.data,function(k,v){
							html	+=		'<option value="'+v.modelo_id+'">'+v.modelo+'</option>';
						});
						$("#modelo_id").html(html);
					}
				},'json');
			}
		});
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
