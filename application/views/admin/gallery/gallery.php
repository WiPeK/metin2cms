<div class="row no_space">
	<div class="col-lg-10 col-lg-offset-1">		
		<div id="upload">
			<h3>Zuploaduj zdjęcie</h3>
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
			<?php echo form_open_multipart('admin/gallery/do_upload'); ?>
			<div class="row">
				<div class="col-lg-6">
					<p class="input_label">Tytuł obrazka:</p>
					<?php echo form_input('img_title','','class="input_wp"'); ?>
				</div>
				<div class="col-lg-6">
					<p class="input_label">Wybierz plik:</p> 
					<?php echo form_upload('userfile','','class="input_file"'); ?>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-12">
					<?php echo form_submit('upload', 'Upload','class="btn btn-primary btn-lg btn-block no_border_radius"'); ?>
				</div>
			</div>
			<?php echo form_close(); ?>					
		</div>
		<br><br>
		<div id="gallery">
			<div class="row">
				<?php if(isset($images) && count($images)):  
					foreach($images as $image): ?>
					<div class="col-lg-2">	
						<div class="img_a">
							<a class="" href="<?php echo $image['img_url']; ?>">
								<img class="" src="<?php echo $image['thumb_url']; ?>" alt="">
							<span><?php echo btn_delete('admin/gallery/delete_image/' . urlencode(base64_encode($image['img_title']))); ?></span><br>
							</a> 
						</div>
					</div>
				<?php endforeach; else: ?>
					<div id="blank_gallery">Please upload an image</div>
				<?php endif; ?>
			</div>
			
		</div>
	</div>
</div>

