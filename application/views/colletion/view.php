<?php
$d = '';
$p = $propriety;

for ($r=0;$r < count($p);$r++)
	{
		$ln = $p[$r];
		
		$lk = 'onclick="newxy(\'' . base_url('index.php/admin/rdf_edit/'.$ln['id_rf'].'/' . checkpost_link($ln['id_rf'])) .'\',800,600);" ';
		
		$d .= '<tr style="line-height: 100%;">';
		$d .= '<td align="left" style="font-size: 8px;">';
		
		$n = trim($ln['prefix_ref']);
		$n .= ':';
		$n .= trim($ln['rs_propriety']);
		$d .= msg($n);		
		$d .= '</td>';
		$d .= '</tr>';
		
		$d .= '<tr style="line-height: 100%;">';
		$d .= '<td style="font-size: 14px;"><b>';
		$d .= mst(msg(trim($ln['rf_value'])));
		$d .= ' <span class="glyphicon glyphicon-pencil" aria-hidden="true" '.$lk.'></span>';
		$d .= '</b>';		
		$d .= '</td>';		
		$d .= '</tr>';
	}
?>
	<div class="row">
		<div class="col-md-12">
			<span style="font-size:8px">Coleção</span><br>
			<span style="font-size:30px"><?php echo $c_name; ?></span>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<table width="100%" border=0>
				<tr style="font-size:10px" valign="top">
					<td width="90%"></td>
				</tr>
				<?php echo $d; ?>
			</table>
		</div>
	</div>
