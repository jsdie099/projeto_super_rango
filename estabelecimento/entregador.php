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





