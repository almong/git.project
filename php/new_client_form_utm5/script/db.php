<?php
    $host = 'localhost';
    $database = 'UTM5';
    $user = 'portal';
    $password = 'ghjdjlybr';

$sql = "SELECT `AUTO_INCREMENT`
        FROM  INFORMATION_SCHEMA.TABLES
        WHERE TABLE_SCHEMA = 'UTM5'
        AND   TABLE_NAME   = 'accounts'";

$link_db = mysql_connect($host, $user, $password, $database);
    if (!$link_db){
        echo "Ошибка подключения к базе данных" . mysql_error();
        exit;
    }  
    $query_ai = mysql_query($sql);
    if ($ai = mysql_fetch_assoc($query_ai)) {
        echo $ai['AUTO_INCREMENT'];
    }
    mysql_close($link_db);