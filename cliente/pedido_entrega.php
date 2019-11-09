<?php
    include "config.php";
    include DBAPI;
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(!isset($_SESSION['logado']))
    {
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Finalização de Pedido</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/sweetalert2.css">
    <meta name="viewport" content="widht=device-width,initial-scale=1.0"/>

</head>
<body>
    <script src="js/sweetalert2.all.min.js"></script>

<?php


    if(!isset($_SESSION['logado']))
    {
        header('location:login.php');
    }
    ($_GET['id_cliente']==base64_encode($_SESSION['id']))?$id_cliente = base64_decode($_GET['id_cliente']):$id_cliente=$_SESSION['id'];

    $id = base64_encode($_SESSION['id']);
    $id_pedido = base64_decode($_GET['id']);
    $_SESSION['logado'];
    $db = open_database();
    $sql = "update pedido set forma='entrega' where id=?";
    $exec = $db->prepare($sql);
    $exec->bind_param("i",$id_pedido);
    $exec->execute();
    $exec = $db->query($sql);


    $sql = "select * from pedido where id=?";
    $exec = $db->prepare($sql);
    $exec->bind_param("i",$id_pedido);
    $exec->execute();
    $results = $exec->get_result();
    $rows = $results->num_rows;
    if($rows>0)
    {
        while ($dados = $results->fetch_object())
        {

            $_SESSION['status'] = $dados->status;
            $_SESSION['id_pedido']=$dados->id;
            $_SESSION['id_pedido1']=$dados->id;
            $_SESSION['id_pedido2']=$dados->id;
            $_SESSION['id_pedido3']=$dados->id;
            $status = $dados->status;
            /*if($status == 0)
            {
                header('location:cardapio.php?id='.$id_cliente.'&status='.$status);//o erro está aqui
            }*/
        }
    }

?>


    <div class="container">
        <header>
            <nav class="nav-container">
                <?php  echo "<a href=\"cardapio.php?id=$id\"><img id=\"logo\" src=\"img/logo.jpg\" alt=\"Super Rango\" title=\"Cardápio\"></a><br>";?>
                <h1 id="titulo">SUPER RANGO</h1>
                <ul>
                    <li>
                        <?php echo "<a href='dados.php?id=$id'>Dados</a><br>"; ?>
                    </li>
                    <li>
                        <?php unset($_SESSION['pedido']); echo "<a href=\"historico.php?id=$id&pagina=1\">Pedidos</a><br>"; ?>
                    </li>
                    <li>
                        <a href="session_destroy.php">Sair</a>
                    </li>
                </ul>
            </nav>
        </header>
    </div>
    <div class="wrapper">
        <script src="js/jquery.js"></script>
        <script src="js/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function () {
                atualiza();
            });
            function atualiza() {
                $.get("acao.php",function (resultado) {
                    $('#notificacao').html(resultado);
                });
                setTimeout('atualiza()',5000);
            }
        </script>
        <h1 id="notificacao"></h1>
        <p style="margin-top: 80px">Aqui é onde você receberá as notificações sobre seu pedido<br>
         o entregador também irá notificá-lo quando for deixá-lo com você,<br>
        muito obrigado pela preferência e esperamos que volte logo.</p>
        <table>
            <tr>
                <td>
                    <div>
                        <?php echo "<a href=\"cardapio.php?id=$id\"><h1>Voltar para o cardápio</h1></a>";?>
                    </div>
                </td>
            </tr>

        </table>
    </div>
</body>
</html>
<?php
    require_once "acao.php";
?>