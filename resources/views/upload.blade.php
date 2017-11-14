<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- My stylesheet -->
	<link rel="stylesheet" type="text/css" href="css/styleGallery.css">
	
	<script>
		$(document).ready(function(){

			$("#imgUpload").on("change", function()
			{
				var reader = new FileReader();
				reader.addEventListener("load", function(e){
					$('#previewImg').attr('src', e.target.result);
				});
				reader.readAsDataURL(this.files[0]);
				
			});

		});

		function validateUpload(){
			if($("#imgUpload").val() == ""){ return false }
			if($("#imgD").val() == ""){ return false }
		}
	</script>
	<title></title>
</head>
<body>
	<div class="wrapper-fileu">
		<div class="header">
			<div class="navBar">
				<ul>
					
					<li class="leftList">
						<img class="headerImg" src="img/home.png">
						<a href="/">HOME</a>
					</li>						
					<li class="leftList">
						<img class="headerImg" src="img/Contact.png">
						<a href="/contact">CONTACT</a>						
					</li>
					<li class="leftList">
						<img class="headerImg"  src="img/search.png">
						<input class="search" type="search" name="">
					</li>
					@if(!Session::has('username'))
						<li class="rightList">
						<img class="headerImg" src="img/login.png">	
						<a href="loginRegis">LOGIN/REGISTER</a>
						</li>	
					@else						
			            <li class="rightList">            
			              <a href="accountSetting">Welcome,{{ Session::get('username') }}</a>
			            </li>
						<li class="rightList">
						<img class="headerImg" src="img/logout.png">	
						<a href="logout">LOGOUT</a>
						</li>
						<li class="rightList">
						<div class="menuBar">		
						<img class="headerImg" class="menuImg" src="img/menu.png">					
						<div class="dropDown">								
						<a href="accountSetting">ACCOUNT SETTING<img class="headerImg" src="img/user.png"></a>
						<a href="upload">UPLOAD<img class="headerImg" src="img/login.png"></a>	
						</div>
						</div>
						</li>
					@endif			
				</ul>
			</div>			
		</div>

		<div class="uploadForm">
			<h2>Upload image:</h2><br>
			<div class="imgSlot">
				<img class="footerImg" src="" id="previewImg">
			</div>
			<form action="fileUpload" enctype="multipart/form-data" method="post" onsubmit="return validateUpload()">
				{{ csrf_field() }}
				<input type="file" name="fileToUpload" id="imgUpload" required><br>
				<input type="text" name="imgDescript" id="imgD" placeholder="Image Description" required><br>
				<button type="submit" submit="test.html" name="submit">upload</button>
			</form>
		</div>




		<div class="footer">
			
		</div>

	</div>




</body>
</html>



