<?php

namespace App\Presenters;

use Nette,
	App\Model;
       

class ListPresenter extends BasePresenter
{
  /** @persistent */
    public $backlink = '';   
    
 public $database;
 
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
   
    protected function createComponentSeznamZakuGrid()
{
    return new Model\SeznamZaku($this->database->table('users')->where('trida!=','42')->where('priorita!=','4'), $this->database);
}

 



	public function renderZaci()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
       $this->backlink = $this->storeRequest();
 
}	
        
 
        
}


