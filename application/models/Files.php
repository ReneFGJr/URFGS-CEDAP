<?php
class files extends CI_model {
	var $temp_dir = 'd:/tmp/';
	/* var $temp_dir = 'Z:/3x4/'; */
	
	function __construct() {
		if (!isset($_SESSION['folder'])) 
			{
				redirect('index.php/main');
			};
		$this->temp_dir = $_SESSION['folder'];
	}

	function icon_type($tp) {
		switch($tp) {
			case 'jpg' :
				$nm = 'glyphicon-picture';
				break;
			case 'png' :
				$nm = 'glyphicon-picture';
				break;
			case 'wav' :
				$nm = 'glyphicon-film';
				break;
			case 'mp3' :
				$nm = 'glyphicon-music';
				break;
			case 'mp3' :
				$nm = 'glyphicon-music';
				break;
			case 'xml' :
				$nm = 'glyphicon-list-alt';
				break;
			case 'oip' :
				$nm = 'glyphicon-list-alt';
				$tp = 'XML';
				break;
			case 'ois' :
				$nm = 'glyphicon-list-alt';
				$tp = 'XML';
				break;
			case 'ojp' :
				$nm = 'glyphicon-list-alt';
				$tp = 'XML';
				break;
			case 'ojs' :
				$nm = 'glyphicon-list-alt';
				$tp = 'XML';
				break;
			default :
				$nm = 'glyphicon-file';
		}
		$sx = '<span class="glyphicon ' . $nm . '" aria-hidden="true" title="' . $tp . '"></span>';
		return ($sx);
	}

