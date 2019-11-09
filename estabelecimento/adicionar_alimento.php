<?php
    include "config.php";
    include DBAPI;
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(isset($_POST) and !empty($_POST))
    {
        $nome = $_POST['campo1'];
        $preco = $_POST['campo2'];
        $db = open_database();
        $sql = "insert into alimento(id,descricao,preco) values ((select max(id)+1 from alimento alim),?,?)";
        $exec = $db->prepare($sql);
        $exec->bind_param("sd",$nome,$preco);
        $exec->execute();
        //$sql = "insert into alimento(id,descricao,preco) values (null,'".$nome."',$preco)";
        $_SESSION['ok']="<h2 align='center'>Alimento adcionado com sucesso</h2>";
    }
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
        <nav class="nav-container" id="nav">
            <a href="telafunc.php"><img id="logo" src="img/logo.jpg" alt="Super Rango"></a>
            <h1 id="titulo">SUPER RANGO</h1>
            <div class="teste">
                <ul>
                    <li><a href="#" id="clique"><h3>Opções</h3></a>
                        <ul>
                            <li>
                                <a href="telafunc.php">Pedidos</a>
                                <a href="historico.php">Histórico de Pedidos</a>
                                <a href="cardapio.php">Cardápio</a><hr>
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

        <h1 class="titulo">Adicionar um Alimento ao cardápio</h1><br><br>
        <?php
        if(isset($_SESSION['ok']))
        {
            echo $_SESSION['ok'];
            unset($_SESSION['ok']);
        }
        ?>
        <table>
            <tr>
                <td>
                        <form action="" method="post">
                            <label>
                            <input type="text" name="campo1" class="adc_alimento" required placeholder="Nome do alimento"></label><br><br>
                            <label>
                            <input type="number" step="any" name="campo2" class="adc_alimento" required placeholder="Preço do alimento"></label><br><br>
                            <input type="submit" value="Enviar">
                        </form>
                </td>
            </tr>
        </table>

    </div>
</body>
</html>