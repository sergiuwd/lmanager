<?php
	include_once("php_includes/check_login_status.php");
	if(isset($_POST["submit"])){
		if(isset($_POST["nume"]) && $_POST["nume"] != "" && isset($_POST["suma"]) && $_POST["suma"] != "" && isset($_POST["tip"]) && $_POST["tip"] != ""){
			include_once("php_includes/db_conx.php");
			$nume = $_POST["nume"];
			$date = date("d-m-Y");
			$suma = $_POST["suma"];
			$tip = $_POST["tip"];
			$checksql = mysqli_query($db_conx, "SELECT * FROM persoane WHERE nume='$nume'");
			$checkres = mysqli_num_rows($checksql);
			if($checkres > 0) {
				$mtype = "error";
				$message = "Persoana exista deja in baza de date!";
			} else {
				$sql = "INSERT INTO persoane (id, nume, tip_plata, valoare, status, parent, data) VALUES ('', '$nume', '$tip', '$suma', 'a', '14', '$date')";
				$do_query = mysqli_query($db_conx, $sql);
				if($do_query) {
					$mtype = "success";
					$message = "Persoana a fost adaugata cu succes!";
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

    <title>Adauga Persoana - LManager</title>

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
                    <h1 class="page-header">Adauga persoane</h1>
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
                                            <label>Nume</label>
                                            <input class="form-control" name="nume" placeholder="Prenume Nume">
                                        </div>

										<div class="form-group">
                                            <label>Tip plata</label>
																						<div class="radio">
                                                <label>
                                                    <input type="radio" name="tip" id="optionsRadios2" value="zi" checked>Pe zi
                                                </label>
                                            </div>
																						<div class="radio">
                                                <label>
                                                    <input type="radio" name="tip" id="optionsRadios1" value="ora">Pe ora
                                                </label>
                                            </div>
																						<div class="radio">
                                                <label>
                                                    <input type="radio" name="tip" id="optionsRadios1" value="sapt">Saptamanal
                                                </label>
                                            </div>
											 											<div class="radio">
                                                <label>
                                                    <input type="radio" name="tip" id="optionsRadios1" value="2pluna">De 2 ori pe luna
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="tip" id="optionsRadios1" value="luna">Lunar
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Suma</label>
											<div class="input-group">
												<input type="numeric" name="suma" class="form-control" placeholder="XXXX">
												<div class="input-group-addon">RON</div>
											</div>
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
