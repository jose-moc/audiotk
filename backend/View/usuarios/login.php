<div class="container">

    <form class="form-signin" action="<?php echo ADMIN_URL ?>access/login" method="post">
        <h2 class="form-signin-heading">Acceso</h2>
        <label for="input_user" class="sr-only">Usuario</label>
        <input type="text" id="input_user" class="form-control" name="user" placeholder="Usuario" required autofocus>
        <label for="input_passwd" class="sr-only">Contraseña</label>
        <input type="password" id="input_passwd" class="form-control" name="passwd" placeholder="Contraseña" required>
        <br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
    </form>

</div> <!-- /container -->

<script src="<?php echo BASE_URL ?>assets/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/main.js"></script>
