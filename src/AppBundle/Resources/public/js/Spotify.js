(function() {
    Spotify = {
        api_url: "http://box.example.com:8000/api/spotify/search",
        api_send_response:"http://box.example.com:8000/api/spotify/response",

        search: function search(value) {
           this.request("POST", this.api_url, value,10,this.renderResult,this.showNotification);
        },

        request : function request(method, url, value, limit, callback,errorCallback) {

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
                        errorCallback("An internal error has occurred","error");
                    }
                }
            };

            xhr.open(method, url, true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(JSON.stringify({value: value,limit:limit}));

            return xhr.responseText;
        },
        renderResult: function renderResult(result,val){
            console.log(result);
            if (result == null){
                return;
            }
            var albums  = result.albums.items;
            var artists  = result.artists.items;
            var playlists = result.playlists;
            var tracks = result.tracks.items;

            var contenedor = document.getElementById("resultados-spotiy");
            contenedor.innerHTML = "";

           /*  var divCol = document.createElement("div");
             divCol.className = "col-md-12 text-center";
             divCol.setAttribute("style","color: white;padding: 10px;font-weight: bold;");
                var label = document.createElement("label");
                label.innerHTML = "Albums";
                divCol.appendChild(label);
            contenedor.appendChild(divCol);

            this.renderAlbums(albums);

            var divCol = document.createElement("div");
            divCol.className = "col-md-12 text-center";
            divCol.setAttribute("style","color: white;padding: 10px;font-weight: bold;");
            var label = document.createElement("label");
            label.innerHTML = "Artists";
            divCol.appendChild(label);

            contenedor.appendChild(divCol);

            this.renderArtists(artists);
            */

           /*var divCol = document.createElement("div");
            divCol.className = "col-md-12 text-center";
            divCol.setAttribute("style","color: white;padding: 10px;font-weight: bold;");
            var label = document.createElement("label");
            label.innerHTML = "Songs";
            divCol.appendChild(label);

            contenedor.appendChild(divCol);*/
            console.log(this);
            Spotify.renderTracks(tracks);

           /* var divCol = document.createElement("div");
            divCol.className = "col-md-12 mb-1 text-center";
            var a =document.createElement("a");
            a.setAttribute("style","width:100%");
            a.href="/api/spotify/search-more?val="+val;
            divCol.innerHTML = "More...";
            divCol.setAttribute("style","padding: 5px;font-size: 14px;");
            a.appendChild(divCol);
            contenedor.appendChild(a);*/

            if (albums.length > 0 || artists.length > 0 || playlists.length > 0 || tracks.length > 0){
                $("#resultados-spotiy").show();
            }else{
                $("#resultados-spotiy").hide();
            }
        },
        renderAlbums: function renderAlbums(albums){

            var contenedor = document.getElementById("resultados-spotiy");
            $.each(albums,function(key,album){
                //console.log(album);
                if (key >= 10){
                    return;
                }
                var divCol = document.createElement("div");
                divCol.className = "col-md-12 mb-2";
                divCol.setAttribute("onclick","add("+JSON.stringify(album)+")");
                var divRow = document.createElement("div");
                divRow.className = "row row-result";
                var divColImg = document.createElement("div");
                divColImg.className = "col-md-3 col-xs-6 text-center no-padding";
                var img = document.createElement("img");
                if (album.images[2].url != null) {
                    img.src = album.images[2].url;
                }
                img.setAttribute("alt",album.name);
                img.setAttribute("title",album.name);
                img.setAttribute("width", '50px');
                divColImg.appendChild(img);
                var divColInfo = document.createElement("div");
                divColInfo.className = "col-md-9 col-xs-6 text-left no-padding";
                var labelTitle = document.createElement("label");
                labelTitle.setAttribute("style","color:white");
                labelTitle.innerHTML = album.name;
                divColInfo.appendChild(labelTitle);
                divRow.appendChild(divColImg);
                divRow.appendChild(divColInfo);
                divCol.appendChild(divRow);
                contenedor.appendChild(divCol);
            });
        },
        renderArtists: function renderArtists(artists){

            var contenedor = document.getElementById("resultados-spotiy");
            $.each(artists,function(key,artist){
                //console.log(album);
                if (key >=2){
                    return;
                }
                var divCol = document.createElement("div");
                divCol.className = "col-md-12 mb-2";
                var divRow = document.createElement("div");
                divRow.className = "row row-result";
                var divColImg = document.createElement("div");
                divColImg.className = "col-md-3 col-xs-6 text-center no-padding";
                var img = document.createElement("img");
                if ( artist.images != null) {
                    img.src = artist.images[2].url;
                }
                img.setAttribute("alt",artist.name);
                img.setAttribute("title",artist.name);
                img.setAttribute("width", '50px');
                divColImg.appendChild(img);
                var divColInfo = document.createElement("div");
                divColInfo.className = "col-md-9 col-xs-6 text-left no-padding";
                var labelTitle = document.createElement("label");
                labelTitle.setAttribute("style","color:white");
                labelTitle.innerHTML = artist.name;
                divColInfo.appendChild(labelTitle);
                divRow.appendChild(divColImg);
                divRow.appendChild(divColInfo);
                divCol.appendChild(divRow);
                contenedor.appendChild(divCol);
            });
        },
        renderTracks: function renderTracks(tracks){
            var contenedor = document.getElementById("resultados-spotiy");
            $.each(tracks,function(key,track){
                if (key >=10){
                    return;
                }
                var divCol = document.createElement("div");
                divCol.setAttribute("data-id",track.id);
                divCol.className = "col-md-12 addSong mb-2";
                divCol.addEventListener("click",selectedSong,false);
                divCol.setAttribute("onclick","selectedSong('"+ track.id +"','" + track.name + "','" + track.uri + "')");

                var divRow = document.createElement("div");
                divRow.className = "row row-result";
                var divColImg = document.createElement("div");
                divColImg.className = "col-md-3 col-xs-6 text-center no-padding";
                var img = document.createElement("img");
                if (track.album.images[2].url != null) {
                    img.src = track.album.images[2].url;
                }
                img.setAttribute("width", '50px');
                img.setAttribute("alt",track.name);
                img.setAttribute("title",track.name);
                divColImg.appendChild(img);
                var divColInfo = document.createElement("div");
                divColInfo.className = "col-md-9 col-xs-6 text-left no-padding";
                var labelTitle = document.createElement("label");
                labelTitle.setAttribute("style","color:white");
                labelTitle.innerHTML = track.name;
                var p = document.createElement("p");
                p.innerHTML = track.album.name;
                divColInfo.appendChild(labelTitle);
                divColInfo.appendChild(p);
                divRow.appendChild(divColImg);
                divRow.appendChild(divColInfo);
                divCol.appendChild(divRow);
                contenedor.appendChild(divCol);
            });
        },
        showNotification: function showNotification(message,type){
            $.notify(message,type,{position: "top right"});

        },
        addMessage: function addMessage(element,idComment){
            var parent = element.parentNode;


            if (document.getElementById("response") != null){
                var contenedor = document.getElementById("response").parentNode;
                console.log(contenedor);
                contenedor.setAttribute("style","border-bottom:1px solid darkgray");
                contenedor.className = "mb-4";
                contenedor.removeChild(document.getElementById("response"));


                var divButton = document.createElement("div");
                divButton.className = "col-12 text-center mb-3";
                divButton.setAttribute("style","border:1px solid darkgray;padding: 5px;");
                var buttonAdd = document.createElement("button");
                buttonAdd.className ="btn btn-primary";
                buttonAdd.setAttribute("style","font-size:12px;cursor: pointer;");
                buttonAdd.setAttribute("onclick","addMessage("+buttonAdd+","+idComment+");");
                buttonAdd.textContent = 'Add answer';

                divButton.appendChild(buttonAdd);

                contenedor.appendChild(divButton);
            }

            var div = document.createElement("div");
            div.id="response";

            element.setAttribute("style","display:none");
            var input = document.createElement("textarea");
            input.id="text-area-respuesta";
            input.setAttribute("style","width:100%;padding-left: 5px;");
            input.setAttribute("placeholder","Add your response...");
            input.rows="3";
            var row= document.createElement("div");
            row.className = "col-12 text-right no-padding";
            var btn= document.createElement("button");
            btn.textContent = "Send";
            btn.setAttribute("type","submit");
            btn.className="btn btn-primary";
            btn.setAttribute("onclick","Spotify.sendAnswer("+idComment+");");
            row.appendChild(btn);
            div.appendChild(input);
            div.appendChild(row);

            parent.appendChild(div);
        },
        sendAnswer: function sendAnswer(idComment){
            var textArea = document.getElementById("text-area-respuesta");

            var data = Array(idComment,textArea.value);

            this.request("POST", this.api_send_response,data ,0,this.renderResponse,this.showNotification);
        },
        renderResponse: function renderResponse(data){
            window.location.href = "/home";
        }



    };




}());