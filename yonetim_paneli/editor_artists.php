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
                    
					<h1 class="h3 mb-4 text-gray-800">Sanatçılar </h1>					
						<div class="card-body">
						
		<div id="yazar_tablosu">
				<?php
	$yazar_basharf = @$_REQUEST["yazar_basharf"]; 
	// echo $yazar_basharf;
?>	
		<div class="table-responsive">
			<table class="table table-bordered" width='60%' id="dataTable" cellpadding="0" cellspacing="0">
			<thead>
			  <tr>
				<th style='text-align:center' width="20%"></th>
				<th style='text-align:center' width="30%">Adı</th>
				<th style='text-align:center' width="20%"></th>
			  </tr>
			<thead>
			<tbody>
				<?php
		if ( $yazar_basharf == 'tum' )  {
			$sorgu_yazar = mysqli_query($conn,"select * from artist");
		} else { 
	 	$sorgu_yazar = mysqli_query($conn,"select * from artist where substr(name,1,1) = '$yazar_basharf'");
		}
					while ( $satir_yazar = mysqli_fetch_array($sorgu_yazar)) {
						$y_id = $satir_yazar['ID'];
						$ks = mysqli_num_rows(mysqli_query($conn,"select * from album where artist_id = $y_id "));
				
				
				// $sifreli_id = base64_encode($y_id)   ve  $y_id = base64_decode($sifreli_id)
				// AES Simetrik Şifreleme
				// $encryption_key = "sifreleme_anahtari";
				// $sifreli_id = openssl_encrypt($y_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
				// $y_id = openssl_decrypt($sifreli_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
				$encryption_key = "sifreleme_123456";
				$sifreli_id = openssl_encrypt($y_id, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
				$sifreli_id = base64_encode($sifreli_id);
				?>
			
				<tr>
				<td style="text-align:center; vertical-align: middle;"><a href="?istek=artist&artist=<?php echo $sifreli_id; ?>"> <img style="border-radius: 23%;" width=75 height=75 src="../<?php echo $satir_yazar['image']; ?>"></a></td>
				<td style="color:red; text-align:center; vertical-align: middle;"><?php echo $satir_yazar['name']; ?></td>
				<td style="font-weight:bold; text-align:center; vertical-align: middle;"><?php echo $ks; ?></td>
			   </tr>
				<?php } ?>
			</tbody>			
			</table>
		</div>
		</div>		
		
	     
		<form id='yazar_harf_sec' name='yazar_harf_sec' method="post" action="#">
	<?php 
	$sorgu_yazar_ilkharfler = mysqli_query($conn,"select substr(name,1,1) as harf, count(id) as sayi 
										from artist group by substr(name,1,1)");
	?>
		
         <p align='right'> Seçiniz: <select id='yazar_basharf' name='yazar_basharf'>
			<option <?php echo ($yazar_basharf == 'tum') ? "selected" : ""; ?> value='tum'>#</option>
			<?php 
			while ( $satir_ilkharf = mysqli_fetch_array($sorgu_yazar_ilkharfler)) {
				?>				
			<option <?php echo ( $yazar_basharf == $satir_ilkharf['harf']) ? "selected" : "" ?> value='<?php echo $satir_ilkharf['harf']?>'><?php echo $satir_ilkharf['harf']?></option>
	<?php 
	}	
	?>
          </select>
		  </p>
		  </form>
        

						
                           
					  </div>	
				</div>

<script>
  // Get the select element
  var select = document.getElementById("yazar_basharf");
  select.addEventListener("change", function() {
    var selectedOption = select.value;
    document.getElementById("yazar_harf_sec").action = "editor_index.php?istek=artists&yazar_basharf=" + selectedOption;
    document.getElementById("yazar_harf_sec").submit();
  });
</script>
