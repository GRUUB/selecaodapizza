<?php
	$user = "root";
	$pass = "";
	
	try {
		$pdo = new PDO("mysql:host=localhost;dbname=selecaodapizza", $user, $pass);
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>