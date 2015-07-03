<?php require('../config.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Simple PHP + MySQL + JQuery Ajax demo</title>
 <link rel="stylesheet" type="text/css" href="../ajax-demos-style.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

</head>

<body>
    <h3>Read all posts by author</h3>

    <?php 
    $query = "SELECT * FROM users";
    $result = $db->query($query);
    ?>


    <select class="picker">
    <?php while( $row = $result->fetch_assoc() ){ ?>

        <option value="<?php echo $row['user_id'] ?>">
            <?php echo $row['username'] ?>
        </option>
      
        <?php } ?>
    </select>

    <div id="display-area">Choose a category to view the posts</div>
    


    <script type="text/javascript">

        $(".picker").change(function() { 
            //get the value of the category they clicked
            var user_id = this.value;               
            //create an ajax request to display.php
            $.ajax({   
                type: "GET",
                url: "display.php",  
                data: { 'user_id': user_id },   //send the user id in the request    
                dataType: "html",   //expect html to be returned
              success: function(response){
                $("#display-area").html(response);
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