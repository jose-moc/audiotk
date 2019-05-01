<h1 class="page-header">Inicio <small>Panel de control</small></h1>
<div class="row">
	<div class="col-xs-4 pd-xs-0">
		<div class="info-qty bg-violet text-center">
			<h3>CDS MP3</h3>
			<strong><?php echo MainController::countItems('cd') ?></strong>
		</div>
	</div>
	<div class="col-xs-4 pd-xs-0">
		<div class="info-qty bg-blue text-center">
			<h3>MP3</h3>
			<strong><?php echo MainController::countItems('mp3') ?></strong>
		</div>
	</div>
	<div class="col-xs-4 pd-xs-0">
		<div class="info-qty bg-green text-center">
			<h3>ORIGINALES</h3>
			<strong><?php echo MainController::countItems('ori') ?></strong>
		</div>
	</div>
</div>
<div class="row">
	<div class="pd-0 col-xs-4">
		<div class="mt_20 col-xs-12 col-sm-6">
			<div class="box_button text-center"><a class="button border-violet text-violet" href="<?php echo ADMIN_URL ?>cds" title="Listar cds"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span class="block">Cd</span></a></div>
		</div>
		<div class="mt_20 col-xs-12 col-sm-6">
			<div class="box_button text-center"><a class="button border-violet text-violet" href="<?php echo ADMIN_URL ?>cds/nuevo" title="Crear cd"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span><span class="block">Cd</span></a></div>
		</div>
	</div>
	<div class="pd-0 col-xs-4">
		<div class="mt_20 col-xs-12 col-sm-6">
			<div class="box_button text-center"><a class="button border-blue text-blue" href="<?php echo ADMIN_URL ?>mp3" title="Listar mp3"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span class="block">Mp3</span></a></div>
		</div>
		<div class="mt_20 col-xs-12 col-sm-6">
			<div class="box_button text-center"><a class="button border-blue text-blue" href="<?php echo ADMIN_URL ?>mp3/nuevo" title="Crear mp3"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span><span class="block">Mp3</span></a></div>
		</div>
	</div>
	<div class="pd-0 col-xs-4">
		<div class="mt_20 col-xs-12 col-sm-6">
			<div class="box_button text-center"><a class="button border-green text-green" href="<?php echo ADMIN_URL ?>original" title="Listar originales"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span class="block">Original</span></a></div>
		</div>
		<div class="mt_20 col-xs-12 col-sm-6">
			<div class="box_button text-center"><a class="button border-green text-green" href="<?php echo ADMIN_URL ?>original/nuevo" title="Crear original"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span><span class="block">Original</span></a></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-primary mt_40">
			<div class="panel-heading">
				<h4>Ultimos registros</h4>
			</div>
	        <div class="table-responsive">
	          <table class="table table-striped">
	            <thead>
	              <tr>
	                <th>Artista</th>
	                <th>Album</th>
	                <th>Año</th>
	                <th>Género</th>
	                <th>Front</th>
	                <th>Back</th>
	                <th>Cd mp3</th>
	                <th>Mp3</th>
	                <th>Original</th>
	                <th colspan="2"></th>
	              </tr>
	            </thead>
	            <tbody>
	                <?php
	                $_items = $this->lastItems(LAST_REG);
	                if($_items):
	                ?>
	                  <?php foreach ($_items as $item): ?>
	                    <tr>
	                      <td><?php echo $item->artista; ?></td>
	                      <td><?php echo $item->album; ?></td>
	                      <td><?php echo $item->fecha; ?></td>
	                      <td><?php echo $item->genero; ?></td>
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
	                      <td>
	                      	<?php
		                      if ($item->cdmp3_id && $item->cdmp3_id != '') {
		                        $cd = $this->getCds($item->cdmp3_id);
		                        echo $cd->nombre;
		                      }
		                      ?>
	                      </td>
	                      <td align="center"><?php echo ($item->mp3 == 1) ? 'Sí' : 'No';  ?></td>
	                      <td><?php echo ($item->original != 0) ? $item->original : 'No'; ?></td>
	                      <td><a href="<?php echo ADMIN_URL ?>mp3/editar/<?php echo $item->id; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;&nbsp;Editar</a></td>
	                      <td><a href="<?php echo ADMIN_URL ?>mp3/borrar/<?php echo $item->id; ?>" title="Eliminar: <?php echo $item->artista.' - '.$item->album ?>" class="btn btn-danger btn-sm delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
	                    </tr>
	                  <?php endforeach ?>
	               <?php else: ?>
	               	<tr>
	               		<td colspan="11">No se ha encotrado ningún registro.</td>
	               	</tr>
	              <?php endif ?>
	            </tbody>
	          </table>
	        </div>
        </div><!-- /.panel -->
    </div>
</div>
