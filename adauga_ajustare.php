<?php

	include_once("php_includes/check_login_status.php");
	if(isset($_POST["submit"])){
		if(isset($_POST["persoana"]) && $_POST["persoana"] != "" && isset($_POST["suma"]) && $_POST["suma"] != ""){
			include_once("php_includes/db_conx.php");
			$persoana = $_POST["persoana"];
			$date = date("Y-m-d");
			$suma = $_POST["suma"];
			$motiv = $_POST["motiv"];

			$sql = "INSERT INTO ajustari (id, pers_id, motiv, suma, data) VALUES ('', '$persoana', '$motiv', '$suma', '$date')";
			$do_query = mysqli_query($db_conx, $sql);
			if($do_query) {
				$mtype = "success";
				$message = "Ajustarea de <b>$suma RON</b> a fost adaugata cu succes!";
			} else {
				$mtype = "error";
				$message = "A aparut o eroare! Reincercati sau contactati un administrator.";
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

    <title>Adauga Ajustare Salariu - LManager</title>

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
                    <h1 class="page-header">Adauga ajustare salariu</h1>
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
                                            <label>Persoana</label>
											<select name="persoana" class="form-control">
											
											<?php
												
												include_once("php_includes/db_conx.php");
									
												$sql = "SELECT * FROM persoane WHERE status='a' ORDER BY nume";
												$query = mysqli_query($db_conx, $sql);
												
												while($val = mysqli_fetch_assoc($query)){
													echo "<option value='".$val['id']."'>".$val['nume']."</option>";
												}
											
											?>
											
											
											</select>
                                        </div>
										
                                        <div class="form-group">
                                            <label>Suma</label>
											<div class="input-group">
												<input type="numeric" name="suma" class="form-control" placeholder="XXXX" required>
												<div class="input-group-addon">RON</div>
											</div>
											<p class="help-block">Cu - (minus) inainte, in cazul in care doriti o scadere.</p>
                                        </div>
										<div class="form-group">
											<label>Motiv</label>
											<input type="text" name="motiv" required class="form-control">
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

</body>

</html>
