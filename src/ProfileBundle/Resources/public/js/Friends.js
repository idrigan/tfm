(function() {

     Friends = {
        api_url : "http://box.example.com:8000/friends/search",

        search : function search(value) {
            this.request("POST", this.api_url, value,5,this.renderSearch);
        },
        renderSearch: function renderSearch(data){

            var resul = document.getElementById("resultados");
            resul.innerHTML="";
            if (data.length > 0){
                resul.setAttribute("style","display:block");
            }
            var divContenedor;

            $.each(data,function(key,val){
                console.log(val);
                if (key < 5) {
                    divContenedor = document.createElement('div');
                    divContenedor.className = 'col-md-12 resultados';
                    var divRow = document.createElement('div');
                    divRow.className = "row";
                    var divColImg = document.createElement("div");
                    divColImg.className = "col-md-2 col-xs-12 text-center";
                    var divImg = document.createElement("div");
                    divImg.setAttribute("style", "border:1px solid black;border-radius: 100%;overflow-x: hidden;width:40px;margin:0 auto;");
                    var img = document.createElement("img");
                    img.src = "bundles/profile/img/user.png";
                    img.setAttribute("width", "40px");
                    divImg.appendChild(img);
                    divColImg.appendChild(divImg);
                    var divColInfor = document.createElement("div");
                    divColInfor.className = "col-md-8 text-left";
                    var spanEmail = document.createElement("span");
                    spanEmail.innerHTML = val.email;
                    var br = document.createElement("br");
                    var spanNick = document.createElement("span");
                    spanNick.innerHTML = val.nick;
                    spanNick.setAttribute("style", "font-size: 12px;");
                    divColInfor.appendChild(spanEmail);
                    divColInfor.appendChild(br);
                    divColInfor.appendChild(spanNick);
                    var divColConnect = document.createElement("div");
                    if (val.b_connect == "0") {
                        divColConnect.className = "col-md-2 text-right";
                        divColConnect.setAttribute("style", "padding-top:10px;")
                        var a = document.createElement("a");
                        a.href = "friends/add/" + val.id;
                        a.setAttribute("style", "font-size:12px;color:#0275d8;padding-right:15px;");
                        var i = document.createElement("i");
                        i.setAttribute("style", "font-size:16px");
                        i.className = "fa fa-plus-circle";
                        a.appendChild(i);
                        divColConnect.appendChild(a);
                    }

                    divRow.appendChild(divColImg);
                    divRow.appendChild(divColInfor);
                    divRow.appendChild(divColConnect);
                    divContenedor.appendChild(divRow);

                    resul.appendChild(divContenedor);
                }
            });
            var divMore = document.createElement("div");

            if (data.length >= 5){

                var divRowMore = document.createElement("div");
                divRowMore.className = "row";
                var divColMore = document.createElement("div");
                divColMore.className = "col-md-12 text-center";
                var aMore = document.createElement("a");
                aMore.href = "friends/more";
                aMore.setAttribute("style", "font-size:12px;color:#0275d8;padding-right:15px;");
                aMore.appendChild(document.createTextNode("More..."));
                divColMore.appendChild(aMore);
                divRowMore.appendChild(divColMore);
                divMore.appendChild(divRowMore);
            }
            console.log(divContenedor);
            divContenedor.appendChild(divMore);
        },
        request : function request(method, url, value, limit, callback) {

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    var result = xhr.responseText;
                    result = JSON.parse(result);
                    if (result.response == "OK"){
                        //result.data;
                        callback(result.data);
                    }else{
                        //MOSTRAR ERROR
                       this.showNotification("Se ha producido un error","error");
                    }
                }
            };

            xhr.open(method, url, true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(JSON.stringify({value: value,limit:limit}));

            return xhr.responseText;
        },
        showNotification: function showNotification(message,type){
            $.notify(message,type,{position: "top right"});
        }

    }



}());