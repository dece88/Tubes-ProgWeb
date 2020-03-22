<style type="text/css">
	body{
		background-image:url('../Image/addNewManga.jpg');
		background-size: cover;
		background-attachment : fixed;
	}
	fieldset{
		background-color: rgba(255, 235, 205,0.5);
		text-align:center;
		padding:10px;
		font-family: "comic sans ms";
		width: 50%;
		margin: auto;
	}
	legend{
		font-size:50px;
		padding:10px;
		font-family: "comic sans ms";
		font-weight:bolder;
		color:white;
	}
	.add-manga{
		margin-top:190px;
	}
	
	.add-manga a{
		text-decoration: none;
		color: black;
	}
	
	.add-manga a:hover{
		background-color : rgba(0,0,0,0.5); 
		color: white;
	}
</style>

<div class="add-manga">
	<fieldset>
		<legend><a href="home.php">Back to Home</a></legend>
<?php 
	include 'conn.php';
	chdir("../manga");
	$dir=getcwd();
	$target_files="../manga/";
	$arr_of_directory=array();

	if(is_dir($dir)){
		$arr=scandir($dir);
		foreach ($arr as $entry) {
			if($entry!='.' && $entry!='..'){
				array_push($arr_of_directory,$target_files.$entry);
			}
		}
	}


	foreach ($arr_of_directory as $item) {
		#variables
		$valid=true;
		$title=pathinfo($item,PATHINFO_BASENAME);

	
		#check validitas
		$sql="SELECT * FROM manga";
		$result=mysqli_query($conn,$sql) Or die(mysqli_error($conn));

		
		while($valid && $entries=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$getTitle=pathinfo($entries['directory_path'],PATHINFO_BASENAME);
			if($title == $getTitle){
				$valid=false;
			}
		}
	


		#adding to database
		if($valid){
			$sql="	INSERT INTO manga(title,directory_path)
					VALUES ('$title','$item')";
			mysqli_query($conn,$sql) Or die(mysqli_error($conn));
			echo "<h2>$title has been added to database!</h2>";
		}					
	}
 ?>		
	</fieldset> 
</div>
