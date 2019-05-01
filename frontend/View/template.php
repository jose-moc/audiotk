<?php if (Session::get('user')): ?>
<?php include 'View/inc/header.php'; ?>
<div class="container-fluid">
	<div class="row">
		<div id="left_sidebar" class="col-sm-3 col-md-2 hidden-xs sidebar">
			<?php include "View/inc/left_sidebar.php" ?>
		</div>
		<div class="col-sm-9 col-md-10 main">

			<?php ViewController::loadView(); ?>

		</div> <!-- /.main -->
    </div>
</div>
<?php include 'View/inc/footer.php'; ?>
<?php else: ?>
		<?php ViewController::loadView(); ?>
<?php endif; ?>
