<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Presenter spravující vytváření nových záznamů v databázi
 */
class NovyPresenter extends BasePresenter
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
 * Funkce vytvářející komponentu formuláře pro nového učitele 
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
                        ->addCondition($form::FILLED)
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

/**
 * Funkce komunikující s databází, vkládá záznam nového učitele 
 */
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
                    if($this->database->query('INSERT INTO users SET username= ?',$values->username,', password= ?',$heslo,', prijmeni= ?',$values->prijmeni,', jmeno= ?',$values->jmeno,', mail= ?',$values->mail,', priorita="2", trida="42" , titul =?',$values->titul)){
                     $flashMessage = $this->flashMessage('Uživatel byl úspěšně přidán do databáze.');    
                    }
                    else {
                     $flashMessage = $this->flashMessage('Chyba databáze na straně serveru, uživatel nebyl přidán!');    
                    }
                      
                  return $flashMessage;       
                }
	}
        
        
        
        
 /**
 * Funkce vytvářející komponentu formuláře pro novou třídu 
 */       
        protected function createComponentNovyTrida()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('zkratka_tridy', 'Zkratka třídy')
                        ->setAttribute('placeholder', 'Zkratka třídy (ve většině případů stejná jako název třídy)')
			->setRequired('Zadejte zkratku třídy')
                        ->addRule($form::MIN_LENGTH, 'Zkratka třídy musí mít minimálně %d znaků.', 1)
                        ->addRule($form::MAX_LENGTH, 'Zkratka třídy musí mít maximálně %d znaků.', 15);
                $form->addText('jmeno_tridy', 'Název třídy:')
                        ->setAttribute('placeholder', 'Název třídy')
			->setRequired('Zadejte název třídy');
                
                
                 $form->addSubmit('send', 'Vytvořit třídu');
		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->novyTrida;
                
                
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
        
/**
 * Funkce komunikující s databází, vkládá záznam nové třídy 
 */       
        function novyTrida($form, $values){
            
               $existuje =  $this->database->table('trida')->where('zkratka_tridy="'.$values->zkratka_tridy.'"')->fetch();
               $uzivatel="";
                if($existuje){
                $uzivatel = $existuje->zkratka_tridy;    
                }
                                
                if ($values->zkratka_tridy==$uzivatel){
                    $flashMessage = $this->flashMessage('Třída s touto zkratkou již existuje!'); 
                  return $flashMessage;
                } 
                else {
                    
                    if($this->database->query('INSERT INTO trida SET zkratka_tridy= ?',$values->zkratka_tridy,', jmeno_tridy= ?',$values->jmeno_tridy,'')){
                     $flashMessage = $this->flashMessage('Třída byla úspěšně přidána do databáze.');    
                    }
                    else {
                     $flashMessage = $this->flashMessage('Chyba databáze na straně serveru, třída nebyla přidána!');    
                    }
                      
                  return $flashMessage;       
                }
            
        }
        
        
        
        
 /**
 * Funkce vytvářející komponentu formuláře pro nový předmět
 */       
         protected function createComponentNovyPredmet()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('zkratka_predmetu', 'Zkratka předmětu')
                        ->setAttribute('placeholder', 'Zkratka předmětu')
			->setRequired('Zadejte zkratku předmětu')
                        ->addRule($form::MIN_LENGTH, 'Zkratka předmětu musí mít minimálně %d znaků.', 2)
                        ->addRule($form::MAX_LENGTH, 'Zkratka předmětu musí mít maximálně %d znaků.', 10);
                $form->addText('nazev', 'Název předmětu:')
                        ->setAttribute('placeholder', 'Název předmětu')
			->setRequired('Zadejte název předmětu');
                
                $form->addSubmit('send', 'Vytvořit předmět');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->novyPredmet;
                
                
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

/**
 * Funkce komunikující s databází, vkládá záznam nového předmětu
 */
        function novyPredmet($form, $values){
            
            $existuje =  $this->database->table('predmet')->where('zkratka_predmetu="'.$values->zkratka_predmetu.'"')->fetch();
               $uzivatel="";
                if($existuje){
                $uzivatel = $existuje->zkratka_predmetu;    
                }
                                
                if ($values->zkratka_predmetu==$uzivatel){
                    $flashMessage = $this->flashMessage('Předmět s touto zkratkou již existuje!'); 
                  return $flashMessage;
                } 
                else {
                    
                    if($this->database->query('INSERT INTO predmet SET zkratka_predmetu= ?',$values->zkratka_predmetu,', nazev= ?',$values->nazev,'')){
                     $flashMessage = $this->flashMessage('Předmět byl úspěšně přidán do databáze.');    
                    }
                    else {
                     $flashMessage = $this->flashMessage('Chyba databáze na straně serveru, předmět nebyl přidán!');    
                    }
                      
                  return $flashMessage;       
                }
            
            
        }
        
        
        
        
 /**
 * Funkce vytvářející komponentu formuláře pro novou skupinu
 */       
       protected function createComponentNovySkupina()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('nazev_skupiny', 'Název skupiny')
                        ->setAttribute('placeholder', 'Název skupiny')
			->setRequired('Zadejte název skupiny')
                        ->addRule($form::MIN_LENGTH, 'Název skupiny musí mít minimálně %d znaků ', 6)
                        ->addRule($form::MAX_LENGTH, 'Název skupiny musí mít maximálně %d znaků', 25);
                
		
                $ucitele=  $this->database->table('users')->where('trida','42')->where('priorita !=','4');
                
                $ucitel_pom=array();
                foreach ($ucitele as $ucitel) {  
                 $ucitel_pom+= array (''.$ucitel->id_users.''  => ''.$ucitel->jmeno.' '.$ucitel->prijmeni.'',); 
                } 
      
                
                $form->addSelect('ucitel', 'Učitel:', $ucitel_pom);
                
                
                $tridy=  $this->database->table('trida')->where('zkratka_tridy !=','ucitel')->order('zkratka_tridy');
                
                $trida_pom=array();
                foreach ($tridy as $trida) {  
                 $trida_pom+= array (''.$trida->id_tridy.''  => ''.$trida->jmeno_tridy.'',); 
                } 
      
                
                $form->addSelect('trida', 'Třída:', $trida_pom);
                
                
                $predmety=  $this->database->table('predmet')->order('nazev');
                
                $predmet_pom=array();
                foreach ($predmety as $predmet) {  
                 $predmet_pom+= array (''.$predmet->id_predmetu.''  => ''.$predmet->nazev.'',); 
                } 
      
                
                $form->addSelect('predmet', 'Předmět:', $predmet_pom);
                     
		$form->addSubmit('send', 'Vytvořit skupinu');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->novySkupina;
                
                
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
        
