<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamUcitelu extends Grid{
  /** @persistent */
    public $backlink = '';     

    protected $ucitele;
    public $database;
    
    public function __construct($ucitele, \Nette\Database\Context $database)
    {
        parent::__construct();
        $this->ucitele = $ucitele;
      $this->database = $database;
         
    
    }

    protected function configure($presenter)
    {
        
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->ucitele->select('id_users,username, jmeno, prijmeni, trida, mail'));
        $this->setDefaultOrder("trida DESC");
//Předáme zdroj
        $this->setDataSource($source);
        
       $this->addColumn('username', 'Přihlašovací jméno', '100px');
       $this->addColumn('jmeno', 'Jméno', '')
             
            ->setTextEditable('jmeno')
            ->setSortable(FALSE)
            ->setTextFilter('jmeno');
               
       
      
       $this->addColumn('prijmeni', 'Příjmení', '')
                     
             ->setTextEditable('prijmeni')
            ->setSortable(FALSE)
            ->setTextFilter('prijmeni');
       $this->addColumn('trida', 'Třída', '')
            ->setRenderer(function($row){return 'Učitel';});

        $numOfResults=$this->database->query('SELECT COUNT(username) AS `pocet` FROM users WHERE trida="42" and priorita !=4')->fetch();  
        $numOfResults = $numOfResults->pocet;
        $this->addColumn('mail', 'E-mail', '')
               
             ->setSortable(FALSE) 
             ->setTextEditable('mail')
             ->setTextFilter('mail')
             ->setAutocomplete($numOfResults);       
 
       /* $this->addButton(Grid::ROW_FORM, "Rychlá editace")
             ->setClass("fast-edit"); */
//        ->setAjax(FALSE);
     $this->addButton("edit", "Editovat")
    ->setClass("edit")
    ->setLink(function($row) use ($presenter){return $presenter->link("edit:ucitel", $row['id_users']);})
    ->setAjax(FALSE);
    
    $this->addButton("heslo", "Změnit heslo")
    ->setClass("heslo")
    ->setLink(function($row) use ($presenter){return $presenter->link("edit:heslo", $row['id_users']);})
    ->setAjax(FALSE);
    
$self = $this;




     $this->addButton("delete", "Smazat")
          ->setClass("delete")
          ->setLink(function($row) use ($self){return $self->link("delete!", $row['id_users']);})
          ->setConfirmationDialog(function($row){return "Určitě chcete smazat uživatele ".$row['jmeno']." ".$row['prijmeni']."? Smazáním uživatele se smažou všechny jeho záznamy v databázi!";});
          
    
    
    $this->paginate = FALSE;

    
    }
    
  function handleDelete($username) {
      
      
    $this->database->query('DELETE FROM users WHERE id_users=?', $username);
    $this->flashMessage('Učitel byl smazán.');
}  
    
}

