<div class="row">
	<div class="col-lg-12">
		<div class="head_subview">
			<h3 class="text-center">Item Shop</h3>
		</div>
		<div class="body_subview">
			<div class="row">
				<div class="col-lg-8">
					<p>Zalogowano jako : <?php echo $this->session->userdata('login'); ?></p>
					<p>Stan Monet : <?php echo $user_data[0]->cash; ?></p>
				</div>
				<div class="col-lg-4">
					<a href="<?php echo site_url() . 'shop/add_methods/'; ?>">
						<button type="button" class="btn btn-primary btn-lg btn-block no_border_radius">
							Doładuj konto
						</button>
					</a>
				</div>
			</div>
			<div class="space100"></div>
			<div class="row no_space">
				<div class="col-lg-12 no_space">
					<?php $this->load->view($sub_view); ?>
				</div>
			</div>
			<div class="space100"></div>
		</div>
	</div>
</div>


