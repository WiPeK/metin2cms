<div class="row">
	<div class="col-lg-12">
		<div class="head_subview">
			<h3 class="text-center">Support</h3>
		</div>
		<div class="body_subview">
			<?php echo form_open(); ?>
			<table class="table">
				<tr>
					<td>Twój email:</td>
					<td>
						<?php echo form_input('email_support','','class="input_wp"'); ?>
						<?php if(form_error('email_support')) : ?>
							<div class="alert alert-warning" role="alert">
								<?php echo form_error('email_support'); ?>
							</div>
						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<td>Treść zgłoszenia:</td>
					<td>
						<?php echo form_textarea('support_body','','class="input_wp"'); ?>
						<?php if(form_error('support_body')) : ?>
							<div class="alert alert-warning" role="alert">
								<?php echo form_error('support_body'); ?>
							</div>
						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<td></td>
					<td>
						<?php echo form_submit('submit', 'Wyślij zgłoszenie', 'class="btn btn-primary no_border_radius"'); ?>
					</td>
				</tr>
			</table>

			<?php echo form_close(); ?>
		</div>
	</div>
</div>