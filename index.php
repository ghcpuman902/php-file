<!DOCTYPE html>
<html  lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Search file(s)</title>
	<style type="text/css">
	
		html, body, *{
			margin: 0px;
			padding: 0px;
			font-family: 'Ping Fang', 'Avenir Next', Avenir, HelveticaNeue, 'Helvetica Neue', Helvetica, 'Lucida Grande', 'Lucida Sans Unicode', Arial, sans-serif, 
			'Lantinghei SC', PingHei, 'Heiti SC', 微软正黑体, 'Segoe UI Webfont', 'Microsoft YaHei', MingLiU, PMingLiU,
			'Lantinghei TC', 'Hiragino Kaku Gothic Pro', 'Heiti TC', 微軟正黑體, 'STHeiti Light', 'Microsoft JhengHei';
			font-size: 12px;
		}

		.centerbox{
			margin: 0 auto;
			width: 300px;
		}

		.main-title{
			font-weight: normal;
			font-size: 3em;
			margin: 0.6em 0;
		}

		.inputText{
			display: block;
		    box-sizing: border-box;
	        outline: none;
	        padding: 6px;
	        width: 100%;
	        border: 1px solid #f0f0f0;
	        border-bottom: 2px solid #000;
    		transition: all 200ms;
			-webkit-appearance: none;
			border-radius: 0;
		}
		.inputText:focus{
	        border: 1px solid #d0d0d0;
	        border-bottom: 2px solid #278BD2;
			-webkit-appearance: none;
			border-radius: 0;
		}

		#suggestions{
			display: block;
		    box-sizing: border-box;
			width: 100%;
			border: dashed 2px #000;
			color: #000;
			border-radius: 10px;
    		transition: all 200ms;
			margin-bottom: 1.8em;
			overflow: scroll;
		}

    	#prog{
    		height: 2px;
    		position: absolute;
    		top: 0%;
    		left: 0%;
    		width: 0%;
    		background-color: #fcfcfc;
    		transition: all 200ms;
    		overflow: scroll;
    	}

    	.list-item{
			display: block;
		    box-sizing: border-box;
			padding: 6px;
    		transition: all 100ms;
    	}
    	.list-item:nth-child(even) {
			background-color: #fafafa;
		}
    	.list-item:hover{
			background-color: #000;
			color: #fff;
    	}

    	.list-item-link{
    		text-decoration: none;
    		color: inherit;
    	}

    	.bold{
    		font-weight: 600;
    	}

    	#back{
    		font-size: 1em;
    		text-decoration: underline;
    		color: #278BD2;
			float: left;
			text-align: left;
    	}
    	#back:hover{
    		color: #4B99D1;
    	}
    	#back:active{
    		color: #1C689E;
    	}

    	#upload{
    		font-size: 1em;
    		text-decoration: underline;
    		color: #278BD2;
			float: right;
			text-align: right;
    	}
    	#upload:hover{
    		color: #4B99D1;
    	}
    	#upload:active{
    		color: #1C689E;
    	}


		@media only screen and (min-width: 320px) {
			/* Small screen, non-retina */

			html, body, *{
				font-size: 14px;
			}	
			.centerbox{
				width: 320px;
			}



		}

		@media only screen and (min-width: 700px) {

			/* Large screen, non-retina */

			html, body, *{
				font-size: 20px;
			}
			.centerbox{
				width: 700px;
			}


		}

		@media only screen and (min-width: 1000px) {

			/* Large screen, non-retina */

			html, body, *{
				font-size: 24px;
			}
			.centerbox{
				width: 1000px;
			}

		}

	</style>

    <script src='../js/jquery-2.1.1.js'></script>
	<script>

		function showSuggestions(inputText){
			if( (inputText.value != ".") && (inputText.value != "..") && (inputText.value.length > 2) ){

		        $("#prog").css("width","0%" );
				str = inputText.value;
				$.ajax({
					url: "file_list.php?input="+str,
					xhrFields: {
						onprogress: function (e) {
							if (e.lengthComputable) {
								console.log(e.loaded / e.total * 100 + '%');		
						        $("#prog").css("width",(e.loaded / e.total *100)+"%" );
							}
						}
					},
					success: function (response) {
				        $("#prog").css("width",(1*100)+"%" );
				        $("#suggestions").html(response);
					}
				});	
			}else{
		        $("#suggestions").html(" ");
			}
		}

	</script>
</head>
<body>
	<div id="prog"></div>
	<div class="centerbox">

			<h1 class='main-title'>Search file(s)</h1>
			
			<input class="inputText"  placeholder="type in to search" onkeyup="showSuggestions(this)"><br>	
			<span class='comment'>Results will automatically appear in the box below.</span>
			<div id='suggestions'><br></div>

			<a href="../../" id="back">Go back to MangleKuo.com</a>
			<a href="upload.php" id="upload">⇧ Upload Files</a>

	</div>
</body>
</html>
