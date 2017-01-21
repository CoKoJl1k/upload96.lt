
<?php
	$msg = "";
// if upload button
	if (isset($_POST['upload'])) {
		$target = "images/".basename($_FILES['image']['name']);

		// connect to the database

		$db = mysqli_connect("localhost", "root", "", "photos");

		// get all the submitetted data from the form
		$image = $_FILES['image']['name'];
		$text = $_POST['text'];

		$sql = "INSERT INTO images (image, text) VALUES ('$image', '$text')";
		mysqli_query($db,$sql);

		//now let's move the uploaded image into the folder:images
		if (move_uploaded_file($_FILES['tmp_name']['name'], $target)) {
			$msg = "Изображение загрузилось полностью.";
		} else {
			$msg = "Возникли проблемы при загрузке изображения.";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Загрузка изображения</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="content">
<?php
	$db = mysqli_connect("localhost", "root", "", "photos");
	$sql = "SELECT * FROM images";
	$result = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_array($result)) {
		echo "<div id='img_div'> ";
			echo "<img src='images/".$row['image']."' >";
			echo "<p>".$row['text']."</p>";
		echo "</div>";
	}

?>
	<form method="post" action="index.php" enctype="multipart/form-data">
	<p>Загрузите файл формата .img .phg</p>
		<input type="hidden" name="size" value="1000000">
		<div>
			<input type="file" name="image">
		</div>
		<div>
			<textarea name="text" cols="40" rows="4" placeholder="Say something obout this image..."></textarea>
		</div>
		<div>
			<input type="submit" name="upload" value="Upload Image">
		</div>
	</form>	
	</div>

</body>
</html>