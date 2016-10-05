<?php
$us_nome = $_SESSION['user'];
?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url('index.php/main'); ?>"><img src="<?php echo base_url('img/logo/logo_png_bw.png'); ?>" height="20"></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>
					<a href="#">Documentos</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Coleções<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="#">Selecionar</a>
						</li>
					</ul>
				</li>
				<li>
				<a href="<?php echo base_url('index.php/main/filescan'); ?>">File Scan</a>
				</li>
				<?php
				//if (perfil("#ADM#GEG")) 
				{
					echo '<li><a href="' . base_url('index.php/io/mets') . '">METS</a></li>' . cr();
				}
				?>					
				<!--
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Financeiro <span class="caret"></span></a>
				<ul class="dropdown-menu">
				<li>
				<a href="<?php echo base_url('index.php/cx/caixa'); ?>">Caixa</a>
				</li>
				<li>
				<a href="<?php echo base_url('index.php/cx/cpagar'); ?>">Contas a Pagar</a>
				</li>
				<li>
				<a href="<?php echo base_url('index.php/cx/creceber'); ?>">Contas a Receber</a>
				</li>
				</ul>
				</li>
				-->

				<?php
				$rd = $this;
				if (isset($rd->uri->rsegments))
				{
					$rd = $rd->uri->rsegments;
					if (($rd[1] == 'io') and (isset($rd[3])) and (strlen($rd[3]) > 0))
						{
							for ($r = 4; $r < 6;$r++)
								{
									if (isset($rd[$r]))
									{
									if (strlen($rd[$r]) > 0)
										{ $rd[3] .= '/'.$rd[$r]; }
									}
								}
							echo '				
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Utilitários <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li>
										<a href="#" onclick="newxy(\''.base_url('index.php/io/dir_createpreview/'.$rd[3]).'\',400,600);">Criar Miniaturas e Preview</a>
									</li>
									<li>
										<a href="#" onclick="newxy(\''.base_url('index.php/io/dir_normatize/'.$rd[3]).'\',400,600);">Padronizar nomes dos arquivos</a>
									</li>									
								</ul>
							</li>';	
						}
					
				}
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastro <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="#">Classes</a>
						</li>
				</li>
				<li>
				<a href="<?php echo base_url('index.php/admin/users'); ?>">Usuários do Sistema</a>
				</li>
				<li>
				<a href="<?php echo base_url('index.php/admin/filiais'); ?>">Matriz e Filiais</a>
				</li>
				<?php
				if (perfil("#ADM#GEG")) {
					echo '<li role="separator" class="divider"></li>' . cr();
					echo '<li><a href="' . base_url('index.php/admin/logins') . '">Atribuir Perfil a usuários</a></li>' . cr();
				}
				?>
			
			</ul>
			<?php
			//if (perfil("#ADM"))
			{
				echo '<li class="dropdown">' . cr();
				echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrador <span class="caret"></span></a>' . cr();
				echo '<ul class="dropdown-menu">' . cr();
				echo '	<li>' . cr();
				echo '		<li><a href="' . base_url('index.php/admin/perfil') . '">Cadastro de Perfis</a></li>' . cr();
				echo '	</li>' . cr();
				echo '	<li>' . cr();
				echo '		<li><a href="' . base_url('index.php/admin/comunicacao_1') . '">Mensagens do Sistema</a></li>' . cr();
				echo '	</li>' . cr();
				echo '	<li>' . cr();
				echo '		<li><a href="' . base_url('index.php/admin/colletion') . '">Coleções (cadastro)</a></li>' . cr();
				echo '	</li>' . cr();
				echo '</ul>' . cr();
			}
			?>

			</li>
			</ul>
			<!--
			<form class="navbar-form navbar-left" role="search">
			<div class="form-group">
			<input type="text" class="form-control" placeholder="Search">
			</div>
			<button type="submit" class="btn btn-default">
			Submit
			</button>
			</form>
			-->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $us_nome; ?>
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo base_url('index.php/main/myaccount'); ?>">Meus Dados</a>
						</li>
						<li>
							<a href="<?php echo base_url('index.php/social/logout'); ?>">Logout</a>
						</li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>