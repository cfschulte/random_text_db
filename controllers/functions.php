<?php
// functions.php -  Tue Jan 2 13:17:17 CST 2024
// 
require_once "essentials.php";


///////////////////////////////////////////////////
// When the contents of a text or textarea input are displayed as
// simple html text, all of the new lines and spacing are lost. 
// This function, plainText2Paragraphs, fixes that.

function plainText2Paragraphs($plain_text){
    $paragraphs = trim($plain_text);

    // Add the description if there was something in it
    if(!empty($paragraphs)){
        $paragraphs = '<p>' . $paragraphs . '</p>' ;
        
        $paragraphs = preg_replace('/[\r\n]+/', '</p><p>', $paragraphs);
    }
    
    return $paragraphs;
}

///////////////////////////////////////////////////
// Like plainText2Paragraphs except that instead of 
// useing paragraph, it just uses <br> elements
function plainText2Breaks($plain_text){
    $paragraphs = trim($plain_text);
    // Add the description if there was something in it
    
    if(!empty($paragraphs)){
        
        $paragraphs = preg_replace('/[\r\n]+/', '<br>', $paragraphs);
    }
    
    return $paragraphs;
}


/////////////////////////////
// Select a random bit of text
function get_random_text() {
	
	$db_obj = new DbClass();
	// How many quotes are there?
	$sql = "SELECT COUNT(id) FROM text_block";
	$db_result = $db_obj->getTableNoParams($sql);
	
	$ceiling = $db_result[0]['COUNT(id)'];
	$rand_id = rand(1, $ceiling);
	
	$sql  = "SELECT tb.id, tb.text_block AS quote, ts.id AS src_id, ts.descriptor AS source FROM text_block AS tb " ;
	$sql .= "JOIN text_source AS ts ON ts.id=tb.text_source " ;
	$sql .= "WHERE tb.id=?";
	$db_result = $db_obj->simpleOneParamRequest($sql, 'i', $rand_id);
	$db_obj->closeDB();
	
	return  $db_result[0];
}


/////////////////////////////
// Add the quote to the database. -- indata now also contains the id
function set_quote($indata) {
	$text_block = $indata['text_block'];
	$text_source = $indata['text_source'];
	
	if(empty($text_block)) {
		return "";
	} elseif(empty($text_source)){
		$text_source = "Unknown";
		$text_source_id = 4;
	}
	
	// Check to see if the text or source have been repeated
	$source_id = check_uniqueness('text_source', 'descriptor',  $text_source);
	$text_block_id = check_uniqueness('text_block', 'text_block',  $text_block);
	
	
	
	if(is_null($text_block_id) && is_null($source_id)) {
		$source_id = addNewSource($text_source);
		$text_block_id = addNewTextBlock($source_id, $text_block);
		
		$new_source = ['source_id' => $source_id, 'text_source' => $text_source];
		
	} elseif(is_null($text_block_id) && $source_id) { // The source has an id but the text does not. 
		$text_block_id = addNewTextBlock($source_id, $text_block); 
	} elseif(is_null($source_id) && $text_block_id) {  // The text has an id but the source does not. 
		// Check to see what or if the original source is. 
		$source_id = getSourceFromTextBlock($text_block_id);
	}
	
	$new_row = quoteRow($text_block_id, $text_block, $text_source);
	
	return ['source_id' => $source_id, 'text_block_id' => $text_block_id, 'table_row' => $new_row, 'new_source' => $new_source];
}

function update_quote($indata) {
	$text_block_id = $indata['text_block_id'];
	$source_id     = $indata['source_id'];
	$table         = $indata['table'];
	$value         = $indata['value'];
	
	$id = 0;
	$column = "";
	if($table == 'text_block') {
		$column = 'text_block';
		$id = $text_block_id;
	} elseif($table == 'text_source') {
		$column = 'descriptor';
		$id = $source_id;
	}
	
	$sql = "UPDATE $table SET $column = ? WHERE id=?";
	$db_obj = new DbClass();
	$result = $db_obj->safeInsertUpdateDelete($sql, 'si', [$value, $id]);
	$db_obj->closeDB();
	
	return $result;
}

