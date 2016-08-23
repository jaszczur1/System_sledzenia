<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <style >
        #logo {text-align: center; 
               font-size: x-large;
               padding-top: 10px;
               padding-bottom: 35px;
        }
        #form{
            padding-left: 15%;
        }
        #image{

        }
        #pass{

        }

    </style>
    <body>  
        <div class="container">

            <div id='logo' >   System sledzenia jednostek trakcyjnych dla potrzeb kolei podmiejskiej
            </div>
            <div class="row">

                <div id='image' class="col-lg-8" >

                    <img src="image/pociąg.JPG">
                </div>
                <div id="form" class="col-lg-4">
                    <form action="zaloguj.php" method="POST">
                        login :  <br>
                        <input type="text" name="login"> 
                        <br>
                        password : <br>
                        <input id="pass" type="password" name="password">
                        <br><br>
                        <input type="submit" value="ok">
                    </form>
                </div>
            </div>
        </div>


    </body>

</html>