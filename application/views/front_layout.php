<?php $this->load->view('include/header'); ?>
<div class="container-fluid">
	<?php $this->load->view('inc/menu'); ?>
	<div class="row">
		<div class="col-lg-3 no_right">
			<?php $this->load->view('inc/left_bar'); ?>
		</div>
		<div class="col-lg-6 no_space">
			<div class="center_bar">
				<?php if(isset($statement)): ?>
					<?php $this->load->view($statement); ?>
				<?php endif; ?>
				<?php if(isset($subview)): ?>
					<?php $this->load->view($subview); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-lg-3 no_left">
			<?php $this->load->view('inc/right_bar'); ?>
		</div>
	</div>
</div>
<?php $this->load->view('include/footer_s'); ?>
<?php $this->load->view('include/footer'); ?>