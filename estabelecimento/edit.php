<?php
require_once "config.php";
include DBAPI;
if(!isset($_SESSION))
{
    session_start();
}
$id=$_GET['id'];
$db = open_database();
$sql1 = "select * from alimento where id = ?";
$exec1 = $db->prepare($sql1);
$exec1->bind_param("i",$id);
$exec1->execute();
$results1 = $exec1->get_result();
$rows = $results1->num_rows;
if($rows>0)
{
    while ($dados = $results1->fetch_object())
    {
        $descricao = $dados->descricao;
        $preco = $dados->preco;
    }
}


if(isset($_POST) and !empty($_POST)) {

    $campo1 = $_POST['campo1'];
    $campo2 = (double)$_POST['campo2'];

    $sql = "update alimento set descricao = ?,preco=? where id=?";
    $exec = $db->prepare($sql);
    $exec->bind_param("sdi",$campo1,$campo2,$id);
    $exec->execute();
    $_SESSION['edit']="<h2 align='center'>Alimento Editado com Sucesso!</h2>";
    header('location:cardapio.php');
    $_SESSION['edit'] = "<h2 align='center'>Alimento Editado com sucesso!</h2>";


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
        <nav class="nav-container">
            <a href="telafunc.php"><img id="logo" src="img/logo.jpg" alt="Super Rango" title="Pedidos"></a>
            <h1 id="titulo">SUPER RANGO</h1>
            <div class="teste">
                <ul>
                    <li>
                        <a href="#"><h3>Opções</h3></a>
                        <ul>
                            <li>
                                <a href="telafunc.php">Pedidos</a>
                                <a href="historico.php">Histórico de Pedidos</a>
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

    <h1 class="titulo">Editar um Alimento do cardápio</h1><br><br>
    <table>
        <tr>
            <td>
                <form action="" method="post">
                    <label>Nome do alimento:<br>
                        <input type="text" name="campo1" required value="<?=$descricao?>">
                    </label><br><br>
                    <label>Preço do alimento:<br>
                        <input type="number" step="any" name="campo2" value="<?=$preco?>"></label><br><br>
                    <input type="submit" value="Enviar"><br>
                </form>
            </td>
        </tr>
    </table>

</div>
</body>
</html>
