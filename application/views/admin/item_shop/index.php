<div class="row no_space">
<br>
	<div class="col-lg-4 no_space">
		<a href="<?php echo site_url() . 'admin/item_shop/add_item'; ?>">
			<button type="button" class="btn btn-primary btn-lg btn-block no_border_radius">Dodaj przedmiot</button>
		</a>
	</div>
	<div class="col-lg-4 no_space">
		<a href="<?php echo site_url() . 'admin/item_shop/add_category'; ?>">
			<button type="button" class="btn btn-default btn-lg btn-block no_border_radius">Dodaj kategorie</button>
		</a>
	</div>
	<div class="col-lg-4 no_space">
		<a href="<?php echo site_url() . 'admin/item_shop/vip_category'; ?>">
			<button type="button" class="btn btn-default btn-lg btn-block no_border_radius">Kategorie VIP</button>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
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
							<th>Kategoria</th>
							<th>Nazwa</th>
							<th>Sztuk</th>
							<th>Cena</th>
							<th>Opis</th>
							<th>Akcja</th>
						</tr>
					</thead>
					<tbody>
			<?php if(count($item_shop)): foreach($item_shop as $item): ?>	
					<tr>
						<td>
							<?php 
							  	$cat_id = (int) $item->category_id;
							  	$query = $this->db->query("SELECT id,category FROM shop_category where id='$cat_id'"); 
							?>
							<?php if((int) $query->row('id') > 0): ?>
								<div class="btn-group">
								  <button type="button" class="btn btn-default dropdown-toggle no_border_radius" data-toggle="dropdown" aria-expanded="false">
								  <?php echo $query->row('category'); ?><span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu no_border_radius" role="menu">
								    <li><?php echo anchor('admin/item_shop/add_category/' . $query->row('id'), 'Edytuj kategorie');?></li>
								    <li class="divider"></li>
								    <li><?php echo anchor('admin/item_shop/delete_category/' . $query->row('id'), 'Usuń kategorie');?></li>
								  </ul>
								</div>
							<?php else: ?>
								Brak kategorii
							<?php endif; ?>
						</td>
						<td><?php echo $item->name; ?></td>			
						<td><?php echo $item->stack; ?></td>			
						<td><?php echo $item->price; ?></td>			
						<td><?php echo $item->describe; ?></td>			
						<td>
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle no_border_radius" data-toggle="dropdown" aria-expanded="false">
							    Zarządzaj<span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu no_border_radius" role="menu">
							    <li><?php echo anchor('admin/item_shop/add_item/' . $item->id, 'Edytuj');?></li>
							    <li class="divider"></li>
							    <li><?php echo anchor('admin/item_shop/delete_item/' . $item->id, 'Usuń');?></li>
							  </ul>
							</div>
						</td>
					</tr>
			<?php endforeach; ?>
			<?php else: ?>
					<tr>
						<td colspan="3">Sklep pusty.</td>
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
