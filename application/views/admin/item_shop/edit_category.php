<div class="row no_space">
<br>
	<div class="col-lg-6 no_space">
		<a href="<?php echo site_url() . 'admin/item_shop/add_item'; ?>">
			<button type="button" class="btn btn-primary btn-lg btn-block no_border_radius">Dodaj przedmiot</button>
		</a>
	</div>
	<div class="col-lg-6 no_space">
		<a href="<?php echo site_url() . 'admin/item_shop/add_category'; ?>">
			<button type="button" class="btn btn-default btn-lg btn-block no_border_radius">Dodaj kategorie</button>
		</a>
	</div>
</div>
<div class="row">
	<?php echo form_open(); ?>
	<div class="col-lg-5">
		<h3 class="text-center"><?php echo empty($category->id) ? 'Dodaj kategorie' : 'Edycja kategorii: ' . $category->name; ?></h3>
		<p class="input_label">Nazwa</p>
		<?php echo form_input('category', set_value('category', $category['name']),'class="input_wp"'); ?>
		<br><br>
		<?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
	</div>
</div>