<?php require('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Simple PHP + MySQL + JQuery Ajax demo</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

  <style type="text/css">
  body{
    font-family: sans-serif;
  }
  </style>
</head>

<body>
    <h3>Pick a category</h3>

    <?php 
    $query = "SELECT * FROM categories";
    $result = $db->query($query);
    ?>


    <select class="picker">
    <?php while( $row = $result->fetch_assoc() ){ ?>

        <option value="<?php echo $row['category_id'] ?>"><?php echo $row['title'] ?></option>
      
        <?php } ?>
    </select>

    <div id="display-area">Choose a category to view the posts</div>


    <script type="text/javascript">
        $(".picker").change(function() { 
            //get the value of the category they clicked
            var catid = this.value;               
            //create an ajax request to display.php
            $.ajax({   
                type: "GET",
                url: "display.php",  
                data: { 'catid': catid },   //send the category id in the request    
                dataType: "html",   //expect html to be returned
              success: function(response){
                $("#display-area")  .html(response)
                                    .css({'background': '#D0F1C0'});
                    //alert(response);
                }
            });
        });
    </script>
</body>
</html>