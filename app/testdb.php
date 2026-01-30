<?php
	$host = getenv('DB_HOST');
	$db = getenv('DB_DATABASE');
	$user = getenv('DB_USERNAME');
	$pass = getenv('DB_PASSWORD');

	try {
		$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
		echo "Connexion ok\n";
	} catch (PDOException $e) {
		echo "Erreur : ". $e->getMessage();
	}
?>
