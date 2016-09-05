<?php
$chk = array('', '', '', '', '', '', '');
$chk[0] = 'checked';
?>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<!-- Styles -->
<style>
	.Raleway {
		font-family: 'Raleway';
		font-weight: 100;
	}

	.full-height {
		height: 50vh;
	}

	.flex-center {
		align-items: center;
		display: flex;
		justify-content: center;
	}

	.position-ref {
		position: relative;
	}

	.top-right {
		position: absolute;
		right: 10px;
		top: 18px;
	}

	.content {
		text-align: center;
	}

	.title {
		font-size: 84px;
	}

	.links {
		font-family: 'Raleway';
		padding: 0 25px;
		font-size: 12px;
		font-weight: 600;
		letter-spacing: .1rem;
		text-decoration: none;
		text-transform: uppercase;
		color: #555555;
	}

	.links > a {
		font-family: 'Raleway';
		padding: 0 25px;
		font-size: 12px;
		font-weight: 600;
		letter-spacing: .1rem;
		text-decoration: none;
		text-transform: uppercase;
		color: #555555;
	}

	.m-b-md {
		margin-top: 0px;
	}
</style>

<div class="flex-center position-ref full-height">
	<div class="content">
		<div class="Raleway title m-b-md">
			Authority Control
		</div>

		<div class="links">
			<a href="<?php echo base_url('index.php/authority/docs'); ?>">Documentation</a>
			<a href="<?php echo base_url('index.php/authority/about'); ?>">About</a>
			<a href="<?php echo base_url('index.php/authority/stats'); ?>">Stats</a>
			<a href="<?php echo base_url('index.php/authority/contact'); ?>">Contact</a>
		</div>

		<div class="form">
			<div class="row" style="margin-top: 100px;">
				<form method="post" action="<?php echo base_url('index.php/authority/'); ?>">
					<div class="col-lg-6 col-lg-offset-3">
						<div class="input-group">
							<input type="text" name="search" class="form-control links" placeholder="Search for..." value="<?php echo get("search"); ?>">
							<span class="input-group-btn">
								<input type="submit" name="action" class="btn btn-primary" type="button" value="Pesquisar!">								
								</button> </span>
						</div><!-- /input-group -->
					</div><!-- /.col-lg-6 -->
					<div class="col-lg-6 col-lg-offset-3">
						<div class="input-group links">
							<input type="radio" value="0" name="entidade" <?php echo $chk[0]; ?>>
							Pessoa
							&nbsp;&nbsp;
							<input type="radio" value="1" name="entidade" <?php echo $chk[1]; ?>>
							Organização
							&nbsp;&nbsp;
							<input type="radio" value="2" name="entidade" <?php echo $chk[2]; ?>>
							Família
						</div><!-- /input-group -->
					</div><!-- /.col-lg-6 -->
				</form>
			</div><!-- /.row -->
			;
		</div>
	</div>
</div>
</body>
</html>
