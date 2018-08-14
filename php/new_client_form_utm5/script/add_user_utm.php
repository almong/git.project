<?php
include_once '../vendor/k-shym/urfa-client/init.php';

$urfa = URFAClient::init(array(
    'login'    => 'init',
    'password' => 'init',
    'address'  => 'localhost',
    'protocol' => 'tls',
));

$result = $urfa->rpcf_add_user_new(array(
    'login'=>'tes222t',
    'password'=>'test222',
));