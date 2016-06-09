<?php
	$codAuth = $_GET['codAuth'];
	$redirect = "https://gruub.com.br/selecaodapizza/confirmEvent.php?codAuth=$codAuth";
	header("location:$redirect");
?>