<?php
$db_name = 'dados';
$db_host = 'host.docker.internal';
$db_user = 'root';
$db_pass = 'root';

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);