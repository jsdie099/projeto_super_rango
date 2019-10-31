<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    require_once "config.php";
    require_once DBAPI;
    $db = open_database();


        if(isset($_SESSION['id_pedido']))
        {
            $sql = "select status from pedido where id=".$_SESSION['id_pedido'];
            $exec = $db->query($sql);
            $rows = $exec->num_rows;
            if($rows>0)
            {
                while ($dados = $exec->fetch_object())
                {


                    if($dados->status==1)
                    {
                        if(isset($_SESSION['id_pedido1']))
                        {
                            echo "
                            <script>
                                $(document).ready(function sweetalertclick() 
                               {
                                    Swal.fire(
                                        'Seu pedido está aguardando aprovação',
                                        'Mantenha-se nessa página para ser notificado',
                                        ''
                                    )
                                } );
                                        </script>";
                            unset($_SESSION['id_pedido1']);
                        }

                    }
                    if($dados->status==2)
                    {
                        if(isset($_SESSION['id_pedido2']))
                        {
                            echo "<script> 
                                   $(document).ready(function sweetalertclick() 
                                   {
                                        Swal.fire(
                                        'Seu pedido foi aprovado',
                                        'Mantenha-se nessa página para ser notificado',
                                        'success'
                                        )
                                    } );
                                        </script>";
                            unset($_SESSION['id_pedido2']);
                        }
                    }
                    if($dados->status==3)
                    {
                        if(isset($_SESSION['id_pedido3']))
                        {
                            echo "<script> 
                                    $(document).ready(function sweetalertclick() 
                                    {
                                        Swal.fire(
                                        'O entregador já saiu para realizar a entrega',
                                        'Em breve seu pedido chegará',
                                        ''
                                        )
                                        } );
                                 </script>";
                            unset($_SESSION['id_pedido3']);
                        }
                    }
                    if($dados->status==4)
                    {
                        echo "<script> 
                                  $(document).ready(function sweetalertclick() 
                                  {
                                        Swal.fire(
                                        'O entregador está aguardando no seu endereço',
                                        'Seu pedido chegou =)',
                                        'success'
                                        )
                                  } );
                                        </script>";
                        unset($_SESSION['id_pedido']);
                    }
                    if($dados->status==0)
                    {
                        $id=base64_encode($_SESSION['id']);
                        echo "<script> 
                                  $(document).ready(function sweetalertclick() 
                                  {
                                        Swal.fire(
                                        'Seu pedido foi negado =(',
                                        'Clique em ok para ser redirecionado ao cardápio novamente',
                                        'error'
                                        )
                                  } );
                                  window.onclick = function() {
                                    window.location.href='cardapio.php?id=$id';
                                  }
                                        </script>";
                        unset($_SESSION['id_pedido']);
                    }
                }
            }
        }