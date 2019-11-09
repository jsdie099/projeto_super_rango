<?php
    include "config.php";
    include DBAPI;
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(!isset($_SESSION['logado']))
    {
        header('location:login.php');
    }
    $_SESSION['logado'];
    ($_GET['id']==base64_encode($_SESSION['id']))?$id = base64_decode($_GET['id']):$id=$_SESSION['id'];
    $db = open_database();

    $sql = "select * from pedido where id_cliente = ?";
    $exec = $db->prepare($sql);
    $exec->bind_param("i",$id);
    $exec->execute();
    $results = $exec->get_result();
    $rows = $results->num_rows;
    if($rows>0)
    {
        while ($dados = $results->fetch_object())
        {
            $total = $dados->preco;
            $tipo = $dados->tipo;
        }
    }
    $sql2 = "select * from pedido where status = 1";
    $exec2 = $db->query($sql2);
    $linhas = $exec2->num_rows;
    if($linhas>0)
    {
        while ($dados = $exec2->fetch_object())
        {

            $id1 = base64_encode($dados->id);
            $id_cli = $dados->id_cliente;

        }
    }

?>
<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <title>Finalização de Pedido</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="widht=device-width,initial-scale=1.0"/>
    </head>
    <body>

<script src="js/jquery.js"></script>
<script src="js/sweetalert2.all.min.js"></script>

<div class="container">
        <header>
            <nav class="nav-container">
                <?php $id=base64_encode($_SESSION['id']); echo "<a href=\"pedido2.php?id=$id\"><img id=\"logo\" src=\"img/logo.jpg\" alt=\"Super Rango\" title=\"Super Rango\"></a><br>";?>
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

            <table>
                <tr>
                    <td>
                        <h2>
                        Número da Escolha:</h2>
                    </td>
                    <td>
                        <h2>Valor Total:</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>
                        <?php echo $tipo;?></h2>
                    </td>
                    <td>
                        <h2>R$ <?php echo number_format($total,'2',',','.');?></h2>
                    </td>
                </tr>
            </table>
            <hr>
        <form action="" method="post">
                <script type="text/javascript">
                    function id(el) {
                        return document.getElementById(el);
                    }
                    function mostra(element) {
                        if (element) {
                            id(element.value).style.display = 'block';
                        }
                    }
                    function esconde_todos($element, tagName) {
                        var $elements = $element.getElementsByTagName(tagName),
                            i = $elements.length;
                        while(i--) {
                            $elements[i].style.display = 'none';
                        }
                    }
                    window.addEventListener('load', function() {
                        var $cartao = id('cartao'),
                            $dinheiro = id('dinheiro'),
                            $tipo = id('tipo');

                        //mostrando no onload da página
                        esconde_todos(id('palco'), 'div');
                        mostra(document.querySelector('input[name="pagamento"]:checked'));


                        //mostrando ao clicar no radio
                        var $radios = document.querySelectorAll('input[name="pagamento"]');
                        $radios = [].slice.call($radios);

                        $radios.forEach(function($each) {
                            $each.addEventListener('click', function() {
                                esconde_todos(id('palco'), 'div');
                                mostra(this);
                            });
                        });
                    });
                </script>

            <h2>Forma de Pagamento</h2><br><br>
                <label id="forma"><input type="radio" name="pagamento" value="cartao"checked>Cartão</label>
                <label id="forma"><input type="radio" name="pagamento" value="dinheiro"checked>Dinheiro</label>

                <div id="palco">
                    <div id="cartao""><br><input type="radio" value="1" name="cartao" checked>MasterCard Débito
                                         <input type="radio" name="cartao" value="2">MasterCard Crédito<br><br>
                                         <input type="radio" value="3" name="cartao">Visa Crédito
                                         <input type="radio" value="4" name="cartao">Visa Débito
                    </div>
            <div id="dinheiro"><br><label><h5>Troco para Quanto?</h5>
                            <input type="number" min="<?=$total?>" name="dinheiro" step="any" value="<?=$total?>"></label></div>
                </div><br><br><hr>
            <h2>Local de Entrega:</h2>

            <?php
                ($_GET['id']==base64_encode($_SESSION['id']))?$id = base64_decode($_GET['id']):$id=$_SESSION['id'];
                $sql = "select * from usuario where id=?";
                $exec = $db->prepare($sql);
                $exec->bind_param("i",$id);
                $exec->execute();
                $results = $exec->get_result();
                $rows = $results->num_rows;
                if($rows>0)
                {
                    while ($dados = $results->fetch_object())
                    {
                        $id = base64_encode($_SESSION['id']);
                        $_SESSION['pedido'] = "<h2><a href='pedido2.php?id=$id'>Retornar ao pedido</a></h2>";
                        echo "<table><tr><td><h3>$dados->rua, $dados->bairro, $dados->numero, 
                        $dados->complemento, $dados->cidade</h3></td></tr>
                        <tr><td><h4>Não se encontra mais neste endereço? 
                        mude agora o seu endereço clicando <a href='dados.php?id=$id'>Aqui</a></h4></td></tr></table>";
                    }
                }
                else
                {
                    echo "<h2>Não foi possível encontrar o seu endereço =(</h2>";
                }
            ?>
            <br><br><hr>
            <h2>Método de entrega:</h2><br><br>



            <table>
                <tr>
                    <td>
                        <input type="submit" value="Delivery" formaction="pedido_entrega.php?id=<?=$id1?>&id_cliente=<?=$id?>" style="border: none; text-transform: none">
                    </td>
                    <td>
                        <input type="submit" value="Retirada" formaction="pedido_retirada.php?id=<?=$id1?>&id_cliente=<?=$id?>" style="border: none; text-transform: none">
                    </td>
                </tr>
            </table>
            </form>
    </div>
</body>
</html>
