<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('ion_auth');
    }


    public function termini()
	{
		if($this->ion_auth->logged_in()){
            $get = $this->input->get();
            $this->load->model("dogovoreni");
            
            // Početni i završni datum koji trebaju ić u kalendar
            // S ovim piši upite
            (isset($get["start"]))?$start = $get["start"]: $start = false;
            (isset($get["end"]))?$end = $get["end"]: $end = false;
			$user_id = $this->ion_auth->user()->row()->id;

            $termini = $this->dogovoreni->get_prihvacene($user_id, $start, $end);
            $response = array();
            if($termini){
                foreach ($termini as $termin) {
                    
                    array_push($response, array("id" => $termin->termin_id,
                               "title" => $termin->termin_id,
                               "start" => $termin->datum."T".$termin->vrijeme,
                               "end"   => $termin->datum."T".$termin->end));
                }
            }
           /* $response = array(
                array("id"    => "1",
                      "title" => "Naslov 1",
                      "start" => "2017-04-12"),

                array("id"    => "2",
                      "title" => "Naslov 2",
                      "start" => "2017-04-08T10:00:00",
                      "end" => "2017-04-08T19:00:00")
            );*/
            //header('Content-Type: application/json');
            echo json_encode( $response );

		} 
            else 
        {
            header('Content-Type: application/json');
            echo json_encode( "{}");
        }
	}

    public function dash_termini()
	{
		if($this->ion_auth->logged_in()){
            $get = $this->input->get();
            $this->load->model("dogovoreni");
            
			$user_id = $this->ion_auth->user()->row()->id;
            $termini = $this->dogovoreni->get_neodgovorene($user_id);
            $response = array();
            if($termini){
                foreach ($termini as $termin) {
                    
                    array_push($response, array("id" => $termin->termin_id,
                               "title" => $termin->termin_id,
                               "datum" => $termin->datum,
                               "start" => $termin->vrijeme,
                               "end"   => $termin->end,
                               "hash"  => $termin->hash));
                }
            }
           /* $response = array(
                array("id"    => "1",
                      "title" => "Naslov 1",
                      "start" => "2017-04-12"),

                array("id"    => "2",
                      "title" => "Naslov 2",
                      "start" => "2017-04-08T10:00:00",
                      "end" => "2017-04-08T19:00:00")
            );*/
            //header('Content-Type: application/json');
            echo json_encode( $response );

		} 
            else 
        {
            header('Content-Type: application/json');
            echo json_encode( "{}");
        }
	}

    public function dostupni_termini()
    {
        $podaci = $this->input->post();
        $this->load->model("dostupni");

        $spremi = array();
        $brisi = array();
        foreach ($podaci as $key => $value) {
            if($key[0] == "c")
                array_push($spremi, substr($key,1,3));
            if(substr($key,0,5) == "range" ){
                array_push($brisi, substr($key,5,7));
            }
        }
        foreach ($brisi as $dan) {
            if( !$this->dostupni->brisi_termin($this->ion_auth->user()->row()->id, $dan) )
                $success = false;
        }
        $success = true;
        foreach ($spremi as $dan){
            // Dobijes 480;1200
            // explode d adobiješ array sa dvije vrijednost
            $split = explode(";", $podaci["range".$dan] );
            
            // Spremi string vrijednosti u zasebne varijable
            $string_start = $split[0];
            $string_end   = $split[1];
            
            // Pretvori string u int da dobiješ brojeve
            $start = intval( $string_start );
            $end   = intval( $string_end );

            // /60 da dobiješ sate rezervaicije 0-23 %60 da dobiješ minute
            $start_sati =  (string)round($start/60);
            $start_minuta = (string)round($start%60);

            $end_sati = (string)round($end/60);
            $end_minuta = (string)round($end%60);

            // Dodaj Vodeće 0
            $start_sati   = (strlen($start_sati)  ==1)?'0'.$start_sati  :$start_sati;
            $start_minuta = (strlen($start_minuta)==1)?'0'.$start_minuta:$start_minuta;

            $end_sati = (strlen($end_sati)==1)?'0'.$end_sati:$end_sati;
            $end_minuta = (strlen($end_minuta)==1)?'0'.$end_minuta:$end_minuta;

            $start = $start_sati.':'.$start_minuta.':00';
            $end   = $end_sati.':'.$end_minuta.':00';


            if( !$this->dostupni->dodaj_termin($dan, $start, $end, $this->ion_auth->user()->row()->id ) )
                $success = false;
        }
        if($success)
            echo "success";
        else
            echo "error";
    }
    public function set_postavke()
    {
        $podaci = $this->input->post();
        $this->load->model("user_postavke");

        $success = true;
        (isset($podaci["postavke_automatsko_prihvacanje"]))?$automatsko_prihvacanje = true:$automatsko_prihvacanje = false;
        (isset($podaci["postavke_dopusti_van_termina"]))?$dopusti_van_termina = true:$dopusti_van_termina = false;
        
        $handle = $podaci["postavke_handle"]; 
        $this->user_postavke->set_postavke($handle, 
                                $podaci["postavke_trajanje"],
                                $automatsko_prihvacanje,
                                $dopusti_van_termina,
                                $this->ion_auth->user()->row()->id);

        if($success)
            echo "success";
        else
            echo "error";
    }
    public function fb_create_token(){
        $id = $this->ion_auth->user()->row()->id;
        $this->load->model("fbconnect");
        $token = $this->fbconnect->create_token($id);
        echo $token;
    }

    public function dash_prihvati()
    {
        if(!$this->ion_auth->logged_in())
            redirect("/","refresh");
        $user_id = $this->ion_auth->user()->row()->id;
        $hash = $this->input->post("hash");
        
        $this->load->model('dogovoreni');
        

        $success = $this->dogovoreni->prihvati_termin($hash);
        if($success){
            echo "success";
            $this->load->library("wesly");
         
            $sender = $this->dogovoreni->get_sender($hash);
           
            $this->wesly->n_odgovori($sender, "Termin ". $hash." je prihvaćen");
         
        } else echo "error";
        
    }
    public function dash_odbij()
    {
         if(!$this->ion_auth->logged_in())
            redirect("/","refresh");
        $user_id = $this->ion_auth->user()->row()->id;
        $hash = $this->input->post("hash");
        $this->load->model('dogovoreni');
        $success = $this->dogovoreni->odbij_termin($hash);
        if($success){
            echo "success";
            
            $this->load->library("wesly");
            $sender = $this->dogovoreni->get_sender($hash);
            $this->wesly->n_odgovori($sender, "Termin ". $hash."je odbijen");
        } else echo "error";
    }


}
