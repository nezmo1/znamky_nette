<?php

namespace App\Presenters;

use Nette,
	App\Model,
        App\Components,
        Nette\Application\UI\Control;
        

/**
 * Base presenter for all application presenters.
 */
class InformacePresenter extends BasePresenter
{
    private $database;

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







	
	

        
        
        