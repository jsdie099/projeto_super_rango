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
($_GET['id']==base64_encode($_SESSION['id']))?$id = base64_decode($_GET['id']):$id=$_SESSION['id'];
$sql = "select * from usuario where id = ".$id;
$exec = $db->query($sql);
if($exec->num_rows>0)
{
    while ($dados = $exec->fetch_object())
    {
        $nome = $dados->nome;
        $cpf = $dados->cpf;
        $celular = $dados->celular;
        $email = $dados->email;
        $rua = $dados->rua;
        $bairro = $dados->bairro;
        $numero = $dados->numero;
        $complemento = $dados->complemento;
        $cidade = $dados->cidade;
        $cep = $dados->cep;
        if($complemento == null)
        {
            $complemento = "";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Dados Cadastrados</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="widht=device-width,initial-scale=1.0"/>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.mask.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
            $('#celular').mask('(00)0 0000-0000');
            $('#cep').mask('00000-000');
        })
    </script>
</head>
<body>
    <div class="container">
        <header>
            <nav class="nav-container">
                <?php $id=base64_encode($_SESSION['id']); echo "<a href=\"cardapio.php?id=$id\"><img id=\"logo\" src=\"img/logo.jpg\" alt=\"Super Rango\"></a><br>";?>
                <h1 id="titulo">SUPER RANGO</h1>
                <ul>
                    <li>
                        <?php echo "<a href=\"historico.php?id=$id\">Pedidos</a><br>";?>
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
        <h1>Dados cadastrados</h1>


        <form action="valida_edit.php?id=<?php echo base64_encode($_SESSION['id']);?>" method="post">
            <div class="bloco">
                <div id="esquerda">
                    <label> Nome:<br>
                        <input type="text" name="nome" required value="<?php echo $nome;?>"></label><br>
                    <label>CPF:<br>
                        <input type="text" name="cpf" id="cpf" required value="<?php echo $cpf;?>"></label><br>
                    <label>Número do Celular:(sem espaço)<br>
                        <input type="text" name="celular" id="celular" required value="<?php echo $celular;?>"></label><br>
                    <label>E-mail:<br>
                        <input type="email" name="email" required value="<?php echo $email;?>"></label><br>
                    <label>Rua:<br>
                        <input type="text" name="rua" required value="<?php echo $rua;?>"></label><br>
                </div>
                <div id="direita">
                    <label>Número:<br>
                        <input type="text" name="numrua" required value="<?php echo $numero;?>"></label><br>
                    <label>Bairro:<br>
                        <input type="text" name="bairro" required value="<?php echo $bairro;?>"></label><br>
                    <label>Complemento:<br>
                        <input type="text" name="complemento" value="<?php echo $complemento;?>"></label><br>
                    <label>Cidade:<br>
                        <input type="text" name="cidade" required value="<?php echo $cidade;?>"></label><br>
                    <label>CEP:<br>
                        <input type="text" name="cep" id="cep" required value="<?php echo $cep;?>"></label><br>
                    <input type="submit" value="Mudar">

                    <?php
                    if(isset($msg) and $msg == 1)
                    {
                        echo $msg;
                    }
                    if(isset($_SESSION['msg']))
                    {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    if(isset($_SESSION['pedido']))
                    {
                        echo $_SESSION['pedido'];
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</body>
</html>


