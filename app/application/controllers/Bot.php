<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bot extends CI_Controller {

	var $Token,$perfil_busqueda,$Disciplinas,$html,$last_id,$is_true;

	public function __construct(){
    parent::__construct();
		$simple_html_dom	=	PATH_LIBRARIES. '/simple_html_dom.php';
		include_once($simple_html_dom);
		$this->html = new simple_html_dom();
  }

	public function Spider(){
		$method	=	$this->uri->segment(3);
		if(method_exists($this,$method)){
			$this->$method();
		}
	}

	private function Yutong(){
		$this->load->model("Scraping/Yutong_model");
		$this->Yutong_model	= 	new Yutong_model();
		$this->Yutong_model->Scraping();
	}
}
?>
