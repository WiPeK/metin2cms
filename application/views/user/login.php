<div class="login_inputs"> 
		<?php echo form_open('user/login'); ?>
			<div class="form-group">
				<label for="Input_email_login">Login</label>
				<?php echo form_input('login', $this->input->post('login'),'id="Input_email_login" class="form-control no_border_radius" placeholder="Login"'); ?>
				<?php if(form_error('login')) : ?>
					<div class="alert alert-warning" role="alert">
						<?php echo form_error('login'); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="form-group">
				<label for="Password_login">Hasło</label>
				<?php echo form_password('password','','id="Password_login" class="form-control no_border_radius" placeholder="Hasło"'); ?>
				<?php if(form_error('password')) : ?>
					<div class="alert alert-warning" role="alert">
						<?php echo form_error('password'); ?>
					</div>
				<?php endif; ?>
				<a class="text-center" href="<?php echo site_url('user/forgotten_password'); ?>"><p>Zapomniane hasło?</p></a>
			</div>
			<?php echo form_submit('submit', 'Logowanie', 'class="btn btn-default btn-register center-block no_border_radius"'); ?>
		<?php echo form_close(); ?>
	</div>