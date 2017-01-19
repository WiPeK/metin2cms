<div class="container-fluid">
	<div class="row no_space strap_top">
		<!-- row at top -->
		<div class="col-lg-2 no_space">
			<a class="logo_top" href="<?php echo site_url(); ?>">
				<p><?php echo $site_name; ?></p>
			</a>
		</div>
		<div class="col-lg-3">
			<p class="players_online">Aktualnie online: <?php echo $players_online; ?></p>
		</div>
		<div class="col-lg-5 no_space">
			<ul class="buttons_top">
				<li>
					<a href="<?php echo site_url('admin/dashboard'); ?>">
						<button type="button" class="btn no_border_radius" data-toggle="tooltip" data-placement="bottom" title="Panel strona główna">
							<i class="glyphicon glyphicon-th-large"></i>
						</button>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/news/edit'); ?>">
						<button type="button" class="btn no_border_radius" data-toggle="tooltip" data-placement="bottom" title="Dodaj news">
							<i class="glyphicon glyphicon-list-alt"></i>
						</button>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/user/edit'); ?>">
						<button type="button" class="btn no_border_radius" data-toggle="tooltip" data-placement="bottom" title="Dodaj użytkownika">
							<i class="glyphicon glyphicon-user"></i>
						</button>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/item_shop/add_item'); ?>">
						<button type="button" class="btn no_border_radius" data-toggle="tooltip" data-placement="bottom" title="Dodaj przedmiot do sklepu">
							<i class="glyphicon glyphicon-gift"></i>
						</button>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/gallery'); ?>">
						<button type="button" class="btn no_border_radius" data-toggle="tooltip" data-placement="bottom" title="Galeria">
							<i class="glyphicon glyphicon-picture"></i>
						</button>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/manage_files'); ?>">
						<button type="button" class="btn no_border_radius" data-toggle="tooltip" data-placement="bottom" title="Pliki">
							<i class="glyphicon glyphicon-file"></i>
						</button>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/global_message'); ?>">
						<button type="button" class="btn no_border_radius" data-toggle="tooltip" data-placement="bottom" title="Wiadomość globalna">
							<i class="glyphicon glyphicon-envelope"></i>
						</button>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/settings'); ?>">
						<button type="button" class="btn no_border_radius" data-toggle="tooltip" data-placement="bottom" title="Ustawienia">
							<i class="glyphicon glyphicon-cog"></i>
						</button>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/support'); ?>">
						<button type="button" class="btn no_border_radius" data-toggle="tooltip" data-placement="bottom" title="Support">
							<i class="glyphicon glyphicon-comment"></i>
						</button>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/logs'); ?>">
						<button type="button" class="btn no_border_radius" data-toggle="tooltip" data-placement="bottom" title="Logi">
							<i class="glyphicon glyphicon-align-justify"></i>
						</button>
					</a>
				</li>
			</ul>
		</div>
		<div class="col-lg-2 no_space">
			<div class="btn-group logged_as">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    Zalogowano jako: <?php echo $this->session->userdata('login'); ?> <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" role="menu">
			    <li><a href="<?php echo site_url() . 'admin/user/edit/' . $user_data[0]->id; ?>">Edytuj profil</a></li>
			    <li class="divider"></li>
			    <li><a href="<?php echo site_url('user/logout'); ?>">Wyloguj się</a></li>
			  </ul>
			</div>
		</div>
	</div>
	<div class="row no_space">
		<!-- navbar -->
		<div class="col-lg-1 no_space col_navbar">
			<?php $this->load->view($navbar_admin); ?>
		</div>
		<div class="col-lg-11">
			<?php $this->load->view($subview); ?>
			<?php $this->load->view('admin/include/footer_s'); ?>
		</div>
	</div>
</div>