<?php

namespace App\Presenters;

use Nette,
	App\Model;
       

class ListPresenter extends BasePresenter
{
  /** @persistent */
    public $backlink = '';   
    
 public $database;
 /**
 * Konstruktor presenteru, obsahující parametr pro připojení k databázi
 */
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
   
    protected function createComponentSeznamZakuGrid()
{
    return new Model\SeznamZaku($this->database->table('users')->where('trida!=','42')->where('priorita!=','4'), $this->database);
}


   protected function createComponentSeznamTridGrid()
{
    return new Model\SeznamTrid($this->database->table('trida')->where('id_tridy!=','42')->order("jmeno_tridy"), $this->database);
}

 protected function createComponentSeznamPredmetuGrid()
{
    return new Model\SeznamPredmetu($this->database->table('predmet')->order("nazev"), $this->database);
}

 public function GenHes(){
     $abeceda="ABCDEFGHJKMNPRSTUVWXYZabcdefghjkmnpqrstuvwxyz";
     $cisla="23456789";
      $heslo=substr($cisla,rand(1, strlen($cisla)-1),1);
      $heslo.=substr($cisla,rand(1, strlen($cisla)-1),1);
      $heslo.=substr($cisla,rand(1, strlen($cisla)-1),1);
     $heslo.=substr($abeceda,rand(1, strlen($abeceda)-1),1);
     $heslo.=substr($abeceda,rand(1, strlen($abeceda)-1),1);
     $heslo.=substr($cisla,rand(1, strlen($cisla)-1),1);
     $heslo.=substr($cisla,rand(1, strlen($cisla)-1),1);
     $heslo.=substr($abeceda,rand(1, strlen($abeceda)-1),1);
     return $heslo;
 }

public function HesDab(){
    $zaci=$this->database->query("SELECT * FROM users where trida != 42"); 
    foreach($zaci as $zak){
     $this->database->query("UPDATE users SET password =?",md5($zak->password)," where id_users= ?",$zak->id_users);   
    }
    
}


	public function renderZaci()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
       $this->backlink = $this->storeRequest();
       $this->template->yolo = $this->GenHes();
       // $this->HesDab();
       /*
        * 
        * SELECT username, jmeno, prijmeni, password, trida.jmeno_tridy FROM `users` 
INNER JOIN trida on users.trida=trida.id_tridy
WHERE users.trida !=42 
        * 
        */
 
}	
   
	public function renderTridy()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
       
      
        
 
}	

	public function renderPredmety()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
       
      
        
 
}
 
        
}


