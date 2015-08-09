<?php

$path = realpath('./files');
//directory we are going to search for

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename){
	//go through the directory and give filename to $filename
	if( (strripos($filename, $_GET['input'])) && (strlen($_GET['input']) > 2) && (stripos($_GET['input'], "mp4") === false) && (stripos($_GET['input'], ".") === false) ){
		//if (filename contains input string) && (input string length longer than 2 (otherwise it's easy to try each letter one by one) ) && (input string does not contain keywords you don't want e.g. "mp4" or ".")
		$name = str_replace( "/Library/WebServer/Documents/else/file/files/" , "" , $filename );
		$name = str_replace( "/home/ghcpuman902/public_html/else/file/files/" , "" , $name );
		//get rid off the path from the server root directory 
		if($name != "." && $name != ".." && $name != ".DS_Store" && (substr($name, -strlen("/.")) != "/.") && (substr($name, -strlen("/..")) != "/..") ){
			//if result is not "." or ".." or ".DS_Store" or ends with "/." or "/.."
			$pos = strripos($name, $_GET['input']);
			$nameArray = str_split($name);
			echo "<div class='list-item'><a href='./files/".$name."' class='list-item-link'>";
			for($i=0;$i<strlen($name);$i++){
				if($i==$pos){
					//get the matched part and make it bold
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
