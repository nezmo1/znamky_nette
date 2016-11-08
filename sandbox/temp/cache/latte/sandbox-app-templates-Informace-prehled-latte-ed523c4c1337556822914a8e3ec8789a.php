<?php
// source: E:\xampp2\htdocs\znamky_nette\sandbox\app/templates/Informace/prehled.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9423347404', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb28c19236ad_content')) { function _lb28c19236ad_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Počet známek</span>
              <div class="count"><?php echo Latte\Runtime\Filters::escapeHtml($prehled['pocet_znamek'], ENT_NOQUOTES) ?></div>
              <span class="count_bottom"><i class="green"> <?php echo Latte\Runtime\Filters::escapeHtml($prehled['pocet_tyden'], ENT_NOQUOTES) ?> </i> známek minulý týden</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Poslední přidaná známka </span>
              <div class="count"><?php if ($prehled['posledni_znamka_den'] >= 7 && $prehled['posledni_znamka_den_inv']==0) { ?>
<div class="red"> <?php } else { ?><div class="green"><?php } ?>  <?php echo Latte\Runtime\Filters::escapeHtml($prehled['posledni_znamka']['den'], ENT_NOQUOTES) ?>
. <?php echo Latte\Runtime\Filters::escapeHtml($prehled['posledni_znamka']['mesic'], ENT_NOQUOTES) ?>. </div> </div>
              <span class="count_bottom"> <?php echo Latte\Runtime\Filters::escapeHtml($prehled['posledni_znamka_den'], ENT_NOQUOTES) ?> dní od poslední známky</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
               <span class="count_top"><i class="fa fa-clock-o"></i> Poslední přidaná známka </span>
              <div class="count green" style="font-size: 120%"><?php echo Latte\Runtime\Filters::escapeHtml($prehled['posledni_pisemka_predmet'], ENT_NOQUOTES) ?></div>
              <span class="count_bottom"> <?php echo Latte\Runtime\Filters::escapeHtml($prehled['posledni_pisemka'], ENT_NOQUOTES) ?></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Nejčastější známka</span>
              <div class="count"><?php echo Latte\Runtime\Filters::escapeHtml($prehled['nej_znamka'], ENT_NOQUOTES) ?></div>
              <span class="count_bottom"><i class="green"><?php echo Latte\Runtime\Filters::escapeHtml($prehled['nej_znamka_pocet'], ENT_NOQUOTES) ?></i> známek</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-pencil"></i></span>
              <div class="count" style="font-size: 180%"><?php if ($uzivatel->isInRole("1")) { ?>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/seznam/zak">Seznam známek</a><?php } else { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/znamka/novaznamka?tridac=n">Nová známka</a><?php } ?></div>
            
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-pencil"></i> </span>
              <div class="count" style="font-size: 180%"><?php if ($uzivatel->isInRole("1")) { ?>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/seznam/cv-zak">Čtvrtletní klasifikace</a><?php } else { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/seznam/ucitel">Seznam známek</a><?php } ?></div>
             
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Měsíční aktivita <small>Počet známek</small></h3>
                  </div>
                  <div class="col-md-6">
                     
                   
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                  <div style="width: 100%;">
                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  

                 

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br>

          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile" style="min-height: 320">
                <div class="x_title">
                  <h2>Počet známek z předmětů</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                 
                    
<?php for ($i=1;$i<$prehled['pocet_znamek_graf1_i'];$i++) { ?>
           
                      <div class="widget_summary">
                    <div class="w_left w_25">
                      <span><?php echo Latte\Runtime\Filters::escapeHtml($prehled['pocet_znamek_jmeno_graf1'][$i], ENT_NOQUOTES) ?></span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss(round(100*$prehled['pocet_znamek_graf1'][$i]/$prehled['celkovy_pocet_znamek_graf1'])), ENT_COMPAT) ?>%;">
                          <span class="sr-only">100% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?php echo Latte\Runtime\Filters::escapeHtml($prehled['pocet_znamek_graf1'][$i], ENT_NOQUOTES) ?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
<?php } ?>
                 
                    
                    
                </div>
              </div>
            </div>

                  
<?php if (!$uzivatel->isInRole("1")) { ?>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile  overflow_hidden" style="min-height: 320">
                <div class="x_title">
                  <h2>Počet známek - třídy</h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Třída</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p class="">Podíl</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          
<?php for ($i=1;$i<$prehled['pocet_znamek_graf2_i'];$i++) { ?>
                            <tr>
                            <td>
                              <p><i class="fa fa-square" style="color:#<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($prehled['pocet_znamek_graf2_barva'][$i]), ENT_COMPAT) ?>
"></i><?php echo Latte\Runtime\Filters::escapeHtml($prehled['pocet_znamek_jmeno_graf2'][$i], ENT_NOQUOTES) ?></p>
                            </td>
                            <td><?php echo Latte\Runtime\Filters::escapeHtml(round(100*$prehled['pocet_znamek_graf2'][$i]/$prehled['celkovy_pocet_znamek_graf2']), ENT_NOQUOTES) ?>%</td>
                          </tr>
<?php } ?>
                          
                          
                         
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
<?php } ?>

             <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile" style="min-height: 320">
                <div class="x_title">
                  <h2>Nejčastější známky</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                 
                    
