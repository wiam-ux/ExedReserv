<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=calendar;charset=utf8mb4', 'root', 'wiam');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
