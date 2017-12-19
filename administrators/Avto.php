<?php
    $ser = $_SERVER['HTTP_REFERER'];    
    
if (isset($_POST['Vin'])) { $Vin = $_POST['Vin']; if ($Vin == '') { unset($Vin);} } //заносим введенный пользователем логин в переменную $snp, если он пустой, то уничтожаем переменную
if (isset($_POST['marka'])) { $marka = $_POST['marka']; if ($marka == '') { unset($marka);} } //заносим введенный пользователем логин в переменную $snp, если он пустой, то уничтожаем переменную
if (isset($_POST['Model'])) { $Model = $_POST['Model']; if ($Model == '') { unset($Model);} } //заносим введенный пользователем логин в переменную $snp, если он пустой, то уничтожаем переменную
if (isset($_POST['Cena'])) { $Cena = $_POST['Cena']; if ($Cena == '') { unset($Cena);} } //заносим введенный пользователем логин в переменную $snp, если он пустой, то уничтожаем переменную
if (isset($_POST['CenaA'])) { $CenaA = $_POST['CenaA']; if ($CenaA == '') { unset($CenaA);} } //заносим введенный пользователем логин в переменную $snp, если он пустой, то уничтожаем переменную
if (isset($_POST['userfile'])) { $userfile = $_POST['userfile']; if ($userfile == '') { unset($userfile);} } //заносим введенный пользователем логин в переменную $snp, если он пустой, то уничтожаем переменную
//заносим введенный пользователем пароль в переменную $data, если он пустой, то уничтожаем переменную
if (empty($Vin) and empty($Marka) and empty($Model) and empty($CenaA) and empty($userfile)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!  <a href=".$ser."> Вернутся назад</a>");
    }
// подключаемся к базе
    include ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 $mysqli->query("INSERT INTO `avtoprocat`.`avto` (`vin`, `marka`, `model`, `cena`, `сena_arendy`, foto) VALUES ('".$Vin."', '".$marka."', '".$Model."', '$Cena', '$CenaA', '".$userfile."');",$db);
 header("Location: $ser");// возврат на главную
 
    ?>