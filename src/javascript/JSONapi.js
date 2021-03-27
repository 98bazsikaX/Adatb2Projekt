//const { resolve } = require("path");

class JSONapi{
    /*
    még nem mükszik de pusholom :(
    @98bazsikaX
    @param {string} api_url - A felhasznalando PHP API helye
    @param {object} post_msg - POST-ra szant uzenet, obj formatumban ( var x = {y:3,a:42,c:'asd'}  )
    */
    constructor(api_url,post_msg){
        api_url = "API/" + api_url;
        this._xhttp = new XMLHttpRequest();
        this._post_msg = "";        
        this._result ="asd";
        var keys = Object.keys(post_msg);
        for(const key in keys){
            this._post_msg += String(key) + "=" + String(post_msg[key]) + "&";
        }
        this._post_msg = this._post_msg.slice(0,-1);

        this._xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response); //Asyncre megfogom oldani xd
                Promise.resolve(this.responseText)
            }else{
                Promise.reject("Not working");

            }
        }
        
                
        this._xhttp.open('POST',api_url,true);
        this._xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this._xhttp.send(this._post_msg);
        this._result = this._xhttp.response ;
    }

    get result(){
        var asd = await this
    }

    set result(something){/* Azert hogy biztos ne lehessen belenyulni a resultba*/}

}