<div class="row">
	<div class="col-lg-12">
		<h3 class="sms_add">Doładowanie konta o <?php echo $sms_conf['sm_number'] . ' Monet'; ?></h3>
		<p>Wyślij sms o treści: <?php echo $sms_conf['sms_code']; ?></p>
		<p>Na numer: <?php echo $sms_conf['sms_number']; ?></p>
		<p>Koszt sms to: <?php echo $sms_conf['sm_cost']; ?></p>
		<div class="space100"></div>
		<?php echo form_open(site_url('shop/add_coins_sms')); ?>
		<?php echo form_input('code','','class="input_wp" placeholder="Wpisz kod"'); ?>
		<?php echo form_hidden('smnum', $sms_conf['sm_number']); ?>
		<?php echo form_hidden('pack', $sms_conf['pack']); ?>
		<?php echo form_submit('submit', 'Potwierdź','class="btn btn-primary btn-lg no_border_radius"'); ?>
		<?php echo form_close(); ?>
	</div>
</div>