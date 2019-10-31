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

$_SESSION['logado'];
$db = open_database();
$id = base64_decode($_GET['id']);
$sql = "update pedido set forma='retirada' where id=?";
$exec = $db->prepare($sql);
$exec->bind_param("i",$id);
$exec->execute();
$sql = "select * from pedido where id=?";
$exec = $db->prepare($sql);
$exec->bind_param("i",$id);
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

    }
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

    <div class="container">
        <header>
            <nav class="nav-container">
                <?php $id = base64_encode($_SESSION['id']);  echo "<a href=\"cardapio.php?id=$id\">
                <img id=\"logo\" src=\"img/logo.jpg\" alt=\"Super Rango\"></a><br>";?>
                <h1 id="titulo">SUPER RANGO</h1>
                <ul>
                    <li>
                        <?php echo "<a href='dados.php?id=$id'>Dados</a><br>"; ?>
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
        <script src="js/jquery.js"></script>
        <script src="js/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function () {
                atualiza();
            });
            function atualiza() {
                $.get("acao_retirada.php",function (resultado) {
                    $('#notificacao').html(resultado);
                });
                setTimeout('atualiza()',5000);
            }
        </script>
        <h1 id="notificacao"></h1>
        <p>O estabelecimento recebeu a notificação de seu pedido,<br>
        você pode aguardar a notificação de aprovação ou pode ir direto ao estabelecimento,<br>
        agradecemos a escolha e desejamos que volte novamente a escolher o nosso humilde estabelecimento =)</p>
        <?php  echo "<a href=\"cardapio.php?id=$id\">
        <h1 style='font-size: 30px'>Voltar para o cardápio</h1></a>";?>
    </div>


</body>
</html>
<?php
require_once "acao_retirada.php";
?>