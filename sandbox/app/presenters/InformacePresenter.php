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
   
   
   
    $query=$this->database->query("SELECT popis, predmet from znamky where ucitel=".$user->getId()." ORDER BY id_znamky DESC")->fetch();
    $prehled+= array ('posledni_pisemka'  => $query['popis'],);
   
    $query=$this->database->query("SELECT nazev FROM predmet where id_predmetu=".$query['predmet']."")->fetch();
    $prehled+= array ('posledni_pisemka_predmet'  => $query['nazev'],);
    
    $query=$this->database->query("SELECT count(znamka) AS `znamka_pocet`, znamka FROM `znamky` where ucitel=".$user->getId()." GROUP BY znamka ORDER BY count(znamka) DESC ")->fetch();
    $prehled+= array ('nej_znamka'  => $query['znamka'],);
    $prehled+= array ('nej_znamka_pocet'  => $query['znamka_pocet'],);
   
     return $prehled;
}
 
  
  
  		public function renderPrehled()
{
            $user =  $this->getUser();
            $this->template->prehled=  $this->PrehledUcitel();
 
}
  
 
} 







	
	

        
        
        