/////////////////////////////
// Checks to see if the given text is unique to that table
function check_uniqueness($table, $column, $text){
	
	$sql = "SELECT $column FROM $table WHERE LOWER($column)=LOWER(?)";
	$sql = "SELECT id FROM $table WHERE LOWER($column)=LOWER(?)";
	$db_obj = new DbClass();
	$db_result = $db_obj->simpleOneParamRequest($sql, 's', $text);
	$db_obj->closeDB();
	
// 	return count($db_result);
	return $db_result[0]['id'];
}

/////////////////////////////
// Takes a new source and adds it to the database 
function addNewSource($text_source) {
	$sql = "INSERT INTO text_source (descriptor) VALUES (?)";
	
	$new_id = 0;
	
	$db_obj = new DbClass();
	$db_result = $db_obj->safeInsertUpdateDelete($sql, 's', [$text_source]);
	
	$new_id =  $db_obj->lastInsertedID();
	$db_obj->closeDB();
	
	
	return $new_id;
}


/////////////////////////////
//NOTE: This will need more error checking!
function addNewTextBlock($source_id, $text_block) {
	$char_count = strlen($text_block);
	$sql = "INSERT INTO text_block (text_source, char_count, text_block) VALUES (?,?,?)";
	
	$db_obj = new DbClass();
	$db_result = $db_obj->safeInsertUpdateDelete($sql, 'iis', [$source_id, $char_count, $text_block]);
	
	$new_id =  $db_obj->lastInsertedID();
	$db_obj->closeDB();
	
	
	return $new_id;
}

/////////////////////////////
// Adds a new site 
function add_new_site($indata) {
	$url = $indata['url'];
	$title = $indata['title'];
	$site_category = $indata['site_category'];
	$category_edit = $indata['category_edit'];
	$site_id = 0;
// 	return $site_category;
	
	$site_category = newOrUpdateSiteCategory($site_category, $category_edit);
// 	return  $site_category;
 
	$site_id = check_url($url);
	if( $site_id == null  ){ // add a new site if it doesn't exist 
		$db_obj = new DbClass();
		$sql = "INSERT INTO saved_site (site_category, url, title) VALUES (?,?,?)";
		$db_result = $db_obj->safeInsertUpdateDelete($sql, 'iss', [$site_category, $url, $title]);
		$site_id = $db_obj->lastInsertedID();
		$db_obj->closeDB();
	} else { // try updating the existing site 
		$db_obj = new DbClass();
		$sql = "UPDATE saved_site SET site_category=?, url=?, title=? WHERE id=?";
		$db_result = $db_obj->safeInsertUpdateDelete($sql, 'issi', [$site_category, $url, $title, $site_id]);
		$db_obj->closeDB();
	}
	
	return $site_id;
}


/////////////////////////////
// Checks to see if a url is already in the database 
function check_url($url) {
	$sql = "SELECT id FROM saved_site WHERE url=?";
	$db_obj = new DbClass();
	$db_result = $db_obj->simpleOneParamRequest($sql, 's', $url);
	$db_obj->closeDB();
	
	return $db_result[0]['id'];
}
/////////////////////////////
// Returns the index of the category - It seems that always rewriting the descriptor
// is less work/clock cycles than checking whether there are actually any updates to 
// be made.
function newOrUpdateSiteCategory($category_id, $descriptor) {
	$db_obj = new DbClass();
	$cat_index = $category_id;
	
	// $category_id will be zero if a new one must be made.
	if($category_id == 0) {
		$sql = 'INSERT INTO site_category (descriptor) VALUES (?)';
		$db_result = $db_obj->safeInsertUpdateDelete($sql, 's', [$descriptor]);
		
		
		if($db_result > 0) { // check for success. 
			$cat_index = $db_obj->lastInsertedID();
		} else {
			$db_obj->closeDB();
			return $db_result;
		}
	} else {
		$sql = 'UPDATE site_category SET descriptor=? WHERE id=?';
		$db_result = $db_obj->safeInsertUpdateDelete($sql, 'si', [$descriptor, $category_id]);
// 		if($db_result == 0) {
// 			$db_obj->closeDB();
// 			return $db_result;
// 			return 'hmm';
// 		} 
	}
	$db_obj->closeDB();
	
	return $cat_index;
}

