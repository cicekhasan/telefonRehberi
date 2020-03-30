<?php 

try{
	if( isset($_POST["yeni"]) ) {
	require 'ayar.php';

	//echo "<pre>";
	//print_r($_POST);
	//print_r($_FILES);
	//echo "</pre>";


	for ($i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')-1, $s = $a{rand(0,$z)}, $i = 1; $i != 32; $x = rand(0,$z), $s .= $a{$x}, $s = ($s{$i} == $s{$i-1} ? substr($s,0,-1) : $s), $i=strlen($s)); 

	// RESİM EKLEME GÜNCELLEME
	$dosya     = "uploads/"; // Dosyanın yükleneceği dizin
	$tmp_name  = $_FILES['resim']['tmp_name']; // Dosyanın geçici gerçek adı
	$name      = $_FILES['resim']['name']; // Dosyanın adı
	$boyut     = $_FILES['resim']['size']; // Boyutu
	$tip       = $_FILES['resim']['type']; // Tipi
	$uzanti    = substr($name,-4,4); // Uzantısı
	$rastgele1 = rand(10000,50000); // Rastgele sayı üretiyor
	$rastgele2 = rand(10000,50000); // Rastgele sayı üretiyor
	$resimAd   = $s.$uzanti; // Resim Adı oluşuyor

		if (strlen(!isset($name))) {
			echo '
			<div class="container">
				<div class="row">
					<div class="alert alert-danger col-md-8 offset-2 mt-3" role="alert">
					  Resim seçmeniz gerekmektedir!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				</div>
			</div>
			';
			exit;
		}

		if ($boyut > (1024*1024*3)) {
			echo '
			<div class="container">
				<div class="row">
					<div class="alert alert-danger col-md-8 offset-2 mt-3" role="alert">
					  Dosya boyutu çok 3.14 MB den büyük olamaz!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				</div>
			</div>
			';
			exit;
		}

		if ($tip != 'image/jpeg' && $tip != 'image/png' && $uzanti != '.jpg') {
			echo '
			<div class="container">
				<div class="row">
					<div class="alert alert-danger col-md-8 offset-2 mt-3" role="alert">
					  Yalnızca "jpeg veya png formatında olabilir!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				</div>
			</div>
			';
			exit;
		}


	$yeniEkle = $vt->prepare('INSERT INTO rehber (
		adi_soyadi,
	  grubu,
	  unvani,
	  cep_telefonu,
	  is_telefonu,
	  is_adresi,
	  is_ilce,
	  is_sehir,
	  ev_adresi,
	  ev_ilce,
	  ev_sehir,
	  e_posta,
	  resim_adi,
	  cinsiyeti) 
	  VALUES (
	  :adi_soyadi,
	  :grubu,
	  :unvani,
	  :cep_telefonu,
	  :is_telefonu,
	  :is_adresi,
	  :is_ilce,
	  :is_sehir,
	  :ev_adresi,
	  :ev_ilce,
	  :ev_sehir,
	  :e_posta,
	  :resim_adi,
	  :cinsiyeti)');

	$yeniEkle->bindValue('adi_soyadi',   $_POST['adi_soyadi'],   PDO::PARAM_STR);
	$yeniEkle->bindValue('grubu',        $_POST['grubu'],        PDO::PARAM_STR);
	$yeniEkle->bindValue('unvani',       $_POST['unvani'],       PDO::PARAM_STR);
	$yeniEkle->bindValue('cep_telefonu', $_POST['cep_telefonu'], PDO::PARAM_STR);
	$yeniEkle->bindValue('is_telefonu',  $_POST['is_telefonu'],  PDO::PARAM_STR);
	$yeniEkle->bindValue('is_adresi',    $_POST['is_adresi'],    PDO::PARAM_STR);
	$yeniEkle->bindValue('is_ilce',      $_POST['is_ilce'],      PDO::PARAM_STR);
	$yeniEkle->bindValue('is_sehir',     $_POST['is_sehir'],     PDO::PARAM_STR);
	$yeniEkle->bindValue('ev_adresi',    $_POST['ev_adresi'],    PDO::PARAM_STR);
	$yeniEkle->bindValue('ev_ilce',      $_POST['ev_ilce'],      PDO::PARAM_STR);
	$yeniEkle->bindValue('ev_sehir',     $_POST['ev_sehir'],     PDO::PARAM_STR);
	$yeniEkle->bindValue('e_posta',      $_POST['e_posta'],      PDO::PARAM_STR);
	$yeniEkle->bindValue('resim_adi',    $resimAd,               PDO::PARAM_STR);
	$yeniEkle->bindValue('cinsiyeti',        $_POST['cinsiyeti'],        PDO::PARAM_STR);
	$sonuc = $yeniEkle->execute();

	move_uploaded_file($tmp_name, "$dosya/$resimAd");

	echo ($sonuc==1) ? "Yüklenmiş olması lazım!" : "Yüklenemedi";
	header('Location:index.php');
	}
}
catch (PDOException $e) {
    echo "Hata kodu: " . $e->getCode() . "<br> Hata mesajı: " . $e->getMessage();
    $conn = null;
}
?>
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 mt-5">
				<h2 class="">Yeni Kayıt</h2>				
				<form method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
								<label for="adi_soyadi" class="col-md-2 col-form-label">Adı ve Soyadı</label>
								<div class="col-md-10">
									<input type="text" class="form-control is-valid" id="adi_soyadi" name="adi_soyadi" value="" placeholder="Tam adını ve soyadını giriniz..." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="unvani" class="col-md-2 col-form-label">Grubu ve Ünvanı</label>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="grubu" name="grubu" value="" placeholder="Grubunu giriniz..." required>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="unvani" name="unvani" value="" placeholder="Ünvanını giriniz..." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="cep_telefonu" class="col-md-2 col-form-label">Cep - İş Telefonu</label>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="cep_telefonu" name="cep_telefonu" value="" placeholder="0-530-4199831" required>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="is_telefonu" name="is_telefonu" value="" placeholder="0-312-4199831-6666">
								</div>
							</div>
							<div class="form-group row">
								<label for="is_adresi" class="col-md-2 col-form-label">İş Adresi</label>
								<div class="col-md-10">
									<input type="text" class="form-control is-valid" id="is_adresi" name="is_adresi" value="" placeholder="İşyeri adı ile adresi arasına # yazarak giriniz...">
								</div>
							</div>
							<div class="form-group row">
								<label for="is_adresi" class="col-md-2 col-form-label">İş İlçe ve İli</label>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="is_ilce" name="is_ilce" value="" placeholder="İlçe adını giriniz...">
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="is_sehir" name="is_sehir" value="" placeholder="İl adını giriniz...">
								</div>
							</div>
							<div class="form-group row">
								<label for="ev_adresi" class="col-md-2 col-form-label">Ev Adresi</label>
								<div class="col-md-10">
									<input type="text" class="form-control is-valid" id="ev_adresi" name="ev_adresi" value="" placeholder="Ev Adresini giriniz...">
								</div>
							</div>
							<div class="form-group row">
								<label for="is_adresi" class="col-md-2 col-form-label">Ev İlçe ve İli</label>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="ev_ilce" name="ev_ilce" value="" placeholder="İlçe adını giriniz...">
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="ev_sehir" name="ev_sehir" value="" placeholder="İl adını giriniz...">
								</div>
							</div>
							<div class="form-group row">
								<label for="e_posta" class="col-md-2 col-form-label">E-Posta</label>
								<div class="col-md-10">
									<input type="text" class="form-control is-valid" id="e_posta" name="e_posta" value="" placeholder="E-Posta adresini giriniz..." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="resim" class="col-md-2 col-form-label">Resim Seç</label>
								<div class="col-md-10">						      
									<input type="file" class="form-control-file mt-2" id="resim" name="resim">
								</div>
							</div>
							<fieldset class="form-group">
								<div class="row">
									<legend class="col-form-label col-md-2 pt-0">Cinsiyeti</legend>
									<div class="col-md-10">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="cinsiyeti" id="gridRadios1" value="Erkek" checked>
											<label class="form-check-label" for="gridRadios1">
												Erkek
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="cinsiyeti" id="gridRadios2" value="Kadın">
											<label class="form-check-label" for="gridRadios2">
												Kadın
											</label>
										</div>
									</div>
								</div>
							</fieldset>
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button type="submit" class="btn btn-sm btn-success" name="yeni" value="yeni_kayit">Kaydet</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>