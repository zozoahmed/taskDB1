<?php

require 'connction.php';

$id = $_GET['id'];
$sql = "select id,name,email ,image from users where id = $id";
$resultObj = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($resultObj);
 ####
function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    // $image    = Clean($_POST['image']);

    $errors = [];

    if (empty($name)) {
        $errors['name'] = "Field Required";
    }

    if (empty($email)) {
        $errors['email'] = "Field Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = "Invalid Email";
    }

    if (count($errors) >0 ){
    foreach ($errors as $key => $value ){
        echo '*'.  $key . ' : ' . $value  . '<br>';

    }

}
else {

$sql = "insert into users (name,email,password,image) values ('$name','$email','$password','image')";

$op = mysqli_query($con , $sql);
if($op) {  echo "Success , Your Account Created"; }
         else{ echo "Failed , " . mysqli_error($con);}
}


 $_SESSION['message'] = $message;

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Update Info : </h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$data['id']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name"  value = "<?php echo $data['name'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email" value = "<?php echo $data['email'];?>">
            </div>
            
          
             <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>