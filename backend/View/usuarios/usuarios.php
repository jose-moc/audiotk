<h1 class="page-header">Usuarios</h1>
<?php echo MessagesController::getMessage() ?>

<div><a href="<?php echo ADMIN_URL ?>usuarios/nuevo" class="btn btn-success">Nuevo usuaro</a></div>
<br>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
        <tr>
					<th>Nombre</th>
					<th>Email</th>
          <th colspan="2"></th>
        </tr>
      </thead>
      <tbody>
        <?php $_usuarios = $this->usr->getAll(); ?>
        <?php if($_usuarios): ?>
        	<?php foreach ($_usuarios as $usr): ?>
            <tr>
            	  <td><?php echo $usr->user ?></td>
                <td><?php echo $usr->email ?></td>
                <td><a href="<?php echo ADMIN_URL ?>usuarios/editar/<?php echo $usr->id; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;&nbsp;Editar</a></td>
                <td><a href="<?php echo ADMIN_URL ?>usuarios/borrar/<?php echo $usr->id; ?>" title="borrar el usuario: <?php echo $usr->user ?>" class="btn btn-danger btn-sm delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
    </table>
</div>
