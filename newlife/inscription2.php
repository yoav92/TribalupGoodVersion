<?php
session_start();
require_once 'php/functions.php';
require_once 'php/db.php';


if(!empty($_POST)){
  $errors = array();


  if(empty($_POST['username'])){ //check the name

		$errors[] = "Your last name is invalid";

	} 
	if(empty($_POST['userprenom'])){ 

		$errors[] = "Your first name is invalid";

	} 

  if(empty($_POST['email'])){

    $errors[] = "Your email is invalid";

  } else {

    $req = $pdo->prepare('SELECT id FROM members WHERE email = ?');

    $req->execute([$_POST['email']]);

    $user = $req->fetch();

    if($user){

      $errors[]= 'This email is already used for another account';
    }
  }


  if(empty($_POST['password'])){

    $errors[] = "Your password is invalid";

  }

  if($_POST['situation']=='What is your current situation?' ){

    $errors[] = "Choose one situation";

  }


  if(empty($errors)){   

    register($_POST['username'],$_POST['userprenom'] ,$_POST['password'] ,$_POST['email'],1);

    $reqq = $pdo ->prepare ("INSERT INTO info_members_no_pro SET id_members=?,situation = ? ");

    $reqq->execute([$_SESSION['id'],$_POST['situation']]);

    header('location: login.php');

    exit();

  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sign in to TribalUp</title>
    <link rel="stylesheet"  href="design/css/design.css">
    <link rel="stylesheet" href="design/css/bootstrap.min.css">
    <link rel="stylesheet" href="design/css/bootstrap-theme.min.css" >
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js" ></script>
  <script type="text/javascript" language="Javascript" src="js/jquery-3.2.1.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
  
    var $nom = $('#nom'),
        $mdp = $('#mdp'),
        $mail = $('#mail'),
        $erreur = $('#erreur'),
        $champ = $('.champ');
        $champe = $('.champe');

    $champ.keyup(function(){
        if($(this).val().length < 6){ // si la chaîne de caractères est inférieure à 5
          $("#mdp").next(".error-message").show().text("Your password must contain at least 6 characters");
            $(this).css({ // on rend le champ rouge
                borderColor : 'red',
          color : 'red'
            });
            
         }
         else{
          $("#mdp").next(".error-message").hide().text("");
             $(this).css({ // si tout est bon, on le rend vert
           borderColor : 'green',
           color : 'green'
       });
             
         }
         
    });


     $champe.keyup(function(){
        if($(this).val().length < 2){ // si la chaîne de caractères est inférieure à 5
            $(this).css({ // on rend le champ rouge
                borderColor : 'red',
          color : 'red'
            });
            
         }
         else{
             $(this).css({ // si tout est bon, on le rend vert
           borderColor : 'green',
           color : 'green'
       });
             
         }
         
    });
          
    $("#mail").keyup(function(){
          if(!$("#mail").val().match(/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/)){
            $("#mail").next(".error-message").show().text("Please enter a valid email address");
            $("#mail").css("border-color","#FF0000");
            
          }
          else{ 
            $("#mail").next(".error-message").hide().text("");
            $("#mail").css("border-color","green");
            
          }
          
        });
    $("#nom").keyup(function(){
          if($("#nom").val() == "" ){
            $("#nom").next(".error-message").show().text("What is your last name?");
            $("#nom").css("border-color","#FF0000");
          
          }
          else{ 
            $("#nom").next(".error-message").hide().text("");
            
          }
          
        });
    $("#prenom").keyup(function(){
          if($("#prenom").val() == "" ){
            $("#prenom").next(".error-message").show().text("What is your first name?");
            $("#prenom").css("border-color","#FF0000");
          
          }
          else{ 
            $("#prenom").next(".error-message").hide().text("");
            
          }
          
        });
$("#metier").keyup(function(){
          if($("#metier").val() == "" ){
            $("#metier").next(".error-message").show().text("What is your profession?");
            $("#metier").css("border-color","#FF0000");
            
          }
          else{ 
            $("#metier").next(".error-message").hide().text("");
            
          }
          
        });

     

   //////////////////////////////////

   var result="";

$('#password').keyup(function(){

  var password = $(this).val();
  password=$.trim(password);
  var lettre_min = /[a-z]/;
  var lettre_maj = /[A-Z]/;
  var nombre = /[0-9]/;

    if(password.length != 0)
    {
      $('.error').hide();

      //password faible
        if((password.match(lettre_min)) && password.length < 5)
        {
          $('.bar').animate({width:'10%'},200).show();
          $('.bar').css('background-color','red').show();
          $('.bar').text('Faible').show();
          $('.pass').css("border-color","red");
          result="faible";
        }
        else if((password.match(lettre_maj)) && password.length < 5)
        {
          $('.bar').animate({width:'10%'},200).show();
          $('.bar').css('background-color','red').show();
          $('.bar').text('Faible').show();
          $('.pass').css("border-color","red");
          result="faible";
        }
        else if((password.match(nombre)) && password.length < 5)
        {
          $('.bar').animate({width:'10%'},200).show();
          $('.bar').css('background-color','red').show();
          $('.bar').text('Faible').show();
          $('.pass').css("border-color","red");
          result="faible";
        }
      //password moyen
        else if((password.match(lettre_min)) && (password.match(lettre_maj)) && password.length >= 6 && password.length<=8)
        {
          $('.bar').animate({width:'15%'},200).show();
          $('.bar').css('background-color','orange').show();
          $('.bar').text('Moyen').show();
          $('.pass').css("border-color","orange");
          result="moyen";
        }
        else if((password.match(nombre)) && (password.match(lettre_maj)) && password.length >= 6 && password.length<=8)
        {
          $('.bar').animate({width:'15%'},200).show();
          $('.bar').css('background-color','orange').show();
          $('.bar').text('Moyen').show();
          $('.pass').css("border-color","orange");
          result="moyen";
        }
        else if((password.match(lettre_min)) && (password.match(nombre)) && password.length >= 6 && password.length<=8)
        {
          $('.bar').animate({width:'15%'},200).show();
          $('.bar').css('background-color','orange').show();
          $('.bar').text('Moyen').show();
          $('.pass').css("border-color","orange");
          result="moyen";
        }
        else if( password.length >=10)
        {
          $('.bar').animate({width:'15%'},200).show();
          $('.bar').css('background-color','orange').show();
          $('.bar').text('Moyen').show();
          $('.pass').css("border-color","orange");
          result="moyen";
        }else if((password.match(lettre_min)) && (password.match(nombre)) && (password.match(lettre_maj)) && password.length >= 5 && password.length<=7)
        {
          $('.bar').animate({width:'20%'},200).show();
          $('.bar').css('background-color','orange').show();
          $('.bar').text('moyen').show();
          $('.pass').css("border-color","orange");
          result="moyen";
        }
      //password fort
        else if((password.match(lettre_min)) && (password.match(nombre)) && (password.match(lettre_maj)) && password.length > 7)
        {
          $('.bar').animate({width:'20%'},200).show();
          $('.bar').css('background-color','green').show();
          $('.bar').text('Fort').show();
          $('.pass').css("border-color","green");
          result="fort";
        }
        else if(password.length >= 12)
        {
          $('.bar').animate({width:'20%'},200).show();
          $('.bar').css('background-color','green').show();
          $('.bar').text('Fort').show();
          $('.pass').css("border-color","green");
          result="fort";
        }

    }
    else
    {
      $('.bar').hide();
      $('.error').fadeIn().text("Please enter your password");
      $('.pass').css("border-color","#FF0000");
      result="vide";
    }

});







});
</script>
  </head>
  <body>

