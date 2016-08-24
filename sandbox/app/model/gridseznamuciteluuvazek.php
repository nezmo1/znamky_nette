<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamUciteluUvazek extends Grid{

    protected $ucitele;
    public $database;
    public $uvazek;
    public $pocet_ve_tride;
    public $odkaz;
    public $trida;
    public $pocet_v_predmetech;
    public $cela_trida;
    
    public function __construct($uvazek, \Nette\Database\Context $database, $odkaz)
    {
        parent::__construct();
        $this->uvazek = $uvazek;  
      $this->database = $database;
      $this->odkaz = $odkaz;    
    
    }

    protected function configure($presenter)
    {
         
        $p_pocet_uvazku_ve_tride=$this->database->query('SELECT ucitel,COUNT(DISTINCT trida) as `ucitele_uvazek` FROM ucitele_uvazek GROUP BY ucitel'); 
           
          $this->pocet_ve_tride=array();
                foreach ($p_pocet_uvazku_ve_tride as $pocet_uvazku_ve_trida) {  
                 $this->pocet_ve_tride+= array (''.$pocet_uvazku_ve_trida->ucitel.''  => ''.$pocet_uvazku_ve_trida->ucitele_uvazek.'',); 
                }
         
        $p_pocet_uvazku_v_predmetech=$this->database->query('SELECT ucitel,COUNT(DISTINCT predmet) as `ucitele_uvazek` FROM ucitele_uvazek GROUP BY ucitel'); 
           
          $this->pocet_v_predmetech=array();
                foreach ($p_pocet_uvazku_v_predmetech as $pocet_uvazku_v_predmetu) {  
                 $this->pocet_v_predmetech+= array (''.$pocet_uvazku_v_predmetu->ucitel.''  => ''.$pocet_uvazku_v_predmetu->ucitele_uvazek.'',); 
                }
     
                
                
                
                 
      
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->uvazek->select('id_users, id_users AS `pocet`, id_users AS `pocet_predmetu`, CONCAT(prijmeni,\' \',jmeno) AS `ucitel`'));
     
//Předáme zdroj
        $this->setDataSource($source);
        
      $self=$this;
               
       $this->addColumn('ucitel', 'Učitel', '')
        ->setRenderer(function($row) use($self){
                  
                 return \Nette\Utils\Html::el('a')->href($self->odkaz, array('ucitelId'=>$row['id_users'],))->setText($row['ucitel'])->addAttributes(array('style' => 'color:#00111a;font-weight:bold;'));
               })
                ->setSortable(FALSE);
          
              
       $this->addColumn('id_users', 'Počet vyučovaných tříd', '')
         ->setRenderer(function($row) use($self){
                   $pocet_trida=$row['pocet'];
                   
                 if(isset($self->pocet_ve_tride[$pocet_trida])){
                    return \Nette\Utils\Html::el('font')->setText($self->pocet_ve_tride[$pocet_trida])->addAttributes(array('style' => 'font-weight:normal;')); 
                    }
                 else {
                    return \Nette\Utils\Html::el('font')->setText('0')->addAttributes(array('style' => 'font-weight:bold;color:red')); 
                 }
                 
                   
                   
                   })
                    ->setSortable(FALSE);
          
       
     $this->addColumn('pocet_predmetu', 'Počet vyučovaných předmětů', '')
         ->setRenderer(function($row) use($self){
                   $pocet_trida=$row['pocet_predmetu'];
                   
                 if(isset($self->pocet_v_predmetech[$pocet_trida])){
                    return \Nette\Utils\Html::el('font')->setText($self->pocet_v_predmetech[$pocet_trida])->addAttributes(array('style' => 'font-weight:normal;')); 
                    }
                 else {
                    return \Nette\Utils\Html::el('font')->setText('0')->addAttributes(array('style' => 'font-weight:bold;color:red')); 
                 }
                 
                   
                   
                   })
                    ->setSortable(FALSE);
       
 
     
     
    
    



 
 





     
    
    
 
 
    }
    
  


    

    
}

