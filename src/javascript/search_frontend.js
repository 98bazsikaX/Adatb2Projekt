/*
* Beallitja a mai datumot az indulast kivallaszto dobozhoz, mert gondolom nem akarunk tegnapi repulore foglalni
*/

function main(){

    setDateBox();
}
function setDateBox() {
    var today = new Date();
    var y = today.getFullYear();
    var m = String(today.getMonth() + 1);
    var d = String(today.getDate());
    document.getElementById("dep_time_box").min = y + "-" + ((m.length == 1) ? ("0") : ("")) + m + "-" + ((d.length == 1) ? ("0") : ("")) + d;
}

//setDateBox(); //majd le is fut


function makeRequest(){
    var search = "search=1&";
    //TODO: Implementalni a beallitott adatok lekerdezeset
    var airline = "airline="+document.getElementById("airline_select").value+"&";
    var departure = "dep="+document.getElementById("departure_select").value+"&";
    var arrival = "arr="+document.getElementById("arrival_select").value+"&";
    var depTime = "time="+document.getElementById("dep_time_box").value;

    if(document.getElementById("departure_select").value == document.getElementById("arrival_select").value){
        alert("Ugyanaz az erkezesi es indulasi hely!");
        return;
    }

    var request = new XMLHttpRequest();
    request.open('POST','../php/API/searchAPI.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function(){
        var div = document.getElementById("results");
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            document.getElementById("results").innerHTML = request.responseText;
        }else{
            div.innerHTML = "ERROR , próbálja meg később";
        }
    }



    request.send(search+airline+departure+arrival+depTime);


}




