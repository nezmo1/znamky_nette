<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;



class SeznamCvZnamekReditel extends Grid{

    protected $znamky;
    public $database;
    public $predmet_pom;
    public $ucitel_pom; 
    public $ucitel;
    public $datum;
    public $poradi;
    public $odkaz;
    public $pocet;
    public function __construct($znamky, \Nette\Database\Context $database, $odkaz)
    {
        parent::__construct();
        $this->znamky = $znamky;
      $this->database = $database;
     $this->poradi = 0;
    $this->odkaz = $odkaz; 
    }

    protected function configure($presenter)
    {
           $ucitele=  $this->database->query('SELECT id_users,jmeno,prijmeni, CONCAT(jmeno," ",prijmeni) AS `cele_jmeno` FROM users WHERE trida=42 and priorita !=4 ORDER By prijmeni,jmeno');      
           $pocet2= $this->database->query('SELECT ucitel, (COUNT(ctvrtleti_1)+COUNT(ctvrtleti_2)+COUNT(ctvrtleti_3)+COUNT(ctvrtleti_4)) AS `pocet_znamek` FROM prum_znamky GROUP BY ucitel ORDER BY pocet_znamek DESC');  
            
                
           
                $this->ucitel_pom=array();
                foreach ($ucitele as $ucitel) {  
                 $this->ucitel_pom+= array (''.$ucitel->id_users.''  => ''.$ucitel->jmeno.' '.$ucitel->prijmeni.'',); 
                } 
                
                
      
                
                $this->pocet=array();
                foreach ($pocet2 as $pocet1) {  
                 $this->pocet+= array (''.$pocet1->ucitel.''  => ''.$pocet1->pocet_znamek.''); 
                } 
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->znamky->select('id_users,jmeno,prijmeni, CONCAT(jmeno," ",prijmeni) AS `cele_jmeno`'));
     
//Předáme zdroj
        $this->setDataSource($source);
        
      
       
           $self = $this;   
      
       
    
        
        $this->addColumn('id_users', '#', '15px')
              ->setRenderer(function($row) use($self){
               
                 
                   $self->poradi++;
                   return \Nette\Utils\Html::el('font')->setText($self->poradi.'.')->addAttributes(array('style' => 'font-weight:bold;'));
                 });  
         $this->addColumn('cele_jmeno', 'Učitel', '300px')
            ->setRenderer(function($row) use($self){
                  
                 return \Nette\Utils\Html::el('a')->href($self->odkaz, array('UcitelId'=>$row['id_users'],))->setText($row['cele_jmeno'])->addAttributes(array('style' => 'font-weight:normal;color:black'));
               });
            
         $this->addColumn('prijmeni', 'Celkový počet známek', '50px')
             ->setRenderer(function($row) use($self){
               
                 
                   $pom_pocet=$row['id_users'];
                   if(!isset($self->pocet[$pom_pocet])){
                     return \Nette\Utils\Html::el('font')->setText('0')->addAttributes(array('style' => 'font-weight:bold;color:red'));
                   }
                   else {
                     return \Nette\Utils\Html::el('font')->setText($self->pocet[$pom_pocet])->addAttributes(array('style' => 'font-weight:bold;'));
                       
                   }
                   });
        
      
          
 
       /* $this->addButton(Grid::ROW_FORM, "Rychlá editace")
             ->setClass("fast-edit"); */
//        ->setAjax(FALSE);
     
    
    
$self = $this;




     
    $this->enableSorting = FALSE;
    
 $this->setDefaultOrder("prijmeni,jmeno DESC");   
$this->setWidth('100%');
 
    }
    
  function handleDelete($idznamky) {
      
      
    $this->database->query('DELETE FROM znamky WHERE id_znamky=?', $idznamky);
    $this->flashMessage('Učitel byl smazán.');
}  
    
}

