<?php
class microservices extends CI_model {

	function action($pth = '', $file = '') {
		$sx = '<hr>';
		$conf = '&confirm=1';

		/* REGRA #01 - não existe miniatura */

		/* REGRA #02 - não existe preview - somente TIFF */
		$sx = $file . '<hr>';
		if (strpos($file, '.tif')) {
			$file2 = troca($file, '.tiff', '.jpg');
			$file2 = troca($file2, '.tiff', '.jpg');
			$sx .= '<button onclick="newxy(\'' . base_url('index.php/io/file_convert/' . $pth . '?dd0=' . $this -> files -> without_type($file)) . $conf . '&dd1=jpg\',750,200);" class="btn btn-success">';
			$sx .= 'Create Preview';
			$sx .= '</button>';
		}

		if (strpos($file, '.jpg')) {
			$img = true;
		} else {
			$img = false;
		}

		/* acao de descrever o projeto */
		if (!(strpos($pth, '/')) and (strlen($file) == 0)) {
			$sx .= '<button onclick="newxy(\'' . base_url('index.php/io/jobs_metadata/' . $pth . '?dd0=' . $this -> files -> without_type($file)) . $conf . '\',750,600);" class="btn btn-success" style="width: 100%">';
			$sx .= 'Criar Dados do Job';
			$sx .= '</button>';
			
			$sx .= '<br>';
			$sx .= '<br>';
			
			$sx .= '<a href="'.base_url('index.php/io/jobs_rename/' . $pth) . '">';
			$sx .= '<button class="btn btn-success" style="width: 100%">';
			$sx .= 'Renomear Job';
			$sx .= '</button>';			
			$sx .= '</a>';
		}

		/* ações para os tipo */
		if (!(strpos($pth, '/')) and $img) {
			$sx .= '<button onclick="newxy(\'' . base_url('index.php/io/file_conserve/' . $pth . '?dd0=' . $this -> files -> without_type($file)) . $conf . '\',750,200);" class="btn btn-success" style="width: 100%">';
			$sx .= 'Matriz para Preservação';
			$sx .= '</button>';

			$sx .= '<br>';
			$sx .= '<br>';

			$sx .= '<button onclick="newxy(\'' . base_url('index.php/io/file_access/' . $pth . '?dd0=' . $this -> files -> without_type($file)) . $conf . '\',750,200);" class="btn btn-primary" style="width: 100%">';
			$sx .= 'Matriz para Acesso';
			$sx .= '</button>';

			$sx .= '<br>';
			$sx .= '<br>';

			$sx .= '<button onclick="newxy(\'' . base_url('index.php/io/file_delete/' . $pth . '?dd0=' . $this -> files -> without_type($file)) . $conf . '\',750,200);" class="btn btn-danger" style="width: 100%">';
			$sx .= 'Delete File';
			$sx .= '</button>';
		}
		if (strpos($pth, 'undo') and $img) {
			$sx .= '<button onclick="newxy(\'' . base_url('index.php/io/file_undelete/' . $pth . '?dd0=' . $this -> files -> without_type($file)) . $conf . '\',750,200);" class="btn btn-success" style="width: 100%">';
			$sx .= 'Undelete File';
			$sx .= '</button>';
		}

		return ($sx);
	}

