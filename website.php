<?php
// website.php -  Thu Apr 11 09:30:18 CDT 2024
// 

require_once "controllers/functions.php";

$id = 0;

if(array_key_exists('id', $_GET)) {
	$id=$_GET['id'];
}

if($id != 0){
	$db_obj = new DbClass();
	$sql  = "SELECT url, title FROM ";
	$sql .= " saved_site ";
	$sql .= " WHERE id=? ";

	$text_info = $db_obj->simpleOneParamRequest($sql, 'i', $id);
	$db_obj->closeDB();
	
	
	$url = $text_info[0]['url'];
	$title = $text_info[0]['title'];
	
} else {
	$url = "";
	$title = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/ >
<title>Edit Quote # <?php echo $id ?></title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="./the_scripts.js"></script>  
</HEAD>
<body>
<header id="dynamic_header" class="page_header">
  <div class="centered">
<?php if($id > 0) : ?>
  <h1>Edit site access for # <?php echo $id ?></h1>
<?php 
// 	showArray($text_info);
?>
<?php else: ?>
  <h1>Enter a new site and url</h1>
<?php endif; ?>
  </div>
</header>
 <article id="wrapper" class="display">
  	<a class="edit_button" href="/random_text_db/">Go Back</a> <br><br>

   <div class="grid_container">
	<div>
	<b>URL:</b> <input class="width_85 <?php if($id>0){echo 'instant_edit_url'} ?>" type=text id="url" name="url" value=<?php echo $url ?> >
   </div>

	<div>
	<b>Title:</b> <input class="width_75 <?php if($id>0){echo 'instant_edit_url'} ?>"  type=text id="title" name="title" value=<?php echo $title ?> >
   </div> 
  </div>
  <div>
<?php if($id=0): ?>
	<button id="add_new_site" value="add_new_site">Deposit</button>
<?php endif; ?>
  </div>
 </article>
</body>
</html>
