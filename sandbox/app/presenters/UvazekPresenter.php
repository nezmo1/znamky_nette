<?php

namespace App\Presenters;

use Nette;


class UvazekPresenter extends BasePresenter
{
    /** @var Nette\Database\Context */
    public $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
        
    }
    
    public function pocetBoxu()
    {
        $lama=$this->database->query('SELECT *, count(zkratka_tridy) as `pocet`  FROM trida WHERE zkratka_tridy !="ucitel"')->fetch();
      
        $swag=$lama->pocet;
        $lama=$this->database->query('SELECT *, count(zkratka_predmetu) as `pocet`  FROM predmet')->fetch();
       
        return $swag*$lama->pocet; 
    }
    
    
     protected function createComponentDefUvazek()
	{
         
         
		$form = new Nette\Application\UI\Form;
		
                
                $pocetboxu=$this->pocetBoxu();
               
             for($i=1;$i<=$pocetboxu;$i++){
                 $form->addCheckbox('n_'.$i, NULL);
                 $form->addHidden('h_'.$i);
             }
             
                
                $form->addSubmit('send', 'Uložit');

		// call method signInFormSucceeded() on success
		
               $form->onSuccess[] = $this->novyUvazek; 
                
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
          
           
       }  
            
        

    public function renderSeznamucitelu()
    {
                 $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
        $this->template->ucitele = $this->database->table('users')->where('trida','ucitel')->where('priorita !=','4');
    }
    
      public function renderUciteluvazek($ucitelId)
    {
          
                   $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
          
        $this->template->ucitel = $this->database->table('users')->get($ucitelId);
        $this->template->predmety = $this->database->query('SELECT *  FROM predmet');
        $this->template->tridypocet = $this->database->query('SELECT *, count(zkratka_tridy)+1 as `pocet`  FROM trida WHERE zkratka_tridy !="ucitel"')->fetch();
        $this->template->tridy = $this->database->query('SELECT *  FROM trida WHERE zkratka_tridy !="ucitel"');
        $this->template->pom_check=1;
        $pom_ex= $this->database->query('SELECT * FROM ucitele_uvazek');
        $pole=array();
        foreach($pom_ex as $ex){
            
        }
       $this->template->uvazekma = ;
        
    }
    
}