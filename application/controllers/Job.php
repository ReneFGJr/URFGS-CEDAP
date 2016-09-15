<?php
class Job extends CI_Controller {
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

	function file($d1='',$d2='',$d3='',$d4='',$d5='',$d6='',$d7='',$d8='')
		{
			$this -> load -> model('files');
			
			$file = '';
			$dd = array();
			$dd[1] = $d1;
			$dd[2] = $d2;
			$dd[3] = $d3;
			$dd[4] = $d4;
			$dd[5] = $d5;
			$dd[6] = $d6;
			$dd[7] = $d7;
			$dd[8] = $d8;
			
			for ($r=1;$r <= 8;$r++)
				{
					$n = $dd[$r];
					if (strlen($n) > 0)
						{
							if (strlen($file) > 0) { $file .= '/'; }
							$file .= $n;
						}
				}
			
			$file = $this->files->temp_dir.$file;
			//header('Content-Type: image/jpg');
			header('Content-Type: image/bmp');
			readfile($file);			
		}

	function index() {
		$this -> cab();
		$this -> load -> view('home', null);
		$this -> footer();
	}

	function view($job = '',$img=0) {
		$this -> load -> model('files');
		$this -> cab();
		$data['title'] = '';
		$data['content'] = $this -> files -> thumb($job,$img);
		$this -> load -> view('content', $data);
		$this -> footer();
	}
	
	function file_delete($job,$id,$conf='')
		{
			$this -> load -> model('files');
			$data['nocab'] = true;
			$this->cab($data);
			$file = $this->files->temp_dir.$job.'/'.$id;
			if (strlen($conf) == 0)
				{
					$sx = '';
					$sx .= '<hr>';
					$sx .= '<span class="btn btn-danger">'.msg('SIM').'</span>';
					$sx .= ' ';
					$sx .= '<span class="btn btn-default">'.msg('NÃO').'</span>';
					$data['content'] = 'Confirma exclusão de '.$file.'?'.$sx;;
					$data['title'] = '';
					$this->load->view('content',$data);
				}
			
		}
	
	function microservice($job,$file,$service)
		{
			ini_set('max_execution_time', 300); //300 seconds = 5 minutes
			$data['nocab'] = true;
			$this->cab($data);
			
			$this->load->model('files');
			$this->load->model('microservices');
			$sv = $this->microservices->le($service);
			
			if (count($sv) > 0)
				{
					$ln = $sv['s_cmd'];
					$file1 = $this->files->temp_dir.$job.'/'.$file;
					$filen = $file;
					$filen = troca($filen,'.tif','.jpg');
					$filen = troca($filen,'.tiff','.jpg');
					$filen = troca($filen,'.TIF','.jpg');
					$filen = troca($filen,'.TIFF','.jpg');
					
					$file2 = $this->files->temp_dir.$job.'/'.$filen;
					$ln = troca($ln,'$1',$file1);
					$ln = troca($ln,'$2',$file2);
					
					$data['content'] = 'Convertendo';
					$data['title'] = 'Conversão de formato';
					$this->load->view('content',$data);
					
					$sx = '<tt>'.$ln.'</tt>';
					shell_exec($ln);
					$data['content'] = $sx;
					$data['title'] = '';
					$this->load->view('content',$data);
				}
			
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
