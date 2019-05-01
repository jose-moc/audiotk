<?php
if(isset($_GET['id'])){
  $cd_id = $_GET['id'];
  unset($_GET['id']);
} else {
  $cd_id = "";
}
?>

<h1 class="page-header">Nuevo Album en Mp3</h1>
<?php echo MessagesController::getMessage() ?>
<div class="row">
  <form action="<?php echo ADMIN_URL ?>mp3/guardar" method="post" enctype="multipart/form-data" onsubmit="return validateAlbumForm()">
    <div class="col-xs-12 col-sm-6">
      <div class="form-group">
        <label for="artista">Artista/Grupo *</label>
        <input type="text" class="form-control" id="artista" name="artista" required placeholder="Nombre del artista/grupo" autofocus maxlength="64">
      </div>
    </div>
    <div class="col-xs-12 col-sm-6">
      <div class="form-group">
        <label for="album">Album *</label>
        <input type="text" class="form-control" id="album" name="album" required placeholder="Nombre del album" maxlength="64">
      </div>
    </div>
    <div class="col-xs-12 col-sm-6">
      <div class="form-group">
        <label for="fecha">Año *</label>
        <input type="text" class="form-control" id="fecha" name="fecha" placeholder="Año del album" maxlength="4">
      </div>
    </div>
    <div class="col-xs-12 col-sm-3">
      <div class="form-group">
        <label for="genero">Género</label>
        <select id="genero" class="form-control" name="genero">
          <option value=''>Selecciona un género</option>
          <?php
          $_conf = new AppConfig();
          $_generos = explode(',', $_conf->getGenders()->valor);
          sort($_generos,SORT_STRING);
          ?>
          <?php foreach($_generos as $_gen): ?>
              <option><?php echo $_gen; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-xs-12 col-sm-3">
      <div class="form-group">
        <label for="cdmp3_id">Cd mp3</label>
        <?php
        $cds_collection = $this->getCds();
        if($cds_collection): ?>

          <select id="cdmp3_id" class="form-control" name="cdmp3_id">
            <option value='0'>Selecciona un cd</option>

            <?php foreach ($cds_collection as $cd): ?>
              <option <?php if($cd->id == $cd_id){ echo 'selected'; } ?> value='<?php echo $cd->id ?>'><?php echo $cd->nombre ?></option>
            <?php endforeach; ?>

         </select>

        <?php else: ?>
          <input type="text" class="form-control" id="cdmp3_id" disabled value="No existe ningun cd">
        <?php endif; ?>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6">
      <div class="form-group">
        <label for="front_cover">Caratula delantera</label>
        <input type="file" id="front_cover" name="img_front" accept="image/jpeg">
        <p class="help-block">Solo archivos .jpg</p>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6">
      <div class="form-group">
        <label for="back_cover">Caratula trasera</label>
        <input type="file" id="back_cover" name="img_back" accept="image/jpeg">
        <p class="help-block">Solo archivos .jpg</p>
      </div>
    </div>
    <div class="col-xs-12"><hr/></div>
    <div class="col-xs-12">
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;&nbsp;Guardar</button>
    </div>
  </form>
</div>
