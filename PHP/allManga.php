<?php session_start();?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../CSS/template.php">	
		<link rel="stylesheet" type="text/css" href="../CSS/template-manga.php">
		<link rel="icon" type="image/png" href="../Image/logo.png">
		
		<title> Profile </title>
		
	</head>

	<body>
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
						echo "<tr><td> <a href=\"profile.php\">".strtoupper($_SESSION['username'])."</a></td></tr>";
						echo "<tr><td> <a class = \"sign\" href=\"logout.php\"> Sign Out </a> </td></tr></table></td>";	
					}else{
						echo "Guest<br>";
						$path_foto="../Image/Profile_Picture/profile.png";
						echo "<td><img class = \"profile-pict\" src = \"$path_foto\"> </td>";
						echo "<td><table border = \"0\">"; 
						echo "<tr><td><a href=\"profile.php\">Guest</a></td></tr>";		
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
		
		
		<div id = "main">
			<?php include"MangaList.php"?>
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
		</script>
		
	</body>
</html>