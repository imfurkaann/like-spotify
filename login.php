<!DOCTYPE html>
<html lang="en">

<?php
include('baglan.php');
$sorgu_gnl = mysqli_query($conn,"select * from genel_bilgiler");
$genel_bilgiler = mysqli_fetch_array($sorgu_gnl);
?>


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
                        <a href="index.php" class="nav-brand"><img src="img/core-img/logo.png" alt=""></a>

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
            <h2>Giriş Yapın</h2>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Login Area Start ##### -->
    <section class="login-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="login-content">
                        <h3>Hoşgeldiniz</h3>
                        <!-- Login Form -->
                        <div class="login-form">
                            <form action="#" method="post" id="giris_form">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="kullanici" aria-describedby="emailHelp" placeholder="E-mail">
                                    <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>E-mail'ini kimseyle paylaşmıyoruz.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Şifre</label>
                                    <input type="password" class="form-control" name="sifre" id="exampleInputPassword1" placeholder="Şifre">
                                </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <label for="login-dkod">Doğrulama Kodu : <img valign='middle' src="yonetim_paneli/admin_img/img_kod.php" height="20" width="60" /></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" min="100" max="999" required name='kod' class="form-control form-control-user"
                                                id="exampleInputDKod"
                                                placeholder="Yukarıda gösterilen kodu giriniz">
                                        </div>
									<div style='min-height:70px;' id='sonuc_giris'>
                                <button type="submit" class="btn oneMusic-btn mt-30">Giriş</button>
                            
                            </form>

                            <form action="yonetim_paneli/kayit.php" method="post">
                                <button type="submit" class="btn oneMusic-btn mt-30">Kayıt</button>
                            </form>

                            <form action="yonetim_paneli/sifremi_unuttum.php" method="post">
                                <button type="submit" class="btn oneMusic-btn mt-30">Şifremi Unuttum</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Login Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container">
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-12 col-md-6">
                    <a href="#"><img src="img/core-img/logo.png" alt=""></a>
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

    <script type="text/javascript">
        $(document).on('submit','form#giris_form',function giris(){
        event.preventDefault(); // Tarayıcının form submit etmesini engelleyelim	
        $('#sonuc_giris').html("<p><center><img src='yonetim_paneli/admin_img/l.gif' height=24 width=24 /></center>");

        $.ajax({
            type: 'POST',
            url: 'yonetim_paneli/isle.php',
            data: $('form#giris_form').serialize() + '&islem=giris_kontrol&r='+Math.random(),
            success: function(ajaxCevap) {
        $('#sonuc_giris').html(ajaxCevap);
            }
        });
        return false;
        });
    </script>

</body>

</html>