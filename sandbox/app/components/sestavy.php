<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Nette\Application\UI\PresenterComponent,
        Nette\Security\User;
       
       

class Sestavy extends Nette\Application\UI\PresenterComponent
{
     public $database;

    public function __construct(Nette\Database\Context $database)
    {

        $this->database = $database;
    }

    public function render()
    {
         
        $predmety=  $this->database->query('SELECT id_predmetu,zkratka_predmetu FROM predmet ORDER BY zkratka_predmetu');
       $predmets=array();
       $zaci=  $this->database->query('SELECT id_users,CONCAT(prijmeni," ",jmeno) as `cele_jmeno` FROM users where trida !="42"');
       $zacis=array(); 
       
       
       foreach ($predmety as $predmet) {  
                    
                 $predmets+= array (''.$predmet->id_predmetu.''  => ''.$predmet->zkratka_predmetu.'',); 
                 }
        foreach ($zaci as $zak) {  
                    
                 $zacis+= array (''.$zak->id_users.''  => ''.$zak->cele_jmeno.'',); 
                 }
       
                 
                 
      // for($i=0;$i<$pocet->pocet;$i++){
           foreach($zacis as $zak => $values) { 
            echo "<table border='1' style='border-collapse: collapse'>";
            echo "<tr>";
            echo "<td></td>";
           foreach($predmets as $predmet => $value)
{
            echo "<td width='30px' style='text-align:center' >";
            echo $value;
            echo "</td>";  
}
            
        echo "</tr>";  
        
        echo "<tr>";
        echo "<td width='150px' >".$values."</td>";
        
        
        
            foreach($predmets as $predmet => $value)
{
            

        $znamka= $this->database->query('SELECT id_prum_znamky, ctvrtleti_1, predmet, zak FROM `prum_znamky` WHERE predmet= '.$predmet.' AND zak= '.$zak.'')->fetch();
      
      
       if($znamka!=FALSE){
        echo "<td style='text-align:center'>$znamka->ctvrtleti_1</td>";
       }
           else {echo "<td style='text-align:center'>-</td>";}
}
        echo "</tr>";

      echo "</table>";         
        echo "<br />";         
       }
                 
       
                
                
           
        
        
       
        
        
       
       
        
        
        
       
            
          
     
           
           
        
        
        
        
    
        
        
        
        
        
    }
}