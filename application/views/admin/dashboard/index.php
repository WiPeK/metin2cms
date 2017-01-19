<div class="row no_space row_db">
	<div class="col-lg-12">
		<h2 class="text-center">Witaj w panelu administracyjnym</h2>
		<div class="row no_space">
			<div class="col-lg-3">
				<div class="bar_stats">
					<div class="panel panel-default">
					  <div class="panel-body">
					    <i class="glyphicon glyphicon-user pull-left user_icon"></i>
					    <p class="count_us text-center">
					    	<?php echo $cdata['cuser']; ?>
					    </p>
						<p class="bar_title text-center">Użytkowników</p>
					  </div>
					  <div class="panel-footer">
					  	<a href="<?php echo site_url() . 'admin/user'; ?>">
					  		<p class="sh_more">Zobacz więcej</p>
							<i class="glyphicon glyphicon-chevron-right sh_mr"></i>
					  	</a>
					  </div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="bar_stats">
					<div class="panel panel-default">
					  <div class="panel-body">
					    <i class="glyphicon glyphicon-tower pull-left page_icon"></i>
					    <p class="count_us text-center">
					    	<?php echo $cdata['cguild']; ?>
					    </p>
						<p class="bar_title text-center">Gildii</p>
					  </div>
					  <div class="panel-footer">
					  	<a href="<?php echo site_url() . 'admin/user/guild_index'; ?>">
					  		<p class="sh_pg">Zobacz więcej</p>
							<i class="glyphicon glyphicon-chevron-right sh_pg"></i>
					  	</a>
					  </div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="bar_stats">
					<div class="panel panel-default">
					  <div class="panel-body">
					    <i class="glyphicon glyphicon-user pull-left user_icon"></i>
					    <p class="count_us text-center">
					    	<?php echo $cdata['cplayer']; ?>
					    </p>
						<p class="bar_title text-center">Postaci</p>
					  </div>
					  <div class="panel-footer">
					  	<a href="<?php echo site_url() . 'admin/user/char_index'; ?>">
					  		<p class="sh_art">Zobacz więcej</p>
							<i class="glyphicon glyphicon-chevron-right sh_art"></i>
					  	</a>
					  </div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="bar_stats">
					<div class="panel panel-default">
					  <div class="panel-body">
					    <i class="glyphicon glyphicon-exclamation-sign pull-left support_icon"></i>
					    <p class="count_us text-center">
					    	<?php echo $cdata['csupport']; ?>
					    </p>
						<p class="bar_title text-center">Zgłoszeń</p>
					  </div>
					  <div class="panel-footer">
					  	<a href="<?php echo site_url() . 'admin/support'; ?>">
					  		<p class="sh_supp">Zobacz więcej</p>
							<i class="glyphicon glyphicon-chevron-right sh_supp"></i>
					  	</a>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row no_space">
	<div class="col-lg-12">
		<div class="row no_space">
			<div class="col-lg-12">
				<div id="is_stat"></div>
			</div>
		</div>
	</div>
</div>
<div class="space100"></div>
<div class="row no_space">
	<div class="col-lg-12">
		<div class="row no_space">
			<div class="col-lg-6">
				<div id="charts_browser"></div>
			</div>
			<div class="col-lg-6">
				<div id="charts_system"></div>
			</div>			
		</div>
	</div>
</div>
<div class="space100"></div>