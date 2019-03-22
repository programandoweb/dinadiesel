<?php
/*
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$row=$data;
?>
<?php echo form_open_multipart(current_url(),array('ajax' => 'true',"class"=>"form-signin"),array("id"=>$this->uri->segment(4)));	?>
<div class="container">
	<div class="row justify-content-md-center ">
		<div class="col bg-blue p-5">
			<div class="row ">
				<div class="col-8">
	        <div class="md-form mt-0 mb-0">
	          <?php echo set_input("tarea",@$row->tarea,$placeholder='Trabajo a realizar',true,' text-secondary',array());?>
	        </div>
				</div>
				<div class="col-4">
	        <div class="md-form mt-0 mb-0">
	          <?php echo set_input("placa",@$row,$placeholder='Placas 3 últimos dígitos',true,' text-secondary ',array("maxlength"=>"3"));?>
	        </div>
				</div>
      </div>
			<div class="row ">
				<div class="col-6">
	        <div class="md-form mt-0 mb-0">
	          <?php echo set_input("fecha_inicio",@$row,$placeholder='Fecha de Inicio',true,' text-secondary ',array("id"=>"fecha_inicio","readonly"=>"readonly"));?>
	        </div>
				</div>
				<div class="col-6">
	        <div class="md-form mt-0 mb-0">
	          <?php echo set_input("fecha_final",@$row,$placeholder='Fecha Finalización',false,' text-secondary ',array("id"=>"fecha_final","readonly"=>"readonly"));?>
	        </div>
				</div>
      </div>
			<div class="row ">
				<div class="col-12">
	        <div class="md-form mt-0 mb-0">
	          <?php
							$data = array('name' => 'descripcion_completa','value' =>@$row->descripcion_completa, 'class' => 'text-secondary md-textarea form-control' ,'rows' => '3','placeholder' => 'Descripción completa', 'cols' => '40','require'=>'true');
							echo form_textarea($data);
						?>
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
