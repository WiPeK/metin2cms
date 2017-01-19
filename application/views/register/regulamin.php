<div class="row">
	<div class="col-lg-12">
		<div class="reg_bar">
			<?php echo $cmscfg->regulamin; ?>
			<div class="clearfix"></div>
			<?php if($this->user_m->loggedin() == FALSE): ?>
				<a href="<?php echo site_url('register/account'); ?>">
					<button type="button" class="btn btn-primary btn-lg btn-block no_border_radius">Potwierdzam regulamin</button>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>