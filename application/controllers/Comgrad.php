<?php
class comgrad extends CI_Controller {
	function __construct() {
		global $dd, $acao;
		parent::__construct();
		$this -> lang -> load("app", "portuguese");
		$this -> load -> helper('form_sisdoc');
		$this -> load -> model('users');

		date_default_timezone_set('America/Sao_Paulo');
	}

	function cab($data = array()) {
		$js = array();
		$css = array();
		array_push($js, 'form_sisdoc.js');
		array_push($js, 'jquery-ui.min.js');

		$data['js'] = $js;
		$data['css'] = $css;

		$data['title'] = ':: COMGRAD/BIB - UFRGS ::';
		$this -> load -> view('comgrad/header', $data);
		$this -> load -> view('comgrad/header_print', $data);

		if (!(isset($data['nocab']))) {
			$this -> load -> view('comgrad/menu_cab_top', $data);
		} else {
			$this -> load -> view('comgrad/header_nomargin.php', null);
		}

		//$this -> users -> security();
	}

	function footer() {
		$this -> load -> view('comgrad/footer', null);
	}
	
	function index()
		{
			$this->cab();
		}
		
	function prerequisito()
		{
			$model = 'comgrads';
			$this->load->model($model);
			
			$this->cab();
			$data['title'] = 'Quebra de Pré-Requisito';
			$data['content'] = $this->$model->form();
			$this->load->view('content',$data);
			$this->footer();
		}

}
?>
