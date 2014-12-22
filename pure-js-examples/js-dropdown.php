<?php require '../config.php'; ?>
<!doctype html>
<html>
<head>
	<title>Filter by category using AJAX</title>
    <link rel="stylesheet" type="text/css" href="../ajax-demos-style.css">

</head>
<body>
  <h1>Simple Dropdown AJAX request </h1>
  <h2>with just JavaScript, PHP, mySQL</h2>

 

    <?php 
	//SELECT dropdown interface 
	//get all categories, show in a dropdown
    $query = "SELECT * FROM categories";
    $result = $db->query($query);
    ?>
    <select name="category" onchange="showPosts(this.value)">
      <option value="">Select a category:</option>
      <?php while($row = $result->fetch_assoc()){ ?>
      <option value="<?php echo $row['category_id'] ?>"><?php echo $row['title'] ?></option>
      <?php } ?>

  </select>

<br>
<div id="display-area">Posts in this category will appear here</div>

<script type="text/javascript">
/**
 * Creates a new AJAX request, sends a category ID to getposts.php 
 * @param  {int} cat category ID to get posts for
 */
 function showPosts(cat) {
    //if category is blank, do nothing
    if (cat == "") {
      return;
  } else { 
      if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("display-area").innerHTML = xmlhttp.responseText;
          }
      }
      xmlhttp.open("GET","display.php?cat_id="+cat,true);
      xmlhttp.send();
  }
}
</script>

</body>
</html>