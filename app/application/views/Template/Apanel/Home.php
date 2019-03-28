<div class="container">
	<div class="row justify-content-md-center">
    <div class="col-12 col-md-4">
			<div class="card p-3">
				<h5>Solicitudes</h5>
				<div class="card-body">
					<table class="table ">
						<thead>
							<th >

							</th>
							<th width="50">
								Cant
							</th>
						</thead>
						<?php
							foreach (makeMarcas(null,null,true) as $key => $value) {
						?>
								<tr>
									<td><?php print($value->marca)?></td>
									<td class="text-right"><b>10</b></td>
								</tr>
						<?php
							}
						?>
					</table>
				</div>
			</div>
    </div>
		<div class="col-12 col-md-4">
			<div class="card p-3">
				<h5><a href="<?php echo base_url("Gestion/Citas")?>"> Citas Asignadas <i class="fas fa-search"></i></a></h5>
				<?php //pre($this->Listado);?>
				<div class="card-body">
					<table class="table ">
						<thead>
							<th >
								Servicio
							</th>
							<th width="50">
								Solicitud
							</th>
						</thead>
						<?php
							foreach ($this->Asignadas as $key => $value) {
								$servicio	=	getServicio($value->sub_tipo);
						?>
							<tr>
								<td><a href="<?php echo base_url("Gestion/Citas/Add/".$value->tarea_id."/Iframe")?>"><?php print( $servicio->sub_servicio );?></a></td>
								<td class="text-right"><b><?php echo $value->fecha_inicio?></b></td>
							</tr>
						<?php
						}?>

					</table>
				</div>
			</div>
    </div>
		<div class="col-12 col-md-4">
			<div class="card p-3">
				<h5>Citas Procesadas</h5>
				<div class="card-body">
					<table class="table ">
						<thead>
							<th >
								Servicio
							</th>
							<th width="50">
								Solicitud
							</th>
						</thead>
						<?php
							foreach ($this->Culminadas as $key => $value) {
								$servicio	=	getServicio($value->sub_tipo);
						?>
							<tr>
								<td><a href="<?php echo base_url("Gestion/Citas/Add/".$value->tarea_id."/Iframe")?>"><?php print( $servicio->sub_servicio );?></a></td>
								<td class="text-right"><b><?php echo $value->fecha_inicio?></b></td>
							</tr>
						<?php
						}?>

					</table>
				</div>
			</div>
    </div>
	</div>
</div>
