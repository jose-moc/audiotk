<h1 class="page-header">Busqueda para: <span style="color:#f90;"><?php echo $this->getSearchTerm(); ?></span></h1>
<?php if($results): ?>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Cd mp3</th>
          <th>Interprete</th>
          <th>Album</th>
          <th>Año</th>
          <th>Género</th>
          <th>Front</th>
          <th>Back</th>
          <th>Mp3</th>
          <th>Original</th>
          <th colspan="2"></th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($results as $item): ?>
            <tr>
              <td><?php if(isset($item->nombre)){ echo $item->nombre; } ?></td>
              <td><?php if(isset($item->artista)){ echo $item->artista; } ?></td>
              <td><?php if(isset($item->album)){ echo $item->album; } ?></td>
              <td><?php if(isset($item->fecha)){ echo $item->fecha; } ?></td>
              <td><?php if(isset($item->genero)){ echo $item->genero; } ?></td>
              <td>
                <?php if(isset($item->img_front) && $item->img_front != ''): ?>
                  <div class="cover_xs">
                    <a href="<?php echo MEDIA_COVERS.$item->img_front ?>" data-fancybox>
                      <img class="img-responsive" src="<?php echo MEDIA_COVERS.$item->img_front ?>" alt="<?php echo $item->album ?> front">
                    </a>
                  </div>
                <?php endif ?>
              </td>
              <td>
                <?php if(isset($item->img_back) && $item->img_back != ''): ?>
                  <div class="cover_xs">
                    <a href="<?php echo MEDIA_COVERS.$item->img_back ?>" data-fancybox>
                      <img class="img-responsive" src="<?php echo MEDIA_COVERS.$item->img_back ?>" alt="<?php echo $item->album ?> back">
                    </a>
                  </div>
                <?php endif ?>
              </td>
              <td align="center"><?php echo ($item->mp3 == 1) ? 'Sí' : 'No';  ?></td>
              <td><?php echo ($item->original != 0) ? $item->original : 'No'; ?></td>
              <td><a href="<?php echo ADMIN_URL ?>mp3/editar/<?php echo $item->mp3id; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
              <td><a href="<?php echo ADMIN_URL ?>mp3/borrar/<?php echo $item->mp3id; ?>" title="Eliminar: <?php echo $item->artista.' - '.$item->album ?>" class="btn btn-danger btn-sm delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
            </tr>
          <?php endforeach ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <h3 class="messages bg-info">Ningun resultado para la busqueda.</h3>
<?php endif; ?>
