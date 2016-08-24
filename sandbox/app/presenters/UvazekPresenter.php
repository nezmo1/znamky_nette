<?php

namespace App\Presenters;

use Nette,
 App\Model;

/**
 * Presenter spravující funkce úvazků učitelů 
 */ 
class UvazekPresenter extends BasePresenter
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
    
        
    
  protected function createComponentSeznamUciteluUvazekGrid()
{ 
      $odkaz =  $this->presenter->link('Uvazek:uciteluvazek'); 
    $user =  $this->getUser();
    return new Model\SeznamUciteluUvazek($this->database->table('users')->where("trida=42")->where("priorita!=4")->order("prijmeni"), $this->database, $odkaz);
}

    
    
 /**
 * Funkce pro zjištění počtu checkboxů pro úvazky učitelů
 */ 
    public function pocetBoxu()
    {
        $pocet_t=$this->database->query('SELECT *, count(zkratka_tridy) as `pocet`  FROM trida WHERE zkratka_tridy !="ucitel"')->fetch();
      
        $pom_p=$pocet_t->pocet;
        $pocet_pr=$this->database->query('SELECT *, count(zkratka_predmetu) as `pocet`  FROM predmet')->fetch();
       
        return $pom_p*$pocet_pr->pocet; 
    }
    
 /**
 * Funkce pro vytvoření komponenty formuláře definice úvazku  
 */ 
     protected function createComponentDefUvazek()
	{
         
         
		$form = new Nette\Application\UI\Form;
		
                
                $pocetboxu=$this->pocetBoxu();
               
             for($i=1;$i<=$pocetboxu;$i++){
                 $form->addCheckbox('n_'.$i, NULL);
                         
                 $form->addHidden('h_'.$i);
             }
             $form->addButton('zpet', 'Zpět na seznam učitelů')
    ->setAttribute('onclick', 'zpetNaSeznam()');
             
                
                $form->addSubmit('send', 'Uložit');

		// call method signInFormSucceeded() on success
		
               $form->onSuccess[] = $this->novyUvazek; 
                
                $renderer = $form->getRenderer();




		return $form;
	}


/**
 * Funkce pracující s databází, vytvoří záznam o novém úvazku 
 */         
       public function novyUvazek($form, $values){
        
         $pocetboxu=  $this->pocetBoxu();
         $hodnoty = $values;
          // učitel
          $casti = explode("_", $hodnoty['h_1']);
          $this->database->query('DELETE FROM ucitele_uvazek WHERE ucitel="'.$casti[0].'"');
         
         for ($i=1;$i<=$pocetboxu;$i++){
         $jmenoboxu="n_".$i;
         $jmenohidden="h_".$i;
         
             if ($hodnoty[$jmenoboxu]==TRUE){
             
              $casti = explode("_", $hodnoty[$jmenohidden]);
              $this->database->query('INSERT INTO ucitele_uvazek SET ucitele_uvazek= ?', $hodnoty[$jmenohidden], ', ucitel= ?', $casti[0],', predmet= ?',$casti[2],', trida= ?',$casti[1],'');   
                                            }   
         }
          $flashMessage = $this->flashMessage('Předměty byly definovány.');  
           
       }  
            
        
/**
 * Funkce vykreslující stránku  Seznamucitelu
 */ 
    public function renderSeznamucitelu()
    {
                 $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
        $this->template->ucitele = $this->database->table('users')->where('trida','42')->where('priorita !=','4');
    }
 /**
 * Funkce vykreslující stránku  Uciteluvazek 
 */    
      public function renderUciteluvazek($ucitelId)
    {
          
                   $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
          
        $this->template->ucitel = $this->database->table('users')->where('id_users',$ucitelId)->fetch();
        $this->template->predmety = $this->database->query('SELECT *  FROM predmet');
        $this->template->tridypocet = $this->database->query('SELECT *, count(zkratka_tridy)+1 as `pocet`  FROM trida WHERE zkratka_tridy !="ucitel"')->fetch();
        $this->template->tridy = $this->database->query('SELECT *  FROM trida WHERE zkratka_tridy !="ucitel" ORDER BY jmeno_tridy');
        $this->template->pom_check=1;
        
        // Kontrola existence úvazku
        $pole=array();
        $pom_ex= $this->database->query('SELECT * FROM ucitele_uvazek');
          
        foreach($pom_ex as $ex){
        $pole[]=$ex->ucitele_uvazek; 
        }
       $this->template->uvazekma=$pole;
       
       
        // Kontrola existence úvazku pro cizí učitele
        $pole2=array();
        $pom_ex2= $this->database->query('SELECT * FROM ucitele_uvazek');
         
        foreach($pom_ex2 as $ex2){
            $pom_trida=$ex2->trida;
            $pom_predmet=$ex2->predmet;
            $pom_plus=$pom_trida.'_'.$pom_predmet;
            $pole2[]=$pom_plus;
            
        }
       
       $this->template->uvazekmajiny=$pole2;
       $this->template->uvazekuci=  $predmet_uci=$this->database->query('SELECT u.jmeno AS  `jmeno` , u.prijmeni AS  `prijmeni` , ucitele_uvazek, ucitel, predmet, s.trida AS  `trida` FROM  `ucitele_uvazek` AS  `s` INNER JOIN users AS  `u` ON u.id_users = s.ucitel');
     
      // skupiny
        $this->template->skupiny= $this->database->query('SELECT id_skupiny, nazev_skupiny, predmet, ucitel, trida, t.jmeno_tridy AS `jmeno_tridy`, p.nazev as `nazev_predmetu` FROM skupina INNER JOIN trida as `t` ON skupina.trida=t.id_tridy INNER JOIN predmet AS `p` ON skupina.predmet=p.id_predmetu WHERE ucitel= ?', $ucitelId);
      // má skupinu 
       $this->template->pocet_skupin= $this->database->query('SELECT count(id_skupiny) AS `pocet` FROM skupina WHERE ucitel= ?', $ucitelId)->fetch();
      // disable checkbox
      $pole_skup=array(); 
        $kon_skupin= $this->database->query('SELECT * FROM skupina WHERE ucitel= ?', $ucitelId);
         foreach($kon_skupin as $kon_skupina){
            $pom_trida=$kon_skupina->trida;
            $pom_predmet=$kon_skupina->predmet;
            $pom_plus=$pom_trida.'_'.$pom_predmet;
            $pole_skup[]=$pom_plus;
            
        }
        $this->template->discheck=$pole_skup;
        
        }
    
        
}