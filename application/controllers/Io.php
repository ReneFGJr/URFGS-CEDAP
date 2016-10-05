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
		$id = round(get("dd0"));
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

		$fl = $this -> files -> files($file);
		$file = $this -> files -> temp_dir . $file . '/' . $fl[$id];

		$type = $this -> files -> filetype($file);
		if ($type == 'oip') { $type = 'xml';
		}
		if ($type == 'ois') { $type = 'xml';
		}
		if ($type == 'ojp') { $type = 'xml';
		}
		if ($type == 'ojs') { $type = 'xml';
		}

		switch ($type) {
			case 'jpg' :
				header('Content-Type: image/jpg');
				break;
			case 'bmp' :
				header('Content-Type: image/bmp');
				break;
			case 'xml' :
				$xml = simplexml_load_file($file);
				echo '<pre>';
				print_r($xml);
				echo '</pre>';
				return ('');

				header("Content-type: text/xml");
				header('Content-Disposition: filename="' . $fl[$id] . '.xml"');
				break;
			case 'htm' :
				header("Content-type: text/html");
				header('Content-Disposition: filename="' . $fl[$id] . '.xml"');
				break;
			case 'pdf' :
				header("Content-type:application/pdf");
				break;
		}
		readfile($file);
	}

	function dir($d1 = '', $d2 = '', $d3 = '', $d4 = '', $d5 = '', $d6 = '', $d7 = '', $d8 = '') {
		$this -> load -> model('files');
		$this -> load -> model('microservices');

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
			if (!isset($files[$id])) {
				redirect(base_url('index.php/io/dir/' . $d1));
			}
			$fl = $files[$id];
			$preview = $this -> files -> filePreview($id, $fl, $path);
		} else {
			$preview = '';
			$preview = $this -> files -> thumb($path);
			$fl = '';
		}
		$data['tree'] = $this -> files -> listDir($path, $link);
		$data['files'] = $this -> files -> listFile($path, $link);
		$data['files_metadata'] = $preview;
		$data['actions'] = $this -> microservices -> action($path, $fl);
		$this -> load -> view('io/home', $data);
		$this -> footer();
	}

	function file_convert($pth = '') {
		$this -> load -> model('microservices');
		$this -> load -> model('files');

		$data['nocab'] = true;
		$this -> cab($data);

		$file = get("dd0") . '.tif';
		$data = array();
		$data['jobs'] = $pth;
		$data['files'] = array($file);

		$this -> files -> create_jpg_from_tiff($data);

		$data['content'] = '<script> wclose(); </script>';
		$this -> load -> view('content', $data);
	}

	function dir_normatize($pth = '', $d1 = '', $d2 = '', $d3 = '', $d4 = '', $d5 = '', $d6 = '', $d7 = '') {
		if (strlen($d1) > 0) { $pth .= '/' . $d1;
		}
		if (strlen($d2) > 0) { $pth .= '/' . $d2;
		}
		if (strlen($d3) > 0) { $pth .= '/' . $d3;
		}
		if (strlen($d4) > 0) { $pth .= '/' . $d4;
		}
		if (strlen($d5) > 0) { $pth .= '/' . $d5;
		}
		if (strlen($d6) > 0) { $pth .= '/' . $d6;
		}
		if (strlen($d7) > 0) { $pth .= '/' . $d7;
		}

		$this -> load -> model('microservices');
		$this -> load -> model('files');
		$files = $this -> files -> files($pth);
		$data['nocab'] = true;
		$this -> cab($data);

		for ($r = 0; $r < count($files); $r++) {
			$data['content'] = 'Convertendo ' . $files[$r] . '<br>';
			$data['title'] = '';
			$type = $this -> files -> filetype($files[$r]);
			$f1 = $files[$r];
			$f2 = name_normalize($files[$r]);
			echo '<br>==>' . $f1 . ' ' . $f2;
			if ($f1 != $f2) {
				echo ' rename';
				$data['jobs'] = $pth;
				$data['file'] = $f1;
				$data['dir'] = $this -> files -> temp_dir;
				$this -> microservices -> exec('rename', $data);
			}
		}
		//		$data['content'] = '<script> wclose(); </script>';
		$this -> load -> view('content', $data);
	}

	function dir_createpreview($pth = '') {
		$this -> load -> model('microservices');
		$this -> load -> model('files');
		$files = $this -> files -> files($pth);
		$data['nocab'] = true;
		$this -> cab($data);

		for ($r = 0; $r < count($files); $r++) {
			$data['content'] = 'Convertendo ' . $files[$r] . '<br>';
			$data['title'] = '';
			$type = $this -> files -> filetype($files[$r]);

			if ($type == 'tif') {

				$file = $files[$r];
				$data = array();
				$data['jobs'] = $pth;
				$data['files'] = array($file);

				$this -> files -> create_jpg_from_tiff($data);

				$this -> load -> view('content', $data);
				$this -> output -> append_output(ob_get_contents());
			}
		}
		$data['content'] = '<script> wclose(); </script>';
		$this -> load -> view('content', $data);
	}

	function file_access($pth = '') {
		$this -> load -> model('microservices');
		$this -> load -> model('files');
		$file = get("dd0");
		$confirm = get("confirm");

		$data = array();
		$data['nocab'] = true;
		$data['link'] = base_url('index.php/io/file_access/' . $pth);

		$this -> cab($data);

		$this -> load -> view('confirm', $data);

		if ($confirm == '1') {

			$data['jobs'] = $pth;
			$data['file'] = $file;
			$data['dir'] = $this -> files -> temp_dir;
			$this -> microservices -> exec('access', $data);

			$data['content'] = '<script> wclose(); </script>';
			$this -> load -> view('content', $data);
		}
	}

	function file_conserve($pth = '') {
		$this -> load -> model('microservices');
		$this -> load -> model('files');
		$file = get("dd0");
		$confirm = get("confirm");

		$data = array();
		$data['nocab'] = true;
		$data['link'] = base_url('index.php/io/file_conserve/' . $pth);

		$this -> cab($data);

		$this -> load -> view('confirm', $data);

		if ($confirm == '1') {

			$data['jobs'] = $pth;
			$data['file'] = $file;
			$data['dir'] = $this -> files -> temp_dir;
			$this -> microservices -> exec('preserv', $data);

			$data['content'] = '<script> wclose(); </script>';
			$this -> load -> view('content', $data);
		}
	}

	function file_undelete($pth = '') {
		$data['nocab'] = true;
		$this -> cab($data);
		$this -> load -> model('microservices');
		$this -> load -> model('files');
		$file = get("dd0");

		$data = array();
		$data['jobs'] = $pth;
		$data['file'] = $file;
		$data['dir'] = $this -> files -> temp_dir;
		$this -> microservices -> exec('undelete', $data);
		$data['content'] = '<script> wclose(); </script>';
		$this -> load -> view('content', $data);
	}

	function file_delete($pth = '') {
		$this -> load -> model('microservices');
		$this -> load -> model('files');
		$file = get("dd0");
		$confirm = get("confirm");

		$data = array();
		$data['nocab'] = true;
		$data['link'] = base_url('index.php/io/file_delete/' . $pth);
		$this -> cab($data);

		$this -> load -> view('confirm', $data);

		if ($confirm == '1') {

			$data['jobs'] = $pth;
			$data['file'] = $file;
			$data['dir'] = $this -> files -> temp_dir;
			$this -> microservices -> exec('del', $data);

			$data['content'] = '<script> wclose(); </script>';
			$this -> load -> view('content', $data);
		}
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

	function jobs_metadata($pth) {
		$this -> load -> model('microservices');
		$this -> load -> model('files');
		$file = get("dd0");
		$confirm = get("confirm");

		$data = array();

		$cp = array();
		array_push($cp, array('$H8', '', '', False, True));
		$sql = "select * from collections where c_status = 1 ";
		array_push($cp, array('$Q id_c:c_name:' . $sql, '', 'Selecione o Projeto', True, True));
		//array_push($cp, array('$D8', '', 'Data do processamento', True, True));
		array_push($cp, array('$B8', '', 'Gerar Metados & Cover page >>', False, True));
		array_push($cp, array('$T80:5', '', 'Informações', False, True));
		$form = new form;
		$form -> id = 0;
		$form -> cp = $cp;
		$data['title'] = 'Metadados';
		$data['content'] = $form -> editar($cp, '');

		if ($form -> saved > 0) {;
			$this -> microservices -> cover_sheet(get("dd1"), $pth);
		} else {

			$data['nocab'] = true;
			$data['link'] = base_url('index.php/io/jobs_metadata/' . $pth);
			$this -> cab($data);
			$this -> load -> view('content', $data);
		}

	}

	function directory($path = '') {
		$this -> load -> model('microservices');
		$this -> load -> model('files');
		$this->files->normalize_names($path);
	}

}
?>
