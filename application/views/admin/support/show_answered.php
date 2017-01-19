<br>
<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<div class="row">
				<div class="col-lg-6">
					<div class="config_bar">
						<p class="input_label">
							Zgłoszenie wysłane od:
						</p>
						<?php echo e($show_answer->email); ?>
					</div>	
				</div>		
				<div class="col-lg-6">
					<div class="config_bar">
						<p class="input_label">
							Data wysłania zgłoszenia:
						</p>
						<?php echo e($show_answer->send_date); ?>
					</div>	
				</div>	
		</div>
<br><br>
		<div class="row">
				<div class="col-lg-12">
					<div class="config_bar">
						<p class="input_label">
							Treść zgłoszenia:
						</p>
						<?php echo e($show_answer->body); ?>
					</div>	
				</div>
		</div>
<br><br>
		<div class="row">
				<div class="col-lg-6">
					<div class="config_bar">
						<p class="input_label">
							Data odpowiedzi:
						</p>
						<?php echo e($show_answer->answer_date); ?>
					</div>	
				</div>
				<div class="col-lg-6">
					<div class="config_bar">
						<p class="input_label">
							Odpowiedź udzielona przez:
						</p>
						<?php echo e($show_answer->who_answer); ?>
					</div>	
				</div>
		</div>
<br><br>
		<div class="row">
				<div class="col-lg-12">
					<div class="config_bar">
						<p class="input_label">
							Treść odpowiedzi:
						</p>
						<?php echo $show_answer->answer_body; ?>
					</div>	
				</div>
		</div>
	</div>
</div>