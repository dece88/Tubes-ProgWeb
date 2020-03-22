

 <style>
	@font-face{
		font-family: "exo2";
		src: url("../CSS/Font/Exo2.otf");	
	}
	
	.manga{
		padding: 5px 140px 15px 5px;
		margin: 50px 0 10px 0;
		border-radius: 10px;
		background-color: rgb(0,0,0,0.2);
		text-align: left;
	}
	
	.cover_manga{
		float:left;
		padding-left: 20px;
		padding-top: 10px;
		margin-bottom: 30px;
	}
	.cover{
		width: 300px;
		height: 400px;
	}
	
	.info{
		font-family:exo2;
		margin-left: 20px;
		margin-top: 10px;	
	}
	.title{
		margin-top: 10px;
		margin-left: 330px;
		font-size:30;
	}
	.detail{
		font-size:18;
		margin-top: 10px;
		margin-left: 330px;
	}
	
	.synopsis{
		margin-left: 330px;
	}
	
	.list_chapter{
		clear: left;
		margin-left: 30px;
		border: 1px solid;
		width: 800px;
		height: 100px;
		font-family:exo2;
		font-size: 20;
		padding: 7px 0 5px 10px;
		position: relative;
		text-align: left;
	}
	
	.chapter_1{
		float: left;
		text-decoration:none;
		background-color: rgb(0,0,0,0.1);
		padding: 5px;
		border-radius: 2px;
		margin: 0 10px 0 10px;
		padding: 10px 30% 10px 5px;
		color: black;
	}
	
	.chapter_2{
		clear: left;
		text-decoration:none;
		background-color: rgb(0,0,0,0.1);
		padding: 5px;
		border-radius: 2px;
		margin: 0 10px 0 10px;
		padding: 10px 30% 10px 5px;
		color: black;
	}
	
	.same-author{
		border: 1px solid black;
		margin-left: 30px;
		width: 800px;
		height: 310px;
		font-family:exo2;
		padding: 7px;
		text-align: left;
	}
	
	.same-author hr{
		margin-bottom:0px;
	}
	.cover-author{
		width: 150px;
		height: 200px;
	}
	
	.title_author{
		font-size: 17px;
		padding: 5px 5px 7px 5px;
	}
	.manga-author{
		float: left;
		width: 150px;
		height: 300px;
		padding: 0 5px 10px 5px;		
	}
	
	.all_comment{
		width: 800px;
		height: auto;
		margin-left: 30px;
		font-family: exo2;
		font-size: 20px;
		text-align: left;
	}
	
	.comment{
		padding-bottom: 10px;
		font-size: 17px;
		margin-left: 20px;
	}
	
	.name_comment{
		margin-bottom: 10px;
		width: 100px;
	}
	
	.add_comment{
		width: 730px;
		height: 100px;
		margin-left: 30px;
	}
	
	.submit_btn{
		font-family: exo2;	
		margin: 5px;
		margin-bottom: 15px;
		padding: 12px;
		font-size: 16px;
		width: 	150px;
		border:none;
		border-radius: 5px;
		background-color: rgb(0,0,0,0.1);
		opacity: 0.8;
		float: right;
	}
	
	.favourite{
		font-family: exo2;	
		margin: 5px;
		margin-left: 35px;
		padding: 12px;
		font-size: 16px;
		width: 150px;
		border:none;
		border-radius: 5px;
		background-color: lightpink;
		opacity: 0.8;
		float: left;
	}
