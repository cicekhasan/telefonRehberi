	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-5">
				<h2>TELEFON REHBERİ</h2>
				<a href="?" title="" class="btn text-primary">
					<i class="fa fa-sync-alt fa-sm"></i>
				</a>
				<a href="?sira=isim" title="" class="btn text-primary">
					<i class="fa fa-sort-alpha-up fa-sm"></i>
					<small> İsim</small>
				</a>
				<a href="?sira=sehir" title="" class="btn text-primary">
					<i class="fa fa-sort-alpha-up fa-sm"></i>
					<small> Şehir</small>
				</a>
				<a href="?sira=isim" title="" class="btn text-success">
					<i class="fa fa-user-friends"></i>
					<small>Güncel</small>
				</a>
				<a href="?sira=isim&islem=hepsi" title="" class="btn text-primary">
					<i class="fa fa-user-friends"></i>
					<small>Hepsi</small>
				</a>
				<a href="?sayfa=yeniKayit" title="" class="btn text-danger">
					<i class="fa fa-user-plus fa-sm"></i>
					<small> Ekle</small>	
				</a>
				<table class="table table-sm table-hover mt-3 tOrtala" style="font-size: 12px;">
					<thead>
						<tr>
							<th>#</th>
							<th></th>
							<th>Adı ve Soyadı</th>
							<th>Grup</th>
							<th>Ünvanı</th>
							<th>Ev Telefonu</th>
							<th>İş Telefonu</th>
							<th>İlçe/Şehir</th>
							<th>E-Posta</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
				<?php 
				require 'ayar.php';

				(!$_GET['sira']) ? $sira='adi_soyadi' : $sira='adi_soyadi' ;
				($_GET['sira']=='isim')  ? $sira='adi_soyadi' : $sira='adi_soyadi' ;
				($_GET['sira']=='sehir') ? $sira='ev_sehir' : $sira='adi_soyadi' ;

				if ($sira) {
					if ($_GET['islem']=='guncel') {
						$kisiler = $vt->query("SELECT * FROM rehber ORDER BY ".$sira." ASC")->fetchAll();
					}else{
						$kisiler = $vt->query("SELECT * FROM rehber ORDER BY ".$sira." ASC")->fetchAll();
					}

					if($_GET['islem']=='hepsi'){
						$kisiler = $vt->query("SELECT * FROM rehber ORDER BY adi_soyadi ASC")->fetchAll();
					}
					foreach ($kisiler as $kisi) {
						extract($kisi);
						echo '
							<tr>
								<td>'.$kisi['id'].'</td>
								<td><img src="uploads/';
								echo ($resim_adi) ? $resim_adi : "uye.jpg";
								echo '" alt="" style="width:45px; height:50px;" class="img-fluid img-thumbnail"></td>
								<td>'.$adi_soyadi.'</td>
								<td>'.$grubu.'</td>
								<td>'.$unvani.'</td>
								<td>';
								cepTelefonu("-", $cep_telefonu);
								echo '</td>
								<td>'.$is_telefonu.'</td>
								<td>'.$ev_ilce.'/'.$ev_sehir.'</td>
								<td>'.$e_posta.'</td>
								<td>
									<a title="Göster" data-toggle="modal" data-target="#'.$id.'"><i class="fa fa-eye text-success"></i></a>
									&nbsp;&nbsp;
									<a href="?islem=sil&id='.$id.'" title="Sil" onclick="return silOnayla();"><i class="fa fa-trash-alt text-danger"></i></a>
									&nbsp;&nbsp;
									<a href="?sayfa=duzenle&id='.$id.'" title="Güncelle"><i class="fa fa-pencil-alt text-warning"></i></a>
									<!-- Modal -->										
									<div class="modal fade bd-example-modal-lg" id="'.$id.'" tabindex="-1" role="dialog" aria-labelledby="'.$id.'" aria-hidden="true">
									  <div class="modal-dialog modal-lg" role="document">
									    <div class="modal-content">
									      <div class="modal-header ';
									      echo ($cinsiyeti=='Erkek') ? "bg-aMavi" : "bg-pembe";
									      echo ' text-white">
									        <h5 class="modal-title" id="'.$id.'">'.$adi_soyadi.' / Detay Kartı</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-body">
									        <div class="row">
									        	<div class="col-md-8">
									        		<div class="row">
									        			<label class="col-md-4 text-right">Adı ve Soyadı : </label>
									        			<label class="col-md-8">'.$adi_soyadi.'</label>
									        		</div>
									        		<div class="row">
									        			<label class="col-md-4 text-right">Ünvanı : </label>
									        			<label class="col-md-8">'.$unvani.'</label>
									        		</div>';

									        		if ($cep_telefonu) {
																echo '
									        		<div class="row">
									        			<label class="col-md-4 text-right">Cep Telefonu : </label>
									        			<label class="col-md-8">';
																cepTelefonu("-", $cep_telefonu);
																echo '</label>
									        		</div>
																';
									        		}

									        		if ($is_telefonu) {
																echo '
									        		<div class="row">
									        			<label class="col-md-4 text-right">İş Telefonu : </label>
									        			<label class="col-md-8">'.$is_telefonu.'</label>
									        		</div>
																';
									        		}

									        		if ($is_adresi) {
																echo '
									        		<div class="row">
									        			<label class="col-md-4 text-right">İş Adres : </label>
									        			<label class="col-md-8">'.$is_adresi.' '.$is_ilce.'/'.$is_sehir.'</label>
									        		</div>
																';
									        		}

									        		if ($ev_adresi) {
																echo '
									        		<div class="row">
									        			<label class="col-md-4 text-right">Ev Adres : </label>
									        			<label class="col-md-8">'.$ev_adresi.' '.$ev_ilce.'/'.$ev_sehir.'</label>
									        		</div>
																';
									        		}

									        		echo '
									        	</div>
									        	<div class="col-md-4 text-center">
															<img src="uploads/'.$resim_adi.'" alt="'.$adi_soyadi.'" class="img-fluid img-thumbnail">
									        	</div>
									        </div>
							        		<div class="row text-white mt-3 text-center ';
									      echo ($cinsiyeti=='Erkek') ? "bg-aMavi" : "bg-pembe";
									      echo '">
							        			<label class="col-md-11 offset-md-1">'.$e_posta.'</label><br />
							        		</div>
									      </div>
									    </div>
									  </div>
									</div>
								</td>
							</tr>
						';
					}
				}
				$pdo = null;
				?>
					</tbody>
				</table>
			</div>
		</div>
	</div>