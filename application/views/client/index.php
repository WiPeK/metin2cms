<div class="row">
	<div class="col-lg-12">
		<div class="links_bar">
			<?php if(isset($client_links)): ?>
				<?php foreach($client_links as $clink): ?>
					<div class="client_icon_bar pull-left">
						<a href="<?php echo $clink->url; ?>" class="thumbnail no_border_radius">
							<i class="glyphicon glyphicon-download-alt"></i>
						</a>
					</div>
					<div class="client_name_bar">
						<?php echo $clink->name; ?>
					</div>
					<div class="clearfix"></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>