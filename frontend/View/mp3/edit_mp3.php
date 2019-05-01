<h1 class="page-header">Editar Album Mp3</h1>
<?php echo MessagesController::getMessage() ?>

<div class="row">
  <form action="<?php echo ADMIN_URL ?>mp3/actualizar" method="post" enctype="multipart/form-data" onsubmit="return validateAlbumForm()">
    <input type="hidden" name="id" value="<?php echo $item->id ?>">
    <div class="col-xs-12 col-sm-5">
      <div class="form-group">
        <label for="artista">Artista/Grupo *</label>
        <input type="text" class="form-control" id="artista" name="artista" required value="<?php echo $item->artista ?>" maxlength="64">
      </div>
    </div>
    <div class="col-xs-12 col-sm-5">
      <div class="form-group">
        <label for="album">Album *</label>
        <input type="text" class="form-control" id="album" name="album" required value="<?php echo $item->album ?>" maxlength="64">
      </div>
    </div>
    <div class="col-xs-12 col-sm-2">
      <div class="form-group">
        <label for="fecha">Año *</label>
        <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $item->fecha ?>" maxlength="4">
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
              <option <?php if($cd->id == $item->cdmp3_id){ echo 'selected'; } ?> value='<?php echo $cd->id ?>'><?php echo $cd->nombre ?></option>
            <?php endforeach; ?>

         </select>

        <?php else: ?>
          <input type="text" class="form-control" id="cdmp3_id" disabled value="No existe ningun cd">
        <?php endif; ?>
      </div>
    </div>
    <div class="col-xs-12 col-sm-3">
      <div class="form-group">
        <label for="soporte">Soporte original</label>
        <select id="soporte" class="form-control" name="ori">
          <option value='0'>Selecciona un Soporte</option>
          <option>1 cd</option>
          <option>2 cds</option>
          <option>1 cd maxi</option>
          <option>1 lp</option>
          <option>2 lps</option>
          <option>1 lp maxi</option>
          <option>3 lps</option>
          <option>cassette</option>
        </select>
      </div>
    </div>
    <div class="col-xs-12 col-sm-3">
      <div class="form-group">
        <label for="rm-mp3">Quitar mp3</label>
        <select id="rm-mp3" class="form-control" name="rm-mp3">
          <option value='0'>No</option>
          <option value='1'>Sí</option>
        </select>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6">
      <div class="form-group">
        <label>Caratula delantera</label>
        <?php if($item->img_front): ?>
          <div class="col-sm-12">
            <div class="cover_sm">
              <a href="<?php echo MEDIA_COVERS.$item->img_front ?>" data-fancybox>
                <img class="img-responsive" src="<?php echo MEDIA_COVERS.$item->img_front ?>" alt="<?php echo $item->album ?> front">
              </a>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="checkbox">
              <label><input type="checkbox" name="del_front" value="1"> Borrar imagen</label>
            </div>
          </div>
        <?php else: ?>
          <div class="cover_sm"></div>
        <?php endif ?>
        <div class="mt_20 col-xs-12">
          <input type="file" id="front_cover" name="img_front" accept="image/jpeg">
          <p class="help-block">Solo archivos .jpg</p>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6">
      <div class="form-group">
        <label>Caratula trasera</label>
        <?php if($item->img_back): ?>
          <div class="col-sm-12">
            <div class="cover_sm">
              <a href="<?php echo MEDIA_COVERS.$item->img_back ?>" data-fancybox>
                <img class="img-responsive" src="<?php echo MEDIA_COVERS.$item->img_back ?>" alt="<?php echo $item->album ?> back">
              </a>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="checkbox">
              <label><input type="checkbox" name="del_back" value="1"> Borrar imagen</label>
            </div>
          </div>
        <?php else: ?>
          <div class="cover_sm"></div>
        <?php endif ?>

        <div class="mt_20 col-xs-12">
          <input type="file" id="back_cover" name="img_back" accept="image/jpeg">
          <p class="help-block">Solo archivos .jpg</p>
        </div>
      </div>
    </div>
    <div class="col-xs-12"><hr/></div>
    <div class="col-xs-12">
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>&nbsp;&nbsp;Actualizar</button>
    </div>
  </form>
</div>

<script>
  $(document).ready(function(){
    var gen = "<?php echo $item->genero ?>";
    var support = "<?php echo $item->original ?>";
    document.getElementById('genero').selectedIndex = buscarIndice('genero', gen);
    document.getElementById('soporte').selectedIndex = buscarIndice('soporte', support);
  });
</script>
