<?php

namespace App\Presenters;

use Nette,
	App\Model;
use Nette\Utils\Html;


/**
 * Presenter spravující nastavení
 */
class NastaveniPresenter extends BasePresenter
{
    
  public $database;
  
 /**
 * Funkce pro vytvoření komponenty formuláře změny hesla v personálním nastavení
 */ 
  protected function createComponentPerZmenaHesla()
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
		$form->onSuccess[] = $this->zmenaHesla;
                
                
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
        

        
        
 /**
 * Funkce pracující s databází, aktualizuje údaje o hesle uživatele
 */      
        function zmenaHesla($form, $values){
                                           
                    if($this->database->query('UPDATE users SET password= ?',md5($values->password),'WHERE id_users=?', $this->user->id)){
                     $flashMessage = $this->flashMessage('Heslo bylo úspěšně změněno.');    
                    }
                    else {
                     $flashMessage = $this->flashMessage('Chyba databáze na straně serveru, heslo nebylo změněno!');    
                    }
                      
                  return $flashMessage;       
                
        }
  
  
 /**
 * Funkce pro vytvoření komponenty formuláře změny emailu v personálním nastavení
 */  
    protected function createComponentPerEmail()
	{
        $existence_mail=  $this->database->table('users')->where('id_users', $this->user->id)->fetch();
        $existence_zak_mail=  $this->database->table('nastaveni_personal')->where('id_user', $this->user->id)->where('parametr','mail_znamky_ano')->fetch();
         $zak_mail=FALSE;
        if($existence_zak_mail!=FALSE){
         $zak_mail = TRUE;  
        }
        
        
		$form = new Nette\Application\UI\Form;
		 $form->addText('mail', 'E-mail:')
                        ->setAttribute('placeholder', 'E-mail ve správném tvaru')
                        ->setRequired('Zadejte E-mail')
			->addRule($form::EMAIL, 'E-mail je ve špatném tvaru')
                         ->setDefaultValue($existence_mail->mail);
                 
                 if(($existence_mail->mail!="")and($this->user->isInRole('1'))){
                     $form->addCheckbox('znamky_zak','Posílat nové známky e-mailem')
                             ->setDefaultValue($zak_mail);
                 }
                 
                 
                
                
                 $form->addSubmit('send', 'Uložit změny');
		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->zmenaEmailu;
                
                
                $renderer = $form->getRenderer();
$renderer->wrappers['controls']['container'] = NULL;

$renderer->wrappers['pair']['container'] = "tr style='text-align:right'";
$renderer->wrappers['pair']['.odd'] = 'alt';
$renderer->wrappers['label']['container'] = 'td td style="text-align:left"';

$renderer->wrappers['control']['.text'] = 'udaje';
$renderer->wrappers['control']['.password'] = 'udaje';
$renderer->wrappers['control']['.submit'] = 'uvazek-send';


		return $form;
	}     
        
 /**
 * Funkce pracující s databází, aktualizuje údaje o emailu uživatele
 */     
        function zmenaEmailu($form, $values){
                      $existence_mail=  $this->database->table('users')->where('id_users', $this->user->id)->fetch();
                            
                    if($this->database->query('UPDATE users SET mail= ?',$values->mail,'WHERE id_users=?', $this->user->id)){
                     $flashMessage = $this->flashMessage('Změny proběhly úspěšně.');    
                    }
                    else {
                     $flashMessage = $this->flashMessage('Chyba databáze na straně serveru.');    
                    }
                   
                    
                     if(($existence_mail->mail!="")and ($this->user->isInRole('1'))){
                        
                    if($values->znamky_zak==TRUE){
                   $existence_posilani=  $this->database->table('nastaveni_personal')->where('id_user', $this->user->id)->where('parametr','mail_znamkky_ano')->fetch();
                   if($existence_posilani==FALSE){
                    $this->database->query('INSERT INTO nastaveni_personal SET parametr="mail_znamky_ano", id_user=?', $this->user->id);   
                      }
                    else{
                     $this->database->query('UPDATE nastaveni_personal SET parametr="mail_znamky_ano" WHERE id_user=?', $this->user->id);   
                       
                    }  
                         }
                         
                     if($values->znamky_zak==FALSE){
                       $this->database->query('DELETE FROM nastaveni_personal WHERE parametr="mail_znamky_ano" and id_user=?', $this->user->id);   
                       
                     }     
                    }
                  return $flashMessage; 
                  
                  
                
        }
        
