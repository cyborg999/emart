<?php if(count($err)): ?>
	<br>
	<?php foreach($err as $idx => $error): ?>
		<div class="alert alert-danger" role="alert">
			<?= $error ?>
		</div>
	<?php endforeach ?>
<?php elseif($model->showSuccessMessage() != ""): ?>
	<br>
	<div class="alert alert-success" role="alert">
		<?= $model->showSuccessMessage(); ?>
	</div>
<?php endif ?>