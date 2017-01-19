<?php //dump($user_data); ?>
<!-- <h3>Nazwa konta: <?php echo $user_data[0]->login; ?></h3>
<p>Data stworzenia konta: <?php echo $user_data[0]->create_time; ?></p>
<p>Data stworzenia konta: <?php echo $user_data[0]->create_time; ?></p>
<p>Królestwo: <?php echo show_empire($user_data[0]->create_time); ?></p>
<p>Monety premium: <?php echo $user_data[0]->cash; ?></p>
<p>Ostatnie logowanie do gry: <?php echo $user_data[0]->last_play; ?></p>
<p>Ostatnie logowanie na stronie: <?php echo $user_data[0]->last_web_login; ?></p>
 -->
<?php //dump($user_chars); ?>
<?php //dump($user_items); ?>

<!-- dodać pasek ostrzeżeń -->

<!-- wyświetlenie ikony - funkcja
pobranie nazwy i ulepszenia
jezeli ma bony to złoty
wymagany poziom
bonusy wbudowane
sprawdzenie i wypisanie bonow
kamienie dusz -->
<div class="row">
	<div class="col-lg-12">
		<div class="items_equipment">
			
		</div>
		<?php foreach($user_items as $item): ?>
			<?php 
				if(isset($item->attrtype0) && $item->attrtype0 != 0)
				{
					$title_color = '#FFC700';
				}
				else
				{
					$title_color = 'white';
				}
			?>
			<div class="item_wrapper" style="float:left;">
				<img class="img_item" src="<?php echo site_url() . 'assets/items/' . $item->icon; ?>" alt="<?php echo $item->name; ?>" data-container="body" data-toggle="popover" data-placement="right" data-trigger="hover" data-template='<div class="item_popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>' data-html="true" data-content="
				<div class='item_popover_top text-center'>
				<br>
					<span class='item_title' style='color:<?php echo $title_color; ?>; margin-top:10px;'><b><?php echo $item->name; ?></b></span>
				</div>
				<div class='item_popover_mid text-center'>
					<span style='color:#C1C1C1; font-size:13px;'><?php if(isset($item->req_lev) && $item->req_lev != 0){ echo 'Wymagany poziom: ' . $item->req_lev . br(2); } ?></span>
					<span style='color:#C1C1C1; font-size:13px;'><?php if(isset($item->def)){ echo 'Obrona: ' . $item->def . br(2); } ?></span>
					<span style='font-size:13px; color: #89B88D;'><?php if(isset($item->war_atk)){ echo 'Wartość ataku: ' . $item->war_atk . br();} ?></span>
					<span style='font-size:13px; color: #89B88D;'><?php if(isset($item->war_mag_atk)){ echo 'Wartość ataku magicznego: ' . $item->war_mag_atk . br();} ?></span>
					<span style='font-size:13px; color: #89B88D;'><?php if(isset($item->bon_dod_0)){ echo $item->bon_dod_0 . ': ' . $item->bon_dod_val_0;} ?></span><?php if(isset($item->bon_dod_0)){ echo br();} ?>
					<span style='font-size:13px; color: #89B88D;'><?php if(isset($item->bon_dod_1)){ echo $item->bon_dod_1 . ': ' . $item->bon_dod_val_1;} ?></span><?php if(isset($item->bon_dod_2)){ echo br();} ?>
					<span style='font-size:13px; color: #89B88D;'><?php if(isset($item->bon_dod_2)){ echo $item->bon_dod_2 . ': ' . $item->bon_dod_val_2;} ?></span><?php if(isset($item->bon_dod_3)){ echo br();} ?>
					<!-- bony 1-5 -->
					<div class='clearfix'></div>
					<span style='font-size:13px; color: #8cdf8d;'><?php if(isset($item->bonus)){ echo $item->bonus . ': ' . $item->attrvalue0 . br();} ?></span>
					<span style='font-size:13px; color: #8cdf8d;'><?php if(isset($item->bonus2)){ echo $item->bonus2 . ': ' . $item->attrvalue1 . br();} ?></span>
					<span style='font-size:13px; color: #8cdf8d;'><?php if(isset($item->bonus3)){ echo $item->bonus3 . ': ' . $item->attrvalue2 . br();} ?></span>
					<span style='font-size:13px; color: #8cdf8d;'><?php if(isset($item->bonus4)){ echo $item->bonus4 . ': ' . $item->attrvalue3 . br();} ?></span>
					<span style='font-size:13px; color: #8cdf8d;'><?php if(isset($item->bonus5)){ echo $item->bonus5 . ': ' . $item->attrvalue4 . br();} ?></span>
					<!-- KADEKI -->
					<div class='clearfix'></div>
					<span style='color:white;'><?php if(isset($item->slot_kd)){ echo br() . $item->slot_kd . br(); } ?></span>
					<span style='color:white;'><?php if(isset($item->slot_kd2)){ echo $item->slot_kd2 . br(); } ?></span>
					<span style='color:white;'><?php if(isset($item->slot_kd3)){ echo $item->slot_kd3; } ?></span>
				</div>
				<div class='item_popover_bot'></div>
				">

			</div>	
		<?php endforeach; ?>
	</div>
</div>