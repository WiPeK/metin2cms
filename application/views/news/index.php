<div class="row">
	<div class="col-lg-12">
		<?php if(isset($news_data)): ?>
			<?php foreach($news_data as $news): ?>
				<div class="news_title_bar">
					<?php echo $news->title; ?>
				</div>
				<div class="pub_aut_bar">
					<p><?php echo $news->pubdate; ?></p>
					<p><?php echo $news->created_by; ?></p>
				</div>
				<div class="clearfix"></div>
				<div class="body_new_bar">
					<?php echo $news->body; ?>
				</div>
				<hr>
				<div class="space100"></div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="alert alert-warning no_border_radius" role="alert">Brak newsów</div>
		<?php endif; ?>
	</div>
</div>