<?php
class microservices extends CI_model {
	function le($id = 0) {
		$sql = "select * from microservice where s_active = 1";
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

	function exec($service,$data) {
		ini_set('max_execution_time', 300);
		//300 seconds = 5 minutes
		$job = $data['jobs'];
		$file = $data['file'];

		$this -> load -> model('files');
		$this -> load -> model('microservices');
		$sv = $this -> microservices -> le($service);

		if (count($sv) > 0) {
			$ln = $sv['s_cmd'];
			$file1 = $this -> files -> temp_dir . $job . '/' . $file;
			$filen = $file;
			$filen = troca($filen, '.tif', '.jpg');
			$filen = troca($filen, '.tiff', '.jpg');
			$filen = troca($filen, '.TIF', '.jpg');
			$filen = troca($filen, '.TIFF', '.jpg');

			$file2 = $this -> files -> temp_dir . $job . '/' . $filen;
			$ln = troca($ln, '$1', $file1);
			$ln = troca($ln, '$2', $file2);
			if (strlen($ln) > 0)
				{
					shell_exec($ln);
				}
		}
	}
}
?>
