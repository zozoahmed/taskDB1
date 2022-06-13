<?php

require_once "connction.php";
 if(isset($_POST["insert"])&& !empty($_POST)){


     $queryString=$connection->prepare("INSERT INTO image (img_name, imag_path ,status)VALUES(?,?,?,?,?)");

    $img_name=$_POST["img_name"];
    $img_path=$_POST["img_path"];
     

    $status=1;

    if($queryString->execute([$img_name,img_path,$status])){
        header("Location: index.php");
    }else{

        echo"Failed to insert";
        header("Refresh: 3;URL=index.php");
    }

 }else{
    echo"Error: You cannot access this page directly, Back to home!";

 }