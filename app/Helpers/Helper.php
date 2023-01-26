<?php

use Illuminate\Support\Facades\DB;

function changeDbConnection($dbName, $userName, $password)
{
    config(['database.connections.mysql' => [
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => $dbName,
        'username'  => $userName,
        'password'  => $password,
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'strict'    => false,
    ]]);
    DB::purge('mysql');
    DB::reconnect('mysql');
}