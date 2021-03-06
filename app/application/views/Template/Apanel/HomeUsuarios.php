<div class="container">
	<div class="row justify-content-md-center">
    <div class="col-12 col-md-3">
			<div class="card testimonial-card">
				<div class="card-up indigo lighten-1"></div>
				<div class="avatar mx-auto white mt-4">
					<img style="width:120px;height:120px;" src="<?php echo IMG."design/avatar.jpg"?>" class="rounded-circle" alt="<?php #echo $value->name?>">
				</div>
				<div class="card-body">
					<h6 class="text-center">TusitioVip.com</h6>
					<h5 class="card-title text-center">
						<?php
							if(!empty($this->user->nombres)){
								echo $this->user->nombres;
							}else{
								echo $this->user->email;
							}
						?>
					</h5>
					<hr>
					<p class="text-center">
						<i class="fas fa-quote-left"></i>
						Apasionado por las ventas
						<i class="fas fa-quote-right"></i>
						<?php #echo $value->caption?>
						<a class="btn btn-primary mt-3" href="<?php echo base_url("p/".$this->user->login)?>">Ver y editar mi Perfil</a>
					</p>
				</div>
			</div>
    </div>
		<div class="col-12 col-md-4">
			<div class="card p-3">
				<h3>Estadísticas</h3>
				<div class="card-body">
					<table class="table ">
						<thead>
							<th >

							</th>
							<th width="50">
								Cant
							</th>
						</thead>
						<tr>
							<td>Inmuebles registrados:</td>
							<td class="text-right"><b><?php echo $this->cant_inmuebles;?></b></td>
						</tr>
						<tr>
							<td>Visitas Anónimas:</td>
							<td class="text-right"><b>300</b></td>
						</tr>
						<tr>
							<td>Visitas registrados:</td>
							<td class="text-right"><b>300</b></td>
						</tr>
						<tr>
							<td>Seleccionados Favoritos:</td>
							<td class="text-right"><b>30</b></td>
						</tr>
					</table>
				</div>
			</div>
    </div>
		<div class="col-12 col-md-5">
			<div class="card p-3">
				<div class="text-right">
					<a class="btn btn-primary mr-4" href="<?php echo base_url("Gestion/Inmuebles/Add/0/Iframe")?>">
						Agregar Inmueble
					</a>
				</div>
				<div class="card-body">
					<table class="table ">
						<thead>
							<th >
								Inmueble
							</th>
							<th>
								Precio
							</th>
							<th width="50">
								Acción
							</th>
						</thead>
						<tbody>
							<?php foreach ($this->Listado as $key => $value) {?>
								<tr>
									<td><?php print($value["titulo"])?></td>
									<td><?php print($value["precio"])?></td>
									<td class="text-right">
										<a class="btnbtn-primary" href="<?php echo base_url("Gestion/Inmuebles/Add/".$value["id"]."/Iframe")?>">
											Edit
										</a>
									</td>
								</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
    </div>
	</div>
</div>
