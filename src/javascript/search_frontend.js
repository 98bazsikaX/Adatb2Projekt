/*
* Beallitja a mai datumot az indulast kivallaszto dobozhoz, mert gondolom nem akarunk tegnapi repulore foglalni
*/

function main(){

    setDateBox();
    setData();
}
function setDateBox() {
    var today = new Date();
    var y = today.getFullYear();
    var m = String(today.getMonth() + 1);
    var d = String(today.getDate());
    document.getElementById("dep_time_box").min = y + "-" + ((m.length == 1) ? ("0") : ("")) + m + "-" + ((d.length == 1) ? ("0") : ("")) + d;
}

//setDateBox(); //majd le is fut
function setData(){
    var request = new XMLHttpRequest();
    request.open('POST','../php/API/searchAPI.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function(){
        var div = document.getElementById("results");
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            createTable(this.responseText);
        }
    };

    request.send("ALL=1");

}

function makeRequest(){
    var search = "search=1&";
    var departure = "dep="+document.getElementById("departure_select").value+"&";
    var arrival = "arr="+document.getElementById("arrival_select").value+"&";
    var depTimeMin = "time="+document.getElementById("dep_time_box").value+"&";
    var depTimeMax = "time_max="+document.getElementById("dep_time_box_too").value+"&";
    var minPrice = "min_price="+document.getElementById("min_price").value+"&";
    var maxPrice = "max_price="+document.getElementById("max_price").value;
    console.log(search+departure+arrival+depTimeMin+depTimeMax+minPrice+maxPrice);

    if(departure===arrival){
        alert("Ugyanaz az erkezesi es indulasi hely!");
        return;
    }
    if(document.getElementById("min_price").value==null || document.getElementById("min_price").value.length === 0){
        minPrice = "min_price=0&";
    }
    if(document.getElementById("max_price").value==null || document.getElementById("max_price").value.length === 0){
        maxPrice = "max_price=999999";
    }

    var request = new XMLHttpRequest();
    request.open('POST','../php/API/searchAPI.php');
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

    request.onreadystatechange = function(){
        if(this.readyState === XMLHttpRequest.DONE && this.status===200){
            createTable(this.responseText);
            console.log(this.responseText);
        }
    };
    request.send(search+departure+arrival+depTimeMin+depTimeMax+minPrice+maxPrice);
}

function createTable(responseText) {

    let results = document.getElementById("resultsTable");
    results.innerHTML = "<tr><th>Légitársaság</th><th>Ár</th><th>Indulás ideje</th><th>Érkezés ideje</th><th>Indulási reptér</th><th>Érkezési reptér</th><th>Vásárlás</th></tr>";
    let jsonArray = JSON.parse(responseText);
    jsonArray.forEach(row=>{
        let rowArr = JSON.parse(row);

        results.innerHTML +=`<tr>
                                <td>${rowArr.AIRLINE_NAME}</td>
                                <td>${rowArr.PRICE}</td>
                                <td>${rowArr.TAKEOFF_DATE}</td>
                                <td>${rowArr.LANDING_DATE}</td>
                                <td>${rowArr.DEP_ARP_CITY} ${rowArr.DEP_ARP_NAME}</td>
                                <td>${rowArr.ARR_ARP_CITY} ${rowArr.ARR_ARP_NAME}</td>
                                <td><a href="buying.php?id=${rowArr.ID}">Jegy vásárlása</a></td>
                            </tr>`;
    });
}




