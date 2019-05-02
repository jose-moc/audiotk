<h1 class="page-header">Albums Mp3</h1>
<div class="row items-wrapper">
  <?php $_collection = $this->getAllMp3(); ?>
  <?php if($_collection): ?>
  	<?php foreach ($_collection as $item): ?>

      <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3 col-xxl-2">
        <div class="item">
           <div class="img-box">
            <?php if($item->img_front != ''): ?>
              <div class="cover">
                <a href="<?php echo MEDIA_COVERS.$item->img_front ?>" data-fancybox>
                  <img class="img-responsive" src="<?php echo MEDIA_COVERS.$item->img_front ?>" alt="<?php echo $item->album ?> front">
                </a>
              </div>
            <?php else: ?>
              <div class="cover">
                <img class="img-responsive" src="<?php echo MEDIA_COVERS ?>no-image.jpg" alt="No hay imagen">
              </div>
            <?php endif ?>
            <?php if($item->img_back != ''): ?>
              <div class="cover">
                <a href="<?php echo MEDIA_COVERS.$item->img_back ?>" data-fancybox>
                  <img class="img-responsive" src="<?php echo MEDIA_COVERS.$item->img_back ?>" alt="<?php echo $item->album ?> back">
                </a>
              </div>
            <?php endif ?>
          </div>
          <div class="clearfix"></div>
          <div class="content-box">
            <table class="table table-bordered table-condensed">
              <tbody>
                <tr>
                  <th>Interprete</th>
                  <td><?php echo $item->artista ?></td>
                </tr>
                <tr class="album-row">
                  <th>Album</th>
                  <td><?php echo $item->album ?></td>
                </tr>
                <tr>
                  <th>Año</th>
                  <td><?php echo $item->fecha ?></td>
                </tr>
                <tr>
                  <th>Género</th>
                  <td><?php echo $item->genero ?></td>
                </tr>
                <tr>
                  <th>Cd Mp3</th>
                  <td>
                    <?php
                    if ($item->cdmp3_id > 0 && $item->cdmp3_id != '') {
                      $cd = $this->getCds($item->cdmp3_id);
                      echo $cd->nombre;
                    }else {
                      echo "No";
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Original</th>
                  <td><?php echo ($item->original != 0) ? $item->original : 'No'; ?></td>
                </tr>
              </tbody>
            </table>
          </div><!-- /.content-box -->
        </div> <!-- /.item -->
      </div>

    <?php endforeach; ?>
  <?php endif; ?>

</div>
<?php $this->getPager(); ?>
