<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Admin Home Page</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
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
                            <li class="active">
                                <a href="index.php"><i class="icon-chevron-right"></i> Главная</a>
                            </li>
                            <li>
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

                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Statistics</div>
                            </div>
                            <div class="block-content collapse in">
                                <?php
                                include ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь                                     
                                $Vsego = $mysqli->query('Select Count(vin) From avto');
                                $VsegoNeNaHody = $mysqli->query('Select Count(vin) From avto Where Na_hody = 0');
                                $Vsegozan = $mysqli->query('Select Count(vin) From avto Where Svobodna = 0');
                                $Vsegodost = $mysqli->query('Select Count(vin) From avto Where Svobodna = 1 AND Na_hody = 1 ');
                                
                                $Vsego_=$Vsego->fetch_array();
                                $remont=$VsegoNeNaHody->fetch_array();
                                $zanaty=$Vsegozan->fetch_array();
                                $dost=$Vsegodost->fetch_array();
                                
                                $Vsego_ = $Vsego_[0];
                                $dost= $dost[0];
                                $remont=$remont[0];
                                $zanaty=$zanaty[0];


                                echo'
                                <div class="span3">
                                    <div class="chart"data-percent="'.@($dost/$Vsego_*100).'">'.@($dost/$Vsego_*100).'%</div>
                                    <div class="chart-bottom-heading"><span class="label label-info">Машин доступно</span>

                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="chart" data-percent="'.@($remont/$Vsego_*100).'">'.@($remont/$Vsego_*100).'%</div>
                                    <div class="chart-bottom-heading"><span class="label label-info">В ремонте</span>

                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="chart" data-percent="'.@($zanaty/$Vsego_*100).'">'.@($zanaty/$Vsego_*100).'%</div>
                                    <div class="chart-bottom-heading"><span class="label label-info">В аренде</span>';
                                ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Неактивированные пользователи</div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>№ Паспорта</th>
                                                <th>ФИО</th>
                                                <th>Логин</th>
                                                <th>Телефон</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                    include ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь                                     
                                    $result = $mysqli->query("select * from users where Aktiv = 0 LIMIT 10;");
                                    while ($row=$result->fetch_array())
                                    {echo'
                                            <tr>
                                                <td>'.$row['Serija_nomer_pass'].'</td>
                                                <td>'.$row['FIO'].'</td>
                                                <td>'.$row['login'].'</td>
                                                <td>'.$row['Telephone'].'</td>
                                            </tr>';}
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Последние обслуженные</div>

                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Vin</th>
                                                <th>Марка</th>
                                                <th>Модель</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        include ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь                                     
                                        $result = $mysqli->query("SELECT s.Vin, a.marka, a.model
                                        FROM Servises s
                                        INNER JOIN avto a ON s.Vin = a.vin LIMIT 10;");
                                        while ($row=$result->fetch_array())
                                        {echo'
                                                <tr>
                                                    <td>'.$row['Vin'].'</td>
                                                    <td>'.$row['marka'].'</td>
                                                    <td>'.$row['model'].'</td>
                                                </tr>';}
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                    </div>
                   
                    
                </div>
            </div>
            <hr>
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>

</html>