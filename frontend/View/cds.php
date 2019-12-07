<h1 class="page-header">Cds de Mp3</h1>

<div class="row items-wrapper cds-grid">
  <?php $cds_collection = $this->getAllCds(); ?>
  <?php if($cds_collection): ?>
    <?php foreach ($cds_collection as $_cd): ?>
      <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3 col-xxl-2">
        <div class="item clearfix">
          <div class="col-xs-8 col-sm-9 col-lg-10">
            <h3 class="name"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span>&nbsp;<?php echo $_cd->nombre ?></h3>
          </div>
          <div class="col-xs-4 col-sm-3 col-lg-2">
            <div class="cdqty">
              <span class="label label-danger"><?php echo $_cd->qty ?></span>
            </div>
          </div>
          <div class="col-xs-12 show-list">
              <a href="<?php echo URL_BASE ?>cds/listar/<?php echo $_cd->id ?>" title="Ver albunes en este cd" id="cd-list">Ver Mp3</a>
            </div>
        </div>
      </div>
    <?php endforeach ?>
  <?php endif; // fin cds_collection ?>
</div>
<?php $this->getPager(); ?>
