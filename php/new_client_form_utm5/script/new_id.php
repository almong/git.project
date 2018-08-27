<?php
    $host = '172.16.1.52';
    $database = 'UTM5';
    $user = 'portal';
    $password = 'portal';

$sql = "SELECT `AUTO_INCREMENT`
        FROM  INFORMATION_SCHEMA.TABLES
        WHERE TABLE_SCHEMA = 'UTM5'
        AND   TABLE_NAME   = 'accounts'";

$link_db = mysql_connect($host, $user, $password, $database);
    if (!$link_db){
        echo "Ошибка подключения к базе данных " . mysql_error();
        exit;
    }

    $query_ai = mysql_query($sql, $link_db);
    $ai = mysql_fetch_array($query_ai);
    print $ai['AUTO_INCREMENT'];
    
    mysql_close($link_db);