	function filePreview($id = 0, $fl = '', $fld = '') {
		$sp = '';
		$type = $this -> filetype($fl);
		$sx = $type;
		if ($type == 'oip') { $type = 'xml';
		}
		if ($type == 'ois') { $type = 'xml';
		}
		if ($type == 'ojp') { $type = 'xml';
		}
		if ($type == 'ojs') { $type = 'xml';
		}

		switch ($type) {
			case 'xxx' :
				break;
			case 'pdf' :
				$url = base_url('index.php/io/image/' . $fld . '/?dd0=' . $id);
				$sx = '<iframe nome="pdf" width="100%" height="100%" src="' . $url . '">';
				$sx .= '</iframe>';
				break;
			case 'mp3' :
				$sx = '<br />
					<br />
					<audio controls="">
					  <source src="' . base_url('index.php/io/image/' . $fld . '/?dd0=' . $id) . '" type="audio/mpeg"></source>
					  <embed height="50" src="' . base_url('index.php/io/image/' . $fld . '/?dd0=' . $id) . '" width="100"></embed>
					</audio> 
					<br />
					<br />';
				break;
			case 'htm' :
				$url = base_url('index.php/io/image/' . $fld . '/?dd0=' . $id);
				$sx = '<iframe nome="html" width="100%" height="100%" src="' . $url . '">';
				$sx .= '</iframe>';
				break;
			case 'xml' :
				$url = base_url('index.php/io/image/' . $fld . '/?dd0=' . $id . '&' . $fl . '.xml');
				$sx = '<iframe nome="pdf" width="100%" height="100%" src="' . $url . '">';
				$sx .= '</iframe>';
				break;
			case 'bmp' :
				$sx .= '<img src="' . base_url('index.php/io/image/' . $fld . '/?dd0=' . $id) . '" width="100%" id="image_zoom">';
				$sx .= '
						<script>
						$(\'#image_zoom\').elevateZoom({
							  /* zoomType : "inner", */
							  zoomType	: "lens",
							  /* lensShape : "round", */
							  lensSize    : 250,
							  zoomWindowPosition: 10,
							  scrollZoom : true
						});
					</script>					
					';
				break;
			case 'jpg' :
				$sx .= '<img src="' . base_url('index.php/io/image/' . $fld . '/?dd0=' . $id) . '" width="100%" id="image_zoom">';
				$sx .= '
						<script>
						$(\'#image_zoom\').elevateZoom({
							  zoomType : "inner",
							  cursor: "crosshair",
							  scrollZoom : true
						});
					</script>					
					';
				break;
			default :
				$sx .= ' no preview ' . $type;
		}
		return ($sx);
	}

	function download($file) {

		//header('Content-Type: image/jpg');
		header('Content-Type: image/bmp');
		readfile($file);
	}

	function filetype($f) {
		while (strpos($f, '.')) {
			$f = substr($f, strpos($f, '.') + 1, strlen($f));
		}
		$f = lowercase($f);
		return ($f);
	}

	function without_type($f) {
		$type = $this -> filetype($f);
		$f = troca($f, '.' . $type, '');
		return ($f);
	}

	function files($pth = '') {
		$sx = '';

		$folders = array();
		$files = array();
		$path = $this -> temp_dir;
		if (strlen($pth) > 0) {
			$path .= $pth;
			$folders[] = '..';
		}
		// Open the given path
		if (file_exists($path)) {
			if ($handle = opendir($path)) {
				// Loop through its contents adding folder paths or files to separate arrays
				// Make sure not to include "." or ".." in the listing.

				while (false !== ($file = readdir($handle))) {
					if ($file != "." && $file != "..") {
						if (is_dir($path . "/" . $file)) {
							$folders[] = $file;
						} else { $files[] = $file;
						}
					}
				}

				// Finally close the directory.
				closedir($handle);
				return ($files);
			}
		}
		return ( array());

	}

	function listFile($pth = "", $link = '') {
		$sx = '';

		$folders = array();
		$files = array();
		$path = $this -> temp_dir;
		if (strlen($pth) > 0) {
			$path .= '/' . $pth;
			$folders[] = '..';
		}
		// Open the given path
		if (file_exists($path)) {
			if ($handle = opendir($path)) {
				// Loop through its contents adding folder paths or files to separate arrays
				// Make sure not to include "." or ".." in the listing.

				while (false !== ($file = readdir($handle))) {
					if ($file != "." && $file != "..") {
						if (is_dir($path . "/" . $file)) {
							$folders[] = $file;
						} else { $files[] = $file;
						}
					}
				}

				$sx = '<table width="100%" class="table" border=0>' . cr();
				$sx .= '<tr><td colspan=5>' . '<a href="' . base_url('index.php/io/dir/' . $pth) . '"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> ' . 'root' . '</a>' . '</td></tr>' . cr();
				$xname = '';
				for ($r = 0; $r < count($files); $r++) {
					/* name */
					$name = $this -> files -> without_type($files[$r]);

					/* nlink */
					$nlink = '<a href="' . base_url($link . $pth . '?dd0=' . $r) . '">';
					$type = $this -> filetype($files[$r]);

					if ($xname != $name) {
						if ($r > 0) { $sx .= '</td>' . cr();
						}
						$sx .= '<tr>' . cr();
						$sx .= '<td class="small">' . cr();
						$sx .= $name . cr();
						$sx .= '</td>' . cr();
					}

					$sx .= '<td width="20">';
					$sx .= $nlink;
					$sx .= $this -> icon_type($type);
					$sx .= '</a>';
					$sx .= '</td>' . cr();

					$xname = $name;
				}
				if ($r > 0) { $sx .= '</td>' . cr();
				}
				$sx .= '</table>';
				// Finally close the directory.
				closedir($handle);
				return ($sx);
			}
		}
		return ('<br><font color="red">Erro na pasta</font>');

	}

	function listDir($pth = "", $link = '') {
		global $listDirCount;

		$sx = '';

		$folders = array();
		$files = array();
		$path = $this -> temp_dir;
		if (strlen($pth) > 0) {
			$path .= '/' . $pth;
			$folders[] = '..';
		}
		// Open the given path
		if (file_exists($path)) {
			if ($handle = opendir($path)) {
				// Loop through its contents adding folder paths or files to separate arrays
				// Make sure not to include "." or ".." in the listing.

				while (false !== ($file = readdir($handle))) {
					if ($file != "." && $file != "..") {
						if (is_dir($path . "/" . $file)) {
							$folders[] = $file;
						} else { $files[] = $file;
						}
					}
				}
				$pth2 = $pth;
				if (strlen($pth) > 0) {
					$pth2 = $pth . '/';
				}
				$sx = '<table width="100%" class="table" border=0>' . cr();
				for ($r = 0; $r < count($folders); $r++) {
					$nlink = '<a href="' . base_url($link . $pth2 . $folders[$r]) . '">';
					$sx .= '<tr>' . cr();
					$sx .= '<td width="20">';
					$sx .= $nlink;
					if ($folders[$r] == '.') {
						$sx .= '<span class="glyphicon glyphicon-level-up" aria-hidden="true"></span>';
					} else {
						$sx .= '<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>';
						//$sx .= '<img src="'.base_url('img/icon/icon_folder.png').'" height="20"></span>'.cr();
					}
					$sx .= '</a>';
					$sx .= '</td>' . cr();

					$sx .= '<td>' . cr();
					$sx .= $nlink;
					$sx .= $folders[$r] . cr();
					$sx .= '</a>';
					$sx .= '</td>' . cr();
					$sx .= '</tr>' . cr();
				}
				$sx .= '</table>';
				// Finally close the directory.
				closedir($handle);
				return ($sx);
			}
		} else {
			return ('<br><font color="red">Erro na pasta</font>');
		}
	}

	function directory($directory = '') {
		$dir = $this -> temp_dir;
		if (strlen($directory) > 0) { $dir .= $directory;
		}

		$files = glob($dir . '*');
		/* perform additional sort here */
		echo "<ul>\n";
		for ($r = 0; $r < count($files); $r++) {
			$file = $files[$r];
			if (is_dir($file)) {
				$files2 = glob($file . '/*');
				$files = array_merge($files, $files2);
			}

		}
		asort($files);
		return ($files);
	}

	function normalize_names($path = '') {
		$files = $this -> directory($path);
		foreach ($files as $key => $value) {
			$name = troca($value, $this -> temp_dir, '');
			$nname = name_normalize($name);
			if ($name != $nname) {
				$data = array();
				$data['jobs'] = '';
				$data['dir'] = '';
				$data['file'] = $value;
				$this -> microservices -> exec('rename', $data);
			}
		}
		return (1);
	}

	function dirscan($dir = '') {
		if (strlen($dir) == 0) {
			$dir = $this -> temp_dir;
		}
		$files1 = scandir($dir, 2);

		$sx = '<pre>';
		$t = 0;

		for ($r = 0; $r < count($files1); $r++) {
			$file = $files1[$r];
			$file_name = $dir . '/' . $file . '/thumb/Image00001.bmp';
			$ok = 0;
			if (file_exists($file_name)) {
				$ok = 1;
			}
			if ($ok == 1) {
				if ($t > 0) { $sx .= '<br>';
				}
				$link = '<a href="' . base_url('index.php/job/view/' . $file) . '">';
				$sx .= $link . $file . '</a>';
				$t++;
			}
		}
		return ($sx);
	}

	function show_file($file) {
		// Set the content type header - in this case image/jpeg

		$file = $this -> temp_dir . $file;
		//echo $file;
		header('Content-Type: image/jpg');
		echo readfile($file);

	}

	function create_jpg_from_tiff($data) {
		$files = $data['files'];
		$this -> load -> model('microservices');
		$this -> load -> model('files');

		for ($r = 0; $r < count($files); $r++) {

			/* conversão */
			$filen = $files[$r];

			if ($this -> filetype($filen) == 'tif') {
				$filen = troca($filen, '.tif', '.jpg');
				$filen = troca($filen, '.tiff', '.jpg');
				$filen = troca($filen, '.TIF', '.jpg');
				$filen = troca($filen, '.TIFF', '.jpg');

				/* PART I */
				$data['file'] = $files[$r];
				$data['file2'] = $filen;
				$this -> microservices -> exec('jpg2048', $data);

				/* PART II */
				$data['file'] = $files[$r];
				$data['file2'] = 'thumb/' . $filen;
				$this -> microservices -> exec('jpg320', $data);
				$data['content'] = 'Convertendo ' . $files[$r] . '<br>';
				$data['title'] = '';
				$this -> load -> view('content', $data);
			} else {
				$data['content'] = 'Format inválido ' . $files[$r] . '<br>';
				$data['title'] = '';
				$this -> load -> view('content', $data);
			}
		}
	}

	function thumb($job = '') {
		$dir = $job;
		$files = $this -> files -> files($dir);
		$sx = '';
		$t = 0;
		$m = 0;
		for ($r = 0; $r < count($files); $r++) {

			if (strpos($files[$r], '.jpg')) {
				//$sx .= $files[$r];
				$mini = $job . '/' . $files[$r];
				$link = '<a href="' . base_url('index.php/io/dir/' . $job . '?dd0=' . $r) . '">';
				$sx .= $link . '<img src="' . base_url('index.php/job/file/' . $mini) . '" width="150" style="border:1px; margin: 8px; box-shadow: 5px 5px 5px grey;">' . '</a>';
			}
		}
		/*
		 $sx .= '
		 <script type="text/javascript">
		 $('.myContainer > .myItem').rondell([options][, callback]);
		 </script>
		 ';
		 *
		 */
		return ($sx);
	}

	function folders() {
		$sql = "select * from folders where f_status = 1 order by f_descript";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		$sx = '<div class="row">';
		for ($r = 0; $r < count($rlt); $r++) {
			$line = $rlt[$r];
			$link = base_url('index.php/main/folder_select/' . $line['id_f'] . '/' . checkpost_link($line['id_f']));
			$sx = '<div class="col-md-2 text-center">';
			$sx .= '<a href="' . $link . '" class="btn btn-primary" style=" width:100%; box-shadow: 3px 3px 5px grey;">';
			$sx .= $line['f_descript'];
			$sx .= '</div>';
		}
		$sx .= '</div>';
		return ($sx);
	}

	function folder_set($id) {
		$data = $this->le_folder($id);
		$path = $data['f_folder'];
		$newdata = array('folder' => $path);

		$this -> session -> set_userdata($newdata);

	}

	function le_folder($id) {
		$sql = "select * from folders where id_f = " . round($id);
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) > 0)
			{
				return($rlt[0]);
			} else {
				return(array());
			}
		return ($rlt);
	}

}

function name_normalize($file) {
	$file = lowercaseSQL($file);
	$file = troca($file, ' ', '_');

	for ($r = 0; $r < strlen($file); $r++) {
		$c = $file[$r];
		if ($c == '(') { $file[$r] = '_';
		}
		if ($c == ')') { $file[$r] = '-';
		}
		if ($c == '[') { $file[$r] = '_';
		}
		if ($c == ']') { $file[$r] = '-';
		}
		if ($c > chr(120)) {
			$file[$r] = ord($file[$r] - 48);
		}
	}
	return ($file);
}
?>
