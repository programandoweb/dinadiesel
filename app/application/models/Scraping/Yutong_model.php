<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yutong_model extends CI_Model {

	var $return=false;

	public function Scraping(){
		$next				=	get("next");
		$url				=	"https://es.yutong.com/products/".$next;
		$this->Scraping2($url);
		return;
		@$this->html->load_file($url);

		foreach($this->html->find('.st-add-list ul li') as $key => $element){
			$insert						=		new stdClass();
			$insert->marca_id	=		1;
			$insert->estatus	=		1;
			$insert->modelo		=		trim($element->find("h2",0)->plaintext);
			$insert->json			=		json_encode(array(	"url"	=>	$element->find("h2 a",0)->href,
																								"image"	=>	$element->find(".image a img",0)->src,
																							));
			$sql = $this->db->set($insert)->get_compiled_insert(DB_PREFIJO."maestro_modelo");
			$sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $sql);
			$this->db->query($sql);
			pre($insert);
		}

		$get_page	=		(int) get("page");
		$page			=		(!empty(get("page")))? 1 + $get_page	: 2;
		$url			=		base_url("Bot/Spider/Yutong").'?page='.$page.'next=index_'.$page.".html";

		echo $url;
		if(1==1){
		?>
			<script>setTimeout(function () {
				window.location.href = "<?php echo $url;?>";
			}, 20000); </script>
		<?php
		}

	}

	function Scraping2($url){
		return;
		$url			=		"https://es.yutong.com";
		$tabla		=		DB_PREFIJO."maestro_modelo";
		$this->db->select("*")->from($tabla);
		$rows	 	=		$this->db->get()->result();
		foreach ($rows as $key => $value) {
			if(!empty($value->json)){
				$json=json_decode($value->json);
				@$this->html->load_file($url.$json->url);
				foreach($this->html->find('.c-box2') as $key => $element){
					$json->html	=	$element->innertext;
					$update	=	array("json"=>json_encode($json));
					$this->db->where("modelo_id",$value->modelo_id);
					$this->db->update(DB_PREFIJO."maestro_modelo",$update);
					//pre($update);
				}
			}
			sleep(5);
		}
	}
}
?>
