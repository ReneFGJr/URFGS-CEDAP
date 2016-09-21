<?php
class IO extends CI_Controller {
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
		redirect(base_url('index.php/io/dir'));
	}

	function image($d1 = '', $d2 = '', $d3 = '', $d4 = '', $d5 = '', $d6 = '', $d7 = '', $d8 = '') {
		$name = get("dd0");
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

		for ($r = 1; $r <= 8; $r++) {
			$n = $dd[$r];
			if (strlen($n) > 0) {
				if (strlen($file) > 0) { $file .= '/';
				}
				$file .= $n;
			}
		}
		$file = $this -> files -> temp_dir . $file;
		echo $file;
		echo '<hr>';
		$fl = $this -> files -> files($file);
		print_r($fl);
		echo $file.'-'.$fl[$id];
		echo '<hr>';		
		
		exit;

		//header('Content-Type: image/jpg');
		//header('Content-Type: image/bmp');
		//readfile($file);
	}

	function img($d1 = '', $d2 = '', $d3 = '', $d4 = '', $d5 = '', $d6 = '', $d7 = '', $d8 = '') {
		$name = get("dd0");
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

		for ($r = 1; $r <= 8; $r++) {
			$n = $dd[$r];
			if (strlen($n) > 0) {
				if (strlen($file) > 0) { $file .= '/';
				}
				$file .= $n;
			}
		}

		$file = $this -> files -> temp_dir . $file;
		echo $file;
		exit ;
		$fl = $this -> files -> files($file);
		print_r($fl);

		//header('Content-Type: image/jpg');
		//header('Content-Type: image/bmp');
		//readfile($file);
	}

	function dir($d1 = '', $d2 = '', $d3 = '', $d4 = '', $d5 = '', $d6 = '', $d7 = '', $d8 = '') {
		$this -> load -> model('files');

		$id = get("dd0");

		$path = '';
		$dd = array();
		$dd[1] = $d1;
		$dd[2] = $d2;
		$dd[3] = $d3;
		$dd[4] = $d4;
		$dd[5] = $d5;
		$dd[6] = $d6;
		$dd[7] = $d7;
		$dd[8] = $d8;

		for ($r = 1; $r <= 8; $r++) {
			$n = $dd[$r];
			if (strlen($n) > 0) {
				if (strlen($path) > 0) { $path .= '/';
				}
				$path .= $n;
			}
		}

		$this -> cab();
		$data = array();
		$link = 'index.php/io/dir/';
		if (strlen($path) > 0) {
			$path = $path;
		} else {
			$path = '';
		}
		$files = $this -> files -> files($path);
		if (strlen($id) > 0) {
			$fl = $files[$id];
			$preview = $this -> files -> filePreview($id, $fl, $path);
		} else {
			$preview = '';
		}
		$data['tree'] = $this -> files -> listDir($path, $link);
		$data['files'] = $this -> files -> listFile($path, $link);
		$data['files_metadata'] = $preview;
		$this -> load -> view('io/home', $data);
		$this -> footer();
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
