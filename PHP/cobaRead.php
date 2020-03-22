<?php 
	session_start();
 ?>

<?php 

	if(isset($_GET['Go'])){
		$_SESSION['repeat']="checked";
	}

	if(!isset($_SESSION['recorded'])&& !isset($_SESSION['repeat'])){				
		$x=$_GET['this_path'];
		$title=$_GET['title'];
		
		#counter increment in database
		include 'conn.php';
		$sql="SELECT counter FROM manga WHERE title='$title'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$row=mysqli_fetch_row($result);
		$counter=$row[0]+1;
		echo "counter :".$counter."<br>";

		$sql="UPDATE manga SET counter=$counter WHERE title='$title'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		
		header("Location:convertToXML.php?this_path=$x&chapter={$_GET['chapter']}&title={$title}");
	}else{
		if(isset($_SESSION['recorded'])){
			unset($_SESSION['recorded']);	
		}
		if(isset($_SESSION['repeat'])){
			unset($_SESSION['repeat']);
		}
	}

	#get path to access chapters
	$arr_of_chapters=array();
	$temp_path=pathinfo($_GET['this_path'],PATHINFO_DIRNAME);
	$temp_path=pathinfo($temp_path,PATHINFO_DIRNAME);
	foreach (scandir($temp_path) as $entry) {
		if($entry!='.' && $entry!='..' && $entry!='cover' && $entry!='xml' && $entry!='comment.txt' && $entry!='info.txt'){
			array_push($arr_of_chapters,$entry);
		}
	}
	
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>READ MANGA</title>
	<meta charset="utf-8">
	<style>
	@font-face{
		font-family: "exo2";
		src: url("../CSS/Font/Exo2.otf");	
	}
	body{
		margin: 0;
		padding: 0;
		background-color: rgb(0,0,0,0.8);
		color: white;
		font-family: exo2;
		position: relative;
	}

	#manga{
		width:400px;
		height:600px;
		margin-right: 15%;
		margin-top: 10px;
	}
		
	#pagesnumber{
		margin-top: 15px;
		float: right;
		margin-right: 70px;
		font-size: 20px;
	}
	
	.home{
		float: left;
		margin-top: 10px;
		margin-left: 20px;
		width:30px;
		height:30px;
	}
	
	.back{
		color: white;
		position: absolute;
		text-decoration: none;
		border-radius: 0 3px 3px 0;
		font-size: 20px;
		font-weight: bold;
		width: auto;
		padding: 12px;
		border: none;
	}
	
	.chapter-select{
		margin-top: 30px;
		margin-left: 20px;
		float: left;
	}
	
	select{
		background: transparent;
		border: none;
		font-size: 14px;
		height: 30px;
		padding: 3px;
		width: 200px;
		color: white;
		font-family: exo2;
		font-size: 18px;
	}
	
	select option{
		color: black;
	}
	
	.change{
		padding: 2px 10px 2px 10px;
		font-family: exo2;
		font-size: 18px;
		margin-left: 10px;
	}
	
	.prev, .next{
		color: white;
		position: absolute;
		top: 50%;
		border-radius: 0 3px 3px 0;
		font-size: 25px;
		font-weight: bold;
		width: auto;
		padding: 16px;
		border: none;
		background-color: rgb(0,0,0,0);	
		transition: 0.6s ease;
		opacity: 0.7;
		
	}
	
	.next{
		right: 0;
		border-radius: 3px 0 0 3px;
	}
	
	.prev:hover, .next:hover, .back:hover{
		background-color: rgba(0,0,0,0.8);
	}

	</style>
</head>
<body>
	<a class = "back" href = "mangaProfile.php?title=<?php echo $_GET['title'] ?>"> &#10094; </a> <br>
	<div class = 'chapter-select'>
		<form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<select name="chapter">
				<?php 
					function intoStr($x){
						$txt="";
						for($i=0;$i<strlen($x);$i++){
							if($x[$i]=="1"){
								$txt.="satu";
							}else if($x[$i]=="2"){
								$txt.="dua";
							}else if($x[$i]=="3"){
								$txt.="tiga";
							}else if($x[$i]=="4"){
								$txt.="empat";
							}else if($x[$i]=="5"){
								$txt.="lima";
							}else if($x[$i]=="6"){
								$txt.="enam";
							}else if($x[$i]=="7"){
								$txt.="tujuh";
							}else if($x[$i]=="8"){
								$txt.="delapan";
							}else if($x[$i]="9"){
								$txt.="sembilan";
							}else{
								$txt.="nol";
							}
						}
						return $txt;
					}
					foreach ($arr_of_chapters as $item) {
						echo "<option value=".intoStr($item)."> Chapter $item</option>";
					}
		
				?>
			</select>
			<?php 
				echo "<input type=\"hidden\" name=\"this_path\" value=\"{$_GET['this_path']}\">";
				echo "<input type=\"hidden\" name=\"chapter\" value=\"{$_GET['chapter']}\">";
				echo "<input type=\"hidden\" name=\"title\" value=\"{$_GET['title']}\">";

			 ?>
			<input class = "change" type="submit" name="Go" value="Go">
		</form>
	</div>
	<br>
	<a href = "home.php"> <img class = "home" src = "../Image/home.png"> </a>
		<center>
		<span id="pagesnumber"> Page </span>
		<img id="manga" src=""> 
		</center>
		<button class = "prev" type="button" onclick="prev()"> &#10094; </button>
		<button class = "next" type="button" onclick="next()"> &#10095; </button>
		
		
	<script type="text/javascript">
		var url="<?php echo $_GET['this_path'] ?>";
		var chapter="<?php echo $_GET['chapter'] ?>";

		var xhttp;
		var i=0;
		var hal=1;
		var x;
		showPage(i);
	
		function showPage(i){
			if(window.XMLHttpRequest){
				xhttp=new XMLHttpRequest();
			}else{
				xhttp=new ActiveXObject("Mirosoft.XMLHttp");
			}
			xhttp.onreadystatechange=function(){
				if(this.status==200 && this.readyState==4){
					myFunction(this,i);
				}
			};
			xhttp.open("GET",url,true);
			xhttp.send();
			document.getElementById("pagesnumber").innerHTML=hal+"/"+x.length;
		}

		function myFunction(xml,i){
			var xmlDoc=xml.responseXML;
			 x=xmlDoc.getElementsByTagName(chapter)[0].getElementsByTagName("pages");
			var current=x[i].getElementsByTagName("path")[0].childNodes[0].nodeValue;
			document.getElementById("manga").src=current;
		}

		function prev(){
			i--;
			if(i<0){
				i=0;
			}
			decrease();
			showPage(i);
		}

		function next(){
			i++;
			if(i==x.length){
				i=x.length-1;
			}
			increase();
			showPage(i);
		}
		function increase(){
			hal++;
			if(hal>x.length){
				hal=x.length;
			}
		}

		function decrease(){
			hal--;
			if(hal<1){
				hal=1;
			}
		}
		
	</script>
</body>
</html>