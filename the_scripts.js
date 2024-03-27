/************

  the_scripts.js -  Tue Jan 2 12:09:56 CST 2024

*************/

// Try using first principles 

///////////////////////
// Setting up after the DOM is loaded
//----------------------------------------
document.addEventListener("DOMContentLoaded", ready); // wait for it to load.
function ready() {

     /*************** These are for index.php. ***************/
  let show_quote_button = document.getElementById('show_quote_button');
   
  /***** Show a quote - Try using XMLHttpRequest  *****/
  if(show_quote_button != null){
    show_quote_button.addEventListener('click', function(event){           
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/random_text_db/ajax_parser.php", true);
        xhr.responsetype = "json";
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
       
        // done
        xhr.onreadystatechange = function(event){
          if (xhr.readyState == 4 && xhr.status == 200) {
             var response = JSON.parse(this.response);
//                  console.log(response);
             document.getElementById('text_block').innerHTML = response.quote;
             document.getElementById('text_source_pulldown').value = response.src_id;
             document.getElementById('text_source').value = response.source;
          }
        };
        // error
        xhr.onerror = function(event) {
          console.log(event);
        };      
  
        xhr.send("action=get_random_text");
  
    });
  }
    /***** Use fetch. It's supposed to be more flexible than SMLHttpRequest *****/
    let add_new_quote = document.getElementById('add_new_quote');
    if(add_new_quote != null){
       add_new_quote.addEventListener('click', function(event){
          event.preventDefault();
          var the_data = {};
          the_data['text_block'] = document.getElementById('text_block').value;
          the_data['text_source'] = document.getElementById('text_source').value;
          
         aj_promise = ajaxCall("set_quote", the_data)
          .then((json_response) => {
//               console.log(json_response);
              // reset the interface.
              document.getElementById('text_block').value = "";
              document.getElementById('text_source').value = "";
              text_source_pulldown.value = 0;
              
              // Add a new line to the list
              if(json_response.table_row != null) { // can use insertRow() or 
//                 console.log(json_response.table_row);
                let quote_table = document.getElementById('quote_list')
                let row = quote_table.insertRow(-1);
                
                row.innerHTML = json_response.table_row;
              }
           }).catch((error) => {
            console.log(`An error occured: ${error}`);
         });
     });
    }
    /***** Set the source via a pulldown. *****/
    // Later, we will select the pulldown by entering text
    let text_source_pulldown = document.getElementById('text_source_pulldown');
    if(text_source_pulldown != null){
       text_source_pulldown.addEventListener('change', function(event){
           var text_source_id = text_source_pulldown.value;
           var text_source_text = text_source_pulldown.options[text_source_pulldown.selectedIndex].innerHTML;
           
           document.getElementById('text_source').value = text_source_text;
       });
    }
    
    ///////////////////////////////////////////////
     /*************** These are for EditText.php. ***************/


}   

///////////////////////////////////////////////
// Straight functions.
//----------------------------------------
async function ajaxCall(action='', data={}) {
// 	console.log(id); 
	const response = await fetch("/random_text_db/ajax_parser.php", {
		// Be aware that there are other options if you want more flexibility
		method: "POST", // *GET, POST, PUT, DELETE, etc.
		headers: {
		  'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: "action=" + action + "&data=" + JSON.stringify(data), // body data type must match "Content-Type" header
	});
	 if (!response.ok) {
		console.log(response);
		throw new Error(`HTTP error: ${response.status}`);
	 }

// 	return response;
	return response.json();
}
 
