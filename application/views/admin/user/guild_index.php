<div class="row no_space">
	<div class="col-lg-12">
		<h2>Gildie</h2>
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
				echo form_open(site_url('admin/user/search_guild'),$attributes);
			?>
			<div class="form-group">
				<?php echo form_input('search_input','','class="form-control no_border_radius" placeholder="Szukaj gildii"'); ?>
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
							<th>Nazwa</th>
							<th>Lider</th>
							<th>Poziom</th>
							<th>Exp</th>
							<th>Wygrane</th>
							<th>Remisy</th>
							<th>Przegrane</th>
							<th>Punkty</th>
							<th>Złoto</th>
						</tr>
					</thead>
					<tbody>
			<?php if(count($guilds)): foreach($guilds as $guild): ?>	
					<tr>
						<td>
							<?php echo $guild->name; ?>
						</td>
						<td>
							<?php
								$query = $this->db->query("SELECT name FROM player WHERE id='$guild->master'");
								echo $query->row('name');
							?>
						</td>
						<td><?php echo $guild->level; ?></td>
						<td><?php echo $guild->exp; ?></td>
						<td><?php echo $guild->win; ?></td>
						<td><?php echo $guild->draw; ?></td>
						<td><?php echo $guild->loss; ?></td>
						<td><?php echo $guild->ladder_point; ?></td>
						<td><?php echo $guild->gold; ?></td>
					</tr>
			<?php endforeach; ?>
			<?php else: ?>
					<tr>
						<td colspan="3">Nie można znaleźć żadnej gildii.</td>
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
