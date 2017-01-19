<div class="row no_space">
	<div class="col-lg-12">
		<h2>Postacie</h2>
		<a href="<?php echo site_url('admin/user/'); ?>">
			<button class="btn btn-default no_border_radius">
				Konta
			</button>
		</a>
		<a href="<?php echo site_url('admin/user/char_index'); ?>">
			<button type="button" class="btn btn-primary no_border_radius">Postacie</button>
		</a>
		<a href="<?php echo site_url('admin/user/guild_index'); ?>">
			<button type="button" class="btn btn-info no_border_radius">Gildie</button>
		</a>
		<a href="<?php echo site_url('admin/user/banned_index'); ?>">
			<button type="button" class="btn btn-danger no_border_radius">Zablokowani</button>
		</a>
		<div class="pull-right">
			<?php 
				$attributes = array(
					'class' => 'navbar-form search_bar',
					'role' => 'search'
				);
				echo form_open(site_url('admin/user/search_char'),$attributes);
			?>
			<div class="form-group">
				<?php echo form_input('search_input','','class="form-control no_border_radius" placeholder="Szukaj postaci"'); ?>
			</div>
			<button type="submit" name="submit" class="btn btn-default no_border_radius">
				<div class="menu_search">
	            	<span class="glyphicon glyphicon-search pull-right search_ic"></span>	
	            </div>
			</button>
			<?php echo form_close(); ?>
		</div>
		<div class="pagination_set text-center">
			<?php if(isset($pagination)): ?>
				<section class="pagination"><?php echo $pagination; ?></section>
			<?php endif; ?>	
		</div>
		<section>
			<table class="table table_hover">
					<thead>
						<tr>
							<th>Nick</th>
							<th>Login</th>
							<th>Poziom</th>
							<th>Status konta</th>
							<th>Akcja</th>
						</tr>
					</thead>
					<tbody>
			<?php if(count($users)): foreach($users as $user): ?>	
					<tr>
						<?php 
							$acc_info = $this->user_m->get_acc_info($user->account_id);
							$acc_login = $acc_info['login'];
							$acc_status = $acc_info['status'];
						?>
						<td><?php echo $user->name; ?></td>			
						<td>
							<?php
								if(is_array($acc_login))
								{
									echo 'Konto usunięte';
								}
								else
									echo anchor('admin/user/edit/' . $user->account_id, $acc_login); 
							?>
						</td>
						<td><?php echo $user->level; ?></td>
						<td>
							<?php 
								if(is_array($acc_status))
								{
									echo 'Konto usunięte';
								}
								else
								{
									echo $acc_status;
								}
							?>
						</td>
						<td>
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle no_border_radius" data-toggle="dropdown" aria-expanded="false">
							    Zarządzaj <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu no_border_radius" role="menu">
							    <li><?php echo anchor('admin/user/char_edit/' . $user->id, 'Edytuj');?></li>
							    <li><?php echo anchor('admin/user/block/' . $user->account_id, 'Zablokuj/Odblokuj');?></li>
							    <li class="divider"></li>
							    <li><?php echo anchor('admin/user/block_ip/' . $user->account_id, 'Blokada wszystkich kont');?></li>
							    <li><?php echo anchor('admin/user/char_delete/' . $user->id, 'Usuń');?></li>
							  </ul>
							</div>
						</td>
					</tr>
			<?php endforeach; ?>
			<?php else: ?>
					<tr>
						<td colspan="3">Nie można znaleźć żadnego użytkownika.</td>
					</tr>
			<?php endif; ?>	
					</tbody>
				</table>
		</section>
		<div class="pagination_set text-center">
			<?php if(isset($pagination)): ?>
				<section class="pagination"><?php echo $pagination; ?></section>
			<?php endif; ?>	
		</div>
	</div>
</div>