<?php

namespace App\Presenters;

use Nette,
	App\Model;
        

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
 
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
        
        
        protected function createComponentSignOutForm() {
         $form = new Nette\Application\UI\Form;
         $form->addSubmit('logout', 'Odhlásit');
          $form->getElementPrototype()->class('login');
		// call method signInFormSucceeded() on success
	$form->onSuccess[] = $this->actionOut;
         return $form;
        }
        
        public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('Odhlášení proběhlo úspěšně');
		$this->redirect('Homepage:');
	}

        
}





	
	

        
        
        