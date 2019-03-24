INSERT INTO pgrw_tareas_maestro_subservicios (servicio_id, sub_servicio, descripcion , estatus ) SELECT servicio_id,servicio,descripcion,1 FROM pgrw_tareas_maestro_servicios_old WHERE tipo = "servicios"




INSERT INTO pgrw_tareas_maestro_subservicios (servicio_id, sub_servicio, descripcion , estatus ) SELECT servicio_id,servicio,descripcion,1 FROM pgrw_tareas_maestro_servicios_old WHERE `tipo_servicio` IS NULL
