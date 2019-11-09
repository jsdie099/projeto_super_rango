<?php

require_once "classe_pedido.php";
require_once "config.php";
require_once DBAPI;
if(!isset($_SESSION))
{
    session_start();
}
if(!isset($_SESSION['logado']))
{
    header('location:login.php');
}
($_GET['id']==base64_encode($_SESSION['id']))?$id = base64_decode($_GET['id']):$id=$_SESSION['id'];
if(isset($_POST) and !empty($_POST))
{
    $pedido = new Pedido();

    $pedido ->setNum($_POST['campo1']);
    $pedido ->getNum();
    $pedido ->setQuantidade($_POST['campo2']);
    $pedido ->getQuantidade();
    $num = $pedido->getNum();
    $qtd = $pedido->getQuantidade();
    $db = open_database();


    $sql_a = " select id,preco from alimento ";
    $exec_a = $db->query($sql_a);
    $rows=$exec_a->num_rows;
    if($rows>0)
    {
        while ($dados = $exec_a->fetch_object())
        {
            $id_a = $dados->id;

            $preco_al = $dados->preco;
            if($num == $id_a && $pedido->getQuantidade()<=30)
            {

                $pedido ->setValor($preco_al);
                $total = $pedido ->getQuantidade()*$pedido->getValor();
                $sql = "insert into pedido(id_cliente,tipo,preco,quantidade,status) values(?,?,?,?,1)";
                $exec = $db->prepare($sql);
                $exec->bind_param("iidi",$id,$num,$total,$qtd);
                $exec->execute();

                header('location:pedido2.php?id='.$id);

                //values(null ,".$id.",".$num.",".$total.",".$pedido->getQuantidade().",1)"
                //status 1 = aguardando aprovação, status 2 = pedido aprovado, status 3 = saiu para entrega, status 4 = pedido chegou, status 0 = pedido negado

            }
            else
            {
                $erro = 1;
            }
        }
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Tela de Pedidos</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/sweetalert2.css">
    <meta name="viewport" content="widht=device-width,initial-scale=1.0"/>
</head>
<body>
<script src="js/sweetalert2.all.min.js"></script>

    <div class="container">
        <header>
            <nav class="nav-container">
                <?php $id = base64_encode($_SESSION['id']); echo "<a href=\"cardapio.php?id=$id\"><img id=\"logo\" src=\"img/logo.jpg\" alt=\"Super Rango\"></a><br>"; ?>
                <h1 id="titulo">SUPER RANGO</h1>
                <ul>
                    <li>
                        <?php  unset($_SESSION['pedido']); echo "<a href='dados.php?id=$id'>Dados</a><br>"; ?>
                    </li>
                    <li>
                        <?php echo "<a href=\"historico.php?id=$id&pagina=1\">Pedidos</a><br>"; ?>
                    </li>
                    <li>
                        <a href="session_destroy.php">Sair</a>
                    </li>
                </ul>
            </nav>
        </header>
    </div>
<div class="wrapper">
   

    <h2>CARDÁPIO</h2><br>
    <table id="table_preco">
        <tr>
            <td align="right">
                <h2>Preço</h2>
            </td>
        </tr>
    </table>
                <?php
                    $db = open_database();
                    $sql = " select * from alimento ";
                    $exec = $db->query($sql);
                    $rows = $exec->num_rows;
                    if($rows>0)
                    {

                        while($dados = $exec->fetch_object())
                        {
                            $id_al = $dados->id;
                            $nome = $dados->descricao;
                            $preco = $dados->preco;
                            $preco_final = number_format($preco,'2',',','.');
                            echo "
                                    <table>
                                            <tr>
                                                <td>
                                            
                                 <ul>
                                    <li>
                                        <h2>$id_al - $nome</h2>
                                        </li>
                                </ul>
                                </td>
                                <td>
                                <h2>R$ $preco_final</h2>
                            </tr>
                            </table>";
                        }
                    }

/*
                if(isset($_GET['status']))
                {
                    $status=$_GET['status'];
                    if($status==0)
                    {
                        echo "<script>
                           window.onload = function sweetalertclick() 
                           {
                                Swal.fire(
                                    'Seu pedido foi negado =(',
                                    'Você foi trago de volta ao cardápio para tentar novamente',
                                    'error'
                                );
                            }
                        </script>";
                    }
                }*/

                $_SESSION['logado'];
                ?>


    <table id="pedido">
        <tr>
            <td>
                    <form action="" method="post">
                        <label for="campo1">Digite o número do alimento que você deseja:<br><br>
                        <input type="number" name="campo1" required placeholder="Número do alimento"></label><br><br>
                        <label for="campo2">Digite a quantidade desejada (máx. 30):<br><br>
                        <input type="number" name="campo2" min="1" required placeholder="Quantidade do alimento"></label><br><br>
                        <input type="submit" value="Enviar" style="margin-right: 6.5%;">
                        <?php
                        if(isset($erro) and $erro==1)
                        {
                            echo "<h3 align='center'>Digite um pedido Válido!</h3><br><br>";
                        }
                        ?>
                    </form>

            </td>
        </tr>
    </table>
</div>
</body>
</html>


