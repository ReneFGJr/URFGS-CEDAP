<?php
class frbr extends CI_model {
	var $table = 'person';
	var $table_cache = 'person_cache';
	var $table_person_name = 'person_name';
	var $table_person_data = 'person_data';

	function limpa_nome($nome) {
		$nome = troca($nome, '  ', ' ');
		if (strpos($nome, ',')) {
			$nome1 = trim(substr($nome, strpos($nome, ',') + 1, strlen($nome)));
			$nome1 = trim(troca($nome1, ',', ''));

			$nome2 = trim(substr($nome, 0, strpos($nome, ',')));
			$nome = $nome1 . ' ' . $nome2;
			$nome = troca($nome, '  ', ' ');
		}
		return($nome);
	}

	function inport_marc21($txt) {
		$txt = troca($txt, '$', '|');
		$txt = troca($txt, ';', '¢');
		$txt = troca($txt, chr(9), ' ');
		$txt = troca($txt, chr(13), ';');
		$txt = troca($txt, chr(10), ';');
		$ln = splitx(';', $txt);
		$dnasc = '';
		$dfale = '';
		$sx = '';
		$m100 = array();
		$m400 = array();

		$genero = '';
		$lang = '';

		for ($r = 0; $r < count($ln); $r++) {
			$lns = $ln[$r];
			$lns = troca($lns, '|', ';');
			$lz = splitx(';', $lns);
			for ($z = 0; $z < count($lz); $z++) {
				$cod = substr($lz[$z], 0, 3);
				switch ($cod) {
					case '100' :
						$nome = $this -> limpa_nome(trim(substr($lz[1], 2, strlen($lz[1]))));

						$nome = nbr_autor($nome, 3);

						array_push($m100, $nome);

						/* nasc & fale */
						for ($d = 0; $d < count($lz); $d++) {
							if (substr($lz[$d], 0, 2) == 'd ') {
								$ano = trim(substr($lz[$d], 2, 20));
								if (strpos($ano, '-')) {
									$dnasc = substr($ano, 0, strpos($ano, '-'));
									$dfale = substr($ano, strpos($ano, '-') + 1, 100);
								}
							}
						}
						break;
					case '400' :
						$nome = $this -> limpa_nome(trim(substr($lz[1], 2, strlen($lz[1]))));
						$nome = nbr_autor($nome, 3);
						array_push($m400, $nome);
						break;
					case '375' :
						$genero = trim(substr($lz[1], 1, strlen($lz[1])));
						break;
					case '377' :
						$lang = trim($lz[1]);
						break;
				}
			}
		}
		if (count($m100) > 0) {
			$data = array();
			$data['m100'] = $m100;
			$data['m400'] = $m400;
			$data['genero'] = $genero;
			$data['language'] = $lang;
			$data['dnasc'] = $dnasc;
			$data['dfale'] = $dfale;
			$this -> inport_author($data);
		}
		return ($sx);
	}

