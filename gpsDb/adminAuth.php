<?php
    session_start();

    if (!$_SESSION['isAdmin']){
        //First we check wether isAdmin exists, which means he is logged in
        //then we check if he's ad Admin, and then, if he is not...
        header('Location: index.php');
    }

?>
