<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamSkupin extends Grid{

    protected $skupiny;
    public $database;
    public $predmet_pom;
    public $zak_pom;
    public $odkaz;
    public $trida;
    public $pocet_zaku;
    public $cela_trida;
    
    public function __construct($skupiny, \Nette\Database\Context $database, $odkaz)
    {
        parent::__construct();
        $this->skupiny = $skupiny;
      $this->database = $database;
      $this->odkaz = $odkaz;   
    
    }

    protected function configure($presenter)
    {
         
          $predmety=  $this->database->query('SELECT DISTINCT predmet, p.nazev AS `nazev` FROM skupina INNER JOIN predmet as `p` on predmet=p.id_predmetu  ORDER BY nazev');
          $ucitele=  $this->database->query('SELECT DISTINCT ucitel,u.jmeno AS `jmeno`, u.prijmeni AS `prijmeni` FROM skupina INNER JOIN users AS `u` ON ucitel=u.id_users ORDER BY prijmeni');      
           $tridy=  $this->database->query('SELECT DISTINCT trida, t.jmeno_tridy AS `jmeno_tridy` FROM skupina INNER JOIN trida AS `t` on trida=id_tridy ');    
          $p_zaci=$this->database->query('SELECT count(id_clen_skupiny) AS `pocet_zaku`, id_skupiny FROM clenove_skupiny GROUP BY id_skupiny');    
         $p_cela_tridy=$this->database->query('SELECT count(id_users) AS `pocet_zaku`, trida FROM users where trida !=42 and priorita !=4 GROUP BY trida'); 
          
         
         $this->cela_trida=array();
                foreach ($p_cela_tridy as $p_cela_trida) {  
                 $this->cela_trida+= array (''.$p_cela_trida->trida.''  => ''.$p_cela_trida->pocet_zaku.'',); 
                }
           
          $this->pocet_zaku=array();
                foreach ($p_zaci as $p_zak) {  
                 $this->pocet_zaku+= array (''.$p_zak->id_skupiny.''  => ''.$p_zak->pocet_zaku.'',); 
                }
           
          
           $this->trida=array();
                foreach ($tridy as $trida) {  
                 $this->trida+= array (''.$trida->trida.''  => ''.$trida->jmeno_tridy.'',); 
                }
           
           
              $this->predmet_pom=array();
                foreach ($predmety as $predmet) {  
                 $this->predmet_pom+= array (''.$predmet->predmet.''  => ''.$predmet->nazev.'',); 
                } 
                
                $this->zak_pom=array();
                foreach ($ucitele as $ucitel) {  
                 $this->zak_pom+= array (''.$ucitel->ucitel.''  => ''.$ucitel->jmeno.' '.$ucitel->prijmeni.'',); 
                } 
                
                 
      
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->skupiny->select('id_skupiny, id_skupiny AS `pocet_zaku`, nazev_skupiny, predmet, ucitel, trida'));
     
//Předáme zdroj
        $this->setDataSource($source);
        
      $self=$this;
               
       $this->addColumn('nazev_skupiny', 'Název skupiny', '')
            ->setTextFilter()
               ->setRenderer(function($row) use($self){
                  
                 return \Nette\Utils\Html::el('a')->href($self->odkaz, array('skupinaId'=>$row['id_skupiny'],))->setText($row['nazev_skupiny'])->addAttributes(array('style' => 'font-weight:normal;color:black'));
               });
       
       
       
      $this->addColumn('predmet', 'Předmět', '')
           ->setRenderer(function($row) use($self){
                   
                 
                   $jmeno_predmetu=$row['predmet'];
                   
                   return $self->predmet_pom[$jmeno_predmetu] ;})
                   ->setSelectFilter($this->predmet_pom);
                
                   
                   
                   
      $this->addColumn('trida', 'Třída','')
              ->setSelectFilter($this->trida)
                ->setRenderer(function($row) use($self){
                   
                 
                   $zak_v_tride=$row['trida'];
                   
                   return $self->trida[$zak_v_tride] ;})
                 
            ->setSortable(FALSE);
                   
                   
       $this->addColumn('ucitel', 'Učitel', '')
           ->setSelectFilter($this->zak_pom)
                ->setRenderer(function($row) use($self){
                   
               
                   $jmeno_ucitele=$row['ucitel'];
                     return \Nette\Utils\Html::el('font')->setText($self->zak_pom[$jmeno_ucitele])->addAttributes(array('style' => 'font-weight:bold;'));
                   }); 
          $this->addColumn('pocet_zaku', 'Počet žáků ve skupině (Celkem žáků)', '200px')
                  
                  ->setRenderer(function($row) use($self){
                   $skupina=$row['pocet_zaku'];
                   $trida=$row['trida'];
                 if(isset($self->pocet_zaku[$skupina])){
                    return \Nette\Utils\Html::el('font')->setText($self->pocet_zaku[$skupina].' ('.$self->cela_trida[$trida].')')->addAttributes(array('style' => 'font-weight:normal;')); 
                    }
                 else {
                    return \Nette\Utils\Html::el('font')->setText('0')->addAttributes(array('style' => 'font-weight:bold;color:red')); 
                 }
                 
                   
                   
                   })
                   
                 ->setSortable(FALSE); 
                   
      
       
 
     
     
    
    
$self = $this;


 $this->addButton("edit", "Editovat")
    ->setClass("edit")
    ->setLink(function($row) use ($presenter){return $presenter->link("edit:skupina", $row['id_skupiny']);})
    ->setAjax(FALSE);
    
  $this->addButton("clear", "Vyprázdnit")
    ->setClass("clear")
    ->setLink(function($row) use ($self){return $self->link("clear!", $row['id_skupiny']);})
     ->setConfirmationDialog(function($row){return "Určitě chcete vyprázdnit skupinu s názvem ".$row['nazev_skupiny']."? \n Vyprázdněním skupiny dojde k: \n -Vymazaní záznamu o členství ve skupině";});
          
    
   
 




     $this->addButton("delete", "Smazat")
          ->setClass("delete")
          ->setLink(function($row) use ($self){return $self->link("delete!", $row['id_skupiny']);})
          ->setConfirmationDialog(function($row){return "Určitě chcete smazat ".$row['nazev_skupiny']."? \n Smazáním skupiny dojde k: \n -Smazání úvazku daného předmětu a učitele \n -Vymazaní záznamu o členství ve skupině";});
          
    

     
    
    
 $this->setDefaultOrder("nazev_skupiny ASC");   
$this->setWidth('100%');
 
    }
    
  function handleDelete($idskupiny) {
      
     $this->database->query('DELETE FROM clenove_skupiny WHERE id_skupiny=?', $idskupiny); 
    $this->database->query('DELETE FROM skupina WHERE id_skupiny=?', $idskupiny);
    $this->flashMessage('Skupina byla smazána.');
}  

  function handleClear($idskupiny) {
      
      
    $this->database->query('DELETE FROM clenove_skupiny WHERE id_skupiny=?', $idskupiny);
    $this->flashMessage('Skupina byla vyprázdněna.');
    
}
    
}

