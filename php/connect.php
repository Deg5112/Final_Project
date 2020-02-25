<?php
$url = getenv('JAWSDB_URL');

$user = parse_url($url, PHP_URL_USER);
$pass = parse_url($url, PHP_URL_PASS);
$host = parse_url($url, PHP_URL_HOST);
$db = explode('/', parse_url($url, PHP_URL_PATH))[1];

$conn = mysqli_connect($host, $user, $pass, $db);
