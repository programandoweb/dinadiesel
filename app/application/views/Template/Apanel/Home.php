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
				<h5>Citas Asignadas</h5>
			</div>
    </div>
		<div class="col-12 col-md-4">
			<div class="card p-3">
				<h5>Citas Procesadas</h5>
			</div>
    </div>
	</div>
</div>
