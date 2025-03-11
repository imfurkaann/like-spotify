<!DOCTYPE html>

<?php
include('baglan.php');
$sorgu_gnl = mysqli_query($conn,"select * from genel_bilgiler");
$genel_bilgiler = mysqli_fetch_array($sorgu_gnl);

?>

<html lang="en">

<head>

    <style>
        .album-thumb {
            position: relative;
            background-color: #fff; /* Arka plan rengi belirle (örneğin, beyaz) */
        }

        .play-stop-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 45%;
            height: 45%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            opacity: 0; /* İlk başta görünmez */
            transition: opacity 0.3s ease; /* Geçiş efekti ekle */
        }

        .play-stop-overlay img {
            width: 50px; /* Özel boyutlandırma */
            height: auto;
        }

        #album-area:hover .play-stop-overlay {
            opacity: 1; /* Üzerine gelince görünür olacak */
        }


    </style>



    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?php echo $genel_bilgiler['site_ismi'] ?></title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Navbar Area -->
        <div class="oneMusic-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="oneMusicNav">

                        <!-- Nav brand -->
                        <a href="index.php" class="nav-brand"><img src="img/core-img/newlogo.png" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.php">Anasayfa</a></li>
                                    <li><a href="albums-store.php">Albümler</a></li>
                                    <li><a href="blog.php">Eğitim</a></li>
                                    <li><a href="event.php">Etkinlikler</a></li>
                                    <li><a href="contact.php">İletişim</a></li>
                                </ul>

                                <!-- Login/Register & Cart Button -->
                                <div class="login-register-cart-button d-flex align-items-center">
                                    <!-- Login/Register -->
                                    <div class="login-register-btn mr-50">
                                        <a href="login.php" id="loginBtn">Giriş / Kayıt </a>
                                    </div>

                                    <!-- Cart Button -->
                                    
                                </div>
                            </div>
                            <!-- Nav End -->

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide -->
            <div class="single-hero-slide d-flex align-items-center justify-content-center">
                <!-- Slide Img -->
                <div class="slide-img bg-img" style="background-image: url(img/bg-img/bg-1.jpg);"></div>
                <!-- Slide Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-slides-content text-center">
                                <h6 data-animation="fadeInUp" data-delay="100ms">Zamanın Ötesinde</h6>
                                <h2 data-animation="fadeInUp" data-delay="300ms">New Music Friday <span>New Music Friday</span></h2>
                                <a data-animation="fadeInUp" data-delay="500ms" href="albums-store.php" class="btn oneMusic-btn mt-50">Keşfet <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Hero Slide -->
            <div class="single-hero-slide d-flex align-items-center justify-content-center">
                <!-- Slide Img -->
                <div class="slide-img bg-img" style="background-image: url(img/bg-img/bg-2.jpg);"></div>
                <!-- Slide Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-slides-content text-center">
                                <h6 data-animation="fadeInUp" data-delay="100ms">En Canlı Müzikler</h6>
                                <h2 data-animation="fadeInUp" data-delay="300ms">Etkinlikler <span>Etkinlikler</span></h2>
                                <a data-animation="fadeInUp" data-delay="500ms" href="event.php" class="btn oneMusic-btn mt-50">Keşfet <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Latest Albums Area Start ##### -->
    <section class="latest-albums-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading style-2">
                        <p>Yenilikleri görün</p>
                        <h2>En Yeni Albümler</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9">
                    <div class="ablums-text text-center mb-70">
                        <p>"En Yeni Albümler" bölümüne hoş geldiniz! Burası, müziğin en taze ve heyecan verici lezzetlerinin bir araya geldiği yer. Her albüm, yeni bir müzik yolculuğuna çıkmanızı sağlayacak bir anahtar gibidir!Yepyeni albümler ve sanatçılarla dolu bu dünyada, sıkıcı anlar yok! Albümler, sizi müziğin büyülü dünyasına götürecek bir davettir. Hadi, yeni sesler keşfetmek ve ritmin tadını çıkarmak için bu renkli dünyaya adım atın!</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="albums-slideshow owl-carousel">


                    <?php
                        $sorgu_album = mysqli_query($conn,"select * from album order by rand() limit 10 ");
                        $say_album = mysqli_num_rows($sorgu_album);
                        
                            if ( $say_album > 0 ) {
                            
                                while ( $satir_album = mysqli_fetch_array($sorgu_album) ) {
                                    
                        ?>
                        
                        <!-- Single Album -->
                        <div class="single-album">
                            <img src="<?php echo $satir_album['image']?>" style="width : 200px ; height:200px">
                            <div class="album-info">
                                <a href="albums-music.php?id=<?php echo $satir_album['ID'] ?>">
                                    <h5><?php echo $satir_album['name']?></h5>
                                </a>
                            <?php 
                            $artist_id = $satir_album['artist_id'];
                            $sorgu_artist_name = mysqli_query($conn, "select name from artist where ID=$artist_id");
                            $artist_name = mysqli_fetch_array($sorgu_artist_name);
                            ?>
                            <p><?php echo $artist_name['name']?></p>
                            </div>
                        </div>
                            
                    <?php  		} }		?>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Latest Albums Area End ##### -->

   
    <!-- ##### Featured Artist Area Start ##### -->
    <section class="featured-artist-area section-padding-100 bg-img bg-overlay bg-fixed" style="background-image: url(img/bg-img/bg-4.jpg);">

                        <?php 
                        $rand_music_query = mysqli_query($conn, "select * from music order by rand() limit 1");
                        $rand_music = mysqli_fetch_array($rand_music_query);
                        $album_id = $rand_music['album_id'];
                        $sorgu_album = mysqli_query($conn,"select * from album where ID = $album_id");
                        $album = mysqli_fetch_array($sorgu_album);
                        $artist_id = $album['artist_id'];
                        $sorgu_artist_name = mysqli_query($conn, "select name from artist where ID=$artist_id");
                        $artist_name = mysqli_fetch_array($sorgu_artist_name);
                        ?>

        <div class="container">
            <div class="row align-items-end">
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="featured-artist-thumb">
                        <img src="<?php echo $album['image'] ?>" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-7 col-lg-8">
                    <div class="featured-artist-content">
                        <!-- Section Heading -->
                        <div class="section-heading white text-left mb-30">
                           
                            <h2>Rastgele Bir Parça Dinleyin</h2>
                        </div>
                        <p>Burası, müziğin sınırlarını zorlayan ve sizi şaşırtacak önerilerin bulunduğu bir cennettir. Bu bölüm, müzik zevkinizi zenginleştirmek ve yeni sesler keşfetmek için mükemmel bir yerdir! Her ziyaretinizde sizi farklı bir müzik yolculuğuna çıkaracak bir şarkı bulabilirsiniz. Bu bölüm, rastgele seçilen şarkılarla doludur ve sizi beklenmedik ve heyecan verici bir müzik deneyimine götürebilir! Hadi, biraz risk alın ve müzik dünyasının derinliklerine dalın! Unutulmaz bir müzik keşfi için "Rasgele Parça Önerisi"ne göz atın!</p>

                        <div class="song-play-area">
                            <div class="song-name">
                                <p><?php echo $artist_name['name']." - ".$rand_music['name'] ?></p>
                            </div>
                            <audio preload="auto" controls>
                                <source src="<?php echo $rand_music['path'] ?>">
                            </audio>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Featured Artist Area End ##### -->

    <!-- ##### Miscellaneous Area Start ##### -->
    <section class="miscellaneous-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- ***** Weeks Top ***** -->

                <div class="col-12 col-lg-4">
                    <div class="weeks-top-area mb-100">
                        <div class="section-heading text-left mb-50 wow fadeInUp" data-wow-delay="50ms">
                            <h2>Önerilen Albümler</h2>
                        </div>

                    <?php
                    $sorgu_album = mysqli_query($conn,"select * from album order by rand() limit 6 ");
                    $say_album = mysqli_num_rows($sorgu_album);
                    
                        if ( $say_album > 0 ) {
                        
                            while ( $satir_album = mysqli_fetch_array($sorgu_album) ) {
                                
                    ?>
                        <!-- Single Top Item -->
                        <div class="single-top-item d-flex wow fadeInUp" data-wow-delay="100ms">
                            <div class="thumbnail">
                                <a href="albums-music.php?id=<?php echo $satir_album['ID'] ?>"> <img src="<?php echo $satir_album['image']?>" style="width : 80px ; height:80px"> </a>
                            </div>
                            <div class="content-">
                                <h6><?php echo $satir_album['name']?></h6>

                                <?php 
                                $artist_id = $satir_album['artist_id'];
                                $sorgu_artist_name = mysqli_query($conn, "select name from artist where ID=$artist_id");
                                $artist_name = mysqli_fetch_array($sorgu_artist_name);
                                ?>
                                <p><?php echo $artist_name['name']?></p>
                            </div>
                        </div>

                    <?php  		} }		?>

                        
                    </div>
                </div>

                <!-- ***** New Hits Songs ***** -->
                <div class="col-12 col-lg-4">
                    <div class="new-hits-area mb-100">
                        <div class="section-heading text-left mb-50 wow fadeInUp" data-wow-delay="50ms">
                            <h2>Önerilen Parçalar</h2>
                        </div>

                        <?php
                        $sorgu_music = mysqli_query($conn, "select * from music order by rand() limit 6");
                        $say_music = mysqli_num_rows($sorgu_music);
                        $sorgu_album = mysqli_query($conn,"select * from album order by rand() limit 6 ");
                        $say_album = mysqli_num_rows($sorgu_album);
                    
                        if ( $say_music > 0 ) {
                        
                            while ( $satir_music = mysqli_fetch_array($sorgu_music) ) {
                                $album_id = $satir_music['album_id'];
                                $sorgu_album = mysqli_query($conn, "select * from album where ID = $album_id");
                                $satir_album = mysqli_fetch_array($sorgu_album);
                                
                    ?>

                        <!-- Single Top Item -->
                        <div class="single-new-item d-flex align-items-center justify-content-between wow fadeInUp" data-wow-delay="100ms">
                            <div class="first-part d-flex align-items-center">
                                <div class="thumbnail">
                                    <img src="<?php echo $satir_album['image']?>" style="width : 80px ; height:80px">
                                </div>
                                <div class="content-">
                                    <h6><?php echo $satir_music['name']?></h6>
                                    <p><?php echo $satir_album['name']?></p>
                                </div>
                            </div>
                            <audio preload="auto" controls>
                                <source src="<?php echo $satir_music['path'] ?>">
                            </audio>
                        </div>
                       
                        <?php  		} }		?>
                        
                    </div>
                </div>

                <!-- ***** Popular Artists ***** -->
                <div class="col-12 col-lg-4">
                    <div class="popular-artists-area mb-100">
                        <div class="section-heading text-left mb-50 wow fadeInUp" data-wow-delay="50ms">
                            <h2>Sanatçılar</h2>
                        </div>



                        <?php
                        $sorgu_artist = mysqli_query($conn,"select * from artist order by rand() limit 10 ");
                        $say_artist = mysqli_num_rows($sorgu_artist);
                    
                        if ( $say_album > 0 ) {
                        
                            while ( $satir_artist = mysqli_fetch_array($sorgu_artist) ) {
                                
                        ?>

                        <!-- Single Artist -->
                        <div class="single-artists d-flex align-items-center wow fadeInUp" data-wow-delay="100ms">
                            <div class="thumbnail">
                                <a href="artist.php?id=<?php echo $satir_artist['ID'] ?>"><img src="<?php echo $satir_artist['image']?>" alt=""></a>
                            </div>
                            <div class="content-">
                                <p><?php echo $satir_artist['name']?></p>
                            </div>
                        </div>

                        <?php  		} }		?>

                        

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Miscellaneous Area End ##### -->

    
    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container">
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-12 col-md-6">
                    <a href="#"><img src="img\core-img\footerlogo.png" alt=""></a>
                    <p class="copywrite-text"><a href="rapor.php"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
 &copy;<script>document.write(new Date().getFullYear());</script> Proje Raporu <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">imfurkaann</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>

                <div class="col-12 col-md-6">
                    <div class="footer-nav">
                        <ul>
                            <li><a href="index.php">Anasayfa</a></li>
                            <li><a href="albums-store.php">Albümler</a></li>
                            <li><a href="blog.php">Eğitim</a></li>                            
                            <li><a href="event.php">Etkinlikler</a></li>
                            <li><a href="contact.php">İletişim</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>