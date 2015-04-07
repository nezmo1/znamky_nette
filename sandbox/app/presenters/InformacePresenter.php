<?php

namespace App\Presenters;

use Nette,
	App\Model,
        App\Components,
        Nette\Application\UI\Control;
        

/**
 * Presenter pro správu informací
 */
class InformacePresenter extends BasePresenter
{
    private $database;
/**
 * Konstruktor presenteru, obsahující parametr pro připojení k databázi
 */
    public function __construct(Nette\Database\Context $database)
    {
        parent::__construct();
        $this->database = $database;
    }
    
    public function renderInformace()
{
    $this->template->info = $this->database->table('users')
        ->where('username' ,'nezmo');
}

   
        
}







	
	

        
        
        