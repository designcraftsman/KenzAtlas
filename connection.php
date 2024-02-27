<?php
try
{
	$db = new PDO('mysql:host=localhost;dbname=kenzltry_kenzatlas;charset=utf8', 'kenzltry_mariamFayz', 'kenzatlas2024');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>