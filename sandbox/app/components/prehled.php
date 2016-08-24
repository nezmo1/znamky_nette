<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Nette\Application\UI\PresenterComponent,
        Nette\Security\User;
       
       

class Prehled extends Nette\Application\UI\PresenterComponent
{
     public $database;
     

    public function __construct(Nette\Database\Context $database)
    {

        $this->database = $database;
       
        
    }

   function prehledPristup($role){
       switch ($role) {
           case 1:
               
               return 1;
               break;
           
           case 2: 
               
               return 2;
               break;
           case 3:
               return 2;
               break;
           case 4:
               return 4;
               break;

           default:  return -1;
               break;
       }
   }
     
   
   function prehledUcitel($user){
      $pocet_znamek=  $this->database->query("SELECT COUNT(id_znamky) as `pocet` FROM znamky where ucitel=",$user)->fetch();
      
      return $pocet_znamek['pocet'];
   }
    
    
    
    
    public function render()
    {
        
            
         $role=  $this->presenter->user->getRoles();
         $user= $this->presenter->user->getId();
       
         
         
         $pristup=  $this->prehledPristup($role[0]);
         $prehledUcitel=  $this->prehledUcitel($user);
         echo $prehledUcitel;
         
         
         $cesta = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();
        
        
        
        
    }
}