	function authority_search($nm) {
		$sql = "select * from " . $this -> table_person_name . " ";
		$sql .= "where (ps_name = '$nm') ";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) > 0) {
			$line = $rlt[0];
			return ($line);
		} else {
			return ( array());
		}
	}

	function inport_author($data) {
		$n100 = $data['m100'][0];
		$n400 = $data['m400'];
		$genero = $data['genero'];
		$dnasc = $data['dnasc'];
		$dfale = $data['dfale'];

		$n100_a = $this -> authority_search($n100);
		$idm = 0;

		if (count($n100_a) > 0) {
			if ($n100_a['ps_preferencial'] != 1) {
				$sx = 'ERRO DE IMPORTAÇÂO, NOME NÃO AUTORIZADO - ' . $n100_a['ps_name'];
				return ($sx);
			} else {
				$idm = $n100_a['ps_p'];
			}

		} else {
			/* Insere novo cadastro */
			$sql = "insert into " . $this -> table . " (p_status, p_uri) value (1,'$n100')";
			$this -> db -> query($sql);

			$sql = "select max(id_p) as id from " . $this -> table;
			$rlt = $this -> db -> query($sql);
			$rlt = $rlt -> result_array();
			$idm = $rlt[0]['id'];
			
			$sql = "insert into " . $this -> table_person_data . " (pd_id_p, pd_genero, pd_born_place, pd_born, pd_death) value ($idm,'',0,'','')";
			$this -> db -> query($sql);			

			$this -> insert_author($idm, array($n100), 1);
		}
		/********** INSERE REMISSIVAS **************/
		if ($idm > 0) {
			$this -> insert_author($idm, $n400, 0);
		}
		/********** INSERE GENERO *****************/
		if (($idm > 0) and (strlen($genero) > 0)) {
			$this -> atualiza_genero($idm, $genero);
		}
		/********** INSERE Datas *****************/
		if (($idm > 0) and (strlen($dnasc . $dfale) > 0)) {
			$this -> atualiza_data($idm, $dnasc, $dfale);
		}
	}

	function atualiza_data($idm, $dnasc, $dfale) {
		$sql = "update " . $this -> table_person_data . " 
					set 
						pd_born = '$dnasc',
						pd_death = '$dfale'					 
					where pd_id_p = " . $idm;
		$rlt = $this -> db -> query($sql);
	}

	function atualiza_genero($idm, $genero) {
		$g = '';
		switch($genero) {
			case 'male' :
				$g = 'M';
				break;
			case 'female' :
				$g = 'F';
				break;
			default :
				$erro = 'Genero não identificado ' . $genero;
				break;
		}
		if ($g != '') {
			$sql = "update " . $this -> table_person_data . " 
						set pd_genero = '$g' 
						where pd_id_p = " . $idm;
			$rlt = $this -> db -> query($sql);
		}
	}

	function insert_author($idm = 0, $authors, $pref = 0) {
		for ($r = 0; $r < count($authors); $r++) {
			$name = $authors[$r];
			$ida = $this -> authority_search($name);
			if (count($ida) == 0) {
				$sql = "insert into " . $this -> table_person_name . "
									(
									  ps_p, ps_name, ps_preferencial, 
									  ps_hidden, ps_situacao
									)
									values
									(
										$idm,'$name',$pref,
										0,1
									)";
				$rlt = $this -> db -> query($sql);
			} else {

			}
		}
	}

	function le_person($id) {
		$wh = ' id_p = ' . round($id);
		$sql = "select * from person
					inner join person_name on id_p = ps_p
					left join person_data on id_p = pd_id_p
					where ps_preferencial = 1 and (" . $wh . ")";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) > 0) {
			$line = $rlt[0];
			/******************/
			$sql = "select * from person_name where ps_p = $id and ps_preferencial = 0 order by ps_name ";
			$rlt = $this -> db -> query($sql);
			$rlt = $rlt -> result_array();
			$line['remissiva'] = $rlt;

			return ($line);
		}
		return ( array());
	}

	function consulta_person($term) {
		$t = splitx(';', troca($term, ' ', ';') . ';');
		$wh = '';
		$rlt = array();
		if (count($t) > 0) {
			$sql = "select ps_p from " . $this -> table_person_name . " ";
			for ($r = 0; $r < count($t); $r++) {
				$tm = $t[$r];
				if (strlen($wh) > 0) {
					$wh .= ' AND ';
				}
				$wh .= "(ps_name like '%$tm%') ";
			}
			$sql .= ' where ' . $wh;
			$sql .= " group by ps_p ";
			$rlt = $this -> db -> query($sql);
			$rlt = $rlt -> result_array();

			$wh = '';

			for ($r = 0; $r < count($rlt); $r++) {
				$line = $rlt[$r];
				$id = $line['ps_p'];
				if (strlen($wh) > 0) { $wh .= ' OR ';
				}
				$wh .= " (id_p = $id) ";
			}
			$sx = '';
			if (count($rlt) > 0) {
				$sql = "select * from person
									inner join person_name on id_p = ps_p
									left join person_data on id_p = pd_id_p
									where ps_preferencial = 1 and (" . $wh . ")";
				$rlt = $this -> db -> query($sql);
				$rlt = $rlt -> result_array();
				for ($r = 0; $r < count($rlt); $r++) {
					$line = $rlt[$r];
					$sx .= $this -> load -> view('frbr/frad/row', $line, true);
				}
			}
		}
		return ($sx);
	}

	function register_search($term, $type) {
		$term = UpperCase($term);
		$sql = "select * from " . $this -> table_cache . " where cache_name = '$term' ";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) == 0) {
			$sql = "insert into " . $this -> table_cache . " 
							(cache_name, cache_status, cache_type)
							values
							('$term','0','$type')";
			$this -> db -> query($sql);
		}
	}

}
?>
