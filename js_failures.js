/************

  js_failures.js -  Wed Mar 13 09:51:45 CDT 2024

*************/

// Example POST method implementation: from https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
async function postData(url = "", data = {}) {
  // Default options are marked with *
  const response = await fetch(url, {
    method: "POST", // *GET, POST, PUT, DELETE, etc.
    mode: "cors", // no-cors, *cors, same-origin
    cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    credentials: "same-origin", // include, *same-origin, omit
    headers: {
      "Content-Type": "application/json",
      // 'Content-Type': 'application/x-www-form-urlencoded',
    },
    redirect: "follow", // manual, *follow, error
    referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    body: JSON.stringify(data), // body data type must match "Content-Type" header
  });
  return response.json(); // parses JSON response into native JavaScript objects
}

        // No POST data
            postData("/random_text_db/ajax_parser.php", the_data).then((output) => {
              console.log(output); // JSON data parsed by `data.json()` call
            });
///////////////////////


            var req = new Request('/random_text_db/ajax_parser.php', {
                method: 'post',
                mode: 'cors',
                redirect: 'follow',
                headers: {
                  "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                },
                body: JSON.stringify(the_data)
              });
              
              fetch(req)
                 .then(function(response){
                    console.log(response);
                 });


//           fetch("/random_text_db/ajax_parser.php", {
//             method: 'POST',
//             body: JSON.stringify(the_data)
//           })
//             .then(response => {
//               if (response.status >= 200 && response.status < 300) {
//                 return Promise.resolve(response)
//               } else {
//                 return Promise.reject(new Error(response.statusText))
//               }
//             })
//             .then(function(response){
//                 console.log(response);
//             })
 //?????         
//           var xhr = new XMLHttpRequest();
//           xhr.open("GET", "/random_text_db/ajax_parser.php", true);
//           xhr.responsetype = "json";
// //           xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//           xhr.setRequestHeader("Content-Type", "application/json'");
//          
//           // done
//           xhr.onreadystatechange = function(event){
//             if (xhr.readyState == 4 && xhr.status == 200) {
// //                var response = JSON.parse(this.response);
//                console.log('bob');
//                console.log(this.response);
//             }
//           };
//           // error
//           xhr.onerror = function(event) {
//             console.log(event);
//           };      
//           
//            xhr.send(JSON.stringify({'id':'get_random_text', 'text_block':the_data['text_block']}));
// //            xhr.send("cat=get_random_text", "text_block=" + the_data['text_block']);
