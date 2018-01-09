      <script type="text/javascript">
      
        var curTaskNum = 1;
        var taskArrayLocation = 0;
        var taskCounter = 0;
        var maxTasks = 6;
        var curTaskText         = "#task"+curTaskNum+"-text";
        var curTaskElementID    = "#t"+curTaskNum;
        
        var taskArray = [false, false, false, false, false, false];  
        
          
        $(".greeting").animate({opacity:1}, 2000);
        $(".task").draggable({
            drag: function(event, ui){
                var taskNum = $(this).attr("id");
                taskNum = taskNum.toString();
                taskNum = taskNum.substr(1, 2);
                curTaskNum = parseInt(taskNum);
                taskArrayLocation = curTaskNum - 1;
                curTaskText ="#task"+curTaskNum+"-text";
                curTaskElementID = "#t"+curTaskNum;
            }
            
        });
        
       
        $("#garbage-icon").droppable({
            drop: function(event, ui){
                ui.draggable.animate({width:"0px",
                                      height:"0px",
                                     marginLeft: "5%",
                                     marginTop: "5%"},
                                      1000, 
                                      function(){
                                          ui.draggable.fadeOut(400, function(){
                                                taskCounter--;
                                                var taskNum = ui.draggable.attr("id");
                                                taskNum = taskNum.toString();
                                                taskNum = taskNum.substr(1, 2);
                                                window.location="loggedinpage.php?delete="+taskNum;
                                               
                                      });
                                        
                });
                
                
            }
        });
        
            
        $("#garbage-icon").droppable({
            activate: function(event, ui){
                $("#garbage-icon").css("border-color","yellow");
            }  
        });    
        $("#garbage-icon").droppable({
            deactivate: function(event, ui){
                $("#garbage-icon").css("border-color","black");
            }  
        });   
         
          
        
      </script> 
     
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
      
      
      
      
      




