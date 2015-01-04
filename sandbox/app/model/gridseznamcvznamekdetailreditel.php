<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamCvZnamekDetailReditel extends Grid{

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
         
          $predmety=  $this->database->query('SELECT DISTINCT predmet, p.nazev AS `nazev` FROM prum_znamky INNER JOIN predmet as `p` on predmet=p.id_predmetu where ucitel= ?',$this->ucitel,' ORDER BY nazev');
          $zaci=  $this->database->query('SELECT DISTINCT zak,u.jmeno AS `jmeno`, u.prijmeni AS `prijmeni` FROM prum_znamky INNER JOIN users AS `u` ON zak=u.id_users WHERE ucitel= ?',$this->ucitel,' ORDER BY prijmeni');      
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
                
             
      
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->znamky->select('id_prum_znamky, ctvrtleti_1,ctvrtleti_2,ctvrtleti_3,ctvrtleti_4, zak AS `trida`, ucitel, zak, predmet'));
     
//Předáme zdroj
        
        $this->setDataSource($source);
        $self = $this;  
       $this->addColumn('zak', 'Žák', '150px')
               ->setSelectFilter($this->zak_pom)
                ->setRenderer(function($row) use($self){
                   
               
                   $jmeno_zaka=$row['zak'];
                     return \Nette\Utils\Html::el('font')->setText($self->zak_pom[$jmeno_zaka])->addAttributes(array('style' => 'font-weight:bold;'));
                   });    
               
               
       $this->addColumn('ctvrtleti_1', '1. čtvrtletí', '120px')
            ->setTextFilter()
            ->setRenderer(function($row){
          
             return $row['ctvrtleti_1'] == NULL ? "-" : $row['ctvrtleti_1'];    
        }) 
            ->setCellRenderer(function($row){return $row['ctvrtleti_1'] == $row['ctvrtleti_1'] ? "text-align:center" : NULL;})
               
               ->setSortable(FALSE);
       $this->addColumn('ctvrtleti_2', 'Pololetí', '120px')
            ->setTextFilter()
            ->setRenderer(function($row){
          
             return $row['ctvrtleti_2'] == NULL ? "-" : $row['ctvrtleti_2'];    
        })    
            ->setCellRenderer(function($row){return $row['ctvrtleti_2'] == $row['ctvrtleti_2'] ? "text-align:center" : NULL;})   
               ->setSortable(FALSE);
       
       $this->addColumn('ctvrtleti_3', '3. čtvrtletí', '120px')
            ->setTextFilter()
            ->setRenderer(function($row){
          
             return $row['ctvrtleti_3'] == NULL ? "-" : $row['ctvrtleti_3'];    
        })    
            ->setCellRenderer(function($row){return $row['ctvrtleti_3'] == $row['ctvrtleti_3'] ? "text-align:center" : NULL;})   
               ->setSortable(FALSE);
       
       $this->addColumn('ctvrtleti_4', 'Konec roku', '120px')
            ->setTextFilter()
            ->setRenderer(function($row){
          
             return $row['ctvrtleti_4'] == NULL ? "-" : $row['ctvrtleti_4'];    
        })    
            ->setCellRenderer(function($row){return $row['ctvrtleti_4'] == $row['ctvrtleti_4'] ? "text-align:center" : NULL;})   
               ->setSortable(FALSE);
       
         $this->addColumn('predmet', 'Předmět', '200px')
           ->setRenderer(function($row) use($self){
                   
                 
                   $jmeno_predmetu=$row['predmet'];
                   
                   return $self->predmet_pom[$jmeno_predmetu] ;})
                   ->setSelectFilter($this->predmet_pom);
                $this->addColumn('trida', 'Třída')
                ->setRenderer(function($row) use($self){
                   
                 
                   $zak_v_tride=$row['zak'];
                   
                   return $self->trida[$zak_v_tride] ;})
                 
            ->setSortable(FALSE);
            
                   
          
       
      
          
 
       /* $this->addButton(Grid::ROW_FORM, "Rychlá editace")
             ->setClass("fast-edit"); */
//        ->setAjax(FALSE);
   /*  $this->addButton("edit", "Editovat")
    ->setClass("edit")
    ->setLink(function($row) use ($presenter){return $presenter->link("edit:CvZnamka", $row['id_prum_znamky']);})
    ->setAjax(FALSE);
    
    
 




     $this->addButton("delete", "Smazat")
          ->setClass("delete")
          ->setLink(function($row) use ($self){return $self->link("delete!", $row['id_prum_znamky']);})
          ->setConfirmationDialog(function($row){return "Určitě chcete smazat tuto čtvrtletní klasifikaci?";});
          
    
    */
 $this->setDefaultOrder("id_prum_znamky DESC");   
$this->setWidth('100%');
 
    }
    
  function handleDelete($idznamky) {
      
      
    $this->database->query('DELETE FROM prum_znamky WHERE id_prum_znamky=?', $idznamky);
    $this->flashMessage('Smazáno.');
}  
    
}



