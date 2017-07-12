<?php

function findMonday($date) {

  if (!is_numeric($date))
        $date = strtotime($date);
    if (date('w', $date) == 1)
        return $date;
    else
      return strtotime(
          'last monday',
           $date
      );
}

function findSunday($date) {

  if (!is_numeric($date))
        $date = strtotime($date);
    if (date('w', $date) == 0)
        return $date;
    else
      return strtotime(
          'next sunday',
           $date
      );

}

function raport_zile($pid){

		// Declarare variabile
		$plati = 0;
		$zile = 0;
		$deplata = 0;
		$lista_zile = array();

		// Conectare la baza de date
		global $db_conx;

		// Calculeaza plati
		$sqlpl = "SELECT * FROM plati WHERE persoana_id='$pid'";
		$querypl = mysqli_query($db_conx, $sqlpl);

		// Calculeaza prezente
		$sqlpr = "SELECT * FROM prezente WHERE persoana_id='$pid'";
		$querypr = mysqli_query($db_conx, $sqlpr);
		$zile = mysqli_num_rows($querypr);

		while($zi = mysqli_fetch_assoc($querypr)){
			$data = $zi['data'];
			$data = date('d-m-Y', strtotime($data));
			$ora1 = $zi['ora_inceput'];
			$ora1 = date('H:i', strtotime($ora1));

			$ora2 = $zi['ora_final'];
			if($ora2 == '00:00:00'){
				$ora2 = '24:00';
			} else {
				$ora2 = date('H:i', strtotime($ora2));
			}

			$lista_zile[] = $data.' '.$ora1.' '.$ora2;
		}

		// Preia salariu
		$sqlsal = "SELECT * FROM persoane WHERE id='$pid' LIMIT 1";
		$getsal = mysqli_query($db_conx, $sqlsal);
		while($getdata = mysqli_fetch_assoc($getsal)){

			$salariu = $getdata['valoare'];
			$tip = $getdata['tip_plata'];

		}

		while($getplata = mysqli_fetch_assoc($querypl)){
			$plati += $getplata['valoare'];
		}
		if($tip == "zi"){
			$deplata = ($zile * $salariu) - $plati;
		} else if($tip == "luna") {
			$deplata = ($zile * ($salariu / 15)) - $plati;
		} else if($tip == "2pluna"){
			$deplata = ($zile * (($salariu * 2) / 15)) - $plati;
		} else if($tip == "ora"){
			$ore = 0;
			while($getore = mysqli_fetch_assoc($querypr)){
				$ora_inceput = $getore['ora_inceput'];
				$ora_final = $getore['ora_final'];
				$data = $getore['data'];
				if($ora_final == "00:00:00"){
					if($data == date("Y-m-d")){
						$ora_final = date("H:i:s");
					} else {
						$ora_final = "24:00:00";
					}
				}
				$start = explode(':', $ora_inceput);
				$end = explode(':', $ora_final);
				$total_hours = $end[0] - $start[0];
				$minute = $end[1] - $start[1];
				if($minute > 30){
					$total_hours = $total_hours + 1;
				}
				$ore = $ore + $total_hours;
			}
			$deplata = ($ore * $salariu) - $plati;
		}

		$deplata = round(floatval($deplata), 2);

		return $lista_zile;
}

// Calculator rest plata
function deplata($pid){

		// Declarare variabile
		$plati = 0;
		$zile = 0;
		$deplata = 0;

		// Conectare la baza de date
		global $db_conx;

		// Calculeaza plati
		$sqlpl = "SELECT * FROM plati WHERE persoana_id='$pid'";
		$querypl = mysqli_query($db_conx, $sqlpl);
		$nrplati = mysqli_num_rows($querypl);

		// Calculeaza prezente
		$sqlpr = "SELECT * FROM prezente WHERE persoana_id='$pid'";
		$querypr = mysqli_query($db_conx, $sqlpr);
		$zile = mysqli_num_rows($querypr);

		// Preia salariu
		$sqlsal = "SELECT * FROM persoane WHERE id='$pid' LIMIT 1";
		$getsal = mysqli_query($db_conx, $sqlsal);
		while($getdata = mysqli_fetch_assoc($getsal)){

			$salariu = $getdata['valoare'];
			$tip = $getdata['tip_plata'];
			$reg_date = $getdata['data'];

		}

    /// ADUNARE PLATI
		while($getplata = mysqli_fetch_assoc($querypl)){
			$plati += $getplata['valoare'];
		}

		if($tip == "zi"){
			$deplata = ($zile * $salariu) - $plati;
		} else if($tip == "luna") {
			$deplata = ($zile * ($salariu / 15)) - $plati;
		} else if($tip == "2pluna"){
			$deplata = ($zile * (($salariu * 2) / 15)) - $plati;
		} else if($tip == "ora"){
			$ore = 0;
			while($getore = mysqli_fetch_assoc($querypr)){
				$ora_inceput = $getore['ora_inceput'];
				$ora_final = $getore['ora_final'];
				$data = $getore['data'];
				if($ora_final == "00:00:00"){
					if($data == date("Y-m-d")){
						$ora_final = date("H:i:s");
					} else {
						$ora_final = "24:00:00";
					}
				}
				$start = explode(':', $ora_inceput);
				$end = explode(':', $ora_final);
				$total_hours = $end[0] - $start[0];
				$minute = $end[1] - $start[1];
				if($minute > 30){
					$total_hours = $total_hours + 1;
				}
				$ore = $ore + $total_hours;
			}
			$deplata = ($ore * $salariu) - $plati;
		} else if($tip == "sapt") {
			$date_now = date('d-m-Y');

			$start_date = findMonday($reg_date);
			$stop_date = findSunday($date_now);

			$days = $stop_date - $start_date;
			$days = floor($days/(60*60*24)) + 1;
			$weeks = ceil($days / 7);

			$deplata = $weeks * $salariu - $plati;
		}

		// Preluare AJUSTARE SALARIU
		$asql = "SELECT * FROM ajustari WHERE pers_id = '$pid'";
		$aquery = mysqli_query($db_conx, $asql);
		$anum = mysqli_num_rows($aquery);

		if($anum > 0){

			while($aj = mysqli_fetch_assoc($aquery)){

				$deplata = $deplata + $aj['suma'];

			}

		}

    $deplata = round($deplata, 2);

		return $deplata;
}

function zileplata($pid){

	// Declarare variabile
	$ziledeplata = 0;
	$zileplatite = 0;

	// Conectare la baza de date
	global $db_conx;

	// Zile platite
	$sqlpl = "SELECT * FROM plati WHERE persoana_id='$pid'";
	$querypl = mysqli_query($db_conx, $sqlpl);
	while($row = mysqli_fetch_assoc($querypl)){
		$zileplatite += $row['prezente'];
	}

	// Zile de plata
	$sqlp = "SELECT * FROM prezente WHERE persoana_id='$pid'";
	$queryp = mysqli_query($db_conx, $sqlp);
	$nr = mysqli_num_rows($queryp);

	//Calculeaza zile de plata
	$ziledeplata = $nr - $zileplatite;

	return $ziledeplata;
}

?>
