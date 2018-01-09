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
        
        #emailDiv{
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
            top: 165px;
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
            width:200px;
            height:200px;
            border-radius: 50%;
            border-width: thick;
            z-index: 1;
            float:left;
            border-style:groove;
            border-color: white;
            display: none;
        }
        #t1{
            display: <?php 
                        
                        if($task1!=""){
                            echo "block"; 
                        }
                
                     ?>
        }
        #t2{
            display: <?php 
                        
                        if($task2!=""){
                            echo "block"; 
                        }
                
                     ?>
        }
        #t3{
            display: <?php 
                        
                        if($task3!=""){
                            echo "block"; 
                        }
                
                     ?>
        }
        #t4{
            display: <?php 
                        
                        if($task4!=""){
                            echo "block"; 
                        }
                
                     ?>
        }
        #t5{
            display: <?php 
                        
                        if($task5!=""){
                            echo "block"; 
                        }
                
                     ?>
        }
        #t6{
            display: <?php 
                        
                        if($task6!=""){
                            echo "block"; 
                        }
                
                     ?>
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
            document.getElementById('greeting-text').innerHTML = checkText(h, name);
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        function checkText(j){
            
            if(j>=0 && j<12){
                    return "Good Morning, ";
                }
                else if(j>=12 && j<18){
                    return "Good Afternoon, ";
                }
                else if(j>=18 && j<21){
                    return "Good Evening, ";
                }
                else{
                    return "Good Night, ";
                }
        }
        
        
       
</script>
      
<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
  </head>