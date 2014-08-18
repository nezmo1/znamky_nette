<?php

namespace App\Presenters;

use Nette,
	App\Model;
use Nette\Utils\Html;


/**
 * Homepage presenter.
 */
class NastaveniPresenter extends BasePresenter
{
    
  public $database;
  
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
                
		
                $ucitele=  $this->database->table('users')->where('trida','ucitel')->where('priorita !=','4');
                
                $ucitel_pom=array();
                foreach ($ucitele as $ucitel) {  
                 $ucitel_pom+= array (''.$ucitel->username.''  => ''.$ucitel->jmeno.' '.$ucitel->prijmeni.'',); 
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
    
   public function setGlNastaveni($form,$values){
       $existence_reditele=  $this->database->table('nastaveni_global')->where('parametr_1','reditel_skoly')->fetch();
       $existence_zastupce=  $this->database->table('nastaveni_global')->where('parametr_1','zastupce')->fetch();
       $existence_ict=  $this->database->table('nastaveni_global')->where('parametr_1','ict_spravce')->fetch();
      
       // reditel, zastupce, ict
      $this->database->query('UPDATE users SET priorita="2" WHERE trida="ucitel" AND priorita !=4');   
       
       if($existence_reditele==FALSE){
           $this->database->query('INSERT INTO nastaveni_global SET parametr_1="reditel_skoly", parametr_2= ?',$values->reditel);   
       }
       else {
       $this->database->query('UPDATE nastaveni_global SET parametr_2= ?',$values->reditel,' WHERE parametr_1="reditel_skoly"');   
          }
       $this->database->query('UPDATE users SET priorita="3" WHERE username= ?',$values->reditel);   
          
          
       if($existence_zastupce==FALSE){
           $this->database->query('INSERT INTO nastaveni_global SET parametr_1="zastupce", parametr_2= ?',$values->zastupce);   
       }
       else {
       $this->database->query('UPDATE nastaveni_global SET parametr_2= ?',$values->zastupce,'WHERE parametr_1="zastupce"');   
          }
       $this->database->query('UPDATE users SET priorita="3" WHERE username= ?',$values->zastupce);    
          
       if($existence_ict==FALSE){
           $this->database->query('INSERT INTO nastaveni_global SET parametr_1="ict_spravce", parametr_2= ?',$values->ict_spravce);   
       }
       else {
       $this->database->query('UPDATE nastaveni_global SET parametr_2= ?',$values->ict_spravce,'WHERE parametr_1="ict_spravce"');   
          }
       $this->database->query('UPDATE users SET priorita="3" WHERE username= ?',$values->ict_spravce);    
          
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
   

  		public function renderGlobalninastaveni()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
 
} 

}



