<script>
	$(document).ready(function(){												
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
</script>
        <!--nice scroll -->
    <script src="<?php echo site_url() . 'assets/js/nicescroll/jquery.nicescroll.min.js'; ?>"></script>
    <script>
        var nice = false;
        $(document).ready(
          function() { 
            nice = $("html").niceScroll();
          }
        );
    </script>
</body>
</html>