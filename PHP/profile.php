<?php session_start();
	include 'conn.php';
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../CSS/template.php">	
		<link rel="icon" type="image/png" href="../Image/logo.png">
		
		<title> Profile </title>
		
		<style>
			.profile-editting{
				width: 100%;
				color: white;
			}
			#profile-choice{
				width: 100%;
				color: white;
				display: none;
				margin-left: 40px;
				
			}
		</style>
	</head>

	<body style="background-image: url('../Image/profile.gif'); background-size: cover; background-attachment: fixed; background-repeat: no-repeat;">
		<audio loop="loop" autoplay>
			<source src="../Music/MyDearest.mp3" type="audio/mp3">
		</audio>
		<nav class="navbar">
			<a style="text-decoration: none; float: left;" href = "home.php"><img class = "logo" src = "../Image/logo.png"></a>
			<a style="text-decoration: none;" href="home.php"><text style="font-size: 25px; color: white; float: left; padding-top: 18px;">ALPHA MANGA</text></a>
			<span class="open-slide">
			  <a href="#" onclick="openSlideMenu()">
				<svg width="30" height="30">
					<path d="M0,5 30,5" stroke="#fff" stroke-width="5"/>
					<path d="M0,14 30,14" stroke="#fff" stroke-width="5"/>
					<path d="M0,23 30,23" stroke="#fff" stroke-width="5"/>
				</svg>
			  </a>
			</span>
		</nav>
		
		<div id = "side-menu" class = "side-nav">
			<a href = "#" class = "btn-close" style="width: 25%;" onclick = "closeSlideMenu()"> &times; </a>
			<hr>
			<div class = "profile">
				<table border = "0">
					
				<tr>
				<?php 
					include 'conn.php';
					if(isset($_SESSION['username'])){
						$sql="SELECT photo FROM reader WHERE username='{$_SESSION['username']}'";
						$result=mysqli_query($conn,$sql);
						$row=mysqli_fetch_row($result);
						$path_foto=$row[0];
						echo "<br>";
						echo "<td><img class = \"profile-pict\" src = \"$path_foto\"> </td>";
						echo "<td><table border = \"0\">"; 
						echo "<tr><td> <a>".strtoupper($_SESSION['username'])."</a></td></tr>";	
						echo "<tr><td> <a class = \"sign\" href=\"logout.php\"> Sign Out </a> </td></tr></table></td>";	
					}else{
						echo "Guest<br>";
						$path_foto="../Image/Profile_Picture/profile.png";
						echo "<td><img class = \"profile-pict\" src = \"$path_foto\"> </td>";
						echo "<td><table border = \"0\">"; 
						echo "<tr><td><a>Guest</a></td></tr>";	
						echo "<tr><td><a class = \"sign\" href=\"login.php\"> Sign In </a> </td>";
						echo "<td><a class = \"sign\" href=\"signup.php\"> Sign Up </a> </td></tr></table></td>";
					}
				?>
				</tr>
				</table>
			</div>
			<hr>
			
			<?php 
				include 'conn.php';
				if(!isset($_SESSION['username'])){
					echo "<a href = \"home.php\"> HOME </a>";
					echo "<a href = \"allManga.php\"> MANGA LIST </a>";
				} else {
					$sql = "SELECT info FROM reader WHERE username='{$_SESSION['username']}'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_row($result);
					if($row[0] == 'Admin'){
						echo "<a href = \"home.php\"> HOME </a>";
						echo "<a href = \"allManga.php\"> MANGA LIST </a>";
						echo "<a href = \"addNewManga.php\"> UPLOAD </a>";
					} else {
						echo "<a href = \"home.php\"> HOME </a>";
						echo "<a href = \"allManga.php\"> MANGA LIST </a>";
					}
				}
			?>
		</div>
		
		<div id = "main" style="background-color: rgba(0,0,0,0.7);">
			<div class = "profile">
				<table width="100%">	
				<tr style="text-align: center;">
				<?php 
						
					if(isset($_SESSION['username'])){
						echo "<td style=\"border-right: 3px solid white;\" width=\"35%;\"><img src = \"$path_foto\" height=\"40%\ width=\"40%\" style=\"border-radius: 100px;\"> </td>";
						echo "<td style=\"text-align: justify; padding-left: 40px; color: white;\"><h1>NAMA : ".strtoupper($_SESSION['username'])."</h1>";
						echo "<button onclick=\"editingProfile()\" value=\"Edit Setting\">Edit Setting</button><td>";
						
						#show this user favorite manga
						$sql="SELECT userid FROM reader WHERE username='{$_SESSION['username']}'";
						$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
						$row=mysqli_fetch_row($result);
						$userid=intval($row[0]);
						$sql="SELECT mangaid FROM favorite WHERE userid=$userid";
						$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

						$fav;
						$arr_favorite=array();
						while($row=mysqli_fetch_row($result)){
							array_push($arr_favorite,$row[0]);
						}

						foreach ($arr_favorite as $mangaid) {
							$thisid=intval($mangaid);
							$sql="SELECT title FROM manga WHERE idmanga=$thisid";
							$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
							$row=mysqli_fetch_row($result);
							if(!isset($fav)){
								$fav=$row[0];
							}else{
								$fav.=", {$row[0]}";
							}
						}
						

					}else{
						$path_foto="../Image/Profile_Picture/profile.png";
						echo "<td style=\"border-right: 3px solid white;\" width=\"35%;\"><img src = \"$path_foto\" height=\"70%\ width=\"70%\" style=\"border-radius: 100px;\"> </td>";
						echo "<td style=\"text-align: justify; color: white; padding-left: 40px;\"><h1>NAMA : GUEST</h1></td>";	
					}
				?>
				</tr>
				<?php 
					echo "<tr style=\"color:white;text-align:center\">";
					if(!isset($fav)){
							echo "<td>You haven't added any manga to favorite list!</td>";
						}else{
							echo "<td>my favorite manga : $fav</td>";
						}
					echo "</tr>";
				 ?>
				</table>
			</div>

			<div id="profile-choice">
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
					<h2>What do you want to edit?</h2>
					<select name="setting">
						<option value="change_pass">Change Password</option>
						<option value="Change_email">Change Email</option>
					</select>	
					<input type="submit" value="Go!" name="submit"/>
				</form>
			</div>
			
			<div class="profile-editting">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<?php 
					if(isset($_POST['submit'])){
						$menu = $_POST['setting'];
						if($menu == "change_pass"){
							echo "<fieldset style=\"color: white;\">";
								echo "<legend>Change Password</legend>";
								echo "Old Password	: <input type=\"password\" name=\"old-password\"/><br><br>";
								echo "New Password	: <input type=\"password\" name=\"new-password\"/><br><br>";
								echo "Input Again New Password	: <input type=\"password\" name=\"renew-password\"/><br><br>";
								echo "<input type=\"submit\" name=\"submit-go-pass\" value=\"Change It\">";
							echo "</fieldset>"; 
						} else if($menu == "Change_email"){
							echo "<fieldset style=\"color: white;\">";
								echo "<legend>Change Email</legend>";
								echo "Old Email	: <input type=\"text\" name=\"old-email\"/><br><br>";
								echo "New Email	: <input type=\"text\" name=\"new-email\"/><br><br>";
								echo "<input type=\"submit\" name=\"submit-go-email\" value=\"Change It\">";
							echo "</fieldset>"; 
						} 
					} 
				?>
				</form>
				<?php
					
					if(isset($_POST['submit-go-pass'])){
						$old_pass = md5($_POST['old-password']);
						$new_pass = md5($_POST['new-password']);
						$renew_pass = md5($_POST['renew-password']);
						
						if($new_pass == $renew_pass){
							
							$sql = "SELECT * FROM reader WHERE username='{$_SESSION['username']}'";
							$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
							$row = mysqli_fetch_row($result);
							if($row[3] == $old_pass){
								$sql = "UPDATE reader SET pass='$new_pass' WHERE username='{$_SESSION['username']}'";
								if(mysqli_query($conn, $sql)){
									echo "<script>window.alert(\"Password berhasil diganti!\")</script>";
								} else {
									echo "<script>window.alert(\"Password gagal diganti!\")</script>";
								}
							} else {
								echo "<script>window.alert(\"Password lama Salah Input!\")</script>";
							}
						} else {
							echo "<script>window.alert(\"Password yang diinput ulang Salah!\")</script>";
						}
					} else if(isset($_POST['submit-go-email'])){
						$old_email = $_POST['old-email'];
						$new_email = $_POST['new-email'];
						
						$sql = "SELECT * FROM reader WHERE username='{$_SESSION['username']}'";
						$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
						$row = mysqli_fetch_row($result);
						if($row[2] == $old_email){
							$sql = "UPDATE reader SET email='$new_email' WHERE username='{$_SESSION['username']}'";
							if(mysqli_query($conn, $sql)){
								echo "<script>window.alert(\"Email berhasil diganti!\")</script>";
							} else {
								echo "<script>window.alert(\"Email gagal diganti!\")</script>";
							}
						} else {
							echo "<script>window.alert(\"Email lama Salah Input!\")</script>";
						}
					} 
				?>
			</div>
			<br><br> 
		</div> 
		
		<div class = "footer">
			<center>
			<br>
			<br>
			<a href = "#"> <img class = "icon" src = "../Image/instagram.png"> </a>
			<a href = "#"> <img class = "icon" src = "../Image/twitter.png"> </a>
			<br>
			<p> &copy 2019, Alpha Manga <br>
			Copyrights and trademarks for the manga, and other promotional materials are held by their respective owners </p>
			</center> 
			
		</div>
		
		<script>
			function openSlideMenu(){
				document.getElementById('side-menu').style.width = '350px';
			}
			
			function closeSlideMenu(){
				document.getElementById('side-menu').style.width = '0';
			}
			
			function editingProfile(){
				document.getElementById('profile-choice').style.display = 'block';
			}
		</script>
		
	</body>
</html>