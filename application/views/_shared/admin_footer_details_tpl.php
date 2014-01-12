<!-- Javascript files -->
      <script src="/js/admin/include_page/bootstrap.min.js"></script>

      <script src="/js/admin/include_page/hover_money.js"></script>

      <?php if ($header['js']) { foreach( $header['js'] as $js ){ echo '<script type="text/javascript" src="'.$js.'"></script>
      '; } } ?>

      <!-- jQuery flot -->
      <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/js/admin/include_page/excanvas.min.js"></script><![endif]-->
        <script src="/js/admin/include_page/jquery.flot.js"></script>
        <script src="/js/admin/include_page/jquery.flot.pie.js"></script>
        <script src="/js/admin/include_page/jquery.flot.stack.js"></script>
        <script src="/js/admin/include_page/jquery.flot.resize.js"></script>

      <!-- /Javascript files -->


      <script type="text/javascript">
         $(function () {

             /* Bar Chart starts */

             var d1 = [];
             for (var i = 0; i <= 35; i += 1)
                 d1.push([i, parseInt(Math.random() * 30)]);

             var d2 = [];
             for (var i = 0; i <= 35; i += 1)
                 d2.push([i, parseInt(Math.random() * 30)]);


             var stack = 0, bars = true, lines = false, steps = false;
             
             function plotWithOptions() {
                 $.plot($("#home-chart"), [ d1, d2 ], {
                     series: {
                         stack: stack,
                         lines: { show: lines, fill: true, steps: steps },
                         bars: { show: bars, barWidth: 0.8 }
                     },
                     grid: {
                         borderWidth: 0, hoverable: true, color: "#777"
                     },
                     colors: ["#16cbe6", "#0fa6bc"],
                     bars: {
                           show: true,
                           lineWidth: 0,
                           fill: true,
                           fillColor: { colors: [ { opacity: 0.9 }, { opacity: 0.8 } ] }
                     }
                 });
             }

             plotWithOptions();
             
             $(".stackControls input").click(function (e) {
                 e.preventDefault();
                 stack = $(this).val() == "With stacking" ? true : null;
                 plotWithOptions();
             });
             $(".graphControls input").click(function (e) {
                 e.preventDefault();
                 bars = $(this).val().indexOf("Bars") != -1;
                 lines = $(this).val().indexOf("Lines") != -1;
                 steps = $(this).val().indexOf("steps") != -1;
                 plotWithOptions();
             });

             /* Bar chart ends */

         });
      </script>