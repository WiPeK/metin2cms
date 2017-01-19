<div class="row">
	<div class="col-lg-12">
		<div class="pagination_set text-center">
			<?php if(isset($pagination)): ?>
				<section class="pagination"><?php echo $pagination; ?></section>
			<?php endif; ?>	
		</div>
		<section>
			<table class="table">
				<thead>
					<tr>
						<th>Nick</th>
						<th>Poziom</th>
						<th>Exp</th>
						<th>Czas gry</th>
						<th>Ostatnie logowanie</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($char_rank)): foreach($char_rank as $char): ?>
						<tr>
							<td>
								<a class="char_anch" href="<?php echo site_url() . 'user/char_profile/' . $char->id; ?>">
									<?php echo $char->name; ?>
								</a>
							</td>
							<td><?php echo $char->level; ?></td>
							<td><?php echo $char->exp; ?></td>
							<td><?php echo ranking_time($char->playtime); ?></td>
							<td><?php echo $char->last_play; ?></td>
						</tr>
					<?php endforeach; else: ?>
						<tr>
							<td>Nie znaleziono żadnej postaci</td>
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
