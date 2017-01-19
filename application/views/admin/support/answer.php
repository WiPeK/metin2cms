<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12">
				<p class="input_label">Od:</p>
				<?php echo $support->email; ?>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="col-lg-12">
				<p class="input_label">Treść:</p>
				<?php echo $support->body; ?>
			</div>
		</div>
		<br><br>
		<?php if(validation_errors()): ?>
			<div class="alert alert-warning" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
		<?php echo form_open(); ?>
		<div class="row">
			<div class="col-lg-12">
				<p class="input_label">Treść odpowiedzi:</p>
			</div>
			<div class="col-lg-12">
				<?php echo form_textarea('answer_body','','id="ckeditor"'); ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-12">
				<?php echo form_submit('submit', 'Wyślij odpowiedź', 'class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
			</div>
		</div>
		<?php echo form_close(); ?>
		<div class="bottom_space"></div>
	</div>
</div>