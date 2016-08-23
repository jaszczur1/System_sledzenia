var arr = [];
var url_0 = "navi_live.php";
var url_1 = "navi_selected_trace.php";
var url_2 = "navi_history.php";
function loadDoc(url) {
    var xhttp, xmlDoc;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {

            xmlDoc = xhttp.responseText;
            arr = [];
            arr = JSON.parse(xmlDoc);
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

var map; //uchwyt do daszych funkcji

var lati = 52.341317048902575;
var lang = 21.24427283235783;
myCenter = new google.maps.LatLng(lati, lang);
function initialize() {
    var mapProp = {
        center: myCenter,
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}

var dlugosc_tabeli = 0;   // dla wszystkich tabel


var tr = "tr"; //zmienna do tworzenia wiersza
var td = "td"; // zmienna do tworzenia pola



function  wypiszCos() {
    zmienna_zegar = 2;
}


function delete_table(){
       
                var remove = document.getElementById('table_boot_status');
               
               if (document.getElementById("Stop") !== null) {
                   
                  var remove1= document.getElementById("naglowa_tabeli");
                 
                    remove1.deleteCell(-1);
                    
                    document.getElementById('Predkość').innerHTML="Predkość";
                    
               }
               
                for (var i = 0; i < dlugosc_tabeli; i++){
                    
                remove.deleteRow(0);
        
    }
            dlugosc_tabeli=0;
}

function crate_table() {
  
    if(dlugosc_tabeli > 0){
   
     delete_table();
        
    document.getElementById("logi_baza").innerHTML=dlugosc_tabeli;
}  



    for (var i = 0; i < arr.length; i++) {

            var create_tr = document.createElement("tr");
            create_tr.setAttribute("id", tr + i);
            var element0 = document.getElementById("table_boot_status");
            element0.appendChild(create_tr);
            
            create_tr.addEventListener("click", function(){
            document.getElementById("logi_baza").innerHTML = this.id;
            
                zmienna_zegar=2;
            
            for(var i=0; i<merkers.length ; i++){
            
            google.maps.event.removeListener(add_listner);
                       
            }     
});          
        for (j = 0; j < 4; j++) {

                var create_td = document.createElement("td");
                create_td.setAttribute("id", td + j);
                if (td + j === "td0") {
                    var node = document.createTextNode(arr[i].description);
                    create_td.appendChild(node);
                }
                if (td + j === "td1") {
                    var node = document.createTextNode(arr[i].boot_name);
                    create_td.appendChild(node);
                }
                if (td + j === "td2") {
                    var node = document.createTextNode(arr[i].route_name);
                    create_td.appendChild(node);
                }
                if (td + j === "td3") {
                    var node = document.createTextNode(arr[i].speed);
                    create_td.appendChild(node);
                }
                element1 = document.getElementById(tr + i);
                element1.appendChild(create_td);
           
        }
        }
        dlugosc_tabeli= i;
        }
       

var myMarker = []; // deklaracja pustej zmiennej
var merkers = [];
var add_listner;

var lati_Merker;
var lang_Merker;
var flightPath; // rysowana scieżka
var myTrip = [];
var myCenter_Trip = null; // tablica wszytkich opozycji
var lati_Trip;
var lang_Trip;
var myTrip_Warrning_1=[];
var flightPath_Warrning_1;

var selected_boot=0;     // zmienne do chwilowych porbran z bazy
var zmienna_zegar = 0; // ustawiona domyslnie


function zegar() {

    if (zmienna_zegar === 0) {     // dla strony live  
       
        loadDoc(url_0);
        
        crate_table();
       
       
        
        if (merkers.length !== 0) {
            for (z = 0; z < merkers.length; z++) {
                    
                    
                     merkers[z].setMap(null);
              
            }
             merkers= [];
        }
        

        for (var i = 0; i < arr.length; i++) {       // dodawanie merkerów do mapy , dodawanie słuchaczy oneclick

            lati_Merker = arr[i].latitude;
            lang_Merker = arr[i].longitude;
            myMarker[i] = new google.maps.LatLng(lati_Merker, lang_Merker);
            merkers[i] = new google.maps.Marker({
                position: myMarker[i],
                label: String(arr[i].id_boot),
                title: String(arr[i].id_boot)
            });
            merkers[i].setMap(map);
           
            
      add_listner=  google.maps.event.addListener(merkers[i], 'click', function () {

                alert("I am marker " + this.title);
                
                zmienna_zegar = 1;
                selected_boot = this.title;
            });   
        }
    };
    var selected_boot_id_position = 0; // zmienna do okreslenia wybarnego elementu

    if (zmienna_zegar === 1) {

    selected_boot_id_position=0;  

        delete_table();

        loadDoc(url_1);   
        
        crate_table();
        
       if (myTrip.length !== 0) {
            for (var z = 0; z < myTrip.length; z++) {
                
        
                flightPath.setMap(null);
                 flightPath_Warrning_1.setMap(null);                       
                 myTrip_Warrning_1=[];
                  myTrip=[];
            }
            
        }
                    
        for (var i = 0; i < arr.length; i++) {
   
            if (arr[i].id_boot === selected_boot && arr[i].description==="Start") {
            

                lati_Trip = arr[i].latitude;
                lang_Trip = arr[i].longitude;
            
            myCenter_Trip = new google.maps.LatLng(lati_Trip, lang_Trip);
            
               myTrip[selected_boot_id_position] = myCenter_Trip;  
          
                selected_boot_id_position++;
               
            }                
        
                 var Warrnig1=0;
                 var  myCenter_Trip_Warrning1; 
        
            if (arr[i].id_boot === selected_boot && arr[i].description ==="Warrning 1") {
            
         
                lati_Trip = arr[i].latitude;
                lang_Trip = arr[i].longitude;

                     myCenter_Trip_Warrning1 = new google.maps.LatLng(lati_Trip, lang_Trip);
                       
                      myTrip_Warrning_1[Warrnig1] = myTrip[selected_boot_id_position-1];
                      
                      Warrnig1++;
                     
          myTrip_Warrning_1[Warrnig1] = myCenter_Trip_Warrning1;
                     
                     
                 
                 
               document.getElementById('logi').innerHTML=myTrip_Warrning_1;                
                
        }
         
    }
       
            flightPath = new google.maps.Polyline({
                path: myTrip,
                strokeColor: "#0000FF",
                strokeOpacity: 0.8,
                strokeWeight: 2
            });

            flightPath_Warrning_1 = new google.maps.Polyline({
                path: myTrip_Warrning_1,
                strokeColor: "#FFFF00",
                strokeOpacity: 0.8,
                strokeWeight: 2
            });
            
        flightPath.setMap(map);   
        
        flightPath_Warrning_1.setMap(map);          
              
            map.setZoom(13);
            map.setCenter(myTrip[myTrip.length-1]);
              
 
        google.maps.event.addListener(flightPath, 'mouseover', function() {
  
        flightPath.setMap(null);
        flightPath_Warrning_1.setMap(null);   
                myTrip=[];
                 arr=[];
            
            map.setZoom(11);
            map.setCenter(myCenter);
            zmienna_zegar=0;
     
    });
      
 //      merkers[merkers.length-1].setMap(null);
     
    if (merkers.length !== 0) {
            for (z = 0; z < merkers.length; z++) {
                               
                     merkers[z].setMap(null);
            }
             merkers= [];
        }
      
  }
    
    if (zmienna_zegar === 2) {

        
        loadDoc(url_2);
        
        delete_table();
        
        document.getElementById('Predkość').innerHTML = "Start";

        if (document.getElementById("Stop") === null) {
            
            var create_th_Stop = document.createElement("th");
            create_th_Stop.setAttribute("id", "Stop");


            var row = document.getElementById("naglowa_tabeli");

            row.appendChild(create_th_Stop);
            var node = document.createTextNode("Stop");
            create_th_Stop.appendChild(node);
          
        }


            for (dlugosc_tabeli = 0; dlugosc_tabeli < arr.length; dlugosc_tabeli++) {

            var create_tr = document.createElement("tr");
            create_tr.setAttribute("id", tr + dlugosc_tabeli);

            var element0 = document.getElementById("table_boot_status");
            element0.appendChild(create_tr);

                create_tr.addEventListener("click", function(){
            
            zmienna_zegar=0;
});


                   for (j = 0; j < 5; j++) {
    
                var create_td = document.createElement("td");
                create_td.setAttribute("id", td + j);

                if (td + j === "td0") {
                    var node = document.createTextNode(arr[dlugosc_tabeli].description);
                    create_td.appendChild(node);
                }
                if (td + j === "td1") {
                    var node = document.createTextNode(arr[dlugosc_tabeli].boot_name);
                    create_td.appendChild(node);
                }
               if (td + j === "td2") {
                    var node = document.createTextNode(arr[dlugosc_tabeli].route_name);
                   create_td.appendChild(node);
                }
                if (td + j === "td3") {
                    var node = document.createTextNode(arr[dlugosc_tabeli].date_event);
                    create_td.appendChild(node);
                }
                if (td + j === "td4") {
                    var node = document.createTextNode(arr[dlugosc_tabeli].date_event);
                    create_td.appendChild(node);
                }
                
                element1 = document.getElementById(tr + dlugosc_tabeli);
                element1.appendChild(create_td);
            }
 
}
    }

    setTimeout("zegar()", 2500);
}

zegar();
google.maps.event.addDomListener(window, 'load', initialize);

            