	function le($id = '') {
		$idx = round($id);
		$sql = "select * from microservice where s_active = 1 and (s_func = '$id')";

		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) > 0) {
			$line = $rlt[0];
			return ($line);
		} else {
			return ( array());
		}

	}

	function list_services() {
		$sql = "select * from microservice where s_active = 1";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		$sx = '<ul>';
		for ($r = 0; $r < count($rlt); $r++) {
			$sx .= '<li>' . $line['s_name'] . '</li>';
		}
		$sx .= '</ul>';
		return ($sx);
	}

	function exec($service, $data) {
		ini_set('max_execution_time', 300);
		//300 seconds = 5 minutes
		$job = $data['jobs'];
		$file = $data['file'];
		if (isset($data['file2'])) {
			$filen = $data['file2'];
		} else {
			$filen = '';
		}

		$this -> load -> model('files');
		$this -> load -> model('microservices');
		$sv = $this -> microservices -> le($service);

		if (count($sv) > 0) {
			$ln = $sv['s_cmd'];
			$file1 = $this -> files -> temp_dir . $job . '/' . $file;
			$file2 = $this -> files -> temp_dir . $job . '/' . $filen;
			if (strlen($filen) > 0) { $file2 = $filen; }

			$ln = troca($ln, '$1', $file1);
			$ln = troca($ln, '$2', $file2);
			$ln = troca($ln,'\\','/');
			if (strlen($ln) > 0) {
				$t = $sv['s_language'];
				switch ($t) {
					case 'dos' :
						shell_exec($ln);
						break;
					case 'php' :
						eval($ln . ';');
						break;
				}

			}
		}
	}

	function cover_sheet($id, $path = '') {
		$this -> load -> helper('tcpdf');

		/* Load Model */
		$model = 'colletions';
		$this -> load -> model($model);
		$data = $this -> $model -> le($id);
		$file = $this -> files -> temp_dir . $path;
		$fl = $file . '/' . $path . '.OIP';
		$data['metadata'] = $this -> microservices -> show_metadata(loadxml($fl));
		$data['content'] = $this -> load -> view('colletion/view', $data, true);
		$data['file'] = $this -> load -> view('colletion/cover_sheet', $data);
	}

	function show_metadata($xml) {
		$sx = '';
		$pg = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		foreach ($xml as $key => $value) {
			//echo '<h4>' . $key . '</h4>';
			$scanner = array('', '', '', '', '');
			foreach ($value as $key2 => $value2) {
				switch($key2) {
					case 'Created' :
						$pg[8] .= '<br>Created: <b>' . $value2 . '</b><br>';
						break;
					case 'ScannerSerial' :
						$scanner[2] .= 'Serial <b>Nº' . $value2 . '</b>';
						break;
					case 'ScannerID' :
						//$scanner[3] = 'ID: '.$value2;
						break;
					case 'Scannername' :
						$scanner[1] = 'Scanner Model: <b>' . $value2 . '</b>';
						break;
					case 'ScannerInfo' :
						//$scanner[0] = ' '.$value2;
						break;
					case 'ScanCounter' :
						$pg[5] .= 'PageCounter:' . $value2.'<br>';
						break;

					case 'ScanResolution' :
						$pg[2] .= 'ScanResolution: <b>' . $value2 . 'DPI</b><br>';
						break;
					case 'VZoom' :
						$pg[6] .= 'Zoom (V):<b>' . $value2 . '</b><br>';
						break;
					case 'HZoom' :
						$pg[6] .= 'Zoom (H):<b>' . $value2 . '</b><br>';
						break;
					case 'JPEGQuality' :
						$pg[7] .= 'JPEGQuality:<b>' . $value2 . '%</b><br>';
						break;
					default :
						//echo $key2 . ' - ' . $value2 . '<br>';
						break;
				}
			}
			$scan = '';
			for ($r = 0; $r < count($scanner); $r++) {
				if (strlen($scanner[$r]) > 0) {
					if (strlen($scan) > 0) {
						$scan .= '<br>';
					}
					$scan .= $scanner[$r];
				}
			}

			$rs = '<br><br><br><br><br><font style="font-size:11px;">'.$scan.'<hr>';
			/* Resolution */
			if (strlen($pg[2]) > 0) { $rs .= $pg[2];
			}
						
			/* Counter Page */
			if (strlen($pg[5]) > 0) { $rs .= $pg[5];
			}
			/* ZOOM */
			if (strlen($pg[6]) > 0) { $rs .= $pg[6];
			}
			/* QUALITY */
			if (strlen($pg[7]) > 0) { $rs .= $pg[7];
			}
			$rs .= '</font>'.cr();
			/* CREATE */
			if (strlen($pg[8]) > 0) { $rs .= '<font style="font-size:8px;">'.$pg[8].'</font>';
			}			
			$rs .= $sx;
			//echo '<pre>'.$rs . '</pre>';
			return ($rs);
		}
		//exit ;
	}

}

function loadxml($file) {
	$xml = simplexml_load_file($file) or die("Error: Cannot create object " . $file);
	if ($xml === false) {
		echo "Failed loading XML: ";
		foreach (libxml_get_errors() as $error) {
			echo "<br>", $error -> message;
			exit ;
		}
	} else {
		return ($xml);
	}
}

function move_file_to_undo($data = '') {
	$data['undo'] = $data['jobs'] . '/undo';
	move_file_to_folder($data, 'undo');
}

function move_file_to_access($data = '') {
	move_file_to_folder($data, 'access');
}

function move_file_to_preservation($data = '') {
	move_file_to_folder($data, 'preservation');
}

function undelete_file($data = '') {
	$data['undo'] = $data['jobs'] . '/undo';
	$data['path'] = '';
	move_file_to_folder($data, '');
}

function rename_file($data = '') {
	$f1 = $data['file'];
	if (!isset($data['file2']))
		{
			$f2 = name_normalize($f1);		
		} else {
			$f2 = trim($data['file2']);
		}
	
	
	$f1 = $f1;
	$f2 = $f2;
	echo '<br>'.$f1.'->'.$f2;
	rename($f1,$f2);
}

function move_file_to_folder($data = '', $path) {

	$directory = $data['dir'] . $data['jobs'] . '/' . $path;

	if (!file_exists($directory)) {
		mkdir($directory);
	}

	$f1f = $data['dir'] . $data['jobs'];
	if (isset($data['undo'])) {
		$f1f = $data['dir'] . $data['undo'];
	}
	$f2 = $data['jobs'] . '/' . $path;
	$f2f = $data['dir'] . $f2;
	$f = $data['file'];
	$files = array();

	if (file_exists($f2f)) {
		if ($handle = opendir($f1f)) {
			// Loop through its contents adding folder paths or files to separate arrays
			// Make sure not to include "." or ".." in the listing.

			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					if (is_dir($f1f . "/" . $file)) {
						$folders[] = $file;
					} else {
						if (substr(trim($file), 0, strlen($f)) == $f) {
							$files[] = $file;
						}
					}
				}
			}

			// Finally close the directory.
			closedir($handle);
		}

		for ($r = 0; $r < count($files); $r++) {
			$file = $f1f . '/' . $files[$r];
			$newfile = $f2f . '/' . $files[$r];
			echo '<br>.' . $file . ' to ' . $newfile;

			if (!copy($file, $newfile)) {
				echo "falha ao copiar $file...\n";
			}
			/* file exist */
			if (file_exists($newfile)) {
				echo '<br> Excluindo ' . $file;
				unlink($file);
			}
		}
	}
}
?>