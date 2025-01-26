<?php

$host = 'pg';
$db = 'studs';
$db_user = 's338859';
$db_password = 'TmZobYLWlDC5imhc'; 

$dsn = "pgsql:host=$host;port=5432;dbname=$db;";

try {
	$pdo = new PDO($dsn, $db_user, $db_password, [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false
	]);
} catch (PDOException $e) {
	die("Ошибка подключения к базе данных: " . $e->getMessage());
}

?>