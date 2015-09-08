<!DOCTYPE html>
<html  lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Upload file(s)</title>
	<style type="text/css">

		html, body, *{
			margin: 0px;
			padding: 0px;
			font-family: 'Ping Fang', 'Avenir Next', Avenir, HelveticaNeue, 'Helvetica Neue', Helvetica, 'Lucida Grande', 'Lucida Sans Unicode', Arial, sans-serif, 
			'Lantinghei SC', PingHei, 'Heiti SC', 微软正黑体, 'Segoe UI Webfont', 'Microsoft YaHei', MingLiU, PMingLiU,
			'Lantinghei TC', 'Hiragino Kaku Gothic Pro', 'Heiti TC', 微軟正黑體, 'STHeiti Light', 'Microsoft JhengHei';
			font-size: 12px;
		}


		.main-title{
			font-weight: normal;
			font-size: 3em;
			margin: 0.6em 0;
		}

		.centerbox{
			margin: 0 auto;
		}


		#file-form{
			margin: 1.8em 0;
		}

		#file-select-wrapper{
		    position: relative;
		    overflow: hidden;
			display: block;
		    box-sizing: border-box;
			width: 100%;
			height: 450px;
			border: dashed 2px #000;
			border-bottom: none 0px;
			color: #000;
			border-radius: 10px 10px 0px 0px;
			padding: 20px;
    		transition: all 200ms;
		}
		#file-select-wrapper:hover{
			background-color: #f5f5f5;
		}

		#file-select-wrapper input#file-select{
		    position: absolute;
		    width: 100%;
		    height: 100%;
		    top: 0;
		    right: 0;
		    margin: 0;
		    padding: 0;
		    cursor: pointer;
		    opacity: 0;
		    filter: alpha(opacity=0);
		}

		#file-select-wrapper>span{/*
			line-height: 2em;
			text-align: center;*/
		    font-size: 1em;
		    overflow: scroll;
		}

		#upload-button{
			display: block;
		    box-sizing: border-box;
			width: 100%;
			height: 50px;
			background-color: #000;
			color: #fff;
			border: none;
			outline: none;
		    cursor: pointer;
			border-radius: 0px 0px 10px 10px;
    		transition: all 200ms;
		}
		#upload-button:hover{
			background-color: #333;
		}

    	.uploaded-file-list{
			width: 100%;
    	}

    	.bold{
    		font-weight: 600;
    	}

    	#back{
    		font-size: 1em;
			margin: 0.6em 0;
    	}

    	a{
    		text-decoration: underline;
    		color: #278BD2;
    	}
    	a:hover{
    		color: #4B99D1;
    	}
    	a:active{
    		color: #1C689E;
    	}

    	#upload-history{
			margin: 0.6em 0;
			width: 100%;
			overflow: scroll;

    	}

		@media only screen and (min-width: 320px) {
			/* Small screen, non-retina */

			html, body, *{
				font-size: 14px;
			}	
			.centerbox{
				width: 300px;
			}
			#file-select-wrapper{
				height: 260px;
			}
			#upload-button{
				height: 40px;
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
			#file-select-wrapper{
				height: 350px;
			}
			#upload-button{
				height: 50px;
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
			#file-select-wrapper{
				height: 450px;
			}
			#upload-button{
				height: 50px;
			}

		}

	</style>

    <script src='../js/jquery-2.1.1.js'></script>
	<script>
		$(document).ready(function(){
			$("#file-select").change(function(){
				// $("#file-select-text").html($(this).val());    

				$("#file-select-text").html("You have chosen:<br>");
				for (var i = 0; i < $(this).get(0).files.length; ++i) {
					$("#file-select-text").html( $("#file-select-text").html() + $(this).get(0).files[i].name + "<br>");
				}
			});	
			$("#file-form").submit(function(event){
				event.preventDefault();

				$("#upload-button").html("uploading...");

				var fileSelect = document.getElementById('file-select');

				var files = fileSelect.files;

				var formData = new FormData();

				if(files.length > 0){
					for (var i = 0; i < files.length; i++) {
					  var file = files[i];

					  // if (!file.type.match('image.*')) {
					  //   continue;
					  // }
					  console.log(i);

					  // Add the file to the request.
					  formData.append('filesArray[]', file, file.name);
					}
					// console.log(formData);

					var xhr = new XMLHttpRequest();
					xhr.open('POST', 'uploader.php', true);
					xhr.onload = function () {
						if (xhr.status === 200) {
						// File(s) uploaded.
							$("#file-select-text").html("You have uploaded:<br>"+xhr.responseText+"1. Click to upload more");
							$("#upload-history").html($("#upload-history").html()+xhr.responseText+"<br>");
							$("#upload-button").html("2. Start Uploading");
						} else {
							$("#file-select-text").html('An error occurred!');
							$("#upload-button").html('An error occurred!');
						}
					};
					xhr.send(formData);
				}else{
					$("#file-select-text").html('No file was chosen. <br>1. Click here to select files');
					$("#upload-button").html("2. Start Uploading");
				}
			});		
		});


	</script>
</head>
<body>
		<div class="centerbox">

			<h1 class="main-title">Upload file(s)</h1>
			<form id="file-form" action="uploader.php" method="POST">
				<div id="file-select-wrapper">
					<input type="file" id="file-select" name="filesArray[]" multiple/>
				    <span id="file-select-text">1. Click here and choose file(s) to upload</span>
				</div>
			  <button type="submit" id="upload-button">2. Start Uploading</button>
			</form>

			<a id="back" href="./index.php">☜ Go Back to Search</a>
			<div id="upload-history">
				<div class="bold">Upload History</div>
			</div>

		</div>

</body>
</html>
