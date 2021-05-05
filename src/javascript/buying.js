function main(){

    setDateBox();
}
var today = new Date();
function setDateBox() {
    var y = today.getFullYear();
    var m = String(today.getMonth() + 1);
    var d = String(today.getDate());
    document.getElementById("dep_time_box").min = y + "-" + ((m.length == 1) ? ("0") : ("")) + m + "-" + ((d.length == 1) ? ("0") : ("")) + d;
}

function makeTicket() {


    var date= today;
    var buying= "buying=1&";
    var fnumber = "fnumber=" + document.getElementById("fnumber").value;
    var r_email = "r_email=" + document.getElementById("r_email").value;
    var person = "person=" + document.getElementById("person").value;



    var calc = new XMLHttpRequest();
    calc.open('POST', '../php/API/buyingAPI.php');
    calc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


    calc.send(buying+fnumber+r_email+person+date);

}