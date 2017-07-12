<?php
	include_once("php_includes/check_login_status.php");
	include_once("php_includes/db_conx.php");
	include_once("php_includes/functii.php");
	$sql = "SELECT * FROM persoane WHERE status='a' ORDER BY nume";
	$query = mysqli_query($db_conx, $sql);
	$data =  date("d-m-Y");

	if(isset($_POST['orainceput'])){
		$persid = $_POST['prezpersid'];
		$ora 		= $_POST['orainceput'];
		$nota 	= $_POST['notaprez'];
		$autor 	= $_SESSION['user'];
		$today = date('Y-m-d');

		$chsql 	 = "SELECT COUNT(*) AS numberOfRows FROM `prezente` WHERE `persoana_id` = '$persid' AND `data` = '$today'";
		$chquery = mysqli_query($db_conx, $chsql);

		$row = mysqli_fetch_array($chquery);

		$num = $row['numberOfRows'];

		if($num == 0) {
			$psql = "INSERT INTO `prezente` (`persoana_id`, `data`, `ora_inceput`, `autor`, `nota`) VALUES ('$persid', NOW(), '$ora', '$autor', '$nota')";
			$pquery = mysqli_query($db_conx, $psql);
		}

	}

	if(isset($_POST['orafinal'])){

		$tip 			= $_POST['tip_abs'];
		$nota 		= "";
		$orafinal = "";
		$persid 	= "";
		$persid 	= $_POST['abspersid'];
		$orafinal = $_POST['orafinal'];
		$nota 		= $_POST['notaabs'];
		$dataref 	= date("Y-m-d");

		if($tip == "final_zi"){

			$asql 	= "UPDATE prezente SET ora_final = '$orafinal' WHERE data = '$dataref' AND persoana_id = '$persid'";
			$aquery = mysqli_query($db_conx, $asql);

		} else if($tip == "eroare_umana"){

			$asql = "DELETE FROM prezente WHERE persoana_id='$persid' AND data='$dataref'";
			$aquery = mysqli_query($db_conx, $asql);

		}

	}

	if(isset($_POST['achsuma'])){
		$zile = $_POST['achzile'];
		$suma = $_POST['achsuma'];
		$nota = $_POST['achnota'];
		$pers = $_POST['achpers'];

		$asql = "INSERT INTO plati (persoana_id, valoare, data, prezente) VALUES ('$pers', '$suma', NOW(), '$zile')";
		$aquery = mysqli_query($db_conx, $asql);

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

    <title>Prezente Astazi - LManager</title>

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

	<style>
	button:focus, input:focus{
		outline: 0;
	}

	.fc {
	direction: ltr;
	text-align: left;
	}

.fc table {
	border-collapse: collapse;
	border-spacing: 0;
	}

html .fc,
.fc table {
	font-size: 1em;
	}

.fc td,
.fc th {
	padding: 0;
	vertical-align: top;
	}



/* Header
------------------------------------------------------------------------*/

.fc-header td {
	white-space: nowrap;
	}

.fc-header-left {
	width: 25%;
	text-align: left;
	}

.fc-header-center {
	text-align: center;
	}

.fc-header-right {
	width: 25%;
	text-align: right;
	}

.fc-header-title {
	display: inline-block;
	vertical-align: top;
	}

.fc-header-title h2 {
	margin-top: 0;
	white-space: nowrap;
	}

.fc .fc-header-space {
	padding-left: 10px;
	}

.fc-header .fc-button {
	margin-bottom: 1em;
	vertical-align: top;
	}

/* buttons edges butting together */

.fc-header .fc-button {
	margin-right: -1px;
	}

.fc-header .fc-corner-right,  /* non-theme */
.fc-header .ui-corner-right { /* theme */
	margin-right: 0; /* back to normal */
	}

/* button layering (for border precedence) */

.fc-header .fc-state-hover,
.fc-header .ui-state-hover {
	z-index: 2;
	}

.fc-header .fc-state-down {
	z-index: 3;
	}

.fc-header .fc-state-active,
.fc-header .ui-state-active {
	z-index: 4;
	}



/* Content
------------------------------------------------------------------------*/

.fc-content {
	clear: both;
	zoom: 1; /* for IE7, gives accurate coordinates for [un]freezeContentHeight */
	}

.fc-view {
	width: 100%;
	overflow: hidden;
	}



/* Cell Styles
------------------------------------------------------------------------*/

.fc-widget-header,    /* <th>, usually */
.fc-widget-content {  /* <td>, usually */
	border: 1px solid #ddd;
	}

.fc-state-highlight { /* <td> today cell */ /* TODO: add .fc-today to <th> */
	background: #fcfcfc;
	}

.fc-cell-overlay { /* semi-transparent rectangle while dragging */
	background: #bcccbc;
	opacity: .3;
	filter: alpha(opacity=30); /* for IE */
	}



/* Buttons
------------------------------------------------------------------------*/

.fc-button {
	position: relative;
	display: inline-block;
	padding: 0 .6em;
	overflow: hidden;
	height: 1.9em;
	line-height: 1.9em;
	white-space: nowrap;
	cursor: pointer;
}


.fc-text-arrow {
	margin: 0 .1em;
	font-size: 2em;
	font-family: "Courier New", Courier, monospace;
	vertical-align: baseline; /* for IE7 */
	}



/*
  button states
  borrowed from twitter bootstrap (http://twitter.github.com/bootstrap/)
*/

.fc-state-default {
	background-color: #f5f5f5;
	}

.fc-state-hover,
.fc-state-down,
.fc-state-active,
.fc-state-disabled {
	color: #333333;
	background-color: #e6e6e6;
	}

.fc-state-hover {
	color: #333333;
	text-decoration: none;
	background-position: 0 -15px;
	-webkit-transition: background-position 0.1s linear;
	   -moz-transition: background-position 0.1s linear;
	     -o-transition: background-position 0.1s linear;
	        transition: background-position 0.1s linear;
	}

.fc-state-down,
.fc-state-active {
	background-color: #cccccc;
	background-image: none;
	outline: 0;
	box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
	}

.fc-state-disabled {
	cursor: default;
	background-image: none;
	opacity: 0.55;
	filter: alpha(opacity=65);
	box-shadow: none;
	}



/* Global Event Styles
------------------------------------------------------------------------*/

.fc-event-container > * {
	z-index: 8;
	}

.fc-event-container > .ui-draggable-dragging,
.fc-event-container > .ui-resizable-resizing {
	z-index: 9;
	}

.fc-event {
	border: 1px solid #3a87ad; /* default BORDER color */
	background-color: #3a87ad; /* default BACKGROUND color */
	color: #fff;               /* default TEXT color */
	font-size: .85em;
	cursor: default;
	}

a.fc-event {
	text-decoration: none;
	}

a.fc-event,
.fc-event-draggable {
	cursor: pointer;
	}

.fc-rtl .fc-event {
	text-align: right;
	}

.fc-event-inner {
	width: 100%;
	height: 100%;
	overflow: hidden;
	}

.fc-event-time,
.fc-event-title {
	padding: 0 1px;
	}

.fc .ui-resizable-handle {
	display: block;
	position: absolute;
	z-index: 99999;
	overflow: hidden; /* hacky spaces (IE6/7) */
	font-size: 300%;  /* */
	line-height: 50%; /* */
	}



/* Horizontal Events
------------------------------------------------------------------------*/

.fc-event-hori {
	border-width: 1px 0;
	margin-bottom: 1px;
	}

.fc-ltr .fc-event-hori.fc-event-start,
.fc-rtl .fc-event-hori.fc-event-end {
	border-left-width: 1px;
	}

.fc-ltr .fc-event-hori.fc-event-end,
.fc-rtl .fc-event-hori.fc-event-start {
	border-right-width: 1px;
	}

/* resizable */

.fc-event-hori .ui-resizable-e {
	top: 0           !important; /* importants override pre jquery ui 1.7 styles */
	right: -3px      !important;
	width: 7px       !important;
	height: 100%     !important;
	cursor: e-resize;
	}

.fc-event-hori .ui-resizable-w {
	top: 0           !important;
	left: -3px       !important;
	width: 7px       !important;
	height: 100%     !important;
	cursor: w-resize;
	}

.fc-event-hori .ui-resizable-handle {
	_padding-bottom: 14px; /* IE6 had 0 height */
	}


table.fc-border-separate {
	border-collapse: separate;
	}

.fc-border-separate th,
.fc-border-separate td {
	border-width: 1px 0 0 1px;
	}

.fc-border-separate th.fc-last,
.fc-border-separate td.fc-last {
	border-right-width: 1px;
	}

.fc-border-separate tr.fc-last th,
.fc-border-separate tr.fc-last td {
	border-bottom-width: 1px;
	}

.fc-border-separate tbody tr.fc-first td,
.fc-border-separate tbody tr.fc-first th {
	border-top-width: 0;
	}



/* Month View, Basic Week View, Basic Day View
------------------------------------------------------------------------*/

.fc-grid th {
	text-align: center;
	}

.fc .fc-week-number {
	width: 22px;
	text-align: center;
	}

.fc .fc-week-number div {
	padding: 0 2px;
	}

.fc-grid .fc-day-number {
	float: right;
	padding: 0 2px;
	}

.fc-grid .fc-other-month .fc-day-number {
	opacity: 0.3;
	filter: alpha(opacity=30); /* for IE */
	/* opacity with small font can sometimes look too faded
	   might want to set the 'color' property instead
	   making day-numbers bold also fixes the problem */
	}

.fc-grid .fc-day-content {
	clear: both;
	padding: 2px 2px 1px; /* distance between events and day edges */
	}

/* event styles */

.fc-grid .fc-event-time {
	font-weight: bold;
	}

/* right-to-left */

.fc-rtl .fc-grid .fc-day-number {
	float: left;
	}

.fc-rtl .fc-grid .fc-event-time {
	float: right;
	}



/* Agenda Week View, Agenda Day View
------------------------------------------------------------------------*/

.fc-agenda table {
	border-collapse: separate;
	}

.fc-agenda-days th {
	text-align: center;
	}

.fc-agenda .fc-agenda-axis {
	width: 50px;
	padding: 0 4px;
	vertical-align: middle;
	text-align: right;
	white-space: nowrap;
	font-weight: normal;
	}

.fc-agenda .fc-week-number {
	font-weight: bold;
	}

.fc-agenda .fc-day-content {
	padding: 2px 2px 1px;
	}

/* make axis border take precedence */

.fc-agenda-days .fc-agenda-axis {
	border-right-width: 1px;
	}

.fc-agenda-days .fc-col0 {
	border-left-width: 0;
	}

/* all-day area */

.fc-agenda-allday th {
	border-width: 0 1px;
	}

.fc-agenda-allday .fc-day-content {
	min-height: 34px; /* TODO: doesnt work well in quirksmode */
	_height: 34px;
	}

/* divider (between all-day and slots) */

.fc-agenda-divider-inner {
	height: 2px;
	overflow: hidden;
	}

.fc-widget-header .fc-agenda-divider-inner {
	background: #eee;
	}

/* slot rows */

.fc-agenda-slots th {
	border-width: 1px 1px 0;
	}

.fc-agenda-slots td {
	border-width: 1px 0 0;
	background: none;
	}

.fc-agenda-slots td div {
	height: 20px;
	}

.fc-agenda-slots tr.fc-slot0 th,
.fc-agenda-slots tr.fc-slot0 td {
	border-top-width: 0;
	}

.fc-agenda-slots tr.fc-minor th,
.fc-agenda-slots tr.fc-minor td {
	border-top-style: dotted;
	}

.fc-agenda-slots tr.fc-minor th.ui-widget-header {
	*border-top-style: solid; /* doesn't work with background in IE6/7 */
	}



/* Vertical Events
------------------------------------------------------------------------*/

.fc-event-vert {
	border-width: 0 1px;
	}

.fc-event-vert.fc-event-start {
	border-top-width: 1px;
	}

.fc-event-vert.fc-event-end {
	border-bottom-width: 1px;
	}

.fc-event-vert .fc-event-time {
	white-space: nowrap;
	font-size: 10px;
	}

.fc-event-vert .fc-event-inner {
	position: relative;
	z-index: 2;
	}

.fc-event-vert .fc-event-bg { /* makes the event lighter w/ a semi-transparent overlay  */
	position: absolute;
	z-index: 1;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: #fff;
	opacity: .25;
	filter: alpha(opacity=25);
	}

.fc .ui-draggable-dragging .fc-event-bg, /* TODO: something nicer like .fc-opacity */
.fc-select-helper .fc-event-bg {
	display: none\9; /* for IE6/7/8. nested opacity filters while dragging don't work */
	}

/* resizable */

.fc-event-vert .ui-resizable-s {
	bottom: 0        !important; /* importants override pre jquery ui 1.7 styles */
	width: 100%      !important;
	height: 8px      !important;
	overflow: hidden !important;
	line-height: 8px !important;
	font-size: 11px  !important;
	font-family: monospace;
	text-align: center;
	cursor: s-resize;
	}



	</style>
</style>

</head>

<body>

<div class="modal fade" id="achitamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="acTitle">Achita </h4>
      </div>
      <div class="modal-body">
        <form method="post" id="achitaform">
		<input type="text" name="achzile" id="achzile" hidden>
		<input type="text" name="achpers" id="achpers" hidden>
		<div class="form-group">
			<label>Suma</label>
			<div class="input-group">
				<input id="modalval" name="achsuma" class="form-control" placeholder="XXXX">
				<div class="input-group-addon">RON</div>
			</div>
        </div>
        <div class="form-group">
          <label for="message-text" class="control-label">Nota:</label>
          <textarea class="form-control" name="achnota" id="message-text"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Anuleaza</button>
        <button type="submit" id="achitaok" class="btn btn-primary" data-dismiss="modal">Trimite</button>
      </div>
	  </form>
    </div>
  </div>
</div>


<!-- FORMULAR INCEPUT PREZENTA -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalTitle">Informatii prezenta</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="prezentaSub">
		<input type="text" name="prezpersid" id="prezpersid" hidden>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Ora inceput:</label>
            <input type="time" value="09:00" name="orainceput" id="time" class="form-control">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Nota:</label>
            <textarea class="form-control" id="notaprez" name="notaprez"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Anuleaza</button>
        <button type="submit" name="submitprez" id="modalAddP" class="btn btn-success" data-dismiss="modal">Marcheaza ca prezent</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<!-- FORMULAR FINAL PREZENTA -->
<div class="modal fade" id="endmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalStopTitle">Informatii prezenta</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="incheieform">
		<div class="form-group">
			<label>Tip operatiune:</label>

			<div class="radio">
				<label>
					<input type="radio" name="tip_abs" value="final_zi" checked>Incheie prezenta
				</label>
			</div>

			<div class="radio">
				<label>
					<input type="radio" name="tip_abs" value="eroare_umana">Anuleaza prezenta (eroare umana)
				</label>
			</div>
		</div>
          <div class="form-group">
			<input type="text" name="abspersid" id="abspersid" hidden>
            <label for="recipient-name" class="control-label">Ora final:</label>
            <input type="time" value="09:00" name="orafinal" id="orafinal" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Nota:</label>
            <textarea class="form-control" name="notaabs" id="message-text"></textarea>
          </div>
		  <input type="text" name="prezpers" hidden id="prezpers">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Anuleaza</button>
        <button type="submit" id="incheieok" class="btn btn-danger" data-dismiss="modal">Marcheaza ca absent</button>
      </div>
	  </form>
    </div>
  </div>
</div>


    <div id="wrapper">

        <?php include_once("meniu.php"); ?>


	<div class="result"></div>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Prezente <?php echo $data; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Prezente
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="mytable">
                                    <thead>
                                        <tr>
											<th style="display: none;">ID</th>
											<th class="col-lg-1">Stare</th>
                                            <th>Nume</th>
                                            <th class="col-lg-1">Prezente de la ultima achitare</th>
											<th><p>Acumulat</p><span id="total"></span></th>
											<th class="col-lg-2">Calendar prezente</th>
                                            <th class="col-lg-2">Prezenta</th>
											<th class="col-lg-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

									<?php
									$datenow = date("Y-m-d");
									while ($row = mysqli_fetch_assoc($query)) {
											$prezent = false;
											$marcat = false;
											$nume = $row['nume'];
											$tplata = $row['tip_plata'];
											$status = $row['status'];
											$id = $row['id'];
											$suma = $row['valoare'];
											$getprezsql="SELECT * FROM prezente WHERE persoana_id='$id' AND ora_final='00:00:00' AND data='$datenow'";
											$getprezquery = mysqli_query($db_conx, $getprezsql);
											$deplata = deplata($id);
											$zileplata = zileplata($id);
											while ($getdata = mysqli_fetch_assoc($getprezquery)){
												$ora_final = $getdata['ora_final'];
											}

											/// Marcat ca absent
											$marcatsql = "SELECT * FROM prezente WHERE persoana_id='$id' AND data = '$datenow' AND ora_final <> '00:00:00'";
											$marcatquery = mysqli_query($db_conx, $marcatsql);
											$marcatcount = mysqli_num_rows($marcatquery);
											if($marcatcount > 0){
												$marcat = true;
											}


											$findsql = "SELECT * FROM prezente WHERE ";
											$numprez = mysqli_num_rows($getprezquery);
											if($numprez > 0){
												if($ora_final != "00:00:00"){
													$ora_acum = date("H:i:s");
													if($ora_final > $ora_acum){
														$prezent = true;
													}
												} else {
													$prezent = true;
												}

												// Verifica daca a fost marcat astazi
												if($ora_final != "00:00:00"){
													$marcat = true;
												}
											}

											echo '<tr>';
											echo '<td class="idrow" style="display: none;">'.$id.'</td>';
											if($prezent){
												echo '<td class="text-center"><button class="btn btn-lg btn-success stare">Prezent</button></td>';
											} else {
												echo '<td class="text-center"><button class="btn btn-lg btn-danger stare">Absent</button></td>';
											}
											echo '<td><h3 class="nume">'.$nume.'</h3></td>';
											echo '<td><h4 class="cprez text-center">'.$zileplata.'</h4></td>';

											echo '<td><h4 class="cplata text-right"><span class="cval">'.$deplata.'</span> Lei</h4></td>';

											echo '<td><button class="btn btn-lg btn-default btn-block calendar">Vezi calendar</button></td>';

											if($prezent){
												echo '<td><button class="btn btn-lg btn-danger btn-block prezent">Marcheaza ca absent</button></td>';
											} else {
												if($marcat){
													echo '<td><button class="btn btn-lg btn-primary btn-block" disabled>Marcat ca absent</button></td>';
												} else {
													echo '<td><button class="btn btn-lg btn-success btn-block prezent">Marcheaza ca prezent</button></td>';
												}
											}

											if($deplata == 0){
												echo '<td><button class="btn btn-lg btn-primary btn-block achita">Nimic de achitat</button></td>';
											} else {
												echo '<td><button class="btn btn-lg btn-warning btn-block achita">Achita</button></td>';
											}
											echo '</tr>';
										}

										?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
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

		$('.prezent').click(function(){
			var userid = $(this).closest("tr").find('.idrow').html();
			var user = $(this).closest("tr").find('.nume').html();
			if($(this).hasClass("btn-success")){
				$("#modalTitle").html("Informatii START prezenta " + user);
				$("#prezpers").val(user);
				$('#modal').modal('show');
				/**$(this).removeClass('btn-success').addClass('btn-danger');
				$(this).html("Marcheaza ca absent");
				$(this).closest("tr").find('.stare').removeClass('btn-danger').addClass('btn-success').html("Prezent");**/
				$("#prezpersid").val(userid);
			} else {
				var dt = new Date();
				var time = dt.getHours() + ":" + dt.getMinutes();
				$("#orafinal").val(time);
				$('#endmodal').modal('show');
				$("#modalStopTitle").html("Informatii STOP prezenta " + user);
				/**$(this).removeClass('btn-danger').addClass('btn-success');
				$(this).html("Marcheaza ca prezent")
				$(this).closest("tr").find('.stare').removeClass('btn-success').addClass('btn-danger').html("Absent");**/
				$("#abspersid").val(userid);
			}
		});

	</script>

	<script>

	$("#modalok").click(function(){

		alert("Merge!");

	});

	</script>

	<script>
	$(".calendar").click(function(){

		alert("Modulul CALENDAR este temporar indisponibil!");

	});
	</script>

	<script>

		$('.achita').click(function(){
			$('#achitamodal').modal('show');
			var userid = $(this).closest("tr").find('.idrow').html();
			var deplata = $(this).closest("tr").find(".cprez").html();
			var value = $(this).closest("tr").find('.cval').html();
			var user = $(this).closest("tr").find('.nume').html();
			$("#acTitle").html("Achita " + user);
			$("#modalval").val(value);
			$("#achzile").val(deplata);
			$('#achpers').val(userid);

		})

	</script>

	<script>
		$('#modalAddP').click(function(e){
			 $('#prezentaSub').submit();
		});
    </script>

	<script>
		$('#incheieok').click(function(e){
			 $('#incheieform').submit();
		});
    </script>

	<script>
		$('#achitaok').click(function(e){
			 $('#achitaform').submit();
		});
    </script>

	<script>
	$(window).load(function(){
		var sum = 0;
		$('.cval').each(function(){
			sum += parseFloat($(this).html());  //Or this.innerHTML, this.innerText
		});
		var sum = Math.round(sum);
		$("#total").html('Total: ' + sum + ' RON');
	});
	</script>
</body>

</html>
