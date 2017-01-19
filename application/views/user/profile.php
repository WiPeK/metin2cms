<div class="row">
	<div class="col-lg-12">
		<div class="profile_bar">
			<div class="head_subview">
				<h3 class="text-center">
					<?php echo $user_data[0]->login; ?>
				</h3>
				<div class="body_subview">
					<div class="uinfo_bar">
						<?php echo 'Data stworzenia konta: ' . $user_data[0]->create_time; ?>
					</div>
					<div class="uinfo_bar">
						<?php echo 'Premium exp do : ' . $user_data[0]->silver_expire; ?>
					</div>
					<div class="uinfo_bar">
						<?php echo 'Premium drop do : ' . $user_data[0]->gold_expire; ?>
					</div>
					<div class="uinfo_bar">
						<?php echo 'Premium drop yang do : ' . $user_data[0]->money_drop_rate_expire; ?>
					</div>
					<div class="uinfo_bar">
						<?php echo 'Ostatnie logowanie w grze : ' . $user_data[0]->last_play; ?>
					</div>

					<?php if(isset($user_chars)): ?>
						<?php foreach($user_chars as $char): ?>
							<a href="<?php echo site_url() . 'user/char_profile/' . $char->id; ?>">
								<button type="button" class="btn btn-primary no_border_radius"><?php echo $char->name; ?></button>
							</a>
						<?php endforeach; ?>
					<?php else: ?>
						<div class="alert alert-warning" type="alert">Na koncie nie ma żadnych postaci.</div>
					<?php endif; ?>
					<br><br>
				</div>
			</div>
		</div>
	</div>
</div>