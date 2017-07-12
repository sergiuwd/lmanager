<?php

session_start();

include_once('php_includes/db_conx.php');

if(!empty($_SESSION['user'])) 
{ 
	header("location: prezente.php");
}

if(isset($_POST['user']))
    {

		if(!empty($_POST['user']) && !empty($_POST['pass'])) {
			$username = mysqli_real_escape_string($db_conx, $_POST['user']);
			$password = mysqli_real_escape_string($db_conx, $_POST['pass']);

			 $checklogin = mysqli_query($db_conx, "SELECT * FROM users WHERE user = '".$username."' AND pass = '".$password."'");

			if(mysqli_num_rows($checklogin) == 1)
			{
				$row = mysqli_fetch_array($checklogin);
				$username = $row['user'];

				$_SESSION['user'] = $username;
				$_SESSION['LoggedIn'] = 1;

				header('location: prezente.php');
			}
			else
			{
				$message= "Userul sau parola sunt incorecte!";
			}        
		} else {   
			$message= "Completati toate spatiile!";
		}
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - LManager</title>
<style>
button:focus, input:focus{
    outline: 0;
}
</style>
    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default text-center">
					<img src="img/sigla.png" style="margin-top: 7px;">
                    <div class="panel-body">
                        <form method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User" name="user" type="text" required="required" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Parola" name="pass" type="password" value="" required="required">
                                </div>
								<?php if(isset($message)){ ?>
								<div class="alert alert-danger" role="alert">
								  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								  <span class="sr-only">Eroare:</span>
								  <?php echo $message; ?>
								</div>
								<?php } ?>
								
                                <!-- Change this to a button or input when using this as a form -->
								<input name="submit" type="submit" value="Autentificare" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
