<div class="row">
	<div class="jumbotron">
	  <div class="container">
	    <h1>Biblioteca de audio para tus discos</h1>
	    <h2>LP, CD, Casete o MP3</h2>
	  </div>
	</div>
</div>
<div class="row">
	<h3 class="page-header">Géneros musicales</h3>
	<?php
	$_conf = new AppConfig();
	$_generos = explode(',', $_conf->getGenders()->valor);
	sort($_generos,SORT_STRING);
	?>

	<div class="gen-slider">
		<?php foreach($_generos as $_gen): ?>
		  	<div class="gen-box"><span><?php echo $_gen; ?></span></div>
		<?php endforeach; ?>
	</div>
</div>
<div id="recent" class="row">
	<h3 class="page-header">Añadidos recientemente</h3>

	<?php $_collection = $this->lastItems(LAST_REG); ?>
	<?php if($_collection): ?>
		 <div class="recent-slider">
	  		<?php foreach ($_collection as $item): ?>
	  			<div class="recent-item">
					<table class="table table-bordered">
		                <tbody>
			              	<tr>
			              		<td rowspan="6" width="90px">
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
			              		</td>
			              		<td><?php echo $item->artista ?></td>
			              	</tr>
			                <tr class="album-row">
			                  <td><?php echo $item->album ?></td>
			                </tr>
		                </tbody>
		            </table>
		        </div>
		    <?php endforeach; ?>
		</div><!-- /.slider -->
	<?php endif; ?>

</div>