<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="index.php">
    <img src="design/icone/logo_tribalup" WIDTH=90 HEIGHT=80/>
     Tribalup
  </a>
  <ul class="nav-item active">
          <a  class="btn btn-outline-success" href="connexion.php" >Already have an account? Log in</a>

   </ul>
   
</nav>
<div class="text-center autr"><span class="tai">Join TribalUp now and find your professional vocation.</span></div>
   

    <?php if(!empty($errors)): ?>

    <div class="alert alert-danger">

      <p>You have not completed the form correctly</p>

      <ul>

        <?php foreach ($errors as $error): ?>

          <li><?= $error; ?></li>
        
        <?php endforeach; ?>

      </ul>

    </div>

    <?php endif; ?>

<form method="POST" action="">
  <div class="container-fluid">
    <div class="row">
    <div class="col-3"></div>
      <div class="col-3"><input class="form-control autreee champe" type="text" name="username" id="nom" placeholder="Last name" ><span class="error-message">erreur</span></div>
      <div class="col-3"><input class="form-control autreee champe" type="text" name="userprenom" id="prenom" placeholder="First name" ><span class="error-message">erreur</span></div>
      <div class="col-3"></div>
  </div>
  <div class="row">
    <div class="col-3"></div>
      <div class="col-6"><input class="form-control autreee" type="email" name="email" id="mail" placeholder="Email address" ><span class="error-message">erreur</span></div>
      <div class="col-3"></div>
  </div>
  <div class="row">
    <div class="col-3"></div>
    <div class="col-6"><input class="form-control autreee pass" type="password" name="password" id="password" placeholder="Password" >
    <span class="error"></span>
    <span class="bar"></span></div>
    <div class="col-3"></div>
  </div>
    <div class="row">
    	<div class="col-3"></div>
      <div class="col-6">
    	<select class="custom-select autreee" name="situation" id="situation">
                          <option selected>What is your current situation?</option>
                          <option value="High school">High school</option>
                          <option value="Student">Student</option>
                          <option value="Reorientation">Reorientation</option>
                          <option value="Other">Other</option>
                          </select>
      </div>
    	<div class="col-3"></div>
    </div>

    <div class="text-center autreee"><button type="submit" name="formins" class="btn btn-secondary btn-lg">Sign up</button></div>
  </div>
</forn>




</footer>
  </body>
</html>