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
      emptyCheck("#lUsername",".loginInput .unameEMsg"," Username is empty!");
      emptyCheck("#lpassword",".loginInput .pwEMsg"," Password is empty!");

      emptyCheck("#rName",".regisInput .nEMsg"," Name is empty!");
      emptyCheck("#rAge",".regisInput .ageEMsg"," Age is empty!");
      emptyCheck("#rEmail",".regisInput .emailEMsg"," Email is empty!");
      emptyCheck("#rUsername",".regisInput .unameEMsg"," Username is empty!");
      emptyCheck("#rPassword",".regisInput .pwEMsg"," Password is empty!");

      restrictKeypress("#rName", "^[a-zA-Z\b]+$");
      restrictKeypress("#rAge", "^[0-9\b]+$");
      restrictKeypress("#rEmail", "^[a-zA-Z0-9@._-\b]+$");
      restrictKeypress("#rUsername", "^[a-zA-Z0-9\b]+$");
      restrictKeypress("#rPassword", "^[a-zA-Z0-9\b]+$");

      $("#rPassword").on("focusout", function(){
        if($("#rPassword").val().length < 8){
         $(".pwEMsg").text(" Password Length should be at least 8.");
       } 
     });
    });

    function emptyCheck(inputCLass, msgCLass, msg){
      $(inputCLass).on("keyup",function(){
        if($(inputCLass).val().length == 0){ $(msgCLass).text(msg);  }
        else{ $(msgCLass).text(""); }   
      });
    }


    function restrictKeypress(inputCLass, regStr){
      $(inputCLass).on('keypress', function (e) {
        var rex = new RegExp(regStr);
        var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (!rex.test(key)) {
         e.preventDefault();
         return false;
       }
     });
    }

    function validateLogin(){
      if($("#lUsername").val() == ""){ return false; }
      if($("#lPassword").val() == ""){ return false; }
    }

    function validateRegister(){
      if($("#rName").val() ==   ""){ return false; }
      if($("#rAge").val() == ""){ return false; }
      if($("#rEmail").val() == ""){ return false; }
      if($("#rUsername").val() == ""){ return false; }
      if($("#rPassword").val().length < 8){ $(".pwEMsg").text(" Password Length should be at least 8."); return false; }
    }

  </script>
  <title></title>
</head>
<body>
  <div class="wrapper-login">
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
            <img class="headerImg" src="img/search.png">
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

    <div class="loginForm">
      <form action="login" method="POST" onsubmit="return validateLogin()">
       {{ csrf_field() }}
       <br>
       <h2>Login</h2>
       <div class="loginInput">
        <p style="color:red" class="unameEMsg"></p>
        <div class="leftBar"><p>USERNAME</p>
        </div>
        <input id="lUsername" class="input" type="text" name="username" placeholder=" Username" required>        
      </div>
      <div class="loginInput">
        <p style="color:red" class="pwEMsg"></p>
        <div class="leftBar"><p>PASSWORD</p>
        </div>
        <input id ="lpassword" class="input" type="password" name="password" placeholder=" Password" required>          
      </div>
      <div class="loginInput">
        <input class="btn" type="submit" value="LOGIN">
      </div>
    </form>
  </div>

  <div class="registerForm">
    <form action="register" method="POST" onsubmit="return validateRegister()">
     {{ csrf_field() }}
     <br>
     <h2>Register</h2>
     <div class="regisInput">
      <p style="color:red" class="nEMsg"></p>
      <div class="leftBar"><p>NAME</p>                
      </div>
      <input id="rName" class="input" type="text" name="name" placeholder=" Name" required>
    </div>
    <div class="regisInput">
      <p style="color:red" class="ageEMsg"></p>
      <div class="leftBar">
        <p>AGE</p>
      </div>
      <input id="rAge" class="input" type="text" name="age" placeholder=" Age" maxlength="3" required>
    </div>
    <div class="regisInput">
      <div class="leftBar"><p>GENDER</p></div>
      <select name="gender">
        <option value="male">male</option>
        <option value="female">female</option>
      </select>
    </div>

    <div class="regisInput">
      <p style="color:red" class="unameEMsg"></p>
      <div class="leftBar"><p>USERNAME</p>
      </div>
      <input id="rUsername" class="input" type="text" name="username" placeholder=" Username" maxlength="20" required>
    </div>
    <div class="regisInput">
      <p style="color:red" class="emailEMsg"></p>
      <div class="leftBar"><p>EMAIL</p>
      </div>
      <input id="rEmail" class="input" type="text" name="email" placeholder=" Email" maxlength="30" required>
    </div>
    <div class="regisInput">
      <p style="color:red" class="pwEMsg"></p>
      <div class="leftBar"><p>PASSWORD</p>
      </div>
      <input id="rPassword" class="input" type="password" name="password" placeholder=" Password" maxlength="20" required>
    </div>
    <div class="regisInput">
      <input class="checkbox" type="checkbox" required>
      <p>I agree the terms and conditions.</p>
    </div>
    <div class="regisInput">
      <input class="btn" type="submit" name="submit" value="REGISTER">
    </div>


  </form>
</div>



<div class="footer"></div>





</div>




</body>
</html>

