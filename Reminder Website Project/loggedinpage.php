<?php
    
    session_start();
    
    $displaytype = "none";     
    $error = "";
    $link = mysqli_connect("shareddb-g.hosting.stackcp.net", "users-data-3237a59e", "abidandpengareawesome123", "users-data-3237a59e");

    if (mysqli_connect_error()){
        die ("There was an error connecting to the database");
    } 


    $logintype = "";
    

    if(array_key_exists('id', $_SESSION)){
        $logintype = $_SESSION['id'];
    }else{
        $logintype = $_COOKIE['id'];
        
    }



    $query = "SELECT * FROM users WHERE id = '".$logintype."' LIMIT 1";
    //Always want to select the user first no matter the case
    $result1 = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result1);
    

    $task1 = $row['taskname1'];
    $duedate1 = convertDueDate($row['duedate1']);
    $task2 = $row['taskname2'];
    $duedate2 = convertDueDate($row['duedate2']);
    $task3 = $row['taskname3'];
    $duedate3 = convertDueDate($row['duedate3']);
    $task4 = $row['taskname4'];
    $duedate4 = convertDueDate($row['duedate4']);
    $task5 = $row['taskname5'];
    $duedate5 = convertDueDate($row['duedate5']);
    $task6 = $row['taskname6'];
    $duedate6 = convertDueDate($row['duedate6']);
    
    


    //DELETE TASK
    if(array_key_exists('delete', $_GET)){
        $deletetask = "UPDATE users SET taskname".$_GET['delete']."= '', duedate".$_GET['delete']."= '' WHERE id ='".$logintype."' LIMIT 1";
        
        if(mysqli_query($link, $deletetask)){
            header("Location: loggedinpage.php");
        }
        
    }

    
    //ADD TASK
    if (array_key_exists('input_asstitle', $_POST) OR array_key_exists('date-input', $_POST)){ //if POST variables exist i.e user has entered data
        
        if ($_POST["input_asstitle"] == ""){
            $error .= "<p>Please give your task a name!</p>";
        } 
        if ($_POST["date-input"] == ""){
            $error .= "<p>Please choose a date!</p>";
        } 
        if(checkAvailable()==0){
            $error .= "<p>You have reached the maximum number of task reminders allowed!";
        }
        if($error == ""){ //if POST variables valid
            
            if ($result = mysqli_query($link, $query)){ //Get ALL of user
                
                $query = "UPDATE `users` SET taskname".checkAvailable()."='" .mysqli_real_escape_string($link, $_POST["input_asstitle"])."', duedate".checkAvailable()." = '".mysqli_real_escape_string($link, $_POST["date-input"])."' WHERE id ='".$logintype."' LIMIT 1"; // Add taskname and duedate
                
                if (!mysqli_query($link, $query)){
                    $error .= "<p>There was a problem signing you up. Please try again later!</p>";
                    
                } else { //If Add success
                   header("Location: loggedinpage.php");
                }
            }
        }
        
        
    }

    // check if date is available in data base and convert it to days
    function convertDueDate($dateInput){
        $curTimeVancouver = time() - 8*60*60;
        $dueDateTime = strtotime($dateInput);    
        return round(abs($dueDateTime - $curTimeVancouver)/(60* 60 *24)) + 1;
    }
    //Check which is available
    function checkAvailable(){
        global $link;
        global $query ;
        global $result1;
        global $row;
        $index = 1;
        $curTask = "";
        while($index<7){
            
            $curTask = $row["taskname"."$index"];
            
           
            //Check if task slot available
            if($curTask==""){//If available
                return $index;
            }
            else{
                $index++;
                if($index>=7){
                    return 0;
                } 
            }
  
        }
  
    }

    
?>


