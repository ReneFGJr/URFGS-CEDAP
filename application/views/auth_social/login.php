<?php
$erro = get("err");
?>
<!
--- LOGIN 
--->
<div class="container">
	<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<div class="panel panel-info" >
			<div class="panel-heading">
				<div class="panel-title">
					Sign In
				</div>
				<!
---
				<div style="float:right; font-size: 80%; position: relative; top:-10px">
					<a href="#">Forgot password?</a>
				</div>
				
-->
			</div>

			<div style="padding-top:30px" class="panel-body" >

				<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

				<?php 
					$atr = array('class' => 'form-horizontal', 'id' => 'loginform', 'role'=>'form');
					echo form_open(base_url('index.php/social/login_local')); 
				?>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id="login-username" type="text" class="form-control" name="dd1" value="" placeholder="username or email">
					</div>

					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="login-password" type="password" class="form-control" name="dd2" placeholder="password">
					</div>
					
					<?php
					if (isset($erro) and (strlen($erro) > 0))
						{
							echo '
							<div class="bg-danger" style="padding: 10px;">'.msg($erro).'</div>';	
						}
					?>

					<div class="input-group">
						<div class="checkbox">
							<label>
								<input id="login-remember" type="checkbox" name="dd3" value="1">
								<?php echo msg('remember_me');?> </label>
						</div>
					</div>

					<div style="margin-top:10px" class="form-group">
						<!
-- Button 
-->

						<div class="col-sm-12 controls">
							<input type="submit" id="btn-login" href="#" class="btn btn-success" value="<?php echo msg('login');?>">
							<a id="btn-fblogin" href="<?php echo base_url('index.php/social/session/facebook/'); ?>" class="btn btn-primary">Login with Facebook</a>
							<a id="btn-fblogin" href="<?php echo base_url('index.php/social/session/google/'); ?>" class="btn btn-primary">Login with Google+</a>

						</div>
					</div>
					<!
--
					<div class="form-group">
						<div class="col-md-12 control">
							<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
								Don't have an account!
								<a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()"> Sign Up Here </a>
							</div>
						</div>
					</div>
					
-->
				</form>

			</div>
		</div>
	</div>
</div>



from PIL import Image

import Image
im = Image.open(library.jpeg)
im.save(test.tiff)  # or test.tif


./configure 
--prefix=/usr 
--libdir=/usr/lib64 
--with-libdir=lib64 
--localstatedir=/var 
--sysconfdir=/etc 
--datarootdir=/usr/share 
--datadir=/usr/share 
--infodir=/usr/info 
--mandir=/usr/man 
--with-apxs2=/usr/bin/apxs 
--enable-fpm 
--with-fpm-user=apache 
--with-fpm-group=apache 
--enable-maintainer-zts 
--enable-pcntl 
--enable-mbregex 
--enable-tokenizer=shared 
--with-config-file-scan-dir=/etc/php.d 
--with-config-file-path=/etc 
--enable-mod_charset 
--with-layout=PHP 
--disable-sigchild 
--enable-xml 
--with-libxml-dir=/usr 
--enable-simplexml 
--enable-xmlreader=shared 
--enable-dom=shared 
--enable-filter 
--disable-debug 
--with-pgsql=shared,/usr/local/pgsql 
--with-openssl=shared 
--with-pcre-regex=/usr
--with-zlib=shared,/usr 
--enable-bcmath=shared 
--with-bz2=shared,/usr 
--enable-calendar=shared 
--enable-ctype=shared 
--with-curl=shared 
--with-mcrypt=/usr 
--enable-dba=shared 
--with-gdbm=/usr 
--with-db4=/usr 
--enable-exif=shared 
--enable-ftp=shared 
--with-gd=shared 
--with-jpeg-dir=/usr 
--with-png-dir=/usr 
--with-vpx-dir=/usr 
--with-zlib-dir=/usr 
--with-xpm-dir=/usr 
--with-freetype-dir=/usr 
--with-t1lib=/usr 
--enable-gd-native-ttf 
--with-gettext=shared,/usr 
--with-gmp=shared,/usr 
--with-iconv=shared 
--with-imap-ssl=/usr 
--with-imap=/usr/local/lib64/c-client 
--with-ldap=shared 
--enable-mbstring=shared 
--enable-hash 
--with-mysql=shared,mysqlnd 
--with-mysqli=shared,mysqlnd 
--with-mysql-sock=/var/run/mysql/mysql.sock 
--with-iodbc=shared,/usr 
--enable-pdo=shared 
--with-pdo-mysql=shared,mysqlnd 
--with-pdo-sqlite=shared,/usr 
--with-pdo-odbc=shared,iODBC,/usr 
--with-pspell=shared,/usr 
--with-enchant=shared,/usr 
--enable-shmop=shared 
--with-snmp=shared,/usr 
--enable-soap=shared 
--enable-sockets 
--with-sqlite3=shared 
--with-regex=php 
--enable-sysvmsg 
--enable-sysvsem 
--enable-sysvshm 
--enable-wddx=shared 
--with-xsl=shared,/usr 
--enable-zip=shared 
--with-tsrm-pthreads 
--enable-intl=shared 
--enable-opcache 
--enable-shared=yes 
--enable-static=no 
--with-gnu-ld 
--with-pic 
--enable-phpdbg 
--build=x86_64-slackware-linux build_alias=x86_64-slackware-linux CFLAGS=-O2 -fPIC
