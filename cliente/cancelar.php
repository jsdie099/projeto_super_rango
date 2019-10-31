<?php
    require_once "config.php";
    require_once DBAPI;

    $id = base64_decode($_GET['id']);
    $db = open_database();
    $sql = "delete from pedido where id =?";
    $exec = $db->prepare($sql);
    $exec->bind_param("i",$id);
    $exec->execute();
    
    header('location:historico.php?id='.base64_encode($_GET['id']));
