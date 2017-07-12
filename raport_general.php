<?php
	include_once("php_includes/check_login_status.php");
	include_once("php_includes/db_conx.php");
	include_once("classes/Raport.php");

	$setid = false;

	if(isset($_POST['target']) && is_numeric($_POST['target'])) {

		$setid = true;

		$id = $_POST['target'];
		$data_inceput = $_POST['data_inceput'];
		$data_final = $_POST['data_final'];

		if(!$data_inceput) {
			$data_inceput = date('Y-m-d');
		}

		if(!$data_final) {
			$data_final = date('Y-m-d');
		}

		$raport = new Raport($id, $data_inceput, $data_final);

	} else {

		$sql = "SELECT * FROM `persoane` WHERE `status` = 'a' ORDER BY `nume` ASC";
		$query = mysqli_query($db_conx, $sql);

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

    <title>Raport General - LManager</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

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
                    <h1 class="page-header">Raport General <?php if($setid) { echo $raport->getNume(); } ?></h1>
										<?php
											if($setid) {
												echo '<p class="help-block">Intre ' . $data_inceput . ' si ' . $data_final . '</p>';
											}
										 ?>
                </div>
                <!-- /.col-lg-12 -->
								<div class="col-lg-12">

									<?php
									if($setid) {

										echo '<h2 class="text-center">Ajustari</h2>';
										echo '<hr>';

										$ajustari = $raport->fetchAjustari();
										if(!empty($ajustari)) {

											foreach($ajustari as $ajustare) {

												echo '<p><i>' . $ajustare['date'] . '</i> - ' . $ajustare['value'] . '</p>';

											}

										} else {
											echo 'Nu exista date.';
										}

										echo '<hr>';
										echo '<p class="help-block text-center">FINAL</p>';
										echo '<hr>';

										echo '<h2 class="text-center">Plati</h2>';
										echo '<hr>';

										$plati = $raport->fetchPlati();
										if(!empty($plati)) {
											$total_plati = 0;
											foreach($plati as $plata) {

												echo '<p><i>' . $plata['date'] . '</i> - ' . $plata['value'] . '</p>';

												$total_plati += $plata['sum'];

											}

												echo '<b>Total: </b>' . $total_plati;

										} else {
											echo 'Nu exista date.';
										}

										echo '<hr>';
										echo '<p class="help-block text-center">FINAL</p>';
										echo '<hr>';

										echo '<h2 class="text-center">Prezente</h2>';
										echo '<hr>';

										$prezente = $raport->fetchPrezente();
										if(!empty($prezente)) {
											foreach($prezente as $prezenta) {

												echo '<p><i>' . $prezenta['date'] . '</i> - ' . $prezenta['value'] . '</p>';

											}

											echo '<b>Total: </b>' . count($raport->fetchPrezente());

										} else {
											echo 'Nu exista date.';
										}

										echo '<hr>';
										echo '<p class="help-block text-center">FINAL</p>';
										echo '<hr>';

									} else {
									?>

									<form method="post" class="form">

										<div class="form-group">
											<label>Angajat:</label>
											<select class="form-control" name="target">

												<?php

												while($row = mysqli_fetch_assoc($query)) {

													echo '<option value="' . $row['id'] . '">' . $row['nume'] . '</option>';

												}

												 ?>
											 </select>
										</div>

										<div class="form-group">
											<label>Intre</label>
											<input type="date" class="form-control" name="data_inceput">
										</div>

										<div class="form-group">
											<label>si</label>
											<input type="date" class="form-control" name="data_final">
										</div>

										<div class="form-group">
											<input type="submit" value="Genereaza Raport" class="btn btn-success">
										</div>

											</select>
										</div>

									</form>

									<?php
									}
									?>

								</div>
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

    <!-- DataTables JavaScript -->
    <script src="bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Romanian.json"
			},
                responsive: true
        });
    });
    </script>

</body>

</html>
