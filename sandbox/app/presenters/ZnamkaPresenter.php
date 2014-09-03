<?php

namespace App\Presenters;

use Nette,
	App\Model;
 use Nette\Forms\FormContainer;
     

class ZnamkaPresenter extends BasePresenter
{
  
    
 public $database;
 public $tridap;
 
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
        
    }
    
  public function VyberTrid($ucitel){
    $predmety=  $this->database->query('SELECT uv.ucitele_uvazek, uv.ucitel,uv.predmet as `predmet`,uv.trida as `trida`,t.jmeno_tridy as `jmeno_tridy`,p.nazev as `nazev` FROM `ucitele_uvazek` as `uv` 
INNER JOIN trida as `t` on uv.trida=t.id_tridy
INNER JOIN predmet as `p` on uv.predmet=p.id_predmetu
WHERE ucitel= ?', $ucitel,' ORDER by trida');  
    
   
    $predmety_pom=array();
     $predmety_pom+= array ('n'  => 'Vyberte předmět',); 
                foreach ($predmety as $predmet) {  
                 $predmety_pom+= array (''.$predmet->trida.''  => ''.$predmet->jmeno_tridy.'',); 
                } 
    return $predmety_pom;
  }  
  
  
  public function VyberPredmetu($ucitel,$trida){
    $predmety=  $this->database->query('SELECT uv.ucitele_uvazek, uv.ucitel,uv.predmet as `predmet`,uv.trida as `trida`,t.jmeno_tridy as `jmeno_tridy`,p.nazev as `nazev` FROM `ucitele_uvazek` as `uv` 
INNER JOIN trida as `t` on uv.trida=t.id_tridy
INNER JOIN predmet as `p` on uv.predmet=p.id_predmetu
WHERE ucitel= ?', $ucitel,' and trida= ?',$trida ,' ORDER by nazev');  
    
   
    
   
   
    $predmety_pom=array();
                foreach ($predmety as $predmet) {  
                $skupina=$this->database->table('skupina')->where('ucitel',$ucitel)->where('trida',$trida)->where('predmet',$predmet->predmet)->fetchAll(); 
                
                if($skupina!=FALSE){
                    foreach($skupina as $sk){
                     $predmety_pom+= array ('s_'.$sk->id_skupiny.''  => ''.$sk->nazev_skupiny.'',);   
                    }
                        
                    }
                   else {
                     $predmety_pom+= array ('p_'.$predmet->predmet.''  => ''.$predmet->nazev.'',);   
                   }
                        
     
                
                    
                } 
    return $predmety_pom;
  }  
   
 protected function createComponentNovaZnamka()
	{
     
     
    $get=$this->request->getParameters();
               if(isset($get['tridac'])){
                 $tridac= $get['tridac'];  
              
                
               }
               
                 
		$form = new Nette\Application\UI\Form;
                $action_pom='Znamka:novaznamka?tridac='.$tridac;
             $form->setAction($this->presenter->link($action_pom));

                
		$ucitel=$this->getUser();
                $form->addSelect('trida', 'Třída nebo skupina', $this->VyberTrid($ucitel->id));
                if(isset($get['tridac'])){
                 $form['trida']->setDefaultValue($tridac);   
               }
               
                if(isset($get['tridac']) and ($get['tridac']!='n')){
                 $form->addSelect('predmet', 'Předmět', $this->VyberPredmetu($ucitel->id,$tridac));  
               }
                
                
                $form->addText('popis', 'Popis:')
                        ->setAttribute('placeholder', 'Popis k udělené známce (např. Písemný test - Žahavci)')
			->setRequired('Zadejte popis');
                 $form->addText('datum', 'Datum:')
                        ->setAttribute('placeholder', 'Datum')
                         ->setAttribute('readonly', 'readonly')
                         ->setDefaultValue($today = date("Y-m-d"))
                         
			->setRequired('Zadejte datum');
                  $vaha= array(
                  '1'  => 'Nízká', 
                  '2'  => 'Normální', 
                  '3' => 'Vysoká',
                  
      
                );
                   
                $form->addSelect('vaha', 'Váha:', $vaha);
                $form['vaha']->setDefaultValue('2'); 
                 $form->addSubmit('send', 'Vygenerovat formulář');
		// call method signInFormSucceeded() on success
		 $form->onSuccess[] = $this->vygenTridu;
                
                
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
        
        
    public function vygenTridu(){
        
    }    
 
	public function renderNovaznamka()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2')) ) {
             $this->redirect('Pristup:pristup');
       }
       
      $yolo=$get=$this->request->getParameters(); 
if($yolo['tridac']!='n'){
    $this->template->trida_p=  $this->tridap;      
 
}
 else{
   $this->template->trida_p=  "n";  
 }  

}	
        
 
        
}


