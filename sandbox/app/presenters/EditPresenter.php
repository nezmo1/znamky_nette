<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Sign in/out presenters.
 */
class EditPresenter extends BasePresenter
{
    /** @var Nette\Database\Context */
    public $database;
 /** @persistent */
    public $backlink = '';
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
            
            $get=$this->request->getParameters();
               
                 $data=  $get['id_users'];
            $editace= $this->database->table('users')->where('id_users',$data)->fetch();
            
            
		$form = new Nette\Application\UI\Form;
		$form->addText('username', 'Uživatelské jméno:')
                        ->setAttribute('placeholder', 'Uživatelské jméno (6 znaků)')
			->setRequired('Zadejte uživatelské jméno')
                        ->setDefaultValue($editace->username)
                        ->addRule($form::MIN_LENGTH, 'Uživatelské jméno musí mít %d znaků (ideálně první tři písmena ze jména a příjmení)', 6)
                        ->addRule($form::MAX_LENGTH, 'Uživatelské jméno musí mít %d znaků (ideálně první tři písmena ze jména a příjmení)', 6);
                $form->addText('jmeno', 'Jméno:')
                        ->setAttribute('placeholder', 'Jméno učitele')
			->setRequired('Zadejte jméno')
                        ->setDefaultValue($editace->jmeno);
                $form->addText('prijmeni', 'Příjmeni:')
                        ->setAttribute('placeholder', 'Příjmení učitele')
                        ->setDefaultValue($editace->prijmeni)
			->setRequired('Zadejte příjmení');
                $form->addText('mail', 'E-mail:')
                        ->setAttribute('placeholder', 'E-mail ve správném tvaru')
                        ->setDefaultValue($editace->mail)
                        ->addCondition($form::FILLED)
			->addRule($form::EMAIL, 'E-mail je ve špatném tvaru');
		
                    
		
                $tituly= array(
                  ''  => 'Bez titulu', 
                  'Mgr.'  => 'Mgr.', 
                  'Bc.' => 'Bc.',
                  'Ing.' => 'Ing.',
                  'PaedDr.' => 'PaedDr.',  
      
                );
                $form->addSelect('titul', 'Titul:', $tituly);
                $form['titul']->setDefaultValue($editace->titul);     
		$form->addSubmit('send', 'Editovat učitele');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->editUcitel;
                
                
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


	public function editUcitel($form, $values)
	{
            $get=$this->request->getParameters();
               
                 $data=  $get['id_users'];
		$existuje =  $this->database->table('users')->where('username="'.$values->username.'"')->where("id_users !=",$data)->fetch();
               $uzivatel="";
                if($existuje){
                $uzivatel = $existuje->id_users;    
                }
                                
                if ($data==$uzivatel){
                    $flashMessage = $this->flashMessage('Uživatel s tímto uživatelským jménem již existuje!'); 
                  return $flashMessage;
                } 
                else {
                  
                    if($this->database->query('UPDATE users SET username= ?',$values->username,', prijmeni= ?',$values->prijmeni,', jmeno= ?',$values->jmeno,', mail= ?',$values->mail,', priorita="2", trida="42" , titul =?',$values->titul,' WHERE id_users= ?',$data)){
                     $flashMessage = $this->flashMessage('Uživatel byl úspěšně editován.');    
                    }
                    else {
                     $flashMessage = $this->flashMessage('Chyba databáze na straně serveru, uživatel nebyl editován!');    
                    }
                      
                  return $flashMessage;  
                  
                }
             
	}
        
      
        
        protected function createComponentZmenaHeslaA()
	{
		$form = new Nette\Application\UI\Form;
		$form->addPassword('password', 'Heslo:')
                        ->setAttribute('placeholder', 'Heslo (min. 6 znaků)')
                     ->setRequired('Zvolte si heslo')
                     ->addRule($form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 6);
                 
                $form->addPassword('passwordVerify', 'Heslo pro kontrolu:')
                        ->setAttribute('placeholder', 'Zadejte prosím heslo ještě jednou pro kontrolu')
                     ->setRequired('Zadejte prosím heslo ještě jednou pro kontrolu')
                     ->addRule($form::EQUAL, 'Hesla se neshodují', $form['password']);
                
                
                 $form->addSubmit('send', 'Změnit heslo');
		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->zmenaHeslaA;
                
                
                $renderer = $form->getRenderer();
$renderer->wrappers['controls']['container'] = NULL;

$renderer->wrappers['pair']['container'] = "tr style='text-align:right'";
$renderer->wrappers['pair']['.odd'] = 'alt';
$renderer->wrappers['label']['container'] = 'td style="text-align:left"';

$renderer->wrappers['control']['.text'] = 'udaje';
$renderer->wrappers['control']['.password'] = 'udaje';
$renderer->wrappers['control']['.submit'] = 'uvazek-send';


		return $form;
	}
        

        
        
       
        function zmenaHeslaA($form, $values){
                       
 $get=$this->request->getParameters();
               
                 $data=  $get['id_users'];            
            
                    if($this->database->query('UPDATE users SET password= ?',md5($values->password),'WHERE id_users=?', $data)){
                     $flashMessage = $this->flashMessage('Heslo bylo úspěšně změněno.');    
                    }
                    else {
                     $flashMessage = $this->flashMessage('Chyba databáze na straně serveru, heslo nebylo změněno!');    
                    }
                      
                  return $flashMessage;       
                
        }
        
        
        
        
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
        
        
        
        
        
