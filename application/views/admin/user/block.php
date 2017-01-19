<div class="row no_space">
	<div class="col-lg-12">
		<h3><?php echo 'Blokada konta: ' . $user[0]->login; ?></h3>
		<?php if(validation_errors()): ?>
			<div class="alert alert-warning" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
		<?php echo form_open(); ?>
			<div class="row no_space">
				<div class="col-lg-6">
					<p class="input_label">Powód</p>
					<?php echo form_input('reason',set_value('reason', $block_user),'class="input_wp"'); ?>
				<br>
				<br>
				<br>

					<br>
					*aby zablokować konto na pewien okres przejdź <?php echo anchor(site_url() . 'admin/user/edit/' . $user[0]->id, 'tutaj'); ?> pole "blokada do"
				</div>
			</div>
			<br>
			<div class="row no_space">
				<?php if($user[0]->status == 'OK'): ?>
				<div class="col-lg-3 no_space">
					<?php echo form_submit('submit', 'Zablokuj', 'class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
				</div>
			<?php endif; ?>
				<?php if($user[0]->status != 'OK'): ?>
					<div class="col-lg-3 no_space">
						<a href="<?php echo site_url() . 'admin/user/unblock/' . $user[0]->id; ?>">
							<button type="button" class="btn btn-default btn-lg btn-block no_border_radius">Odblokuj</button>
						</a>
					</div>
				<?php endif; ?>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>