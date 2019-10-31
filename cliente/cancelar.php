<?php
    require_once "config.php";
    require_once DBAPI;

    $db = open_database();
    $sql = "delete from pedido where id =".base64_decode($_GET['id']);
    $exec = $db->query($sql);
    $id = base64_encode($_GET['id']);
    header('location:historico.php?id='.$id);
