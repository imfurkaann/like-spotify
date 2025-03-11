<?php
@session_start();

include_once('../baglan.php');
include_once('editor_fonks.php');
include_once('editor_fonks_mail.php');

$ip = $_SERVER['REMOTE_ADDR'];  
$islem = $_REQUEST['islem'];
date_default_timezone_set('Europe/Istanbul');

//echo $islem;

if ( $islem == 'giris_kontrol'  ){

$kullanici = mysqli_real_escape_string($conn,@$_POST['kullanici']);
$kod= mysqli_real_escape_string($conn,@$_POST['kod']);
$sifre = mysqli_real_escape_string($conn,@$_POST['sifre']);
$dkod= $_SESSION["dogrulamakodu"]; 


if ( buyuk_harf($kod) != $dkod) {
		echo "<center><img src='admin_img/hata.png' width='24' height='24'> <br>";
		echo "<font color='red'>Doğrulama Kodu Yanlış</font></center>";
        die;
}

$sorgu = mysqli_query($conn,"Select * from uyeler where mail='$kullanici'");
$say_uye = mysqli_num_rows($sorgu);

if (  $say_uye > 0  ) {
    $satir = mysqli_fetch_array($sorgu);
    $d_sifre = $satir['sifre'];
    echo $d_sifre."<br>";
	echo md5(sha1(sha1(sha1(md5('deneme')))));
}

if (  $say_uye == 0 ) {
		echo "<center><img src='admin_img/hata.png' width='24' height='24'> <br>";
		echo "<font color='red'>Kullanıcı adı yanlış</font></center>";	
} elseif (  md5(sha1(sha1(sha1(md5($sifre))))) != $d_sifre  ) {
		echo "<center><img src='admin_img/hata.png' width='24' height='24'> <br>";
		echo "<font color='red'>Kullanıcı adı veya şifre yanlış</font></center>";
} else {
	 $u = $satir['id'];
	 $_SESSION["giris_yapan_uye"] = $u;
 	 mysqli_query($conn,"update uyeler set giris_sayisi=giris_sayisi + 1 where id='$u'");
	 
	 echo yonlen('yonetim_paneli/editor_index.php'); 
}

} 
elseif ( $islem == 'uye_ol_form'  ){

	$ad = buyuk_harf(mysqli_real_escape_string($conn,@$_POST['ad']));
	$soyad = buyuk_harf(mysqli_real_escape_string($conn,@$_POST['soyad']));
	$email = strtolower(mysqli_real_escape_string($conn,@$_POST['e-mail']));
	$tel = mysqli_real_escape_string($conn,@$_POST['tel']);
	$cinsiyet = @$_POST['cinsiyet'];
	$dtarih = mysqli_real_escape_string($conn,@$_POST['dtarih']);
	
	$md5yap = md5(rand(0, 999999));
	$sifre = strtoupper(substr($md5yap, 8, 6));
	$db_sifre = md5(sha1(sha1(sha1(md5($sifre)))));
	
	$sorgu_kontrol = mysqli_query($conn, "SELECT * FROM uyeler WHERE mail='$email'");
	$say_kontrol = mysqli_num_rows($sorgu_kontrol);
	if ($say_kontrol > 0) {
		echo "<center><img src='admin_img/hata.png' width='24' height='24'> <br>";
		echo "<font color='red'>Girilen mail adresi sistemde kayıtlıdır.<br>Şifremi unuttum bağlantısını kullanınız.</font></center>";
		die();
	}
	
	$sql = "INSERT INTO uyeler (adi, soyadi, cinsiyet, sifre, uyelik_turu, mail, tel, dtarih) 
			VALUES 
			('$ad', 
			'$soyad', 
			'$cinsiyet',
			'$db_sifre',
			'1',
			'$email', 
			'$tel',
			'$dtarih')"; 
	
	if (mysqli_query($conn, $sql)) {
		
		$icerik = "e-Kütüphane Kayıt İşleminiz Tamamlanmıştır. <p>
				   Kütüphane üyelik bilgileriniz :  <p>
				   <ul>
				   <li>Ad : $ad </li>
				   <li>Soyad : $soyad </li>
				   <li>Telefon : $tel </li>       
				   <li>E-mail : $email </li>
				   <li>Şifre : $sifre </li>
				   </ul>";

		echo "<center><img src='admin_img/ok.png' width='24' height='24'> <br>";
		echo "<p style='color: blue;'>Üyelik İşleminiz Tamamlandı!!! <br> Şifre için mail adresinizi kontrol ederek giriş yapabilirsiniz. </p></center>";
		echo $icerik;
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}	

elseif ( $islem == 'sifre_hatirlatma'  ){

$kullanici = mysqli_real_escape_string($conn,@$_POST['kullanici']);
$kod= mysqli_real_escape_string($conn,@$_POST['kod']);
$dkod= $_SESSION["dogrulamakodu"]; 


$sorgu = mysqli_query($conn,"Select * from uyeler where mail='$kullanici'");
$say_uye = mysqli_num_rows($sorgu);

echo "<br>";

if (  $say_uye > 0  ) {
    $satir = mysqli_fetch_array($sorgu);
    $kisi_id = $satir['id'];
    $kisi_ad = $satir['adi'];
    $kisi_soyad = $satir['soyadi'];
	$kisi_mail = $satir['mail'];
} 

if ( buyuk_harf($kod) != $dkod  ) {
    echo "<img src='admin_img/hata.png' width='24' height='24'><br>";
    echo "Doğrulama kodu hatalı";
} elseif (  $say_uye == 0  ) {
    echo "<img src='admin_img/hata.png' width='24' height='24'><br>";
    echo "Böyle bir üye bulunamadı.";
}
else {
    
	$sorgu_genel = mysqli_query($conn,"select * from genel_bilgiler");
	$satir_genel = mysqli_fetch_array($sorgu_genel);

	$simdiki_zaman = date("Y-m-d H:i:s");
	$sql = "UPDATE uyeler SET sifre_istek = 1, sifre_istek_tarihi = '$simdiki_zaman' WHERE id='$kisi_id'";
	$sorgu = mysqli_query($conn, $sql);

	
	echo "<img src='admin_img/ok.png' width='24' height='24'><br>";
	echo yonlen_zamanli('yeni_sifre_olustur.php',2000); 
	
	
	


	}
}

elseif ( $islem == 'yeni_sifre'  ){

	$kullanici = mysqli_real_escape_string($conn,@$_POST['kullanici']);
	$sifre = mysqli_real_escape_string($conn,@$_POST['sifre']);
	$tsifre = mysqli_real_escape_string($conn,@$_POST['tsifre']);

	$sorgu = mysqli_query($conn,"Select * from uyeler where mail='$kullanici'");
	$say_uye = mysqli_num_rows($sorgu);

	echo "<br>";

	if (  $say_uye > 0  ) {
		$satir = mysqli_fetch_array($sorgu);
		$kisi_id = $satir['mail'];
	} 

	if (  $say_uye == 0 ) {
		echo "<img src='admin_img/hata.png' width='24' height='24'><br>";
		echo "Böyle bir üye bulunamadı.";
	} elseif (  $sifre != $tsifre ) {
		echo "<img src='admin_img/hata.png' width='24' height='24'><br>";
		echo "Şifreler Eşleşmiyor.";
	} 
	else {
		
		// echo "şifre güncellenecek";
		
		$db_sifre = md5(sha1(sha1(sha1(md5($sifre)))));
		

		$sql = "UPDATE uyeler SET sifre = '$db_sifre' WHERE mail = '$kisi_id'";

	     echo $sql;

		if (mysqli_query($conn,$sql)) {
			echo "<img src='admin_img/ok.png' width='24' height='24'><br>";
			echo "Şifreniz değiştirildi";
			echo yonlen_zamanli('../login.php',2000); 
		}
		else{ echo "Beklenmeyen bir hata oluştu. Kod : 50";}

	}

}

elseif ( $islem == 'yazar_duzenleme' )  {     // yazar düzenleme

	$sifreli_id_bs64 = @$_REQUEST["yazar_id"];; 
	$sifreli_id = base64_decode($sifreli_id_bs64);
	$encryption_key = "sifreleme_123456";
	$yazar_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
	//echo $yazar_id; die;


	$sorgu_yazar = mysqli_query($conn,"select * from yazarlar where ID='$yazar_id'");
	$satir_yazar = mysqli_fetch_array($sorgu_yazar);
	$yazar_eski_resim = $satir_yazar['resim'];

	$yazar_adi = @$_REQUEST["yazar_adi"]; 
	$yazar_soyadi = @$_REQUEST["yazar_soyadi"]; 
	$yazar_ozgecmis = @$_REQUEST["yazar_ozgecmis"];
	$yazar_cinsiyeti = @$_REQUEST["yazar_cinsiyeti"];	
	$yazar_ozgecmis= htmlentities($yazar_ozgecmis, ENT_QUOTES, "UTF-8");

$sql = "Update yazarlar SET adi='$yazar_adi', soyadi='$yazar_soyadi', cins = '$yazar_cinsiyeti', ozgecmis='$yazar_ozgecmis' where id='$yazar_id'";
	if ( mysqli_query($conn,$sql) ) {
		echo "<img src='admin_img/save-icon.gif' width='24' title='Kayıt Edildi' alt='Kayıt Edildi' valign='middle'>";
	} else {
		echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
	}

	$isim = $_FILES['yazar_resim']['name'];
	$boyut = $_FILES['yazar_resim']['size'];
	$tmp = $_FILES['yazar_resim']['tmp_name'];

//echo $isim;

$yol = "../images/yazarlar/";
$kabul_boyut = 800*800;
$kabul_uzanti = array("gif","jpg","jpeg","png");

if ( strlen($isim) > 0 ) {

	list($txt,$uzanti) = explode(".",$isim);
	if ( !in_array($uzanti,$kabul_uzanti) ) {
			echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
			die();	
	}

	if ( $boyut > $kabul_boyut ) {
			echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
			die();
	}

	$yeni_isim = $sifreli_id_bs64."_".time().".".$uzanti;

//echo $yeni_isim;

	if ( move_uploaded_file($tmp,$yol.$yeni_isim) ) {
	unlink($yol.$yazar_eski_resim);
	$sql = "Update yazarlar SET resim='$yeni_isim' where id='$yazar_id'";
	if ( mysqli_query($conn,$sql) ) {
		echo "<img src='admin_img/pr_img.png' width='24' title='Resim Değiştirildi' alt='Resim Değiştirildi' valign='middle'>";
	} else {
		echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
	}
	} else {			
		echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'>";
		die();
	}
}
}
elseif ( $islem == 'artist_duzenleme' )  {     // yazar düzenleme

	$artist_id = @$_REQUEST["id"];
	$sorgu_artist = mysqli_query($conn,"select * from artist where ID='$artist_id'");
	$satir_artist = mysqli_fetch_array($sorgu_artist);
	$artist_eski_resim = $satir_artist['image'];
	$artist_name = @$_REQUEST["name"]; 

	$sql = "Update artist SET name='$artist_name' where ID='$artist_id'";
	if ( mysqli_query($conn,$sql) ) {
		echo "<img src='admin_img/save-icon.gif' width='24' title='Kayıt Edildi' alt='Kayıt Edildi' valign='middle'>";
	} else {
		echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
	}

	$isim = $_FILES['resim']['name'];
	$boyut = $_FILES['resim']['size'];
	$tmp = $_FILES['resim']['tmp_name'];

//echo $isim;

	$yol = "../database/artist_image/";
	$kabul_boyut = 1024*1024;
	$kabul_uzanti = array("gif","jpg","jpeg","png");

	if ( strlen($isim) > 0 ) {

		list($txt,$uzanti) = explode(".",$isim);
		if ( !in_array($uzanti,$kabul_uzanti) ) {
			echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
			die();	
		}

		if ( $boyut > $kabul_boyut ) {
			echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
			die();
		}

		$yeni_isim = $artist_id."_".time().".".$uzanti;
		$resim_db_yol = "database/artist_image/".$yeni_isim;

		//echo $yeni_isim;

		if ( move_uploaded_file($tmp,$yol.$yeni_isim) ) {
			unlink("../".$yazar_eski_resim);
			$sql = "Update artist SET image='$resim_db_yol' where ID='$artist_id'";
			if ( mysqli_query($conn,$sql) ) {
				echo "<img src='admin_img/pr_img.png' width='24' title='Resim Değiştirildi' alt='Resim Değiştirildi' valign='middle'>";
			} else {
				echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
			}
		} else {			
			echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'>";
			die();
		}
	}
}
elseif ( $islem == 'artist_ekle' )  {     // yazar ekleme
     
		$yazar_adi = @$_REQUEST["name"]; 

		$isim = $_FILES['resim']['name'];
		$boyut = $_FILES['resim']['size'];
		$tmp = $_FILES['resim']['tmp_name'];
		
		//echo $isim;

		$yol = "../database/artist_image/";
		$kabul_boyut = 800*800;
		$kabul_uzanti = array("gif","jpg","jpeg","png");

		if ( !strlen($isim) > 0 ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Resim Ekleyiniz' alt='Resim Ekleyiniz' valign='middle'>";
					die();
		}

		list($txt,$uzanti) = explode(".",$isim);
		if ( !in_array($uzanti,$kabul_uzanti) ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
					die();	
		}

		if ( $boyut > $kabul_boyut ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim boyutu' alt='Kabul edilmeyen resim boyutu'  valign='middle'>";
					die();
		}

		$yeni_isim = time().rand(100,999).".".$uzanti;
		$resim ='database/artist_image/'.$yeni_isim;

		//echo $yeni_isim;

		if ( move_uploaded_file($tmp,$yol.$yeni_isim) ) {
			$sql = "Insert into artist (name, image) values ('$yazar_adi','$resim')";
			if ( mysqli_query($conn,$sql) ) {
				// echo "<img src='admin_img/save-icon.gif' width='24' valign='middle'>";
				echo yonlen('editor_index.php?istek=artists&yazar_basharf=tum');
				
			} else {
				echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
			}
		} else {			
				echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'>";
				die();
		}
	
}
elseif ( $islem == 'artist_silme' )  {     // yazar silme
	$artist_id = @$_REQUEST["artist_id"];
	$sorgu_artist = mysqli_query($conn,"select * from artist where ID='$artist_id'");
	$artist = mysqli_fetch_array($sorgu_artist);
	$artist_resim = $artist['image'];
	if ( file_exists( "../" . $artist_resim ) ) {
		unlink("../".$artist_resim);
	}
	mysqli_query($conn,"delete from artist where ID='$artist_id'");
	echo yonlen('yonetim_paneli/editor_index.php?istek=artists&yazar_basharf=tum');
}

elseif ( $islem == 'yazar_silme' )  {     // yazar silme


	$sifreli_id_bs64 = @$_REQUEST["yazar_id"];; 
	$sifreli_id = base64_decode($sifreli_id_bs64);
	$encryption_key = "sifreleme_123456";
	$yazar_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key); 

	$sorgu_yazar = mysqli_query($conn,"select * from yazarlar where id='$yazar_id'");
	$satir_yazar = mysqli_fetch_array($sorgu_yazar);
	$yazar_resim = $satir_yazar['resim'];
	$yol = "../images/yazarlar/";
	unlink($yol.$yazar_resim);
	mysqli_query($conn,"delete from yazarlar where id='$yazar_id'");
	// yazarın kitaplarının da silinmesi gerekir
	echo yonlen('yonetim_paneli/editor_index.php?istek=yazarlar&yazar_basharf=tum');


} elseif ( $islem == "album_ekle" ) {
	
		$name = @$_REQUEST["name"]; 
		$artist = @$_REQUEST['artist'];

		$isim = $_FILES['resim']['name'];
		$boyut = $_FILES['resim']['size'];
		$tmp = $_FILES['resim']['tmp_name'];
		
		//echo $isim;

		$yol = "../database/album_image/";
		$kabul_boyut = 800*800;
		$kabul_uzanti = array("gif","jpg","jpeg","png");

		if ( !strlen($isim) > 0 ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Resim Ekleyiniz' alt='Resim Ekleyiniz' valign='middle'>";
					die();
		}

		list($txt,$uzanti) = explode(".",$isim);
		if ( !in_array($uzanti,$kabul_uzanti) ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
					die();	
		}

		if ( $boyut > $kabul_boyut ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim boyutu' alt='Kabul edilmeyen resim boyutu'  valign='middle'>";
					die();
		}

		$yeni_isim = time().rand(100,999).".".$uzanti;
		$resim ='database/album_image/'.$yeni_isim;

		//echo $yeni_isim;

		if ( move_uploaded_file($tmp,$yol.$yeni_isim) ) {
			$sql = "Insert into album (name, image, artist_id) values ('$name','$resim', '$artist')";
			if ( mysqli_query($conn,$sql) ) {
				// echo "<img src='admin_img/save-icon.gif' width='24' valign='middle'>";
				echo yonlen('editor_index.php?istek=artists&yazar_basharf=tum');
				
			} else {
				echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
			}
		} else {			
				echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'>";
				die();
		}
} elseif ( $islem == "music_ekle" ) {
	
		$name = @$_REQUEST["name"]; 
		$album = @$_REQUEST['album'];
		$type = @$_REQUEST['type'];
		
		

		$isim = $_FILES['music']['name'];
		$boyut = $_FILES['music']['size'];
		$tmp = $_FILES['music']['tmp_name'];

		$yol = "../database/music/";
		$kabul_boyut = 800*1024*1024;
		$kabul_uzanti = array("mp3");

		if ( !strlen($isim) > 0 ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Resim Ekleyiniz' alt='Resim Ekleyiniz' valign='middle'>";
					die();
		}

		list($txt,$uzanti) = explode(".",$isim);
		if ( !in_array($uzanti,$kabul_uzanti) ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
					die();	
		}

		if ( $boyut > $kabul_boyut ) {
					echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim boyutu' alt='Kabul edilmeyen resim boyutu'  valign='middle'>";
					die();
		}

		$yeni_isim = time().rand(100,999).".".$uzanti;
		$music ='database/music/'.$yeni_isim;

		echo $music;

		if ( move_uploaded_file($tmp,$yol.$yeni_isim) ) {
			$sql = "Insert into music (name, album_id, path, type) values ('$name','$album', '$music', '$type')";
			if ( mysqli_query($conn,$sql) ) {
				// echo "<img src='admin_img/save-icon.gif' width='24' valign='middle'>";
				echo yonlen('editor_index.php?istek=artists&yazar_basharf=tum');
				
			} else {
				echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
			}
		} else {			
				echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'>";
				die();
		}
}
elseif ( $islem == 'egitim_ekle' )  {     // yazar ekleme
    // egitim gorseli, egitim_videosu, egitim-seviyesi, eğitim adı, eğitmen adı, eğitim içeriği, enstrüman adı  
	$egitim_adi = @$_REQUEST["name"]; 
	$egitmen_adi = @$_REQUEST["inst_name"];
	$icerik = @$_REQUEST["icerik"];
	$enstruman = @$_REQUEST["enstruman"];
	$seviye = @$_REQUEST["seviye"];

	if (!(isset($_FILES['resim']))) {
		echo "Resim bulunamadı";
		die();
	}
	if (!(isset($_FILES['video']))) {
		echo "Video bulunamadı";
		die();
	}

	$gorsel_isim = $_FILES['resim']['name'];
	$gorsel_boyut = $_FILES['resim']['size'];
	$gorsel_tmp = $_FILES['resim']['tmp_name'];
	
	$video_isim = $_FILES['video']['name'];
	$video_boyut = $_FILES['video']['size'];
	$video_tmp = $_FILES['video']['tmp_name'];
	//echo $isim;

	$gorsel_yol = "../database/education_image/";
	$video_yol = "../database/education_video/";
	$kabul_boyut = 1000*1024*1024;
	$kabul_uzanti_gorsel = array("gif","jpg","jpeg","png");
	$kabul_uzanti_video = array("mp4");

	if ( !strlen($gorsel_isim) > 0 ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Resim Ekleyiniz' alt='Resim Ekleyiniz' valign='middle'>";
				die();
	}
	list($txt,$uzanti) = explode(".",$gorsel_isim);
	if ( !in_array($uzanti,$kabul_uzanti_gorsel) ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
				die();	
	}
	if ( $gorsel_boyut > $kabul_boyut ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim boyutu' alt='Kabul edilmeyen resim boyutu'  valign='middle'>";
				die();
	}
	$gorsel_yeni_isim = time().rand(100,999).".".$uzanti;
	$resim_yol_db ='database/education_image/'.$gorsel_yeni_isim;
	if ( move_uploaded_file($gorsel_tmp,$gorsel_yol.$gorsel_yeni_isim) ) {
		echo "OK";
	} else {			
		echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'> ";
		die();
	}

	if ( !strlen($video_isim) > 0 ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Resim Ekleyiniz' alt='Resim Ekleyiniz' valign='middle'> 1";
				die();
	}
	list($txt,$uzanti) = explode(".",$video_isim);
	if ( !in_array($uzanti,$kabul_uzanti_video) ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'> 2";
				echo "$uzanti";
				die();	
	}
	if ( $video_boyut > $kabul_boyut ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim boyutu' alt='Kabul edilmeyen resim boyutu'  valign='middle'> 3";
				die();
	}
	$video_yeni_isim = time().rand(100,999).".".$uzanti;
	$video_yol_db ='database/education_video/'.$video_yeni_isim;
	if ( move_uploaded_file($video_tmp,$video_yol.$video_yeni_isim) ) {
		echo "OK";
	} else {			
		echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'> ananı sikim galatasaray";
		die();
	}

	$sql = "Insert into education (name, type, level, instructor_name, comment, image, video) values ('$egitim_adi','$enstruman','$seviye','$egitmen_adi','$icerik','$resim_yol_db','$video_yol_db')";
	if ( mysqli_query($conn,$sql) ) {
		// echo "<img src='admin_img/save-icon.gif' width='24' valign='middle'>";
		echo yonlen('editor_index.php?istek=artists&yazar_basharf=tum');
		
	} else {
		echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
	}

}
elseif ( $islem == 'etkinlik_ekle' )  {     // yazar ekleme
    // name, date, city, mail, location, adress, number, artist 
	$name = @$_REQUEST["name"]; 
	$date = @$_REQUEST["date"]."00:00:00";
	$city = @$_REQUEST["city"];
	$mail = @$_REQUEST["mail"];
	$location = @$_REQUEST["location"];
	$adress = @$_REQUEST["adress"];
	$number = @$_REQUEST["number"];
	$artist = @$_REQUEST["artist"];
	if (!(isset($_FILES['resim']))) {
		echo "Resim bulunamadı";
		die();
	}
	$gorsel_isim = $_FILES['resim']['name'];
	$gorsel_boyut = $_FILES['resim']['size'];
	$gorsel_tmp = $_FILES['resim']['tmp_name'];
	$gorsel_yol = "../database/event_image/";
	$kabul_boyut = 1*1024*1024;
	$kabul_uzanti_gorsel = array("gif","jpg","jpeg","png");
	if ( !strlen($gorsel_isim) > 0 ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Resim Ekleyiniz' alt='Resim Ekleyiniz' valign='middle'>";
				die();
	}
	list($txt,$uzanti) = explode(".",$gorsel_isim);
	if ( !in_array($uzanti,$kabul_uzanti_gorsel) ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim formatı' alt='Kabul edilmeyen resim formatı'  valign='middle'>";
				die();	
	}
	if ( $gorsel_boyut > $kabul_boyut ) {
				echo "<img src='admin_img/gecersiz.png' width='24' title='Kabul edilmeyen resim boyutu' alt='Kabul edilmeyen resim boyutu'  valign='middle'>";
				die();
	}
	$gorsel_yeni_isim = time().rand(100,999).".".$uzanti;
	$resim_yol_db ='database/event_image/'.$gorsel_yeni_isim;
	if ( move_uploaded_file($gorsel_tmp,$gorsel_yol.$gorsel_yeni_isim) ) {
		echo "OK";
	} else {			
		echo "<img src='admin_img/gecersiz.png' width='24' title='resim yüklenemedi' alt='resim yüklenemedi'  valign='middle'> ";
		die();
	}

	$sql = "Insert into event (title, artist_id, image, datetime, city, adress, location, mail, phone_number) values ('$name','$artist','$resim_yol_db','$date','$city','$adress','$location','$mail','$number')";
	if ( mysqli_query($conn,$sql) ) {
		// echo "<img src='admin_img/save-icon.gif' width='24' valign='middle'>";
		echo yonlen('editor_index.php?istek=artists&yazar_basharf=tum');
		
	} else {
		$error_message = mysqli_error($conn);
		echo "<img src='admin_img/gecersiz.png' width='24' title='veri tabanı kaydı yapılamadı' alt='veri tabanı kaydı yapılamadı'  valign='middle'>";
	}

}

else{
	echo "Beklenmeyen bir hata oluştu. Kod : 10";
}

?>

