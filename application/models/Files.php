<?php
class files extends CI_model {
	var $temp_dir = 'D:/jobs/';
	/* var $temp_dir = 'Z:/3x4/'; */
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
				$sx .= '<span onclick="newxy(\'' . base_url('index.php/job/microservice/' . $job . '/' . $files[$id] . '/' . '1') . '\',300,300);" class="btn btn-primary">';
				$sx .= 'create middle image';
				$sx .= '</span>';
			} else {
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
			}
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
