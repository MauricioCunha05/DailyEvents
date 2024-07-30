<?php
session_start();
unset($_SESSION);
session_destroy();
?>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!-- Include the above in your HEAD tag -->

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>

@media (min-width:1100px){
  #login {
  padding-left: 0%;
}
.container {
  height: 100%;
  display: flex;
    flex-wrap: wrap;
    align-content: center;
    flex-direction: row;

}

#login form {
    width: 100%;
}

#login form input[type="text"], input[type="password"] {

    width: 80%;
}

}



@media (min-width:100px) and (max-width:1100px){

  .container {
    display: flex;
    flex-direction: column-reverse;
    }

    #login {
      width: 100%;
      
}

div#login {
    width: 100%;
    padding-left: 0px;

}

#login form {
    width: 100%;
}


#login form input[type="text"], input[type="password"] {

    width: 92%;
    font-size: 20px;

}



.logo{
  width: 100%;
  display: flex;
    place-content: center;
  padding-bottom: 1em;
}
a {
  font-size: 30px;
}



#login form input[type="submit"] {

    height: 56px;
}

  .col-md-7{
    width: 100%;
  }

}



@media (min-width: 1000px) and (max-width:1200px){
  #login form input[type="text"], input[type="password"] {

width: 60%;
}
div#login {
    width: 49%;
}
#login {
    padding-left: 9%;
}
#login form input[type="text"], input[type="password"] {

width: 100%;
}
}







</style>
</head>

<body>
<div class="main">
    <div class="container">
      <div id="login">

      <?php
      if(!empty($_GET['invalid']) && $_GET['invalid'] = 'true'){
        echo '	<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size:20px">
                  Login inválido.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
      }
      ?>
        <form action="valida.php" method="post">


          <div class="row">
          <div class="form-group col-md-12 col-sm-4">

          <span class="fa fa-user"></span><input type="text"  Placeholder="Usuário" name="usuario" id="txUsuario" style="font-size:20px" required> <!-- JS because of IE support; better: placeholder="Username" -->
          </div>
            </div>
            <div class="row">
            <div class="form-group col-md-12 col-sm-4">

              <p><span class="fa fa-lock"></span><input type="password"  Placeholder="Senha" name="senha" id="txSenha" style="font-size:20px" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
              </div>

            </div>
            
             <div>
                                <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#" data-toggle='tooltip' data-placement='top' title='entre em contato com um administrador.'>esqueceu a senha?</a></span>
                                <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Entrar"></span>
                            </div>


<div class="clearfix"></div>
        </form>

        <div class="clearfix"></div>

      </div> <!-- end login -->
      <div class="logo"><img src="img/faetec.png" width="450" height="150" style="padding:25px" alt="">
          
          <div class="clearfix"></div>
      </div>
      
      </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>