<style type="text/css">
	form{
		margin:auto;
		width:50%;	
	}
	fieldset{
		background-color: rgba(255, 235, 205,0.5);
		text-align:center;
		padding:10px;
		font-family: "comic sans ms";
	}
	legend{
		font-size:50px;
		padding:10px;
		font-family: "comic sans ms";
		font-weight:bolder;
		color:white;
	}
	body{
		background-image: url('../Image/signup.jpg');
		background-size:cover;
	}
	div{
		margin-top:190px;
	}

</style>



<?php
	include "conn.php";
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$email = $_POST['email'];
		$status = $_POST['info'];
		$foto = $_FILES['foto_profile']['tmp_name'];
		$foto_name = $_FILES['foto_profile']['name'];
		$path_foto = "../Image/Profile_Picture/profile.png";
		
		$sql="SELECT username FROM reader WHERE username='$username'";
		$result=mysqli_query($conn,$sql) Or die(mysqli_error($conn));

		if(mysqli_num_rows($result)!=0){
			echo "<script>window.alert(\"username has been taken!\")</script>";
		}else{
			if($_FILES['foto_profile']['error'] == 0){
				if(!getimagesize($_FILES['foto_profile']['tmp_name'])){
					echo "<script>window.alert(\"file upload is not an image\");</script>";
				}else{
					if(move_uploaded_file($foto, "../Image/Profile_Picture/$foto_name")){
						echo "<script>window.alert(\"Upload File Succesfully!\");</script>";
						$path_foto = "../Image/Profile_Picture/$foto_name";
					} else {
						echo "<script>window.alert(\"Upload failed!\")</sript>";
					}
				}
				
			}
			
			
		
			$sql = "INSERT INTO reader(username, email, pass, photo, info) VALUES('$username', '$email', '$password', '$path_foto', '$status')";
		
			if(mysqli_query($conn, $sql)){
				echo "<script>window.alert(\"Sign Up Succesfully!\")</script>";
				header("Location:home.php");
			} else {
				echo "<script>window.alert(\"Sign Up Fail!\")</script>";
			}
		}
		
	} 
?>

<audio loop="loop" autoplay>
	<source src="../Music/Kirameki - Wacci (Your Lie In April).mp3" type="audio/mp3">
</audio>

<div>
 <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<fieldset>
		<legend>Sign Up</legend>
			Username	: <input type="text" name="username"/><br><br>
			Password	: <input type="password" name="password"/><br><br>
			Email 		: <input type="text" name="email"/><br><br>
			Upload Foto Profile : <input type="file" name="foto_profile"/>
			<input type="hidden" name="info" value="Reguler"/>
			
			<br><br>
		<input type="submit" name="SignUp" value="SignUp">
		<input type="reset" name="Reset" value="Reset"><br><br>	
		<a href="home.php">Go Back Home</a>
	</fieldset> 	
 </form>
</div>

