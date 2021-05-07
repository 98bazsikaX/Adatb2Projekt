function main(){ //onload miatt, ha betoltott a <body> akkor ez meghivodik, ebben lesznek a generalo fuggvenyek
    getFilghts();
    getAirlines();
    getAirplanes();
    getDiscounts();
    getAirports();
    getUsers();

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
    //getFilghts();
    var set = "flight=1&";
    var airplane = "airplane=" + document.getElementById("airline_select").value +"&";
    var price = "price="+document.getElementById("price").value+"&";
    var depTime = "depTime="+document.getElementById("depTime").value+"&";
    var arrTime = "arrTime="+document.getElementById("arrTime").value + "&";
    var depCode = "depCode="+document.getElementById("flight_airport").value+"&";
    var arrCode = "arrCode="+document.getElementById("arrId").value;

    if(depCode===arrCode){
        alert("Ugyanaz az érkezési és indulási reptér!");
        return;
    }

    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIsetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
           getFilghts();
        }/*else{
            alert("HIBA!");
            console.log("Hiba: " + this.responseText);
        }*/
    }
    request.send(set+airplane+price+depTime+arrTime+depCode+arrCode);
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
        let div = document.getElementById("airlinesTable");
        let options = document.getElementById("airlineForAirplane");
        let delOption = document.getElementById("delAirlineForAirplane");
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            let results = JSON.parse(this.responseText);
            div.innerHTML = "<tr></tr><th>Kód</th><th>Név</th><th>Ország</th><th>Rövidítés</th></tr>";

            results.forEach(row=>{
                let row_arr = JSON.parse(row);
                div.innerHTML+=`<tr>
                                        <td>${row_arr.code}</td>
                                        <td>${row_arr.name}</td>
                                        <td>${row_arr.country}</td>
                                        <td>${(row_arr.abbr)==null ? "" : row_arr.abbr}</td> 
                                    </tr>`;

                let optionstuff = document.createElement("option");
                optionstuff.value = row_arr.code;
                optionstuff.text = row_arr.name;
                options.add(optionstuff);
                optionstuff = document.createElement("option");
                optionstuff.value = row_arr.code;
                optionstuff.text = row_arr.name;
                delOption.add(optionstuff);

            });
        }else{
            div.innerHTML = "ERROR , próbálja meg később";
        }
    };

    request.send('airlines=1');
}


function getAirplanes(){
    let request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIgetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function(){
        let div = document.getElementById("airplaneTable");
        let optionstuff = document.getElementById("airline_select");

        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            div.innerHTML=" <tr><th>Légitársaságon belüli kódja</th><th>Típusa</th><th>Férőhelyek száma</th><th>Légitársaság neve</th></tr>";
            let planes = JSON.parse(this.responseText);
            planes.forEach(row=>{

                let row_arr = JSON.parse(row);
                div.innerHTML+=`<tr>
                                    <td>${row_arr.airplane_id}</td>
                                    <td>${row_arr.type}
                                    <td>${row_arr.capacity}</td>
                                    <td>${row_arr.airline_name}</td>
                                    </tr>`;

                let toAdd = document.createElement("option");
                toAdd.value = row_arr.id;
                toAdd.text = row_arr.airline_name + "  " + row_arr.type;
                optionstuff.add(toAdd);

            });
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
       // var div = document.getElementById("airportTable");
        let apOption=document.getElementById("flight_airport");
        let arrOption=document.getElementById("arrId");
        let apTable = document.getElementById("airportTable");
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){

            let results = JSON.parse(this.responseText);
            apTable.innerHTML = "<tr></tr><th>Kód</th><th>Név</th><th>Ország</th><th>Város</th></tr>";
            apOption.innerHTML="";
            arrOption.innerHTML="";
            results.forEach(row=>{

                let row_arr = JSON.parse(row);
                apTable.innerHTML+=`<tr>
                                        <td>${row_arr.code}</td>
                                        <td>${row_arr.name}</td>
                                        <td>${row_arr.country}</td>
                                        <td>${row_arr.city}</td> 
                                    </tr>`;

                let option = document.createElement("option");
                option.text = row_arr.name;
                option.value = row_arr.code;
                apOption.add(option);
                /*a kurva geci add vmiért evleszi az option értékét???????????????????!!!!!!!!*/
                option = document.createElement("option");
                option.text = row_arr.name;
                option.value = row_arr.code;
                arrOption.add(option);
            });

        }else{
            apTable.innerHTML = "<p>ERROR , próbálja meg később</p>";
        }
    };

    request.send('airport=1');
}

function setAirport(){
    var setairport = "airport=1&";
    var code = "code=" + document.getElementById("AirportCode").value.toUpperCase()  + "&";
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


function getUsers(){
    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIgetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function(){
        var div = document.getElementById("userTable");
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            div.innerHTML = this.responseText;
        }else{
            div.innerHTML = "ERROR , próbálja meg később";
        }
    };

    request.send('users=1');
}

function deleteUser(){
    var delete_string = "delete_user=1&";
    var email = "email=" + document.getElementById("deleteEmail").value.trim();

    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIsetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            alert("Sikeresen torolte a usert")
            console.log("lefutott, vagyis remelem");
            console.log(this.responseText);
        }
        getUsers();
    }
    request.send(delete_string+email);
}


function newRoleStuff(){
    if(!window.confirm("Biztos")){
        return;
    }
    let roletype = "setRole=1&type="+ document.getElementById("setRole").value + "&";
    let email = "email="+document.getElementById("roleEmail").value;

    var request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIsetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            alert("Sikeresen megváltoztatta a felhasználó típusát");
        }
        getUsers();
    }
    request.send(roletype+email);

}


function setAirplane(){
    let setter = "airplaneSetter=1&";
    let airline = "airlineForPlane="+document.getElementById("airlineForAirplane").value+"&";
    let type = "type="+document.getElementById("airplaneType").value +"&";
    let cap = "cap="+document.getElementById("airplaneCap").value ;
    if(parseInt(cap)<=0){
        alert("Kicsi a repülő te$$");
        return;
    }
    let request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIsetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            //alert("Sikeresen megváltoztatta a felhasználó típusát");
            alert("Sikeresen hozzáadta a gépet!");
        }
        getAirplanes();
    }
    request.send(setter+airline+type+cap);

}

function delAirplane(){
    if(!window.confirm("Biztos törli a gépet?")){
        return;
    }
    let r = "delAirplane=1&";
    let airline = "toDelAirline="+document.getElementById("delAirlineForAirplane").value+"&";
    let code = "toDelCode="+document.getElementById("delAirplaneCode").value;

    let request = new XMLHttpRequest();
    request.open('POST','../php/API/adminAPIsetData.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            //alert("Sikeresen megváltoztatta a felhasználó típusát");
            alert("Sikeresen törölte a gépet!");
        }
        getAirplanes();
    }
    request.send(r + airline + code);
}