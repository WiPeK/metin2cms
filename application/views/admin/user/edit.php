<div class="row no_space">
	<div class="col-lg-9">
		<h3><?php echo empty($user->id) ? 'Dodaj konto' : 'Edycja konta: ' . $user->login; ?></h3>
		<?php echo form_open(); ?>
			<div class="row no_space">
				<div class="col-lg-6">
					<p class="input_label">Login</p>
					<?php echo form_input('login', set_value('login', $user[0]->login),'class="input_wp"'); ?>
				</div>
				<div class="col-lg-6">
					<p class="input_label">Hasło</p>
					<?php echo form_password('password','','class="input_wp"'); ?>
				</div>
			</div>
			<br>
			<div class="row no_space">
				<div class="col-lg-6">
					<p class="input_label">Kod usunięcia</p>
					<?php echo form_input('social_id', set_value('social_id', $user[0]->social_id),'class="input_wp"'); ?>
				</div>
				<div class="col-lg-6">
					<p class="input_label">Email</p>
					<?php echo form_input('email', set_value('email', $user[0]->email),'class="input_wp"'); ?>
				</div>
			</div>
			<br>
			<div class="row no_space">
				<div class="col-lg-6">
					<p class="input_label">Status</p>
					<?php echo form_input('status', set_value('status', $user[0]->status),'class="input_wp"'); ?>
				</div>
				<div class="col-lg-6">
					<p class="input_label">Blokada do:</p>
					<?php echo form_input('availDt', set_value('availDt', $user[0]->availDt),'class="datepicker"'); ?>
				</div>
			</div>
			<br>
			<div class="row no_space">
				<div class="col-lg-6">
					<p class="input_label">Smocze monety</p>
					<?php echo form_input('cash', set_value('cash', $user[0]->cash),'class="input_wp"'); ?>
				</div>
				<div class="col-lg-6">
					<p class="input_label">Zwiększony drop:</p>
					<?php echo form_input('gold_expire', set_value('gold_expire', $user[0]->gold_expire),'class="datepicker"'); ?>
				</div>
			</div>
			<br>
			<div class="row no_space">
				<div class="col-lg-6">
					<p class="input_label">Zwiększony exp</p>
					<?php echo form_input('silver_expire', set_value('silver_expire', $user[0]->silver_expire),'class="datepicker"'); ?>
				</div>
				<div class="col-lg-6">
					<p class="input_label">Zwiększony drop yang:</p>
					<?php echo form_input('money_drop_rate_expire', set_value('money_drop_rate_expire', $user[0]->money_drop_rate_expire),'class="datepicker"'); ?>
				</div>
			</div>
			<br>
			<div class="row no_space">
				<div class="col-lg-9">
					<?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>
	<div class="col-lg-3">
		<div class="user_chars_right">
			<h3>Postacie</h3>
			<?php if(isset($user_chars) && !empty($user_chars)): ?>
				<?php foreach($user_chars as $uschar): ?>
					<a href="<?php echo site_url() . 'admin/user/char_edit/' . $uschar->id; ?>">
						<button type="button" class="btn btn-default btn-lg btn-block no_border_radius"><?php echo $uschar->name; ?></button>
					</a>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="alert alert-warning no_border_radius" role="alert">Na tym koncie nie ma żadnej postaci.</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<script>
$(function() {
	$('.datepicker').datepicker({ format : 'yyyy-mm-dd' });
});
</script>