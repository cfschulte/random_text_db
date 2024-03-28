<?php
// index.php -  Tue Jan 2 10:42:24 CST 2024
// 
require_once "functions.php";

$db_obj = new DbClass();
$sql = "SELECT text_block.id, text_block.text_block, text_source.descriptor FROM text_block ";
$sql .= " JOIN text_source ON text_block.text_source=text_source.id ";
$text_table = $db_obj->getTableNoParams($sql) ;
$db_obj->closeDB();

?>
<!DOCTYPE html>
<html lang="en">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/ >
<title>Collect Random Text Samples</title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="./the_scripts.js"></script>  

</HEAD>
<body>
<header id="dynamic_header" class="page_header">
  <div class="centered">
  <h1>Collect Random Text Samples</h1>
  </div>
</header>
<article id="wrapper" class="display width_80">
	<div class="working_display">
 	<h2>Show random text</h2>
    <button id="show_quote_button">Show me something</button><br><br>
   	
	<form id="new_quote">
	   <label for="text_block">The Text</label>
	   <textarea id="text_block" name='text_block'></textarea>
	   
	   <br>
	   <div class="flex_container_100">
	     <div class="flex_item_40">
		  <label for="text_source">Source</label>
	     	<?php
	     	echo buildSourceSelect();
	     	?>
		 </div>
	     <div class="flex_item_40">
		  <input type="text" id="text_source" class="width_60" name='text_source' value="" >
	     </div>
	     <div id="edit_link_space" class="flex_item_8em">
	     </div>
	   </div>
	   
	   <br><br>
	   <button id="add_new_quote" value="add_new_quote">Deposit</button>
	</form>
	
	</div>
	<?php 
// 	showArray($text_table);
	?>
	
	<h2>The complete list</h2>
	<table id="quote_list"  class="table_table db_table_list">
	<thead>
	   <tr><th>Edit</th><th>The Text</th><th>Source</th></tr>
	</thead>
	<tbody>
	<?php 
	foreach($text_table as $row) {
		echo '<tr>';
		$url = './EditText.php?id=' . $row['id'];
		$the_text = plainText2Breaks($row['text_block']);
		echo "<td><a href='$url'>" . $row['id'] . "</a></td>";
		echo "<td>$the_text</td>";
		echo "<td>" . $row['descriptor'] . "</td>";
		echo '</tr>' . "\n";
	}
	?>
	 </tbody>
	</table>
</article>

</body>
</html>
