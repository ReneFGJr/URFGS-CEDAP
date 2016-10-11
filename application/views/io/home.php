<div class="container-fluid">
	<?php
	if (!isset($path)) { $path = array();
	}
	$url = 'index.php/io/dir/';
	echo '<ol class="breadcrumb">' . cr();
	echo '<li class="breadcrumb-item">' . cr();
	echo '<a href="'.base_url($url).'">'.msg('folder').'</a>';
	echo '</li>';
	
	for ($r = 1; $r < count($path); $r++) {
		if (strlen($path[$r]) > 0) {
			$url .= trim($path[$r]).'/';
			echo '<li class="breadcrumb-item">' . cr();
			echo '<a href="'.base_url($url).'">' . trim($path[$r]) . '</a>' . cr();
			echo '</li>' . cr();
		}

	}
	echo '</ol>' . cr();
	?>

	</ol>
	<div class="row">
		<div class="col-md-2">
			File Explorer
			<?php echo $tree; ?>
		</div>
		<div class="col-md-3">
			File System
			<?php echo $files; ?>
		</div>
		<div class="col-md-5">
			<?php echo $files_metadata; ?>
		</div>
		<div class="col-md-2">
			File Action

			<?php echo $actions; ?>
		</div>
	</div>
</div>
<pre>

<html>
<head>
<title>Current Directory Listing</title>
<script type="text/javascript">
	// Find the appropriate folder id and determine its state.
	// If it is not showing, show it and if it is showing hide it.
	function showSubs(topicid) {
		var subs = document.getElementById("folder" + topicid);

		// In the if statement below you can also add statements to change icons for each element
		// Just remember to give the icon a unique id that matches the folder's id.
		if (subs.style.display == "none") {
			subs.style.display = "block";
		} else {
			subs.style.display = "none";
		}
	}

</script>
</head>

<body>


</pre>