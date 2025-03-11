<?php
include_once('editor_fonks.php');
include_once('editor_ses_kontrol.php');
	if ( $yetki_seviyesi <> 2 ) {
		yazdir_yetkisiz_islem();
		die;
	}
	
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
					<h1 class="h3 mb-4 text-gray-800">Sanatçı Bilgileri </h1>					
						<div class="card-body">
						

	<?php
	$sifreli_id_bs64 = @$_GET["artist"]; 
	$sifreli_id = base64_decode($sifreli_id_bs64);
	// echo $sifreli_id;
	$encryption_key = "sifreleme_123456";
	$y_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
	
	/*
	if ($y_id === false) {
    echo 'Şifre çözme başarısız oldu: ' . openssl_error_string();
	}   else {
    echo 'Şifre çözme başarılı: ' . $y_id;
	}
	 */	
	?>

				<?php
			$sorgu_yazar = mysqli_query($conn,"select * from artist where ID = $y_id ");
            $satir_yazar = mysqli_fetch_array($sorgu_yazar);
			$sorgu_kitap = mysqli_query($conn,"select * from album where artist_id = $y_id ");
			$ks = mysqli_num_rows($sorgu_kitap);
				?>
	
		<div class="table-responsive">
		<table width='80%' >
		<tbody>
		<tr>
		<td>
			  <form id='yazar_bilgileri' name='yazar_bilgileri' method="post" enctype="multipart/form-data" action="isle.php?islem=artist_duzenleme">  
			  <table class="table table-bordered" cellpadding="0" cellspacing="0">
				  <tr>
					<td style='text-align:center' colspan=2>
					<img style="border-radius: 53%;" width=175 height=175 src='../<?php echo $satir_yazar['image'] ?>'>
					</td>
				  </tr>
				  <tr>
					<td><strong>Resim Değiştir</strong></td>
					<td><input type='file' accept="image/gif, image/jpg, image/jpeg, image/png" name='resim'></td>
				  </tr>
				  <tr>
					<td><strong>Adı</strong></td>
					<td><input type="text" class="text" required  name='name' value='<?php echo $satir_yazar['name'] ?>' /></td>
				  </tr>
				  <tr>
					  <td style="text-align:right; vertical-align: middle;"><span id='sonuc'></span></td>
					  <td style="text-align:left; vertical-align: middle;">
							<input type="hidden" name='id' value='<?php echo $y_id; ?>' />
							<input type='submit' name='submit' style="background-color: #124559;color: white;border-radius: 7px;" value='Artist Bilgilerini Kaydet'>
							<a href="isle.php?islem=artist_silme&artist_id=<?php echo $y_id; ?>" class="yazar_sil_button">
							Artist Sil
							</a>
						</td>
				 </tr>
				</table>        
			  </form>

		</td>
		</tr>
		<tr>
		<td>		
			<table class="table table-borderless" width='100%' id="dataTable" cellpadding="0" cellspacing="0">
			<thead>
			  <tr>
				<th style='text-align:center' width="20%"></th>
				<th style='text-align:center' width="30%">Album Adı</th>
			  </tr>
			<thead>
			<tbody>
				<?php
				while ( $satir_kitap = mysqli_fetch_array($sorgu_kitap)) {
						$kitap_id = $satir_kitap['ID'];
						
						$ks = mysqli_num_rows(mysqli_query($conn,"select * from album where artist_id = $y_id "));
				$encryption_key = "sifreleme_123456";
				$sifreli_id = openssl_encrypt($y_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
				$sifreli_id = base64_encode($sifreli_id);
				?>
			
				<tr>
				<td style="text-align:center; vertical-align: middle;"><a href="?istek=kitap_detay&kitap=<?php echo $sifreli_id; ?>"> <img style="border-radius: 5%;" width=125 height=200 src="../<?php echo $satir_kitap['image']; ?>"></a></td>
				<td style="color:red; text-align:center; vertical-align: middle;"><?php echo $satir_kitap['name']; ?></td>
			   </tr>
				<?php } ?>
			</tbody>			
			</table>		
		</td>
		</tr>
		</tbody>			
		</table>
		</div>
	
 
	</div>	
	</div>
	
	
<script>
      ClassicEditor
      .create( document.querySelector( '#yazar_ozgecmis' ), {
		language: 'tr',
		mediaEmbed: {
             previewsInData:true
        }
        } )
        .then( editor => {
          console.log(editor);
        })
        .catch( error => {
            console.error( error );
        } );
</script>

  <script>
  // ajax    
  $('form#yazar_bilgileri').submit(function(event) {
    event.preventDefault(); 
		$('#sonuc').fadeIn().html("<img src=admin_img/l.gif width=24 height=24 valign='middle'>");
    var form = $(this);
    var formVeri= new FormData($('form#yazar_bilgileri')[0]);   
    $.ajax({
      type: form.attr('method'),
      url: form.attr('action'),
	  contentType: form.attr('enctype'),
      processData: false,
      contentType: false,
      data: formVeri,
	        success: function(response) {
                $('#sonuc').html(response);
            }  
	  });
  });	 
</script>



