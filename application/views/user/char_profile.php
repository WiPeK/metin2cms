<div class="row">
	<div class="col-lg-12">
		<div class="user_char_bar">
			<div class="head_subview">
				<h3 class="text-center">
					<?php echo $char_data[0]->name; ?>
				</h3>
			</div>
			<div class="body_subview">
				<div class="row">
					<div class="col-lg-6">
						<img class="img-responsive" src="<?php echo get_proffesion_img($char_data[0]->job); ?>" alt="profesja">
					</div>
					<div class="col-lg-6">
						<div class="char_bar">
							<?php echo 'Królestwo: ' . krolestwo((int)$char_data[0]->empire); ?>
						</div>
						<div class="char_bar">
							<?php echo 'Profesja: ' . nazwa_profesji($char_data[0]->job, $char_data[0]->skill_group); ?>
						</div>
						<div class="char_bar">
							<?php echo 'Czas gry: ' . $char_data[0]->playtime . ' minut'; ?>
						</div>
						<div class="char_bar">
							<?php echo 'Poziom: ' . $char_data[0]->level; ?>
						</div>
						<div class="char_bar">
							<?php echo 'Doświadczenie: ' . $char_data[0]->exp; ?>
						</div>
						<div class="char_bar">
							<?php echo 'Złoto: ' . $char_data[0]->gold; ?>
						</div>
						<div class="char_bar">
							Statusy: <br>
							<?php echo 'Witalność: ' . $char_data[0]->ht . br(); ?>
							<?php echo 'Inteligencja: ' . $char_data[0]->iq . br(); ?>
							<?php echo 'Siła: ' . $char_data[0]->st . br(); ?>
							<?php echo 'Zręcznośc: ' . $char_data[0]->dx . br(); ?>
						</div>
						<div class="char_bar">
							<?php echo 'Ranga: ' . $char_data[0]->alignment; ?>
						</div>
						<div class="char_bar">
							<?php echo 'Ostatnie logowanie: ' . $char_data[0]->last_play; ?>
						</div>
						<div class="char_bar">
							<?php echo 'Poziom konia: ' . $char_data[0]->horse_level; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="item_char_bar">
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
						<span style='color:white;'><?php if(isset($item->slot_kd) && $item->slot_kd < 29000){ echo br() . $item->slot_kd . br(); } ?></span>
						<span style='color:white;'><?php if(isset($item->slot_kd2)){ echo $item->slot_kd2 . br(); } ?></span>
						<span style='color:white;'><?php if(isset($item->slot_kd3)){ echo $item->slot_kd3; } ?></span>
					</div>
					<div class='item_popover_bot'></div>
					">
				</div>	
			<?php endforeach; ?>
		</div>	
	</div>
</div>