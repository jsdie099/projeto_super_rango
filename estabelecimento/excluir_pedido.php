<?php
    include "config.php";
    include DBAPI;
    $id = base64_decode($_GET['id']);
    $db = open_database();
    $sql = "update pedido set status = 0 where id=?";
    $exec = $db->prepare($sql);
    $exec->bind_param("i",$id);
    $exec->execute();
    header('location:telafunc.php');
?>
