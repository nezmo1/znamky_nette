<?php

namespace App\Presenters;

use Nette,
	App\Model;
use Nette\Utils\Html;
use Grido;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
    
  public $database;
    

  public function renderDefault() {
       if($this->user->loggedIn){
           $this->redirect('Informace:prehled');  
  }

}

}