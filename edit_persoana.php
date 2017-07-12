<?php
	include_once("php_includes/check_login_status.php");
	include_once("php_includes/db_conx.php");
	
	if(isset($_GET["user"])){
		
		$uid = $_GET['user'];
		
	} else {
			header("prezente.php");
	}
	
	if(isset($_POST['submit'])){
		$newnume = $_POST['nume'];
		$newtplata = $_POST['tip'];
		$newsuma = $_POST['suma'];
		$newstatus = $_POST['status'];
		$sql = "UPDATE persoane SET nume='$newnume',tip_plata='$newtplata', valoare='$newsuma', status='$newstatus'  WHERE id=$uid;";
		$query = mysqli_query($db_conx, $sql);
		if($query){
			$mtype = "success";
			$message = "Modificarile au fost salvate cu succes!";
		} else {
			$mtype = "error";
			$message = "A aparut o eroare!";
		}
		
	}
	
	if(isset($_GET["user"])){
		$uid = $_GET['user'];
		$sql = "SELECT * FROM persoane WHERE id='$uid'";
		$query = mysqli_query($db_conx, $sql);
		while ($row = mysqli_fetch_assoc($query)) {
			$nume = $row['nume'];
			$tplata = $row['tip_plata'];
			$status = $row['status'];
			$id = $row['id'];
			$suma = $row['valoare'];
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

    <title>Editare <?php echo $nume; ?> - LManager</title>

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
                    <h1 class="page-header">Editare <i><?php echo $nume; ?></i></h1>
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
                                            <input class="form-control" value="<?php echo $nume; ?>" name="nume" placeholder="Prenume Nume">
                                        </div>
										
										<div class="form-group">
                                            <label>Tip plata</label>
											<div class="radio">
                                                <label>
												<?php
												if($tplata == "zi"){
                                                    echo '<input type="radio" name="tip" value="zi" checked>Pe zi';
												} else {
													echo '<input type="radio" name="tip" value="zi">Pe zi';
												}
												?>
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
												<?php
												if($tplata == "ora"){
                                                    echo '<input type="radio" name="tip" value="ora" checked>Pe ora';
												} else {
													echo '<input type="radio" name="tip" value="ora">Pe ora';
												}
												?>
                                                </label>
                                            </div>
											 <div class="radio">
                                                <label>
												<?php
												if($tplata == "2pluna"){
                                                    echo '<input type="radio" name="tip" value="2pluna" checked>De 2 ori pe luna';
												} else {
													echo '<input type="radio" name="tip" value="2pluna">De 2 ori pe luna';
												}
												?>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
													<?php
													if($tplata == "luna"){
														echo '<input type="radio" name="tip" value="luna" checked>Lunar';
													} else {
														echo '<input type="radio" name="tip" value="luna">Lunar';
													}
													?>
                                                </label>
                                            </div>
                                        </div>
										
										
										<div class="form-group">
                                            <label>Status</label>
											<div class="radio">
                                                <label>
												<?php
												if($status == "a"){
                                                    echo '<input type="radio" name="status" value="a" checked>Activ';
												} else {
													echo '<input type="radio" name="status" value="a">Activ';
												}
												?>
                                                </label>
                                            </div>
											 <div class="radio">
                                                <label>
												<?php
												if($status == "d"){
                                                    echo '<input type="radio" name="status" value="d" checked>Inactiv';
												} else {
													echo '<input type="radio" name="status" value="d">Inactiv';
												}
												?>
                                                </label>
                                            </div>
                                        </div>
										
										
                                        <div class="form-group">
                                            <label>Suma</label>
											<div class="input-group">
												<input type="numeric" value="<?php echo $suma; ?>" name="suma" class="form-control">
												<div class="input-group-addon">RON</div>
											</div>
                                        </div>
                                        <button type="reset" class="btn btn-default">Anuleaza</button>
										<button name="submit" type="submit" class="btn btn-primary">Salveaza modificarile</button>
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
