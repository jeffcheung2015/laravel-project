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
		var leftBarVisible = false;
		$(document).ready(function(){
			var bannerTimeOutID = window.setInterval(bannerScroll, 4000);


			$(".bannerContainer").hover(function(){
				clearInterval(bannerTimeOutID);
			}, function(){
				bannerTimeOutID = window.setInterval(bannerScroll, 4000);
			});

			$("#leftBarButton").on("click",function(){
				$(".leftSidebar").css({
					"width" : (leftBarVisible) ? "0%" : "100%",
					 "left" : (leftBarVisible) ? "-100%" : "0%"});
				leftBarVisible = !leftBarVisible;
			});

			
			$(".leftArrow").click(function(){				

				$("#banner1").finish();
				$("#banner2").finish();
				$("#banner3").finish();
				$("#banner4").finish();

				scroll("#banner1",$("#banner1").position().left,-1,1000);
				scroll("#banner2",$("#banner2").position().left,-1,1000);
				scroll("#banner3",$("#banner3").position().left,-1,1000);
				scroll("#banner4",$("#banner4").position().left,-1,1000);		
			});

			$(".rightArrow").click(function(){

				$("#banner1").finish();
				$("#banner2").finish();
				$("#banner3").finish();
				$("#banner4").finish();

				scroll("#banner1",$("#banner1").position().left,1,1000);
				scroll("#banner2",$("#banner2").position().left,1,1000);
				scroll("#banner3",$("#banner3").position().left,1,1000);
				scroll("#banner4",$("#banner4").position().left,1,1000);		
			});
		});
		// ==> dir=-1
		// <== dir=+1		
		function scroll (idstr,posLeft,dir,time){
			
			switch(posLeft){
				case -800:				
				if(dir==1){
					$(idstr).css('display','none');
				}	
				$(idstr).animate({'left':(dir == 1) ? 1600 : 0}, time, "swing", function(){
					if(dir==1){
						$(idstr).css('display','inline');
					}
				});			
				break;
				case 0:
				$(idstr).animate({'left':(dir == 1) ? -800 : 800}, time);
				break;
				case 800:
				$(idstr).animate({'left':(dir == 1) ? 0 : 1600}, time);
				break;
				case 1600:
				if(dir==-1){
					$(idstr).css('display','none');
				}
				$(idstr).animate({'left':(dir == 1) ? 800 : -800}, time, "swing", function(){
					if(dir==-1){
						$(idstr).css('display','inline');
					}
				});
				break;
			}
		}
		//banner scroll over time, called every 3s, animation last 2s only
		function bannerScroll(){
			
			scroll("#banner1",$("#banner1").position().left,-1,1000);
			scroll("#banner2",$("#banner2").position().left,-1,1000);
			scroll("#banner3",$("#banner3").position().left,-1,1000);
			scroll("#banner4",$("#banner4").position().left,-1,1000);
			
		}
	</script>
	<title></title>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<div class="navBar">
				<ul>
					<li class="leftList">
						<img class="headerImg" src="img/leftBar.png" id="leftBarButton">
					</li>
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


		<div class="banner">
			<div class="bannerContainer">
				<img class="bannerImg" id="banner1" src="img/banner1.jpg">	
				<img class="bannerImg" id="banner2" src="img/banner2.jpg">	
				<img class="bannerImg" id="banner3" src="img/banner3.jpg">	
				<img class="bannerImg" id="banner4" src="img/banner4.jpg">	
				<input type="image" src="img/left.png" class="leftArrow" onclick=""/>
				<input type="image" src="img/right.png" class="rightArrow" onclick=""/>
			</div>
		</div>


		<div class="gallery">
			<?php  
			$currPage = (Request::path() == '/') ? 1 : intVal(Request::path());			
			?>
			@foreach(App\Image::whereIn('id', range(($currPage-1)*6,$currPage*6))->get() as $img)
				<div class="slot">
				<div class="imgSlot">				
				<img class="galleryImg" src="{{$img->imgAddress}}">
				</div>
				</a>
				<div class="descriptSlot">
				<p class="imgDescript">
				Description: {{$img->description}}
				<br>
				Uploader: {{$img->username}}</p>

				</div>
				</div>
			@endforeach

			<div class="pageBar">
			@if(Request::path() == '/' || Request::path() >= 1)
				<?php 
				$tem = -1;
				switch(Request::path()){
					case '/':
						$tem = 1;
						break;
					default:
						$tem = intVal(Request::path());
						break;
				}
				$start = ($tem < 6) ? 1:$tem-5;
				
				$page = ceil(App\Image::count()/6);
				$end = ($tem < 6) ? min(11,$page): min(($tem+5),$page);

				?>

				@for ($i = $start; $i <= $end; $i++)

					@if($i != $tem)
						<a href="{{url('/').'/'.$i}}">{{$i}}</a>
					@else
						<a href="{{url('/').'/'.$i}}" style="background-color: yellow">{{$i}}</a>
					@endif
				@endfor

			@endif
				
				
			</div>
		</div>

		<div class="leftSidebar">
			<h3>Categories</h3>
			<ul>
				<li class="cateList"><a href="">1234</a></li>
				<li class="cateList"><a href="">1234</a></li>
				<li class="cateList"><a href="">1234</a></li>
				<li class="cateList"><a href="">1234</a></li>
				<li class="cateList"><a href="">1234</a></li>
				<li class="cateList"><a href="">1234</a></li>
				<li class="cateList"><a href="">1234</a></li>
			</ul>
		</div>

		<div class="modal">
			<div class="blackenedArea"></div>
			<div class="modalBody">
				<a href="">
				<img class="modalBodyImg" src="">
				</a>	
			</div>				
		</div>
		<div class="footer">			
		</div>
	</div>
<script>
	$(".slot").on("click", function(e){
		$(".modal").css("display","block");
		$(".modalBodyImg").attr('src',$(this).find(".galleryImg").attr('src'));
		$(".modalBody a").attr('href',$(this).find(".galleryImg").attr('src'));
	});

	$(".blackenedArea").on("click", function(){
		$(".modal").css("display","none");
	});

</script>


</body>
</html>



