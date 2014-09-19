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
          $url = $this->presenter->link('Seznam:zak');    
        echo '<li><a href="'.$url.'">Seznam známek</a>';
        echo '      </li>';
        echo '<li><a href="#">Seznam čtvrtletní klasifikace</a>
              </li>';   
        }
           
        
        
        
        if(($user->isInRole('4')) or ($user->isInRole('3')) or ($user->isInRole('2'))){
           echo  '<li><a href="#" class="drop">Známky</a>
    
		<div class="dropdown_2columns" style="width:400px">
        
                <div class="col_1" style="width:180px">
                
                    <ul>';
           echo "<h3>Známky</h3>";
           $url = $this->presenter->link('Znamka:novaznamka?tridac=n');
           echo             '<li style="width:180px"><a href="'.$url.'">Nová známka</a></li>';
           echo             '<li style="width:180px"><a href="'.$url.'">Hromadné přidání známek</a></li>';
           
            $url = $this->presenter->link('Seznam:ucitel');
           echo             '<li style="width:180px"><a href="'.$url.'">Seznam známek</a></li>';
           
           echo             '
                   
                    </ul>   
                     
                </div>
               <div class="col_1" style="width:180px">
               <ul >
               <h3>Čtvrtletní klasifikace</h3>
               <li style="width:180px"><a href="#">Nová čtvrtletní klasifikace</a></li>
                        <li style="width:180px"><a href="#">Hromadné přidání čtvrtletní klasifikace</a></li>
                        <li style="width:180px"><a href="#">Seznam čtvrtletní klasifikace</a></li>
     </ul>
               </div>

                
		</div>
        
	</li>';
           
        }
           
           
        
        
        
        
    if(($user->isInRole('4')) or ($user->isInRole('3'))){
         $url = $this->presenter->link('Nastaveni:globalninastaveni');
        echo '<li class="menu_right"><a href="'.$url.'">Nastavení systému</a>
              </li>';    
        $url = $this->presenter->link('Prehled:portal');
           echo '<li class="menu_right"><a href="'.$url.'">Přehled školy</a>
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
           $url = $this->presenter->link('Skupiny:seznamskupindef'); 
              echo     '<li><a href="'.$url.'">Seznam skupin</a></li>';
         
                    
              echo '</ul>   
                 
            </div>
    
            <div class="col_1">
            
                <h3>Žáci a třídy</h3>
                <ul>';
              $url = $this->presenter->link('Novy:zak');
            echo        '<li><a href="'.$url.'">Nový žák</a></li>';
            $url = $this->presenter->link('List:zaci');
         echo           '<li><a href="'.$url.'">Seznam žáků</a></li>';
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