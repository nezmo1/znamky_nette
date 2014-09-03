   <?php
   
   $sql_nastaveni_global="SELECT concat(titul,' ',prijmeni,' ',jmeno) as `cele_jmeno`, id FROM user

WHERE id='$ucitel'
ORDER BY prijmeni";
$q_nastaveni_global=mysql_query($sql_nastaveni_global);
$zaznam=mysql_fetch_array($q_nastaveni_global);   
  $jmeno_ucitele=$zaznam['cele_jmeno'];
  if($ucitel=="%"){
  $jmeno_ucitele="Všichni učitelé";
  }
   ?>
	           
	
		<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Počet známek dle předmětů <?php echo "- ".$jmeno_ucitele; ?>'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Procentuální zastoupení',
                data: [
                <?php
                

$q_pocet_znamek=mysql_query($sql_pocet_znamek);
$zaznam_pocet_znamek=mysql_fetch_array($q_pocet_znamek);
$pocet_znamek=($zaznam_pocet_znamek['pocet_znamek']/100);
 $q_znamky_z=mysql_query($sql_znamky_z);
                while($zaznam_znamky_z=mysql_fetch_array($q_znamky_z)){
                  $proc_znamek=$zaznam_znamky_z['znamka_s'];
                  $procenta_znamek=($proc_znamek*100)/$pocet_znamek;
                  $ucitel_cele_jmeno=$zaznam_znamky_z['cele_jmeno'];
                  $predmet=$zaznam_znamky_z['nazev'];
                  echo  "['".$predmet." - ".$ucitel_cele_jmeno." '  ,$procenta_znamek], ";
                  }
                  /*  ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]    */
                    
                  ?>  
                ]
            }]
        });
    });
    

		</script>
	 
	
<script src="./grafy/js/highcharts.js"></script>
<script src="./grafy/js/modules/exporting.js"></script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

	

