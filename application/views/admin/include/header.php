<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $site_name; ?></title>
	<link rel="stylesheet" href="<?php echo site_url('css/style_admin.css') ?> ">
	<link href="<?php echo site_url('css/datepicker.css'); ?>" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo site_url() . 'assets/images/favicon.ico'; ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo site_url() . 'assets/images/favicon.ico'; ?>" type="image/x-icon">

	<!-- jquery -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<!--jquery ui + sortable-->
	<?php if(isset($highcharts) && $highcharts === TRUE): ?>
	<script src="<?php echo site_url() . 'assets/highcharts/js/highcharts.js'; ?>"></script>
	<script src="<?php echo site_url() . 'assets/highcharts/highcharts_template.js' ?>"></script>
	<script>
		$(function () {
		    $('#charts_browser').highcharts({
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: 1,//null,
		            plotShadow: false
		        },
		        title: {
		            text: 'Najczęściej używane przeglądarki przez odwiedzających'
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		        },
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: true,
		                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                    style: {
		                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                    }
		                }
		            }
		        },
		        series: [{
		            type: 'pie',
		            name: 'Browser share',
		            data: [
				                ['Firefox',   <?php echo $browser_usage['Firefox']; ?>],
				                ['IE',       <?php echo $browser_usage['IE']; ?>],
				                {
				                    name: 'Chrome',
				                    y: <?php echo $browser_usage['Chrome']; ?>,
				                    sliced: true,
				                    selected: true
				                },
				                ['Safari',    <?php echo $browser_usage['Safari']; ?>],
				                ['Opera',     <?php echo $browser_usage['Opera']; ?>],
				                ['Mobile',     <?php echo $browser_usage['Mobile']; ?>],
				                ['Inne',   <?php echo $browser_usage['Inne']; ?>]
				            ]
		        }]
		    });
		});
		
		
	</script>
	<script>
		$(function () {
		    $('#charts_system').highcharts({
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: 1,//null,
		            plotShadow: false
		        },
		        title: {
		            text: 'Najczęściej używane systemy przez odwiedzających'
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		        },
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: true,
		                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                    style: {
		                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                    }
		                }
		            }
		        },
		        series: [{
		            type: 'pie',
		            name: 'OS share',
		            data: [
				                ['Windows 7',   <?php echo $system_usage['Windows 7']; ?>],
				                ['Windows 8',       <?php echo $system_usage['Windows 8']; ?>],
				                {
				                    name: 'Windows 8.1',
				                    y: <?php echo $system_usage['Windows 8.1']; ?>,
				                    sliced: true,
				                    selected: true
				                },
				                ['Windows Vista',    <?php echo $system_usage['Windows Vista']; ?>],
				                ['Windows XP',     <?php echo $system_usage['Windows XP']; ?>],
				                ['Windows Phone',     <?php echo $system_usage['Windows Phone']; ?>],
				                ['Android',     <?php echo $system_usage['Android']; ?>],
				                ['iOS',     <?php echo $system_usage['iOS']; ?>],
				                ['Mac OSX',     <?php echo $system_usage['mac_osx']; ?>],
				                ['Linux',     <?php echo $system_usage['linux']; ?>],
				                ['Macintosh',     <?php echo $system_usage['macintosh']; ?>],
				                ['Debian',     <?php echo $system_usage['debian']; ?>],
				                ['Inne',   <?php echo $system_usage['Inne']; ?>]
				            ]
		        }]
		    });
		});
		Highcharts.setOptions(Highcharts.theme);
	</script>
	<script>
		$(function () {
		    $('#is_stat').highcharts({
		        chart: {
		            type: 'column'
		        },
		        title: {
		            text: 'Ilość sprzedanych przedmiotów'
		        },
		        xAxis: {
		            type: 'category',
		            labels: {
		                rotation: -45,
		                style: {
		                    fontSize: '13px',
		                    fontFamily: 'Verdana, sans-serif'
		                }
		            }
		        },
		        yAxis: {
		            min: 0,
		            title: {
		                text: 'Ilość'
		            }
		        },
		        legend: {
		            enabled: false
		        },
		        tooltip: {
		            pointFormat: 'Sztuk : <b>{point.y}</b>'
		        },
		        series: [{
		            name: 'Sztuk',
		            data: [
		            	<?php foreach($sales_items as $sales): ?>
		                ['<?php echo $sales['name']; ?>', <?php echo $sales['count']; ?>],
		                <?php endforeach; ?>
		            ],
		            dataLabels: {
		                enabled: true,
		                rotation: 0,
		                color: '#FFFFFF',
		                align: 'center',
		                format: '{point.y}', // one decimal
		                y: 20, // 10 pixels down from the top
		                style: {
		                    fontSize: '13px',
		                    fontFamily: 'Verdana, sans-serif'
		                }
		            }
		        }]
		    });
		});
	</script>
	<?php endif; ?>
	<?php if(isset($sortable) && $sortable === TRUE): ?>
	<script src="<?php echo site_url() . 'assets/js/jquery-ui-1.9.1.custom.min.js'; ?>"></script>
	<script src="<?php echo site_url() . 'assets/js/jquery.mjs.nestedSortable.js'; ?>"></script>
	<?php endif; ?>
</head>
<body>