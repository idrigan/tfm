
var Spotify = {
    search: function search( value ){

    }
};


/**
 * Objeto simple para realizar llamadas AJAX.
 */
var AJAX = {
    request: function request(method,url,value){
        var xhr = new XMLHttpRequest();
        xhr.open(method, url, false);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify({value:value}));

        return xhr.responseText;
    }
}
