<?php

$connect = mysqli_connect('localhost', 'root', '', 'tutorials') or die(mysqli_error());

if(isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$r_password = $_POST['r_password'];

 	 $password = stripslashes($password);
 	 $password    = htmlspecialchars($password);
 	 $password = trim($password);//удаляем все лишнее 


     if (strlen($password) < 8 ) {//проверка на    количество символов
            echo ("Пароль слишком короткий."); //останавливаем выполнение сценариев
            }else{
					if($password == $r_password) {
						$password = md5($password);
						$query = "INSERT INTO usersss VALUES ('','$username', '$email', '$password')" or die(mysqli_error());
						mysqli_query($connect,$query);
						header ("Location: upload/index.php");
					}
					else{
						die('Пароли не совпадают!');
					}
				}
}

if(isset($_POST['enter'])){
	$e_email = $_POST['e_email'];
	$e_password =md5($_POST['e_password']);





	$connect = mysqli_connect('localhost', 'root', '', 'tutorials') or die(mysqli_error());
	$query = "SELECT * FROM usersss WHERE email = '$e_email'";
	$user_data = mysqli_query($connect,$query);
	$row = mysqli_fetch_array($user_data);

	if($row['password'] == $e_password) {
		 header ("Location: upload/index.php");
	}
	else{
		echo "Пароль или email не верны.";
	}
}
?>

<form method="post" action="index.php">
<input type="text" name="username" placeholder="Username" required /><br>
<input type="email" name="email" placeholder="email" required /><br>
<input type="password" name="password" placeholder="Password" required /><br>
<input type="password" name="r_password" placeholder="Repeat password" required /><br>
<input type="submit" name="submit" value="Register"/><br>
</form>

<form method="post" action="index.php">
<input type="email" name="e_email" placeholder="email" required /><br>
<input type="password" name="e_password" placeholder="Password" required /><br>
<input type="submit" name="enter" value="Enter"/><br>
</form>