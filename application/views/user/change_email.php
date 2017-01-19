<div class="row">
	<div class="col-lg-12">
		<div class="remind_bar">
			<div class="head_subview">
				<h3 class="text-center">Zmiana email</h3>
			</div>
			<div class="body_subview">
				<?php echo form_open('user/change_email'); ?>
				<table class="table">
					<tr>
						<td>Stary email:</td>
						<td>
							<?php echo form_input('old_email'); ?>
							<?php if(form_error('old_email')) : ?>
								<div class="alert alert-warning" role="alert">
									<?php echo form_error('old_email'); ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<td>Nowy email:</td>
						<td>
							<?php echo form_input('new_email'); ?>
							<?php if(form_error('new_email')) : ?>
								<div class="alert alert-warning" role="alert">
									<?php echo form_error('new_email'); ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<td>Powtórz nowy email:</td>
						<td>
							<?php echo form_input('cnew_email'); ?>
							<?php if(form_error('cnew_email')) : ?>
								<div class="alert alert-warning" role="alert">
									<?php echo form_error('cnew_email'); ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<td></td>
						<td>
							<?php echo form_submit('submit', 'Zmień email', 'class="btn btn-primary no_border_radius"'); ?>
						</td>
					</tr>
				</table>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>