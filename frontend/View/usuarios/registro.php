<h1 class="page-header">Nuevo usuario</h1>
<?php echo MessagesController::getMessage() ?>
<div class="row">
	<div class="col-sm-8 col-md-6">
		<form action="<?php echo ADMIN_URL ?>usuarios/guardar" method="post" onsubmit="return validateUserForm()">
		<div class="form-group">
			<label for="user_name">Nombre de usuario</label>
			<input type="text" class="form-control" id="user_name" name="user_name" required autofocus>
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" required>
		</div>
		<div class="form-group">
			<label for="password">Contraseña</label>
			<input type="password" class="form-control" id="password" name="password" required>
		</div>
		<div class="form-group">
			<label for="password_confirm">Confirmar contraseña</label>
			<input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
		</div>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
	</div>
	<div class="col-sm-4 col-md-6">
		<div class="avatar img-thumbnail"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
	</div>
</div>
