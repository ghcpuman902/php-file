<?php
$path = realpath('./files');
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename){
	if( (strripos($filename, $_GET['input'])) && (strlen($_GET['input']) > 2) && (stripos($_GET['input'], "mp4") === false) && (stripos($_GET['input'], ".") === false) ){
		$name = str_replace( "/Library/WebServer/Documents/else/file/files/" , "" , $filename );
		$name = str_replace( "/home/ghcpuman902/public_html/else/file/files/" , "" , $name );
		if($name != "." && $name != ".." && $name != ".DS_Store" && (substr($name, -strlen("/.")) != "/.") && (substr($name, -strlen("/..")) != "/..") ){
			$pos = strripos($name, $_GET['input']);
			$nameArray = str_split($name);
			echo "<div class='list-item'><a href='./files/".$name."' class='list-item-link'>";
			for($i=0;$i<strlen($name);$i++){
				if($i==$pos){
					echo "<span class='bold'>";
				}
				echo $nameArray[$i];
				if($i==($pos + strlen($_GET['input']) -1)){
					echo "</span>";
				}
			}
			echo "</a></div>";
		}
	}
}
?>
