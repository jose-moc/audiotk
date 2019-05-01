<h1 class="page-header">Nuevo CD de Mp3</h1>
<?php echo MessagesController::getMessage() ?>

<div class="row">
  <form action="<?php echo ADMIN_URL ?>cds/guardar" method="post" enctype="multipart/form-data">
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label for="nombre_cd">Nombre del cd</label>
        <input type="text" class="form-control" id="nombre_cd" name="nombre" required autofocus maxlength="48">
      </div>
      <div class="form-group">
        <label for="qty_cd">Número de Albums</label>
        <input type="text" class="form-control" id="qty_cd" name="qty" value="0" disabled="disabled">
      </div>
    </div>
    <div class="hidden-xs hidden-sm col-md-6">
      <img src="<?php echo BASE_URL ?>assets/images/cd-animated.gif" alt="" class="img-responsive">
    </div>
    <div class="col-xs-12">
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;&nbsp;Guardar</button>
    </div>
  </form>
</div>
