<?php
	include_once("php_includes/check_login_status.php");
	include_once("php_includes/db_conx.php");
	$sql = "SELECT * FROM prezente";
	$query = mysqli_query($db_conx, $sql);
	$azi = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Listare Prezente - LManager</title>

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
                    <h1 class="page-header">Lista prezente</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Lista prezente
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nume</th>
                                            <th>Data</th>
											<th>Ora inceput</th>
											<th>Ora final</th>
                                            <th>Marcat de</th>
											<th>Ore lucrate</th>
											<th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
									
									while ($row = mysqli_fetch_assoc($query)) {
										$id = $row['persoana_id'];
										$getnamesql = "SELECT * FROM persoane WHERE id='$id'";
										$getnamequery = mysqli_query($db_conx, $getnamesql);
										while ($getname = mysqli_fetch_assoc($getnamequery)){
											$name = $getname['nume'];
										}
										$data = $row['data'];
										$ora_inceput = $row['ora_inceput'];
										$ora_final = $row['ora_final'];
										
										if($ora_final == "00:00:00" && $data != $azi ){
											$ora_final = "24:00:00";
										} else if($ora_final == "00:00:00" && $data == $azi){
											$ora_final = '<span class="label label-success">Prezent</span>';
										}
										
										// DIFERENTA DE ORE
										if($data == $azi){
											$total_hours = '<span class="label label-warning"><span class="glyphicon glyphicon-repeat"></span> IN DERULARE</span>';
										} else if($data != $azi) {
											$start = explode(':', $ora_inceput);
											$end = explode(':', $ora_final);
											$total_hours = $end[0] - $start[0] - ($end[1] < $start[1]);
										}
										
										$autor = $row['autor'];
										$nota = $row['nota'];
										echo '<tr class="gradeA">';
										
										//username
										echo '<td>';
										echo $name;
										echo '</td>';
										
										//data
										echo '<td>';
										echo $data;
										echo '</td>';
										
										//ora inceput
										echo '<td>';
										echo $ora_inceput;
										echo '</td>';
										
										//ora final
										echo '<td>';
										echo $ora_final;
										echo '</td>';
										
										//marcat de
										echo '<td class="col-lg-2">';
										echo "MOMENTAN INDISPONIBIL";
										echo '</td>';
										
										//marcat de
										echo '<td class="col-lg-1">';
										echo $total_hours;
										echo '</td>';
										
										//marcat de
										echo '<td class="col-lg-1">';
										echo $nota;
										echo '</td>';
										
										echo '</tr>';
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
