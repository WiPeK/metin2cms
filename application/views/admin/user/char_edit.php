<div class="row no_space">
	<div class="col-lg-12">
		<h3><?php echo 'Edycja postaci: ' . $char[0]->name; ?></h3>
		<?php if(validation_errors()): ?>
			<div class="alert alert-warning" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
		<?php echo form_open(); ?>
			<div class="row no_space">
				<div class="col-lg-4">
					<p class="input_label">Nick</p>
					<?php echo form_input('name', set_value('name', $char[0]->name),'class="input_wp"'); ?>
				</div>
				<div class="col-lg-4">
					<p class="input_label">Poziom</p>
					<?php echo form_input('level', set_value('level', $char[0]->level),'class="input_wp"'); ?>
				</div>
				<div class="col-lg-4">
					<p class="input_label">Exp</p>
					<?php echo form_input('exp', set_value('exp', $char[0]->exp),'class="input_wp"'); ?>
				</div>
			</div>
			<br>
			<div class="row no_space">
				<div class="col-lg-4">
					<p class="input_label">Złoto</p>
					<?php echo form_input('gold', set_value('gold', $char[0]->gold),'class="input_wp"'); ?>
				</div>
				<div class="col-lg-4">
					<p class="input_label">Ranga</p>
					<?php echo form_input('alignment', set_value('alignment', $char[0]->alignment),'class="input_wp"'); ?>
				</div>
				<div class="col-lg-4">
					<p class="input_label">Poziom konia</p>
					<?php echo form_input('horse_level', set_value('horse_level', $char[0]->horse_level),'class="input_wp"'); ?>
				</div>
			</div>
			<br>
			<div class="row no_space">
				<div class="col-lg-12">
					<p>* zmiany zostaną zapisane gdy postać będzie wylogowana przez około 15 minut w przeciwnym wypadku coś może pójść nie tak</p>
					<?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>