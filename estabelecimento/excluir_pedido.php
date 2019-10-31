<?php
    include "config.php";
    include DBAPI;
    $id = $_GET['id'];
    $db = open_database();
    $sql = "update pedido set status = 0 where id = ".$id;
    $exec = $db->query($sql);
    header('location:telafunc.php');
?>
