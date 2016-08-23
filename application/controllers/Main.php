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

}
?>
