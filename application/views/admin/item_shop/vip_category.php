<div class="row no_space">
	<div class="col-lg-12">
		<h2>Kategorie VIP</h2>
		<a href="<?php echo site_url('admin/item_shop/vip_edit'); ?>">
			<button class="btn btn-default no_border_radius">
				<i class="glyphicon glyphicon-plus"></i> Dodaj opcje VIP
			</button>
		</a>
	</div>
	<div class="col-lg-12">
		<table class="table">
			<thead>
				<tr>
					<th>Czas (Dni)</th>
					<th>Koszt</th>
					<th>Kategoria</th>
					<th>Akcja</th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($vips_cat)): ?>
					<?php foreach($vips_cat as $vip_cat): ?>
						<tr>
							<td>
								<?php echo $vip_cat->days; ?>
							</td>
							<td>
								<?php echo $vip_cat->cash; ?>
							</td>
							<td>
								<?php echo $vip_cat->category; ?>
							</td>
							<td>
								<div class="btn-group">
								  <button type="button" class="btn btn-default dropdown-toggle no_border_radius" data-toggle="dropdown" aria-expanded="false">
								    Zarządzaj <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu no_border_radius" role="menu">
								    <li><?php echo anchor('admin/item_shop/vip_edit/' . $vip_cat->id, 'Edytuj');?></li>
								    <li class="divider"></li>
								    <li><?php echo anchor('admin/item_shop/vip_delete/' . $vip_cat->id, 'Usuń');?></li>
								  </ul>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="3">Nie można znaleźć kategorii exp.</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>