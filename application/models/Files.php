<?php
class files extends CI_model {
	var $temp_dir = 'D:/projeto/URFGS-CEDAP/jobs/';
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

	function thumb($job = '') {
		$dir = $this -> temp_dir . '/' . $job;
		$files = scandir($dir, 2);

		$sx = '<div class="row">';
		$sx .= '<div class="col-md-3">';
		$t = 0;
		for ($r = 0; $r < count($files); $r++) {
			$mini = troca('jobs/' . $job . '/thumb/' . $files[$r], '.tif', '.bmp');
			if (strpos($mini, '.bmp')) {
				//$sx .= $files[$r];
				$sx .= '<img src="' . base_url($mini) . '" width="250" style="border:1px;">';
				$sx .= '<br>';
				$sx .= '<br>';
				$t = $t + 2;
			}
		}
		$sx .= '</div>';
		$midle = troca('jobs/' . $job . '/' . $files[3], '.tif', '.jpg');
		$sx .= '<div class="col-md-8">';
			$sx .= '<img src="' . base_url($midle) . '" width="150" style="border:1px;">';
		$sx .= '</div>';
		$sx .= '</div>';
		return ($sx);
	}

}
?>
