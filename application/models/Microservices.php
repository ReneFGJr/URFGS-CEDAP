<?php
class microservices extends CI_model
	{
		function le($id=0)
			{
				$sql = "select * from microservice where s_active = 1";
				$rlt = $this->db->query($sql);
				$rlt = $rlt->result_array();
				if (count($rlt) > 0)
					{
						$line = $rlt[0];
						return($line);
					} else {
						return(array());
					}
				
			}
		function list_services()
			{
				$sql = "select * from microservice where s_active = 1";
				$rlt = $this->db->query($sql);
				$rlt = $rlt->result_array();
				$sx = '<ul>';
				for ($r=0;$r < count($rlt);$r++)
					{
						$sx .= '<li>'.$line['s_name'].'</li>';
					}
				$sx .= '</ul>';
				return($sx);
			}
	}
?>
