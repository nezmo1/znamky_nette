<?php

namespace App\Presenters;

use Nette,
	App\Model;
       

class UsersPresenter extends BasePresenter
{
    
    
 private $database;
 
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
   
    protected function createComponentArticleGrid()
{
    return new Model\ArticleGrid($this->database->table('users'));
}





	public function renderList()
{
    
 
}	
        
 
        
}


