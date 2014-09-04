<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamZnamekUcitel extends Grid{

    protected $znamky;
    public $database;
    public $trida_pom;
    public function __construct($znamky, \Nette\Database\Context $database)
    {
        parent::__construct();
        $this->znamky = $znamky;
      $this->database = $database;
         
    
    }

    protected function configure($presenter)
    {
          $tridy=  $this->database->table('trida')->where('zkratka_tridy !=','ucitel')->order('zkratka_tridy');
                
                $this->trida_pom=array();
                foreach ($tridy as $trida) {  
                 $this->trida_pom+= array (''.$trida->id_tridy.''  => ''.$trida->jmeno_tridy.'',); 
                } 
      
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->znamky->select('id_znamky,LEFT(znamka,8) AS `znamka`, LEFT(popis,8) AS `popis`, DATE_FORMAT(datum,"`%d`-`%m`- %Y") AS `datum`, vaha, ucitel, zak, predmet'));
     
//Předáme zdroj
        $this->setDataSource($source);
        
       $this->addColumn('zak', 'Žák', '100px');
       $this->addColumn('znamka', 'Známka', '100px');
       $this->addColumn('popis', 'Popis', '100px');
             
         $this->addColumn('vaha', 'Váha', '100px');     
         $this->addColumn('predmet', 'Předmět', '100px');     
           $this->addColumn('datum', 'Datum', '100px');     
       
      
          
 
       /* $this->addButton(Grid::ROW_FORM, "Rychlá editace")
             ->setClass("fast-edit"); */
//        ->setAjax(FALSE);
     $this->addButton("edit", "Editovat")
    ->setClass("edit")
    ->setLink(function($row) use ($presenter){return $presenter->link("edit:ucitel", $row['id_znamky']);})
    ->setAjax(FALSE);
    
    
    
$self = $this;




     $this->addButton("delete", "Smazat")
          ->setClass("delete")
          ->setLink(function($row) use ($self){return $self->link("delete!", $row['id_znamky']);})
          ->setConfirmationDialog(function($row){return "Určitě chcete smazat uživatele ".$row['zak']." ".$row['zak']."? Smazáním uživatele se smažou všechny jeho záznamy v databázi!";});
          
    
    
    
$this->setWidth('100%');
 
    }
    
  function handleDelete($username) {
      
      
    $this->database->query('DELETE FROM users WHERE id_users=?', $username);
    $this->flashMessage('Učitel byl smazán.');
}  
    
}

