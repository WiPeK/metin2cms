<div class="row edit_data no_space">
	<div class="col-lg-12">
		<h3>Wiadomość do wszystkich użytkowników</h3>
		<?php if(validation_errors()): ?>
			<div class="alert alert-warning" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
		<?php if(isset($message)): ?>
			<div class="alert" role="alert">
				<?php echo $message; ?>
			</div>
		<?php endif; ?>	
		<?php echo form_open(); ?>
		<div class="row">
			<div class="col-lg-12">
				<p class="input_label">Temat</p>
				<?php echo form_input('subject','','class="input_wp"'); ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-12">
				<p class="input_label">Treść</p>
				<?php echo form_textarea('message_body','','id="ckeditor"'); ?>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12">
				<?php echo form_submit('submit', 'Wyślij Email', 'class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>
