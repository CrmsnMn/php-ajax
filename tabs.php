<?php require('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Simple PHP + MySQL + JQuery Ajax tabs demo</title>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

  <style type="text/css">
      body{
        font-family: sans-serif;
    }
   
    .tabs{
        margin: 0;
        padding: 0;
    }
    .tab{
        margin: 0 .1em;
        padding: 0;
        padding:.5em;
        border-bottom:none;
        display: inline-block;
        cursor: pointer;
         background: #eee;
    }
    
    .tab-panel{
        background-color: #eee;
        padding:1em;
    }
    .active    {
        background-color: #D0F1C0;
    }
    .loading{
        opacity: .3;
        background: 
                    url('http://i.stack.imgur.com/FhHRx.gif')
                    50% 50% 
                    no-repeat;
    }
    
</style>
</head>

<body>
    <h3>Pick a category</h3>

    <?php 
    $query = "SELECT * FROM categories";
    $result = $db->query($query);
    ?>


    <ul class="tabs">
        <?php while( $row = $result->fetch_assoc() ){ ?>

        <li class="tab" data-catid="<?php echo $row['category_id'] ?>"><?php echo $row['title'] ?></li>

        <?php } ?>
    </ul>

    <div id="display-area" class="tab-panel">Choose a category to view the posts</div>

    <script type="text/javascript">
        $(".tab").click(function() { 

            //get the value of the category they clicked
            var catid = $(this).data("catid"); 

            //reset active tab class
            $('ul > li').removeClass('active'); 
            //apply active tab class
            $(this).addClass('active'); 

            //create an ajax request to display.php
            $.ajax({   
                type: "GET",
                url: "display.php",  
                data: { 'catid': catid },   //send the category id in the request    
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