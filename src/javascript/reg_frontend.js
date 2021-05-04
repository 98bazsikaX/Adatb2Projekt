/*
* php-ban lesz megvalósítva a belépés és regisztráció session miatt!
* countries api: https://restcountries.eu/rest/v2/all
*
* main: body onload függvénye
* */
function main() {
    setCountries();
}


function setCountries(){
    let request = new XMLHttpRequest();
    request.open("GET","https://restcountries.eu/rest/v2/all");

    request.onreadystatechange = function () {
        if(this.readyState === 4 && this.status===200){
            let countries = JSON.parse(this.responseText);
            let countryOption = document.getElementById("country");
            countries.forEach(country =>{
                let option = document.createElement("option");
                option.text = country.name;
                option.value = country.name;
                countryOption.add(option);
            });
        }
    };
    request.send();

}