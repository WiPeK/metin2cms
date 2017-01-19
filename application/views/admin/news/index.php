<div class="row">
	<div class="col-lg-12">
		<h2>Aktualności</h2>
		<a href="<?php echo site_url('admin/news/edit'); ?>">
			<button class="btn btn-default no_border_radius">
				<i class="glyphicon glyphicon-plus"></i> Dodaj news
			</button>
		</a>
		<div class="pagination_set text-center">
			<?php if($pagination): ?>
				<section class="pagination"><?php echo $pagination; ?></section>
			<?php endif; ?>	
		</div>
		<section>
			<table class="table table_hover">
				<thead>
					<tr>
						<th>Tytuł</th>
						<th>Data publikacji</th>
						<th>Dodane przez</th>
						<th>Akcja</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($articles)): foreach($articles as $article): ?>	
					<tr>
						<td class="art_tit"><?php echo anchor('admin/news/edit/' . $article->id, $article->title);?></td>
						<td><?php echo $article->pubdate; ?></td>
						<td><?php echo $article->created_by; ?></td>
						<td>
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle no_border_radius" data-toggle="dropdown" aria-expanded="false">
							    Zarządzaj <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu no_border_radius" role="menu">
							    <li><?php echo anchor('admin/news/edit/' . $article->id, 'Edytuj');?></li>
							    <li class="divider"></li>
							    <li><?php echo anchor('admin/news/delete/' . $article->id, 'Usuń');?></li>
							  </ul>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td class="col-lg-3">Nie można znaleźć żadnego artykułu</td>
						</tr>
					<?php endif; ?>	
				</tbody>
			</table>
		</section>
		<div class="pagination_set text-center">
			<?php if($pagination): ?>
				<section class="pagination"><?php echo $pagination; ?></section>
			<?php endif; ?>	
		</div>
	</div>
</div>