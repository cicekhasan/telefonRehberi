<?php
require 'fonksiyonlar.php';

if ($_GET['islem']=='sil') {
	require 'ayar.php';
	$sil = $vt->query("DELETE FROM rehber WHERE id=".$_GET['id']."");
	header('Location:index.php');
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<title>Rehber 2020</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/renk.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript">
		function silOnayla(){ return confirm("Silmek istediğine emin misin!"); }
	</script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light camurcun-1">
	  <a class="navbar-brand" href="#" style="text-height: 100px !important;">
	    <i class="fa fa-phone-square-alt camurcun-6t d-inline-block align-top" style="width: 50px; height: 50px;"></i>
	    <h1 class="d-inline-block align-top">Rehber 2020</h1>
	  </a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item <?php echo ($_GET['sayfa']=='anasayfa') ? "active" : null; ?>">
	        <a class="nav-link" href="?sayfa=anasayfa">Anasayfa <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item <?php echo ($_GET['sayfa']=='hakkimda') ? "active" : null; ?>">
	        <a class="nav-link" href="?sayfa=hakkimda">Hakkımda</a>
	      </li>
	    </ul>
	  </div>
	</nav>	