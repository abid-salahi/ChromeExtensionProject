<?php
	session_start();
	$errormsg = "";

	if(array_key_exists("logout", $_GET)){
        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
      	setcookie("username", "", time() - 60*60);
      	setcookie("password", "", time() - 60*60);
        $_COOKIE["id"] = "";
        $_COOKIE["username"] = "";
      	$_COOKIE["password"] = "";
        header("Location: index.php");
        
    }else{
    
      if(!array_key_exists("id", $_COOKIE)){
          $link = mysqli_connect("shareddb-g.hosting.stackcp.net", "users-data-3237a59e", "abidandpengareawesome123", "users-data-3237a59e");

          if (mysqli_connect_error()){
             die ("There was an error connecting to the database");
          } 

          if (array_key_exists('user', $_POST) OR array_key_exists('rememberMeCheckBox', $_POST) OR array_key_exists('password', $_POST)){
              $query = "SELECT * FROM users WHERE email = '" .mysqli_real_escape_string($link, $_POST["user"])."' LIMIT 1";

              if($result = mysqli_query($link, $query)){                 //If email is found
                  $row=mysqli_fetch_array($result);
                  $hashedpassword = md5(md5($row["id"]).$_POST["password"]);
                  if($row["password"] != $hashedpassword){            //Password DOES NOT match
                      $errormsg .= "Incorrect password!";
                  }
                  else{                                               //Password match
                      if(array_key_exists("rememberMeCheckBox", $_POST)){            //Remember Info
                          setcookie("id", $row["id"],time()+60*60*24*365);
                          setcookie("username", $row["username"],time()+60*60*24*365);
                          setcookie("password", $row["password"],time()+60*60*24*365);

                      }
                      $_SESSION["username"] = $row["username"];
                      $_SESSION["password"] = $row["password"];
                      $_SESSION["id"]       = $row["id"];
                      header("Location: loggedinpage.php");
                  }

              }else{                                                    //If email is not found
                  $errormsg .= "User does not exist!";

              }

          }

      }else{
          header("Location: loggedinpage.php");
      }
        

    }

  
?>

<!doctype html>
<html lang="en">
  <head>
      
      
      
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="jquery-3.2.1.min.js"></script>
    <script src="jquery-ui.js"></script>
    <link rel="stylesheet" href="jquery-ui.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <title>Penabela Assignment Tracker 1.0</title>
   

    <style>
      
        
      
        body{
            margin:0;
            padding:0;
            background-color: white;
        }
        
        
        
       
        #search-img1{
            position:relative;
            top:5px;
           
            height: 17px;
           
        }
        
        #user-icon{
            width: 25px;
            float:left;
            position:relative;
            top:30px;
            left:-5px;
            
            
        }

        .background-wrap{
            position:fixed;
            z-index:-1000;
            width:100%;
            height:100%;
            overflow:hidden;
            top=0;
            left:0;
            opacity: 0;
        }
      
          #logo{
              width: 100px;
              margin-left: 0;
              transform: translate(-20%, 0%);
          }
        
        #usernameDiv{
            margin-bottom: 5%;
        }
        
        .userPassLabel {
            margin-right: 3%;
        }
        
        #loginButton{
            margin-top: 3%;
        }
        
        #rememberMeCheckMBox{
            transform: translate(50%, 55%);
        }
        
       #add-button {
          position: fixed;
          bottom: 5%;
          right: 3%;
          border-radius: 50%;
        }
         .greeting{
            font-family: 'Dancing Script', cursive;
            position: relative;
            top: 200px;
            font-size: 200%;
            color:black;
            opacity: 0;
        }
        
        #search-bar{
            background-color: lightgrey;
            font-size:15px;
            padding-right: 25%;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left:3px;
            opacity: 0.5;
            border-radius: 10%;
            
        }
        #search-bar:hover{
            background-color: lightgrey;
            font-size:15px;
            padding-right: 25%;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left:3px;
            opacity: 1;
            border-radius: 10%;
            border-color: grey;
            border-style: solid;
        }
        
      .task{
            background-color: black;
            width:150px;
            height:150px;
            border-radius: 50%;
            border-width: thick;
            z-index: 1;
            float:left;
            border-style:groove;
            border-color: white;
            display: none;
        }
        .task-text{
            font-family:fantasy;
            margin-top: 35%;
            text-align: center;
            font-size: 150%;
            color: white;
           
        
        }
        #garbage-icon{
            float:right;
            margin: 5%;
            border-color:black;
            border-radius: 50%;
            border-style: solid;
            padding:1%;
            width: 6%;
        }
      
      </style>
      
      <script type="text/javascript">
        function start(){
            startTime();
            
        }
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML =
            h + ":" + m + ":" + s;
            document.getElementById('greeting-text').innerHTML = checkText(h);
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        function checkText(j){
            
            if(j>=0 && j<12){
                    return "Good Morning, there";
                }
                else if(j>=12 && j<18){
                    return "Good Afternoon, there" ;
                }
                else if(j>=18 && j<21){
                    return "Good Evening, there" ;
                }
                else{
                    return "Good Night, there" ;
                }
        }
        
        
       
</script>
      
<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
  </head>
  <body onload="start()">
   
              <nav class="navbar navbar-expand-sm navbar-light">
                   <a class="navbar-brand"><img id="logo" src="icon.png"> <!-- color of backgroun#F8F9FA --></a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                        <a class="nav-link" href="#">Science</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Engineering</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Business</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Forestry</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Land and Food Sciences</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Kinesiology</a>
                      </li>
                      <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              More
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="#">Bla</a>
                              <a class="dropdown-item" href="#">Another Bla</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">Maybe more bla</a>
                            </div>
                     </li>
                    </ul>

                        <h3><?php
                            
                            
                            echo $errormsg;
                        
                            ?></h3>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                          Sign in
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Hey there!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="post">
                                      <div class="form-group" id="usernameDiv">
                                        <label for="userName" class="userPassLabel">Email</label>
                                        <input name="user" type="text" class="form-control" id="userName" aria-describedby="emailHelp" placeholder="Enter Your email address">
                                      </div>
                                      <div class="form-group">
                                        <label for="password" class="userPassLabel">Password</label>
                                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                                      </div>
                                      <div class="form-check">
                                        <input type="checkbox" name="rememberMeCheckBox" class="form-check-input" id="rememberMeCheckBox">
                                        <label class="form-check-label" for="exampleCheck1">Remember me!</label>
                                      </div>
                                      <button type="submit" class="btn btn-primary" id="loginButton">Login</button>
                               </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      <a class="nav-link" href="createaccount.php">Create Account</a>
                      <a class="nav-link" href="#">About Us</a>
                  </div>
          </nav>
        

      
      
      <center class="greeting">
            <h3><div id="txt"></div></h3>
            
            <h1 id="greeting-text"></h1>
            
            <form method="get" action="http://www.google.com/search">
                    <input type="text" name = "q" id="search-bar" placeholder="Google Search">
                    <input type="image" name = "sitesearch" value = "" id="search-img1" src="search.png" >
            </form>
        </center>

       
      
      
      
      

     
      
      <script type="text/javascript">
      
        
        $(".greeting").animate({opacity:1}, 2000);
        
      </script> 
     
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
      
      
      
      
      
  </body>
</html>













