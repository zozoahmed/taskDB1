<?php

session_start();

 $server   = "localhost";
$database = "phpnti";
$username = "root";
$password = "";


try  {

$con = mysqli_connect($server ,$username ,$password , $database);

if(!$con) {
    throw new Exception('not connected' .mysqli_connect_error());

}
}catch (Exception $e) {
    echo $e->getMessage();
}
 



?>