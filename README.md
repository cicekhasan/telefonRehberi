# RESİMLİ TELEFON REHBERİ

Php pdo kurcalamaları derken...

### Yapacaklarınız
1. Proje dizininde "uploads/uyeler" şeklinde bir dizin yapısı oluşturun,
2. **ayar.php** dosyasını kendiniz ouşturun ve aşagıdaki kodları içerisine yapıştırın.

```php
# ayar.php dosya içeriği...
$dsn       = 'mysql:host=localhost;dbname=veritabaniAdi';
$kullanici = 'kullaniciAdi';
$parola    = 'parola';
 
try {
  $vt = new PDO($dsn, $kullanici, $parola);
} catch (PDOException $hata) {
  echo 'Bağlantı hatası: ' . $hata->getMessage();
}
```

3. Dosya yetkilerini ayarlayın;

```bash
sudo adduser $USER www-data
sudo chown -R $USER:www-data /var/www/html/
sudo chmod -R 777 uploads/
```

### Yapılacaklar
- [ ] Kayıt ekleme
  - [x] Hangi bilgileri eklemeliyim?
    - [x] Adı ve Soyadı
    - [x] Grubu (Gruplara ayırıp filitrelemek ve silme yerine bir grupta toplamak için),
    - [x] Ünvanı (Baba, anne, öğrenci ve meslek ünvanı gibi),
    - [x] Cep telefonu (Rehberin amacı gereği mutlaka olmalı),
    - [x] İş telefonu
    - [x] İş adresi (Çalışıyorsa iş adresi, öğrenci ise okul bilgileri girilecek),
    - [x] İşyerinin bulunduğu ilçe,
    - [x] İşyerinin bulunduğu şehir,
    - [x] Ev adresi (Olursa iyi olur),
    - [x] İkamet ettiği ilçe (Filtrelemede kullanılabilir),
    - [x] İkamet ettiği şehir (Filtrelemede kullanılabilir),
    - [x] Elektronik posta bilgisi (Belki toplu e-posta atma olabilir),
    - [x] Resim adı bilgisi (Resmi yoksa ortak bir resim görüntülenecek. Sadece jpg ve png yüklenebilecek), 
    - [x] Cinsiye bilgisi (Cinsiyete göre e-posta atılabilir [Erkek, kadın]),
  - [ ] Eklenecek bilgilerde özel şartlar olacak mı?
    - [ ] Kayıt sırasında ad ve soyad daha önceden kayıt edilmiş mi? Varsa cep telefonu gibi bir kaç bilgi karşılaştırılıp aynı kişi olup olmadığı teyidi yapılacak. Rehberin çöp olmasını engelleyelim!
    - [x] Resim isimleri 29 harf ve 012345689 rakam karekterilerinden rastgele oluşturulacak,
    - [ ] Resimler yüklenirken boyutlandırılacak,
    - [x] Cep telefon numarası kayıt sırasında x-xxx-xxxxxxx şeklinde - ile ayrılarak yapılacak. Kayıt son aşamasında otomatik x(xxx) xxxxxxx şekline dönüştürülecek,
    - [ ] İlçe ve şehir isimlerinde liste kullanılacak,
- [x] Güncelleme
  - [x] Bilgileri güncelleme ile resim güncelleme ayrı yapılabilecek,
  - [x] Resim güncelleme işlemi ayrı yapılacak ve güncellenirken kişiye ait eski resim silinecek,
  - [x] Cep telefon numarası güncelleme sırasında x-xxx-xxxxxxx şeklinde - ile ayrılarak yapılacak. Güncelleme son aşamasında otomatik x(xxx) xxxxxxx şekline dönüştürülecek,
- [ ] Listeleme
  - [x] Listeleme anasayfa da yapılacak,
  - [ ] Listelemede görüntülenecek bilgiler belirlenecek,
  - [x] Satırlarda göster, çöpe al ve düzenle işlem bağlantıları olacak,
- [ ] Kişi bilgierini görüntüleme,
  - [x] Görüntüleme modal aracılığı ile yapılacak ve kartvizit benzeri olarak tasarlanacak,
  - [x] Görüntülemede gösterilecek bilgiler belirlenecek,
  - [x] Görüntülemede cinsiyetine göre renklendirme yapılacak. Kadın mı erkek mi renkten anlasılabilir olacak,
- [ ] Silme
  - [ ] Silme yapılmayacak, uygun bir grup isminde toplanacak. Normalde görüntülenemeyecek, bunun için özel bir bağlantı olacak.

    