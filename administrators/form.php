<!DOCTYPE html>
<html>
    
    <head>
        <title>Forms</title>
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
                <li>
                    <a href="stats.php"><i class="icon-chevron-right"></i> Статистика</a>
                </li>
                <li class="active">
                    <a href="form.php"><i class="icon-chevron-right"></i> Администрирование</a>
                </li>
                </li>
                    </ul>
                </div>
                <!--/span-->
                <div class="span9" id="content">
                      <!-- morris stacked chart -->
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Сервис</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form action="Serv.php" method="post" class="form-horizontal">
                                      <fieldset>
                                        <legend>Сервисный интервал</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Vin код </label>
                                          <div class="controls">
                                              <?php
                                                include ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь                                     
                                                $result = $mysqli->query('select vin From avto');
                                                echo '<input type="text" class="span6" id="typeahead" name ="vin"  data-provide="typeahead" data-items="4" data-source=\'[';                                                
                                                $i=0;
                                                while ($row=$result->fetch_array()){

                                                    if($i==0){
                                                echo '"'.$row[0].'"';}
                                                else {
                                                echo ',"'.$row[0].'"';}
                                                $i++;
                                                }

                                            echo "]'>";
                                            ?>
                                            <p class="help-block">Vin код сервисного авто</p>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="date01">Интервал</label>
                                          <div class="controls">
                                            <input type="text" class="input-xlarge datepicker" name ="data" id="date01" value="10/26/2017">
                                            <p class="help-block">Дата следующего сервисного обслуживания</p>
                                          </div>
                                        </div>
                                        
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary">Сохранить</button>
                                          <button type="reset" class="btn">Очистить</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Пользователи</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form action="UserA.php" method="post" class="form-horizontal">
                                      <fieldset>
                                        <legend>Активация пользователя</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Номер паспорта </label>
                                          <div class="controls">
                                              <?php
                                                include ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь                                     
                                                $result = $mysqli->query('select Serija_nomer_pass from users');
                                                echo '<input type="text" class="span6" id="typeahead" name ="snp"  data-provide="typeahead" data-items="4" data-source=\'[';                                                
                                                $i=0;
                                                while ($row=$result->fetch_array()){

                                                    if($i==0){
                                                echo '"'.$row[0].'"';}
                                                else {
                                                echo ',"'.$row[0].'"';}
                                                $i++;
                                                }

                                            echo "]'>";
                                            ?>
                                          </div>
                                        </div>      
                                        
                                        
                                        <div class="control-group">
                                        <label class="control-label" for="active">Активирован</label>
                                        <div class="controls">
                                                <div class="input-group">
                                                    <div id="radioBtn" class="btn-group">
                                                        <a class="btn btn-primary" data-toggle="active" data-title="1">Да</a>
                                                        <a class="btn" data-toggle="active" data-title="0">Нет</a>
                                                    </div>
                                                    <input type="hidden" name="active" id="active" value="1">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary">Сохранить</button>
                                          <button type="reset" class="btn">Очистить</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>


                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Авто</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form action="avto.php" method="post" class="form-horizontal">
                                      <fieldset>
                                        <legend>Добавление авто</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="typeaheadVin">Vin </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeaheadVin" name ="Vin">
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Марка </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead" name="marka" data-provide="typeahead" data-items="4" data-source='["Vw","Ford","Peugeot","BMW","Fiat"]'>
                                          </div>
                                        </div>   

                                        <div class="control-group">
                                          <label class="control-label" for="typeaheadМодель">Модель </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeaheadМодельт" name ="Model">
                                          </div>
                                        </div> 

                                        <div class="control-group">
                                          <label class="control-label" for="typeaheadЦена">Цена </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeaheadЦена" name ="Cena">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeaheadЦенаА">Цена аренды</label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeaheadЦенаА" name ="CenaA">
                                          </div>
                                        </div>   
                                        <div class="control-group">
                                          <label class="control-label" for="typeaheadЦенаА">Фото авто</label>
                                          <div class="controls">
                                          <input name="userfile" type="file" accept="image/jpeg,image/png,image/gif">  
                                          </div>
                                        </div>   
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary">Сохранить</button>
                                          <button type="reset" class="btn">Очистить</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                </div>
            </div>
        </div>
        <!--/.fluid-container-->
        <link href="vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/jquery.uniform.min.js"></script>
        <script src="vendors/chosen.jquery.min.js"></script>
        <script src="vendors/bootstrap-datepicker.js"></script>

        <script src="vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

	<script type="text/javascript" src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="assets/form-validation.js"></script>
        
	<script src="assets/scripts.js"></script>
        <script>

	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
	
    $('#radioBtn a').on('click', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', sel);
    
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('btn btn-primary').addClass('btn');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('btn').addClass('btn btn-primary');
})

        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
        </script>
    </body>

</html>