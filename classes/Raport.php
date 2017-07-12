<?php

  class Raport {

    private $results = array();
    private $target = 0;
    private $name = "NULL";
    private $data_inceput;
    private $data_final;

    public function __construct($id = null, $datastart = null, $datafinal = null) {

      $this->target = $id;

      $this->data_inceput = $datastart;
      $this->data_final = $datafinal;

      global $db_conx;
      $sql = "SELECT `nume` FROM `persoane` WHERE `id` = {$id}";
      $query = mysqli_query($db_conx, $sql);

      $row = mysqli_fetch_assoc($query);

      $this->name = $row['nume'];

    }

    public function getNume() {
      return $this->name;
    }

    public function fetchAjustari() {

      global $db_conx;

      $results = array();

      $sql = "SELECT * FROM `ajustari` WHERE `pers_id` = {$this->target} AND `data` between '{$this->data_inceput}' and '{$this->data_final}'  ORDER BY `data` DESC";
      $query = mysqli_query($db_conx, $sql) or die(mysqli_error($db_conx));

      while($row = mysqli_fetch_assoc($query)) {

        $text = "A primit o ajustare de " . $row['suma'] . " RON - Motiv: " . $row['motiv'];

        $results[] = array('date' => $row['data'], 'value' => $text);

      }

      return $results;

    }

    public function fetchPlati() {

      global $db_conx;

      $results = array();

      $sql = "SELECT * FROM `plati` WHERE `persoana_id` = {$this->target} AND `data` between '{$this->data_inceput}' and '{$this->data_final}'  ORDER BY `data` DESC";
      $query = mysqli_query($db_conx, $sql);

      while($row = mysqli_fetch_assoc($query)) {

        $text = "A primit o plata de " . $row['valoare'] . " RON - Prezente la data platii: " . $row['prezente'];

        $results[] = array('date' => $row['data'], 'value' => $text, 'sum' => $row['valoare']);

      }

      return $results;

    }

    public function fetchPrezente() {

      global $db_conx;

      $results = array();

      $sql = "SELECT * FROM `prezente` WHERE `persoana_id` = {$this->target} AND `data` between '{$this->data_inceput}' and '{$this->data_final}'  ORDER BY `data` DESC";
      $query = mysqli_query($db_conx, $sql);

      while($row = mysqli_fetch_assoc($query)) {

        if($row['nota'] != "") {
          $detalii = $row['nota'];
        } else {
          $detalii = "FARA";
        }

        $text = "A fost prezent intre orele " . $row['ora_inceput'] . " si " . $row['ora_final'] . " - Detalii: " . $detalii;

        $results[] = array('date' => $row['data'], 'value' => $text);

      }

      return $results;

    }

    public function getAll() {
      $this->fetchAjustari();
      $this->fetchPlati();
      return $this->results;
    }

  }

?>
