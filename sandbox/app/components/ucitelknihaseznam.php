<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Nette\Application\UI\PresenterComponent,
        Nette\Security\User;
       
       

class UcitelKnihaSeznam extends Nette\Application\UI\PresenterComponent
{
     public $database;
     

    public function __construct(Nette\Database\Context $database)
    {

        $this->database = $database;
       
        
    }

   
    
    public function VyberTrid($ucitel){
    $predmety=  $this->database->query('SELECT uv.ucitele_uvazek, uv.ucitel,uv.predmet as `predmet`,uv.trida as `trida`,t.jmeno_tridy as `jmeno_tridy`,p.nazev as `nazev` FROM `ucitele_uvazek` as `uv` 
INNER JOIN trida as `t` on uv.trida=t.id_tridy
INNER JOIN predmet as `p` on uv.predmet=p.id_predmetu
WHERE ucitel= ?', $ucitel,' ORDER by trida');  
    
   
    $predmety_pom=array();
     
                foreach ($predmety as $predmet) {  
                 $predmety_pom+= array (''.$predmet->trida.''  => ''.$predmet->jmeno_tridy.'',); 
                } 
    return $predmety_pom;
  } 
    
    
    
    
   
    public function VyberPredmetu($ucitel,$trida){
    $predmety=  $this->database->query('SELECT uv.ucitele_uvazek, uv.ucitel,uv.predmet as `predmet`,uv.trida as `trida`,t.jmeno_tridy as `jmeno_tridy`,p.nazev as `nazev` FROM `ucitele_uvazek` as `uv` 
INNER JOIN trida as `t` on uv.trida=t.id_tridy
INNER JOIN predmet as `p` on uv.predmet=p.id_predmetu
WHERE ucitel= ?', $ucitel,' ORDER by trida, nazev ');  
    
   
    
   
   
    $predmety_pom=array();
                foreach ($predmety as $predmet) {  
                $skupina=$this->database->table('skupina')->where('ucitel',$ucitel)->where('predmet',$predmet->predmet)->fetchAll(); 
                
                if($skupina!=FALSE){
                    foreach($skupina as $sk){
                     $predmety_pom+= array ('s_'.$sk->id_skupiny.''  => ''.$sk->nazev_skupiny.'',);   
                    }
                        
                    }
                   else {
                     $predmety_pom+= array ('p_'.$predmet->ucitele_uvazek.''  => ''.$predmet->jmeno_tridy.'. třída - '.$predmet->nazev.'',);   
                   }
                        
     
                
                    
                } 
    return $predmety_pom;
  }  
    
   
  
 
  
  
    public function render()
    {
          
        
        // tlačítka
        $ucitel=$this->presenter->getUser()->id;
       $trida=  $this->VyberTrid($ucitel);
           
       $predmety=  $this->VyberPredmetu($ucitel, $trida);
       $x = array_keys($predmety);
       $i=0;
        echo '<div class="btn-group btn-group-justified">';
                foreach($predmety as $predmet){
              echo '<a href="?uvazek='.$x[$i].'" class="btn btn-primary">'.$predmet.'</a>';
              $i++;
                }
                  
              echo '</div>';
        
        
        //tabulka
        $get=$this->presenter->request->getParameters();
        if(isset($get['uvazek'])){
        $uvazekc=$get['uvazek'];
       
        
        $skupina=  explode("_", $uvazekc);
        
        if($skupina[0]=="p"){
         $zaci=  $this->database->query("SELECT CONCAT(u.jmeno,' ',u.prijmeni) as `cele_jmeno`, u.id_users as `zak` FROM `users` as `u`
                                            INNER JOIN trida as `t` on u.trida=t.id_tridy
                                            WHERE trida=".$skupina[2]."
                                            ORDER BY prijmeni, jmeno")->fetchAll();   
        
        }
        
       else {
         $zaci=  $this->database->query("SELECT CONCAT(u.jmeno,' ',u.prijmeni) as `cele_jmeno`, cs.id_clen_skupiny, cs.id_skupiny, cs.zak, s.predmet as `predmet` FROM `clenove_skupiny` as `cs`
                                        INNER JOIN skupina as `s` on cs.id_skupiny=s.id_skupiny
                                        INNER JOIN users as `u` on cs.zak=u.id_users
                                        WHERE s.id_skupiny=".$skupina[1]."
                                        ORDER BY prijmeni, jmeno")->fetchAll(); 
         
       } 
        
        
     
       echo '<div class="table-responsive">';
        
    echo        '<table class="table table-striped datagrid">
    <thead>
      <tr>
        <th><div><span>Jméno</span></div></th>';
        
     
    
    
    


    
   $popisy=  $this->database->query("SELECT * FROM `znamky` WHERE predmet=".$skupina[3]." and ucitel=".$ucitel." GROUP BY popis ORDER BY datum ASC")->fetchAll(); 
           $popisc=array();
           $j=0;
            foreach ($popisy as $popis) {  
                 $popisc+= array (''.$j.''  => ''.$popis->popis.'',); 
                echo '<th><div><span>'.$popis->popis.'</span></div></th>';
                 $j++;
                 
            }
          //  dump($popisc);
            
  $p_popis=sizeof($popisc);
  
    
    
    echo '</tr>
    </thead>
    <tbody>';
    
    
    
    // známky
    
    foreach ($zaci as $zak) {
        
        echo "<tr><td>".$zak['cele_jmeno']."</td>";
    if($skupina[0]=="p") {    
    $predmetc=$skupina[3];
    
    }
    else {
        $predmetc=$zak['predmet'];
        
    }
    
        
                
           $znamky=  $this->database->query("SELECT * FROM `znamky` WHERE zak=".$zak['zak']." and predmet=".$predmetc." and ucitel=".$ucitel)->fetchAll(); 
           $p_znamek=  $this->database->query("SELECT * FROM `znamky` WHERE zak=".$zak['zak']." and predmet=".$predmetc." and ucitel=".$ucitel); 
           $p_znamek=count($znamky);
           //dump($p_znamek);
           
       for($i=0;$i<$p_popis;$i++){
           for($j=0;$j<$p_znamek;$j++){
               
            if($znamky[$j]['popis']==$popisc[$i]){
                echo "<td>".$znamky[$j]['znamka']."</td>";  
                $pom=1;
                
            }
          
            
           }
           
      //  if($pom==1) echo "<td>".$i."hh</td>"; $pom=0;
           
       }    
          
        
        
        
        echo "</tr>";
    }
    
    
      echo '
    </tbody>
  </table>';
  echo "</div>";          
            
            
        }
              
              
              
              
        
     
        
        
        
    }
}