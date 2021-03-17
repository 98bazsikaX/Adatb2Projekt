class JSONapi{
    /*
    még nem mükszik de pusholom :(
    @98bazsikaX
    @param {string} api_url - A felhasznalando PHP API helye
    @param {Map} post_msg - POST-ra szant uzenet, obj formatumban ( var x = {y:3,a:42,c:'asd'}  )
    */
    constructor(api_url,post_msg){
        this._xhttp = new XMLHttpRequest();
        this._post_msg = "";
        this._result ="asd";
        var keys = Object.keys(post_msg);
        for(const key in keys){
            this._post_msg += String(key) + "=" + String(post_msg[key]) + "&";
        }
        this._post_msg = this._post_msg.slice(0,-1);
        var x = null; //a kovetkezo blokk scopejaban a this az xhttp classra mutat, nem erre, ezert kell ez
        this._xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
            }
        }
        
                
        this._xhttp.open('POST',api_url,true);
        this._xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this._xhttp.send(this._post_msg);
        this._result = this._xhttp.response ;
    }

    get result(){
        return this._result;
    }

    
    set result(something){/* Azert hogy biztos ne lehessen belenyulni a resultba*/}

}