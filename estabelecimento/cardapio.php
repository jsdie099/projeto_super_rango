<?php
    require_once "config.php";
    include DBAPI;
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Tela de Pedidos</title>
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
                            <li>
                                <a href="telafunc.php">Pedidos</a>
                                <a href="adicionar_alimento.php">Adicionar Alimento</a>
                                <a href="historico.php">Histórico de Pedidos</a>
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

                    <h1 class="titulo">Extrema-MG</h1>

        <hr>
        <h1 class="titulo">CARDÁPIO</h1><br>
        <?php
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['edit']))
            {
                echo $_SESSION['edit'];
                unset($_SESSION['edit']);
            }
        ?>
        <table id="table_hist" border="1">
            <tr>
                <td>
                    <h2>Identificação</h2>
                </td>
                <td>
                    <h2 >Preço</h2>
                </td>
                <td>
                    <h2>Ações</h2>
                </td>
            </tr>
                <?php
                $db = open_database();
                $sql = "select * from alimento";
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
                               <tr>
                                   <td>  
                                    <ul>
                                       <li>
                                           <h3>$id_al - $nome</h3>                                    
                                       </li>
                                   </ul>
                                   </td>
                                   <td>
                                        <h3>R$ $preco_final</h3>
                                   </td>    
                                   <td>
                                        <h3>
                                        <a href='edit.php?id=$id_al'>Editar alimento</a></h3>
                                   </td>                     
                               </tr>
                      ";
                    }
                }
                ?>
        </table>
    </div>
</body>
</html>

