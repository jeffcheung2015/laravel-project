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
		}
	</script>
	<title></title>
</head>
<body>
	<div class="wrapper-userProfile">
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


		<div class="userProfile">


		</div>



		

	</div>




</body>
</html>



