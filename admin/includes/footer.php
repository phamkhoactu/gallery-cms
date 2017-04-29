    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
     <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
     <script src="js/scripts.js" type="text/javascript" charset="utf-8" async defer></script>
     <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',    <?php echo $session->count; ?>],
          ['Photos',      <?php echo Photo::count_all(); ?>],
          ['User',  <?php echo User::count_all(); ?>],
          ['Comment', <?php echo Comment::count_all(); ?>]
        ]);

        var options = {
          legend:'none',
          pieSliceText:'label',
          title: 'My Daily Activities',
          backgroundColor: 'transparent'

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
<?php echo $Photo::count_all(); ?>
</body>

</html>
