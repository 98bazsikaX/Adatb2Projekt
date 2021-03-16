<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSS Tours</title>
    <link rel="stylesheet" href="../stylesheets/global.css">
    <script type="text/javascript">
        function test_api(){
            /*
            forras https://www.w3schools.com/xml/xml_http.asp
            backend megvalositasa: /API/api_test.php
            GET megvalositas:
            */
           var url = 'API/api_test.php';
           var get_msg = '?test=true';
           var post_msg = 'testpost=true';
            console.log("Function called");
            var xhttp= new XMLHttpRequest();
            
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status==200){

                    console.log(xhttp.responseText);
                }
            }
            

            xhttp.open('GET','API/api_test.php?test=true');
            xhttp.send();
             

            

            /*
            POST megvalositas
            Forras: https://stackoverflow.com/questions/9713058/send-post-data-using-xmlhttprequest
            */
            xhttp.open('POST',url,true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(post_msg); 
            
        }
    
    </script>
</head>
<body>
    <header>
        Üdvözöljük a Szlavikovics - Sárossy - Szombati utazási iroda weboldalán.
    </header>
    <button type="button" onclick="test_api()">TEST API</button>
    <footer>
        All rights reserved
    </footer>

</body>
</html>