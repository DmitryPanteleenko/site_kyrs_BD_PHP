<!DOCTYPE html>
<html>
    
    <head>
        <title>Statistics</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Admin Panel</a>
                    
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li>
                            <a href="index.php"><i class="icon-chevron-right"></i> Главная</a>
                        </li>
                        <li class="active">
                            <a href="stats.php"><i class="icon-chevron-right"></i> Статистика</a>
                        </li>
                        <li>
                            <a href="form.php"><i class="icon-chevron-right"></i> Администрирование</a>
                        </li>
                        </li>
                    </ul>
                </div>
                <!--/span-->
                <div class="span9" id="content">
                     
                    <!-- morris graph chart -->
                    <div class="row-fluid section">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">График доходов по месяцам <small>В бел. Руб.</small></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <div id="hero-graph" style="height: 230px;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                    <!-- morris bar & donut charts -->
                    <div class="row-fluid section">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Самые популярные авто</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span6 chart">
                                    <div id="hero-bar" style="height: 250px;"></div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                    
                </div>
            </div>
        </div>
        <!--/.fluid-container-->
        <link rel="stylesheet" href="vendors/morris/morris.css">


        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="vendors/jquery.knob.js"></script>
        <script src="vendors/raphael-min.js"></script>
        <script src="vendors/morris/morris.min.js"></script>

        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/flot/jquery.flot.js"></script>
        <script src="vendors/flot/jquery.flot.categories.js"></script>
        <script src="vendors/flot/jquery.flot.pie.js"></script>
        <script src="vendors/flot/jquery.flot.time.js"></script>
        <script src="vendors/flot/jquery.flot.stack.js"></script>
        <script src="vendors/flot/jquery.flot.resize.js"></script>

        <script src="assets/scripts.js"></script>

        <?php
        include ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь                                     
        $result = $mysqli->query('select a.model,COUNT(d.Vin_avto) from Dogovora d INNER JOIN avto a ON d.Vin_avto = a.vin GROUP BY a.model');
        echo "<script>        
        // Morris Bar Chart
        
        Morris.Bar({
            element: 'hero-bar',
            data: [";
            while ($row=$result->fetch_array())
            {
            echo"
                {device: '$row[0]', заказов: $row[1]},";
            }
           echo" ],
            xkey: 'device',
            ykeys: ['заказов'],
            labels: ['заказов'],
            barRatio: 0.4,
            xLabelMargin: 10,
            hideHover: 'auto',
            barColors: ['#3d88ba']
        });";
        ?>

  
        function labelFormatter(label, series) {
            return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
        }
        </script>
        <?php
        include ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь                                     
        $result = $mysqli->query('select DATE_FORMAT(data_time_konec,"%Y-%m") AS da,Sum(Stoimost) from Dogovora  GROUP BY da');
        echo' <script>        
        // Morris Line Chart
        var tax_data = [';
        while ($row=$result->fetch_array())
{
    echo'
            {"period": "'.$row[0].'", "Summ": '.$row[1].'},';}
        echo '];
        Morris.Line({
            element: "hero-graph",
            data: tax_data,
            xkey: "period",
            xLabels: "month",
            ykeys: ["Summ"],
            labels: ["Summ"]
        }); </script>';
        ?>


    </body>

</html>