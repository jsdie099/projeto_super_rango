<?php

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
    $_SESSION['logado'];
    $db = open_database();
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Histórico de pedidos</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="widht=device-width,initial-scale=1.0"/>
</head>
<body>
    <div class="container">
        <header>
            <nav class="nav-container">
                <?php $id=base64_encode($_SESSION['id']); echo "<a href=\"cardapio.php?id=$id\"><img id=\"logo\" src=\"img/logo.jpg\" alt=\"Super Rango\"></a><br>";?>
                <h1 id="titulo">SUPER RANGO</h1>
                <ul>
                    <li>
                        <?php echo "<a href=\"dados.php?id=$id\">Dados</a><br>";?>
                    </li>
                    <li>
                        <?php echo "<a href=\"cardapio.php?id=$id\">Cardápio</a><br>";?>
                    </li>
                    <li>
                        <a href="session_destroy.php">Sair</a>
                    </li>
                </ul>
            </nav>
        </header>
    </div>
    <div class="wrapper">

        <h1 class="titulo" style="margin-bottom: 0;">Histórico de Pedidos</h1>

            <?php
            ($_GET['id']==base64_encode($_SESSION['id']))?$id = base64_decode($_GET['id']):$id=$_SESSION['id'];

            $itens_por_pagina = 10;
            if(!isset($_GET['pagina']))
            {
                $_GET['pagina'] = 1;
            }
            $pagina = $_GET['pagina'];
            $inicio = ($itens_por_pagina*$pagina)-$itens_por_pagina;
            $sql = "select * from pedido where id_cliente=".$id." order by id desc limit {$inicio},{$itens_por_pagina}";
            $exec = $db->query($sql);
            $rows = $exec->num_rows;
            $sql = "select * from pedido where id_cliente={$id}";
            $execa = $db->query($sql);
            $num_total = $execa->num_rows;
            $num_paginas = ceil($num_total/$itens_por_pagina);
            if($rows>0)
            {
                echo "<p style='margin-top: 0;'>
            Aqui estão Todos os seus pedidos,<br> você pode acompanhar os que ainda estão em aberto. =)
        </p>
                <table border=\"1\"id=\"table_hist\"><tr>
                <td>
                   <h3>Identificação do Pedido</h3>
                </td>
                <td>
                    <h3>Valor total do pedido</h3>
                </td>
                <td>
                    <h3>Status</h3>
                </td>
            </tr>";
                while ($dados = $exec->fetch_object())
                {

                    $id_pedido = base64_encode($dados->id);
                    $preco = number_format($dados->preco,'2',',','.');
                    $qtd = $dados->quantidade;
                    $status = $dados->status;
                    $forma = $dados->forma;
                    $id = base64_encode($_SESSION['id']);
                    switch ($status)
                    {
                        case 0:
                            $texto="Pedido negado";
                            break;
                        case 1:

                            $texto="Pedido Pendente<br><a href='pedido_entrega.php?id=$id_pedido&id_cliente=$id'>Acompanhar</a><br>
                            <a href='cancelar.php?id=$id_pedido'>Cancelar Pedido</a>";
                            break;
                        case 2:

                            $texto="Pedido Aprovado<br><a href='pedido_entrega.php?id=$id_pedido&id_cliente=$id'>Acompanhar</a>";
                            break;
                        case 3:

                            $texto="Pedido saiu para entrega<br><a href='pedido_entrega.php?id=$id_pedido&id_cliente=$id'>Acompanhar</a>";
                            break;
                        case 4:
                            $texto="Pedido Finalizado";
                            break;
                        default:echo "Valor inválido";

                    }
                    if($forma == 'retirada' && $status == 1)
                    {
                        $texto="Pedido para retirada<br><a href='pedido_retirada.php?id=$id_pedido&id_cliente=$id'>Verificar</a>";
                    }
                    else if ($forma == 'retirada' && $status > 1)
                    {
                        $texto = "Pedido Para retirada aceito,<br>Finalizado.";
                    }
                    echo "<tr>
                <td>
                    $dados->id
                </td>
                <td>R$ $preco</td>
                <td>
                    $texto
                </td>
            </tr>";

                }
                echo "</table>";
                if($_GET['pagina']>$num_paginas)
                {
                    $valor = $_GET['pagina']-1;
                }
                else
                {
                    $valor=1;
                }
                echo "<div id='paginacao'>
                    <ul>
                        <li >
                            <a href=\"historico.php?id=$id&pagina=$valor\">Previous</a>
                        </li>";
                for($i = 1; $i<=$num_paginas;$i++) {
                    if($pagina==$i)
                    {
                        echo "<li><a href=\"historico.php?id=$id&pagina=$i\"><strong>".($i)."</strong></a></li>";
                    }
                    else
                    {
                        echo "<li><a href=\"historico.php?id=$id&pagina=$i\">".($i)."</a></li>";
                    }
                }
                if($_GET['pagina']<$num_paginas)
                {
                    $valor=$_GET['pagina']+1;
                }
                else
                {
                    $valor=$_GET['pagina'];
                }
                echo "<li>
                            <a href=\"historico.php?id=$id&pagina=$valor\">Next</a>
                      </li>
                    </ul></div>";
            }
            else
            {
                echo "<h1>Você ainda não realizou nenhum pedido!</h1>";
            }

            ?>
    </div>
</body>
</html>



