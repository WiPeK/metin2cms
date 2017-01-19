<div class="row">
	<div class="col-lg-12">
		<?php if(isset($items)): ?>
			<?php foreach($items as $item): ?>
				<div class="item_cat">
					<div class="is_item_name"><?php echo $item->name; ?></div>
					<div class="is_item_stack"><?php echo 'Ilość sztuk: ' . $item->stack; ?></div>
					<div class="is_item_price"><?php echo 'Cena: ' . $item->price; ?></div>
					<div class="clearfix"></div>
					<br>
					<div class="row no_space">
						<div class="col-lg-2 no_space"><img class="center-block" src="<?php echo site_url() . 'assets/shop/' . $item->logo; ?>" alt="<?php echo $item->name; ?>"></div>
						<div class="col-lg-7 no_space"><?php echo $item->describe; ?></div>
						<div class="col-lg-3 no_space">
							<?php if($user_data[0]->cash >= $item->price): ?>
								<a class="center-block" href="<?php echo site_url() . 'shop/buy_item/' . $item->id; ?>">
									<button type="button" class="btn btn-primary no_border_radius">
										Kup przedmiot
									</button>
								</a>
							<?php else: ?>
								<p>Za mało monet</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<hr>
				<div class="clearfix"></div>
			<?php endforeach; ?>	
		<?php else: ?>
			<p>W tej kategorii nie ma przedmiotów.</p>
		<?php endif; ?>
	</div>
</div>