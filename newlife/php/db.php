<?php

/*$pdo = new PDO('mysql:dbname=helpWork;host=localhost','root','friends92');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);*/

try
{
	 $pdo = new PDO('mysql:host=localhost;dbname=helpWork;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

