<?php 
	session_start();

	include 'conn.php';

	$sql="SELECT * FROM manga WHERE title='{$_GET['title']}'";

	$query=mysqli_query($conn,$sql) or die(mysqli_error($conn));

	while($row=mysqli_fetch_assoc($query)){
		$path=$row['directory_path']."/xml";
		
		$id=$row['idmanga'];
		$title=$row['title'];
		$status=$row['status'];
		$counter=$row['counter'];
		
		

		$Data="<manga>";
		$Data.="<id>".$id."</id>";
		$Data.="<title>".$title."</title>";
		$Data.="<status>".$status."</status>";
		$Data.="<counter>".$counter."</counter>";
		$Data.="<cover>".$row['directory_path']."/cover/cover.jpg"."</cover>";

		#take author name
		$arr=scandir($row['directory_path']);
		foreach ($arr as $entry) {
			if($entry=="info.txt"){
				$file=fopen($row['directory_path']."/$entry",'r');
				while(!feof($file)){
					$temp=explode("-",fgets($file));
					if($temp[0]=="Author"){
						$Data.="<author>".$temp[1]."</author>";
					}
					if($temp[0]=="Genre"){
						$Data.="<genre>".$temp[1]."</genre></manga>";
					}
				}
			}
		}


		#add to XML
		$x=new SimpleXMLElement($Data);
		$path.="/$title.xml";
		if(file_exists($path)){
			unlink($path);
		}
		$x->asXML($path);
	}
	
	header("location:convertChapterToXML.php?this_path={$_GET['this_path']}&chapter={$_GET['chapter']}&title={$_GET['title']}");

 ?>