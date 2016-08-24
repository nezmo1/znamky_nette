<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamCvZnamekZak extends Grid{

    protected $znamky;
    public $database;
    public $predmet_pom;
    public $zak_pom;
    public $ucitel;
    public $datum;
    public function __construct($znamky, \Nette\Database\Context $database, $ucitel)
    {
        parent::__construct();
        $this->znamky = $znamky;
      $this->database = $database;
      $this->ucitel = $ucitel;   
    
    }

    protected function configure($presenter)
    {
          $vaha=array('1' => 'Nízká','2' => 'Normální','3' => 'Vysoká');
          $predmety=  $this->database->query('SELECT DISTINCT predmet, p.nazev AS `nazev` FROM prum_znamky INNER JOIN predmet as `p` on predmet=p.id_predmetu where zak= ?',$this->ucitel->id,' ORDER BY nazev');
          $ucitele=  $this->database->query('SELECT DISTINCT ucitel,u.jmeno AS `jmeno`, u.prijmeni AS `prijmeni` FROM prum_znamky INNER JOIN users AS `u` ON ucitel=u.id_users WHERE zak= ?',$this->ucitel->id,' ORDER BY prijmeni');      
              $this->predmet_pom=array();
                foreach ($predmety as $predmet) {  
                 $this->predmet_pom+= array (''.$predmet->predmet.''  => ''.$predmet->nazev.'',); 
                } 
                
                $this->zak_pom=array();
                foreach ($ucitele as $ucitel) {  
                 $this->zak_pom+= array (''.$ucitel->ucitel.''  => ''.$ucitel->jmeno.' '.$ucitel->prijmeni.'',); 
                } 
                
               
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->znamky->select('id_prum_znamky, ctvrtleti_1, ctvrtleti_2, ctvrtleti_3, ctvrtleti_4, ucitel, zak, predmet'));
     
//Předáme zdroj
        $this->setDataSource($source);
          $self = $this; 
      
               
        $this->addColumn('ctvrtleti_1', '1. čtvrtletí', '')
            ->setTextFilter()
            ->setRenderer(function($row){
          
             return $row['ctvrtleti_1'] == NULL ? "-" : $row['ctvrtleti_1'];    
        }) 
            ->setCellRenderer(function($row){return $row['ctvrtleti_1'] == $row['ctvrtleti_1'] ? "text-align:center" : NULL;})
               
               ->setSortable(FALSE);
       $this->addColumn('ctvrtleti_2', 'Pololetí', '')
            ->setTextFilter()
            ->setRenderer(function($row){
          
             return $row['ctvrtleti_2'] == NULL ? "-" : $row['ctvrtleti_2'];    
        })    
            ->setCellRenderer(function($row){return $row['ctvrtleti_2'] == $row['ctvrtleti_2'] ? "text-align:center" : NULL;})   
               ->setSortable(FALSE);
       
       $this->addColumn('ctvrtleti_3', '3. čtvrtletí', '')
            ->setTextFilter()
            ->setRenderer(function($row){
          
             return $row['ctvrtleti_3'] == NULL ? "-" : $row['ctvrtleti_3'];    
        })    
            ->setCellRenderer(function($row){return $row['ctvrtleti_3'] == $row['ctvrtleti_3'] ? "text-align:center" : NULL;})   
               ->setSortable(FALSE);
       
       $this->addColumn('ctvrtleti_4', 'Konec roku', '')
            ->setTextFilter()
            ->setRenderer(function($row){
          
             return $row['ctvrtleti_4'] == NULL ? "-" : $row['ctvrtleti_4'];    
        })    
            ->setCellRenderer(function($row){return $row['ctvrtleti_4'] == $row['ctvrtleti_4'] ? "text-align:center" : NULL;})   
               ->setSortable(FALSE);
               
           
           
       $this->addColumn('predmet', 'Předmět', '')
               
           ->setRenderer(function($row) use($self){
               
                 
                   $jmeno_predmetu=$row['predmet'];
                   return \Nette\Utils\Html::el('font')->setText($self->predmet_pom[$jmeno_predmetu])->addAttributes(array('style' => 'font-weight:bold;'));
                 })
                   ->setSelectFilter($this->predmet_pom);
       
       
        
        
        
         $this->addColumn('ucitel', 'Učitel', '')
               ->setSelectFilter($this->zak_pom)
                ->setRenderer(function($row) use($self){
                   
            
                   $jmeno_zaka=$row['ucitel'];
                     
                     return \Nette\Utils\Html::el('font')->setText($self->zak_pom[$jmeno_zaka])->addAttributes(array('style' => 'font-weight:normal;'));
                   });    
               
         
                 
         
      
          
 
       /* $this->addButton(Grid::ROW_FORM, "Rychlá editace")
             ->setClass("fast-edit"); */
//        ->setAjax(FALSE);
     
    
    
$self = $this;




     
    
    
 $this->setDefaultOrder("id_prum_znamky DESC");   
$this->setWidth('100%');
 
    }
    

    
}

