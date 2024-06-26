<?php
// EditText.php -  Tue Jan 2 13:32:04 CST 2024
// 
require_once "controllers/functions.php";

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
	$source_text = $text_info[0]['descriptor'];
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
<title>Edit Quote # <?php echo $id ?></title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="./the_scripts.js"></script>  
</HEAD>
<body>
<header id="dynamic_header" class="page_header">
  <div class="centered">
  <h1>Edit Quote # <?php echo $id ?></h1>
  </div>
</header>
 <article id="wrapper" class="display width_80">
	<div class="working_display">
 	<a class="edit_button" href="/random_text_db/">Go Back</a> <br><br>
     <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
     <input type="hidden" id="source_id" name="source_id" value="<?php echo $source_id ?>">
     <input type="hidden" id="char_count" name="char_count" value="<?php echo $char_count ?>">

	   <label for="text_block_edit" class="instant_edit">The Text</label><br>
	   <textarea id="text_block_edit" class="instant_edit" name='text_block'><?php echo $text_block ?></textarea>
	   
	   <br><br>
	   <label for="text_source_edit">Source</label><br>
	   <input type="text" id="text_source_edit" class="width_80 instant_edit" name='text_source' value="<?php echo $source_text; ?>"
 </div>
<?php 
// 	showArray($text_info);
?>
</div>
 </article>
</body>
</html>
