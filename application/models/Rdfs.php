<?php
class rdfs extends CI_model
	{
		function cp($id,$pg)
			{
				$cp = array();
				if ($id==0)
					{
						array_push($cp,array('$H8','id_rf','',False,True));
						array_push($cp,array('$HV','rf_id_c',$pg,True,True));
						$sql = "select * from rdf_resource";
						array_push($cp,array('$Q id_rs:rs_propriety:'.$sql,'rf_rs','',True,True));
						array_push($cp,array('$T80:6','rf_value','',True,True));
						return($cp);
					} else {
						array_push($cp,array('$H8','id_rf','',False,True));
						$sql = "select * from rdf_resource";
						array_push($cp,array('$Q id_rs:rs_propriety:'.$sql,'rf_rs','',True,True));
						array_push($cp,array('$T80:6','rf_value','',True,True));
						return($cp);						
					}				
			}
	}
?>
