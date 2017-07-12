<?php
	include_once("php_includes/check_login_status.php");
	include_once("php_includes/db_conx.php");
	$sql = "SELECT * FROM cf_cat";
	$query = mysqli_query($db_conx, $sql);
	
	if(isset($_POST['submit'])){
		
		$cat = $_POST['cat'];
		$denumire = $_POST['denumire'];
		echo $cat.' '.$denumire;
		
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

    <title>Setari Cashflow - LManager</title>

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
	<script type="text/javascript">
		$(document).ready(function()
		{
			$(".country").change(function()
			{
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
				type: "POST",
				url: "ajax_city.php",
				data: dataString,
				cache: false,
				success: function(html)
				{
				$(".city").html(html);
				} 
			});

			});

		});
	</script>
	
	<style>
			.tree {
				min-height:20px;
				padding:19px;
				margin-bottom:20px;
				background-color:#fbfbfb;
				border:1px solid #999;
				-webkit-border-radius:4px;
				-moz-border-radius:4px;
				border-radius:4px;
				-webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
				-moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
				box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
			}
			.tree li {
				list-style-type:none;
				margin:0;
				padding:10px 5px 0 5px;
				position:relative
			}
			.tree li::before, .tree li::after {
				content:'';
				left:-20px;
				position:absolute;
				right:auto
			}
			.tree li::before {
				border-left:1px solid #999;
				bottom:50px;
				height:100%;
				top:0;
				width:1px
			}
			.tree li::after {
				border-top:1px solid #999;
				height:20px;
				top:25px;
				width:25px
			}
			.tree li span {
				-moz-border-radius:5px;
				-webkit-border-radius:5px;
				border:1px solid #999;
				border-radius:5px;
				display:inline-block;
				padding:3px 8px;
				text-decoration:none
			}
			.tree li.parent_li>span {
				cursor:pointer
			}
			.tree>ul>li::before, .tree>ul>li::after {
				border:0
			}
			.tree li:last-child::before {
				height:30px
			}
			.tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
				background:#eee;
				border:1px solid #94a0b4;
				color:#000
			}
			
			.prime_hy {
				background-color: #337ab7;
				color: #FFF;
				font-weight: bold;
			}
	</style>
</head>

<body>

    <div id="wrapper">
	<?php include_once("meniu.php"); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Setari Cashflow</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                            <div class="row">
							
							<div class="col-lg-3">
								<div class="tree well">
									<ul>
										<li>
											<span class="prime_hy"><i class="icon-folder-open"></i> Cheltuieli utilitati</span>
											<ul>
												<li>
													<span><i class="icon-minus-sign"></i> Chirie</span>
												</li>
												<li>
													<span><i class="icon-minus-sign"></i> Energie electrica</span>
												</li>
												<li>
													<span><i class="icon-minus-sign"></i> Energie termica</span>
												</li>
											</ul>
										</li>
									</ul>
									
									<ul>
										<li>
											<span class="prime_hy"><i class="icon-folder-open"></i> Cheltuieli intretinere</span>
											<ul>
												<li>
													<span><i class="icon-minus-sign"></i> Auto</span>
												</li>
												<li>
													<span><i class="icon-minus-sign"></i> Categorie 2</span>
												</li>
											</ul>
										</li>
									</ul>
									
									<ul>
										<li>
											<span class="prime_hy"><i class="icon-folder-open"></i> Cheltuieli dezvoltare</span>
											<ul>
												<li>
													<span><i class="icon-minus-sign"></i> Bucatarie</span>
												</li>
												<li>
													<span><i class="icon-minus-sign"></i> Bar</span>
												</li>
												<li>
													<span><i class="icon-minus-sign"></i> Cofetarie</span>
												</li>
											</ul>
										</li>
									</ul>
									
									<ul>
										<li>
											<span class="prime_hy"><i class="icon-folder-open"></i> Cheltuieli combustibil</span>
											<ul>
												<li>
													<span><i class="icon-minus-sign"></i> Fiat</span>
												</li>
												<li>
													<span><i class="icon-minus-sign"></i> Matiz</span>
												</li>
												<li>
													<span><i class="icon-minus-sign"></i> Peugeot</span>
												</li>
											</ul>
										</li>
									</ul>
									
									<ul>
										<li>
											<span class="prime_hy"><i class="icon-folder-open"></i> Cheltuieli Marketing</span>
											<ul>
												<li>
													<span><i class="icon-minus-sign"></i> Internet</span>
												</li>
												<li>
													<span><i class="icon-minus-sign"></i> Pliante</span>
												</li>
											</ul>
										</li>
									</ul>
									
									<ul>
										<li>
											<span class="prime_hy"><i class="icon-folder-open"></i> Cheltuieli consumabile</span>
											<ul>
												<li>
													<span><i class="icon-minus-sign"></i> Auto</span>
												</li>
												<li>
													<span><i class="icon-minus-sign"></i> Categorie 2</span>
												</li>
											</ul>
										</li>
									</ul>
								</div>

							
                                <div class="col-lg-6">
                                  
									
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                            </div>
							
							<div class="col-lg-9">
								  <form role="form" method="post">
                                        <div class="form-group">
                                            <label>Categorie principala</label>
											<select class="form-control" name="cat">
												<option value="no">Fara</option>
												<?php
													while($row = mysqli_fetch_assoc($query)){
														$id = $row['id'];
														$den = $row['den_cat'];
														echo '<option value="'.$id.'">'.$den.'</option>';
													}
												?>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Denumire</label>
											<input type="numeric" name="denumire" class="form-control">
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
