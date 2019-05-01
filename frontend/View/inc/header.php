<?php $p = isset($_GET['c']) ? strtolower($_GET['c']) : ''; ?>

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
	          <a class="navbar-brand" href="<?php echo URL_BASE ?>"><?php echo BRAND ?></a>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
				<li class="<?php echo $p == '' ? 'active' : ''; ?>"><a href="<?php echo URL_BASE ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
				<li class="<?php echo $p == 'cds' ? 'active' : ''; ?>"><a href="<?php echo URL_BASE ?>cds">Cds Mp3</a></li>
				<li class="<?php echo $p == 'original' ? 'active' : ''; ?>"><a href="<?php echo URL_BASE ?>original">Originales</a></li>
				<li class="<?php echo $p == 'mp3' ? 'active' : ''; ?>"><a href="<?php echo URL_BASE ?>mp3">Mp3</a></li>

	            <li class="dropdown">
					<a href="#" title="Buscar" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<form class="navbar-form navbar-right" action="<?php echo URL_BASE ?>search" method="post">
					          	<div class="input-group search">
						            <input type="text" class="form-control" id="search" name="search" placeholder="Buscar...">
								    <span class="input-group-btn">
								      <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
								    </span>
								</div>
					        </form>
					    </li>
					</ul>
				</li>
	          </ul>
	        </div>
	      </div>
	    </nav>
	</header>

