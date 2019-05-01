<h1 class="page-header">Cds de Mp3</h1>
<?php echo MessagesController::getMessage() ?>

<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width="220">Nombre</th>
        <th width="60">Qty</th>
        <th>Albums</th>
      </tr>
    </thead>
    <tbody>
      <?php $cds_collection = $this->getAllCds(); ?>
      <?php if($cds_collection): ?>
        <?php foreach ($cds_collection as $_cd): ?>
          <tr>
            <td>
              <h4 title="id=<?php echo $_cd->id ?>"><?php echo $_cd->nombre ?></h4>
              <div>
                <a href="<?php echo ADMIN_URL ?>cds/editar/<?php echo $_cd->id; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;Editar</a>&nbsp;&nbsp;
                <a href="<?php echo ADMIN_URL ?>cds/borrar/<?php echo $_cd->id; ?>" title="Eliminar: <?php echo $_cd->nombre ?>" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
              </div>
            </td>
            <td><?php echo $_cd->qty ?></td>
            <td>
              <?php
              // creamos un nuevo objeto mp3 para cada cd
              $this->setMp3();
              $_albums = $this->mp3->getChild($_cd->id);
              ?>
              <?php if($_albums): ?>
                <button class="show-list btn btn-default">Ver lista &nbsp;<span class="glyphicon glyphicon-menu-down"></span></button>
                <div class="list" style="display:none;">
                	<table class="table table-striped">
                		<thead>
			                <tr>
        								<th>Interprete</th>
        								<th>Album</th>
        								<th>Año</th>
                        <th>Género</th>
        								<th>Front</th>
        								<th>Back</th>
                        <th colspan="2"></th>
			                </tr>
			              </thead>
			              <tbody>
                      <?php foreach ($_albums as $item): ?>
  			                <tr>
    			                <td><?php echo $item->artista ?></td>
                          <td><?php echo $item->album ?></td>
                          <td><?php echo $item->fecha ?></td>
                          <td><?php echo $item->genero ?></td>
                          <td>
                            <?php if($item->img_front != ''): ?>
                              <div class="cover_xs">
                                <a href="<?php echo MEDIA_COVERS.$item->img_front ?>" data-fancybox>
                                  <img class="img-responsive" src="<?php echo MEDIA_COVERS.$item->img_front ?>" alt="<?php echo $item->album ?> front">
                                </a>
                              </div>
                            <?php endif ?>
                          </td>
                          <td>
                            <?php if($item->img_back != ''): ?>
                              <div class="cover_xs">
                                <a href="<?php echo MEDIA_COVERS.$item->img_back ?>" data-fancybox>
                                  <img class="img-responsive" src="<?php echo MEDIA_COVERS.$item->img_back ?>" alt="<?php echo $item->album ?> back">
                                </a>
                              </div>
                            <?php endif ?>
                          </td>
                          <td><a href="<?php echo ADMIN_URL ?>mp3/editar/<?php echo $item->id; ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                          <td><a href="<?php echo ADMIN_URL ?>mp3/borrar/<?php echo $item->id; ?>" title="Eliminar: <?php echo $item->artista.' - '.$item->album ?>" class="btn btn-danger btn-xs delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
  			                </tr>
                      <?php endforeach ?>
                      <tr>
                        <td colspan="7"><a href="<?php echo ADMIN_URL ?>mp3/nuevo/<?php echo $_cd->id; ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;&nbsp;Nuevo mp3</a></td>
                      </tr>
			              </tbody>
                  </table>
                </div>
              <?php else: ?>
                <a href="<?php echo ADMIN_URL ?>mp3/nuevo/<?php echo $_cd->id; ?>" class="btn btn-success" style="margin-left:8px;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;&nbsp;Nuevo mp3</a>
              <?php endif; // fin albums ?>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif; // fin cds_collection ?>
    </tbody>
  </table>
</div>
<?php $this->getPager(); ?>
