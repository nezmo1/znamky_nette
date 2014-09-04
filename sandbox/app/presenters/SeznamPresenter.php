<?php

namespace App\Presenters;

use Nette,
	App\Model;
       

class SeznamPresenter extends BasePresenter
{
  /** @persistent */
    public $backlink = '';   
    
 public $database;
 
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
   
    protected function createComponentSeznamZnamekUcitelGrid()
{ 
    $user =  $this->getUser();
    return new Model\SeznamZnamekUcitel($this->database->table('znamky')->where('ucitel',$user->id), $this->database);
}




	public function renderUcitel()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2'))) {
             $this->redirect('Pristup:pristup');
       }
     
}	
        
 
        
}


