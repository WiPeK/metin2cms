<div class="row no_space">
	<div class="col-lg-12">
		<h2>Użytkownicy</h2>
		<a href="<?php echo site_url('admin/user/edit'); ?>">
			<button class="btn btn-default no_border_radius">
				<i class="glyphicon glyphicon-plus"></i> Dodaj użytkownika
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
				echo form_open(site_url('admin/user/search_ip'),$attributes);
			?>
			<div class="form-group">
				<?php echo form_input('search_input_ip','','class="form-control no_border_radius" placeholder="Szukaj ip"'); ?>
			</div>
			<button type="submit" name="submit" class="btn btn-default no_border_radius">
				<div class="menu_search">
	            	<span class="glyphicon glyphicon-search pull-right search_ic"></span>	
	            </div>
			</button>
			<?php echo form_close(); ?>
		</div>
		<div class="pull-right">
			<?php 
				$attributes = array(
					'class' => 'navbar-form search_bar',
					'role' => 'search'
				);
				echo form_open(site_url('admin/user/search_acc'),$attributes);
			?>
			<div class="form-group">
				<?php echo form_input('search_input','','class="form-control no_border_radius" placeholder="Szukaj konta"'); ?>
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
		<br>
			<table class="table table_hover">
					<thead>
						<tr>
							<th>Login</th>
							<th>Email</th>
							<th>Data stworzenia</th>
							<th>Status</th>
							<th>Smocze monety</th>
							<th>Akcja</th>
						</tr>
					</thead>
					<tbody>
			<?php if(count($users)): foreach($users as $user): ?>	
					<tr>
						<td><?php echo anchor('admin/user/edit/' . $user->id, $user->login); ?></td>
						<td><?php echo $user->email; ?></td>			
						<td><?php echo $user->create_time; ?></td>
						<td><?php echo $user->status; ?></td>
						<td><?php echo $user->cash; ?></td>
						<td>
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle no_border_radius" data-toggle="dropdown" aria-expanded="false">
							    Zarządzaj <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu no_border_radius" role="menu">
							    <li><?php echo anchor('admin/user/edit/' . $user->id, 'Edytuj');?></li>
							    <li>
							    	<?php 
							    	if($user->status != 'OK')
							    	{
							    		echo anchor('admin/user/unblock/' . $user->id, 'Odblokuj');
							    	}
							    	else
							    		echo anchor('admin/user/block/' . $user->id, 'Zablokuj');?>
							    </li>
							    <li class="divider"></li>
							    <li><?php echo anchor('admin/user/block_ip/' . $user->id, 'Blokada wszystkich kont');?></li>
							    <li><?php echo anchor('admin/user/delete_account/' . $user->id, 'Usuń');?></li>
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