<h1 class="page-header">Editar Album Original</h1>
<?php echo MessagesController::getMessage(); ?>

<div class="row">
  <form action="<?php echo ADMIN_URL ?>original/actualizar" method="post" enctype="multipart/form-data" onsubmit="return validateAlbumForm()">
    <input type="hidden" name="id" value="<?php echo $item->id ?>">
    <div class="col-xs-12 col-sm-4">
      <div class="form-group">
        <label for="artista">Artista / Grupo *</label>
        <input type="text" class="form-control" id="artista" name="artista" required value="<?php echo $item->artista ?>" maxlength="64">
      </div>
    </div>
    <div class="col-xs-12 col-sm-5">
      <div class="form-group">
        <label for="album">Album *</label>
        <input type="text" class="form-control" id="album" name="album" required value="<?php echo $item->album ?>" maxlength="64">
      </div>
    </div>
    <div class="col-xs-12 col-sm-3">
      <div class="form-group">
        <label for="soporte">Soporte</label>
        <select id="soporte" class="form-control" name="soporte">
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
    <div class="col-xs-12 col-sm-4">
      <div class="form-group">
        <label for="fecha">Año *</label>
        <input type="text" class="form-control" id="fecha" name="fecha" required value="<?php echo $item->fecha ?>" maxlength="4">
      </div>
    </div>
    <div class="col-xs-12 col-sm-4">
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
    <div class="col-xs-12 col-sm-4">
      <div class="form-group">
        <label for="is_mp3">Poner en mp3</label>
        <select id="is_mp3" class="form-control" name="mp3">
          <option value='0'>No</option>
          <option value='1'>Sí</option>
        </select>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6">
      <div class="form-group">
        <label>Caratula delantera</label>
        <?php if($item->img_front): ?>
          <div class="col-xs-12">
            <div class="cover_sm">
              <a href="<?php echo ADMIN_URL.$item->img_front ?>" data-fancybox>
                <img class="img-responsive" src="<?php echo ADMIN_URL.$item->img_front ?>" alt="<?php echo $item->album ?> front">
              </a>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="checkbox">
              <label><input type="checkbox" name="del_front" value="1"> Borrar imagen</label>
            </div>
          </div>
        <?php else: ?>
          <div class="cover_sm"></div>
        <?php endif ?>
        <div class="mt_20 col-xs-12">
          <input type="file" id="front_mp3" name="img_front" accept="image/jpeg">
          <p class="help-block">Solo archivos .jpg</p>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6">
      <div class="form-group">
        <label>Caratula trasera</label>
        <?php if($item->img_back): ?>
          <div class="col-xs-12">
            <div class="cover_sm">
              <a href="<?php echo ADMIN_URL.$item->img_back ?>" data-fancybox>
                <img class="img-responsive" src="<?php echo ADMIN_URL.$item->img_back ?>" alt="<?php echo $item->album ?> back">
              </a>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="checkbox">
              <label><input type="checkbox" name="del_back" value="1"> Borrar imagen</label>
            </div>
          </div>
        <?php else: ?>
          <div class="cover_sm"></div>
        <?php endif ?>

        <div class="mt_20 col-xs-12">
          <input type="file" id="back_mp3" name="img_back" accept="image/jpeg">
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
    var mp3 = "<?php echo $item->mp3 ?>";
    var support = "<?php echo $item->original ?>";
    document.getElementById('genero').selectedIndex = buscarIndice('genero', gen);
    document.getElementById('soporte').selectedIndex = buscarIndice('soporte', support);

    if(mp3 == 1){ mp3 = 'Sí'; }
    document.getElementById('is_mp3').selectedIndex = buscarIndice('is_mp3', mp3);
  });
</script>
