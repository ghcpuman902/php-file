<?php

$i = 0;
while($_FILES["filesArray"]["size"][$i] > 1){
	echo "<div class='uploaded-file-list'>";
	if ($_FILES["filesArray"]["error"][$i] > 0){
	    echo "Oops...something went wrong.<br>Error Code: " . $_FILES["filesArray"]["error"][$i] . "<br />";
	}else{
		$ctime = date("YmdHis" ,time());
		echo "+&nbsp;<span class='bold'>". $_FILES["filesArray"]["name"][$i] ."</span>&nbsp;(".($_FILES["filesArray"]["size"][$i] / 1024 / 1024) . "MB), Saved As <span class='bold'>http://" . $_SERVER['SERVER_NAME'] . "/else/file/files/". $ctime ."_". $_FILES["filesArray"]["name"][$i] ."</span>";
		move_uploaded_file($_FILES["filesArray"]["tmp_name"][$i], "files/". $ctime."_".$_FILES["filesArray"]["name"][$i]  );
	}
	echo "</div>";
	$i++;
}

// print_r($_FILES);

?>
