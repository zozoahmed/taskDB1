 <?php
 
 require 'connction.php';

 $sql = "select id ,name , email, image from users";

 $resultObj = mysqli_query($con , $sql);
 
 ?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <style>
        .m-r-1em {
            margin-right: 1em;
        }
        .m-b-1em {
            margin-bottom: 1em;
        }
        .m-l-1em {
            margin-left: 1em;
        }
        .mt0 {
            margin-top: 0;
        }
    </style>

</head>
<body>
     <div class="container">
        <div class="page-header">
            <h1> Users </h1>
            <br>
         <?php 
            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
         ?>
        </div> <a href="">+ Account</a>
        <table class='table table-hover table-responsive table-bordered'>
             <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>action</th>
            </tr>
     <?php 
         while($raw = mysqli_fetch_assoc($resultObj)){      
     ?>
            <tr>
                <td><?php  echo $raw['id'];  ?></td>
                <td><?php  echo $raw['name'];  ?></td>
                <td><?php  echo $raw['email'];  ?></td>
                <td><?php  echo $raw['image'];  ?></td>
                <td>
                    <a href='delete.php?id=<?php  echo $raw['id'];  ?>' class='btn btn-danger m-r-1em'>Delete</a>
                    <a href='edit.php?id=<?php  echo $raw['id'];  ?>' class='btn btn-primary m-r-1em'>Edit</a>
                    <a href='insert.php?id=<?php  echo $raw['id'];  ?>' class='btn btn-primary m-r-1em'>insert</a>
                </td>
            </tr>
    <?php } ?>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>


