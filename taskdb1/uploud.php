
<?php
 
error_reporting(0);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['uploud'])) {

	$filename = $_FILES["uploudfile"]["name"];
	$tempname = $_FILES["uploudfile"]["tmp_name"];
	$folder = "./image/" . $filename;

	$db = mysqli_connect("localhost", "root", "", "");

 	$sql = "INSERT INTO image (filename) VALUES ('$filename')";

 	mysqli_query($db, $sql);

 	if (move_uploaded_file($tempname, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
	} else {
		echo "<h3> Failed to upload image!</h3>";
	}
}
?>

 
<style>
*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

#content{
	width: 50%;
	justify-content: center;
	align-items: center;
	margin: 20px auto;
	border: 1px solid #cbcbcb;
}
form{
	width: 50%;
	margin: 20px auto;
}

#display-image{
	width: 100%;
	justify-content: center;
	padding: 5px;
	margin: 15px;
}
img{
	margin: 5px;
	width: 350px;
	height: 250px;
}
</style>


<!DOCTYPE html>
<html>

<head>
	<title>Image Upload</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
	<div id="content">
		<form method="POST" action="" enctype="multipart/form-data">
			<div class="form-group">
				<input class="form-control" type="file" name="uploadfile" value="" />
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="uploud">UPLOAD</button>
			</div>
		</form>
	</div>
	<div id="display-image">
	<?php
		$query = " select * from image ";
		$result = mysqli_query($db, $query);

		while ($data = mysqli_fetch_assoc($result)) {
	?>
		<img src="w2day6/taskdb1/<?php echo $data['filename']; ?>">

	<?php
		}
	?>
	</div>
</body>

</html>

 <?php

// if (isset($_FILES["uploud"])) {
//   try {

//     require "connection.php";

//      $stmt = $pdo->prepare("INSERT INTO `images` (`img_name`, `img_data`) VALUES (?,?)");
//     $stmt->execute([$_FILES["uploud"]["name"], file_get_contents($_FILES["uploud"]["tmp_name"])]);
//     echo "OK";
//   } catch (Exception $ex) { echo $ex->getMessage(); }
// }

?>
<!-- <form method="post" enctype="multipart/form-data">
  <input type="file" name="uploud" accept=".png,.gif,.jpg,.webp" required>
  <input type="submit" name="submit" value="Upload Image">
</form> -->



<?php
// $private = "PATH/TO/FOLDER/";
// move_uploaded_file (
//   $_FILES["uploud"]["tmp_name"], $private . $_FILES["uploud"]["name"]
// );
?>
