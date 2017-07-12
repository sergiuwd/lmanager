<?php
	include_once("php_includes/check_login_status.php");
	include_once("php_includes/db_conx.php");
	$sql = "SELECT SQL_NO_CACHE * FROM persoane";
	$query = mysqli_query($db_conx, $sql) or die(mysqli_error($db_conx));

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Listare Persoane - LManager</title>

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
                    <h1 class="page-header">Lista Persoane</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Listare Persoane
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nume</th>
                                            <th>Suma (RON)</th>
                                            <th>Tip plata</th>
											<th>Adaugat la</th>
											<th>De catre</th>
											<th>Status</th>
											<th class="col-lg-1">Operatii</th>
                                        </tr>
                                    </thead>
                                    <tbody>

										<?php

										while ($row = mysqli_fetch_assoc($query)) {
											$nume = $row['nume'];
											$tplata = $row['tip_plata'];
											$status = $row['status'];
											$id = $row['id'];
											$parent = $row['parent'];
											$suma = $row['valoare'];
											$data = $row['data'];
											$parentsql = "SELECT user FROM users WHERE id='$parent'";
											$getparent = mysqli_query($db_conx, $parentsql);

											echo '<tr class="gradeA">';

											//username
											echo '<td>';
											echo $nume;
											echo '</td>';

											//suma
											echo '<td>';
											echo $suma;
											echo '</td>';

											//status
											echo '<td>';
											if($tplata == "luna"){
												echo 'Pe luna';
											} else if($tplata == "zi"){
												echo 'Pe zi';
											} else if ($tplata == "2pluna"){
												echo 'De doua ori pe luna';
											} else if ($tplata == "ora"){
												echo 'Pe ora';
											} else if ($tplata == "sapt"){
												echo 'Pe saptamana';
											}
											echo '</td>';

											//data
											echo '<td>';
											echo $data;
											echo '</td>';

											//parent
											echo '<td>';
											while ($row = mysqli_fetch_assoc($getparent)) {
												echo $row['user'];
											}
											echo '</td>';

											//status
											echo '<td>';
											if($status == "a"){
												echo '<span class="label label-success">Activ</span>';
											} else if($status == "d"){
												echo '<span class="label label-danger">Dezactivat</span>';
											}
											echo '</td>';

											//rank
											echo '<td><a href="edit_persoana.php?user='.$id.'"><span class="glyphicon glyphicon-pencil"></span> Editeaza</td>';
										}

										?>
                                    </tbody>
                                </table>
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
