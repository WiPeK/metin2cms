<div class="row">
	<div class="col-lg-12">
		<div class="pagination_set text-center">
			<?php if(isset($pagination)): ?>
				<section class="pagination"><?php echo $pagination; ?></section>
			<?php endif; ?>	
		</div>
		<section>
			<table class="table">
				<thead>
					<tr>
						<th>Nazwa</th>
						<th>Lider</th>
						<th>Poziom</th>
						<th>Zwycięstwa</th>
						<th>Remisy</th>
						<th>Przegrane</th>
						<th>Punkty</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($guilds_rank)): foreach($guilds_rank as $guild): ?>
						<tr>
							<td><?php echo $guild->name; ?></td>
							<td>
								<?php
									$query = $this->db->query("SELECT name FROM player.player WHERE id='$guild->master'");
									echo $query->row('name');
								?>
							</td>
							<td><?php echo $guild->level; ?></td>
							<td><?php echo $guild->win; ?></td>
							<td><?php echo $guild->draw; ?></td>
							<td><?php echo $guild->loss; ?></td>
							<td><?php echo $guild->ladder_point; ?></td>
						</tr>
					<?php endforeach; else: ?>
						<tr>
							<td>Nie znaleziono żadnej postaci</td>
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
