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
    return new Model\SeznamZnamekUcitel($this->database->table('znamky')->where('ucitel',$user->id), $this->database, $user);
}

  protected function createComponentSeznamZnamekZakGrid()
{ 
    $user =  $this->getUser();
    return new Model\SeznamZnamekZak($this->database->table('znamky')->where('zak',$user->id), $this->database, $user);
}

  protected function createComponentSeznamCvZnamekZakGrid()
{ 
    $user =  $this->getUser();
    return new Model\SeznamCvZnamekZak($this->database->table('prum_znamky')->where('zak',$user->id), $this->database, $user);
}

    protected function createComponentSeznamCvZnamekUcitelGrid()
{ 
    $user =  $this->getUser();
    return new Model\SeznamCvZnamekUcitel($this->database->table('prum_znamky')->where('ucitel',$user->id), $this->database, $user);
}



	public function renderUcitel()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2'))) {
             $this->redirect('Pristup:pristup');
       }
     
}	
 
	public function renderZak()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('1')) and (!$user->isInRole('4'))) {
             $this->redirect('Pristup:pristup');
       }
     
}
 

	public function renderCvUcitel()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2'))) {
             $this->redirect('Pristup:pristup');
       }
     
}
        
}


