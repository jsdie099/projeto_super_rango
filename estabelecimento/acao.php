<?php
if(!isset($_SESSION))
{
    session_start();
}
    require_once "../clientea/config.php";
    require_once DBAPI;
    $db = open_database();
    $sql = "select * from pedido where status=1";
    $exec = $db->query($sql);
    $rows = $exec->num_rows;
        if($rows>0)
        {
            while ($dados = $exec->fetch_object())
            {
                $num = $dados->id;
                $tipo = $dados->tipo;
                $preco = $dados->preco;
                $final = number_format($preco,2);
                $qtd = $dados->quantidade;
                $forma = strtoupper($dados->forma);
                    echo  "<table width='80%'>
                            <tr>
                                <td>
                                   <h5>Pedido N° 
                                   $num:</h5>
                                    (lanche pedido: $tipo, 
                                   preço: R$ $final<br> $qtd unidades,$forma)<br><br>
                                   
                                </td>
                                <td>
                                <h5>
                                Escolher:<br><br> 
                                <a href='pedido.php?id=$num'> <img src='img/download.png' width='7%'></a>&nbsp;&nbsp;&nbsp;
                                    
                                <a href='excluir_pedido.php?id=$num'><img src='img/images.png' width='7%'></a>
                                </h5>
                                </td>
                            </tr>
                        </table>";
                }
        }
        else
        {
            echo "<table>
                        <tr>
                            <td>
                               <h3>Nenhum pedido realizado até o momento!</h3><br><br>
                            </td>
                        
                        </tr>
                    </table>";
        }