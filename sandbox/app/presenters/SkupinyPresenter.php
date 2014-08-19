<?php

namespace App\Presenters;

use Nette;

/* SELECT u.username, jmeno, prijmeni, u.trida FROM `users` AS `u` 
INNER JOIN skupina as `s` on u.trida = s.trida 
LEFT JOIN clenove_skupiny as `zs` on s.id_skupiny=zs.id_skupiny*/
class SkupinyPresenter extends BasePresenter
{
    /** @var Nette\Database\Context */
    public $database;
    
     /** @persistent */
    public $backlink = '';
    

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
        
    }
   public function pocetBoxuSkupina($skupinaId)
    {
       $pom_pocet= $this->database->query('SELECT trida FROM skupina WHERE id_skupiny= ?',$skupinaId)->fetch();
      
        $pocet=$this->database->query('SELECT count(trida) as `pocet`  FROM users WHERE trida !="ucitel" and trida= ?', $pom_pocet->trida)->fetch();
      $pocet_uz_v_sk=$this->database->query('SELECT count(username) as `pocet`  FROM clenove_skupiny WHERE id_skupiny= ?', $skupinaId)->fetch();
      
        
       
        return $pocet->pocet-$pocet_uz_v_sk->pocet; 
    }  
    
    
    public function pocetBoxuSkupina2($skupinaId)
    {
       $pocet_uz_v_sk=$this->database->query('SELECT count(username) as `pocet`  FROM clenove_skupiny WHERE id_skupiny= ?', $skupinaId)->fetch();
      
        
       
        return $pocet_uz_v_sk->pocet; 
    }  
    
  protected function createComponentSeznamZakuSkupina()
	{
		$form = new Nette\Application\UI\Form;
		
                $get=$this->request->getParameters();
               
                 $pocet_boxu=  $this->pocetBoxuSkupina($get['skupinaId']);
                 
                 for($i=1;$i<=$pocet_boxu;$i++){
                 $form->addCheckbox('n_'.$i, NULL);
                 $form->addHidden('h_'.$i);
             }
                 $form->addSubmit('send', 'Vložit žáky');
		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->vlozitDoSkupiny;
                
                
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
        
      public function vlozitDoSkupiny($form, $values){
        
        $get=$this->request->getParameters();
        $pocetboxu=  $this->pocetBoxuSkupina($get['skupinaId']);
         $hodnoty = $values;
          // učitel
          
         
         for ($i=1;$i<=$pocetboxu;$i++){
         $jmenoboxu="n_".$i;
         $jmenohidden="h_".$i;
         
             if ($hodnoty[$jmenoboxu]==TRUE){
             
             
              $this->database->query('INSERT INTO clenove_skupiny SET username= ?', $hodnoty[$jmenohidden], ', id_skupiny= ?', $get['skupinaId'],'');   
                                            }   
         }
          $flashMessage = $this->flashMessage('Operace proběhla úspěšně');  
           $this->restoreRequest($this->backlink);
       }     
        
 
     protected function createComponentSeznamZakuVeSkupine()
	{
		$form = new Nette\Application\UI\Form;
		
                $get=$this->request->getParameters();
               
                 $pocet_boxu=  $this->pocetBoxuSkupina2($get['skupinaId']);
                 
                 for($i=1;$i<=$pocet_boxu;$i++){
                 $form->addCheckbox('n1_'.$i, NULL);
                 $form->addHidden('h1_'.$i);
             }
                 $form->addSubmit('send', 'Odebrat žáky');
		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->odebratZeSkupiny;
                
                
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
       
        
    public function odebratZeSkupiny($form, $values){
        
        $get=$this->request->getParameters();
        $pocetboxu=  $this->pocetBoxuSkupina2($get['skupinaId']);
         $hodnoty = $values;
          // učitel
          
         
         for ($i=1;$i<=$pocetboxu;$i++){
         $jmenoboxu="n1_".$i;
         $jmenohidden="h1_".$i;
         
             if ($hodnoty[$jmenoboxu]==TRUE){
             
             
            $this->database->query('DELETE FROM clenove_skupiny WHERE username= ?', $hodnoty[$jmenohidden], ' and id_skupiny= ?', $get['skupinaId'],'');   
                                            }   
         }
         
          $flashMessage = $this->flashMessage('Operace proběhla úspěšně');  
           $this->restoreRequest($this->backlink);
           
       }     
        
       
       

    public function renderSeznamskupindef()
    {
                 $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) ) {
             $this->redirect('Pristup:pristup');
       }
        $this->template->skupiny = $this->database->table('skupina');
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
       $this->template->zaci_v_ts = $this->database->query('SELECT username, jmeno, prijmeni 
FROM   users 
WHERE  username NOT IN (SELECT username FROM clenove_skupiny WHERE id_skupiny= ?',$skupinaId,') and trida= ?',$id_tridy_v_sk->trida);
       
 
       $this->template->zaci_v_sks = $this->database->query('SELECT username, jmeno, prijmeni 
FROM   users 
WHERE  username IN (SELECT username FROM clenove_skupiny WHERE id_skupiny= ?',$skupinaId,') and trida= ?',$id_tridy_v_sk->trida);
        $this->template->pom_check = 1;
        $this->template->pom_check2 = 1;
        }
    
        
}