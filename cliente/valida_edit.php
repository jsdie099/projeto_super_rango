<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(!isset($_SESSION['logado']))
    {
        header('location:login.php');
    }
    require_once "config.php";
    require_once DBAPI;
    $_SESSION['logado'];
    require_once "cliente.php";

    $db = open_database();

    $cli = new Cliente();
    $cli->setNomeCli($_POST['nome']);
    $cli->setCpfCli($_POST['cpf']);
    $cli->setNumCel($_POST['celular']);
    $cli->setEmail($_POST['email']);
    $cli->setRua($_POST['rua']);
    $cli->setNumero($_POST['numrua']);
    $cli->setBairro($_POST['bairro']);
    $cli->setComplemento($_POST['complemento']);
    $cli->setCidade($_POST['cidade']);
    $cli->setCep($_POST['cep']);


    $nome = $cli->getNomeCli();
    $cpf = $cli->getCpfCli();
    $celular = $cli->getNumCel();
    $email = $cli->getEmail();
    $rua = $cli->getRua();
    $num_rua = $cli->getNumero();
    $bairro = $cli->getBairro();
    $complemento = $cli->getComplemento();
    $cidade = $cli->getCidade();
    $cep = $cli->getCep();

    ($_GET['id']==base64_encode($_SESSION['id']))?$id = base64_decode($_GET['id']):$id=$_SESSION['id'];

    $sql = "update usuario set nome=?, cpf=?, celular=?, email=?, rua=?, numero=?, bairro=?, complemento=?, cidade=?, cep=?
    where id=?";
    $exec = $db->prepare($sql);
    $exec->bind_param("ssssssssssi",$nome,$cpf,$celular,$email,$rua,$num_rua,$bairro,$complemento,$cidade,$cep,$id);
    $exec->execute();
    /*$sql = "update usuario set nome='".$cli->getNomeCli()."',cpf='".$cli->getCpf()."',
    celular='".$cli->getNumCel()."',email='".$cli->getEmail()."',rua='".$cli->getRua()."',
    numero='".$cli->getNumero()."',bairro='".$cli->getBairro()."',complemento='".$cli->getComplemento()."',
    cidade='".$cli->getCidade()."',cep='".$cli->getCep()."' where id=".$id;
    $exec = $db->query($sql);*/
    $_SESSION['msg'] = "<h2>Seus dados foram Alterados com sucesso!</h2>";
    header('location:dados.php?id='.base64_encode($_SESSION['id']));





