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
    
   

    public function createComponentGrid($name)
    {
        $grid = new Grido\Grid($this, $name);
        $grid->model = $this->database->table('users')->where('trida !=','ucitel')->order('trida');

        $grid->addColumnText('username', 'Uživatelské jméno')
            ->setFilterText()
                ->setSuggestion();

        $grid->addColumnText('jmeno', 'Jméno')
            
            ->setFilterText()
                ->setSuggestion();
        $grid->addColumnText('prijmeni', 'Příjmení')
            
            ->setFilterText()
                ->setSuggestion();
        $grid->addColumnText('trida', 'Třída')
            
            ->setFilterSelect();
                

       
        $grid->setExport();
    }

}

