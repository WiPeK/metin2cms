<div class="row">
	<div class="col-lg-12">
		<h3><?php echo $bonus_data->name; ?></h3>
		<?php if(validation_errors()): ?>
			<div class="alert alert-warning" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
		<?php echo form_open(); ?>
		<div class="bonus_bar">
			<label for="bonus_prob">Szansa na wejście bonusu</label>
			<?php echo form_input('bonus_prob', set_value('bonus_prob',$bonus_data->prob), 'class="input_wp"'); ?>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="bonus_bar">
					<label for="bonus_lv1">Wartość 1</label>
					<?php echo form_input('bonus_lv1', set_value('bonus_lv1',$bonus_data->lv1), 'class="input_wp bonus_val"'); ?>
					<br>
					<label for="bonus_lv2">Wartość 2</label>
					<?php echo form_input('bonus_lv2', set_value('bonus_lv2',$bonus_data->lv2), 'class="input_wp bonus_val"'); ?>
					<br>
					<label for="bonus_lv3">Wartość 3</label>
					<?php echo form_input('bonus_lv3', set_value('bonus_lv3',$bonus_data->lv3), 'class="input_wp bonus_val"'); ?>
					<br>
					<label for="bonus_lv4">Wartość 4</label>
					<?php echo form_input('bonus_lv4', set_value('bonus_lv4',$bonus_data->lv4), 'class="input_wp bonus_val"'); ?>
					<br>
					<label for="bonus_lv5">Wartość 5</label>
					<?php echo form_input('bonus_lv5', set_value('bonus_lv5',$bonus_data->lv5), 'class="input_wp bonus_val"'); ?>
				</div>
			</div>
			<div class="col-lg-6">
				<h4>Przedmioty w które można włożyć ten bonus</h4>
				<div class="bonus_bar">
					<label for="bonus_weapon">Broń</label>
					<?php
						if($bonus_data->weapon > 0)
						{
							$b_weap = true;
						}
						else
						{
							$b_weap = false;
						}
						$js = 'onclick="$(this).val(this.checked ? 1 : 0)"';
					?>
					<?php echo form_checkbox('bonus_weapon', $bonus_data->weapon, $b_weap, $js); ?>
				</div>
				<div class="bonus_bar">
					<label for="bonus_body">Zbroja</label>
					<?php
						if($bonus_data->body > 0)
						{
							$b_body = true;
						}
						else
						{
							$b_body = false;
						}
					?>
					<?php echo form_checkbox('bonus_body', $bonus_data->body, $b_body, $js); ?>
				</div>
				<div class="bonus_bar">
					<label for="bonus_wrist">Branzoleta</label>
					<?php
						if($bonus_data->wrist > 0)
						{
							$b_wrist = true;
						}
						else
						{
							$b_wrist = false;
						}
					?>
					<?php echo form_checkbox('bonus_wrist', $bonus_data->wrist, $b_wrist, $js); ?>
				</div>
				<div class="bonus_bar">
					<label for="bonus_foots">Buty</label>
					<?php
						if($bonus_data->foots > 0)
						{
							$b_foots = true;
						}
						else
						{
							$b_foots = false;
						}
					?>
					<?php echo form_checkbox('bonus_foots', $bonus_data->foots, $b_foots, $js); ?>
				</div>
				<div class="bonus_bar">
					<label for="bonus_neck">Naszyjnik</label>
					<?php
						if($bonus_data->neck > 0)
						{
							$b_neck = true;
						}
						else
						{
							$b_neck = false;
						}
					?>
					<?php echo form_checkbox('bonus_neck', $bonus_data->neck, $b_neck, $js); ?>
				</div>
				<div class="bonus_bar">
					<label for="bonus_head">Hełm</label>
					<?php
						if($bonus_data->head > 0)
						{
							$b_head = true;
						}
						else
						{
							$b_head = false;
						}
					?>
					<?php echo form_checkbox('bonus_head', $bonus_data->head, $b_head, $js); ?>
				</div>
				<div class="bonus_bar">
					<label for="bonus_shield">Tarcza</label>
					<?php
						if($bonus_data->shield > 0)
						{
							$b_shield = true;
						}
						else
						{
							$b_shield = false;
						}
					?>
					<?php echo form_checkbox('bonus_shield', $bonus_data->shield, $b_shield, $js); ?>
				</div>
				<div class="bonus_bar">
					<label for="bonus_ear">Kolczyki</label>
					<?php
						if($bonus_data->ear > 0)
						{
							$b_ear = true;
						}
						else
						{
							$b_ear = false;
						}
					?>
					<?php echo form_checkbox('bonus_ear', $bonus_data->ear, $b_ear, $js); ?>
				</div>
			</div>
		</div>
		<?php echo form_submit('submit', 'Zapisz','class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
		<?php echo form_close(); ?>
	</div>
</div>