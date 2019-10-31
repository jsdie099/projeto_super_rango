<?php
    include "../clientea/config.php";
    include DBAPI;
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(!isset($_SESSION['logado_f']))
    {
        header('location:index.php');
    }

    $_SESSION['logado_f'];
/*
$db = open_database();
$sql = "select * from pedido where status between 2 and 3";
$exec = $db->query($sql);
$rows = $exec->num_rows;
if($rows>0)
{
    while ($dados = $exec->fetch_object())
    {
        $id = $dados->id;
        $id_cliente = $dados->id_cliente;
        $tipo = $dados->tipo;
        $preco = $dados->preco;
        $final = number_format($preco,2);
        $qtd = $dados->quantidade;
        $status = $dados->status;
                    $parte1 =    "

                                        <h3>Pedido $id do dia:<br>
                                        (lanche pedido: $tipo, preço R$ $final, $qtd unidades)</h3>
                            
                                 ";
                    $parte2 = "
                                <h2 id='estado'>Estado da Entrega:</h2>
                                <select name='entreg' required>
                                    <option value='0'></option>
                                    <option value='1'>À Caminho</option>
                                    <option value='2'>Chegou</option>
                                </select>
                            ";
    }

}
*/

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recebimento de Pedidos</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="widht=device-width,initial-scale=1.0"/>
</head>
<body>
        <div class="container">
            <header>

                <nav class="nav-container">
                    <a href="entregador.php"><img id="logo" src="img/logo.jpg" alt="Super Rango"></a><br>
                    <h1 id="titulo">SUPER RANGO</h1>
                    <ul>
                        <li>
                            <a href="session_destroy.php">Sair</a>
                        </li>
                    </ul>
                </nav>
            </header>
        </div>

    <div class="wrapper">
        <h1 class="titulo">Nome do Estabelecimento</h1>
        <hr>
        <h1 class="titulo">Pedidos Pendentes Para Entrega</h1><br><br>
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function () {
                atualiza();
            });
            function atualiza() {
                $.get("acao_entregador.php",function (resultado) {
                    $('#notificacao').html(resultado);
                });
                setTimeout('atualiza()',10000);
            }
        </script>
        <h3 id="notificacao"></h3>
                    <?php
                    /*
                    $db = open_database();
                    $sql = "select * from pedido where status between 2 and 3";
                    $exec = $db->query($sql);
                    $rows = $exec->num_rows;
                    if($rows>0)
                    {
                        while ($dados = $exec->fetch_object())
                        {
                            $id = $dados->id;
                            $id_cliente = $dados->id_cliente;
                            $tipo = $dados->tipo;
                            $preco = $dados->preco;
                            $final = number_format($preco,2);
                            $qtd = $dados->quantidade;
                            $status = $dados->status;
                            $parte1 =    "
                                        <h3 id='estado'>Pedido $id do dia:<br>
                                        (lanche pedido: $tipo, preço R$ $final, $qtd unidades)</h3>
                            
                                 ";
                            $parte2 = "
                                <h2 class='titulo'>Estado da Entrega:</h2>
                                <select name='entreg' required>
                                    <option value='0'></option>
                                    <option value='1'>À Caminho</option>
                                    <option value='2'>Chegou</option>
                                </select>
                            ";
                            echo "<form action='notificacao_cliente.php?id=$id' method='post'><table id='entrega'>
                            <tr><td>$parte1</td><td>$parte2</td><td><input type='submit' value='Enviar'></td></tr></table></form>";
                        }

                    }
                    else
                    {
                        $vazio = "<h1 align='center'>Nenhum Pedido no momento!</h1>";
                    }*/
                    ?>

            <table>
                <tr>
                    <td>
                        <?php
                            if(isset($vazio))
                            {
                                echo $vazio;
                            }
                        ?>
                    </td>
                </tr>
            </table>
    </div>
</body>
</html>





