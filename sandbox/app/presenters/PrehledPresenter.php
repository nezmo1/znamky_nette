<?php

namespace App\Presenters;

use Nette,
	App\Model;

/**
 * Presenter pro správu přehledu ředitele školy
 */
class PrehledPresenter extends BasePresenter
{
    /** @var Nette\Database\Context */
    public $database;
    
     /** @persistent */
    public $backlink = '';
    
/**
 * Konstruktor presenteru, obsahující parametr pro připojení k databázi
 */
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
        
    }
/**
 * Funkce vykreslení seznamu známek všech učitelů v NiftyGrid
 */   
       protected function createComponentSeznamZnamekReditelGrid()
{ 
    $user =  $this->getUser();
    
     $get=$this->request->getParameters();
     if(isset($get['backlink'])){
     $odkaz =  $this->presenter->link('Prehled:ucitelSeznam?backlink=');  
     } 
     else{
         $odkaz =  $this->presenter->link('Prehled:ucitelSeznam');
     }
    
    return new Model\SeznamZnamekReditel($this->database->table('users')->where('trida','42')->where('priorita !=','4'), $this->database, $odkaz);
}
/**
 * Funkce pro vykreslení stránky Portal
 */   
    public function renderPortal()
    {
                 $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
        $this->template->reditel = $this->database->table('nastaveni_global')->where('parametr_1','reditel_skoly')->where('parametr_2',$user->id)->fetch();
    }
 
 /**
 * Funkce pro vykreslení stránky UciteleZnamky
 */   
    public function renderUciteleZnamky()
    {
                 $user =  $this->getUser();
             $reditel=  $this->database->table('nastaveni_global')->where('parametr_1','reditel_skoly')->where('parametr_2',$user->id)->fetch();  
    if ((!$user->isInRole('4')) and $reditel==FALSE ) {
             $this->redirect('Pristup:pristup');
       }
       
    }
    
    
    
 /**
 * Funkce vykreslení seznamu známek daného učitele v NiftyGrid
 */      
          protected function createComponentSeznamZnamekDetailReditelGrid($UcitelId)
{ 
         
           $get=$this->request->getParameters();
     if(isset($get['UcitelId'])){
     $user =  $get['UcitelId'];  
     } 
     
    
    return new Model\SeznamZnamekDetailReditel($this->database->table('znamky')->where('ucitel',$user), $this->database, $user);
}

  /**
 * Funkce pro vykreslení stránky UcitelSeznam
 */     
     public function renderUcitelSeznam($UcitelId)
    {
                 $user =  $this->getUser();
             $reditel=  $this->database->table('nastaveni_global')->where('parametr_1','reditel_skoly')->where('parametr_2',$user->id)->fetch();  
    if ((!$user->isInRole('4')) and $reditel==FALSE ) {
             $this->redirect('Pristup:pristup');
       }
       
       $this->template->jmeno_ucitele =  $this->database->query('SELECT Concat(jmeno," ",prijmeni) as cele_jmeno FROM users WHERE id_users = ?', $UcitelId)->fetch(); 
       
        
    }
    
    
  /**
 * Funkce vykreslení seznamu čtvrtletní klasifikace všech učitelů v NiftyGrid
 */     
           protected function createComponentSeznamCvZnamekReditelGrid()
{ 
    $user =  $this->getUser();
    
     $get=$this->request->getParameters();
     if(isset($get['backlink'])){
     $odkaz =  $this->presenter->link('Prehled:ucitelCvSeznam?backlink=');  
     } 
     else{
         $odkaz =  $this->presenter->link('Prehled:ucitelCvSeznam');
     }
    
    return new Model\SeznamCvZnamekReditel($this->database->table('users')->where('trida','42')->where('priorita !=','4'), $this->database, $odkaz);
}
    
 /**
 * Funkce pro vykreslení stránky UciteleKlasifikace
 */      
      public function renderUciteleKlasifikace()
    {
                 $user =  $this->getUser();
             $reditel=  $this->database->table('nastaveni_global')->where('parametr_1','reditel_skoly')->where('parametr_2',$user->id)->fetch();  
    if ((!$user->isInRole('4')) and $reditel==FALSE ) {
             $this->redirect('Pristup:pristup');
       }
       
    }
    
    
    
  /**
 * Funkce vykreslení seznamu čtvrtletní klasifikace daného učitele v NiftyGrid
 */     
            protected function createComponentSeznamCvZnamekDetailReditelGrid($UcitelId)
{ 
         
           $get=$this->request->getParameters();
     if(isset($get['UcitelId'])){
     $user =  $get['UcitelId'];  
     } 
     
    
    return new Model\SeznamCvZnamekDetailReditel($this->database->table('prum_znamky')->where('ucitel',$user), $this->database, $user);
}
    
/**
 * Funkce pro vykreslení stránky UciteleCvSeznam
 */       
      public function renderUcitelCvSeznam($UcitelId)
    {
                 $user =  $this->getUser();
             $reditel=  $this->database->table('nastaveni_global')->where('parametr_1','reditel_skoly')->where('parametr_2',$user->id)->fetch();  
    if ((!$user->isInRole('4')) and $reditel==FALSE ) {
             $this->redirect('Pristup:pristup');
       }
       
       $this->template->jmeno_ucitele =  $this->database->query('SELECT Concat(jmeno," ",prijmeni) as cele_jmeno FROM users WHERE id_users = ?', $UcitelId)->fetch(); 
       
        
    }
    
    
    
    
    
    
      public function renderSkupinadef($skupinaId)
    {
          $this->backlink = $this->storeRequest();
                   $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
        $id_tridy_v_sk=  $this->database->query('SELECT trida FROM skupina WHERE id_skupiny = ?', $skupinaId)->fetch();
        
       $this->template->skupina = $this->database->table('skupina')->get($skupinaId);
       $this->template->zaci_v_ts = $this->database->query('SELECT id_users, username, jmeno, prijmeni 
FROM   users 
WHERE  id_users NOT IN (SELECT zak FROM clenove_skupiny WHERE id_skupiny= ?',$skupinaId,') and trida= ?',$id_tridy_v_sk->trida);
       
 
       $this->template->zaci_v_sks = $this->database->query('SELECT id_users, username, jmeno, prijmeni 
FROM   users 
WHERE  id_users IN (SELECT zak FROM clenove_skupiny WHERE id_skupiny= ?',$skupinaId,') and trida= ?',$id_tridy_v_sk->trida);
        $this->template->pom_check = 1;
        $this->template->pom_check2 = 1;
        }
    
        
}