<?php
    session_start();
    $successMsg = "";
    $error = "";
    $link = mysqli_connect("shareddb-g.hosting.stackcp.net", "users-data-3237a59e", "abidandpengareawesome123", "users-data-3237a59e");
    
    
    
    if (mysqli_connect_error()){
       die ("There was an error connecting to the database");
    } 

    if (array_key_exists('email', $_POST) OR array_key_exists('user-name', $_POST) OR array_key_exists('password', $_POST) OR array_key_exists('password-confirm', $_POST)){
        
        if ($_POST["email"] == "" || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $error .= "<p>Email is invalid.</p>";
        } 
        if ($_POST["user-name"] == ""){
            $error .= "<p>Username is invalid.</p>";
        } 
        if($_POST["password"] == "") {
            $error .= "<p>Password is invalid.</p>";
        }
        if($_POST["password"] != $_POST["password-confirm"]){
            $error .= "<p>Passwords do not match!</p>";
        }
        
        if($error == ""){
            
            $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST["email"])."'";
            $result = mysqli_query($link, $query);
            
            if (mysqli_num_rows($result) != 0){
                $error .= "<p>That Email has already been taken.</p>";
            } else {
                $query = "INSERT INTO `users` (`email`, `username`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST["email"])."', '".mysqli_real_escape_string($link, $_POST["user-name"])."', '".mysqli_real_escape_string($link, $_POST["password"])."')";
                
                if (!mysqli_query($link, $query)){
                    $error .= "<p>There was a problem signing you up. Please try again later!</p>";
                    
                } else {
                    $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                    mysqli_query($link, $query);
                    
                    $_SESSION["username"] = $_POST["user-name"];
                    $_SESSION["id"] = mysqli_insert_id($link);
                    $_SESSION["password"] = $_POST["password"];
                    $successMsg .= "You have been signed up!";
                    header("Location: loggedinpage.php");
                }
            }
        }
        
        
    }


   
    
    
    
?>



<html>
<head>
    <title>Penabela Create Account</title>
    
    <script src = "jquery-3.2.1.min.js"></script>
    <style type = "text/css">
      #logo{
            width: 20%;
            margin: 0px auto;
            
            
        }
      #welcome-text{
         font-family:fantasy;
         font-weight: 1;
         color:black;

      }

      #sign-up{
          position:relative;
          top: 25px;;
          background-color: #EFEFEF;
          width: 20%;
          height: 25%;
          border-radius: 10%;
          border-style:groove;
          border-width: thin;
          border-color: darkgrey;


      }
      #create-account-text{
          float:left;
          margin-left:5%;
          margin-top: 3%;
          font-family:fantasy;
          font-size-adjust: auto;

      }
      #create-account-form{
          clear:both;
          float:left;
          margin-left:5%;
          margin-top: 3%; 
      }
      .label-text{
          font-family: fantasy;
          float:left;
      }
      #email{
          border-radius: 10%;
          border-style: solid;
          border-color: lightgray;
      }
      .input-bar{
          float:right;
          margin-left:20px;
          width:50%;
          border-radius: 10%;
          border-style: solid;
          border-color: lightgray;
      }
      .input-field{
          padding-bottom: 10px;
      }
      #input-submit{
          margin-top:40px;
          margin-left: 50%;
          float: left;
      }
      #return-img{
          position: relative;
          margin-top:6.5%;
          left: 15%;
          width:8%;


      }
      #input-submit{
          position: relative;
          left: -3%;
          width:10%;
          margin-top: 5%;



      }
      #error-field{
          color:red;
      }

  </style>
      
      
    
    
</head>
    
    
    
<body>
    <center>
    <img src = "icon.png" id = "logo">
    <h1 id = "welcome-text">Welcome Aboard!</h1>
        
    <p id = "error-field"><?php
        
            echo $error;
            echo $successMsg;
        ?></p>
        
        
    <div id = "sign-up">
        
        <p id="create-account-text">Create Account</p>
        
        
        
        <form method="post" id = "create-account-form">
            
            <div class = "input-field">
            <label for ="email" class="label-text">Email</label>
            <input type = "text" name = "email" id = "email" class="input-bar" placeholder = "e.g. user-name@yahoo.com">
            <br>
            </div>
            
            <div class = "input-field">
            <label for ="user-name" class="label-text">Username</label>
            <input type = "text" name = "user-name" id = "user-name" class="input-bar" placeholder = "e.g. Penabela2017">
            <br>    
            </div>
            
            <div class = "input-field">
            <label for ="password" class="label-text">Password</label>
            <input type = "password" name = "password" id = "password" class="input-bar" placeholder = "Must be at least 6 characters long!">
            <br>     
            </div>
            
            <div class = "input-field">
            <label for ="password-confirm" class="label-text">Re-enter Passowrd</label>
            <input type = "password" name = "password-confirm" id = "password-confirm" class="input-bar" placeholder = "Must be at least 6 characters long">   
            </div>
            
            <input type = "image" name="submit" src = "submit-icon.png" id = "input-submit">
            <a href = "index.php"><img src = "return-icon.png" id= "return-img"></a>
        </form>
            
           

    </div>   

    </center>
    
    
    
</body>

</html>
