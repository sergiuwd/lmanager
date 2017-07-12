<?php
	include_once("php_includes/check_login_status.php");
	include_once("php_includes/db_conx.php");

	$total = 0;

	if(isset($_POST['luna'])){

		$luna = $_POST['luna'];

	} else {

		$luna = date('n');

	}

	$sql = "SELECT * FROM plati";
	$query = mysqli_query($db_conx, $sql);

	$totalsql = "SELECT * FROM `plati` WHERE Month(data) = '$luna' AND Year(data) = '2016'";
	$totalquery = mysqli_query($db_conx, $totalsql);

	while($row = mysqli_fetch_assoc($totalquery)){
		$total += $row['valoare'];
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

    <title>Istoric Plati - LManager</title>

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

        <!-- Navigation -->
        <?php include_once("meniu.php"); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Raport plati</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Raport Plati
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nume</th>
                                            <th>Suma</th>
                                            <th>Zile</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>

									<?php

									while($row = mysqli_fetch_assoc($query)){
										$id = $row['persoana_id'];
										$valoare = $row['valoare'];
										$data = $row['data'];
										$prezente = $row['prezente'];
										$getnsql = "SELECT * FROM persoane WHERE id='$id'";
										$dogetn = mysqli_query($db_conx, $getnsql);
										while($getn = mysqli_fetch_assoc($dogetn)){
											$nume = $getn['nume'];
										}

										echo '<tr class="gradeA">';
										echo '<td>'.$nume.'</td>';
										echo '<td>'.$valoare.'</td>';
										echo '<td>'.$prezente.'</td>';
										echo '<td>'.$data.'</td>';
									}

									?>
                                    </tbody>
                                </table>
                            </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

							<div class="panel panel-default">
								<div class="panel-heading">
									Raport plati pe luna
								</div>
								<div class="panel-body">
								<div class="col-lg-6">
								<form id="selectdate" method="post">
									<p><b>Luna</b></p>
									<select id="changemonth" name="luna" class="form-control input-lg">
									<?php

									if($luna == "12"){
										echo '<option value="12" selected>Decembrie</option>';
									} else {
										echo '<option value="12">Decembrie</option>';
									}

									if($luna == "11"){
										echo '<option value="11" selected>Noiembrie</option>';
									} else {
										echo '<option value="11">Noiembrie</option>';
									}

									if($luna == "10"){
										echo '<option value="10" selected>Octombrie</option>';
									} else {
										echo '<option value="10">Octombrie</option>';
									}

									if($luna == "9"){
										echo '<option value="9" selected>Septembrie</option>';
									} else {
										echo '<option value="9">Septembrie</option>';
									}

									if($luna == "8"){
										echo '<option value="8" selected>August</option>';
									} else {
										echo '<option value="8">August</option>';
									}

									if($luna == "7"){
										echo '<option value="7" selected>Iulie</option>';
									} else {
										echo '<option value="7">Iulie</option>';
									}

									if($luna == "6"){
										echo '<option value="6" selected>Iunie</option>';
									} else {
										echo '<option value="6">Iunie</option>';
									}

									if($luna == "5"){
										echo '<option value="5" selected>Mai</option>';
									} else {
										echo '<option value="5">Mai</option>';
									}

									if($luna == "4"){
										echo '<option value="4" selected>Aprilie</option>';
									} else {
										echo '<option value="4">Aprilie</option>';
									}

									if($luna == "3"){
										echo '<option value="3" selected>Martie</option>';
									} else {
										echo '<option value="3">Martie</option>';
									}

									if($luna == "2"){
										echo '<option value="2" selected>Februarie</option>';
									} else {
										echo '<option value="2">Februarie</option>';
									}

									if($luna == "1"){
										echo '<option value="1" selected>Ianuarie</option>';
									} else {
										echo '<option value="1">Ianuarie</option>';
									}

									?>
									</select>
								</form>
									<h3 class="text-center"><?php echo $total.' RON'; ?> </h3>
									</div>
								</div>
							</div>

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

	<script>
	$('#changemonth').change(function(){
		$('#selectdate').submit();
	});
	</script>

</body>

</html>
