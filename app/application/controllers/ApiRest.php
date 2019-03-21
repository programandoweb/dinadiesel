<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiRest extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->user			=	$this->session->userdata('User');
		if(empty($this->user) && $this->uri->segment(4)!='Upload'){
			redirect(base_url("Main"));	return;
		}
  }

	public function Index(){
    $post   =   post();
    $action =   $post["action"];
    $Key    =   $post["Key"];
    unset($post["action"],$post["Key"]);
    $this->CheckKey=$CheckKey = CheckKey($Key);

    if(method_exists($this, $action)){
      if(!empty($CheckKey)){
        $post["usuario_id"] = $CheckKey->usuario_id;
        $this->$action($post);
        return;
      }else if(!empty($Key) && empty($CheckKey) && $action=='RegisterUser'){
        $new_key  = $this->Key(false,$Key);
        $CheckKey = CheckKey($new_key);
        $post["usuario_id"] = $CheckKey->usuario_id;
        $this->$action($post);
        return;
      }else{
        $this->$action($post);
        return;
      }
    }

    if(empty($this->user)){
			echo json_response(array("data"=>0),"Acceso Restringido",200);
		}else{
			echo json_response(NULL,"Bienvenido, sistema desarrolado por ProgramandoWeb",200);
		}
	}

  private function RegisterUser($post){
    $this->ApiRest->post($post);
    $this->ApiRest->RegisterUser();
    if(!is_null($this->ApiRest->code)){
      echo json_response(array("code"=>$this->ApiRest->code,"data"=>$this->ApiRest->data,"message"=>$this->ApiRest->message));
    }else{
      //echo json_response(NULL,$message = "Acceso Restringido", $code = 200);
    }
  }

  private function LoginUser($post){
    $this->ApiRest->post($post);
    $this->ApiRest->LoginUserUser();
    if(!is_null($this->ApiRest->code)){
      echo json_response( array("code"=>$this->ApiRest->code,"data"=>$this->ApiRest->data,"message"=>$this->ApiRest->message)
    );
    }else{
      //echo json_response(NULL,$message = "Acceso Restringido", $code = 200);
    }
  }

  private function ListarCitas(){
    $this->ApiRest->post(post());
    $this->ApiRest->ListarCitas();
    echo json_response(array("code"=>$this->ApiRest->code,"data"=>$this->ApiRest->data));
  }

  private function ListarMisCitas(){
    $this->ApiRest->key($this->CheckKey);
    $this->ApiRest->post(post());
    $this->ApiRest->Citas();
    //pre($this->ApiRest->data);
    echo json_response(array("code"=>$this->ApiRest->code,"data"=>$this->ApiRest->data));
  }

  private function closeSession(){
    $this->db->where("llave",post("Key"));
		$this->db->update(DB_PREFIJO."keys",array("usuario_id"=>0));
    echo json_response(array("response"=>"Ok"));
  }

	public function Key($print=true,$llave=false){
    $campos		=	array(
                "id"=>null,
                "llave"=>"pgrw::".sha1(rand(10000,9000000)).'::'.md5(date("Y-m-d H:i:s")),
                "level"=>"1",
                "ignore_limits"=>"1000",
                "date_created"=>date("Y-m-d"),
              );
    if($llave){
      $campos["llave"]  = $llave;
    }
    if(post("usuario_id")>0){
      $campos["usuario_id"]  = post("usuario_id");
    }

    $sql = $this->db->set($campos)->get_compiled_insert(DB_PREFIJO."keys");
    $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $sql);
    $this->db->query($sql);
    if($print){
        echo json_response(array("code"=>200,"Key"=>$campos['llave']));
    }else{
        return $campos['llave'];
    }
	}

  public function NuevaCita(){
    $this->ApiRest->key($this->CheckKey);
    $this->ApiRest->post(post());
    $this->ApiRest->NuevaCita();
    if(!is_null($this->ApiRest->code)){
      echo json_response(array("code"=>$this->ApiRest->code,"message"=>$this->ApiRest->message));
    }
  }

	public function Get(){
		$metodo	=	$this->uri->segment(3);
		$this->$metodo();
	}

	public function Push(){
		$metodo	=	$this->uri->segment(3);
		$this->$metodo();
	}

	public function Post(){
		$metodo	=	$this->uri->segment(3);
		$this->$metodo();
	}

	public function Upload(){
		$metodo	=	$this->uri->segment(3);
		$this->$metodo();
	}

	private function Modelos(){
		$this->load->model('Gestion_model');
		$this->Gestion 	= 	new Gestion_model();
		$this->Response 		=			array(	"code"=>"200",
																			"data"=>$this->Gestion->GetModeloXMarca($this->uri->segment(4))
																		);
		echo answers_json($this->Response);
	}

	private function Subtipo(){
		$this->load->model('Gestion_model');
		$this->Gestion 	= 	new Gestion_model();
		$this->Response 		=			array(	"code"=>"200",
																			"data"=>$this->Gestion->GetSubtipoXTipo($this->uri->segment(4))
																		);
		echo answers_json($this->Response);
	}

	private function Subtipofinal(){
		$this->load->model('Gestion_model');
		$this->Gestion 	= 	new Gestion_model();
		$this->Response 		=			array(	"code"=>"200",
																			"data"=>$this->Gestion->GetSubtipoXTipoFinal(post("q"))
																		);
		echo answers_json($this->Response);
	}

	private function Images(){
		$imagen	=	upload('userfile',$path='images/uploads/'.$this->uri->segment(4).'/',$config=array("allowed_types"=>'gif|jpg|png',"renombrar"=>"PGRW_".rand(5000,600000),"max_size"=>2000,"max_width"=>2000,"max_height"=>2000));
		echo json_encode(array(
			'name'  => @$imagen["upload_data"]["imagen_nueva"],
			'error' => @$imagen["upload_data"]["error"],
		));
	}

	private function ImagesUp(){
		$imagen	=	upload('img','images/uploads/'.get("folder").'/',$config=array("allowed_types"=>'gif|jpg|png',"renombrar"=>get("name"),"max_size"=>4000,"max_width"=>4000,"max_height"=>4000));
		echo json_encode(array(
			'status'  => 	"success",
			'url'  		=>  @$imagen["upload_data"]["imagen_nueva"].'?rand='.rand(1000,50000),
		));
	}

	private function Profile(){
		$this->load->model('Autenticacion_model');
		$this->Autenticacion 	= 	new Autenticacion_model();
		$this->Autenticacion->set_user(post(),TRUE);
		$this->session->set_userdata(array('User'=>$this->Autenticacion->user));
		$this->Response 		=			array(	"code"		=>	"200","callback"=>"toggle(".json_encode($this->Autenticacion->user).")" );
		echo answers_json($this->Response);
	}

}
?>
