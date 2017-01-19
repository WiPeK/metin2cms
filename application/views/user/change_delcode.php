<div class="row">
	<div class="col-lg-12">
		<div class="remind_bar">
			<div class="head_subview">
				<h3 class="text-center">Zmiana kodu usunięcia posatci</h3>
			</div>
			<div class="subview_body">
				<?php echo form_open('user/change_delcode'); ?>
				<table class="table">
					<tr>
						<td>Stary kod:</td>
						<td>
							<?php echo form_input('old_del_code'); ?>
							<?php if(form_error('old_del_code')) : ?>
								<div class="alert alert-warning" role="alert">
									<?php echo form_error('old_del_code'); ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<td>Nowy kod:</td>
						<td>
							<?php echo form_input('new_del_code'); ?>
							<?php if(form_error('new_del_code')) : ?>
								<div class="alert alert-warning" role="alert">
									<?php echo form_error('new_del_code'); ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<td>Powtórz nowy kod:</td>
						<td>
							<?php echo form_input('cnew_del_code'); ?>
							<?php if(form_error('cnew_del_code')) : ?>
								<div class="alert alert-warning" role="alert">
									<?php echo form_error('cnew_del_code'); ?>
								</div>
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<td></td>
						<td>
							<?php echo form_submit('submit', 'Zmień kod', 'class="btn btn-primary no_border_radius"'); ?>
						</td>
					</tr>
				</table>

				<?php echo form_close(); ?>	
			</div>
		</div>
	</div>
</div>