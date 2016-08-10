<?php

namespace App\Presenters;

use Nette,
	App\Model;
       
/**
 * Presenter spravující seznamy NiftyGrid
 */   
class SeznamPresenter extends BasePresenter
{
  /** @persistent */
    public $backlink = '';   
    
 public $database;
 /**
 * Konstruktor presenteru, obsahující parametr pro připojení k databázi
 */
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
    
    
    
    
   protected function createComponentUcitelKnihaSeznam()
    {
        $control = new \UcitelKnihaSeznam($this->database);

        return $control;
    } 

    
/**
 * Funkce pro vytvoření komponenty seznamu NiftyGrid známky učitelů
 */      
    protected function createComponentSeznamZnamekUcitelGrid()
{ 
    $user =  $this->getUser();
    return new Model\SeznamZnamekUcitel($this->database->table('znamky')->where('ucitel',$user->id), $this->database, $user);
}

/**
 * Funkce pro vytvoření komponenty seznamu NiftyGrid známky žáků 
 */ 
  protected function createComponentSeznamZnamekZakGrid()
{ 
    $user =  $this->getUser();
    return new Model\SeznamZnamekZak($this->database->table('znamky')->where('zak',$user->id), $this->database, $user);
}
/**
 * Funkce pro vytvoření komponenty seznamu NiftyGrid seznamu čtvrtletní kalsifikace žáků 
 */ 
  protected function createComponentSeznamCvZnamekZakGrid()
{ 
    $user =  $this->getUser();
    return new Model\SeznamCvZnamekZak($this->database->table('prum_znamky')->where('zak',$user->id), $this->database, $user);
}
/**
 * Funkce pro vytvoření komponenty seznamu NiftyGrid seznam čtvrtletní klasifikace učitelů
 */ 
    protected function createComponentSeznamCvZnamekUcitelGrid()
{ 
    $user =  $this->getUser();
    return new Model\SeznamCvZnamekUcitel($this->database->table('prum_znamky')->where('ucitel',$user->id), $this->database, $user);
}


/**
 * Funkce pro vykreslení stránky Ucitel
 */   
	public function renderUcitel()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2'))) {
             $this->redirect('Pristup:pristup');
       }
     
}	
 /**
 * Funkce pro vykreslení stránky Zak
 */   
	public function renderZak()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('1')) and (!$user->isInRole('4'))) {
             $this->redirect('Pristup:pristup');
       }
     
}
 
/**
 * Funkce pro vykreslení stránky CvUcitel
 */   
	public function renderCvUcitel()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2'))) {
             $this->redirect('Pristup:pristup');
       }
     
}
   

public function renderucitelKniha()
{
    
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2'))) {
             $this->redirect('Pristup:pristup');
       }
     
}


}


