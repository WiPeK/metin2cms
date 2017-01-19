<div class="row">
	<div class="col-lg-12">
		<table class="table">
			<thead>
				<tr>
					<th>Bonus</th>
					<th>Szansa na wejście</th>
					<th>Wartość 1</th>
					<th>Wartość 2</th>
					<th>Wartość 3</th>
					<th>Wartość 4</th>
					<th>Wartość 5</th>
					<th>Edytuj</th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($item_bonus)): ?>
					<?php foreach($item_bonus as $bonus): ?>
						<tr>
							<td><?php echo $bonus->name; ?></td>
							<td><?php echo $bonus->prob; ?></td>
							<td><?php echo $bonus->lv1; ?></td>
							<td><?php echo $bonus->lv2; ?></td>
							<td><?php echo $bonus->lv3; ?></td>
							<td><?php echo $bonus->lv4; ?></td>
							<td><?php echo $bonus->lv5; ?></td>
							<td class="text-center">
								<a href="<?php echo site_url() . 'admin/bonus_item/edit_bon/' . $bonus->id; ?>">
									<i class="glyphicon glyphicon-edit"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<div class="space100"></div>
	</div>
</div>