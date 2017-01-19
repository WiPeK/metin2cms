<div class="row">
	<div class="col-lg-12">
		<h3 class="sms_add">Doładowanie konta o <?php echo $call_conf['sm_number'] . ' Monet'; ?></h3>
		<p>Zadzwoń na podany numer telefonu: <?php echo $call_conf['call_number']; ?></p>
		<p>i podaj kod: <?php echo $call_conf['call_code']; ?></p>
		<p>Koszt rozmowy to: <?php echo $call_conf['sm_cost']; ?></p>
		<div class="space100"></div>
		<?php echo form_open(site_url('shop/add_coins_sms')); ?>
		<?php echo form_input('code','','class="input_wp" placeholder="Wpisz kod"'); ?>
		<?php echo form_hidden('smnum', $call_conf['sm_number']); ?>
		<?php echo form_hidden('smscode', $call_conf['call_code']); ?>
		<?php echo form_submit('submit', 'Potwierdź','class="btn btn-primary btn-lg no_border_radius"'); ?>
		<?php echo form_close(); ?>
	</div>
</div>