/////////////////////////////
//
function getSourceFromTextBlock($text_block_id) {
	$sql = "SELECT source_id FROM text_block WHERE id=?";

	$db_obj = new DbClass();
	$db_result = $db_obj->safeSelect($sql, 'i', [$text_block_id]);
	$db_obj->closeDB();
}


//////////////////////////////////////////////////////////
// stuff to build the interface 

function buildSiteCatSelect($current_choice=0, $disabled=0) {
	$pulldownList = getPulldownList('site_category', 'id', 'descriptor');
	
	$buffer  = '<select id="site_category" name="site_category" >' . "\n";
	$buffer .= '<option value="0" >New</option>' . "\n";  
	foreach($pulldownList as $choice) {
		$buffer .= '<option value="' . $choice['id'] . '" ';  
		if($choice['id'] == $current_choice) {
		    $buffer .= 'selected';
		}
		$buffer .= '>' . $choice['descriptor'] . '</option>' . "\n";
	}
	$buffer .= "</select>\n";
	
	return $buffer;
}


//////////////////////////////////////////////////////////
// stuff to build the interface 

function buildSourceSelect($current_choice=0, $disabled=0) {
	$pulldownList = getPulldownList('text_source', 'id', 'descriptor');
	
	$buffer  = '<select id="text_source_pulldown" name="text_source_pulldown" >' . "\n";
	$buffer .= '<option value="0" >other</option>' . "\n";  
	foreach($pulldownList as $choice) {
		$buffer .= '<option value="' . $choice['id'] . '" ';  
		if($choice['id'] == $current_choice) {
		    $buffer .= 'selected';
		}
		$buffer .= '>' . $choice['descriptor'] . '</option>' . "\n";
	}
	$buffer .= "</select>\n";
	
	return $buffer;
}

 /*************************************************************************/  
 // create a row for the list of quotes
function quoteRow($text_block_id, $text_block, $text_source) {
// 		$buffer  = '<tr>';
		$url = './EditText.php?id=' . $text_block_id;
		$the_text = plainText2Breaks($text_block);
		$buffer = "<td><a href='$url'>" . $text_block_id . "</a></td>";
		$buffer .= "<td>$the_text</td>";
		$buffer .= "<td>" . $text_source. "</td>";
// 		$buffer .= '</tr>' . "\n";
		
		return $buffer;
}

 /*************************************************************************/  
    //  echo a select input directly to the output 
    // - Sloppy - copy paste for small addition -  but quick
    function buildGenericSelectInstantEdit($tablename, $form_name, $id_name, $label_name, $current_choice=0, $disabled=0) {
        $pulldownList = getPulldownList($tablename, $id_name, $label_name);

        echo '<select id="' . $form_name . '" name="' . $form_name . '" ';
        if($disabled) {
           echo ' disabled '; 
        }
        echo '>' . "\n";
    
        foreach($pulldownList as $choice) {
            echo '<option value="' . $choice[$id_name] . '" ';  
            $this->setSelection($choice[$id_name], $current_choice);
            echo '>' . $choice[$label_name] . '</option>' . "\n";
        }
        echo "</select>\n";
    }


    // //////////////////////
    function getPulldownList($tablename, $id_name, $label_name) {
         $sql = "SELECT $id_name, $label_name FROM  $tablename";
        
        $db_obj = new DbClass();
        $db_table = $db_obj->getTableNoParams($sql);
        $db_obj->closeDB();
        return     $db_table;
    }
