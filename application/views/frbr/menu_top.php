<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">AC</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="font-family: 'RobotoThin'; font-size: 26px;" href="<?php echo base_url('index.php/authority');?>">
      			<font color="green">A</font>
      			<font style="font-size:16px;">&</font>
      			<font color="orange">C</font></a>
    </div>

     
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url('index.php/authority');?>">Home</a></li>
        <li><a href="<?php echo base_url('index.php/authority/import');?>">Import</a></li>
      </ul>
	
      <ul class="nav navbar-nav navbar-right">
      	<!--
        <li><a href="#">Link</a></li>
       -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sign in <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>