<?php
/**
 * Created by PhpStorm.
 * User: Juliano
 * Date: 14/05/2019
 * Time: 20:37
 */

mysqli_report(MYSQLI_REPORT_STRICT);

function open_database()
{
    try
    {
        $conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_NAME);
        $conn->set_charset('utf8');
        return $conn;
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        return null;
    }
}

function close_database()
{
    try
    {
        mysqli_close($conn);
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

function find($table = null, $id = null)
{
    if(!isset($_SESSION))
    {
        session_start();
    }

    $database = open_database();
    $found = null;
    try
    {
        if($id)
        {
            $sql = ' select * from '.$table.' where id = '.$id;
            $result = $database->query($sql);
            if($result->num_rows>0)
            {
                $found = $result->fetch_all(MYSQLI_ASSOC);
            }
        }
    }
    catch (Exception $e)
    {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
    return $found;

}


function find_all($table)
{
    return find($table);
}


function save($table = null, $id = null)
{
    if(!isset($_SESSION))
    {
        session_start();
    }
    $database = open_database();
    $columns = null;
    $values = null;
    foreach ($data as $key=>$value)
    {
        $columns .= trim($key,",").",";
        $values .= "'$value',";
    }
    $columns = rtrim($columns.',');
    $values = rtrim($values,',');
    $sql = ' insert into '.$table. "($columns)"." values". "($values)";
    try
    {
        $database->query($sql);
        $_SESSION['message'] = 'Cadastro realizado com sucesso!';
        $_SESSION['type'] = 'sucess';
    }
    catch (Exception $e)
    {
        $_SESSION['message'] = 'Não foi possível realizar a operação.';
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
}

function update($table = null, $id = 0, $data = null)
{
    if(!isset($_SESSION))
    {
        session_start();
    }
    $database = open_database();
    $itens = null;
    foreach($data as $key=>$value)
    {
        $itens .= rtrim($key."'")."='$value',";
    }
    $itens = rtrim($itens,',');
    $sql = 'update '.$table;
    $sql .=" set $itens";
    $sql .= ' where id = '. $id.';';
    try
    {
        $database->query($sql);
        $_SESSION['message'] = 'Registro atualizado com sucesso!';
        $_SESSION['type'] = 'sucess';
    }
    catch (Exception $e)
    {
        $_SESSION['message'] = 'Não foi possível realizar a operação.';
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
}


/*
function remove($table = null, $id = null)
{
    if(!isset($_SESSION))
    {
        session_start();
    }
    $database = open_database();
    try
    {
        if($id)
        {
            $sql = 'delete from '. $table.' where id = '.$id;
            if($result = $database->query($sql))
            {
                $_SESSION['message'] = "Registro removido com sucesso!";
                $_SESSION['type'] = 'sucess';
            }

        }
    }
    catch (Exception $e)
    {
        $_SESSION['message'] = 'Não foi possível realizar a operação.';
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
}
*/

?>