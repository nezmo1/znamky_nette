<?php

namespace App\Presenters;

use Nette,
	App\Model;
       

class UsersPresenter extends BasePresenter
{
    
    
 public $database;
 
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
   
    protected function createComponentSeznamUcitelu()
{
    return new Model\SeznamUcitelu($this->database->table('users')->where('trida','ucitel'), $this->database);
}

 



	public function renderList()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}	
        
 
        
}


