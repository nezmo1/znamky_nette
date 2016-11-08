<?php

namespace App\Presenters;

use Nette,
	App\Model,
        App\Components,
        Nette\Application\UI\Control;
        

/**
 * Homepage presenter.
 */
class SestavyPresenter extends BasePresenter
{
    
  public $database;
    

  
  protected function createComponentSestavy()
    {
        $control = new \Sestavy($this->database);

        return $control;
    }
  
  public function renderCvpredmety() {
      

}

	public function renderUcitel()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2'))) {
             $this->redirect('Pristup:pristup');
       }
     
}


  protected function createComponentSeznamZnamekUcitelGrid()
{ 
    $user =  $this->getUser();
    return new Model\SeznamZnamekUcitelSestava($this->database->table('znamky'), $this->database, $user);
}



}