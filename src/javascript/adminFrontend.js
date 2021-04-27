function main(){ //onload miatt, ha betoltott a <body> akkor ez meghivodik, ebben lesznek a generalo fuggvenyek
    getFilghts();
    getAirlines();

}



function getFilghts(){

    return null;
}


function setAirline(){
    var setairline = "setairline=1&";
    var code = "code="+document.getElementById("AirlineCode").value + "&";
    var name = "name=" + document.getElementById("name").value + "&";
    var abbr = (document.getElementById("abr").value.length <1) ? ("") : ("abbr=" + document.getElementById("abr").value + "&");
    var nat = "nat=" + document.getElementById("country").value;


    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIsetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE && this.status===200 && this.responseText=="1"){
            getAirlines();
        }else{
            alert("HIBA!");
            console.log("Hiba: " + this.responseText);
        }
    }
    request.send(setairline+code+name+abbr+nat);

}

function getAirlines(){

    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIgetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function(){
        var div = document.getElementById("airlinesTable");
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            div.innerHTML = this.responseText;
        }else{
            div.innerHTML = "ERROR , próbálja meg később";
        }
    };

    request.send('airlines=1');



}

