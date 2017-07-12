<?php
	include_once("php_includes/check_login_status.php");
	include_once("php_includes/db_conx.php");
	$sql = "SELECT * FROM cf_plati";
	$query = mysqli_query($db_conx, $sql);
	
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cheltuieli - LManager</title>

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
                    <h1 class="page-header">Cheltuieli</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="btn-group btn-group-justified text-center" role="group">
							  <div class="btn-group" role="group">
								<a href="adauga_cheltuieli.php"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Adauga cheltuieli</button></a>
							  </div>
							  <div class="btn-group" role="group">
								<button type="button" class="btn btn-success"><span class="glyphicon glyphicon-object-align-left"></span> Genereaza rapoarte</button>
							  </div>
							</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th class="col-lg-2">Categorie</th>
                                            <th class="col-lg-2">Subcategorie</th>
                                            <th>Suma</th>
											<th>Data</th>
											<th>Detalii</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										
										<?php
									
										while ($row = mysqli_fetch_assoc($query)) {
											$catid = $row['cat_id'];
											$subcatid = $row['subcat_id'];
											
											// Fetch cat name
											$getcatname = mysqli_query($db_conx, "SELECT * FROM cf_cat WHERE id='$catid'");
											while($grabcat = mysqli_fetch_assoc($getcatname)){
												$cat = $grabcat['den_cat'];
											}
											
											// Fetch subcat name
											$getsubname = mysqli_query($db_conx, "SELECT * FROM cf_subcat WHERE id='$subcatid'");
											while($grabsub = mysqli_fetch_assoc($getsubname)){
												$subcat = $grabsub['den_sub'];
											}
											
											$val = $row['suma'];
											$data = date("d-m-Y", strtotime($row['data']));
											$detalii = $row['detalii'];
											$id = $row['id'];
											
											echo '<tr class="gradeA">';
											
											//categorie
											echo '<td>';
											echo $cat;
											echo '</td>';
											
											//subcategorie
											echo '<td>';
											echo $subcat;
											echo '</td>';
											
											//valoare
											echo '<td>';
											echo $val;
											echo '</td>';
											
											//data
											echo '<td>';
											echo $data;
											echo '</td>';
											
											//detalii
											echo '<td>';
											echo $detalii;
											echo '</td>';
											
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
