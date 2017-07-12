<?php
	include_once("php_includes/check_login_status.php");
	include_once("php_includes/db_conx.php");
	if(isset($_POST["submit"])){
		if(isset($_POST["cat"]) && $_POST["cat"] != "" && isset($_POST["valoare"]) && $_POST["valoare"] != "" && isset($_POST["data"]) && $_POST["data"] != ""){
			$cat = $_POST["cat"];
			$valoare = $_POST["valoare"];
			$subcat = $_POST["subcat"];
			$data = $_POST['data'];
			$data_afisare = date("d-m-Y", strtotime($data));
			$getcatname = mysqli_query($db_conx, "SELECT * FROM cf_cat WHERE id='$cat'");
			while($row = mysqli_fetch_assoc($getcatname)){
				$catname = $row['den_cat'];
			}
			$sql = "INSERT INTO cf_plati (suma, cat_id, subcat_id, data) VALUES ('$valoare', '$cat', '$subcat', '$data')";
			$do_query = mysqli_query($db_conx, $sql);
			if($do_query) {
					$mtype = "success";
					$message = "Succes!";
					$message .= "<p>Suma <b>".$valoare." RON</b> a fost adaugata in categoria <b>".$catname."</b>";
					if(isset($subcat) && $subcat != ""){
						$getsubname = mysqli_query($db_conx, "SELECT * FROM cf_subcat WHERE id='$subcat'");
						while($get = mysqli_fetch_assoc($getsubname)){
							$subname = $get['den_sub'];
						}
						$message .= ", subcategoria <b>".$subname."</b>";
					}
					$message .= ", cu data <b>".$data_afisare."</b>";
					$message .= "!</p>";
			} else {
					$mtype = "error";
					$message = "A aparut o eroare! Reincercati sau contactati un administrator.";
			}
			
		} else {
			$mtype = "error";
			$message = "Completati minim categoria, suma si data!";
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

    <title>Adauga Cheltuieli - LManager</title>

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
	
	<!-- Populare subcategorii -->
	
</head>

<body>

    <div id="wrapper">
	<?php include_once("meniu.php"); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Adauga cheltuieli</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
							
                                <div class="col-lg-6">
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label>Categorie</label>
											<select class="form-control" name="cat" id="cat">
												<?php
													$sql=mysqli_query($db_conx, "SELECT * FROM cf_cat");
													
													while($row=mysqli_fetch_assoc($sql))
													{
														$id=$row['id'];
														$data=$row['den_cat'];
														echo '<option value="'.$id.'">'.$data.'</option>';
													}
												?>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Subcategorie</label>
											<select class="form-control" name="subcat" id="subcat">
												<?php
													$sql=mysqli_query($db_conx, "SELECT * FROM cf_subcat WHERE parent_cat='1'");
													
													while($row=mysqli_fetch_assoc($sql))
													{
														$id=$row['id'];
														$data=$row['den_sub'];
														echo '<option value="'.$id.'">'.$data.'</option>';
													}
												?>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Suma</label>
											<div class="input-group">
												<input name="valoare" type="numeric" name="suma" class="form-control" placeholder="XXXX">
												<div class="input-group-addon">RON</div>
											</div>
                                        </div>
										
										<div class="form-group">
                                            <label>Data</label>
												<input name="data" id="data" value="<?php echo date("Y-m-d"); ?>" type="date" name="data" class="form-control">
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
	
	<!-- Submit VIA Ajax -->
	<script type="text/javascript">
		$(document).ready(function()
		{
			$("#cat").change(function(){
			var id=$(this).val();
			var dataString = 'id='+ id;

				$.ajax({
					  url: 'php_includes/ajax_subcat.php',
					  type: 'post',
					  data: dataString,
					  cache: false,
					  success: function(html){ 
						$("#subcat").html(html);
					  }
				});

			});

		});
	</script>

</body>

</html>