       protected function createComponentNovySkupina()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('nazev_skupiny', 'Název skupiny')
                        ->setAttribute('placeholder', 'Název skupiny')
			->setRequired('Zadejte název skupiny')
                        ->addRule($form::MIN_LENGTH, 'Název skupiny musí mít minimálně %d znaků ', 6)
                        ->addRule($form::MAX_LENGTH, 'Název skupiny musí mít maximálně %d znaků', 25);
                
		
                $ucitele=  $this->database->table('users')->where('trida','ucitel')->where('priorita !=','4');
                
                $ucitel_pom=array();
                foreach ($ucitele as $ucitel) {  
                 $ucitel_pom+= array (''.$ucitel->username.''  => ''.$ucitel->jmeno.' '.$ucitel->prijmeni.'',); 
                } 
      
                
                $form->addSelect('ucitel', 'Učitel:', $ucitel_pom);
                
                
                $tridy=  $this->database->table('trida')->where('zkratka_tridy !=','ucitel')->order('zkratka_tridy');
                
                $trida_pom=array();
                foreach ($tridy as $trida) {  
                 $trida_pom+= array (''.$trida->zkratka_tridy.''  => ''.$trida->jmeno_tridy.'',); 
                } 
      
                
                $form->addSelect('trida', 'Třída:', $trida_pom);
                
                
                $predmety=  $this->database->table('predmet')->order('nazev');
                
                $predmet_pom=array();
                foreach ($predmety as $predmet) {  
                 $predmet_pom+= array (''.$predmet->zkratka_predmetu.''  => ''.$predmet->nazev.'',); 
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
        
        
    function novySkupina($form, $values){
            
            
                
                    
                    if($this->database->query('INSERT INTO skupina SET nazev_skupiny= ?',$values->nazev_skupiny,', ucitel= ?',$values->ucitel,', trida= ?',$values->trida,', predmet= ?',$values->predmet,'')){
                     $flashMessage = $this->flashMessage('Skupina byla úspěšně přidána do databáze.');    
                    }
                    else {
                     $flashMessage = $this->flashMessage('Chyba databáze na straně serveru, skupina nebyla přidána!');    
                    }
                      
                  return $flashMessage;       
                
            
            
        }    
        
        
        
        
        
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
        

       protected function createComponentEditZnamka()
	{
           $get=$this->request->getParameters();
        $existence=  $this->database->query('SELECT *,DATE_FORMAT(datum,"%Y-%m-%d") AS `data` FROM znamky WHERE id_znamky= ?',$get['id_znamky'])->fetch();   
		$form = new Nette\Application\UI\Form;
		$form->addText('znamka', 'Známka')
                        ->setAttribute('placeholder', 'Známka')
                        ->setValue($existence['znamka'])
			->setRequired('Zadejte známku');
                      
                $form->addText('popis', 'Popis')
                        ->setAttribute('placeholder', 'Popis')
                        ->setValue($existence['popis'])
			->setRequired('Zadejte popis');
                $form->addText('datum', 'Datum')
                        ->setAttribute('readonly', 'readonly')
                        ->setValue($existence['data'])
                        ->setAttribute('id','datepicker')
			->setRequired('Zadejte datum');
                  $vaha= array(
                  '1'  => 'Nízká', 
                  '2'  => 'Normální', 
                  '3' => 'Vysoká',
                  
      
                );
                   
                $form->addSelect('vaha', 'Váha:', $vaha);
                $form['vaha']->setDefaultValue($existence['vaha']);  
                $ucitel =  $this->getUser();
                $predmety=  $this->database->query('SELECT DISTINCT predmet, p.nazev AS `nazev` FROM znamky INNER JOIN predmet as `p` on predmet=p.id_predmetu where ucitel= ?',$ucitel->id,' ORDER BY nazev');
         
                
                $predmet_pom=array();
                foreach ($predmety as $predmet) {  
                 $predmet_pom+= array (''.$predmet->predmet.''  => ''.$predmet->nazev.'',); 
                } 
      
                $form->addHidden('id_znamky')
                      ->setValue($get['id_znamky']);  
                $form->addSelect('predmet', 'Předmět:', $predmet_pom);
                 $form['predmet']->setDefaultValue($existence['predmet']);
                $form->addSubmit('send', 'Editovat známku');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->editZnamkaS;
                
                
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
   
        
  public function editZnamkaS($form, $values)
	{
      $ucitel=$this->getUser();
      $this->database->query('UPDATE znamky SET znamka= ?',$values['znamka'],', popis= ?',$values['popis'],', datum= ?',$values['datum'],', vaha= ?',$values['vaha'],', ucitel= ?',$ucitel->id,', predmet= ?',$values['predmet'],' WHERE id_znamky=?',$values['id_znamky']);  
               		
	}        
        
        
        
        

		public function renderUcitel($id_users)
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}

		public function renderHeslo($id_users)
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}


	public function renderZnamka($id_znamky)
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}



		public function renderPredmet()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}

		public function renderTrida()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}

		public function renderSkupina()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}

		public function renderZak()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
}
}
