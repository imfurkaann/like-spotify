
<?php
include_once('editor_fonks.php');
include_once('editor_ses_kontrol.php');
	if ( $yetki_seviyesi <> 2 ) {
		yazdir_yetkisiz_islem();
		die;
	}
	
$sorgu_artist = mysqli_query($conn,"select * from album");
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
					<h1 class="h3 mb-4 text-gray-800">Albüm Silme</h1>					
						<div class="card-body">
						
		<div class="table-responsive">
		<table width='80%' >
		<tbody>
		<tr>
		<td>
			  <form id='music' name='music' method="post" enctype="multipart/form-data" action="isle.php?islem=music_ekle">  
			  <table class="table table-bordered" cellpadding="0" cellspacing="0">
				 
					<td><strong>Albüm</strong></td>
					<td><select name="album" id="album">
                        <option>Lütfen seçin</option>
                        <?php 
                        while ( $artist = mysqli_fetch_array($sorgu_artist) ) {
                        ?>
                        <option value="<?php echo $artist['ID'] ?>"><?php echo $artist['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select></td>
				  </tr>
				  <tr>
					  <td style="text-align:right; vertical-align: middle;"><span id='sonuc'></span></td>
					  <td style="text-align:left; vertical-align: middle;">
							<input type='submit' name='submit' style="background-color: #124559;color: white;border-radius: 7px;" value='Albüm Sil'>
						</td>
				 </tr>
				</table>        
			  </form>

		</td>
		</tr>
		</tbody>			
		</table>
		</div>
	
 
	</div>	
	</div>	
	

  <script>
  // ajax    
  $('form#music').submit(function(event) {
    event.preventDefault(); 
		$('#sonuc').fadeIn().html("<img src=admin_img/l.gif width=24 height=24 valign='middle'>");
    var form = $(this);
    var formVeri= new FormData($('form#music')[0]);   
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



