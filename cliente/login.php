<?php
/**
 * Created by PhpStorm.
 * User: Juliano
 * Date: 03/04/2019
 * Time: 20:45
 */

include "cliente.php";
include 'config.php';
include DBAPI;
$db = open_database();
if(!isset($_SESSION))
{
    session_start();
}
if(!empty($_POST) and isset($_POST))
{
    $cli = new Cliente();
    $cli -> setEmail($_POST['email']);
    $cli -> setCpfCli(($_POST['cpfcli']));
    $email = $cli->getEmail();
    $cpf = $cli->getCpf();
    $sql = "select * from usuario where email=? and cpf=?";
    $exec = $db->prepare($sql);
    $exec->bind_param("ss",$email,$cpf);
    $exec->execute();
    $res =  $exec->get_result();
    $rows = $res->num_rows;
    //$sql = "select * from usuario where email = '".$cli ->getEmail()."' and cpf = '".$cli -> getCpfCli()."' ";
    //$exec = $db->query($sql);
    //$rows = $exec->num_rows;
    if($rows>0)
    {
        while ($dados = $res->fetch_object())
        {
            $_SESSION['id']=$dados->id;
            $_SESSION['logado']=$dados->nome;
            header('location:cardapio.php?id='.base64_encode($dados->id));
        }
    }
    else
    {
        $msg=1;
    }

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="widht=device-width,initial-scale=1.0"/>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.mask.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
        })
    </script>
</head>
<body>
    <div class="container">
        <header>
            <nav class="nav-container">
                <a href="index.html"><img id="logo" title="Super Rango" src="img/logo.jpg" alt="Super Rango"></a><br>
                <h1 id="titulo">SUPER RANGO</h1>
            </nav>
        </header>
    </div>
<div class="wrapper">

    <h1 class="titulo">Login do Cliente</h1>
    <br>
    <table>
        <tr>
            <td>
                    <form action="" method="post">
                        <label >E-mail:<br>
                        <input type="email" name="email" required placeholder="E-mail"></label><br>
                        <label>CPF: (somente números)<br>
                        <input type="text" name="cpfcli" id="cpf" required placeholder="CPF"></label><br><br>
                        <input type="submit" value="Enviar"><br><br>
                        <h2>Ainda não tem sua conta?<a href="cadastro.php">Cadastre-se</a></h2><br>
                            <?php
                            if(isset($msg) and $msg == 1)
                            {
                                echo "<h2>E-mail ou CPF inválidos!</h2>";
                            }
                            if(isset($_SESSION['cadastro']))
                            {
                                echo $_SESSION['cadastro'];
                                unset($_SESSION['cadastro']);
                            }
                            ?>
                    </form>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
