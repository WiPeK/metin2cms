<div class="row">
	<div class="col-lg-12 no_left">
		<?php if($this->user_m->loggedin() == FALSE): ?>
			<div class="login_bar">
				<div class="head_login text-center">
					Logowanie
				</div>
				<div class="login_body">
					<?php echo form_open('user/login'); ?>
						<div class="form-group text-center"><br>
							<label for="Input_email_login">Wpisz login i hasło</label>
							<?php echo form_input('login', $this->input->post('login'),'id="Input_email_login" class="form-control no_border_radius" placeholder="Login"'); ?>
							<?php echo form_password('password','','id="Password_login" class="form-control no_border_radius" placeholder="Hasło"'); ?>
							<a class="text-center" href="<?php echo site_url('user/forgotten_password'); ?>"><p>Zapomniane hasło?</p></a>
						</div>
						<?php echo form_submit('submit', 'Logowanie', 'class="btn btn-default btn-register center-block no_border_radius"'); ?>
					<?php echo form_close(); ?>
				</div>
			</div>
		<?php elseif($this->user_m->loggedin() == TRUE): ?>
			<div class="login_bar">
				<div class="head_login text-center">
					<?php echo $this->session->userdata('login'); ?>
				</div>
				<div class="login_body">
					<br>
					<a href="<?php echo site_url() . 'user/profile/' . $user_data[0]->id; ?>" class="change_data">Profil</a>
					<div class="clearfix"></div>
					<div class="cash_data">
						Ilość sm: <?php echo $user_data[0]->cash; ?>
						<a href="<?php echo site_url('shop/add_methods'); ?>" class="change_data">Doładuj</a>
					</div>
					<div class="clearfix"></div>
					<a href="<?php echo site_url() . 'user/change_password'; ?>" class="change_data">Zmień hasło</a>
					<div class="clearfix"></div>
					<a href="<?php echo site_url() . 'user/change_email'; ?>" class="change_data">Zmień email</a>
					<div class="clearfix"></div>
					<a href="<?php echo site_url() . 'user/change_delcode'; ?>" class="change_data">Zmień kod usunięcia postaci</a>
					<div class="clearfix"></div>
					<a href="<?php echo site_url() . 'user/char_fix'; ?>" class="change_data">Odbuguj postać</a>
					<div class="clearfix"></div>
					<a href="<?php echo site_url() . 'user/logout'; ?>" class="change_data">Wyloguj</a>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php endif; ?>

		<div class="char_ranking_bar">
			<div class="head_rank text-center">
				Top 10 postaci
			</div>
			<div class="body_rank">
				<?php if(count($char_ranking)): ?>
					<table class="table">
						<thead>
							<tr>
								<th>Nick</th>
								<th>Poziom</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0; foreach($char_ranking as $char): ?>
								<tr>
									<td>
										<a class="char_anch" href="<?php echo site_url() . 'user/char_profile/' . $char->id; ?>">
											<?php echo $char->name; ?>
										</a>
									</td>
									<td><?php echo $char->level; ?></td>
								</tr>
								<?php $i++; if($i == 10){ break;} ?>
							<?php endforeach; ?>		
						</tbody>
					</table>
					<a href="<?php echo site_url('user/char_ranking'); ?>" class="text-center"><p>Zobacz pełny ranking</p></a>
				<?php else: ?>
					Brak postaci
				<?php endif; ?>
			</div>
		</div>

		<div class="char_ranking_bar">
			<div class="head_rank text-center">
				Top 5 gildii
			</div>
			<div class="body_rank">
				<?php if(count($guild_ranking)): ?>
					<table class="table">
						<thead>
							<tr>
								<th>Nick</th>
								<th>Poziom</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 0; foreach($guild_ranking as $guild): ?>
								<tr>
									<td><?php echo $guild->name; ?></td>
									<td><?php echo $guild->level; ?></td>
								</tr>
								<?php $i++; if($i == 5){ break;} ?>
							<?php endforeach; ?>		
						</tbody>
					</table>
					<a href="<?php echo site_url('user/guild_ranking'); ?>" class="text-center"><p>Zobacz pełny ranking</p></a>
				<?php else: ?>
					Brak gildii
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>