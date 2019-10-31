<?php
    include "config.php";
    include DBAPI;
    if(!isset($_SESSION))
    {
        session_start();
    }

    unset($_SESSION['logado']);

    header('location:index.html');
?>
