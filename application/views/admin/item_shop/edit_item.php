<div class="row">
	<div class="col-lg-12">
		<h3><?php echo empty($shop_item->id) ? 'Dodawanie nowego przedmiotu' : 'Edycja przedmiotu ' . $shop_item->name; ?></h3>
		<?php if(validation_errors()): ?>
			<div class="alert alert-warning" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>	
		<?php echo form_open_multipart('admin/item_shop/add_item/' . $this->uri->segment(4)); ?>
		<div class="row">
			<div class="col-lg-6">
				<?php echo form_upload('logo','','class="input_file"'); ?>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-6">
				<p class="input_label">Nazwa</p>
				<?php echo form_input('name', set_value('name', $shop_item[0]->name),'class="input_wp"'); ?>
			</div>
			<div class="col-lg-6">
				<p class="input_label">Id przedmiotu</p>
				<?php echo form_input('vnum', set_value('vnum', $shop_item[0]->vnum),'class="input_wp"'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<p class="input_label">Ilość</p>
				<?php echo form_input('stack', set_value('stack', $shop_item[0]->stack),'class="input_wp"'); ?>
			</div>
			<div class="col-lg-6">
				<p class="input_label">Cena</p>
				<?php echo form_input('price', set_value('price', $shop_item[0]->price),'class="input_wp"'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<p class="input_label">Opis</p>
				<?php echo form_textarea('describe', set_value('describe', $shop_item[0]->describe),'class="input_wp"'); ?>
			</div>
			<div class="col-lg-6">
				<p class="input_label">Kategoria</p>
				<?php echo form_dropdown('category_id', $drop_cat,'class="input_wp"'); ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-12">
				<?php echo form_submit('submit', 'Zapisz', 'class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>