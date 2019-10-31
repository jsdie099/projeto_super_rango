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


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sinalização</title>
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
            <h1 class="titulo">Status do Pedido:</h1>

            <table>
                <tr>
                    <td>
                        <h2>A notificação foi enviada ao Entregador.</h2><br>
                        <div class="link">
                        <?php echo "<h3 align='center'><a href='telafunc.php'>Retornar aos pedidos</a></h3>";?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
</body>
</html>