<?php
  class Dostupni extends CI_model {
    public $dostupni_termini_id;
    public $dan;
    public $vrijeme_pocetka;
    public $vrijeme_kraja;
    public $user_id;
    
    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }
    // Glupo sam nazvao funkciju treba bit dodaj dostupnost ili slicno
    // This confusees me.
    public function dodaj_termin($dan, $start, $end, $user_id)
    {
        // TODO Prebaci na update
        $sql = "DELETE FROM dostupni_termini WHERE dan = ? AND user_id = ?";
        $query = $this->db->query($sql,array( $dan, $user_id));
        
       
        $sql = "INSERT INTO dostupni_termini VALUES(default, ?, ?, ?, ?);";
        $query = $this->db->query($sql, array($dan, $start, $end, $user_id) );

        if($query)
            return true;
        return false;
    }
    public function brisi_termin($user_id, $dan)
    {
        // TODO Prebaci na update
        $sql = "DELETE FROM dostupni_termini WHERE dan = ? AND user_id = ?";
        $query = $this->db->query($sql,array( $dan, $user_id));
        
    }
    public function provjeri_dostupnost($user_id, $datum, $vrijeme)
    {
      $dan = date("D", strtotime($datum));
      $sql = 'SELECT * FROM dostupni_termini WHERE 
                        dan = ? AND 
                        vrijeme_pocetka <= ? AND 
                        vrijeme_kraja >= ? AND 
                        user_id = ?';

      $query = $this->db->query($sql,array( $dan, $vrijeme, $vrijeme, $user_id ) ); 
      
      if($query->result())
        return true;
      return false;
    }
    public function get_dash_dopstupni( $user_id, $dan = null ) 
    {
      $sql = 'SELECT  extract(hour from vrijeme_pocetka) * 60 + 
                      extract(minute from vrijeme_pocetka) as od,
                       extract(hour from vrijeme_kraja) * 60 + 
                      extract(minute from vrijeme_kraja) as do
                      from dostupni_termini where user_id = ?';
      if($dan) $sql .= " AND dan = ?";
      $query = $this->db->query($sql, array(intval($user_id), $dan));
      if(empty($query->result()) ) return false;
      return $query->result()[0];
    }
    public function dobavi_string($user_id)
    {
        $sql = 'SELECT  vrijeme_pocetka,
                        vrijeme_kraja,
                        dan
                        from dostupni_termini where user_id = ?';
        $query = $this->db->query($sql, intval($user_id));

        if(empty($query->result()) ) return false;
        $dani = array();
        foreach ($query->result() as $dan) {
          $za_unjeti = "";
          switch ($dan->dan) {
            case 'Mon':
               $za_unjeti .= "Ponedeljak ";
              break;
            case 'Tue':
               $za_unjeti .= "Utorak ";
              break;
            case 'Wed':
              $za_unjeti .= "Srijeda ";
              break;
            case 'Thu':
              $za_unjeti .= "Četvrtak ";
              break;
            case 'Fri':
              $za_unjeti .= "Petak ";
              break;
            case 'Sat':
              $za_unjeti .= "Subota ";
              break;
            case 'Sun':
              $za_unjeti .= "Nedelja ";
              break;
          }
          $za_unjeti .= "od ".$dan->vrijeme_pocetka." ";
          $za_unjeti .= "do ".$dan->vrijeme_kraja;
          array_push($dani, $za_unjeti);
        }
        return $dani;
    }
  }
?>