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
           <!-- <img id="logo" src="http://apex.apengage.io/img/apengage_logo.png" style="width: 100px; margin: 20px;"/> -->
          </div>

          <div id="title" style="width: 99.7%; border:1px solid; border-color:  #dfe0df;">
           <!-- <img src="http://apex.apengage.io/img/apengage_background.png" style="width:100%; max-width: 600px;"/>-->
            <h1 style="text-align:center; font-family: 'Lato', sans-serif;">New User/Company Request</h1>
          </div>
          
          <div id="content" style="width: 99.7%; border:1px solid; border-color:  #dfe0df;">
            <div id="text_content" style="width:  90%; margin:0 auto;">

                <h2 style="font-family: 'Lato', sans-serif;">{{$fname}} {{$lname}} has requested user access to your platform</h2>
                <h3 style="font-family: 'Lato', sans-serif;">sign up details are below:</h3>
                
                <ul>
                  <li style="font-family: 'Lato', sans-serif;">First Name - {{$fname}}</li>
                  <li style="font-family: 'Lato', sans-serif;">Last Name - {{$lname}}</li>
                  <li style="font-family: 'Lato', sans-serif;">Email - {{$email}}</li>
                   <li style="font-family: 'Lato', sans-serif;">Phone no. - {{$phone}}</li>
                  <li style="font-family: 'Lato', sans-serif;">Company - {{$company}}</li>
                </ul>
                <p>
                  Please review this point of contact.  When you are ready to give login/account access, approve them .
                </p>
            
                  {{ Form::open([
                     "route"        => "import company",
                     "autocomplete" => "off",
                     'method' =>'POST'
                     ]) }}
                {{Form::hidden('email', $email, ["id"=>"placeLogin", 'class' => 'form-control hidden'])}}
                {{Form::hidden('company', $company, ["id"=>"placeLogin", 'class' => 'form-control hidden'])}}
                {{Form::hidden('fname', $fname, ["id"=>"placeLogin", 'class' => 'form-control hidden'])}}
                {{Form::hidden('lname', $lname, ["id"=>"placeLogin", 'class' => 'form-control hidden'])}}  
               
                 {{Form::button('Approve', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
    
                {{form::close()}}
               <!-- <a href="{{URL::to('autoAdd', array('fname' => $fname, 'lname' => $lname, 'email' => $email, 'company'=>$company))}}"><p style="font-family: 'Lato', sans-serif;">Add this User to the system?  User will be added with staff permissions by default.</p></a>-->

            </div>
          </div>

          <div id="footer" style="width: 99.7%; border:1px solid; border-color:  #dfe0df;">
           
          </div>

      </div>

  </body>
</html>