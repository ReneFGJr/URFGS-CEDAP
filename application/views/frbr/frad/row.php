<?php
	$link = base_url('index.php/authority/author/'.$id_p);
?>
<div class="row">
	<div class="col-md-12">
		<a href="<?php echo $link;?>" class="Raleway xxxbig">
		<?php echo $ps_name;
		
		/**** DATAS ***/
		$dn = $pd_born;
		$df = $pd_death;
		$dn = substr($dn,0,4);
		$df = substr($df,0,4);
		if (strlen($dn.$df) > 0)
			{
				echo ', '.$dn.'-'.$df;
			}
		?>
		</a>
	</div>
</div>
