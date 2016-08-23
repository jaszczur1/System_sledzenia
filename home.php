
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Strona glowna</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

        <script src="http://maps.googleapis.com/maps/api/js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="json.js"></script>
        
        <style>
            #content{
                word-wrap:break-word;
            }
            #logo{
                text-align: center;
            }
            #googleMap{ 
                padding-bottom: 45%;               
            } 
        </style>
    </head>
    <body>
          <div id='content' class="container-fluid">
            <div id='logo'>
               System sledzenia jednostek trakcyjnych dla potrzeb kolei podmiejskiej
            </div>
            <div class="row">
                <div id="googleMap" class="col-lg-8">
                    miejsce na google maps
                </div>

                <div id="table" class="col-lg-4">
                    <table class="table">
                        <thead>
                            <tr id="naglowa_tabeli">
                                <th id="Status">Status</th>
                                <th id="Nazawa_Urzadzenia">Nazawa Urzadzenia</th>
                                <th id="Trasa">Trasa</th>
                                <th id="Predkość">Predkość</th>
                            </tr>
                        </thead>
                        <tbody id="table_boot_status">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id='footer'>
            Projekt pracy dyplomowej
        </div>
        <div id="logi">
           
        </div>       
        <div id="logi_baza">
            </div>       
    </body>
</html>
