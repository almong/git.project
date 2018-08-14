<?php
$d_num = "59";
$file = fopen("doc/number_doc", "w");
$d_num = $d_num + 1;
fwrite($file, $d_num); 
fclose($file);
echo $d_num;
