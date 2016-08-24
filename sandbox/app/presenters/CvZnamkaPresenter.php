<?php

namespace App\Presenters;

use Nette,
	App\Model;
 use Nette\Forms\FormContainer;
     
/**
 * Prezenter zaměřený na funkce čtvrtletní klasifikace
 */
class CvZnamkaPresenter extends BasePresenter
{
  
    
 public $database;
 public $tridap;
 
 public $hodnoty;
 
/**
 * Konstruktor presenteru, obsahující parametr pro připojení k databázi
 */ 
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
        
    }
/**
 * Funkce řešící výběr tříd z úvazků učitelů pomocí jeho id <br>
 * $ucitel obsahuje id učitele <br>
 * Vrací pole možných tříd <br>
 */    
  public function VyberTrid($ucitel){
    $predmety=  $this->database->query('SELECT uv.ucitele_uvazek, uv.ucitel,uv.predmet as `predmet`,uv.trida as `trida`,t.jmeno_tridy as `jmeno_tridy`,p.nazev as `nazev` FROM `ucitele_uvazek` as `uv` 
INNER JOIN trida as `t` on uv.trida=t.id_tridy
INNER JOIN predmet as `p` on uv.predmet=p.id_predmetu
WHERE ucitel= ?', $ucitel,' ORDER by trida');  
    
   
    $predmety_pom=array();
     $predmety_pom+= array ('n'  => 'Vyberte třídu',); 
                foreach ($predmety as $predmet) {  
                 $predmety_pom+= array (''.$predmet->trida.''  => ''.$predmet->jmeno_tridy.'',); 
                } 
    return $predmety_pom;
  }  
  
/**
 * Funkce řešící výběr tříd z úvazků učitelů pomocí učitelova ID a pole tříd z funkce VyberTrid <br>
 * $ucitel obsahuje id učitele <br>
 * $trida obsahuje pole možných tříd <br>
 */  
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

 /**
 * Vytvoření komponenty pro formulář vložení nové známky 
 */
 protected function createComponentNovaZnamka()
	{
     
/**
 * pomocí parametru v URL vybere třídu
 */     
    $get=$this->request->getParameters();
               if(isset($get['tridac'])){
                 $tridac= $get['tridac'];  
              
                
               }
               
                 
		$form = new Nette\Application\UI\Form;
                $action_pom='CvZnamka:novaznamka?tridac='.$tridac;
             $form->setAction($this->presenter->link($action_pom));

                
		$ucitel=$this->getUser();
                $form->addSelect('trida', 'Třída nebo skupina', $this->VyberTrid($ucitel->id));
                if(isset($get['tridac'])){
                 $form['trida']->setDefaultValue($tridac);   
               }
               
                if(isset($get['tridac']) and ($get['tridac']!='n')){
                 $form->addSelect('predmet', 'Předmět', $this->VyberPredmetu($ucitel->id,$tridac));  
               }
                
                
                
                  $ctvrtleti= array(
                  '1'  => '1. čtvrtletí', 
                  '2'  => 'Pololetí', 
                  '3' => '3. čtvrtletí',
                  '4' => 'Konec roku',
      
                );
                   
                $form->addSelect('ctvrtleti', 'Čtvrtletí:', $ctvrtleti);
                $form['ctvrtleti']->setDefaultValue('1'); 
                 $form->addSubmit('send', 'Vygenerovat formulář');
		// call method signInFormSucceeded() on success
		 $form->onSuccess[] = $this->vygenForm;
                
                
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
 * Funkce pro vygenerovaný formulář <br>
 * $form obsahuje komponentu NovaZnamka <br>
 * $values je povinný parametr 
 */       
  public function vygenForm($form, $values){
  
      $this->hodnoty=$values;
      
   $this->redirect('CvZnamka:vygenFormNovaZnamka?predmet='.$values['predmet'].'&trida='.$values['trida'].'&ctvrtleti='.$values['ctvrtleti'].'');
  
  
  }     
  
/**
 * Vytvoření komponenty formuláře hromadné známky.
 */  
  protected function createComponentFormHromadnaZnamka()
	{
     
/**
 * výběr hodnot z URL adresy
 */     
    $get=$this->request->getParameters();
               
               
                 
		$form = new Nette\Application\UI\Form;
              

                 $action_pom='CvZnamka:vygenFormNovaZnamka?predmet='.$get['predmet'].'&trida='.$get['trida'].'&ctvrtleti='.$get['ctvrtleti'].'';
 
             $form->setAction($this->presenter->link($action_pom)); 
		$ucitel=$this->getUser();
               $casti = explode("_", $get['predmet']);
               if($casti[0]=="s"){
                $vyber_zaku=  $this->database->query('SELECT zak,u.jmeno as `jmeno`,u.prijmeni `prijmeni` FROM clenove_skupiny INNER JOIN users as `u` on zak=u.id_users WHERE id_skupiny= ?',$casti[1],' ORDER BY prijmeni,jmeno')->fetchAll();
                 
               }
               else{
                $vyber_zaku=  $this->database->query('SELECT u.jmeno as `jmeno`,u.prijmeni as `prijmeni`  FROM `ucitele_uvazek` 
INNER JOIN users as `u` on ucitele_uvazek.trida=u.trida
WHERE ucitel= ?',$ucitel->id,' and predmet= ?',$casti['1'],' and u.trida= ?',$get['trida'] ,' ORDER BY prijmeni,jmeno')->fetchAll();
                   
               }
  $sirka=  $this->database->query('SELECT * FROM nastaveni_personal WHERE id_user= ?',$ucitel->id,'and parametr="sirka_znamek_ano"')->fetch();              
                $pom_cislo=1;
                if($vyber_zaku!=FALSE){
                  foreach($vyber_zaku as $vyber_zak){
                    $id_zak="zak_".$pom_cislo;
                   
                    $form->addText($id_zak, 'Žák')
                        ->setAttribute('readonly', 'readonly')
                        ->setDefaultValue($vyber_zak['jmeno'].' '.$vyber_zak['prijmeni']);  
                    $znamka="znamka_".$pom_cislo;
                    if($sirka!=FALSE){
                     $form->addTextArea($znamka, "Znamka");    
                    }
                    
                    else{
                     $form->addText($znamka, "Znamka");   
                    }
                    
                                        
                    
                  
                  $h_zak="hzak_".$pom_cislo;
                  $form->addHidden($h_zak); 
                  $pom_cislo++;       
                }   
                }
                else{
                  $form->addText('zak_1', 'Žák')
                        ->setAttribute('placeholder', 'Nebyli nalezeni žádní žáci')  
                          ->setAttribute('readonly', 'readonly'); 
                }
               
                 $form->addHidden('pocet_zaznamu');
                      
		 
                 $form->addHidden('trida')
                      ->setValue($get['trida']);
                
                 $form->addHidden('ctvrtleti')
                      ->setValue($get['ctvrtleti']); 
                 $form->addHidden('predmet')
                      ->setValue($get['predmet']); 
                 $form->addSubmit('send', 'Vložit známky');
		// call method signInFormSucceeded() on success
		 $form->onSuccess[] = $this->vlozitZnamky;
                
                
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
 * Funkce vkládá známky do databáze
 * 
 */  
  public function vlozitZnamky($form, $values){
      // dump($values);
      $ucitel=$this->getUser();
      $casti = explode("_", $values['predmet']);
      if($casti[0]=="p"){
        for($i=1;$i<$values['pocet_zaznamu'];$i++){
           $znamka='znamka_'.$i; 
           $zak='hzak_'.$i;
           $ctvrtleti='ctvrtleti_'.$values['ctvrtleti'];
        if($values[$znamka]!=""){
         $exist=  $this->database->query('SELECT * FROM prum_znamky where zak= ?', $values[$zak], 'and predmet= ?', $casti[1])->fetch();   
         if($exist==FALSE){
              $this->database->query('INSERT INTO prum_znamky SET '.$ctvrtleti.'= ?',$values[$znamka],', ucitel= ?',$ucitel->id,', zak= ?',$values[$zak],', predmet= ?', $casti[1]);    
         }
         else {
            $this->database->query('UPDATE prum_znamky SET '.$ctvrtleti.'= ?',$values[$znamka],', ucitel= ?',$ucitel->id,' WHERE zak= ?',$values[$zak],'and predmet= ?',$casti[1]); 
         }
                                }
         }  
      }
      
      
      if($casti[0]=="s"){
          $predmet=  $this->database->query('SELECT predmet FROM skupina WHERE id_skupiny= ?',$casti[1])->fetch();
        for($i=1;$i<$values['pocet_zaznamu'];$i++){
           $znamka='znamka_'.$i; 
           $zak='hzak_'.$i; 
           $ctvrtleti='ctvrtleti_'.$values['ctvrtleti'];
        if($values[$znamka]!=""){
             $exist=  $this->database->query('SELECT * FROM prum_znamky where zak= ?', $values[$zak], 'and predmet= ?', $predmet->predmet)->fetch();  
             
         if($exist==FALSE){
              $this->database->query('INSERT INTO prum_znamky SET '.$ctvrtleti.'= ?',$values[$znamka],', ucitel= ?',$ucitel->id,', zak= ?',$values[$zak],', predmet= ?', $predmet->predmet);    
         }
         else {
            $this->database->query('UPDATE prum_znamky SET '.$ctvrtleti.'= ?',$values[$znamka],', ucitel= ?',$ucitel->id,' WHERE zak= ?',$values[$zak],'and predmet= ?',$predmet->predmet);    
        
         }
          
            }
         }  
      }
      $this->redirect('CvZnamka:novaznamka?tridac=n&uspech=ano');
  }
  
  
  
/**
 * Funkce pro vykreslení stránky Nové známky pro čtvrtletní klasifikaci
 */ 
	public function renderNovaznamka()
{
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2')) ) {
             $this->redirect('Pristup:pristup');
       }
       
      $trida=$get=$this->request->getParameters(); 
if($trida['tridac']!='n'){
    $this->template->trida_p=  $this->tridap;      
 
}
 else{
   $this->template->trida_p=  "n";  
 }  

 if(isset($trida['uspech'])){
    $this->template->uspech=  "ano";      
 
}
 else{
   $this->template->uspech=  "ne";  
 } 
 
 
}	
/**
 * Funkce pro vykreslení stránky s vygenerovaným formulářem Čtvrtletní klasifikace
 */
public function rendervygenFormNovaZnamka()
{
    
            $user =  $this->getUser();
    if ((!$user->isInRole('4')) and (!$user->isInRole('3')) and (!$user->isInRole('2')) ) {
             $this->redirect('Pristup:pristup');
       }
       $ucitel=$this->getUser();
       $get=$this->request->getParameters();
        $casti = explode("_", $get['predmet']);
               if($casti[0]=="s"){
                   $this->template->vyber_zaku=  $this->database->query('SELECT zak,u.jmeno as `jmeno`,u.prijmeni `prijmeni` FROM clenove_skupiny INNER JOIN users as `u` on zak=u.id_users WHERE id_skupiny= ?',$casti[1], 'ORDER BY prijmeni,jmeno')->fetchAll();
                  $this->template->trida=  $this->database->query('SELECT jmeno_tridy FROM trida WHERE id_tridy='.$get['trida'])->fetch(); 
                   $this->template->predmet= $this->database->query('SELECT skupina.nazev_skupiny as `nazev` FROM predmet INNER JOIN skupina on predmet.id_predmetu=skupina.predmet WHERE skupina.id_skupiny='.$casti['1'])->fetch();
                  
               }
               
               else{
              $this->template->vyber_zaku=  $this->database->query('SELECT u.id_users as `zak`, u.jmeno as `jmeno`,u.prijmeni as `prijmeni`  FROM `ucitele_uvazek` 
INNER JOIN users as `u` on ucitele_uvazek.trida=u.trida
WHERE ucitel= ?',$ucitel->id,' and predmet= ?',$casti['1'],' and u.trida= ?',$get['trida'],' ORDER BY prijmeni,jmeno')->fetchAll();
                
              
               $this->template->trida=  $this->database->query('SELECT jmeno_tridy FROM trida WHERE id_tridy='.$get['trida'])->fetch(); 
              $this->template->predmet= $this->database->query('SELECT nazev FROM predmet WHERE id_predmetu='.$casti['1'])->fetch();
           
               }
        
            $this->template->pom_cislo=1;
            
            
  $this->template->sirka=  $this->database->query('SELECT * FROM nastaveni_personal WHERE id_user= ?',$ucitel->id,'and parametr="sirka_znamek_ano"')->fetch();              
    $detekuj=new \DesktopDetect();
     $this->template->desktop= $detekuj->DetekujMobil();
}	
        
 
        
}


