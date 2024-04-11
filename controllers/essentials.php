<?php
// essentials.php -  Wed Jun 27 15:12:16 CDT 2018
//
// This is a collection of functions that I developed over the past
// few years. They are mostly little handy things and a few user 
// management utilities. 

$root = $_SERVER['DOCUMENT_ROOT'] ;
set_include_path($root . '/random_text_db/:' . 
			     $root .  '/random_text_db/models:' . 
			     $root .  '/random_text_db/controllers:' 
			     );



require_once "DbClass.php";


// $DATE_FORMAT = 'mm/dd/yyyy';
$DATE_FORMAT = 'yyyy/mm/dd';

// $LOG_FILE = '/var/log/';

//////////////
function showArray($inArray){
    if(is_array($inArray)){
        echo "<pre style=\"text-align:left\">\n";
        print_r($inArray);
        echo "</pre><br/>\n";
    } else {
        echo "not an array<br/>\n";
    }
}

//////////////
function showObject($object){
    echo "<pre style=\"text-align:left\">\n";
    print_r($object);
    echo "</pre><br/>\n";
}


//////////////
function showDebug( $string ) {
    echo 'DEBUG: ' . $string . '<br/>' . "\n";
}

//////////////
function dump($value) {
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

////////////////////////////////////
// standard reply for successful update 
function successfulUpdate() {
    date_default_timezone_set("America/Chicago");
    return "Update successful: " . date("Y/m/d H:i:sa");            
}



///////////////////////////////////////////////////
//  Make sure the data value is the correct type for
//  the database field.
// Right now, I'm just checking for dates, but this
// should be expanded to make sure numbers are cast 
// correctly. 
function ensureType($val, $val_type) {
    if($val_type == 'date') {
        $val = ensureDate($val);
    }
    return $val;
}


////////////////////////////////////
//  Creates a date format that won't screw up MySQL.
//  This defaults to 1969-12-31, so that would be an error.
function ensureDatetime($date) {
    date_default_timezone_set("America/Chicago");
    
    $time = strtotime($date);
    if( $time != '' ) {
        $format = "m/d/Y H:i:s";
        return date($format, $time);
    } else {
        return NULL;
    }
}


////////////////////////////////////
//  Creates a date format that won't screw up MySQL.
//  This defaults to 1969-12-31, so that would be an error.
function ensureDate($date) {
    date_default_timezone_set("America/Chicago");
    $time = strtotime($date);
    
    // having issues with some formats using m/d/y
    $standardized_date = date("m/d/Y", $time);

    // Make sure that the date wasn't set to the future - e.g. 1/4/69 is not 
    // set to 01/04/2069 instead of 01/04/1969
    $this_year = date("Y"); 
    $date_array = explode('-', $standardized_date);
    if($date_array[0] > $this_year){
        $date_array[0] = $date_array[0] - 100;
        $new_date = implode("-", $date_array); 
        return $new_date;
    }
    
    // just double checking 
    if( $time != '' ) {
        return $standardized_date;
    } else {
        return NULL;
    }
}

function today() {
    date_default_timezone_set("America/Chicago");
    return date("Y-m-d H:i:s");  
//     return date("m/d/Y");  
}

/////////////////////////////
//  
function beforeToday($end_date) {
    if($end_date == '') { // end date has not been set, so..
        return false;
    }
    
    date_default_timezone_set("America/Chicago");    
    $now = time ();
    $endTime = strtotime($end_date);
    
    if($endTime < $now) { // before now 
        return true;
    }
    return false;
}

/////////////////////////////

function americanDate($date) {
    date_default_timezone_set("America/Chicago");
    $time = strtotime($date);
    if( $time != '' ) {
        $format = "m/d/Y";
        return date($format, $time);
    } else {
        return '';
    }
}


////////////////////////////////////
// from http://stackoverflow.com/questions/9219795/truncating-text-in-php
// truncates a string to the nearest whitespace to the maximum length 
function truncate($text, $chars = 25) {
    $orig_text = $text;
    $text .= ' ';
    $text = substr($text,0,$chars);
    $text = substr($text,0,strrpos($text,' '));
    if( $orig_text != $text ) {
        $text .= '...';
    }
    return $text;
}


////////////////////////
// Turn text area text delineated by new lines and/or carriage returns into
// paragraphs. We could do it in one line of something sloppy. We won't do that.
function nl2paragraph($in_text){
    // create an array of text strings. 
    $text_array = preg_split("/\n|\r/", $in_text);

    // Declare the text block.
    $out_buffer = "";

    foreach($text_array as $str){
        if(empty($str)) {
            continue;
        }
        $out_buffer .= '<p>'. $str . '</p>';
    }
    return $out_buffer; 
}


//////////
// Quickly create a more usable associative array from the post data sent by json
// I used to use the jquery function serializeArray() to get form data. That returned an
// "array" (json structure) of the type, item:{name: x, value: y}. This converts that 
// structure into a php associated array of the sort [name1=>value1, name2=>value2...]
function simpleAssocArray($inArray) {
    $outarray = array() ;
    
    // the current format is array('name' => $name, 'value' => $value, $proto_object )
    foreach( $inArray as $object ) {
        $name = $object['name'];
        $value = $object['value'];
        
        $outarray[$name] = $value;
    }
    
    return $outarray;
}


////////////////////
// This needs to be updated for this application.
function getUserInfo( $userid ){
    // query users in database for this information 
    
    $db_obj = new DbClass();
    $sql = 'SELECT name, net_id, user_privilege, show_closed_tickets FROM user WHERE net_id=?';
    $db_table = $db_obj->simpleOneParamRequest($sql, 's', $userid);
    $user_row = $db_table[0];
    
    // If the user does not exist in the database, it is probably because they are
    // new and haven't been added to it yet. So, create a user without a name.
    if(empty($db_table)){
        $sql = 'INSERT INTO user (name, net_id) VALUES ("No Name", ?)';
        $db_obj->safeInsertUpdateDelete($sql, 's', [$userid]);
    }
        
    $db_obj->closeDB();
    
    $user_row['is_admin'] = 0;
    if($user_row['user_privilege'] == USER_ADMIN) {
    	$user_row['is_admin'] = 1;
    }
    
    return $user_row;
}


////////////////////
// Get shibboleth information for userid 
function check_login() {
  // we will get the cookies up and going for this later. 
    // base url
//     return array( 'name' => 'Carri Glide-Hurst', 'net_id' =>'glidehurst', 'user_id' => '2');
    $user_privileges = 10; // for possible later use
    $userid = '';
    if( array_key_exists('uid', $_SERVER)){
        $userid = $_SERVER['uid'];
    } else {
        $userid= 'enoon'; // a dummy account
        $user_privileges = 100;
        
        // For development and debuging on the localhost, I switch between various 
        // user types.
        if($_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'localhost'){ 
//              $userid = 'jbsmilow';   // a physicist
             $userid = 'cfschulte';  // an admin
//              $userid = 'ehyland';    // a therapist
// 			 $userid = 'almathews'; // status change only
         }
    }
	if($_SERVER['HTTP_HOST'] == 'dho-dev03.humonc.wisc.edu'){ // Test debug on the dev machine
// 		  $userid = 'jbsmilow';   // a physicist
		  $userid = $userid;  // an admin
// 		  $userid = 'ehyland';    // a therapist
// 		$userid = 'almathews'; // status change only
	 }
	 $userInfo        = getUserInfo( $userid );
//     $userEnvironment = getUserEnvironment( $userid );
//     
//    // Add whatever environment is needed to userInfo
//     $userInfo['show_closed_tickets'] = $userEnvironment['show_closed_tickets'];
//     $userInfo['is_admin'] = $userEnvironment['is_admin'];
    
   // showArray($userInfo);
    // Let them through if they are on the list, otherwise send them to disallow.
    if( empty($userInfo) ){
        header('Location: /phys_machine_tracker/unauthorized.php');
    }
    // else follow through to the called page 
    return $userInfo;
}
