<!-- <p class="pull-right">Strona wygenerowana dnia <strong><?php echo date('Y-m-d H-i-s') ?></strong> w czasie <strong>{elapsed_time}</strong> sek</p>
 -->	<!-- bootstrap js -->
	<!--<script src="<?php echo site_url('js/jquery.js') ?>"></script>-->
    
	<script src="<?php echo site_url() . 'assets/js/bootstrap.js'; ?>"></script>
	<!--Bootstrap Datepicker-->
	<script src="<?php echo site_url() . 'assets/js/bootstrap-datepicker.js'; ?>"></script>

	<script src="<?php echo site_url() . 'assets/js/admin_functions.js'; ?>"></script>

	<script src="<?php echo site_url() . 'assets/ckeditor/ckeditor.js'; ?>"></script>
	<script>
		CKEDITOR.replace('ckeditor');
	</script>
	<script>
		jQuery(document).ready(function(){
			$(".nav-adm").height($(document).height());
		});
		
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
		$(function () {
  			$('[data-toggle="popover"]').popover()
		})
	</script>
			<!--nice scroll 
	<script src="<?php echo site_url() . 'assets/js/nicescroll/jquery.nicescroll.min.js'; ?>"></script>
	<script>
		$(document).ready(
		  function() { 
		    $("html").niceScroll();
		  }
		);
	</script>-->
</body>
</html>