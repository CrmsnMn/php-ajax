<?php
//connect to DB
require('config.php');


//data coming from jquery .ajax() call on demo.php
$id = $_REQUEST['catid'];

//get the posts in that category
$query = "SELECT posts.title , posts.body, categories.title AS category
		 FROM posts, categories, post_cats 
		 WHERE posts.post_id = post_cats.post_id
		 AND categories.category_id = post_cats.category_id
		 AND categories.category_id = $id";
//run it
$result = $db->query($query);


if($result->num_rows >= 1){
	echo $result->num_rows . ' Posts Found';
	echo '<ul>';
	while($row = $result->fetch_assoc()){  
	?> 
		<li><b><?php echo $row['title']  ?></b> - <?php echo $row['body'] ?></li>
		<?php
	}
	echo '</ul>';
}else{
	echo 'Sorry, no posts in that category';
}
