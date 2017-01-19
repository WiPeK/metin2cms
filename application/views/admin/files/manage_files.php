<div class="row edit_data no_space">
	<div class="col-lg-10 col-lg-offset-1">		
		<div id="upload">
			<h3>Zuploaduj plik</h3>
			<?php if($error): ?>
				<div class="alert alert-warning" role="alert">
					<?php echo $error; ?>
				</div>
			<?php endif; ?>	
			<?php if(validation_errors()): ?>
				<div class="alert alert-warning" role="alert">
					<?php echo validation_errors(); ?>
				</div>
			<?php endif; ?>
			<?php echo form_open_multipart('admin/manage_files/do_upload'); ?>
			<div class="row">
				<div class="col-lg-6">
					<p class="input_label">Tytuł pliku:</p>
					<?php echo form_input('file_title','','class="input_wp"'); ?>
				</div>
				<div class="col-lg-6">
					<p class="input_label">Wybierz plik:</p> 
					<?php echo form_upload('userfile','','class="input_file"'); ?>
				</div>
			</div><br><br>
			<div class="row">
				<div class="col-lg-12">
					<?php echo form_submit('upload', 'Upload','class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
				</div>
			</div>
			<?php echo form_close(); ?>					
		</div>
		<br><br>
		<section>
			<table class="table table_hover">
				<thead>
					<tr>
						<th>Plik</th>
						<th>Dodany przez</th>
						<th>Data dodania</th>
						<th>Rozmiar</th>
						<th>Pobierz</th>
						<th>Usuń</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($files)): foreach($files as $file): ?>
						<tr>
							<td>
								<?php echo $file->file_title . $file->extension; ?>
							</td>
							<td>
								<?php echo $file->file_who_add; ?>
							</td>
							<td>
								<?php echo $file->add_date; ?>
							</td>
							<td>
								<?php echo $file->file_size . ' Kb'; ?>
							</td>
							<td>
								<a class="center-block text-center" href="<?php echo site_url() . 'download_menager/' . urlencode(base64_encode($file->file_title . $file->extension)) . '/' . $file->raw_name; ?>">
									<i class="glyphicon glyphicon-download-alt"></i>
								</a>
							</td>
							<td>
								<?php echo btn_delete('admin/manage_files/delete_file/' . urlencode(base64_encode($file->file_url))); ?>
							</td>
						</tr>
					<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td class="col-lg-3">Nie znaleziono żadnego pliku</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</section>
	</div>
</div>

