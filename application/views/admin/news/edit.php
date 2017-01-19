<div class="row">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<h3><?php echo empty($article->id) ? 'Dodaj artykuł' : 'Edycja artykułu: ' . $article->title; ?></h3>
		</div>
	</div>
	<?php if(validation_errors()): ?>
		<div class="alert alert-warning" role="alert">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>
	<?php echo form_open(); ?>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-1">
			<p class="input_label"><b>Tytuł</b></p>
			<?php echo form_input('title', set_value('title', $article->title),'class="input_wp"'); ?>
		</div>
		<div class="col-lg-4">
			<p class="input_label"><b>Data publikacji</b></p>
			<?php echo form_input('pubdate', set_value('pubdate', $article->pubdate), 'class="datepicker no_border_radius"'); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<?php echo form_textarea('body', set_value('body', $article->body), 'id="ckeditor"'); ?>
		</div>
	</div>
	<br>	
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
		</div>
	</div>	
	<?php echo form_close();?>
</div>
<script>
	$(function() {
		$('.datepicker').datepicker({ format : 'yyyy-mm-dd' });
	});
</script>