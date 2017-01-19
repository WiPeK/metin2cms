<div class="row">
	<div class="col-lg-12">
		<div class="remind_bar">
			<div class="head_subview">
				<h3 class="text-center">Przypomnienie hasła</h3>
			</div>

			<div class="subview_body">
				<?php if(validation_errors()): ?>
				<div class="alert alert-danger no_border_radius">
					<?php echo validation_errors(); ?>
				</div>	
				<?php endif; ?>
				<?php echo form_open(); ?>
				<div class="form-group">
					<label for="forg_pass">Login</label>
					<?php echo form_input('loginf','','id="forg_pass" class="form-control no_border_radius" placeholder="Login"'); ?>
					<?php echo form_submit('submit', 'Przypomnij hasło', 'class="btn btn-default btn-register center-block no_border_radius"'); ?>
				</div>
				<?php echo form_close(); ?>
			</div>		
		</div>
	</div>
</div>