<?php
include("header.php");
?>
<body onload="start()">
   
              <nav class="navbar navbar-expand-sm navbar-light">
                   <a class="navbar-brand"><img id="logo" src="icon.png"> <!-- color of backgroun#F8F9FA --></a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                        <a class="nav-link" href="https://www.sciencenews.org/">Science</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="https://www.sciencedaily.com/news/matter_energy/engineering/">Engineering</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="http://money.cnn.com/news/">Business</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" href="https://www.sciencedaily.com/news/earth_climate/forests/">Forestry</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" href="https://www.sciencedaily.com/news/plants_animals/food/">Land and Food Sciences</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="https://www.news-medical.net/?tag=/Kinesiology">Kinesiology</a>
                      </li>
                      <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              More
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="http://money.cnn.com/technology/">Technology</a>
                              <a class="dropdown-item" href="http://www.cnn.com/entertainment">Entertainment</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="http://www.cnn.com/politics">Politics</a>
                            </div>
                     </li>
                    </ul>
                    <div class="pull-xs-right">
                        <a href ='index.php?logout=1'>
                        <button type="submit" class="btn btn-primary" id="logoutButton" name="logoutSubmit">Log out</button>
                        </a>
                    
                      </div>
                  </div>
            </nav>
        

      
      
      <center class="greeting">
            <h3><div id="txt"></div></h3>
            
            <h1 id="greeting-text"></h1>
            <h1><?php
                    if(array_key_exists('username', $_COOKIE)){
                        echo $_COOKIE["username"];
                    }
                    else if(array_key_exists("username", $_SESSION)){
                        echo $_SESSION["username"];
                    }
                    else{
                        echo "there";
                    }

              ?></h1>
        	
            <form method="get" action="http://www.google.com/search">
                    <input type="text" name = "q" id="search-bar" placeholder="Google Search">
                    <input type="image" name = "sitesearch" value = "" id="search-img1" src="search.png" >
            </form>
        </center>

       
      
      
<!-- Garbage bin -->
        <img src = "garbagebin-icon.png" id = "garbage-icon">
        
      
      
      
      
      <!-- Button trigger modal -->
<button id="add-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  <p>Click me <br> to create <br> reminder!</p>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Task reminder!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
    <!-- form -->
          
        <form method="post">
            <div class='form-group'>
                <label for='input_asstitle' id='ass-text' >Task:</label>
                <input type = 'text' name = 'input_asstitle' id ='input_asstitle' style='margin-left: 10%;'>    
            </div>
            <div class='form-group'>
                <label for='date-input' id='due-date-text' style="margin-right: 2%;">Due Date:</label>
                <input type='date' name = 'date-input' id='date-input' >
            </div>
            <input type = 'submit' name = "submit-button" value = 'Add' id='submit-button' style='margin-left: 40%;'>
        </form>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
      
    
      
    <div id = "alltasks" style="margin-top: 20%;">
            
            <div class="task" id = "t1"><p class="task-text" id="task1-text"><?php
                if($task1!=""){
                   echo $task1."<br>".$duedate1; 
                }
                
                ?></p></div>
        
            <div class="task" id = "t2"><p class="task-text" id="task2-text">
                <?php
                if($task2!=""){
                echo $task2."<br>".$duedate2;
                }
                ?></p></div>
        
            <div class="task" id = "t3"><p class="task-text" id="task3-text"><?php
                if($task3!=""){
                echo $task3."<br>".$duedate3;
                }
                ?></p></div>
        
            <div class="task" id = "t4"><p class="task-text" id="task4-text"><?php
                if($task4!=""){
                echo $task4."<br>".$duedate4;
                }
                ?></p></div>
        
            <div class="task" id = "t5"><p class="task-text" id="task5-text"><?php
                if($task5!=""){
                echo $task5."<br>".$duedate5;
                }
                ?></p></div>
        
            <div class="task" id = "t6"><p class="task-text" id="task6-text"><?php
                if($task6!=""){
                echo $task6."<br>".$duedate6;
                }
                ?></p></div>
        
    </div>
   
      
      
<?php
include("footer.php");      
?>





