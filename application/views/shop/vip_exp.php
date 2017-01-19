<table class="table">
	<thead>
		<tr>
			<th>Czas</th>
			<th>Koszt</th>
			<th>Kup</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($vip_exp)): ?>
			<?php foreach($vip_exp as $vexp): ?>
				<tr>
					<td><?php echo $vexp->days; ?></td>
					<td><?php echo $vexp->cash; ?></td>
					<td><?php echo anchor(site_url() . 'shop/buy_vip_exp/' . $vexp->id, 'Kup'); ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>