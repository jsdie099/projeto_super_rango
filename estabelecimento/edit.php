
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
            <a href="telafunc.php"><img id="logo" src="img/logo.jpg" alt="Super Rango"></a>
            <h1 id="titulo">SUPER RANGO</h1>
            <ul>
                <li>
                    <a href="telafunc.php">Pedidos</a>
                </li>
                <li>
                    <a href="historico.php">Histórico de Pedidos</a>
                </li>
                <li>
                    <a href="cardapio.php">Cardápio</a>
                </li>
                <li>
                    <a href="session_destroy.php">Sair</a>
                </li>
            </ul>
        </nav>
    </header>
</div>
<div class="wrapper">
    <h1 class="titulo">Nome do Estabelecimento</h1><br>
    <hr>
    <h1 class="titulo">Editar um Alimento do cardápio</h1><br><br>
    <table>
        <tr>
            <td>
                <form action="" method="post">
                    <label>
                        <input type="text" name="campo1" required placeholder="Nome do alimento"></label><br><br>
                    <label>
                        <input type="number" step="any" name="campo2" required placeholder="Preço do alimento"></label><br><br>
                    <input type="submit" value="Enviar"><br>
                </form>
            </td>
        </tr>
    </table>

</div>
</body>
</html>
<?php
require_once "config.php";
include DBAPI;
if(!isset($_SESSION))
{
    session_start();
}
$id=$_GET['id'];
if(isset($_POST) and !empty($_POST)) {

    $campo1 = $_POST['campo1'];
    $campo2 = (double)$_POST['campo2'];
    $db = open_database();
    $sql = "update alimento set descricao = '$campo1',preco='$campo2' where id='$id'";
    $exec = $db->query($sql);
    $_SESSION['edit']="<h2 align='center'>Alimento Editado com Sucesso!</h2>";
    header('location:cardapio.php');
    $_SESSION['edit'] = "<h2 align='center'>Alimento Editado com sucesso!</h2>";
}

?>