<?php for ($i=1;$i<$prehled['pocet_znamek_graf3_i'];$i++) { if ($prehled['pocet_znamek_jmeno_graf3'][$i]!="Zbytek") { ?>
                      <div class="widget_summary">
                    <div class="w_left w_25">
                      <span><?php echo Latte\Runtime\Filters::escapeHtml($prehled['pocet_znamek_jmeno_graf3'][$i], ENT_NOQUOTES) ?></span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss(round(100*$prehled['pocet_znamek_graf3'][$i]/$prehled['celkovy_pocet_znamek_graf3'])), ENT_COMPAT) ?>%;">
                          <span class="sr-only">100% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?php echo Latte\Runtime\Filters::escapeHtml($prehled['pocet_znamek_graf3'][$i], ENT_NOQUOTES) ?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                    
<?php } ?>
                      
<?php if ($prehled['pocet_znamek_graf3_zbytek']!=0 && $i+1==$prehled['pocet_znamek_graf3_i']) { ?>
                       <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Zbytek</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss(round(100*$prehled['pocet_znamek_graf3_zbytek']/$prehled['celkovy_pocet_znamek_graf3'])), ENT_COMPAT) ?>%;">
                          <span class="sr-only">100% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?php echo Latte\Runtime\Filters::escapeHtml($prehled['pocet_znamek_graf3_zbytek'], ENT_NOQUOTES) ?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                      
<?php } ?>
                      
                      
                    
<?php } ?>
                 
                    
                    
                </div>
              </div>
            </div>

          </div>


          
        </div>
        <!-- /page content -->
        
     


   

    <!-- Flot -->
    <script>
      $(document).ready(function() {
        var data1 = [
<?php for ($i = 1; $i <= $prehled['pocet_dnu_graf']; $i++) { ?>
          [gd(<?php echo Latte\Runtime\Filters::escapeJs($prehled['rok_graf']) ?>
, <?php echo Latte\Runtime\Filters::escapeJs($prehled['mesic_graf']) ?>, <?php echo Latte\Runtime\Filters::escapeJs($i) ?>
), <?php echo Latte\Runtime\Filters::escapeJs($prehled['data_graf'][$i]) ?>],
<?php } ?>
          
          
        ];

       
        $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
          data1
        ], {
          series: {
            lines: {
              show: false,
              fill: true
            },
            splines: {
              show: true,
              tension: 0.4,
              lineWidth: 1,
              fill: 0.4
            },
            points: {
              radius: 0,
              show: true
            },
            shadowSize: 2
          },
          grid: {
            verticalLines: true,
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#fff'
          },
          colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
          xaxis: {
            tickColor: "rgba(51, 51, 51, 0.06)",
            mode: "time",
            tickSize: [1, "day"],
            //tickLength: 10,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10
          },
          yaxis: {
            ticks: 8,
            tickColor: "rgba(51, 51, 51, 0.06)",
          },
          tooltip: false
        });

        function gd(year, month, day) {
          return new Date(year, month - 1, day).getTime();
        }
      });
    </script>
    <!-- /Flot -->

    <!-- JQVMap -->
    <script>
      $(document).ready(function(){
        $('#world-map-gdp').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#666666',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#E6F2F0', '#149B7E'],
            normalizeFunction: 'polynomial'
        });
      });
    </script>
    <!-- /JQVMap -->

    <!-- Skycons -->
    <script>
      $(document).ready(function() {
        var icons = new Skycons({
            "color": "#73879C"
          }),
          list = [
            "clear-day", "clear-night", "partly-cloudy-day",
            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
            "fog"
          ],
          i;

        for (i = list.length; i--;)
          icons.set(list[i], list[i]);

        icons.play();
      });
    </script>
    <!-- /Skycons -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas1"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
<?php for ($i=1;$i<$prehled['pocet_znamek_graf2_i'];$i++) { ?>
              <?php echo Latte\Runtime\Filters::escapeJs($prehled['pocet_znamek_jmeno_graf2'][$i]) ?>+". třída",
<?php } ?>
            ],
            datasets: [{
              data: <?php for ($i=1;$i<$prehled['pocet_znamek_graf2_i'];$i++) { ?>

              <?php if ($i==1) { ?>[<?php } ?>

                <?php echo Latte\Runtime\Filters::escapeJs(round(100*$prehled['pocet_znamek_graf2'][$i]/$prehled['celkovy_pocet_znamek_graf2'])) ?>,
                <?php if ($i+1==$prehled['pocet_znamek_graf2_i']) { ?>]<?php } ?>

                <?php } ?>,
              backgroundColor: [
<?php for ($i=1;$i<$prehled['pocet_znamek_graf2_i'];$i++) { ?>
              
                "#"+<?php echo Latte\Runtime\Filters::escapeJs($prehled['pocet_znamek_graf2_barva'][$i]) ?>,
                
<?php } ?>
                        
                       
               
              ]
            
            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->
    
    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->

    <!-- gauge.js -->
    <script>
      var opts = {
          lines: 12,
          angle: 0,
          lineWidth: 0.4,
          pointer: {
              length: 0.75,
              strokeWidth: 0.042,
              color: '#1D212A'
          },
          limitMax: 'false',
          colorStart: '#1ABC9C',
          colorStop: '#1ABC9C',
          strokeColor: '#F0F3F3',
          generateGradient: true
      };
      var target = document.getElementById('foo'),
          gauge = new Gauge(target).setOptions(opts);

      gauge.maxValue = 6000;
      gauge.animationSpeed = 32;
      gauge.set(3200);
      gauge.setTextField(document.getElementById("gauge-text"));
    </script>
    <!-- /gauge.js --><?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 