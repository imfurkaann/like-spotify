<!DOCTYPE html>

<?php
include('baglan.php');
$sorgu_gnl = mysqli_query($conn,"select * from genel_bilgiler");
$genel_bilgiler = mysqli_fetch_array($sorgu_gnl);

$artist_id = $_GET['id'];
$sorgu_artist = mysqli_query($conn, "select * from artist where ID = $artist_id");
$artist = mysqli_fetch_array($sorgu_artist);
?>

<html lang="en">

<head>
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
                                        <a href="login.php" id="loginBtn">Giriş / Kayıt</a>
                                    </div>

                                    
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

    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="bradcumbContent">
            <p></p>
            <h2><?php echo $artist['name'] ?></h2>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Album Catagory Area Start ##### -->
    <section class="album-catagory section-padding-100-0">

        <div class="container">

            <div class="row oneMusic-albums">

            <?php
            $sorgu_albums = mysqli_query($conn, "select * from album where artist_id = $artist_id");
            while ( $album = mysqli_fetch_array($sorgu_albums) ) {
            ?>
                <!-- Single Album -->
                <div class="col-12 col-sm-4 col-md-3 col-lg-2 single-album-item t">
                    <div class="single-album">
                        <img src="<?php echo $album['image'] ?>" alt="">
                        <div class="album-info">
                            <a href="albums-music.php?id=<?php echo $album['ID'] ?>">
                                <h5><?php echo $album['name'] ?></h5>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>


            </div>
        </div>
    </section>




    <section class="events-area section-padding-100">
        <div class="container">
            <div class="row">

            <?php
            $sorgu_events = mysqli_query($conn, "select * from event where artist_id = $artist_id");
            while ( $event = mysqli_fetch_array($sorgu_events) ) { 
            ?>
                <!-- Single Event Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-event-area mb-30">
                        <div class="event-thumbnail">
                            <img src="<?php echo $event['image'] ?>" alt="">
                        </div>
                        <div class="event-text">
                            <h4><?php echo $event['title'] ?></h4>
                            <div class="event-meta-data">
                                <a href="#" class="event-place"><?php echo $event['city'] ?></a>
                                <a href="#" class="event-date"><?php echo date("F jS, Y", strtotime($event['datetime'])) ?></a>
                            </div>
                            <a href="event-info.php?id=<?php echo $event['ID'] ?>" class="btn see-more-btn">See Event</a>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </section>

   

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container">
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-12 col-md-6">
                    <a href="#"><img src="img/core-img/footerlogo.png" alt=""></a>
                    <p class="copywrite-text"><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
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