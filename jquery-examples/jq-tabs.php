<?php require('../config.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Simple PHP + MySQL + JQuery Ajax tabs demo</title>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

 <link rel="stylesheet" type="text/css" href="../ajax-demos-style.css">
</head>

<body>
    <h3>Pick a category</h3>

    <?php 
    $query = "SELECT * FROM users";
    $result = $db->query($query);
    ?>


    <ul class="tabs">
        <?php while( $row = $result->fetch_assoc() ){ ?>

        <li class="tab" data-user="<?php echo $row['user_id'] ?>"><?php echo $row['username'] ?></li>

        <?php } ?>
    </ul>

    <div id="display-area" class="tab-panel">Choose a category to view the posts</div>

    <script type="text/javascript">
        $(".tab").click(function() { 

            //get the value of the category they clicked
            var user_id = $(this).data("user"); 

            //reset active tab class
            $('ul > li').removeClass('active'); 
            //apply active tab class
            $(this).addClass('active'); 

            //create an ajax request to display.php
            $.ajax({   
                type: "GET",
                url: "display.php",  
                data: { 'user_id': user_id },   //send the user id in the request    
                dataType: "html",   //expect html to be returned
                success: function(response){
                    $("#display-area")  .html(response)
                    .addClass('active');
                    //alert(response);
                }
            });
        });
        //do stuff during and after ajax is loading (like visual feedback)
        $(document).on({
            ajaxStart: function() { $("#display-area").addClass("loading");    },
            ajaxStop: function() { $("#display-area").removeClass("loading"); }    
        });
    </script>
</body>
</html>