/**
 * Funkce komunikující s databází, vkládá záznam nové skupiny
 */        
    function novySkupina($form, $values){
            
            
                
                    
                    if($this->database->query('INSERT INTO skupina SET nazev_skupiny= ?',$values->nazev_skupiny,', ucitel= ?',$values->ucitel,', trida= ?',$values->trida,', predmet= ?',$values->predmet,'')){
                     $flashMessage = $this->flashMessage('Skupina byla úspěšně přidána do databáze.');    
                    }
                    else {
                     $flashMessage = $this->flashMessage('Chyba databáze na straně serveru, skupina nebyla přidána!');    
                    }
                      
                  return $flashMessage;       
                
            
            
        }    
        
        
        
        
 /**
 * Funkce vytvářející komponentu formuláře pro nového žáka
 */       
        protected function createComponentNovyZak()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('username', 'Uživatelské jméno:')
                        ->setAttribute('placeholder', 'Uživatelské jméno (6 znaků)')
			->setRequired('Zadejte uživatelské jméno')
                        ->addRule($form::MIN_LENGTH, 'Uživatelské jméno musí mít %d znaků (ideálně první tři písmena ze jména a příjmení)', 6)
                        ->addRule($form::MAX_LENGTH, 'Uživatelské jméno musí mít %d znaků (ideálně první tři písmena ze jména a příjmení)', 6);
                $form->addText('jmeno', 'Jméno:')
                        ->setAttribute('placeholder', 'Jméno žáka')
			->setRequired('Zadejte jméno');
                $form->addText('prijmeni', 'Příjmeni:')
                        ->setAttribute('placeholder', 'Příjmení žáka')
			->setRequired('Zadejte příjmení');
                $form->addText('mail', 'E-mail:')
                        ->setAttribute('placeholder', 'E-mail ve správném tvaru')
                        ->addCondition($form::FILLED)
			->addRule($form::EMAIL, 'E-mail je ve špatném tvaru');
		$form->addPassword('password', 'Heslo:')
                        ->setAttribute('placeholder', 'Heslo (min. 6 znaků)')
                     ->setRequired('Zvolte si heslo')
                     ->addRule($form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 6);
                 
                $form->addPassword('passwordVerify', 'Heslo pro kontrolu:')
                        ->setAttribute('placeholder', 'Zadejte prosím heslo ještě jednou pro kontrolu')
                     ->setRequired('Zadejte prosím heslo ještě jednou pro kontrolu')
                     ->addRule($form::EQUAL, 'Hesla se neshodují', $form['password']);
		
                $tridy=  $this->database->table('trida')->where('zkratka_tridy !=','ucitel')->order('zkratka_tridy');
                
                $trida_pom=array();
                foreach ($tridy as $trida) {  
                 $trida_pom+= array (''.$trida->id_tridy.''  => ''.$trida->jmeno_tridy.'',); 
                } 
      
                
                $form->addSelect('trida', 'Třída:', $trida_pom);
                     
		$form->addSubmit('send', 'Vytvořit žáka');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->novyZak;
                
                
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
        
/**
 * Funkce komunikující s databází, vkládá záznam nového žáka
 */
public function novyZak($form, $values)
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
                    if($this->database->query('INSERT INTO users SET username= ?',$values->username,', password= ?',$heslo,', prijmeni= ?',$values->prijmeni,', jmeno= ?',$values->jmeno,', mail= ?',$values->mail,', priorita="1", trida =?',$values->trida)){
                     $flashMessage = $this->flashMessage('Uživatel byl úspěšně přidán do databáze.');    
                    }
                    else {
                     $flashMessage = $this->flashMessage('Chyba databáze na straně serveru, uživatel nebyl přidán!');    
                    }
                      
                  return $flashMessage;       
                }
	}        
        

/**
 * Funkce pro vykreslení stránky Ucitel
 */
		public function renderUcitel()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}


/**
 * Funkce pro vykreslení stránky Predmet
 */
		public function renderPredmet()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}
/**
 * Funkce pro vykreslení stránky Trida
 */
		public function renderTrida()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}
/**
 * Funkce pro vykreslení stránky Skupina
 */
		public function renderSkupina()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}
/**
 * Funkce pro vykreslení stránky Zak
 */
		public function renderZak()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}
}
