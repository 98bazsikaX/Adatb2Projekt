var today = new Date();
var y = today.getFullYear();
var m = String(today.getMonth()+1);
var d = String(today.getDate());
document.getElementById("dep_time_box").min = y + "-" + ((m.length == 1)? ("0") : ("")) +  m + "-" + ((d.length == 1)? ("0") : ("")) +  d;




