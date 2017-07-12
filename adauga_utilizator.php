<?php
	include_once("php_includes/check_login_status.php");
	if(isset($_POST["submit"])){
		if(isset($_POST["user"]) && $_POST["user"] != "" && isset($_POST["temp_pass"]) && $_POST["temp_pass"] != "" && isset($_POST["rank"]) && $_POST["rank"] != ""){
			include_once("php_includes/db_conx.php");
			$user = $_POST["user"];
			$tpass = $_POST["temp_pass"];
			$rank = $_POST["rank"];
			$sql = "INSERT INTO users (id, user, temp_pass, rank, status) VALUES ('', '$user', '$tpass', '$rank', 'v')";
			$checksql = mysqli_query($db_conx, "SELECT * FROM users WHERE user='$user'");
			$checkres = mysqli_num_rows($checksql);
			if($checkres > 0) {
				$mtype = "error";
				$message = "Utilizatorul exista deja in baza de date!";
			} else {
				$do_query = mysqli_query($db_conx, $sql);
				if($do_query) {
					$mtype = "success";
					$message = "Utilizatorul a fost adaugat cu succes!";
				} else {
					$mtype = "error";
					$message = "A aparut o eroare! Reincercati sau contactati un administrator.";
				}
			}
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

    <title>Adauga Utilizator - LManager</title>

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

    <div id="wrapper">
	<?php include_once("meniu.php"); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Adauga utilizator</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label>Utilizator:</label>
                                            <input class="form-control" name="user" placeholder="User" required>
											<p class="help-block">Sunt interzise spatiile.</p>
                                        </div>
										
										<div class="form-group">
                                            <label>Parola temporara:</label>
											<input id="tpass" class="form-control" name="temp_pass" placeholder="Parola temporara" required>
                                        </div>
										
										<div class="form-group">
											<div id="randgen" class="btn btn-default">Genereaza parola temporara</div>
											<p class="help-block">Utilizatorului va schimba parola temporara cu una permanenta la prima logare.</p>
										</div>
										
										<div class="form-group">
											<label>Nivelul utilizatorului:</label>
											<select name="rank" class="form-control">
												<option value="utilizator">Utilizator</option>
												<option value="moderator">Moderator</option>
												<option value="administrator">Administrator</option>
											</select>
										</div>
										
                                        <button type="reset" class="btn btn-default">Anuleaza</button>
										<button name="submit" type="submit" class="btn btn-primary">Adauga</button>
                                    </form>
									
									<?php
									if(isset($message) && isset($mtype)){
										
										if($mtype == "error"){
											?>
											<br>
											<div class="alert alert-danger" role="alert">
												<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
												<span class="sr-only">Eroare:</span>
												<?php echo $message; ?>
											</div>
											<?php
										} else if($mtype = "success"){
											?>
											<br>
											<div class="alert alert-success" role="alert">
												<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
												<span class="sr-only">Eroare:</span>
												<?php echo $message; ?>
											</div>
											<?php
										}
										
									}
									
									?>
									
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                            </div>
                            <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
	
	<!-- Random Password -->
	<script>
	$("#randgen").click(function(){

		var chars = "123456789abcdefghikmnpqrstuvwxyz";
		var string_length = 5;
		var randomstring = '';
		for (var i=0; i<string_length; i++) {
			var rnum = Math.floor(Math.random() * chars.length);
			randomstring += chars.substring(rnum,rnum+1);
		}
		$("#tpass").val(randomstring);
		
	});
	</script>

</body>

</html>
