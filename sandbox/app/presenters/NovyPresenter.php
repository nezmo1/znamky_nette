<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Sign in/out presenters.
 */
class NovyPresenter extends BasePresenter
{
    /** @var Nette\Database\Context */
    public $database;

    public function __construct(Nette\Database\Context $database)
    {

        $this->database = $database;
    }



	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentNovyUcitel()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('username', 'Uživatelské jméno:')
                        ->setAttribute('placeholder', 'Uživatelské jméno (6 znaků)')
			->setRequired('Zadejte uživatelské jméno')
                        ->addRule($form::MIN_LENGTH, 'Uživatelské jméno musí mít %d znaků (ideálně první tři písmena ze jména a příjmení)', 6)
                        ->addRule($form::MAX_LENGTH, 'Uživatelské jméno musí mít %d znaků (ideálně první tři písmena ze jména a příjmení)', 6);
                $form->addText('jmeno', 'Jméno:')
                        ->setAttribute('placeholder', 'Jméno učitele')
			->setRequired('Zadejte jméno');
                $form->addText('prijmeni', 'Příjmeni:')
                        ->setAttribute('placeholder', 'Příjmení učitele')
			->setRequired('Zadejte příjmení');
                $form->addText('mail', 'E-mail:')
                        ->setAttribute('placeholder', 'E-mail ve správném tvaru')
			->addRule($form::EMAIL, 'E-mail je ve špatném tvaru');
		$form->addPassword('password', 'Heslo:')
                        ->setAttribute('placeholder', 'Heslo (min. 6 znaků)')
                     ->setRequired('Zvolte si heslo')
                     ->addRule($form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 6);
                 
                $form->addPassword('passwordVerify', 'Heslo pro kontrolu:')
                        ->setAttribute('placeholder', 'Zadejte prosím heslo ještě jednou pro kontrolu')
                     ->setRequired('Zadejte prosím heslo ještě jednou pro kontrolu')
                     ->addRule($form::EQUAL, 'Hesla se neshodují', $form['password']);
		
                $tituly= array(
                  ''  => 'Bez titulu', 
                  'Mgr.'  => 'Mgr.', 
                  'Bc.' => 'Bc.',
                  'Ing.' => 'Ing.',
                  'PaedDr.' => 'PaedDr.',  
      
                );
                $form->addSelect('titul', 'Titul:', $tituly);
                     
		$form->addSubmit('send', 'Vytvořit učitele');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->novyUcitel;
                
                
                $renderer = $form->getRenderer();
$renderer->wrappers['controls']['container'] = NULL;

$renderer->wrappers['pair']['container'] = "tr";
$renderer->wrappers['pair']['.odd'] = 'alt';
$renderer->wrappers['label']['container'] = 'td';

$renderer->wrappers['control']['.text'] = 'udaje';
$renderer->wrappers['control']['.password'] = 'udaje';
$renderer->wrappers['control']['.submit'] = 'login-prehled';


		return $form;
	}


	public function novyUcitel($form, $values)
	{
		$existuje =  $this->database->table('users')->where('username="'.$values->username.'"')->fetch();
               $uzivatel="";
                if($existuje){
                $uzivatel = $existuje->username;    
                }
                                
                if ($values->username==$uzivatel){
                    $flashMessage = $this->flashMessage('Uživatel s tímto uživatelským jménem již existuje!'); 
                  return $flashMessage;
                } 
                else {
                    $heslo=md5($values->password);
                    $this->database->query('INSERT INTO USERS SET username= ?',$values->username,', password= ?',$heslo,', prijmeni= ?',$values->prijmeni,', jmeno= ?',$values->jmeno,', mail= ?',$values->mail,', priorita="2", trida="ucitel"');
                      $flashMessage = $this->flashMessage('Uživatel byl úspěšně přidán do databáze.'); 
                  return $flashMessage;       
                }
	}


		public function renderUcitel()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}

}