</style>		
<?php 
	$title=$_GET['title'];
	
	include 'conn.php';
	$sql="SELECT * FROM manga WHERE title='$title'";
	$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

	$row=mysqli_fetch_assoc($result);

	#function convert to str
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

	#get synopsis
	$info_path=$row['directory_path']."/info.txt";
	$file=fopen($info_path,'r');
	while(!feof($file)){
		$temp=explode("-",fgets($file));
		if($temp[0]=="Synopsis"){
			$synopsis=$temp[1];
			break;
		}
	}
	fclose($file);

	#get comment path
	$comment_path=$row['directory_path']."/comment.txt";

		#write comment if has been trigerred before
		if(isset($_GET['komentar'])){
			$name=$_SESSION['username'];
			$msg=$_GET['komentar'];
			$tulis=fopen($comment_path,'a');
			fwrite($tulis,$name."-".$msg."\n");
			fclose($tulis);
		}

	
	#pick data from xml
		$xml=simplexml_load_file($row['directory_path']."/xml/".$title.".xml");
	
	#untuk add favorite matter
		$mangaid=(int)$xml->id;
	#end
	
	echo "<div class = 'manga'>";
		echo "<div class = 'cover_manga'>";
			echo "<img class = 'cover' src=\"$xml->cover\"}>";
		echo "</div>";	
		echo "<div class = 'info'>";
			echo "<div class = 'title'>";
				echo $xml->title;
			echo "</div>";
			echo "<div class = 'detail'>";
				echo "Author : ".$xml->author."<br>";
				echo "Genre : ".$xml->genre."<br>";
				echo "Viewed : ".$xml->counter." times<br>";
				echo "Status : ".$xml->status."<br>";
			echo "</div>";
			echo "<div class = 'synopsis'>";
				echo "<br> $synopsis";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	
	#get path to xml and shows chapters
	$xpath=$row['directory_path']."/xml/chapters.xml";
	$info_path=$row['directory_path'];
	echo "<div class = 'list_chapter'>";
		echo "Chapters<hr>";
		$a = 0;
		foreach (scandir($info_path) as $entry) {
			if($entry!='.'&& $entry!='..' && $entry!='info.txt' && $entry!='comment.txt' && $entry!='xml' && $entry!='cover'){
				$chapterInfo=intoStr((string)$entry);
				if($a!=2){
					echo "<a class = 'chapter_1' href=\"cobaRead.php?this_path={$xpath}&chapter={$chapterInfo}&title={$row['title']}\">Chapter $entry </a>";	
					$a++;
				}else{
					echo "<a class = 'chapter_2' href=\"cobaRead.php?this_path={$xpath}&chapter={$chapterInfo}&title={$row['title']}\">Chapter $entry </a>";	
					$a = 1;
				}
			}
		}
	echo "</div>";

	#get same author
	$arr_xml=array();
	$thisauthor=$xml->author;
	$sql="SELECT * FROM manga";
	$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_assoc($result)){
		$mangapath=$row['directory_path']."/xml/".$row['title'].".xml";
		$authorxml=simplexml_load_file($mangapath);
		if((string)$title!=(string)$authorxml[0]->title){
			if((string)$authorxml[0]->author==(string)$thisauthor){
				array_push($arr_xml,$mangapath);
			}
		}
	}

	echo "<br><br>";
	#same author show
	if(count($arr_xml)!=0){
		echo "<div class = 'same-author'>";
			echo "Other Manga by <b>$thisauthor</b><hr>";
			foreach ($arr_xml as $xmlPath) {
				echo "<div class = 'manga-author'>";
					$thisxml=simplexml_load_file($xmlPath);
					echo "<div class = 'title_author'>";
						echo "<b>{$thisxml[0]->title}</b>";
					echo "</div>";
					echo "<a href=\"mangaProfile.php?title={$thisxml[0]->title}\"><img class = 'cover-author' src=\"{$thisxml[0]->cover}\"></a>";
				echo "</div>";
			}
		echo "</div>";
	}
	
	echo "<br> <br>";
	#show comment
	
	echo "<div class = 'all_comment'>";
		echo "COMMENT <hr>";
		$komen=fopen($comment_path,'r');
		while(!feof($komen)){
			$temp=explode("-",fgets($komen));
			echo "<div class = 'comment'>";
			if($temp[0]!=""){
				echo "<div class = 'name_comment'>";
					echo "<b>" . $temp[0] . "</b>";
				echo "</div>";
				echo $temp[1] . "<hr>";	
			}
			echo " </div>";
		}
	echo "</div>";
 ?>

<!--add to favorite-->
<?php 
	if(isset($_GET['addfav'])){
		$sql="SELECT * FROM reader WHERE username='{$_SESSION['username']}'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		$userid=$row['userid'];
		#$mangaid declared upper

		$sql="SELECT userid,mangaid FROM favorite WHERE userid=$userid and mangaid=$mangaid";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		if(mysqli_num_rows($result)==0){
			$sql="	INSERT INTO favorite(userid,mangaid)
					VALUES ($userid,$mangaid)";
			mysqli_query($conn,$sql) or die(mysqli_error($conn));
		}else{
			echo "<script>window.alert(\"manga has been added to your favorite!\")</script>";
		}
	}

 ?>

 <div class = "add_comment">
 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
 	<?php 
 		if(isset($_SESSION['username'])){
 			echo "<textarea cols=\"100\" rows=\"6\" name=\"komentar\">";
 			echo "enter your comment here!";
 			echo "</textarea> <br>";
		
 			echo "<input type=\"hidden\" name=\"title\" value=\"$title\">";
 			echo "<input class = 'submit_btn' type=\"submit\" name=\"comment\" value=\"POST\">";
 		}
 	 ?>
 </form>
 </div>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
 	<?php 
 		if(isset($_SESSION['username'])){
			echo "<input type=\"hidden\" name=\"title\" value=\"$title\">";
 			echo "<input class = 'favourite' type=\"submit\" name=\"addfav\" value=\"add to favorite\">";
 		}
 	 ?>
 </form>
 </form>