<?php
/**
 * DISPLAY OUTPUT
 * This file gets loaded by the ajax request
 * It is identical whether using jquery or pure ajax
 * note that it has no doctype and is not intended as a standalone file. 
 */
require('../config.php');

//data coming from jquery .ajax() call
$id = $_REQUEST['user_id'];

//get the posts in that category
$query = "SELECT *
		 FROM posts
		 WHERE posts.is_published = 1
		 AND user_id = $id";
//run it
$result = $db->query($query);

//check
if($result->num_rows >= 1){
	echo $result->num_rows . ' Posts Found';
	echo '<section>';
	while($row = $result->fetch_assoc()){  
	?> 
		<article><h1><?php echo $row['title']  ?></h1> 
			<p><?php echo $row['body'] ?></p>
		</article>
	<?php
	}
	echo '</section>';
}else{
	echo 'Sorry, this author has not written any posts';
}
