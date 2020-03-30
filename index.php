<?php 
session_start();

$sayfa = $_GET['sayfa'];


$arrSayfalar = array();
$arrSayfalar[] = 'anasayfa';
$arrSayfalar[] = 'hakkimda';
$arrSayfalar[] = 'tahta';
$arrSayfalar[] = 'yeniKayit';
$arrSayfalar[] = 'goster';
$arrSayfalar[] = 'duzenle';

in_array($sayfa, $arrSayfalar) ? $goster = $sayfa : $goster = 'anasayfa' ;

include '_ust.php';
include $goster.'.php';
include '_alt.php';

