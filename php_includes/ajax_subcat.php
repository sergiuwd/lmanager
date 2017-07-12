<?php
	include('db_conx.php');
	
	if($_POST['id'])
	{
		$id=$_POST['id'];
		$sql=mysqli_query($db_conx, "SELECT * FROM cf_subcat WHERE parent_cat='$id'");
		while($row=mysqli_fetch_assoc($sql))
		{
			$id_subcat=$row['id'];
			$data=$row['den_sub'];
			echo '<option value="'.$id_subcat.'">'.$data.'</option>';
		}
	}
?>