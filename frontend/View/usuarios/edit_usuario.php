<h1 class="page-header">Editar Usuario</h1>
<?php echo MessagesController::getMessage() ?>

<form action="<?php echo ADMIN_URL ?>usuarios/actualizar" method="post" onsubmit="return validateUserForm();">
  <input type="hidden" name="id" value="<?php echo $_usuario->id ?>">
  <div class="col-xs-12 col-sm-6 col-md-4">
    <div class="form-group">
      <label for="usuario">Usuario</label>
      <input type="text" class="form-control" id="user_name" name="user_name" required value="<?php echo $_usuario->user ?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" class="form-control" id="email" name="email" value="<?php echo $_usuario->email ?>">
    </div>
    <div class="checkbox">
      <label id="checkbox_passwd"><input id="change_passwd" type="checkbox" name="change_passwd" value="1"> Cambiar contraseña</label>
    </div>
    <div class="show_passwd" style="display:none;">
      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="form-group">
        <label for="password_confirm">Confirmar contraseña</label>
        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
      </div>
    </div>
  </div>

  <div class="col-xs-12">
    <button type="submit" class="btn btn-primary">Actualizar</button>
  </div>
</form>
