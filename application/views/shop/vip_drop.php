<table class="table">
	<thead>
		<tr>
			<th>Czas</th>
			<th>Koszt</th>
			<th>Kup</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($vip_drop)): ?>
			<?php foreach($vip_drop as $vdrop): ?>
				<tr>
					<td><?php echo $vdrop->days; ?></td>
					<td><?php echo $vdrop->cash; ?></td>
					<td><?php echo anchor(site_url() . 'shop/buy_vip_drop/' . $vdrop->id, 'Kup'); ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>