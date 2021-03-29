<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; <?php echo date("Y") ?> <a href="https://github.com/coderaulia/ci-cms">CI Basic CMS</a> </div>
        <!-- /span12 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /footer-inner -->
</div>
<!-- /footer -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>jquery-1.7.2.min.js"></script>
<script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>bootstrap.js"></script>
<script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>jquery.hashchange.min.js"></script>
<script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>excanvas.min.js"></script>
<script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>chart.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>full-calendar/fullcalendar.min.js"></script>

<script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>base.js"></script>
<script>
  // HashChange
  $(function() {
    var path = window.location.pathname;

    //memanggil modal jika ada perubahan hash (tambah)
    $(window).hashchange([{
      hash: "#tambah",
      onSet: function() {
        $('#myModal').modal('show');
      }
    }]);
    // menghapus hash jika popup diclose.
    $('#myModal').on('hidden', function() {
      window.history.pushState(null, null, path);
    });

  });


  // Chart
  var lineChartData = {
    labels: ["23", "25", "25", "26", "27"],
    datasets: [{
      fillColor: "rgba(151,187,205,0.5)",
      strokeColor: "rgba(151,187,205,1)",
      pointColor: "rgba(151,187,205,1)",
      pointStrokeColor: "#fff",
      data: [2700, 2700, 2900, 2600, 2900]
    }]
  }

  var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);
</script>
</body>

</html>