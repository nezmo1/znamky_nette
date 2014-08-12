<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamUcitelu extends Grid{

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
        $source = new \NiftyGrid\DataSource\NDataSource($this->ucitele->select('username, jmeno, prijmeni, trida, mail'));
        $this->setDefaultOrder("trida DESC");
//Předáme zdroj
        $this->setDataSource($source);
        
       $this->addColumn('username', 'Přihlašovací jméno', '100px');
       $this->addColumn('jmeno', 'Jméno', '100px')
             
            ->setTextEditable('jmeno')
            ->setSortable(FALSE)
            ->setTextFilter('jmeno');
               
       
      
       $this->addColumn('prijmeni', 'Příjmení', '100px')
                     
             ->setTextEditable('prijmeni')
            ->setSortable(FALSE)
            ->setTextFilter('prijmeni');
       $this->addColumn('trida', 'Třída', '80px')
            ->setRenderer(function($row){return 'Učitel';});

        $numOfResults=$this->database->query('SELECT COUNT(username) AS `pocet` FROM users WHERE trida="ucitel"')->fetch();  
        $numOfResults = $numOfResults->pocet;
        $this->addColumn('mail', 'E-mail', '300px')
               
             ->setSortable(FALSE) 
             ->setTextEditable('mail')
             ->setTextFilter('mail')
             ->setAutocomplete($numOfResults);       
 
        $this->addButton(Grid::ROW_FORM, "Rychlá editace")
             ->setClass("fast-edit")
        ->setAjax(FALSE);
        $this->setRowFormCallback(function($values){
            $this->databse->query('UPDATE USERS SET prijmeni="hodnota" where username="hodnota"');});
    
$self = $this;


     $this->addButton("delete", "Smazat")
          ->setClass("delete")
          ->setLink(function($row) use ($self){return $self->link("delete!", $row['username']);})
          ->setConfirmationDialog("Určitě chcete smazat všechny vybrané članky?");
          
    
    
    $this->paginate = FALSE;
$this->setWidth('100%');
    
    }
    
  function handleDelete($username) {
      
      
    $this->database->query('DELETE FROM USERS WHERE username=?', $username);
    $this->flashMessage('Učitel byl smazán.');
}  
    
}