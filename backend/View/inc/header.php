<?php include "head.php" ?>
<body>
	<header>
		<nav class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container-fluid">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="<?php echo ADMIN_URL ?>main"><?php echo BRAND ?></a>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="<?php echo ADMIN_URL ?>main" title="Inicio"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span><span class="show-xs">&nbsp;&nbsp;Inicio</span></a></li>
	            <li class="dropdown">
					<a href="#" title="Listar" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span><span class="show-xs">&nbsp;&nbsp;Listar&nbsp;</span><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo ADMIN_URL ?>cds">Cds Mp3</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?php echo ADMIN_URL ?>original">Albums originales</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?php echo ADMIN_URL ?>mp3">Albums mp3</a></li>
					</ul>
				</li>
	            <li class="dropdown">
					<a href="#" title="Nuevo" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span><span class="show-xs">&nbsp;&nbsp;Nuevo&nbsp;</span><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo ADMIN_URL ?>cds/nuevo">Nuevo cd mp3</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?php echo ADMIN_URL ?>original/nuevo">Nuevo album original</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?php echo ADMIN_URL ?>mp3/nuevo">Nuevo album mp3</a></li>
					</ul>
				</li>
				<li><a href="<?php echo ADMIN_URL ?>config" title="Configuración"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span><span class="show-xs">&nbsp;&nbsp;Configuración</span></a></li>
	            <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;<?php echo Session::get('user') ?>&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo ADMIN_URL ?>usuarios"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Ver usuarios</a></li>
						<li><a href="<?php echo ADMIN_URL ?>usuarios/nuevo"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;&nbsp;Nuevo usuario</a></li>
						<li><a href="<?php echo ADMIN_URL ?>usuarios/editar/<?php echo Session::get('user_id') ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;Editar cuenta</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="<?php echo ADMIN_URL ?>access/logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;&nbsp;Cerrar sesión</a></li>
					</ul>
				</li>
	          </ul>
	          <form class="navbar-form navbar-right" action="<?php echo ADMIN_URL ?>search" method="post">
	          	<div class="input-group">
		            <input type="text" class="form-control" id="search" name="search" placeholder="Buscar...">
				    <span class="input-group-btn">
				      <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
				    </span>
				</div>
	          </form>
	        </div>
	      </div>
	    </nav>
	</header>

