<?php


    session_start();

    if (array_key_exists('task', $_POST) AND array_key_exists('daysremaining', $_POST) AND array_key_exists('taskNum', $_POST)){
        
        include("connection.php");
        
        // the string with the current task number
        $taskNum = $_POST["taskNum"];
        
        $query = "SELECT taskname".taskNum." FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        $row = mysqli_fetch_array(mysqli_query($link, $query));
 
        $tasknameContent = $row['taskname'.$taskNum];
        
        if ($tasknameContent == ""){
            $query = "INSERT INTO `users` (`taskname".$taskNum."`, `duedate".$taskNum."`) VALUES ('".mysqli_real_escape_string($link, $_POST["task"])."', '".mysqli_real_escape_string($link, $_POST["daysremaining"])."')";
             
        } else {
            $query = "UPDATE `users` SET `diary` = '".mysqli_real_escape_string($link, $_POST['content'])."' WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        
        }
        
        mysqli_query($link, $query);
        
    }



?>