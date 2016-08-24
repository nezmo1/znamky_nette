<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamZnamekZak extends Grid{

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
          $predmety=  $this->database->query('SELECT DISTINCT predmet, p.nazev AS `nazev` FROM znamky INNER JOIN predmet as `p` on predmet=p.id_predmetu where zak= ?',$this->ucitel->id,' ORDER BY nazev');
          $ucitele=  $this->database->query('SELECT DISTINCT ucitel,u.jmeno AS `jmeno`, u.prijmeni AS `prijmeni` FROM znamky INNER JOIN users AS `u` ON ucitel=u.id_users WHERE zak= ?',$this->ucitel->id,' ORDER BY prijmeni');      
          $data= $this->database->query('SELECT DISTINCT datum, DATE_FORMAT(datum,"%d-%m-%Y") as `data` FROM znamky WHERE zak= ?',$this->ucitel->id,' ORDER BY datum');  
              $this->predmet_pom=array();
                foreach ($predmety as $predmet) {  
                 $this->predmet_pom+= array (''.$predmet->predmet.''  => ''.$predmet->nazev.'',); 
                } 
                
                $this->zak_pom=array();
                foreach ($ucitele as $ucitel) {  
                 $this->zak_pom+= array (''.$ucitel->ucitel.''  => ''.$ucitel->jmeno.' '.$ucitel->prijmeni.'',); 
                } 
                
                 $this->datum=array();
                foreach ($data as $datum) {  
                 $this->datum+= array (''.$datum->datum.''  => ''.$datum->data.'',); 
                } 
      
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->znamky->select('id_znamky, znamka, popis, datum, vaha, ucitel, zak, predmet'));
     
//Předáme zdroj
        $this->setDataSource($source);
        
      
               
       $this->addColumn('znamka', 'Známka', '')
            ->setTextFilter()
               
               ->setSortable(FALSE);
       $this->addColumn('popis', 'Popis', '')
               ->setTextFilter()
               ->setSortable(FALSE); 
           $self = $this;   
       $this->addColumn('predmet', 'Předmět', '')
               
           ->setRenderer(function($row) use($self){
               
                 
                   $jmeno_predmetu=$row['predmet'];
                   return \Nette\Utils\Html::el('font')->setText($self->predmet_pom[$jmeno_predmetu])->addAttributes(array('style' => 'font-weight:bold;'));
                 })
                   ->setSelectFilter($this->predmet_pom);
       
       
         $this->addColumn('vaha', 'Váha', '')
               ->setSelectFilter($vaha)  
              ->setRenderer(function($row){
             switch ($row['vaha']) {
                 case 1: $vaha="Nízká";
                         $barva="font-style:italic";
                     break;
                 case 2: $vaha="Normální";
                         $barva="";
                     break;
                 case 3: $vaha="Vysoká";
                         $barva="font-weight:bold";
                     break;
                 default:
                     break;
             }
             return \Nette\Utils\Html::el('font')->setText($vaha)->addAttributes(array('style' => $barva));
             // return $vaha;    
        });
        
        
         $this->addColumn('ucitel', 'Učitel', '')
               ->setSelectFilter($this->zak_pom)
                ->setRenderer(function($row) use($self){
                   
            
                   $jmeno_zaka=$row['ucitel'];
                     
                     return \Nette\Utils\Html::el('font')->setText($self->zak_pom[$jmeno_zaka])->addAttributes(array('style' => 'font-weight:normal;'));
                   });    
               
         
                 
           $this->addColumn('datum', 'Datum', '')
                 ->setSelectFilter($this->datum)  
                 ->setRenderer(function($row){return date('j. n. Y', strtotime($row['datum']));});  
       
      
          
 
       /* $this->addButton(Grid::ROW_FORM, "Rychlá editace")
             ->setClass("fast-edit"); */
//        ->setAjax(FALSE);
     
    
    
$self = $this;




     
    
    
 $this->setDefaultOrder("id_znamky DESC");   
$this->setWidth('100%');
 
    }
    
  function handleDelete($idznamky) {
      
      
    $this->database->query('DELETE FROM znamky WHERE id_znamky=?', $idznamky);
    $this->flashMessage('Učitel byl smazán.');
}  
    
}

