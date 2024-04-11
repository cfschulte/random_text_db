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
	$sql  = "SELECT url, title, site_category, cat.descriptor  ";
	$sql .= " FROM saved_site ";
	$sql .= " JOIN site_category AS cat ON cat.id=saved_site.site_category ";
	$sql .= " WHERE saved_site.id=? ";

	$text_info = $db_obj->simpleOneParamRequest($sql, 'i', $id);
	$db_obj->closeDB();
	
	
	$url = $text_info[0]['url'];
	$title = $text_info[0]['title'];
	$site_category = $text_info[0]['site_category'];
	$descriptor = $text_info[0]['descriptor'];
	
} else {
	$url = "";
	$title = "";
	$site_category = 0;
	$descriptor = "";
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
<?php else: ?>
  <h1>Enter a new site and url</h1>
<?php endif; ?>
  </div>
</header>

 <article id="wrapper" class="display">
<?php 
// 	showArray($text_info);
// 	showDebug($id);
?>
  	<a class="edit_button" href="/random_text_db/">Go Back</a> <br><br>

   <div class="grid_container">
	<div class="url-wrap">
	<b>URL:</b> <input class="width_85 <?php if($id>0){echo 'instant_edit_url';} ?>" type=text id="url" name="url" value="<?php echo $url; ?>" >
   </div>

	<div class="title-wrap">
	<b>Title:</b> <input class="width_75 <?php if($id>0){echo 'instant_edit_url';} ?>"  type=text id="title" name="title" value="<?php echo $title ?>" >
   </div> 
	<div class="category-select-wrap">
	<b>Category:</b> <?php echo buildSiteCatSelect($site_category); ?>
   </div> 
	<div class="category-edit-wrap">
	<b>Other:</b> <input class="width_75 <?php if($id>0){echo 'instant_edit_url';} ?>"  type=text id="category_edit" name="category_edit" value="<?php echo $descriptor ?>" >
   </div> 
  </div>
  <div>
<?php if($id==0): ?>
	<button id="add_new_site" value="add_new_site">Deposit</button>
<?php endif; ?>
  </div>
 </article>
</body>
</html>
