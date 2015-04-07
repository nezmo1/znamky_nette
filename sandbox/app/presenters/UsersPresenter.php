<?php

namespace App\Presenters;

use Nette,
	App\Model;
       

class UsersPresenter extends BasePresenter
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
   
    protected function createComponentSeznamUcitelu()
{
    return new Model\SeznamUcitelu($this->database->table('users')->where('trida','42')->where('priorita!=','4'), $this->database);
}

 



	public function renderList()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
       $this->backlink = $this->storeRequest();
 
}	
        
 
        
}


