<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamPredmetu extends Grid{

    protected $tridy;
    public $database;
    public $trida_pom;
    public function __construct($tridy, \Nette\Database\Context $database)
    {
        parent::__construct();
        $this->tridy = $tridy;
      $this->database = $database;
         
    
    }

    protected function configure($presenter)
    {
          $pocet_zaku=  $this->database->query("SELECT trida, COUNT(id_users) AS `pocet_zaku` FROM users WHERE trida !=42 GROUP BY trida");
                
                $this->trida_pom=array();
                foreach ($pocet_zaku as $pocet) {  
                 $this->trida_pom+= array (''.$pocet->trida.''  => ''.$pocet->pocet_zaku.'',); 
                } 
      
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->tridy->select('id_predmetu,zkratka_predmetu,nazev '));
     
//Předáme zdroj
        $this->setDataSource($source);
        
      
       $this->addColumn('nazev', 'Název předmětu', '')
             
           
            ->setSortable(FALSE);
            
               
       $self=$this;
      
       $this->addColumn('zkratka_predmetu', 'Zkratka třídy', '')
                     
            
            ->setSortable(FALSE);
            
       
      
                   
                   
            

        $numOfResults=$this->database->query('SELECT COUNT(username) AS `pocet` FROM users WHERE trida="42" and priorita !=4')->fetch();  
        $numOfResults = $numOfResults->pocet;
         
 
       /* $this->addButton(Grid::ROW_FORM, "Rychlá editace")
             ->setClass("fast-edit"); */
//        ->setAjax(FALSE);
     $this->addButton("edit", "Editovat")
    ->setClass("edit")
    ->setLink(function($row) use ($presenter){return $presenter->link("edit:predmet", $row['id_predmetu']);})
    ->setAjax(FALSE);
    
  
    
$self = $this;




     $this->addButton("delete", "Smazat")
          ->setClass("delete")
          ->setLink(function($row) use ($self){return $self->link("delete!", $row['id_predmetu']);})
          ->setConfirmationDialog(function($row){return "Určitě chcete smazat uživatele ? Smazáním uživatele se smažou všechny jeho záznamy v databázi!";});
          
    
    
    
$this->setWidth('100%');
 
    }
    
  function handleDelete($username) {
      
      
    $this->database->query('DELETE FROM predmet WHERE id_predmetu=?', $username);
    $this->flashMessage('Třída byla smazána.');
}  
    
}

