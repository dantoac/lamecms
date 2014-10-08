<?php
session_start();
//error_reporting(null);
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime; 
require ('Core/config.php');

include 'GUI/portada.php';
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$endtime = $mtime;
$totaltime = ($endtime - $starttime);
echo "Esta página se creo en ".$totaltime." segundos."; 
?>
