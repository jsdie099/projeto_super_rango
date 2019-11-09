<?php

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
    <title>Pedidos</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="widht=device-width,initial-scale=1.0"/>
</head>
<body>

<div class="container">
    <header>
	
        <nav class="nav-container" id="nav">
            <a href="telafunc.php"><img id="logo" src="img/logo.jpg" alt="Super Rango" title="Super Rango"></a>
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


        <h1 class="titulo">Pedidos Pendentes</h1><br><br>
         <script src="js/jquery.js"></script>
         <script>
             $(document).ready(function () {
                 atualiza();
             });
             function atualiza() {
                 $.get("acao.php",function (resultado) {
                     $('#notificacao').html(resultado);
                 });
                 setTimeout('atualiza()',10000);
             }
         </script>
            <h1 id="notificacao"><?php
                require_once "acao.php";
                ?></h1>
            <?php
            /*$db = open_database();
            $sql = "select * from pedido where status = 1";
            $exec = $db->query($sql);
            $rows = $exec->num_rows;
            if($rows>0)
            {
                while ($dados = $exec->fetch_object())
                {
                    $num = $dados->id;
                    $tipo = $dados->tipo;
                    $preco = $dados->preco;
                    $final = number_format($preco,2);
                    $qtd = $dados->quantidade;

                    echo "<table align='center' width='60%'>
                <tr>
                    <td>
                       <h3>Pedido N°
                       $num:</h3>
                       <h3> (lanche pedido: $tipo,
                       preço: R$ $final<br> $qtd unidades)</h3><br><br>

                    </td>
                    <td>
                    Escolher:<br><br>
                    <a href='pedido.php?id=$num'> <img src='img/download.png' width='7%'></a>&nbsp;&nbsp;&nbsp;

                    <a href='excluir_pedido.php?id=$num'><img src='img/images.png' width='7%'></a>

                    </td>
                </tr>
            </table>";
                }
            }
            else
            {
                echo "<table>
                <tr>
                    <td>
                       <h2>Nenhum pedido realizado até o momento!</h2><br><br>
                    </td>

                </tr>
            </table>";
            } */
            ?>
     </div>
</body>
</html>









