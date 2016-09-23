<?php
class microservices extends CI_model {

	function action($pth = '', $file = '') {
		$sx = '<hr>';

		/* REGRA #01 - não existe miniatura */
		/* REGRA #02 - não existe preview - somente TIFF */
		$sx = $file . '<hr>';
		if (strpos($file, '.tif')) {
			$file2 = troca($file, '.tiff', '.jpg');
			$file2 = troca($file2, '.tiff', '.jpg');
			$sx .= '<button onclick="newxy(\'' . base_url('index.php/io/file_convert/' . $pth . '?dd0=' . $this -> files -> without_type($file)) . '&dd1=jpg\',750,200);" class="btn btn-success">';
			$sx .= 'Create Preview';
			$sx .= '</button>';
		}

		if (strpos($file, '.jpg')) {
			$img = true;
		} else {
			$img = false;
		}
		if (!(strpos($pth, '/')) and $img) {
			$sx .= '<button onclick="newxy(\'' . base_url('index.php/io/file_conserve/' . $pth . '?dd0=' . $this -> files -> without_type($file)) . '\',750,200);" class="btn btn-success" style="width: 100%">';
			$sx .= 'Matriz para Preservação';
			$sx .= '</button>';

			$sx .= '<br>';
			$sx .= '<br>';

			$sx .= '<button onclick="newxy(\'' . base_url('index.php/io/file_delete/' . $pth . '?dd0=' . $this -> files -> without_type($file)) . '\',750,200);" class="btn btn-danger" style="width: 100%">';
			$sx .= 'Delete File';
			$sx .= '</button>';
		}
		if (strpos($pth, 'undo') and $img) {
			$sx .= '<button onclick="newxy(\'' . base_url('index.php/io/file_undelete/' . $pth . '?dd0=' . $this -> files -> without_type($file)) . '\',750,200);" class="btn btn-success" style="width: 100%">';
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

			$ln = troca($ln, '$1', $file1);
			$ln = troca($ln, '$2', $file2);
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

}

function move_file_to_undo($data = '') {
	move_file_to_folder($data, 'undo');
}

function move_file_to_preservation($data = '') {
	move_file_to_folder($data, 'preservation');
}

function undelete_file($data='') {
	move_file_to_folder($data, '');
}

function move_file_to_folder($data = '', $path) {

	print_r($data);
	$directory = $data['dir'].$data['jobs'] . '/' . $path;
	if (!file_exists($directory))
		{
			mkdir($directory);
		}

	$f1f = $data['dir'] . $data['jobs'];
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