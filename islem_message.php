<?php
    include("baglan.php");

        $message = mysqli_real_escape_string($conn,@$_GET['message']);

        $sql = "insert into message(message) values ('$message')";

        if (mysqli_query($conn,$sql)) {
            echo "Mesajınız Gönderildi</center>";
        } else{ echo "Beklenmeyen bir hata oluştu.";}

?>