 /**
 * Funkce pro vytvoření komponenty formuláře změny šířky známky v personálním nastavení
 */         
        protected function createComponentPerSirkaZnamky()
	{
        $existence_sirka=  $this->database->table('nastaveni_personal')->where('id_user', $this->user->id)->where('parametr','sirka_znamek_ano')->fetch();
         $sirka=FALSE;
        if($existence_sirka!=FALSE){
         $sirka = TRUE;  
        }
        
        
		$form = new Nette\Application\UI\Form;
		
                 
               
                     $form->addCheckbox('znamky_sirka','Používat široký popis známek (vhodné pro slovní hodnocení)')
                             ->setDefaultValue($sirka);
                 
                 
                 
                
                
                 $form->addSubmit('send', 'Uložit změny');
                         
                 
                         
		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->sirkaZnamek;
                
                
                $renderer = $form->getRenderer();
$renderer->wrappers['controls']['container'] = NULL;

$renderer->wrappers['pair']['container'] = "tr style='text-align:right'";
$renderer->wrappers['pair']['.odd'] = 'alt';
$renderer->wrappers['label']['container'] = 'td';

$renderer->wrappers['control']['.text'] = 'udaje';
$renderer->wrappers['control']['.password'] = 'udaje';
$renderer->wrappers['control']['.submit'] = 'uvazek-send';


		return $form;
	}     
        
    /**
 * Funkce pracující s databází, aktualizuje šířku formulářového prvku stránky
 */  
        function sirkaZnamek($form, $values){
           
            
                        
                    if($values->znamky_sirka==TRUE){
                   $existence_sirka=  $this->database->table('nastaveni_personal')->where('id_user', $this->user->id)->where('parametr','sirka_znamek_ano')->fetch();
                   if($existence_sirka==FALSE){
                    $this->database->query('INSERT INTO nastaveni_personal SET parametr="sirka_znamek_ano", id_user=?', $this->user->id);   
                      }
                    else{
                     $this->database->query('UPDATE nastaveni_personal SET parametr="sirka_znamek_ano" WHERE id_user=?', $this->user->id);   
                       
                    }  
                         }
                         
                     if($values->znamky_sirka==FALSE){
                       $this->database->query('DELETE FROM nastaveni_personal WHERE parametr="sirka_znamek_ano" and id_user=?', $this->user->id);   
                       
                     }     
                    $flashMessage = $this->flashMessage('Změny proběhly úspěšně');  
                  return $flashMessage; 
                  
                  
                
        }
        
        
        
        
 /**
 * Funkce pro vytvoření komponenty formuláře pro globální nastavení
 */     
  
