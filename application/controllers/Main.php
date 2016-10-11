<?php
class Main extends CI_Controller {
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

		$data['title'] = ':: CEDAP - UFRGS ::';
		$this -> load -> view('header/header', $data);
		$this -> load -> view('header/header_print', $data);

		if (!(isset($data['nocab']))) {
			$this -> load -> view('menus/menu_cab_top', $data);
		} else {
			$this -> load -> view('header/header_nomargin.php', null);
		}

		$this -> users -> security();
	}

	function footer() {
		$this -> load -> view('header/footer', null);
	}

	function index() {
		$this -> cab();
		$this -> load -> view('home', null);
		$this -> footer();
	}

	function collections($id = '') {
		/* Load Model */
		$model = 'colletions';
		$this -> load -> model($model);

		/* Controller */
		$this -> cab();

		$data = array();
		$data['title'] = 'Coleções';

		$form = new form;
		$form = $this -> $model -> row($form);
		$form -> tabela = $this -> $model -> table;
		$form -> see = true;
		$form -> novo = false;
		$form -> edit = false;

		$form -> row_edit = '';
		$form -> row_view = base_url('index.php/main/colletion_view');
		$form -> row = base_url('index.php/main/collections');

		$data['content'] = row($form, $id);

		$this -> load -> view('content', $data);
	}

	function colletion_view($id = 0, $chk = '') {
		/* Load Model */
		$model = 'colletions';
		$this -> load -> model($model);
		$this -> load -> model('files');

		/* Controller */
		$this -> cab();

		$data = $this -> $model -> le($id);
		$tela = $this -> load -> view('colletion/view', $data, true);

		$tela .= '<br>';
		/* checa folder */
		$path = $this -> files -> temp_dir;
		if (strlen($data['c_folder']) > 0) {
			$path .= '/' . trim($data['c_folder']);
		}
		if (!is_dir($path)) {
			mkdir($path) or dir("Erro ao criar arquivo");
		}
		if (is_dir($path)) {
			$tela .= '<a href="' . base_url('index.php/io/dir/' . $data['c_folder']) . '" class="btn btn-primary">' . msg('folder') . '</a>';
			$data = array();

			$dados['content'] = $tela;
			$dados['title'] = '';
			$this -> load -> view('content', $dados);
		}

		$this -> footer();
	}

	function folders() {
		$this -> load -> model('files');
		$this -> cab();
		$data['content'] = $this -> files -> folders();

		$data['title'] = msg('folder');
		$this -> load -> view('content', $data);
		$this -> footer();
	}

	function folder_select($id = 0, $chk = '') {
		$this -> load -> model('files');
		$dt = $this -> files -> le_folder($id);
		if (count($dt) == 0) {
			redirect(base_url('index.php/main/folders'));
		} else {
			$this -> files -> folder_set($id);
			redirect(base_url('index.php/io'));
		}
	}

	function cover_sheet($id) {
		$this -> load -> helper('tcpdf');

		/* Load Model */
		$model = 'colletions';
		$this -> load -> model($model);
		$data = $this -> $model -> le($id);
		$data['content'] = $this -> load -> view('colletion/view', $data, true);

		$this -> load -> view('colletion/cover_sheet', $data);
	}

	function convert_tif_to_jpg() {
		/* Read the image */
		$im = new Imagick("d://_REPOSITORIO//test.png");

		/* Thumbnail the image */
		$im -> thumbnailImage(200, null);

		/* Create a border for the image */
		$im -> borderImage(new ImagickPixel("white"), 5, 5);

		/* Clone the image and flip it */
		$reflection = $im -> clone();
		$reflection -> flipImage();

		/* Create gradient. It will be overlayed on the reflection */
		$gradient = new Imagick();

		/* Gradient needs to be large enough for the image and the borders */
		$gradient -> newPseudoImage($reflection -> getImageWidth() + 10, $reflection -> getImageHeight() + 10, "gradient:transparent-black");

		/* Composite the gradient on the reflection */
		$reflection -> compositeImage($gradient, imagick::COMPOSITE_OVER, 0, 0);

		/* Add some opacity. Requires ImageMagick 6.2.9 or later */
		$reflection -> setImageOpacity(0.3);

		/* Create an empty canvas */
		$canvas = new Imagick();

		/* Canvas needs to be large enough to hold the both images */
		$width = $im -> getImageWidth() + 40;
		$height = ($im -> getImageHeight() * 2) + 30;
		$canvas -> newImage($width, $height, new ImagickPixel("black"));
		$canvas -> setImageFormat("png");

		/* Composite the original image and the reflection on the canvas */
		$canvas -> compositeImage($im, imagick::COMPOSITE_OVER, 20, 10);
		$canvas -> compositeImage($reflection, imagick::COMPOSITE_OVER, 20, $im -> getImageHeight() + 10);

		/* Output the image*/
		header("Content-Type: image/png");
		echo $canvas;
	}

	function myaccount() {
		$id = $_SESSION['id'];

		$this -> cab();
		$data['title'] = '';
		$data['content'] = $this -> users -> my_account($id);
		$this -> load -> view('content', $data);
	}

	function change_password() {
		$id = $_SESSION['id'];

		$this -> cab();
		$data['title'] = '';

		$data['content'] = $this -> users -> change_password($id);
		$this -> load -> view('content', $data);
	}

	function change_my_sign() {
		$id = $_SESSION['id'];

		$this -> cab();
		$data['title'] = '';

		$data['content'] = $this -> users -> change_sign($id);
		$this -> load -> view('content', $data);
	}

	function filescan() {
		$dir = get("dd1");
		$this -> load -> model('files');
		$this -> cab();
		$data['title'] = 'Jobs';
		$txt = $this -> files -> dirscan($dir);
		$data['content'] = $txt;
		$this -> load -> view('content', $data);
	}

}
?>
