<?php

namespace App\Presenters;

use Nette,
	App\Model,
        App\Components,
        Nette\Application\UI\Control;
        

/**
 * Base presenter je předek všech dalších presenterů v projektu
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

    
  /** @var Nette\Database\Context */
    public $database;

    
 /**
 * Konstruktor presenteru, obsahující parametr pro připojení k databázi
 */
    public function __construct(Nette\Database\Context $database)
    {

        $this->database = $database;
    }

   
    
    
 /**
 * Vytvoření formuláře pro přihlášení
 */  
   protected function createComponentSignInForm()
	{
               
		$form = new Nette\Application\UI\Form;
               
                $form->  addText('username')
			->setRequired('Zadejte uživatelské jméno.')
                        ->setAttribute('placeholder', 'Uživatelské jméno');

		$form->addPassword('password')
			->setRequired('Zadejte heslo.')
                        ->setAttribute('placeholder', 'Heslo');
		$form->addCheckbox('remember', 'Zůstat přihlášen');
                
		$form->addSubmit('send', 'Přihlásit');
                
                $form->getElementPrototype()->class('login');
		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
                

		return $form;
	}
      
 /**
 * Funkce pro zpracování hodnot přihlašovacího formuláře; řeší čas expirace sezení 
 */     
        public function signInFormSucceeded($form, $values)
	{
            
		if ($values->remember) {
			$this->getUser()->setExpiration('14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->redirect('Homepage:');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}
        
 /**
 * Funkce pro vytvoření odhlášovacího formuláře ze sezení 
 */      
        protected function createComponentSignOutForm() {
         $form = new Nette\Application\UI\Form;
         $form->addSubmit('logout', 'Odhlásit');
          $form->getElementPrototype()->class('login');
		// call method signInFormSucceeded() on success
	$form->onSuccess[] = $this->actionOut;
         return $form;
        }
 
 /**
 * Funkce pro zpracování samotného odhlášení
 */       
        public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('Odhlášení proběhlo úspěšně');
		$this->redirect('Homepage:');
	}
 /**
 * Vytvoření komponenty vertikálního menu
 */        
  protected function createComponentMenu()
    {
        $control = new \Menu($this->database);

        return $control;
    }
 /**
 * Vytvoření komponenty "Víte že"
 */    
    protected function createComponentViteze()
    {
        $control = new \Viteze($this->database);

        return $control;
    }
 /**
 * Inicializace komponenty Informace po přihlášení
 */    
   protected function createComponentInformace()
    {
        $control = new \Informace($this->database);

        return $control;
    }
 /**
 * Funkce řeší zobrazení názvu školy
 */    
    public function beforeRender(){
        
        if(($this->presenter->presenter->name != "Error")){
        if(!$this->user->loggedIn  && ($this->presenter->presenter->name != "Pristup")){
           $this->redirect('Pristup:login');   
        }
         else {
        $nazev_sk=$this->database->query('SELECT * FROM nastaveni_global WHERE parametr_1="nazev_skoly"')->fetch();
        $this->template->nazev_skoly = "";
        if($nazev_sk!=FALSE){
        $this->template->nazev_skoly = $nazev_sk;     
           }
        }
        
        }
       
    }
 
}







	
	

        
        
        