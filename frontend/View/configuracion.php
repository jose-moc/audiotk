<h1 class="page-header">Configuración</h1>
<?php echo MessagesController::getMessage() ?>
<div class="col-md-8 col-lg-6">
	<form class="form-horizontal" action="<?php echo ADMIN_URL ?>config/actualizar" method="post" onsubmit="return validateConfig()">
		<div class="form-group">
		    <label for="app_name" class="col-sm-4 control-label">Nombre app</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="app_name" name="app_name[<?php echo $this->conf->getAppName()->id ?>]" value="<?php echo $this->conf->getAppName()->valor ?>">
		    </div>
		</div>
	    <div class="form-group">
		    <label for="url_base" class="col-sm-4 control-label">URL Base</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="url_base" name="url_base[<?php echo $this->conf->getUrlBase()->id ?>]" value="<?php echo $this->conf->getUrlBase()->valor ?>">
		    </div>
	    </div>
	    <div class="form-group">
		    <label for="reg_page" class="col-sm-4 control-label">Items por página</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="reg_page" name="reg_page[<?php echo $this->conf->getRegPerPage()->id ?>]" value="<?php echo $this->conf->getRegPerPage()->valor ?>">
		    </div>
	    </div>
	    <div class="form-group">
		    <label for="last_reg" class="col-sm-4 control-label">Mostrar últimos</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="last_reg" name="last_reg[<?php echo $this->conf->getLastReg()->id ?>]" value="<?php echo $this->conf->getLastReg()->valor ?>">
		    </div>
	    </div>
	    <div class="form-group">
		    <label for="genders" class="col-sm-4 control-label">Géneros musicales</label>
		    <div class="col-sm-8">
		      <select id="genero" class="form-control" name="del_gen[<?php echo $this->conf->getGenders()->id ?>][]" multiple>
		      	<?php
		      	$_generos = explode(',', $this->conf->getGenders()->valor);
		      	sort($_generos,SORT_STRING);
		      	?>
		      	<?php foreach($_generos as $_gen): ?>
                	<option><?php echo $_gen; ?></option>
            	<?php endforeach; ?>
              </select>
              <small>Seleccione géneros para eliminarlos.</small>
		    </div>
	    </div>
		<div class="form-group">
		    <label for="add_gen" class="col-sm-4 control-label">Añadir géneros</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="add_gen" name="add_gen[<?php echo $this->conf->getGenders()->id ?>]" placeholder="Añadir géneros separados por coma.">
		    </div>
	    </div>
	    <div class="form-group">
		    <div class="col-sm-offset-4 col-sm-8">
		      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;&nbsp;Guardar</button>
		    </div>
	    </div>
	</form>
</div>
