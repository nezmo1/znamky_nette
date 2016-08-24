<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamZnamekDetailReditel extends Grid{

    protected $znamky;
    public $database;
    public $predmet_pom;
    public $zak_pom;
    public $ucitel;
    public $datum;
    public $trida;
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
          $predmety=  $this->database->query('SELECT DISTINCT predmet, p.nazev AS `nazev` FROM znamky INNER JOIN predmet as `p` on predmet=p.id_predmetu where ucitel= ?',$this->ucitel,' ORDER BY nazev');
          $zaci=  $this->database->query('SELECT DISTINCT zak,u.jmeno AS `jmeno`, u.prijmeni AS `prijmeni` FROM znamky INNER JOIN users AS `u` ON zak=u.id_users WHERE ucitel= ?',$this->ucitel,' ORDER BY prijmeni');      
          $data= $this->database->query('SELECT DISTINCT datum, DATE_FORMAT(datum,"%d-%m-%Y") as `data` FROM znamky WHERE ucitel= ?',$this->ucitel,' ORDER BY datum');  
          $tridy=  $this->database->query('SELECT DISTINCT id_users, t.jmeno_tridy AS `trida` FROM users INNER JOIN trida AS `t` on trida=id_tridy WHERE trida !=42 and priorita !=4 GROUP BY id_users');    
                $this->trida=array();
                foreach ($tridy as $trida) {  
                 $this->trida+= array (''.$trida->id_users.''  => ''.$trida->trida.'',); 
                }
                
                $this->predmet_pom=array();
                foreach ($predmety as $predmet) {  
                 $this->predmet_pom+= array (''.$predmet->predmet.''  => ''.$predmet->nazev.'',); 
                } 
                
                $this->zak_pom=array();
                foreach ($zaci as $zak) {  
                 $this->zak_pom+= array (''.$zak->zak.''  => ''.$zak->jmeno.' '.$zak->prijmeni.'',); 
                } 
                
                 $this->datum=array();
                foreach ($data as $datum) {  
                 $this->datum+= array (''.$datum->datum.''  => ''.$datum->data.'',); 
                } 
      
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->znamky->select('id_znamky, znamka, zak AS `trida`, popis, datum, vaha, ucitel, zak, predmet'));
     
//Předáme zdroj
        
        $this->setDataSource($source);
        $self = $this;  
       $this->addColumn('zak', 'Žák', '')
               ->setSelectFilter($this->zak_pom)
                ->setRenderer(function($row) use($self){
                   
               
                   $jmeno_zaka=$row['zak'];
                     return \Nette\Utils\Html::el('font')->setText($self->zak_pom[$jmeno_zaka])->addAttributes(array('style' => 'font-weight:bold;'));
                   });    
               
               
       $this->addColumn('znamka', 'Známka', '')
            ->setTextFilter()
               
               ->setSortable(FALSE);
       $this->addColumn('popis', 'Popis', '')
               ->setTextFilter()
               ->setSortable(FALSE); 
             
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
         $this->addColumn('predmet', 'Předmět', '')
           ->setRenderer(function($row) use($self){
                   
                 
                   $jmeno_predmetu=$row['predmet'];
                   
                   return $self->predmet_pom[$jmeno_predmetu] ;})
                   ->setSelectFilter($this->predmet_pom);
                $this->addColumn('trida', 'Třída')
                ->setRenderer(function($row) use($self){
                   
                 
                   $zak_v_tride=$row['zak'];
                   
                   return $self->trida[$zak_v_tride] ;})
                 
            ->setSortable(FALSE);
            
                   
                   
           $this->addColumn('datum', 'Datum', '')
                 ->setSelectFilter($this->datum)  
                 ->setRenderer(function($row){return date('j. n. Y', strtotime($row['datum']));});  
       
      
          
 
       /* $this->addButton(Grid::ROW_FORM, "Rychlá editace")
             ->setClass("fast-edit"); */
//        ->setAjax(FALSE);
                 /*
     $this->addButton("edit", "Editovat")
    ->setClass("edit")
    ->setLink(function($row) use ($presenter){return $presenter->link("edit:znamka", $row['id_znamky']);})
    ->setAjax(FALSE);
    
    
 




     $this->addButton("delete", "Smazat")
          ->setClass("delete")
          ->setLink(function($row) use ($self){return $self->link("delete!", $row['id_znamky']);})
          ->setConfirmationDialog(function($row){return "Určitě chcete smazat tuto známku?";});
          
    
    */
 $this->setDefaultOrder("id_znamky DESC");   
$this->setWidth('100%');
 
    }
    /*
  function handleDelete($idznamky) {
      
      
    $this->database->query('DELETE FROM znamky WHERE id_znamky=?', $idznamky);
    $this->flashMessage('Učitel byl smazán.');
}  
  */  
}

