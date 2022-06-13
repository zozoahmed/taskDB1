<?php
require 'connction.php';

function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name     = Clean($_POST['name']);
    $password = Clean($_POST['password']);
    $email    = Clean($_POST['email']);
    //  $image    = Clean($_POST['image']);

 $errors = [];

     if (empty($name)) {
        $errors['name'] = "Field Required";
    }

if (empty($email)){
   $errors['email']= "is required";}

   elseif(!filter_var($email ,FILTER_VALIDATE_EMAIL))
   {
       $errors['Email'] = "invalid Email";
   }
  if (empty($password)) {
        $errors['password'] = "Field Required";
    } elseif (strlen($password) < 6) {
        $errors['Password'] = "Length Must be >= 6 chars";
    }
 
     if (empty($_FILES['image']['name'])) {
        $errors['image'] = "Field Required";
    } else {

         $imageType = $_FILES['image']['type'];
        $extensionArray = explode('/', $imageType);
        $extension =  strtolower(end($extensionArray));

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];     

        if (!in_array($extension, $allowedExtensions)) {

            $errors['image'] = "File Type Not Allowed";
        }
    }

####333333333333333333
if (count($errors) >0 ){
    foreach ($errors as $key => $value ){
        echo '*'.  $key . ' : ' . $value  . '<br>';

    }

}
else {
        $finalName = uniqid() . time() . '.' . $extension;
        $disPath = 'uploud/' . $finalName;
        $tempName  = $_FILES['image']['tmp_name'];

        if (move_uploaded_file($tempName, $disPath)) {
            $file = fopen('info.txt', 'a') or die('Unable to OPen File');

            $text =  uniqid() . "|" . $name . "|" . $email . "|" . $password . "|" . $finalName ."\n";
            fwrite($file, $text);

            fclose($file);

            echo '<div class="alert alert-success">
                    <strong>Success!</strong> Your Data is Stored Successfully.
                 </div>';   

        } else {
            echo 'Error In Saving Data  , Try Again';
        }
     $password = sha1($password);

$sql = "insert into users (name,email,password, image) values ('$name','$email','$password' ,'image')";

$op = mysqli_query($con , $sql);
if($op) {  echo "Success , Your Account Created"; }
         else{ echo "Failed , " . mysqli_error($con);}
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" class="form-control" required id="exampleInputPassword1" name="password" placeholder="Password">
            </div>


             <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>  

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>