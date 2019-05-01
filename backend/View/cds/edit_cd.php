MEDIA_COVERS.<h1 class="page-header">Editar Cd Mp3</h1>
<?php echo MessagesController::getMessage() ?>

<div class="row">
  <form action="<?php echo ADMIN_URL ?>cds/actualizar" method="post">
    <input type="hidden" name="id" value="<?php echo $item->id ?>">
    <div class="col-xs-12 col-sm-6">
      <div class="form-group">
        <label for="nombre_cd">Nombre del cd</label>
        <input type="text" class="form-control" id="nombre_cd" name="nombre" required value="<?php echo $item->nombre ?>" maxlength="48">
      </div>

      <div class="form-group">
        <label for="qty_cd">Número de Albums</label>
        <input type="text" class="form-control" id="qty_cd" value="<?php echo $item->qty ?>" disabled="disabled">
        <?php // Como no se puede envíar un input disabled, lo hacemos oculto ?>
        <input type="hidden" name="qty" value="<?php echo $item->qty ?>">
      </div>
    </div>
    <div class="hidden-xs hidden-sm col-md-6">
      <img src="<?php echo ADMIN_URL ?>assets/images/cd-animated.gif" alt="" class="img-responsive">
    </div>

    <div class="col-xs-12">
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>&nbsp;&nbsp;Actualizar</button>
    </div>
    <div class="col-xs-12 col-sm-12">
      <h3 class="page-header mt_40">Seleccionar Mp3</h3>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th></th>
              <th>Artista</th>
              <th>Album</th>
              <th>Año</th>
              <th>Género</th>
              <th>Front</th>
              <th>Back</th>
              <th>Original</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $this->setMp3();
            $_collection = $this->getAllMp3();
            ?>
            <?php if($_collection): ?>
              <?php foreach ($_collection as $item): ?>
                <tr>
                  <td>
                    <div class="checkbox">
                      <label><input type="checkbox" name="add2cd[]" value="<?php echo $item->id ?>"></label>
                    </div>
                  </td>
                  <td><?php echo $item->artista ?></td>
                  <td><?php echo $item->album ?></td>
                  <td><?php echo $item->fecha ?></td>
                  <td><?php echo $item->genero ?></td>
                  <td>
                    <?php if($item->img_front != ''): ?>
                      <div class="cover_xs">
                        <a href="<?php echo MEDIA_COVERS.$item->img_front ?>" class="fancybox">
                          <img class="img-responsive" src="<?php echo MEDIA_COVERS.$item->img_front ?>" alt="<?php echo $item->album ?> front">
                        </a>
                      </div>
                    <?php endif ?>
                  </td>
                  <td>
                    <?php if($item->img_back != ''): ?>
                      <div class="cover_xs">
                        <a href="<?php echo MEDIA_COVERS.$item->img_back ?>" class="fancybox">
                          <img class="img-responsive" src="<?php echo MEDIA_COVERS.$item->img_back ?>" alt="<?php echo $item->album ?> back">
                        </a>
                      </div>
                    <?php endif ?>
                  </td>
                  <td>
                    <?php echo ($item->original != 0) ? $item->original : 'No'; ?>
                  </td>
                </tr>
              <?php endforeach ?>
            <?php else: ?>
              <tr>
                <td colspan="9"><div class="messages bg-info">No hay MP3 sin asignar.</div></td>
              </tr>
            <?php endif ?>
          </tbody>
        </table>
      </div>
    </div>
  </form>
</div>
