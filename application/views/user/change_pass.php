<div class="row">
	<div class="col-lg-12">
		<div class="remind_bar">
			<div class="head_subview">
				<h3 class="text-center">Zmiana hasła</h3>
			</div>
			<div class="subview_body">
				<?php echo form_open('user/change_password'); ?>
				<table class="table">
					<tr>
						<td>Stare hasło:</td>
						<td>
							<?php echo form_password('old_password'); ?>
							<?php if(form_error('old_password')) : ?>
								<div class="alert alert-warning" role="alert">
									<?php echo form_error('old_password'); ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<td>Nowe hasło:</td>
						<td>
							<?php echo form_password('new_password'); ?>
							<?php if(form_error('new_password')) : ?>
								<div class="alert alert-warning" role="alert">
									<?php echo form_error('new_password'); ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<td>Powtórz nowe hasło:</td>
						<td>
							<?php echo form_password('cnew_password'); ?>
							<?php if(form_error('cnew_password')) : ?>
								<div class="alert alert-warning" role="alert">
									<?php echo form_error('cnew_password'); ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<td></td>
						<td>
							<?php echo form_submit('submit', 'Zmień hasło', 'class="btn btn-primary no_border_radius"'); ?>
						</td>
					</tr>
				</table>

				<?php echo form_close(); ?>	
			</div>
		</div>
	</div>
</div>