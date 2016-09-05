<?php
/* Remissivas */
$remi = '<ul>';
for ($r = 0; $r < count($remissiva); $r++) {
	$remi .= '<li>' . $remissiva[$r]['ps_name'] . '</li>';
}
$remi .= '</ul>';
?>
<div class="container">
  <h2>
				<?php
				echo trim($ps_name);
				/**** DATAS ***/
				$dn = $pd_born;
				$df = $pd_death;
				$dn = substr($dn, 0, 4);
				$df = substr($df, 0, 4);
				if (strlen($dn . $df) > 0) {
					echo ', ' . $dn . '-' . $df;
				}
				?></h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">MARC21</a></li>
    <li><a data-toggle="tab" href="#menu2">VIAF</a></li>
    <li><a data-toggle="tab" href="#menu3">Edit</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Remissivas</h3>
      <?php echo $remi; ?>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>