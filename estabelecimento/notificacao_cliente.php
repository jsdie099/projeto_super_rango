<?php
include "config.php";
class Entrega
{
    private $tipo;
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
}
$entrega = new Entrega();
$entrega->setTipo($_POST['entreg']);
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
$id = $_GET['id'];
$db = open_database();
$sql = "select * from pedido where status = 2";

if($entrega->getTipo()==1)
{
    $sql = "update pedido set status = 3 where id = ".$id;
    $exec = $db->query($sql);

}
if($entrega->getTipo()==2)
{
    $sql = "update pedido set status = 4 where id = ".$id;
    $exec = $db->query($sql);
}
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
        <h1 class="titulo">Nome do Estabelecimento</h1>
        <hr>
        <h1 class="titulo">Status do Pedido:</h1><br>

        <table>
            <tr>
                <td>
                    <h2>A notificação foi enviada ao Cliente.</h2><br><br>
                    <?php
                        echo "<h3><a href='entregador.php'>Retornar aos pedidos</a></h3>";
                    ?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>

