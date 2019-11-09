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
         $id = base64_encode($dados->id);
         $id_cliente = $dados->id_cliente;
         $tipo = $dados->tipo;
         $preco = $dados->preco;
         $final = number_format($preco,2);
         $qtd = $dados->quantidade;
         $status = $dados->status;

         $sql1 = "select * from usuario where id = {$id_cliente}";
         $exec1 = $db->query($sql1);
         if($exec1->num_rows>0)
         {
             while ($dados1 = $exec1->fetch_object())
             {
                 $nome = explode(" ",$dados1->nome);
                 $nome_final = $nome[0];
                 $rua = $dados1->rua;
                 $bairro = $dados1->bairro;
                 $numero = $dados1->numero;
                 $cidade = $dados1->cidade;
                 $complemento = "";
                 if($dados1->complemento != null)
                 {
                     $complemento = $dados1->complemento.",";
                 }



             }
         }

         $parte1 =    "
                                       <h3 id='estado'>Pedido $dados->id<br>
                                       ($nome_final, $rua, $bairro, $numero, $cidade, $complemento R$ $final)</h3>
                           
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