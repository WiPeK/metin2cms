<div class="row no_space">
	<div class="col-lg-10 col-lg-offset-1">
		<h3>Linki do clienta</h3>
		<?php if(validation_errors()): ?>
			<div class="alert alert-warning" role="alert">
				<?php echo validation_errors(); ?>
			</div>
		<?php endif; ?>
		<div class="client_url_bar">
			<p class="input_label">Nazwa źródła</p>
			<?php echo form_open(); ?>
			<?php echo form_input('name','','class="input_wp"'); ?>
		</div>
		<div class="client_url_bar">
		<p class="input_label">Link</p>
			<?php echo form_input('client_url','','class="input_wp"'); ?>
			<?php echo form_submit('submit', 'Zapisz','class="btn btn-primary no_border_radius"'); ?>
			<?php echo form_close(); ?>
		</div>
		<div class="space100"></div>
		<div class="client_links">
			<table class="table">
				<thead>
					<tr>
						<th>Link</th>
						<th>Nazwa</th>
						<th>Data</th>
						<th>Dodane przez</th>
						<th>Usuń</th>
					</tr>
				</thead>
				<tbody>
					<?php if(isset($client_links)): ?>
						<?php foreach($client_links as $client): ?>
							<tr>
								<td><?php echo $client->url; ?></td>
								<td><?php echo $client->name; ?></td>
								<td><?php echo $client->time; ?></td>
								<td><?php echo $client->add_by; ?></td>
								<td>
									<a href="<?php echo site_url() . 'admin/client_download/cdelete/' . $client->id; ?>">
										<i class="glyphicon glyphicon-remove"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>