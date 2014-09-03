
	
	
		<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Počet známek dle předmětů'
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
                $sql_znamky_z = "SELECT z.ucitel ,count(znamka) as `znamka_s`, p.nazev as `nazev` FROM `zak_znam` as `z` 
join predmety as `p` on predmety_predmet_id=p.predmet_id
WHERE ucitel='".$_SESSION['id']."'
GROUP BY ucitel, nazev"; 

$sql_pocet_znamek="SELECT count(ucitel) as `pocet_znamek` FROM zak_znam WHERE ucitel='".$_SESSION['id']."'";

$q_pocet_znamek=mysql_query($sql_pocet_znamek);
$zaznam_pocet_znamek=mysql_fetch_array($q_pocet_znamek);
$pocet_znamek=($zaznam_pocet_znamek['pocet_znamek']/100);
 $q_znamky_z=mysql_query($sql_znamky_z);
                while($zaznam_znamky_z=mysql_fetch_array($q_znamky_z)){
                  $proc_znamek=$zaznam_znamky_z['znamka_s'];
                  $procenta_znamek=($proc_znamek*100)/$pocet_znamek;
                  $predmet=$zaznam_znamky_z['nazev'];
                  echo  "['$predmet',   $procenta_znamek],";
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

	

