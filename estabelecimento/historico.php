<?php
    include "config.php";
    include DBAPI;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Pedidos</title>
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
                                <li>
                                    <a href="telafunc.php">Pedidos</a>
                                    <a href="adicionar_alimento.php">Adicionar Alimento</a>
                                    <a href="cardapio.php">Cardápio</a>
                                    <a href="session_destroy.php">Sair</a>
                                </li>
                            </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</div>
    <div class="wrapper">
        <h1 class="titulo">Nome do Estabelecimento</h1><br>
        <hr>
        <h1 class="titulo">Histórico dos Pedidos realizados</h1><br><br>
        <table border="1" id="table_hist">
            <tr>
                <td>
                    <h1>Identificação do Pedido</h1>
                </td>
                <td>
                    <h1>Preço</h1>
                </td>
                <td>
                    <h1>Estado</h1>
                </td>
            </tr>
            <?php
                $db = open_database();
                $itens_por_pagina = 10;
                if(!isset($_GET['pagina']))
                {
                    $_GET['pagina'] = 1;
                }
                $pagina = $_GET['pagina'];

                $inicio = ($itens_por_pagina*$pagina)-$itens_por_pagina;
                $sql = "select * from pedido where status between 0 and 4 order by id desc limit {$inicio},{$itens_por_pagina}";
                $exec = $db->query($sql);
                $rows = $exec->num_rows;

                $sql = "select * from pedido where status between 0 and 4";
                $execa = $db->query($sql);
                $num_total = $execa->num_rows;
                $num_paginas = ceil($num_total/$itens_por_pagina);
                if($rows>0)
                {
                    while($dados = $exec->fetch_object())
                    {
                        $id = $dados->id;
                        $id_cliente=$dados->id_cliente;
                        $preco = number_format($dados->preco,'2',',','.');
                        $status = $dados->status;
                        if($status==0)
                        {
                            $valor = "Pedido Cancelado";
                        }
                        else
                        {
                            $valor = "Pedido Finalizado";
                        }

                        echo "<tr>
                                    <td>
                                        $id
                                    </td>
                                    <td>
                                        <i>
                                            R$ $preco
                                        </i>
                                    </td>
                                    <td>
                                        $valor
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
                            <a href=\"historico.php?pagina=$valor\">Previous</a>
                        </li>";
                    for($i=1; $i<=$num_paginas;$i++) {
                        if($pagina==$i)
                        {
                            echo "<li><a href=\"historico.php?pagina=$i\"><strong>".($i)."</strong></a></li>";
                        }
                        else
                        {
                            echo "<li><a href=\"historico.php?pagina=$i\">".($i)."</a></li>";
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
                            <a href=\"historico.php?pagina=$valor\">Next</a>
                      </li>
                    </ul></div>";
                }

            ?>

        <?php

        if($rows<0)
            {
                $vazio =  "<h2>Não existe nenhum histórico de pedidos no momento</h2>";
            }
            if (isset($vazio))
            {
                echo $vazio;
            }
        ?>
    </div>
</body>
</html>