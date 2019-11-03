<?php
include "config.php";
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
    $id = base64_decode($_GET['id']);
    $db = open_database();
    $sql = "update pedido set status = 2 where id = ?";
    $exec = $db->prepare($sql);
    $exec->bind_param("i",$id);
    $exec->execute();
    $sql2 = "select * from pedido where status = 2";
    $exec2 = $db->query($sql2);
    $rows = $exec2->num_rows;
        if($rows>0)
        {
            while ($dados = $exec2->fetch_object())
            {
                $id = $dados->id;
                $tipo = $dados->tipo;
                $preco = $dados->preco;
                $final = number_format($preco,2);
                $qtd = $dados->quantidade;
                $forma = $dados->forma;

                $table = "
                    
                        <td>
                            <h3>Pedido $id:<br>
                                <br>(lanche pedido: $tipo, preço: R$ $final<br> $qtd unidades)</h3>  <br><br>
                        </td>
                       
                    
                ";
                if(isset($_POST) and !empty($_POST) and $forma=='entrega')
                {
                    header('location:notificacao.php');
                }
                if(isset($_POST) and !empty($_POST) and $forma=='retirada')
                {
                    header('location:telafunc.php');
                }
            }
        }
?>
<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <title>Pedidos Aprovados</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="widht=device-width,initial-scale=1.0"/>
    </head>
    <body>
    <div class="container">
        <header>

            <nav class="nav-container" id="nav">
                <a href="telafunc.php"><img id="logo" src="img/logo.jpg" alt="Super Rango"></a>
                <h1 id="titulo">SUPER RANGO</h1>
                <div class="teste">
                    <ul>
                        <li>
                            <a href="#"><h3>Opções</h3></a>
                            <ul>
                                <li><a href="adicionar_alimento.php">Adicionar alimento</a></li>
                                <li><a href="historico.php">Histórico de Pedidos</a></li>
                                <li><a href="cardapio.php">Cardápio</a></li>
                                <li><a href="session_destroy.php">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <div class="wrapper">
        <h1 class="titulo">Nome do Estabelecimento</h1>
        <hr>
        <h1 class="titulo">Pedidos Aprovados e em Processamento</h1>
            <table>
                <tr>
                        <?php
                            echo $table;
                        ?>
                    <td>
                        <form action='' method='post'>
                                <h3>Estado:</h3>
                                <input type='radio' name='estado' value='1' required>Pronto
                                <input type='radio' name='estado' value='2' required>Fazendo
                                <input type='submit' value='Enviar'>
                        </form>
                    </td>
                </tr>
            </table>
    </div>
    </body>
    </html>