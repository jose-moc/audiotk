<h1 class="page-header">Albums Originales</h1>
<?php echo MessagesController::getMessage() ?>

<div class="table-responsive">
	<table id="table-list" class="table table-striped">
		<thead>
        <tr>
					<th>Interprete &nbsp;<span id="artista" class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true" onclick="sortBy(this);"></span></th>
					<th>Album &nbsp;<span id="album" class="glyphicon glyphicon-sort" aria-hidden="true" onclick="sortBy(this);"></span></th>
					<th>Año &nbsp;<span id="fecha" class="glyphicon glyphicon-sort" aria-hidden="true" onclick="sortBy(this);"></span></th>
          <th>Género</th>
					<th>Front</th>
					<th>Back</th>
          <th>Mp3</th>
          <th>Soporte</th>
          <th colspan="2"></th>
        </tr>
      </thead>
      <tbody>
        <?php $albums_collection = $this->getAllOri(); ?>
        <?php if($albums_collection): ?>
        	<?php foreach ($albums_collection as $item): ?>
            <tr>
            	  <td><?php echo $item->artista ?></td>
                <td><?php echo $item->album ?></td>
                <td><?php echo $item->fecha ?></td>
                <td><?php echo $item->genero ?></td>
                <td>
                  <?php if($item->img_front != ''): ?>
                    <div class="cover_xs">
                      <a href="<?php echo $item->img_front ?>" data-fancybox>
                        <img class="img-responsive" src="<?php echo $item->img_front ?>" alt="front">
                      </a>
                    </div>
                  <?php endif ?>
                </td>
                <td>
                  <?php if($item->img_back != ''): ?>
                    <div class="cover_xs">
                      <a href="<?php echo $item->img_back ?>" data-fancybox>
                        <img class="img-responsive" src="<?php echo $item->img_back ?>" alt="back">
                      </a>
                    </div>
                  <?php endif ?>
                </td>
                <td><?php echo ($item->mp3 == 1) ? 'Sí' : 'No'; ?></td>
                <td><?php echo $item->original ?></td>
                <td><a href="<?php echo ADMIN_URL ?>original/editar/<?php echo $item->id; ?>" title="Editar: <?php echo $item->artista.' - '.$item->album ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                <td><a href="<?php echo ADMIN_URL ?>original/borrar/<?php echo $item->id; ?>" title="Borrar: <?php echo $item->artista.' - '.$item->album ?>" class="btn btn-danger btn-sm delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
    </table>
</div>

<?php $this->getPager(); ?>

<script type="text/javascript">
$(document).ready(function(){
  var sort_mp3 = getCookie('sort_ori');
  var cdir = getCookie("ori_ordir");

  if(sort_mp3 != null){
    jq("#artista").removeClass('glyphicon-sort-by-alphabet glyphicon-sort-by-alphabet-alt');
    jq("#artista").addClass('glyphicon-sort');

    if(cdir == "ASC"){
      jq("#"+sort_mp3).addClass('glyphicon-sort-by-alphabet');
    }else {
      jq("#"+sort_mp3).addClass('glyphicon-sort-by-alphabet-alt');
    }
  }
});

function sortBy(elem){
var ADMIN_URL = "<?php echo ADMIN_URL ?>";
var cdir = getCookie("ori_ordir");
var id = elem.id;  //recoge el id del elemento html
var p = <?php echo $this->getPage() ?>;

changeSortIco(elem,cdir);

sortList(ADMIN_URL,'original',id,p);
}
</script>
