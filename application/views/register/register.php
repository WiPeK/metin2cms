<div class="head_subview">
	<h3 class="text-center">
		Rejestracja
	</h3>
</div>
<div class="modal-body">
	<?php echo form_open(); ?>
	<table class="table">
		<tr>
			<td>Login: (3-16 znaków)</td>
			<td>
				<?php echo form_input('loginr', $this->input->post('loginr')); ?>
				<?php if(form_error('loginr')) : ?>
					<div class="alert alert-warning" role="alert">
						<?php echo form_error('loginr'); ?>
					</div>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td>Hasło: (4-16 znaków)</td>
			<td>
				<?php echo form_password('passwordr'); ?>
				<?php if(form_error('passwordr')) : ?>
					<div class="alert alert-warning" role="alert">
						<?php echo form_error('passwordr'); ?>
					</div>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td>Powtórz hasło:</td>
			<td>
				<?php echo form_password('password_c'); ?>
				<?php if(form_error('password_c')) : ?>
					<div class="alert alert-warning" role="alert">
						<?php echo form_error('password_c'); ?>
					</div>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>
				<?php echo form_input('email', $this->input->post('email')); ?>
				<?php if(form_error('email')) : ?>
					<div class="alert alert-warning" role="alert">
						<?php echo form_error('email'); ?>
					</div>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td>Powtórz email:</td>
			<td>
				<?php echo form_input('email_c'); ?>
				<?php if(form_error('email_c')) : ?>
					<div class="alert alert-warning" role="alert">
						<?php echo form_error('email_c'); ?>
					</div>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td>Kod usunięcia:</td>
			<td>
				<?php echo form_input('del_code', $this->input->post('del_code')); ?>
				<?php if(form_error('del_code')) : ?>
					<div class="alert alert-warning" role="alert">
						<?php echo form_error('del_code'); ?>
					</div>
				<?php endif; ?>
			</td>
		</tr>
			<td>Captcha:</td>
			<td>
				<?php echo $image; ?> <br>
				<?php echo form_input('captcha','','class="input_cp"'); ?>
				<?php if(form_error('captcha')) : ?>
					<div class="alert alert-warning" role="alert">
						<?php echo form_error('captcha'); ?>
					</div>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo form_submit('submit', 'Rejestracja', 'class="btn btn-primary no_border_radius"'); ?>
			</td>
		</tr>
	</table>
	<?php echo form_close(); ?>
</div>		