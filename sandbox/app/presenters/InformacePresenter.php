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
    
 
 function PrehledZak(){
      $user =  $this->getUser();
      
    $prehled=array();
    $query=$this->database->query("SELECT count(id_znamky) AS `pocet_znamek` from znamky where zak=".$user->getId())->fetch();
    $prehled+= array ('pocet_znamek'  => $query['pocet_znamek'],);
    
    $query=$this->database->query("SELECT count(id_znamky) as `pocet_tyden` FROM `znamky` WHERE WEEK(datum) = (WEEK(CURRENT_DATE)-1) and zak=".$user->getId())->fetch();
    $prehled+= array ('pocet_tyden'  => $query['pocet_tyden'],);
   
   $query=$this->database->query("SELECT MAX(datum) as `posledni_znamka` FROM `znamky` WHERE zak=".$user->getId())->fetch();
   $date1=date_create($query['posledni_znamka']);
   $date2=date_create(date("d-m-Y"));
   $diff=date_diff($date1,$date2);
   $datum=strtotime($query['posledni_znamka']);
   $den=date("j",$datum);
   $mesic=date("n",$datum);
   $datum=array();
   $datum['den']=$den;
   $datum['mesic']=$mesic;
   //dump($diff);
   $prehled+= array ('posledni_znamka'  => $datum,);
   $prehled+= array ('posledni_znamka_den'  => $diff->days,);
   $prehled+= array ('posledni_znamka_den_inv'  => $diff->invert,);
   
   
    $query=$this->database->query("SELECT popis, predmet from znamky where zak=".$user->getId()." ORDER BY id_znamky DESC")->fetch();
    $prehled+= array ('posledni_pisemka'  => $query['popis'],);
   
 if(!isset($query['predmet']))$query['predmet']=0;
    $query=$this->database->query("SELECT nazev FROM predmet where id_predmetu=".$query['predmet']."")->fetch();
    $prehled+= array ('posledni_pisemka_predmet'  => $query['nazev'],);
    
    $query=$this->database->query("SELECT count(znamka) AS `znamka_pocet`, znamka FROM `znamky` where zak=".$user->getId()." GROUP BY znamka ORDER BY count(znamka) DESC ")->fetch();
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
 
   
   
    
    
    
    $query=$this->database->query("SELECT count(id_znamky) as `pocet_znamek`,  DATE_FORMAT(datum,'%Y-%c-%e') AS `datum` FROM `znamky` WHERE datum BETWEEN '".$minuly_mesic."' AND '".$dnes2."' AND zak=".$user->getId()." group by datum");
     
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
      
      
      
      
      
      //graf předměty
     $query=$this->database->query("SELECT count(id_znamky) AS `pocet_znamek`, predmet, p.nazev AS `nazev_predmetu` FROM `znamky` INNER JOIN predmet AS `p` ON"
             . " znamky.predmet=p.id_predmetu WHERE zak=".$user->getId()." GROUP BY predmet ORDER BY nazev_predmetu");
     
   
       $data_pocet_znamek=array();
        $data_pocet_znamek_nazev=array();
        
       $i=1;
       $j=0;
                foreach ($query as $quer) {  
                 $data_pocet_znamek+= array (''.$i.''  => ''.$quer->pocet_znamek.'',); 
                  $data_pocet_znamek_nazev+= array (''.$i.''  => ''.$quer->nazev_predmetu.'',); 
                $i++;
                $j=$j + $quer->pocet_znamek; 
                }
           // dump($j); 
      $prehled+= array ('pocet_znamek_graf1'  => $data_pocet_znamek,);
      $prehled+= array ('celkovy_pocet_znamek_graf1'  => $j,);
      $prehled+= array ('pocet_znamek_graf1_i'  => $i,);
      $prehled+= array ('pocet_znamek_jmeno_graf1'  => $data_pocet_znamek_nazev,);
      
      
      
      
      
      
      
      
      //graf třídy
     $query=$this->database->query("SELECT count(id_znamky) AS `pocet_znamek`, t.jmeno_tridy AS `nazev_tridy` FROM `znamky` INNER JOIN users ON znamky.zak=users.id_users INNER JOIN trida AS `t` ON users.trida=t.id_tridy WHERE zak=".$user->getId()." GROUP BY trida ORDER BY nazev_tridy");
     
   
       $data_pocet_znamek=array();
        $data_pocet_znamek_nazev=array();
        $data_pocet_znamek_barva=array();
       $i=1;
       $j=0;
                foreach ($query as $quer) {  
                    $color = dechex(rand(0x000000, 0xFFFFFF));
                 $data_pocet_znamek+= array (''.$i.''  => ''.$quer->pocet_znamek.'',); 
                  $data_pocet_znamek_nazev+= array (''.$i.''  => ''.$quer->nazev_tridy.'',); 
                  $data_pocet_znamek_barva+= array (''.$i.''  => ''.$color.'',); 
                $i++;
                $j=$j + $quer->pocet_znamek; 
                }
           // dump($j); 
      $prehled+= array ('pocet_znamek_graf2'  => $data_pocet_znamek,);
      $prehled+= array ('celkovy_pocet_znamek_graf2'  => $j,);
      $prehled+= array ('pocet_znamek_graf2_i'  => $i,);
      $prehled+= array ('pocet_znamek_jmeno_graf2'  => $data_pocet_znamek_nazev,);
       $prehled+= array ('pocet_znamek_graf2_barva'  => $data_pocet_znamek_barva,);
      
     // dump($color);
      
       
     
        //graf známky počet výskytů
      $query=$this->database->query("SELECT count(znamka) AS `znamka_pocet`, znamka FROM `znamky` where zak=".$user->getId()." GROUP BY znamka ORDER BY count(znamka) DESC");
     // dump($query);
      
       $data_pocet_znamek=array();
        $data_pocet_znamek_nazev=array();
        
       $i=1;
       $j=0;
       $zbytek=0;
                foreach ($query as $quer) {  
                 if(round(100*$quer->znamka_pocet/$prehled['pocet_znamek'])>2)  {
                 $data_pocet_znamek+= array (''.$i.''  => ''.$quer->znamka_pocet.'',); 
                  $data_pocet_znamek_nazev+= array (''.$i.''  => ''.$quer->znamka.'',);     
                 } 
                 else{
                 $data_pocet_znamek+= array (''.$i.''  => ''.$quer->znamka_pocet.'',); 
                  $data_pocet_znamek_nazev+= array (''.$i.''  => 'Zbytek',);     
                    $zbytek=$zbytek+$quer->znamka_pocet; 
                 }
               
                $i++;
                $j=$j + $quer->znamka_pocet; 
                }
        //   dump($j); 
      $prehled+= array ('pocet_znamek_graf3'  => $data_pocet_znamek,);
      $prehled+= array ('celkovy_pocet_znamek_graf3'  => $j,);
      $prehled+= array ('pocet_znamek_graf3_i'  => $i,);
      $prehled+= array ('pocet_znamek_jmeno_graf3'  => $data_pocet_znamek_nazev,);
        $prehled+= array ('pocet_znamek_graf3_zbytek'  => $zbytek,);
     return $prehled;
}
 
  




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
   $den=date("j",$datum);
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
   
 if(!isset($query['predmet']))$query['predmet']=0;
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
      
      
      
      
      
      //graf předměty
     $query=$this->database->query("SELECT count(id_znamky) AS `pocet_znamek`, predmet, p.nazev AS `nazev_predmetu` FROM `znamky` INNER JOIN predmet AS `p` ON"
             . " znamky.predmet=p.id_predmetu WHERE ucitel=".$user->getId()." GROUP BY predmet ORDER BY nazev_predmetu");
     
   
       $data_pocet_znamek=array();
        $data_pocet_znamek_nazev=array();
        
       $i=1;
       $j=0;
                foreach ($query as $quer) {  
                 $data_pocet_znamek+= array (''.$i.''  => ''.$quer->pocet_znamek.'',); 
                  $data_pocet_znamek_nazev+= array (''.$i.''  => ''.$quer->nazev_predmetu.'',); 
                $i++;
                $j=$j + $quer->pocet_znamek; 
                }
           // dump($j); 
      $prehled+= array ('pocet_znamek_graf1'  => $data_pocet_znamek,);
      $prehled+= array ('celkovy_pocet_znamek_graf1'  => $j,);
      $prehled+= array ('pocet_znamek_graf1_i'  => $i,);
      $prehled+= array ('pocet_znamek_jmeno_graf1'  => $data_pocet_znamek_nazev,);
      
      
      
      
      
      
      
      
      //graf třídy
     $query=$this->database->query("SELECT count(id_znamky) AS `pocet_znamek`, t.jmeno_tridy AS `nazev_tridy` FROM `znamky` INNER JOIN users ON znamky.zak=users.id_users INNER JOIN trida AS `t` ON users.trida=t.id_tridy WHERE ucitel=".$user->getId()." GROUP BY trida ORDER BY nazev_tridy");
     
   
       $data_pocet_znamek=array();
        $data_pocet_znamek_nazev=array();
        $data_pocet_znamek_barva=array();
       $i=1;
       $j=0;
                foreach ($query as $quer) {  
                    $color = dechex(rand(0x000000, 0xFFFFFF));
                 $data_pocet_znamek+= array (''.$i.''  => ''.$quer->pocet_znamek.'',); 
                  $data_pocet_znamek_nazev+= array (''.$i.''  => ''.$quer->nazev_tridy.'',); 
                  $data_pocet_znamek_barva+= array (''.$i.''  => ''.$color.'',); 
                $i++;
                $j=$j + $quer->pocet_znamek; 
                }
           // dump($j); 
      $prehled+= array ('pocet_znamek_graf2'  => $data_pocet_znamek,);
      $prehled+= array ('celkovy_pocet_znamek_graf2'  => $j,);
      $prehled+= array ('pocet_znamek_graf2_i'  => $i,);
      $prehled+= array ('pocet_znamek_jmeno_graf2'  => $data_pocet_znamek_nazev,);
       $prehled+= array ('pocet_znamek_graf2_barva'  => $data_pocet_znamek_barva,);
      
     // dump($color);
      
       
     
        //graf známky počet výskytů
      $query=$this->database->query("SELECT count(znamka) AS `znamka_pocet`, znamka FROM `znamky` where ucitel=".$user->getId()." GROUP BY znamka ORDER BY count(znamka) DESC");
     // dump($query);
      
       $data_pocet_znamek=array();
        $data_pocet_znamek_nazev=array();
        
       $i=1;
       $j=0;
       $zbytek=0;
                foreach ($query as $quer) {  
                 if(round(100*$quer->znamka_pocet/$prehled['pocet_znamek'])>2)  {
                 $data_pocet_znamek+= array (''.$i.''  => ''.$quer->znamka_pocet.'',); 
                  $data_pocet_znamek_nazev+= array (''.$i.''  => ''.$quer->znamka.'',);     
                 } 
                 else{
                 $data_pocet_znamek+= array (''.$i.''  => ''.$quer->znamka_pocet.'',); 
                  $data_pocet_znamek_nazev+= array (''.$i.''  => 'Zbytek',);     
                    $zbytek=$zbytek+$quer->znamka_pocet; 
                 }
               
                $i++;
                $j=$j + $quer->znamka_pocet; 
                }
        //   dump($j); 
      $prehled+= array ('pocet_znamek_graf3'  => $data_pocet_znamek,);
      $prehled+= array ('celkovy_pocet_znamek_graf3'  => $j,);
      $prehled+= array ('pocet_znamek_graf3_i'  => $i,);
      $prehled+= array ('pocet_znamek_jmeno_graf3'  => $data_pocet_znamek_nazev,);
        $prehled+= array ('pocet_znamek_graf3_zbytek'  => $zbytek,);
     return $prehled;
}





  
  		public function renderPrehled()
{
            $user =  $this->getUser();
            $this->template->uzivatel=$user;
           if(!$user->isInRole("1")){
            $this->template->prehled=  $this->PrehledUcitel();
           }
              else{
            $this->template->prehled=  $this->PrehledZak();
}
           
           
}       
  
 
} 







	
	

        
        
        