<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamZaku extends Grid{

    protected $zaci;
    public $database;
    public $trida_pom;
    public function __construct($zaci, \Nette\Database\Context $database)
    {
        parent::__construct();
        $this->zaci = $zaci;
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
        $source = new \NiftyGrid\DataSource\NDataSource($this->zaci->select('id_users,username, jmeno, prijmeni, trida, mail'));
     
//Předáme zdroj
        $this->setDataSource($source);
        
       $this->addColumn('username', 'Přihlašovací jméno', '');
       $this->addColumn('jmeno', 'Jméno', '')
             
            ->setTextEditable('jmeno')
            ->setSortable(FALSE)
            ->setTextFilter('jmeno');
               
       
      
       $this->addColumn('prijmeni', 'Příjmení', '')
                     
             ->setTextEditable('prijmeni')
            ->setSortable(FALSE)
            ->setTextFilter('prijmeni');
       $this->addColumn('trida', 'Třída', '80px')
               ->setSelectFilter($this->trida_pom)
               ->setRenderer(function($row){
                   
                 
                   $jmeno_tridy=$row['trida'];
                   
                   return $this->trida_pom[$jmeno_tridy] ;});
            

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
    ->setLink(function($row) use ($presenter){return $presenter->link("edit:zak", $row['id_users']);})
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
          
    
    
    
$this->setWidth('100%');
 
    }
    
  function handleDelete($username) {
      
      
    $this->database->query('DELETE FROM users WHERE id_users=?', $username);
    $this->flashMessage('Učitel byl smazán.');
}  
    
}

