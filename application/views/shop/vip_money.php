<table class="table">
	<thead>
		<tr>
			<th>Czas</th>
			<th>Koszt</th>
			<th>Kup</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($vip_money)): ?>
			<?php foreach($vip_money as $vmoney): ?>
				<tr>
					<td><?php echo $vmoney->days; ?></td>
					<td><?php echo $vmoney->cash; ?></td>
					<td><?php echo anchor(site_url() . 'shop/buy_vip_money/' . $vmoney->id, 'Kup'); ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>