<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <!-- CSS linkleri buraya -->
</head>
<body>

<div class="col-12 col-sm-6 col-md-4 col-lg-2">
    <div class="single-album-area wow fadeInUp" data-wow-delay="300ms">
        <div class="album-thumb">
            <img src="img/bg-img/b1.jpg" alt="">                            
        </div>
        <div class="album-info">
            <a href="#">
                <h5>Garage Band</h5>
            </a>
            <p>Radio Station</p>
        </div>
    </div>
</div>

<!-- JavaScript kodu buraya -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var audio = new Audio("audio/dummy-audio.mp3"); // Müzik dosyasının adresini buraya yazın

        var albumThumb = document.querySelector('.album-thumb');
        var isPlaying = false;

        albumThumb.addEventListener('click', function () {
            if (isPlaying) {
                audio.pause();
                isPlaying = false;
            } else {
                audio.play();
                isPlaying = true;
            }
        });
    });
</script>

</body>
</html>