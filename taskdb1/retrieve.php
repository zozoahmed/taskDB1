<?php
 require "connction.php";
 
 $name = "9.jpg";
$stmt = $pdo->prepare("SELECT `img_data` FROM `image` WHERE `img_name`=?");
$stmt->execute([$name]);
$img = $stmt->fetch();
$img = $img["img_data"];

 $img = base64_encode($img);
$ext = pathinfo($name, PATHINFO_EXTENSION);
echo "<img src='data:image/".$ext.";base64,".$img."'/>";
?>