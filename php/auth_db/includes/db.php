<?php
    require "./libs/rb.php";

    R::setup( 'mysql:host=localhost;dbname=users',
    'root', '1234' );

    session_start();
