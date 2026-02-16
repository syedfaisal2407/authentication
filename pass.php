    //MD5 algorithm

    <?php
        $str = "my_password";
        echo md5($str);
    ?>


    //Bcrypt algorithm

    <?php
    $password = "my_password";
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    echo $hashed_password;
    ?>

