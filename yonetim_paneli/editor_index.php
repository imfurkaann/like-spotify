<!DOCTYPE html>
<html lang="tr">
<?php
session_start();
include('editor_fonks.php');
include('editor_ses_kontrol.php');
$kid = $_SESSION['giris_yapan_uye'];
include('../baglan.php');

	$sorgu = mysqli_query($conn,"select * from uyeler where id='$kid' ");
    $satir = mysqli_fetch_array($sorgu);
	
	
	
$id = @$_GET['istek'];

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Spotimy Editör Paneli </title>

    <!-- Custom fonts for this template-->
    <link href="admin_vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin_css/sb-admin-2.min.css" rel="stylesheet">
	<link href="admin_css/ek.css" rel="stylesheet">
	
	    <script src="admin_vendor/jquery/jquery.min.js"></script>
		
	<script src="admin_vendor/ckeditor5-41.2.1-usmxa9flxj4t/build/ckeditor.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="editor_index.php">
                <div class="sidebar-brand-text mx-3">Spotimy Kullanıcı Paneli</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="editor_index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Anasayfa</span></a>
            </li>
			<?php
			
				if ( $yetki_seviyesi == 2 ) {
			?>

            <!-- Divider -->
            <hr class="sidebar-divider">

             <!-- Heading -->
            <div class="sidebar-heading">
                Sanatçılar
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="?istek=artists&yazar_basharf=tum">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Sanatçılar</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?istek=artist_ekle">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Artist Ekleme</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?istek=album_ekle">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Albüm Ekleme</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?istek=music_ekle">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Müzik Ekleme</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?istek=egitim_ekle">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Eğitim Ekleme</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?istek=etkinlik_ekle">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Etkinlik Ekleme</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?istek=ticket_goster">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Ticket Listeleme</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="?istek=music_delete">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Müzik Silme</span></a>
            </li>
			
			<li class="nav-item">
                <a class="nav-link" href="?istek=album_delete">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Albüm Silme</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

			<?php
				} 
			if ( $yetki_seviyesi >= 1 ) {
			?>

            
			<?php
				}
			?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $satir['adi']." ".$satir['soyadi']; ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="cikis.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Çıkış
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
				
				   <?php 
		if ( $id == "artist_ekle" ) {
			include('editor_artist_ekle.php');
		} elseif ( $id == "artists" ) {
			include('editor_artists.php');
		} elseif ( $id == "artist" ) {
			include('editor_artist.php');
		} elseif ( $id == "album_ekle" ) {
			include('editor_album_ekle.php');
		} elseif ( $id == "music_ekle" ) {
			include('editor_music_ekle.php');
		} elseif ( $id == "egitim_ekle" ) {
            include('editor_egitim_ekle.php');
        } elseif ( $id == "etkinlik_ekle" ) {
            include('editor_etkinlik_ekle.php');  
        } elseif ( $id == "ticket_goster" ) {
            include('ticket_goster.php');  
        }elseif ( $id == "music_delete" ) {
            include('music_delete.php');  
        }elseif ( $id == "album_delete" ) {
            include('album_delete.php');  
        }
		 
		else{
		?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Anasayfa</h1>                        
                    </div>

				
                 <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                        <?php   
                            $bugunun_tarihi = date("Y-m-d");
                            $sorgu_gunluk = mysqli_query($conn, "SELECT ziyaretci_sayisi FROM ziyaretci_takip WHERE tarih = ' $bugunun_tarihi'");
                            $gunluk_sayi = mysqli_fetch_array($sorgu_gunluk, MYSQLI_ASSOC);


                        ?>


                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Ziyaret (Günlük)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $gunluk_sayi['ziyaretci_sayisi'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                            <?php
                                $hafta_baslangic = date("Y-m-d", strtotime("last Sunday"));
                                $hafta_bitis = date("Y-m-d", strtotime("next Saturday"));

                                $sorgu_haftalik = mysqli_query($conn, "SELECT SUM(ziyaretci_sayisi) AS haftalik_ziyaret FROM ziyaretci_takip WHERE tarih BETWEEN '$hafta_baslangic' AND '$hafta_bitis'");
                                $haftalik_sayi = mysqli_fetch_array($sorgu_haftalik, MYSQLI_ASSOC);
                              
                            ?>
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Ziyaret (Haftalık)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $haftalik_sayi['haftalik_ziyaret'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                            <?php
                                $ay_baslangic = date("Y-m-01");
                                $ay_bitis = date("Y-m-t");

                                $sorgu_aylik = mysqli_query($conn, "SELECT SUM(ziyaretci_sayisi) AS aylik_ziyaret FROM ziyaretci_takip WHERE tarih BETWEEN '$ay_baslangic' AND '$ay_bitis'");
                                $aylik_sayi = mysqli_fetch_array($sorgu_aylik, MYSQLI_ASSOC);
                              
                            ?>
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ziyaret (Aylık)
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $aylik_sayi['aylik_ziyaret'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">

                                <?php
                                    $sorgu_tum = mysqli_query($conn, "SELECT SUM(ziyaretci_sayisi) AS toplam_ziyaret FROM ziyaretci_takip");
                                    $tum_sayi = mysqli_fetch_array($sorgu_tum, MYSQLI_ASSOC);


                                ?>


                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Ziyaret (Toplam)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $tum_sayi['toplam_ziyaret'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"> 
                                    <h6 class="m-0 font-weight-bold text-primary">Türlerine Göre Müzik Sayıları </h6>
                                </div>
                                <!-- Card Body -->
                                <?php
                                    $sorgu_artist = mysqli_query($conn, "SELECT type FROM music");

                                    $types = array();
                                    if ($sorgu_artist) {
                                        while ($row = mysqli_fetch_assoc($sorgu_artist)) {
                                            $types[] = $row['type'];
                                        }
                                        $type_counts = array_count_values($types);
                                    }

                                    ?>
                                <div class="card-body">
                                    
                                <ul>
                                    <?php foreach ($type_counts as $type => $count): ?>
                                        <li><?php echo $type; ?>       ---- <?php echo $count; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                    
                                </div>

                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"> 
                                    <h6 class="m-0 font-weight-bold text-primary">Toplam Sanatçı Sayısı </h6>
                                </div>
                                <!-- Card Body -->
                                <?php
                                    $sorgu_uye_sayisi = mysqli_query($conn, "SELECT COUNT(*) as uye_sayisi FROM artist");

                                    if ($sorgu_uye_sayisi) {
                                        $row = mysqli_fetch_assoc($sorgu_uye_sayisi);
                                        
                                    } 

                                    ?>

                                    
                                <div class="card-body">
                                    
                                <ul>
                                    <?php echo $row['uye_sayisi'] ?>
                                </ul>
                                    
                                </div>

                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"> 
                                    <h6 class="m-0 font-weight-bold text-primary">Toplam Albüm Sayısı </h6>
                                </div>
                                <!-- Card Body -->
                                <?php
                                    $sorgu_uye_sayisi = mysqli_query($conn, "SELECT COUNT(*) as uye_sayisi FROM album");

                                    if ($sorgu_uye_sayisi) {
                                        $row = mysqli_fetch_assoc($sorgu_uye_sayisi);
                                        
                                    } 

                                    ?>
                                <div class="card-body">
                                    
                                <ul>
                                    <?php echo $row['uye_sayisi'] ?>
                                </ul>
                                    
                                </div>

                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"> 
                                    <h6 class="m-0 font-weight-bold text-primary">Toplam Üye Sayısı</h6>
                                </div>
                                <!-- Card Body -->
                                <?php
                                    $sorgu_uye_sayisi = mysqli_query($conn, "SELECT COUNT(*) as uye_sayisi FROM uyeler");

                                    if ($sorgu_uye_sayisi) {
                                        $row = mysqli_fetch_assoc($sorgu_uye_sayisi);
                                        
                                    } 
                                    ?>
                                <div class="card-body">
                                    
                                <ul>
                                    <?php echo $row['uye_sayisi'] ?>
                                </ul>
                                    
                                </div>

                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"> 
                                    <h6 class="m-0 font-weight-bold text-primary">Türlere Göre Toplam Eğitim Sayısı</h6>
                                </div>
                                <!-- Card Body -->
                                <?php
                                    $sorgu_artist = mysqli_query($conn, "SELECT type FROM education");

                                    $types = array();
                                    if ($sorgu_artist) {
                                        while ($row = mysqli_fetch_assoc($sorgu_artist)) {
                                            $types[] = $row['type'];
                                        }
                                        $type_counts = array_count_values($types);
                                    }

                                    ?>
                                <div class="card-body">
                                    
                                <ul>
                                    <?php foreach ($type_counts as $type => $count): ?>
                                        <li><?php echo $type; ?>       - <?php echo $count; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                    
                                </div>
                            </div>

                            
                        </div>
						
<!-- Grafik 10 -->

<?php
$sorgu_artist = mysqli_query($conn, "SELECT type FROM music");

$types = array();
if ($sorgu_artist) {
    while ($artist = mysqli_fetch_assoc($sorgu_artist)) {
        $types[] = $artist['type'];
    }
} else {
    echo "Sorgu başarısız: " . mysqli_error($conn);
}
?>

<script>
        const labels = <?php echo json_encode($types); ?>;
        
        new Chart(document.getElementById("gr2"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Type',
                    backgroundColor: "#d9ed92",
                    fill: true,
                    data: [23, 26, 56], // Burada gerçek verilerinizi kullanabilirsiniz
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>



		<?php
		}
		?>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Spotimy Yönetim Sistemi</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Çıkış Onay</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Oturumu sonlandırmak istediğinize emin misiniz?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
                    <a class="btn btn-primary" href="../index.php">Çıkış</a>
                </div>
            </div>
        </div>
    </div>

 <!-- Bootstrap core JavaScript-->
    <script src="admin_vendor/jquery/jquery.min.js"></script>
    <script src="admin_vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin_vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin_js/sb-admin-2.min.js"></script>


    <!-- Page level plugins -->
    <script src="admin_vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin_js/demo/datatables-demo.js"></script>	

</body>

</html>











