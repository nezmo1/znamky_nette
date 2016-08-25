<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Informace extends \Nette\Application\UI\Control  {
public $database;

    public function __construct(Nette\Database\Context $database)
            
    {

        $this->database = $database;
         parent::__construct();
    }
    
     public function render($user,$typ)
    {
         $username=$user->id;
         $jmeno=$this->database->table('users')
                ->where('id_users', $username)->fetch();
         $cesta = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();
       //  echo "<h1>Vítejte, jste přihlášen jako <font color='yellow'>".$jmeno['jmeno']." ".$jmeno['prijmeni']."</font></h1>";
        if($typ==1){ 
         echo ' <div class="profile">
              <div class="profile_pic">
                <img src="'.$cesta.'images/owl_rose.png" alt="..." class="img-circle profile_img">
              </div>
                
              <div class="profile_info">
                <span>Vítejte,</span>
                <h2>'.$jmeno['jmeno'].' '.$jmeno['prijmeni'].'</h2>
              </div>
            </div> ';
        }
        if ($typ==2){
            echo '<img src="'.$cesta.'images/owl_rose.png" alt=""> ';
         echo $jmeno['jmeno']." ".$jmeno['prijmeni'];   
        }
         
          
         
    }
}