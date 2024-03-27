<?php
// EditText.php -  Tue Jan 2 13:32:04 CST 2024
// 
require_once "functions.php";

$id = 0;

if(array_key_exists('id', $_GET)) {
	$id=$_GET['id'];
}

if($id != 0){
	$db_obj = new DbClass();
	$sql  = "SELECT tb.text_block, tb.text_source, tb.char_count, ts.descriptor FROM ";
	$sql .= " text_block AS tb ";
	$sql .= " JOIN text_source AS ts ON tb.text_source=ts.id ";
	$sql .= " WHERE tb.id=? ";

	$text_info = $db_obj->simpleOneParamRequest($sql, 'i', $id);
	$db_obj->closeDB();
	
	
	$source_id = $text_info[0]['text_source'];
	$text_block = $text_info[0]['text_block'];
	
} else {
	$source_id = 0;
	$text_block = "";
}
	
?>
<!DOCTYPE html>
<html lang="en">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/ >
<title>Create or edit a block of text</title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="./the_scripts.js"></script>  
</HEAD>
<body>

<header id="dynamic_header" class="page_header">
  <div class="centered">
  <h1>Create or edit a block of text</h1>
  </div>
</header>
 <article id="wrapper" class="display width_80">
    <form id="generic_edit_form" method="POST">
     <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
     <input type="hidden" id="char_count" name="char_count" value="<?php echo $char_count ?>">

 <div class="flex_container">
 	<div class="flex_item">
 		<a class="edit_button" href="/random_text_db">Back to the list</a>
 	</div>
 	<div class="flex_item">
 		<?php if($id != 0): ?>
 		  <a class="edit_button" href="/random_text_db/EditText.php">New entry</a>
 		<?php else: ?>
 		  <input id="submit_button" type="submit" >
 		<?php endif ?>
 	</div>
 	<div class="flex_item">
 		<a class="edit_button" href="/random_text_db/EditSource.php">New Source</a>
 	</div>
 </div>
 <div class="flex_container">
 	<div class="flex_item_6em">
 		<a class="edit_button" href="/random_text_db/EditSource.php?id='$source_id'">New Source</a>
 	</div>
 	<div class="flex_item_90">
 		<textarea id="text_block" name="text_block"  ><?php echo $text_block ?></textarea>
 	</div>
 </div>
<?php 
// 	showArray($text_info);
?>
 </form>
 </article>
</body>
</html>
