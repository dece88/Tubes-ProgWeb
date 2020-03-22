<?php 
	session_start();
	include 'conn.php';
	$title=$_GET['title'];
	$sql="SELECT directory_path FROM manga WHERE title='$title'";

	$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

	#function for creating header per chapter
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
	
	while($row=mysqli_fetch_row($result)){
		$path=$row[0]."/xml/chapters.xml";
		$Data="<chapters>";
		$arr=scandir($row[0]);
		for($i=0;$i<count($arr);++$i){
			$chapterHeader="";
			if($arr[$i]!='.' && $arr[$i]!='..' && $arr[$i]!='cover' && $arr[$i]!='xml' && $arr[$i]!='comment.txt' && $arr[$i]!='info.txt'){
				$chapterpath=$row[0]."/{$arr[$i]}";
				$chapterHeader=intoStr((string)$arr[$i]);
				
				$Data.="<".$chapterHeader.">";
				$tempArr=scandir($chapterpath);
				for($j=0;$j<count($tempArr);++$j){

					if($tempArr[$j]!='.' && $tempArr[$j]!='..'){
						
						$Data.="<pages>";
						$Data.="<path>".$chapterpath."/".$tempArr[$j]."</path>";
						$Data.="</pages>";
					}
				}
				$Data.="</".$chapterHeader.">";
			}
		}
		$Data.="</chapters>";
		
		$newdata=new SimpleXMLElement($Data);
		if(file_exists($path)){
			unlink($path);
		}
		$newdata->asXML($path);

	}
	$_SESSION['recorded']="yes";
	header("location:cobaRead.php?this_path={$_GET['this_path']}&chapter={$_GET['chapter']}&title={$_GET['title']}");

 ?>