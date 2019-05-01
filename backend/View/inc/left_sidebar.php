<?php
$p = isset($_GET['c']) ? strtolower($_GET['c']) : '';
$p .= isset($_GET['a']) ? '-'.strtolower($_GET['a']) : '';
?>

<ul class="nav nav-sidebar">
  <li class="<?php echo $p == 'cds' ? 'active' : ''; ?>"><a href="<?php echo ADMIN_URL ?>cds"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;&nbsp;Cds Mp3</a></li>
  <li class="<?php echo $p == 'original' ? 'active' : ''; ?>"><a href="<?php echo ADMIN_URL ?>original"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;&nbsp;Albums Originales</a></li>
  <li class="<?php echo $p == 'mp3' ? 'active' : ''; ?>"><a href="<?php echo ADMIN_URL ?>mp3"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;&nbsp;Albums Mp3</a></li>
</ul>
<hr>
<ul class="nav nav-sidebar">
  <li class="<?php echo $p == 'cds-nuevo' ? 'active' : ''; ?>"><a href="<?php echo ADMIN_URL ?>cds/nuevo"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span>&nbsp;&nbsp;Nuevo cd</a></li>
  <li class="<?php echo $p == 'original-nuevo' ? 'active' : ''; ?>"><a href="<?php echo ADMIN_URL ?>original/nuevo"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span>&nbsp;&nbsp;Nuevo album original</a></li>
  <li class="<?php echo $p == 'mp3-nuevo' ? 'active' : ''; ?>"><a href="<?php echo ADMIN_URL ?>mp3/nuevo"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span>&nbsp;&nbsp;Nuevo album mp3</a></li>
</ul>
<hr>
<ul class="nav nav-sidebar">
  <li class="<?php echo $p == 'config' ? 'active' : ''; ?>"><a href="<?php echo ADMIN_URL ?>config"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;&nbsp;Configuración</a></li>
</ul>
