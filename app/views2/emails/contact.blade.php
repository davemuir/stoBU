<?php
//welcome email body
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  </head>
  <body style="background-color:#b7b9bb;"> <!-- change all image paths from hosting when site goes up -->

      <div id="content" style="background-color: white; margin: 0 auto; width:100%; max-width: 600px;">
        
        <div id="header" style="width:  100%; height: 50px;">
          <img id="logo" src="http://apex.apengage.io/img/apengage_logo.png" style="width: 100px; margin: 20px;"/>
        </div>

        <div id="title" style="width: 99.7%; border:1px solid; border-color:  #dfe0df;">
          <img src="http://apex.apengage.io/img/apengage_background.png" style="width:100%; max-width: 600px;"/>
          <h1 style="text-align:center; font-family: 'Lato', sans-serif;">ApEngage Contactee</h1>
        </div>
        
        <div id="content" style="width: 99.7%; border:1px solid; border-color:  #dfe0df;">

          <div id="text_content" style="width:  90%; margin:0 auto;">

  
            <ul>
              <li style="font-family: 'Lato', sans-serif;">Name - {{$name}}</li>
              <li style="font-family: 'Lato', sans-serif;">subject - {{$subject}}</li>
              <li style="font-family: 'Lato', sans-serif;">Email - {{$email}}</li>
            </ul>

            <p style="font-family: 'Lato', sans-serif;">{{$text}}</p>

          </div>

        </div>

        <div id="footer" style="width: 99.7%; border:1px solid; border-color:  #dfe0df;">
          <img id="logo" src="http://apex.apengage.io/img/apengage_logo.png" style="width: 100px; margin: 20px auto auto 40%;"/>
        </div>

      </div>

  </body>
</html>