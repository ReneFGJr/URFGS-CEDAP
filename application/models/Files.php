<?php
class files extends CI_model {
	var $temp_dir = 'D:/tmp/';
	/* var $temp_dir = 'Z:/3x4/'; */
	function icon_type($tp) {
		switch($tp) {
			case 'jpg' :
				$nm = 'glyphicon-picture';
				break;
			case 'png' :
				$nm = 'glyphicon-picture';
				break;
			default :
				$nm = 'glyphicon-file';
		}
		$sx = '<span class="glyphicon ' . $nm . '" aria-hidden="true"></span>';
		return ($sx);
	}
	
	function filePreview($id=0,$fl='',$fld='')
		{
			$sp = '';
			$type = $this->filetype($fl);
			$sx = $type;
			switch ($type)
				{
				case 'xxx':
					break;
				case 'pdf':
					$url = base_url('index.php/io/image/'.$fld.'/?dd0='.$id);
					$sx = '<iframe nome="pdf" width="100%" height="100%" src="'.$url.'">';
					$sx .= '</iframe>';
				case 'jpg':
					$sx .= '<img src="'.base_url('index.php/io/image/'.$fld.'/?dd0='.$id).'" width="100%" id="image_zoom">';
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
				default:
					$sx .= 'no preview';
				}
			return($sx);
		}
	
	function download($file)
		{
			
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

	function files($pth='') {
		$sx = '';

		$folders = array();
		$files = array();
		$path = $this -> temp_dir;
		if (strlen($pth) > 0) {
			$path .= '/' . $pth;
			$folders[] = '..';
		}
		// Open the given path

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
			for ($r = 0; $r < count($files); $r++) {
				$nlink = '<a href="' . base_url($link . $pth . '?dd0=' . $r) . '">';
				$sx .= '<tr>' . cr();
				$sx .= '<td width="20">';
				$sx .= $nlink;
				//$sx .= '<span class="glyphicon glyphicon-level-up" aria-hidden="true"></span>';
				$type = $this -> filetype($files[$r]);
				$sx .= $this -> icon_type($type);
				//$sx .= '<img src="'.base_url('img/icon/icon_folder.png').'" height="20"></span>'.cr();
				$sx .= '</a>';
				$sx .= '</td>' . cr();

				$sx .= '<td>' . cr();
				$sx .= $nlink;
				$sx .= $files[$r] . cr();
				$sx .= '</a>';
				$sx .= '</td>' . cr();
				$sx .= '</tr>' . cr();
			}
			$sx .= '</table>';
			// Finally close the directory.
			closedir($handle);
			return ($sx);
		}

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
			for ($r = 0; $r < count($folders); $r++) {
				$nlink = '<a href="' . base_url($link . $folders[$r]) . '">';
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

	function thumb($job = '', $id = 0) {
		$dir = $this -> temp_dir . '/' . $job;
		$files = scandir($dir, 2);

		$sx = '<div class="row">';
		$sx .= '<div class="col-md-3">';

		$sx .= '<nav aria-label="...">
			  <ul class="pagination">' . cr();
		$n = 1;
		for ($r = 0; $r < count($files); $r++) {
			$mini = troca($job . '/thumb/' . $files[$r], '.tif', '.bmp');
			if (strpos($mini, '.bmp')) {
				if ($r == $id) {
					$sa = 'class="active"';
				} else {
					$sa = '';
				}

				$link = '<a href="' . base_url('index.php/job/view/' . $job . '/' . $r) . '" style="width: 40px;">';
				$sx .= '<li ' . $sa . ' class="text-center">' . $link . $n . '</a></li>' . cr();
				$n++;
			}
		}
		$sx .= '</ul></nav>';

		$t = 0;
		$m = 0;
		for ($r = $id; $r < count($files); $r++) {
			$mini = troca($job . '/thumb/' . $files[$r], '.tif', '.bmp');
			if ($m < 5) {
				if (strpos($mini, '.bmp')) {
					//$sx .= $files[$r];
					$link = '<a href="' . base_url('index.php/job/view/' . $job . '/' . $r) . '">';
					$sx .= $link . '<img src="' . base_url('index.php/job/file/' . $mini) . '" width="150" style="border:1px;">' . '</a>';
					$sx .= '<br>';
					//$sx .= $mini;
					$sx .= '<br>';
					$t = $t + 2;
					$m++;
				}
			}
		}

		$midle = troca($job . '/' . $files[$id], '.tif', '.jpg');
		$sx .= '</div>' . cr();
		$sx .= '<div class="col-md-9">';
		if ($id > 0) {

			$file = $this -> temp_dir . $midle;

			if (!file_exists($file)) {
				$dd = array();
				$dd['jobs'] = $job;
				$dd['file'] = $files[$id];
				
				$this -> microservices -> exec(1, $dd);
				$sx .= '<span onclick="newxy(\'' . base_url('index.php/job/microservice/' . $job . '/' . $files[$id] . '/' . '1') . '\',300,300);" class="btn btn-primary">';
				$sx .= 'create middle image';
				$sx .= '</span>';
			}
			$midle = troca($files[$id], '.tif', '.jpg');
			$sx .= '<img src="' . base_url('index.php/job/file/' . $job . '/' . $midle) . '" id="image_fix" width="100%" style="border:1px;">';
			$sx .= '<br><br>';

			$sx .= '<a href="' . base_url('index.php/job/file/' . $job . '/' . $midle) . '" class="btn btn-primary" target="_' . $file . '">' . msg('view_full') . '</a>';
			$sx .= '<script>
						$(\'#image_fix\').elevateZoom({
							  zoomType	: "lens",
							  /* lensShape : "round", */
							  lensSize    : 300,
							  scrollZoom : true
						});
					</script>';
			/* delete imagem */
			$sx .= ' ';
			$sx .= '<span onclick="newxy(\'' . base_url('index.php/job/file_delete/' . $job . '/' . $midle) . '\',600,300);" class="btn btn-danger">' . msg('delete_file') . '</a>';

		}
		$sx .= '</div>';
		$sx .= '<div class="col-md-12" style="padding: 0px 10px;">';
		$sx .= 'Metadados';
		$sx .= '</div>';
		$sx .= '</div>';
		return ($sx);
	}

}
?>
