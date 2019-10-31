<?php

include 'config.php';
include "cliente.php";
include DBAPI;

if(!empty($_POST) and isset($_POST))
{
    $cli = new Cliente();
    $cli -> setNomeCli($_POST['nome']);
    $cli -> setCpfCli(($_POST['cpf']));
    $cli->setNumCel($_POST['celular']);
    $cli->setEmail($_POST['email']);
    $cli->setRua($_POST['rua']);
    $cli->setNumero($_POST['numrua']);
    $cli->setBairro($_POST['bairro']);
    $cli->setComplemento($_POST['complemento']);
    $cli->setCidade($_POST['cidade']);
    $cli->setCep($_POST['cep']);

    $db = open_database();
    $sql = "select * from usuario where email = '".$cli -> getEmail()."' ";
    $exec = $db->query($sql);
    $rows = $exec->num_rows;
    if($rows>0)
    {
        $msg = 1;
    }
    else
    {
        $sql = "INSERT INTO usuario(id, nome, cpf, celular, email, rua, numero, bairro, complemento, cidade, cep) 
VALUES (null,'".$cli->getNomeCli()."','".$cli->getCpfCli()."','".$cli->getNumCel()."','".$cli->getEmail()."','".$cli->getRua()."'
,'".$cli->getNumero()."','".$cli->getBairro()."','".$cli->getComplemento()."','".$cli->getCidade()."','".$cli->getCep()."')";
        $exec = $db->query($sql);
        header('location:login.php');

    }

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="widht=device-width,initial-scale=1.0"/>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.mask.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
            $('#celular').mask('(00)0 0000-0000');
            $('#cep').mask('00000-000');
        })
    </script>
</head>
<body>
<div>
    
    <div class="container">
        <header>

            <nav class="nav-container">
                <a href="index.html"><img id="logo" src="img/logo.jpg" alt="Super Rango"></a><br>
                <h1 id="titulo">SUPER RANGO</h1>
            </nav>
        </header>
    </div>
<div class="wrapper">
<h1>Cadastro do Cliente</h1>


            <form action="" method="post">
                <div class="bloco">
                    <div id="esquerda">
                        <label> Nome:<br>
                        <input type="text" name="nome" required placeholder="Nome"></label><br>
                        <label>CPF:<br>
                        <input type="text" name="cpf" id="cpf" required placeholder="CPF"></label><br>
                        <label>Número do Celular:(sem espaço)<br>
                        <input type="text" name="celular" id="celular" required placeholder="xx xxxxxxxxx"></label><br>
                        <label>E-mail:<br>
                        <input type="email" name="email" required placeholder="E-mail"></label><br>
                        <label>Rua:<br>
                        <input type="text" name="rua" required placeholder="Nome da rua"></label><br>
                    </div>


                    <div id="direita">
                        <label>Número:<br>
                        <input type="text" name="numrua" required placeholder="Número da casa"></label><br>
                        <label>Bairro:<br>
                        <input type="text" name="bairro" required placeholder="Nome do bairro"></label><br>
                        <label>Complemento (opcional):<br>
                        <input type="text" name="complemento" placeholder="Complemento"></label><br>
                        <label>Cidade:<br>
                        <input type="text" name="cidade" required placeholder="Nome da cidade"></label><br>
                        <label>CEP:<br>
                        <input type="text" name="cep" id="cep" required placeholder="CEP da cidade"></label><br>
                        <input type="submit" value="Enviar">
                        <h2>Já tem sua conta?<a href="login.php">Login</a></h2>
                            <?php
                            if(isset($msg) and $msg == 1)
                            {
                                echo "<h2>E-mail já cadastrado!</h2>";
                            }
                            ?>
                    </div>
                </div>
            </form>


</div>
</body>
</html>