  protected function createComponentGlNastaveni()
	{
       
      // defaultní hodnoty
      $existence_reditele=  $this->database->table('nastaveni_global')->where('parametr_1','reditel_skoly')->fetch();
       $existence_zastupce=  $this->database->table('nastaveni_global')->where('parametr_1','zastupce')->fetch();
       $existence_ict=  $this->database->table('nastaveni_global')->where('parametr_1','ict_spravce')->fetch();
       $existence_nazvu=  $this->database->table('nastaveni_global')->where('parametr_1','nazev_skoly')->fetch(); 
        $existence_url=  $this->database->table('nastaveni_global')->where('parametr_1','url_skoly')->fetch();
       
        
        $nazev_skoly="";
        if($existence_nazvu!=FALSE){
         $nazev_skoly = $existence_nazvu->parametr_2;  
        }
        
        $url_skoly="";
        if($existence_url!=FALSE){
         $url_skoly = $existence_url->parametr_2;  
        }
        
        $reditel_skoly="";
        if($existence_reditele!=FALSE){
         $reditel_skoly = $existence_reditele->parametr_2;  
        }
        
        $zastupce="";
        if($existence_zastupce!=FALSE){
         $zastupce = $existence_zastupce->parametr_2;  
        }
        
         $ict="";
        if($existence_ict!=FALSE){
         $ict = $existence_ict->parametr_2;  
        }
        
        
        
        // formulář
		$form = new Nette\Application\UI\Form;
		$form->addText('nazev_skoly', 'Název školy')
                        ->setAttribute('placeholder', 'Název školy')
			->setRequired('Zadejte název školy');
                $form->addText('url_skoly', 'Stránky školy')
                        ->setAttribute('placeholder', 'URL adresa školy')
			->setRequired('Zadejte URL adresu školy');       
                
		
                $ucitele=  $this->database->table('users')->where('trida','42')->where('priorita !=','4');
                
                $ucitel_pom=array();
                foreach ($ucitele as $ucitel) {  
                 $ucitel_pom+= array (''.$ucitel->id_users.''  => ''.$ucitel->jmeno.' '.$ucitel->prijmeni.'',); 
                } 
      
                $form->setDefaults(array(
                        'nazev_skoly' => $nazev_skoly,
                        'url_skoly' => $url_skoly,                
                       ));
                
                $form->addSelect('reditel', 'Ředitel školy:', $ucitel_pom);
                $form['reditel']->setDefaultValue($reditel_skoly); 
                
                $form->addSelect('zastupce', 'Zástupce ředitele:', $ucitel_pom);
                $form['zastupce']->setDefaultValue($zastupce); 
                
                $form->addSelect('ict_spravce', 'Správce ICT:', $ucitel_pom);
                 $form['ict_spravce']->setDefaultValue($ict);
                
                 
               
                     
		$form->addSubmit('send', 'Uložit nastavení');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->setGlNastaveni;
                
                
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
 * Funkce pracující s databází, aktualizuje údaje globálního nastavení
 */       
   public function setGlNastaveni($form,$values){
       $existence_reditele=  $this->database->table('nastaveni_global')->where('parametr_1','reditel_skoly')->fetch();
       $existence_zastupce=  $this->database->table('nastaveni_global')->where('parametr_1','zastupce')->fetch();
       $existence_ict=  $this->database->table('nastaveni_global')->where('parametr_1','ict_spravce')->fetch();
      
       // reditel, zastupce, ict
      $this->database->query('UPDATE users SET priorita="2" WHERE trida="42" AND priorita !=4');   
       
       if($existence_reditele==FALSE){
           $this->database->query('INSERT INTO nastaveni_global SET parametr_1="reditel_skoly", parametr_2= ?',$values->reditel);   
       }
       else {
       $this->database->query('UPDATE nastaveni_global SET parametr_2= ?',$values->reditel,' WHERE parametr_1="reditel_skoly"');   
          }
       $this->database->query('UPDATE users SET priorita="3" WHERE id_users= ?',$values->reditel);   
          
          
       if($existence_zastupce==FALSE){
           $this->database->query('INSERT INTO nastaveni_global SET parametr_1="zastupce", parametr_2= ?',$values->zastupce);   
       }
       else {
       $this->database->query('UPDATE nastaveni_global SET parametr_2= ?',$values->zastupce,'WHERE parametr_1="zastupce"');   
          }
       $this->database->query('UPDATE users SET priorita="3" WHERE id_users= ?',$values->zastupce);    
          
       if($existence_ict==FALSE){
           $this->database->query('INSERT INTO nastaveni_global SET parametr_1="ict_spravce", parametr_2= ?',$values->ict_spravce);   
       }
       else {
       $this->database->query('UPDATE nastaveni_global SET parametr_2= ?',$values->ict_spravce,'WHERE parametr_1="ict_spravce"');   
          }
       $this->database->query('UPDATE users SET priorita="3" WHERE id_users= ?',$values->ict_spravce);    
          
        // Název školy, stránky školy
        $existence_nazvu=  $this->database->table('nastaveni_global')->where('parametr_1','nazev_skoly')->fetch(); 
        $existence_url=  $this->database->table('nastaveni_global')->where('parametr_1','url_skoly')->fetch();
        
        if($existence_nazvu==FALSE){
           $this->database->query('INSERT INTO nastaveni_global SET parametr_1="nazev_skoly", parametr_2= ?',$values->nazev_skoly);   
       }
       else {
       $this->database->query('UPDATE nastaveni_global SET parametr_2= ?',$values->nazev_skoly,'WHERE parametr_1="nazev_skoly"');   
          } 
       
       if($existence_url==FALSE){
           $this->database->query('INSERT INTO nastaveni_global SET parametr_1="url_skoly", parametr_2= ?',$values->url_skoly);   
       }
       else {
       $this->database->query('UPDATE nastaveni_global SET parametr_2= ?',$values->url_skoly,'WHERE parametr_1="url_skoly"');   
          }    
   }     
  /**
 * Funkce vykresluje stránku Globalninastaveni
 */  

  		public function renderGlobalninastaveni()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
} 
 /**
 * Funkce vykresluje stránku Personalninastaveni
 */ 
  		public function renderPersonalninastaveni()
{
           $user =  $this->getUser();
    if ((!$user->isLoggedIn())) {
             $this->redirect('Pristup:pristup');
       }
 
} 

}



