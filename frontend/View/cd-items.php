<div class="row">
  <div class="col-xs-12 col-sm-9 col-md-10">
    <h1 class="page-header name"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span>&nbsp;<?php echo $_cd->nombre ?></h1></div>
  <div class="col-xs-12 col-sm-3 col-md-2 text-right mb_20">
    <a href="javascript:history.back(1)" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp;&nbsp;Atrás</a>
  </div>
</div>
<?php if($albums): ?>
  <div class="row items-wrapper">
    <?php foreach ($albums as $item): ?>
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
    <?php endforeach ?>
  </div>
  <div class="col-xs-12 text-right mb_20">
    <a href="javascript:history.back(1)" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp;&nbsp;Atrás</a>
  </div>
<?php endif; // fin albums ?>

