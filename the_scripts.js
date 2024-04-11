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
        xhr.open("POST", "/random_text_db/controllers/ajax_parser.php", true);
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
             var edit_link = '<a class="edit_button" href="./EditText.php?id=' + response.id + '">Edit this</a>' ;
             document.getElementById('edit_link_space').innerHTML = edit_link;
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
              
              // Add the source to the pulldown if it's new.
              if(json_response.new_source != null) {
                 var src_select = document.getElementById('text_source_pulldown');
                 var new_option = document.createElement('option');
                 new_option.value = json_response.new_source.source_id;
                 new_option.text = json_response.new_source.text_source;
                 
                 src_select.add(new_option);
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
    
    let edit_text_fields = document.getElementsByClassName('instant_edit');
    if(edit_text_fields.length > 0) {
        let the_elements = Array.from(edit_text_fields);
        the_elements.forEach(function(element) {
            element.addEventListener("change", function(event){
                event.preventDefault();
                var the_data = {};
                the_data['table'] = this.name;
                the_data['value'] = this.value;
                the_data['source_id'] = document.getElementById('source_id').value;
                the_data['text_block_id'] = document.getElementById('id').value;
                console.log(the_data);
//                 console.log(this.value);
//                 console.log(this.name);
                
                aj_promise = ajaxCall("update_quote", the_data)
                 .then((json_response) => {
                    console.log(json_response);
                 });
            });
        });
    } 
    
    ///////////////////////////////////////////////
     /*************** These are for website.php. ***************/
    let add_new_site = document.getElementById('add_new_site');
    if( add_new_site != null) {
      let site_category_select = document.getElementById('site_category');
      
      // Choose whether the category editor edits or creates a new category
      site_category_select.addEventListener('change', function(){
          selection = site_category_select.value;
          console.log( site_category_select.options[site_category_select.selectedIndex].innerHTML );
          if(selection != 0) {
              document.getElementById('category_edit').value = site_category_select.options[site_category_select.selectedIndex].innerHTML;
          } else {
              document.getElementById('category_edit').value = "";
          }
          
      });
      add_new_site.addEventListener('click', function(event){
         console.log('Add a site!');
          event.preventDefault();
          var the_data = {};
          
          the_data['url'] = document.getElementById('url').value;
          the_data['title'] = document.getElementById('title').value;
          the_data['site_category'] = site_category_select.value;
          the_data['category_edit'] = document.getElementById('category_edit').value;
                    
          console.log(the_data);
          
          // AJAX Call
          aj_promise = ajaxCall("add_new_site", the_data)
           .then((json_response) => {
              console.log(json_response);
           });
      });

        
        
    } else {
        let url_text_fields = document.getElementsByClassName('instant_edit_url');
        if(url_text_fields.length > 0){
            let the_elements = Array.from(edit_text_fields);
            console.log(the_elements)
        }
    }

}   

///////////////////////////////////////////////
// Straight functions.
//----------------------------------------
async function ajaxCall(action='', data={}) {
// 	console.log(id); 
	const response = await fetch("/random_text_db/controllers/ajax_parser.php", {
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
 
