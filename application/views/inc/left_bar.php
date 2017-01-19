<div class="row">
	<div class="col-lg-12 no_right">
		<div class="left_bar">
			<a href="<?php echo site_url(); ?>">
				<button type="button" class="btn btn-default btn-lg btn-block no_border_radius">Home</button>
			</a>
			<a href="<?php echo site_url('register'); ?>">
				<button type="button" class="btn btn-default btn-lg btn-block no_border_radius">Rejestracja</button>
			</a>
			<a href="<?php echo site_url('client_download'); ?>">
				<button type="button" class="btn btn-default btn-lg btn-block no_border_radius">Pobierz</button>
			</a>
			<?php if($this->user_m->loggedin() == TRUE): ?>
				<a href="<?php echo site_url('shop'); ?>">
					<button type="button" class="btn btn-default btn-lg btn-block no_border_radius">Sklep</button>
				</a>
				<?php if(isset($shop_category)): ?>
					<?php foreach($shop_category as $category): ?>
						<a href="<?php echo site_url() . 'shop/category/' . $category->id; ?>" class="center-block">
							<button type="button" class="btn btn-default btn-sm btn-block btn_categ no_border_radius">
								<?php echo $category->category; ?>
							</button>
						</a>
						<div class="clearfix"></div>
					<?php endforeach; ?>
				<?php endif; ?>
				<a href="<?php echo site_url('shop/vip_exp'); ?>">
					<button type="button" class="btn btn-default btn-lg btn-block no_border_radius">Pakiety VIP</button>
				</a>
				<a href="<?php echo site_url() . 'shop/vip_exp/'; ?>" class="center-block">
					<button type="button" class="btn btn-default btn-sm btn-block btn_categ no_border_radius">
						Zwiększony exp
					</button>
				</a>
				<div class="clearfix"></div>
				<a href="<?php echo site_url() . 'shop/vip_drop/'; ?>" class="center-block">
					<button type="button" class="btn btn-default btn-sm btn-block btn_categ no_border_radius">
						Zwiększony drop
					</button>
				</a>
				<div class="clearfix"></div>
				<a href="<?php echo site_url() . 'shop/vip_money/'; ?>" class="center-block">
					<button type="button" class="btn btn-default btn-sm btn-block btn_categ no_border_radius">
						Zwiększony drop złota
					</button>
				</a>
				<div class="clearfix"></div>
			<?php endif; ?>
			<?php if($this->user_m->loggedin() == TRUE && $this->session->userdata('mods') == 'admin'): ?>
				<a href="<?php echo site_url('admin/dashboard'); ?>">
					<button type="button" class="btn btn-default btn-lg btn-block no_border_radius">Panel administratora</button>
				</a>
			<?php endif; ?>
		</div>
		<div class="facebook_panel">
			<div class="fb-like-box" data-href="<?php echo $cmscfg->fb_link; ?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" data-width="260"></div>
		</div>
	</div>
</div>