<?php

namespace App\Presenters;

use Nette,
	App\Model;
use Nette\Utils\Html;


/**
 * Homepage presenter.
 */






class InformacePresenter extends BasePresenter
{
    
  public $database;
    
 
 function PrehledUcitel(){
      $user =  $this->getUser();
      
    $prehled=array();
    $query=$this->database->query("SELECT count(id_znamky) AS `pocet_znamek` from znamky where ucitel=".$user->getId())->fetch();
    $prehled+= array ('pocet_znamek'  => $query['pocet_znamek'],);
    
    $query=$this->database->query("SELECT count(id_znamky) as `pocet_tyden` FROM `znamky` WHERE WEEK(datum) = (WEEK(CURRENT_DATE)-1) and ucitel=".$user->getId())->fetch();
    $prehled+= array ('pocet_tyden'  => $query['pocet_tyden'],);
   
   $query=$this->database->query("SELECT MAX(datum) as `posledni_znamka` FROM `znamky` WHERE ucitel=".$user->getId())->fetch();
   $date1=date_create($query['posledni_znamka']);
   $date2=date_create(date("d-m-Y"));
   $diff=date_diff($date1,$date2);
   $datum=strtotime($query['posledni_znamka']);
   $den=date("d",$datum);
   $mesic=date("n",$datum);
   $datum=array();
   $datum['den']=$den;
   $datum['mesic']=$mesic;
   //dump($diff);
   $prehled+= array ('posledni_znamka'  => $datum,);
   $prehled+= array ('posledni_znamka_den'  => $diff->days,);
   $prehled+= array ('posledni_znamka_den_inv'  => $diff->invert,);
   
   
    $query=$this->database->query("SELECT popis, predmet from znamky where ucitel=".$user->getId()." ORDER BY id_znamky DESC")->fetch();
    $prehled+= array ('posledni_pisemka'  => $query['popis'],);
   
    $query=$this->database->query("SELECT nazev FROM predmet where id_predmetu=".$query['predmet']."")->fetch();
    $prehled+= array ('posledni_pisemka_predmet'  => $query['nazev'],);
    
    $query=$this->database->query("SELECT count(znamka) AS `znamka_pocet`, znamka FROM `znamky` where ucitel=".$user->getId()." GROUP BY znamka ORDER BY count(znamka) DESC ")->fetch();
    $prehled+= array ('nej_znamka'  => $query['znamka'],);
    $prehled+= array ('nej_znamka_pocet'  => $query['znamka_pocet'],);
    
    
    
    
    
    //datum na graf
    $minuly_mesic=  date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
     
     $dnes1=date("Y-m-d");
     $dnes=date("Y-m-d");
     $dnes=strtotime($dnes);
     $mesic=date("n",$dnes);
     $rok=date("Y",$dnes);
     
     
     $dni_v_mesici = cal_days_in_month(CAL_GREGORIAN, $mesic, $rok);
    $dnes2=date("Y-m-".$dni_v_mesici);
 
   
   
    
    
    
    $query=$this->database->query("SELECT count(id_znamky) as `pocet_znamek`,  DATE_FORMAT(datum,'%Y-%c-%e') AS `datum` FROM `znamky` WHERE datum BETWEEN '".$minuly_mesic."' AND '".$dnes2."' AND ucitel=".$user->getId()." group by datum");
     
                $data=array();
                foreach ($query as $quer) {  
                 $data+= array (''.$quer->datum.''  => ''.$quer->pocet_znamek.'',); 
                }
               
                $data_f=array();
                for($i=1;$i<=$dni_v_mesici;$i++){
                  $data_f[$i]=$rok.'-'.$mesic.'-'.$i;
                  
                  if(isset($data[$rok.'-'.$mesic.'-'.$i])){
                  
                     $data_f[$i]=$data[$rok.'-'.$mesic.'-'.$i]; 
                  
                 
                  
                  }
                  else $data_f[$i]=0;
                 
                  }
    
      
      $prehled+= array ('pocet_dnu_graf'  => $dni_v_mesici,);
      $prehled+= array ('mesic_graf'  => $mesic,);
      $prehled+= array ('rok_graf'  => $rok,);
      $prehled+= array ('data_graf'  => $data_f,);
     return $prehled;
}
 
  
  
  		public function renderPrehled()
{
            $user =  $this->getUser();
            $this->template->prehled=  $this->PrehledUcitel();
 
}
  
 
} 







	
	

        
        
        