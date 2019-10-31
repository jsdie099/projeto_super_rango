<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once "config.php";
require_once DBAPI;
 $db = open_database();
 $sql = "select * from pedido where status between 2 and 3 and forma='entrega'";
 $exec = $db->query($sql);
 $rows = $exec->num_rows;
 if($rows>0)
 {
     while ($dados = $exec->fetch_object())
     {
         $id = $dados->id;
         $id_cliente = $dados->id_cliente;
         $tipo = $dados->tipo;
         $preco = $dados->preco;
         $final = number_format($preco,2);
         $qtd = $dados->quantidade;
         $status = $dados->status;

         $parte1 =    "
                                       <h3 id='estado'>Pedido $id do dia:<br>
                                       (lanche pedido: $tipo, preço R$ $final, $qtd unidades)</h3>
                           
                                ";
         $parte2 = "
                               <h2 class='titulo'>Estado da Entrega:</h2>
                               <select name='entreg' required>
                                   <option value='0'></option>
                                   <option value='1'>À Caminho</option>
                                   <option value='2'>Chegou</option>
                               </select>
                           ";
         echo "<form action='notificacao_cliente.php?id=$id' method='post'><table id='entrega'>
                           <tr><td>$parte1</td><td>$parte2</td><td><input type='submit' value='Enviar'></td></tr></table></form>";
     }
 }
 else
     {
         echo "<h1 align='center'>Nenhum Pedido no momento!</h1>";
     }
 ?>