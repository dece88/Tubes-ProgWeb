
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
		background-image:url('../Image/loginBackground.jpg');
		background-size:cover;
	}
	div{
		margin-top:190px;
	}

</style>
<audio loop="loop" autoplay>
	<source src="../Music/Yumetourou.mp3" type="audio/mp3">
</audio>
<?php 
	session_start();
	include 'conn.php';
	if(isset($_POST['username']) && isset($_POST['password'])){
		$username=$_POST['username'];
		$password=md5($_POST['password']);

		$sql="SELECT * FROM reader";
		$result=mysqli_query($conn,$sql) Or die(mysqli_error($conn));
		$ada=false;

		while(!$ada && $row=mysqli_fetch_array($result)){
			if($row['username']==$username && $row['pass']==$password){
				$ada=true;
			}
		}

		if($ada){
			if(isset($_POST['remember'])){
				setcookie("user",$username,time()+(30*86400));
				setcookie("pass",$_POST['password'],time()+(30*86400));
			}
			echo "<script>window.alert(\"Login success!\")</script>";
			$_SESSION['username']=$username;
			header('Location:home.php');		#check here!
		}else{
			echo "<script>window.alert(\"user not found\")</script>";
		}
		
	}
 ?>
<div>
 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<fieldset>
		<legend>Login</legend>
			Username : <input type="text" name="username" value="<?php if(isset($_COOKIE['user'])){echo $_COOKIE['user'];} ?>"><br><br>
			Password : <input type="password" name="password" value="<?php if(isset($_COOKIE['pass'])){echo $_COOKIE['pass'];} ?>"><br>
			<input type="checkbox" name="remember" style="text-align:left">Remember Me
			<br><br>
			<input type="submit" name="Login" value="Log in">
			<input type="reset" name="Reset" value="Reset"><br><br>
			<a href="home.php">Go back Home</a>
	</fieldset> 	
 </form>
</div>
