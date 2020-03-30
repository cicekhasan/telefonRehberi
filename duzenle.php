<?php 

try{

	if($_POST["guncelle"]) {
	require 'ayar.php';

	$guncelle = $vt->prepare("UPDATE rehber SET
		adi_soyadi   = :adi_soyadi, 
		grubu        = :grubu, 
		unvani       = :unvani, 
		cep_telefonu = :cep_telefonu, 
		is_telefonu  = :is_telefonu, 
		is_adresi    = :is_adresi, 
		is_ilce      = :is_ilce, 
		is_sehir     = :is_sehir, 
		ev_adresi    = :ev_adresi, 
		ev_ilce      = :ev_ilce, 
		ev_sehir     = :ev_sehir, 
		e_posta      = :e_posta, 
		resim_adi    = :resim_adi, 
		cinsiyeti    = :cinsiyeti 
	  WHERE id=:id");

	$sonuc = $guncelle->execute(
	[
		":adi_soyadi"   => $_POST['adi_soyadi'], 
		":grubu"        => $_POST['grubu'], 
		":unvani"       => $_POST['unvani'], 
		":cep_telefonu" => $_POST['cep_telefonu'], 
		":is_telefonu"  => $_POST['is_telefonu'], 
		":is_adresi"    => $_POST['is_adresi'], 
		":is_ilce"      => $_POST['is_ilce'], 
		":is_sehir"     => $_POST['is_sehir'], 
		":ev_adresi"    => $_POST['ev_adresi'], 
		":ev_ilce"      => $_POST['ev_ilce'], 
		":ev_sehir"     => $_POST['ev_sehir'], 
		":e_posta"      => $_POST['e_posta'], 
		":resim_adi"    => $_POST['resim_adi'], 
		":cinsiyeti"    => $_POST['cinsiyeti'], 
		":id"           => $_GET['id']
	]);

	echo ($sonuc==1) ? "Yüklenmiş olması lazım!" : "Yüklenemedi";
	header('Location:index.php');

	}
}catch (PDOException $e) {
    echo "Hata kodu: " . $e->getCode() . "<br> Hata mesajı: " . $e->getMessage();
    $conn = null;
}

try{

	if($_POST["resimYukle"]) {
		if ($_FILES['yuklenecekResim']['name']) {
			require 'ayar.php';

			// RESİM BİLGİLERİ
			// Resim isimlerini parametrede verdiğin rakam kadar oluşturur
			$karisikVeri = veriUret(10);

			$dosya     = "uploads/";
			$tmp_name  = $_FILES['yuklenecekResim']['tmp_name'];
			$name      = $_FILES['yuklenecekResim']['name'];
			$boyut     = $_FILES['yuklenecekResim']['size'];
			$tip       = $_FILES['yuklenecekResim']['type'];
			$uzanti    = substr($name,-4,4);
			$resimAd   = $karisikVeri.$uzanti;

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

			$sorgu = $vt->query('SELECT * FROM rehber WHERE id='.$_GET['id'])->fetch();
			extract($sorgu);
			// Öndeden kaydedilmiş id ye ait resim siliniyor
			($resim_adi) ? unlink($dosya.$resim_adi) : null;
			// Yeni resim klasöre kayıt ediliyor
			move_uploaded_file($tmp_name, "$dosya/$resimAd");

			$guncelle = $vt->prepare("UPDATE rehber SET resim_adi=:resim_adi WHERE id=:id");
			$sonuc = $guncelle->execute([":resim_adi"=>$resimAd, ":id"=> $_GET['id']]);

			header('Refresh: 10;');

		}else{
			echo '
			<div class="row">
				<div class="alert alert-danger alert-dismissible fade show col-md-8 offset-md-2 text-center mt-5" role="alert">
				  <strong>Önce Resim Dosyası Seçmelisin!</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			</div>
			';
		}

	}
}catch (PDOException $e) {
    echo "Hata kodu: " . $e->getCode() . "<br> Hata mesajı: " . $e->getMessage();
    $conn = null;
}
?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 mt-5">
				<h2 class="">Güncelleme Ekranı</h2>				
				<form method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<?php 
						if (trim($_GET['id'])) {
							include 'ayar.php';
							$getir = $vt->query('SELECT * FROM rehber WHERE id='.$_GET['id'])->fetch();
							$sonuc = extract($getir);

					echo '
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
								<label for="adi_soyadi" class="col-md-3 col-form-label">Adı ve Soyadı</label>
								<div class="col-md-9">
									<input type="text" class="form-control is-valid" id="adi_soyadi" name="adi_soyadi" value="'.$adi_soyadi.'" placeholder="Tam adını ve soyadını giriniz..." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="unvani" class="col-md-3 col-form-label">Grubu ve Ünvanı</label>
								<div class="col-md-4">
									<input type="text" class="form-control is-valid" id="grubu" name="grubu" value="'.$grubu.'" placeholder="Grubunu giriniz..." required>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="unvani" name="unvani" value="'.$unvani.'" placeholder="Ünvanını giriniz..." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="cep_telefonu" class="col-md-3 col-form-label">Cep - İş Telefonu</label>
								<div class="col-md-4">
									<input type="text" class="form-control is-valid" id="cep_telefonu" name="cep_telefonu" value="'.$cep_telefonu.'" placeholder="x(xxx) xxxxxxx" required>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="is_telefonu" name="is_telefonu" value="'.$is_telefonu.'" placeholder="x(xxx) xxxxxxx-dahili">
								</div>
							</div>
							<div class="form-group row">
								<label for="is_adresi" class="col-md-3 col-form-label">İş Adresi</label>
								<div class="col-md-9">
									<input type="text" class="form-control is-valid" id="is_adresi" name="is_adresi" value="'.$is_adresi.'" placeholder="İşyeri adı ile adresi arasına # yazarak giriniz...">
								</div>
							</div>
							<div class="form-group row">
								<label for="is_adresi" class="col-md-3 col-form-label">İş İlçe ve İli</label>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="is_ilce" name="is_ilce" value="'.$is_ilce.'" placeholder="İlçe adını giriniz...">
								</div>
								<div class="col-md-4">
									<input type="text" class="form-control is-valid" id="is_sehir" name="is_sehir" value="'.$is_sehir.'" placeholder="İl adını giriniz...">
								</div>
							</div>
							<div class="form-group row">
								<label for="ev_adresi" class="col-md-3 col-form-label">Ev Adresi</label>
								<div class="col-md-9">
									<input type="text" class="form-control is-valid" id="ev_adresi" name="ev_adresi" value="'.$ev_adresi.'" placeholder="Ev Adresini giriniz...">
								</div>
							</div>
							<div class="form-group row">
								<label for="is_adresi" class="col-md-3 col-form-label">Ev İlçe ve İli</label>
								<div class="col-md-5">
									<input type="text" class="form-control is-valid" id="ev_ilce" name="ev_ilce" value="'.$ev_ilce.'" placeholder="İlçe adını giriniz...">
								</div>
								<div class="col-md-4">
									<input type="text" class="form-control is-valid" id="ev_sehir" name="ev_sehir" value="'.$ev_sehir.'" placeholder="İl adını giriniz...">
								</div>
							</div>
							<div class="form-group row">
								<label for="e_posta" class="col-md-3 col-form-label">E-Posta</label>
								<div class="col-md-9">
									<input type="text" class="form-control is-valid" id="e_posta" name="e_posta" value="'.$e_posta.'" placeholder="E-Posta adresini giriniz..." required>
								</div>
							</div>
							<div class="form-group row">
								<label for="resim" class="col-md-3 col-form-label">Resim Seç</label>
								<div class="col-md-9">						      
									<input type="text" class="form-control is-valid" id="resim_adi" name="resim_adi" value="'.$resim_adi.'">
								</div>
							</div>
							<fieldset class="form-group">
								<div class="row">
									<legend class="col-form-label col-md-3 pt-0">Cinsiyeti</legend>
									<div class="col-md-9">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="cinsiyeti" id="gridRadios1" value="Erkek" ';
											echo ($cinsiyeti=='Erkek') ? " checked" : null;
											echo '>
											<label class="form-check-label" for="gridRadios1">
												Erkek
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="cinsiyeti" id="gridRadios2" value="Kadın" ';
											echo ($cinsiyeti=='Kadın') ? " checked" : null;
											echo '>
											<label class="form-check-label" for="gridRadios2">
												Kadın
											</label>
										</div>
									</div>
								</div>
							</fieldset>
							<div class="form-group row">
								<div class="col-md-9 offset-md-3">
									<button type="submit" class="btn btn-sm btn-success" name="guncelle" value="Güncelle">Kaydet</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4 mt-5">
				<div class="form-group row">
					<div class="col-md-12 mt-5">	
						<form method="post" accept-charset="utf-8" enctype="multipart/form-data">
							<div class="form-group row">
						    <div class="col-md-12 text-center">
						    	<img src="uploads/';
										echo ($resim_adi) ? $resim_adi : "uye.jpg";
										echo '" alt="" style="width:300px;" class="img-fluid img-thumbnail">
									<input type="file" class="form-control-file mt-2" id="resim" name="yuklenecekResim">
									<input class="btn btn-primary btn-sm btn-block my-2" type="submit" name="resimYukle" value="Resmi Değiştir">
						    </div>
						  </div>
						</form>	
					</div>
				</div>
			</div>
			';
		} ?>
		</div>
	</div>