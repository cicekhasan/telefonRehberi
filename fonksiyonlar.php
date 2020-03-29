<?php

function cepTelefonu($x, $y)
{
	$gelen = explode($x, $y);
	echo $gelen['0']."(".$gelen['1'].") ".$gelen['2'];
}

function veriUret($karakterSayisi=32, $karakterler='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
{
	for ($i = 0, $z = strlen($a = $karakterler)-1, $s = $a{rand(0,$z)}, $i = 1; $i != $karakterSayisi; $x = rand(0,$z), $s .= $a{$x}, $s = ($s{$i} == $s{$i-1} ? substr($s,0,-1) : $s), $i=strlen($s));
		return $s;
}