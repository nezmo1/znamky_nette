<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Souhrn dle známek'
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
                $sql_pocet_znamek = " SELECT COUNT( znamka ) as `pocet` FROM zak_znam
where ucitel='".$_SESSION['id']."'
";
 $q_pocet_znamek=mysql_query($sql_pocet_znamek);
$pocet=mysql_fetch_array($q_pocet_znamek);
 $pocet_znamek=$pocet['pocet'];
 
  $sql_pocet_dle_znamek = " SELECT znamka, COUNT( znamka ) as `pocet_dle_znamek` FROM zak_znam
where ucitel='".$_SESSION['id']."'
GROUP BY znamka
ORDER BY COUNT(znamka) DESC";
 $q_pocet_dle_znamek=mysql_query($sql_pocet_dle_znamek);
                 $pom_ostatni=0;
                while($zaznam_pocet_dle_znamek=mysql_fetch_array($q_pocet_dle_znamek)){
                  $procent=round(($zaznam_pocet_dle_znamek['pocet_dle_znamek']*100)/$pocet_znamek,2);
                  $znamka=$zaznam_pocet_dle_znamek['znamka'];
                 
                 if($procent>3){
                  echo  "['$znamka',   $procent],";
                 
                 }
                 else
                 {
                 $pom_ostatni=$pom_ostatni+$procent;
                 }
                 
                  }
                 if($pom_ostatni!=0){
                 echo  "['Ostatní',   $pom_ostatni],";
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
	</head>
	<body>  
<script src="./grafy/js/highcharts.js"></script>
<script src="./grafy/js/modules/exporting.js"></script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
