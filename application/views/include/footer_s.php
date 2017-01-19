<div class="row">
	<div class="col-lg-12">
		<div class="footer_links">
			<ul>
				<li>
					<a href="<?php echo site_url(); ?>">Home</a>
				</li>
				<p>/</p>
				<li>
					<a href="<?php echo site_url('register'); ?>">Rejestracja</a>
				</li>
				<p>/</p>
				<li>
					<a href="<?php echo site_url('client_download'); ?>">Pobierz</a>
				</li>
				<p>/</p>
				<li>
					<a href="<?php echo site_url('shop'); ?>">Sklep</a>
				</li>
				<p>/</p>
				<li>
					<a href="<?php echo site_url('support'); ?>">Support</a>
				</li>
				<p>/</p>
				<li>
					<a href="<?php echo site_url('gallery'); ?>">Galeria</a>
				</li>
				<p>/</p>
				<li>
					<a href="<?php echo 'ts3server://' . $cmscfg->ts_adress; ?>">TS3</a>
				</li>
				<p>/</p>
				<li>
					<a href="<?php echo $cmscfg->forum_url; ?>">Forum</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<hr>
		<div class="row no_space">
			<div class="col-lg-6 no_space">
				<p class="pull-left">Metin2CMS Created by WiPeK - Krzysztof Adamczyk 2015 wipekxxx@gmail.com</p>
			</div>
			<div class="col-lg-6 no_space">
				 <p class="pull-right">Strona wygenerowana dnia <strong><?php echo date('Y-m-d H-i-s') ?></strong> w czasie <strong>{elapsed_time}</strong> sek</p> 
			</div>
		</div>
	</div>
</div>