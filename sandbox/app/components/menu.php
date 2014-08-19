<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Nette\Application\UI\PresenterComponent,
        Nette\Security\User;
       
       

class Menu extends Nette\Application\UI\PresenterComponent
{
     public $database;

    public function __construct(Nette\Database\Context $database)
    {

        $this->database = $database;
    }

    public function render($user)
    {
        $url_skoly=$this->database->query('SELECT * FROM nastaveni_global WHERE parametr_1="url_skoly"')->fetch();
        $url_skol="";
        if($url_skoly!=FALSE){
        $url_skol=$url_skoly->parametr_2;    
        }
        $url = $this->presenter->link('Homepage:');
                
        echo '<li><a href="'.$url.'">Hlavní strana</a>
              </li>';
        // Doplnit o výstup z databáze!!
        echo '<li><a href="'.$url_skol.'">Stránka školy</a>
              </li>';
        
        
        
        if(($user->isInRole('1'))){
        echo '<li><a href="http://seznam.cz">Seznam známek</a>
              </li>';
        echo '<li><a href="http://seznam.cz">Seznam čtvrtletní klasifikace</a>
              </li>';   
        }
           
        
        
        
        if(($user->isInRole('4')) or ($user->isInRole('3')) or ($user->isInRole('2'))){
           echo  '<li><a href="#" class="drop">Známky</a>
    
		<div class="dropdown_1column align_right">
        
                <div class="col_1">
                
                    <ul class="simple">
                        <li><a href="#">Nová známka</a></li>
                        <li><a href="#">Hromadné přidání známek</a></li>
                        <li><a href="#">Seznam známek</a></li>
                        <li><a href="#">Nová čtvrtletní klasifikace</a></li>
                        <li><a href="#">Hromadné přidání čtvrtletní klasifikace</a></li>
                        <li><a href="#">Seznam Čtvrtletní klasifikace</a></li>
                   
                    </ul>   
                     
                </div>
                
		</div>
        
	</li>';
           
        }
           
           
        
        
        
        
    if(($user->isInRole('4')) or ($user->isInRole('3'))){
         $url = $this->presenter->link('Nastaveni:globalninastaveni');
        echo '<li class="menu_right"><a href="'.$url.'">Nastavení systému</a>
              </li>';    
           echo '<li class="menu_right"><a href="http://centrum.cz">Přehled školy</a>
              </li>';  
      echo   '<li><a href="#" class="drop">Nastavení školy</a>
    
        <div class="dropdown_4columns"><!-- Begin 4 columns container -->
        
            <div class="col_4">
                
            </div>
            
            <div class="col_1">
            
                <h3>Učitelé</h3>
                <ul>';
               $url = $this->presenter->link('Uvazek:seznamucitelu');
               echo     '<li><a href="'.$url.'">Úvazky učitelů</a></li>';
               $url = $this->presenter->link('Novy:ucitel');
               echo     '<li><a href="'.$url.'">Nový učitel</a></li>';
               $url = $this->presenter->link('Users:list');   
               echo  '<li><a href="'.$url.'">Seznam učitelů</a></li>';
                    
      echo          '</ul>   
                 
            </div>
    
            <div class="col_1">
            
                <h3>Předměty</h3>
                <ul>';
           $url = $this->presenter->link('Novy:predmet');       
       echo             '<li><a href="'.$url.'">Nový předmět</a></li>';
       echo             '<li><a href="#">Seznam předmětů</a></li>
                    
                </ul>   
                 
            </div>
    
            <div class="col_1">
            
                <h3>Skupiny</h3>
                <ul>';
        $url = $this->presenter->link('Novy:skupina');
              echo      '<li><a href="'.$url.'">Nová skupina</a></li>';
          
              echo     '<li><a href="#">Seznam skupin</a></li>';
         $url = $this->presenter->link('Skupiny:seznamskupindef');     
              echo      '<li><a href="'.$url.'">Žáci ve skupině</a></li>';
                    
              echo '</ul>   
                 
            </div>
    
            <div class="col_1">
            
                <h3>Žáci a třídy</h3>
                <ul>';
              $url = $this->presenter->link('Novy:zak');
            echo        '<li><a href="'.$url.'">Nový žák</a></li>';
         echo           '<li><a href="#">Seznam žáků</a></li>';
       $url = $this->presenter->link('Novy:trida'); 
              echo      '<li><a href="'.$url.'">Nová třída</a></li>';
               echo     '<li><a href="#">Seznam tříd</a></li>
                </ul>   
                 
            </div>
            
        </div><!-- End 4 columns container -->
    
    </li><!-- End 4 columns Item -->';
      
 
      
      
    }
        
        
        
        
        
    }
}