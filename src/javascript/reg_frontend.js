class reg_data{
    /*
    * Osztaly azert hogy konyebb legyen json objektumma alakitani a regisztracio adatait
    * e :  {string} : email
    * p :  {string} : password
    * pa : {string} : password for checking
    */
    constructor(e,p,pa) {
        this.email = e;
        this.password = p;
        this.passwordAgain = pa;
    }
}

function register(){
    /*Adatok felkeszitese*/
    let email = document.getElementById("r_email").value;
    let pwd = document.getElementById("r_password").value;
    let passwordConf = document.getElementById("pwd_again").value;
    let data = JSON.stringify(new reg_data(email,pwd,passwordConf));

    /*API CALL*/
    var request = new XMLHttpRequest();
    request.open('POST','../php/API/login_API.php',false); //nem async mert nem akarok callbackel szenvedni
    request.setRequestHeader("CONTENT-TYPE","application/json");
    request.send(data);

    if(request.status==200){
        if(request.responseText){
            console.log(request.responseText); //debug miatt
            alert("Sikeres regisztráció!");
        }else{
            alert(request.responseText);
        }
    }else{
       alert("Hiba tortent!");
    }

}