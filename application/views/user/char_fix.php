<div class="row">
	<div class="col-lg-12">
	<div class="space100"></div>
		<?php echo form_open(site_url('user/charfix')); ?>
		<p class="input_label">Wybierz postać do odbugowania</p>
		<?php echo form_dropdown('charF', $chars_to_fix, 'class="input_wp"'); ?>
		<?php echo form_submit('submit', 'Odbuguj','class="btn btn-primary no_border_radius"'); ?>
		<?php echo form_close(); ?>
		<div class="space100"></div>
	</div>
</div>