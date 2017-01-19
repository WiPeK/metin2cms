<div class="row">
	<div class="col-lg-12">
		<h3><?php echo empty($vip_cat->id) ? 'Dodawanie vip' : 'Edycja vip ' . $vip_cat->category; ?></h3>
		<?php if(validation_errors()): ?>
			<div class="alert alert-warning" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>	
		<div class="row">
			<div class="col-lg-12">
				<?php echo form_open(); ?>
				<p class="input_label">Ilość dni</p>
				<?php echo form_input('days', set_value('days', $vip_cat->days), 'class="input_wp"'); ?>
				<div class="clearfix"></div>
				<p class="input_label">Koszt</p>
				<?php echo form_input('cash', set_value('cash', $vip_cat->cash), 'class="input_wp"'); ?>
				<div class="clearfix"></div>
				<p class="input_label">Kategoria</p>
				<?php echo form_dropdown('category',array('exp' => 'exp','drop' => 'drop','money' => 'money'),'class="input_wp"'); ?>
				<div class="clearfix"></div><br>
				<?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary no_border_radius"'); ?>
				<?php echo form_close(); ?>
			</div>	
		</div>
	</div>
</div>