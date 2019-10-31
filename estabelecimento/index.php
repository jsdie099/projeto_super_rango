<?php
include "funcionario.php";
include "config.php";
include DBAPI;

if(isset($_POST) and !empty($_POST))
{
    $func = new Funcionario();
    $func -> setTipo($_POST['funcionario']);
    $func -> setNome($_POST['nome']);
    $func -> setCpf($_POST['cpf']);

    $tipo = $func->getTipo();
    $nome = $func->getNome();
    $cpf = $func->getCpf();

    $db = open_database();
    $sql = " select * from funcionario where tipo=? and nome=? and cpf=?";
    $exec = $db->prepare($sql);
    $exec->bind_param("sss",$tipo,$nome,$cpf);
    $exec->execute();
    //$sql = " select * from funcionario where tipo = '".$func->getTipo()."' and nome = '".$func->getNome()."' and cpf = '".$func->getCpf()."'";
    $results = $exec->get_result();
    $rows = $results->num_rows;
    if($rows>0 && $func->getTipo()==1)
    {
        while (($dados = $results->fetch_object()))
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            $_SESSION['logado_f']= $dados->nome;
            header('location:telafunc.php');
        }

    }
    else
    {
        $msg = 1;
    }
    if($rows>0 && $func->getTipo()==2)
    {
        while ($dados = $results->fetch_object())
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            $_SESSION['logado_f'] = $dados->nome;
            header('location:entregador.php');
        }

    }
    else
    {
        $msg = 1;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login de Funcionário - SUPER RANGO</title>
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
                <a href="index.php"><img id="logo" src="img/logo.jpg" alt="Super Rango"></a><br>
                <h1 id="titulo">SUPER RANGO</h1>
            </nav>
        </header>
    </div>

    <div class="wrapper">
        <h1 class="titulo">Nome do Estabelecimento</h1>
        <hr>
        <h1 class="titulo">Login do Funcionário</h1>
        <form action="" method="post">

            <table id="tabela_index">
                <tr>
                    <td>
                        <h3>Tipo de Login:</h3>
                        <label>
                            <select name="funcionario" required>
                                <option value=""></option>
                                <option value="1" >Funcionário</option>
                                <option value="2" >Entregador</option>
                            </select></label>
                    </td>
                </tr>
                <tr>
                    <td>

                            <label for="nome">Nome:<br>
                            <input type="text" name="nome" required placeholder="Nome"></label><br>
                            <label for="cpf">CPF: <br>
                            <input type="text" name="cpf" id="cpf" required placeholder="CPF"></label><br>

                            <input type="submit" value="Enviar">


                                <?php
                                    if(isset($msg) and $msg == 1)
                                    {
                                        echo "<h3>Nome ou CPF inválidos!</h3>";
                                    }
                                ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>

