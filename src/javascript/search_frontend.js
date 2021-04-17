/*
* Beallitja a mai datumot az indulast kivallaszto dobozhoz, mert gondolom nem akarunk tegnapi repulore foglalni
*/
function setDateBox(){
    var today = new Date();
    var y = today.getFullYear();
    var m = String(today.getMonth()+1);
    var d = String(today.getDate());
    document.getElementById("dep_time_box").min = y + "-" + ((m.length == 1)? ("0") : ("")) +  m + "-" + ((d.length == 1)? ("0") : ("")) +  d;
}
setDateBox(); //majd le is fut


/*
*
* A fuggveny beallitja az options div-ben levo mezok ertekeit hogy lehessen keresni
*TODO: implement
*/
function getOptions(){

}

getOptions(); //majd le is fut



function makeRequest(){
    //TODO: Implementalni a beallitott adatok lekerdezeset

    var request = new XMLHttpRequest();
    request.open('POST','../php/API/searchAPI.php',false); //nem async mert nem akarok callbackel szenvedni
    request.setRequestHeader("CONTENT-TYPE","application/json");
    request.send(null);

    if(request.status == 200){
        document.getElementById("results").innerHTML = request.responseText;
    }



}




