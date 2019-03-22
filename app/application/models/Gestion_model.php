<?php
/*
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion_model extends CI_Model {

	var $return;

	public function __construct(){
		$this->return	=	new stdClass();
	}

	function GetSubtipoXTipoFinal($tipo_servicio){
		$tabla	=	DB_PREFIJO."maestro_servicios";
		$this->db->select('servicio_id,servicio')->from($tabla);
		$this->db->where("tipo_servicio",$tipo_servicio);
		//$this->db->where("tipo_servicio!=","");
		$query	=	$this->db->get();
		return $query->result();
	}

	function GetSubtipoXTipo($tipo){
		$tabla	=	DB_PREFIJO."maestro_servicios";
		$this->db->select('servicio_id,servicio')->from($tabla);
		$this->db->where("tipo",$tipo);
		//$this->db->where("tipo_servicio!=","");
		$query	=	$this->db->get();
		return $query->result();
	}

	function GetModeloXMarca($marca_id){
		$tabla	=	DB_PREFIJO."maestro_modelo";
		$this->db->select('modelo_id,modelo')->from($tabla);
		$this->db->where("marca_id",$marca_id);
		$query	=	$this->db->get();
		return $query->result();
	}

	function CantInmuebles(){
		$tabla	=	DB_PREFIJO."anuncio";
		$this->db->select('count(id) as total')->from($tabla);
		if($this->user->tipo_id>0){
			$this->db->where("usuario_id",$this->user->usuario_id);
		}
		$query	=	$this->db->get();
		return $query->row()->total;
	}

	function Inmuebles(){
		$tabla	=	DB_PREFIJO."anuncio";
		$this->db->select('id,titulo,precio,estatus,"prueba" as edit')->from($tabla);
		if($this->user->tipo_id>0){
			$this->db->where("usuario_id",$this->user->usuario_id);
		}
		$query	=	$this->db->get();
		return foreach_edit($query->result_array());
	}

	public function Asignaciones($var){
		return $this->Citas($var);
	}

	public function GetInmuebles($id){
		$tabla	=	DB_PREFIJO."anuncio";
		$this->db->select('*,estatus,"prueba" as edit');
		$this->db->from($tabla);
		$this->db->where("id",$id);
		if($this->user->tipo_id>0){
			//$this->db->where("usuario_id",$this->user->usuario_id);
		}
		$query	=	$this->db->get();
		return $query->row();
	}

	public function SetInmuebles($var){
		if(isset($var["callback"])){
			unset($var["callback"]);
		}
		if($this->user->tipo_id>0){
			$var["usuario_id"]		=		$this->user->usuario_id;
		}
		$return =	false;
		if($var["id"]==0){
			$this->return->id		=		$var["id"];
			unset($var["id"]);
			if($this->db->insert(DB_PREFIJO."anuncio",$var)){
				$return=true;
				$this->return->id	=		$insert_id = $this->db->insert_id();
			}
		}else{
			$this->db->where("id",$var["id"]);
			$insert_id = $var["id"];
			if($this->db->update(DB_PREFIJO."anuncio",$var)){
				$this->return->id		=		$var["id"];
				$return=true;
			}
		}

		upload_multiple(	$_FILES["userfile"],
											$path='images/uploads/inmuebles/'.$insert_id,
											$config=array(	"allowed_types"=>'gif|jpg|png',
																			"max_size"=>2048,
																			"max_width"=>2048,
																			"max_height"=>2048));



		return $return;
	}

	public function GetCitas($id){
		$tabla	=	DB_PREFIJO."tareas";
		$this->db->select('*,"prueba" as edit');
		$this->db->from($tabla);
		$this->db->where("tarea_id",$id);
		$query	=	$this->db->get();
		return $query->row();
	}

	public function GetUsuarios($id){
		$tabla	=	DB_PREFIJO."usuarios";
		$this->db->select('usuario_id as id,tipo_id,nombres,apellidos,telefono,estatus, email ,"prueba" as edit');
		$this->db->from($tabla);
		$this->db->where("usuario_id",$id);
		$query	=	$this->db->get();
		return $query->row();
	}

	public function Usuarios($var){
		$start	=	$var["start"];
		$length	=	$var["length"];
		$search	=	$var["search"]["value"];
		$key_order	=	@$var["order"][0]["column"];
		$tabla	=	DB_PREFIJO."usuarios";
		$this->db->select('usuario_id as id,CONCAT(nombres," " ,apellidos) as nombres,telefono, email ,"prueba" as edit');
		$this->db->from($tabla);
		if($search){
		 		$this->db->where("tarea",$search);
		}
		$this->db->where("tipo_id>",0);
		$this->db->limit($length,$start);
		if(isset($var["columns"]) && isset($var["order"])){
				$this->db->order_by($var["columns"][$key_order]["data"],$var["order"][0]["dir"]);
		}
		$query	=	$this->db->get();
		return foreach_edit($query->result_array());
	}

	public function SetAsignaciones($var){
		if($var["usignado_x_usuario_id"]<1){
			$var["usignado_x_usuario_id"]=$this->user->usuario_id;
		}
		return $this->SetCitas($var);
	}

	public function SetCitas($var){
		$return =false;
		if($var["tarea_id"]==0){
			unset($var["id"]);
			if($this->db->insert(DB_PREFIJO."tareas",$var)){
				$this->return->id		= $this->db->insert_id();
				$return=true;
			}
		}else{
			$this->return->id		=		$var["tarea_id"];
			$this->db->where("tarea_id",$var["tarea_id"]);
			if($this->db->update(DB_PREFIJO."tareas",$var)){
				$return=true;
			}
		}
		return $return;
	}

	public function Citas($var){
		$start			=	$var["start"];
		$length			=	$var["length"];
		$search			=	$var["search"]["value"];
		$key_order	=	@$var["order"][0]["column"];
		$tabla			=	DB_PREFIJO."tareas t1";
		$this->db->select('CONCAT(nombres," ",apellidos) AS asignado,tarea_id, tipo as tarea ,fecha_inicio,fecha_final,t1.estatus,t1.tarea_id as id,"prueba" as edit');
		$this->db->from($tabla)->join(DB_PREFIJO."usuarios t2","t1.usignado_a_usuario_id=usuario_id","left");
		if($search){
		 		$this->db->where("tarea",$search);
		}
		if(empty(get("estatus"))){
		 		$this->db->where("t1.estatus<",9);
		}
		$this->db->limit($length,$start);
		if(isset($var["columns"]) && isset($var["order"])){
				$this->db->order_by($var["columns"][$key_order]["data"],$var["order"][0]["dir"]);
		}
		$query	=	$this->db->get();
		return foreach_edit($query->result_array());
	}

	public function CountCitas($var){
		$search			=	$var["search"]["value"];
		$tabla			=		DB_PREFIJO."tareas t1";
		$this->db->select('count(tarea_id) as total');
		$this->db->from($tabla);
		if($search){
				$this->db->where("tarea",$search);
		}
		$query	=	$this->db->get();
		$row=$query->row();
		if(!empty($row)){
			return $row->total;
		}else{
			return 0;
		}
	}

	public function SetCotizaciones($var){
		$return =false;
		if($var["id"]==0){
			unset($var["id"]);
			if($this->db->insert(DB_PREFIJO."cotizaciones",$var)){
				$return=true;
			}
		}else{
			$this->db->where("id",$var["id"]);
			if($this->db->update(DB_PREFIJO."cotizaciones",$var)){
				$return=true;
			}
		}
		return $return;
	}

	public function GetCotizaciones($id){
		$tabla	=	DB_PREFIJO."cotizaciones";
		$this->db->select('*,id,placa,descripcion_completa, tarea ,fecha_inicio,fecha_final,estatus,"prueba" as edit');
		$this->db->from($tabla);
		$this->db->where("id",$id);
		$query	=	$this->db->get();
		return $query->row();
	}

	public function Cotizaciones($var){
		$start	=	$var["start"];
		$length	=	$var["length"];
		$search	=	$var["search"]["value"];
		$key_order	=	@$var["order"][0]["column"];
		$tabla	=	DB_PREFIJO."cotizaciones";
		$this->db->select('id, tarea ,fecha_inicio,fecha_final,estatus,"prueba" as edit');
		$this->db->from($tabla);
		if($search){
		 		$this->db->where("tarea",$search);
		}
		$this->db->limit($length,$start);
		if(isset($var["columns"]) && isset($var["order"])){
				$this->db->order_by($var["columns"][$key_order]["data"],$var["order"][0]["dir"]);
		}
		$query	=	$this->db->get();
		return foreach_edit($query->result_array());
	}

	public function SetUsuarios($var){
		$return =false;
		if($var["usuario_id"]==0){
			$this->return->id		=		$var["usuario_id"];
			unset($var["usuario_id"]);
			if($this->db->insert(DB_PREFIJO."usuarios",$var)){
				$return=true;
			}
		}else{
			$this->return->id		=		$var["usuario_id"];
			$this->db->where("usuario_id",$var["usuario_id"]);
			if($this->db->update(DB_PREFIJO."usuarios",$var)){
				$return=true;
			}
		}
		return $return;
	}

}
?>
