<?php
/**
 * Created by PhpStorm.
 * User: Juliano
 * Date: 14/05/2019
 * Time: 20:26
 */

define('DB_NAME','fast_food2');
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');

if(!defined('ABSPATH'))
{
    define('ABSPATH',dirname(__FILE__).'/');
}
if(!defined('BASEURL'))
{
    define('BASEURL','/clientea/');
}
if(!defined('DBAPI'))
{
    define('DBAPI',ABSPATH.'/banco/database.php');
}
?>