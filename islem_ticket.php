<?php
    include("baglan.php");

        $name = mysqli_real_escape_string($conn,@$_GET['name']);
        $email = mysqli_real_escape_string($conn,@$_GET['email']);
        $subject = mysqli_real_escape_string($conn,@$_GET['subject']);
        $message = mysqli_real_escape_string($conn,@$_GET['message']);

        $sql = "insert into ticket(name, mail, subject, message) values ('$name','$email', '$subject', '$message' )";

        if (mysqli_query($conn,$sql)) {
            echo "Mesajınız Gönderildi</center>";
        } else{ echo "Beklenmeyen bir hata oluştu.";}

?>