<?php
class colletions extends CI_model {
	var $table = 'collections';
	function cp() {
		$cp = array();
		array_push($cp, array('$H8', 'id_c', '', false, true));
		array_push($cp, array('$S80', 'c_name', 'Coleção', false, true));
		array_push($cp, array('$T80:6', 'c_context', 'Descrição', false, true));
		array_push($cp, array('$O 1:Ativo&9:Cancelado', 'c_status', 'Situação', false, true));
		array_push($cp, array('$H8', 'updated_at', date("Y-m-d H:i:s"), false, true));
		return ($cp);
	}

	function row($form) {
		$form -> fd = array('id_c', 'c_name', 'c_status');
		$form -> lb = array('id_c', msg('c_name'), msg('c_status'));
		$form -> mk = array('', 'L', 'A');
		return ($form);
	}
	function le($id)
		{
			$sql = "select * from ".$this->table." where id_c = ".round($id);
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			if (count($rlt) > 0)
				{
					$line = $rlt[0];					
					$line['propriety'] = $this->le_propriety($id);					
					return($line);
				} else {
					return(array());
				}
		}

	function le_propriety($id)
		{
			$sql = "select * from rdf_propriety
						LEFT JOIN rdf_resource ON id_rs = rf_rs
						LEFT JOIN rdf_prefix ON rs_prefix = id_prefix 
						where rf_id_c = ".round($id);
						
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			if (count($rlt) > 0)
				{
					return($rlt);
				} else {
					return(array());
				}
		}

}
?>
