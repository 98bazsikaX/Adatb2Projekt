function main(){ //onload miatt, ha betoltott a <body> akkor ez meghivodik, ebben lesznek a generalo fuggvenyek
    getFilghts();
    getAirlines();
    getAirplanes();
    getDiscounts();
    getAirports();

}



function getFilghts(){

    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIgetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function(){
        var div = document.getElementById("flightsTable");
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            div.innerHTML = this.responseText;
        }else{
            div.innerHTML = "ERROR , próbálja meg később";
        }
    }

    request.send('flights=1');

}

function setFlights(){
    getFilghts();
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
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
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


function getAirplanes(){
    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIgetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function(){
        var div = document.getElementById("airplaneTable");
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            div.innerHTML = this.responseText;
        }else{
            div.innerHTML = "ERROR , próbálja meg később";
        }
    };

    request.send('planes=1');
}


function addAirplane(){
    return null;
}

function setDiscount(){

}
function getDiscounts(){
    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIgetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function(){
        var div = document.getElementById("discountTable");
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            div.innerHTML = this.responseText;
        }else{
            div.innerHTML = "<p>ERROR , próbálja meg később</p>";
        }
    };

    request.send('discount=1');
}

function getAirports(){
    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIgetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function(){
        var div = document.getElementById("airportTable");
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            div.innerHTML = this.responseText;
        }else{
            div.innerHTML = "<p>ERROR , próbálja meg később</p>";
        }
    };

    request.send('airport=1');
}

function setAirport(){
    var setairport = "airport=1&";
    var code = "code=" + document.getElementById("AirportCode").value.toUpperCase() + "&";
    var name = "name=" + document.getElementById("AirportName").value + "&";
    var country = "country=" + document.getElementById("AirportCountry").value + "&";
    var city = "city="+document.getElementById("AirportCity").value;

    if(document.getElementById("AirportCode").value.length<1 || document.getElementById("AirportName").value.length<1 || document.getElementById("AirportCountry").value.length<1 || document.getElementById("AirportCity").value.length<1){
        alert("Hibás adatok új reptér megadásánál!\n Minden mezőnek min 1 hosszónak kell lennie.");
        return;
    }

    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIsetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            console.log("lefutott, vagyis remelem");
        }
        getAirports();
    }
    request.send(setairport+code+name+country+city);


}