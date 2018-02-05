(function() {

     Friends = {
        api_url : "/friends/search",
        api_friend_accept: "/friends/add",
        api_friend_cancel: "/friends/cancel-friend",
        api_send_invitation: "/friends/send-invitation",
        search : function search(value) {
            this.request("POST", this.api_url, value,5,this.renderSearch);
        },
        renderSearch: function renderSearch(data,value){

            var resul = document.getElementById("resultados");
            resul.innerHTML="";
            resul.setAttribute("style","display:block");

            let divContenedor;

            if (data.length == 0){
                divContenedor = document.createElement('div');
                divContenedor.className = 'col-md-12 resultados';
                var divRow = document.createElement('div');
                divRow.className = "row";
                var divColImg = document.createElement("div");
                divColImg.className = "col-md-12 col-xs-12 text-center";
                //divContenedor.addEventListener("click",sendInvitation,false);
                divContenedor.setAttribute("style","cursor:pointer");
                divContenedor.setAttribute("onclick","Friends.sendInvitation('"+ value +"')");
                var span = document.createElement("span");
                span.innerHTML = "Send Notification: " + value;
                divColImg.appendChild(span);
                divRow.appendChild(divColImg);
                divContenedor.appendChild(divRow);
                resul.appendChild(divContenedor);
                console.log(resul);
            }else {


                $.each(data, function (key, val) {
                    console.log(val);
                    if (key < 5) {
                        if (val.b_connect == "0") {
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

                            divColConnect.className = "col-md-2 text-right";
                            divColConnect.setAttribute("style", "padding-top:10px;");
                            var a = document.createElement("a");
                            a.href = "/friends/add/" + val.id;
                            a.setAttribute("style", "font-size:12px;color:#0275d8;padding-right:15px;");
                            var i = document.createElement("i");
                            i.setAttribute("style", "font-size:16px");
                            i.className = "fa fa-plus-circle";
                            a.appendChild(i);
                            divColConnect.appendChild(a);


                            divRow.appendChild(divColImg);
                            divRow.appendChild(divColInfor);
                            divRow.appendChild(divColConnect);
                            divContenedor.appendChild(divRow);

                            resul.appendChild(divContenedor);
                        }
                    }
                });
                /*var divMore = document.createElement("div");

                if (data.length >= 5) {

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
                }*/
              //  console.log(divContenedor);
              //  divContenedor.appendChild(divMore);
            }

        },
        request : function request(method, url, value, limit, callback) {

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    var result = xhr.responseText;
                    result = JSON.parse(result);
                    if (result.response == "OK"){
                        //result.data;
                        callback(result.data,value);
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
        },
        sendInvitation: function sendNotification(value){
            this.request("POST",this.api_send_invitation,value,0,this.showNotification);
        },
        renderNotifications: function renderNotifications(friendsNotifications){
            var divFriends = document.getElementById("resultados-friend");

            var style = window.getComputedStyle(divFriends);
            if (style.display === 'block'){
                divFriends.style.display="none";
                return;
            }
            divFriends.innerHTML = "";

            if (friendsNotifications.length >0) {
                divFriends.style.display = "block";
            }

            for (var i=0;i<friendsNotifications.length;i++){
                var field = friendsNotifications[i];

                var divContenedor = document.createElement('div');
                divContenedor.className = 'row p-1 mb-2';
                    var divCol3 = document.createElement('div');
                    divCol3.className = "col-3";
                        var divImg = document.createElement("div");
                        divImg.setAttribute("style","border:1px solid black;border-radius: 100%;overflow-x: hidden;width:60px;margin:0 auto;");
                            var img = document.createElement("img");
                            img.src = field.image;
                            img.setAttribute("width", "100%");
                        divImg.appendChild(img);
                    divCol3.appendChild(divImg);
                    var divCol9 = document.createElement("div");
                    divCol9.className ="col-9 text-white";
                        var label = document.createElement("label");
                        label.innerHTML = field.email;
                    divCol9.appendChild(label);
                        var divRow = document.createElement("div");
                        divRow.className ="row";
                            var divCol6Accept = document.createElement("div");
                            divCol6Accept.className ="col-6";
                                var labelAccept = document.createElement("label");
                                labelAccept.setAttribute("onclick","Friends.acceptInvitation('"+ field.id +"')");
                                labelAccept.setAttribute("style","color:darkgreen;cursor:pointer;");
                                labelAccept.innerHTML = '<i class="fa fa-check"></i> Accept';
                            divCol6Accept.appendChild(labelAccept);
                        divRow.appendChild(divCol6Accept);
                            var divCol6Cancel = document.createElement("div");
                            divCol6Cancel.className ="col-6";
                                var labelRemove = document.createElement("label");
                                labelRemove.setAttribute("style","color:darkred;cursor:pointer;");
                                labelRemove.setAttribute("onclick","Friends.cancelInvitation('"+ field.id +"')");
                                labelRemove.innerHTML = '<i class="fa fa-remove"></i> Cancel';
                            divCol6Cancel.appendChild(labelRemove);
                        divRow.appendChild(divCol6Cancel);
                    divCol9.appendChild(divRow);
                divContenedor.appendChild(divCol3);
                divContenedor.appendChild(divCol9);
                divFriends.appendChild(divContenedor);
            }

            var divCol12 = document.createElement("div");
            divCol12.className = "col-12 text-center p-2";
            divCol12.setAttribute("style","border-top:1px solid lightgray;");
            var a = document.createElement("a");
            a.setAttribute("href","/friends");
            a.innerHTML="show my friends";
            divCol12.appendChild(a);


            divFriends.appendChild(divCol12);
        },
        acceptInvitation: function acceptInvitation(id){
            this.request("POST",this.api_friend_accept+"/"+id,'',0,this.showNotification);
            window.location.href = "/friends";
        },
        cancelInvitation: function cancelInvitation(id){
           this.request("POST",this.api_friend_cancel+"/"+id,'',0,this.showNotification);
            window.location.href = "/friends";
        }

    }



}());