<?php
$path = realpath('./files');
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename){
	$name = str_replace( "/Library/WebServer/Documents/else/file/files/" , "" , $filename );
	$name = str_replace( "/home/ghcpuman902/public_html/else/file/files/" , "" , $name );
	// Get rid of the front part of absolute path
	if( strripos($name, $_GET['input']) === 0 || strripos($name, $_GET['input']) > 0 || ($_GET['input'] == "825") ){
		// If path has the input string
		if($name != "." && $name != ".." && $name != ".DS_Store" && (substr($name, -strlen("/.")) != "/.") && (substr($name, -strlen("/..")) != "/..") ){
			//We don't want folders and system hidden file to be shown
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
