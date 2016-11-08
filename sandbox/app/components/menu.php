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
                
        
        
       
       
       echo '<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <br><h3>Menu</h3>
                <ul class="nav side-menu">
                  <li><a href="'.$url.'"><i class="fa fa-home"></i> Hlavní strana</a></li>
                   <li><a href="'.$url_skol.'"><i class="fa fa-university"></i> Stránka školy</a></li>';
       
          



        // menu žáci
            if(($user->isInRole('1'))){
                     $url = $this->presenter->link('Seznam:zak');    
                   echo ' <li><a href="'.$url.'"><i class="fa fa-table"></i>Seznam známek</a></li>';


                   $url = $this->presenter->link('Seznam:cvZak');
                    echo ' <li><a href="'.$url.'"><i class="fa fa-book"></i>Seznam čtvrtletní klasifikace</a></li>'; 
                   }
           
        // menu učitelé
            if(($user->isInRole('4')) or ($user->isInRole('3')) or ($user->isInRole('2'))){
             
                
                 $url = $this->presenter->link('Znamka:novaznamka?tridac=n');     
              
              
              echo'  <li><a><i class="fa fa-pencil"></i>Přidat známku<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="'.$url.'">Přidat známku</a></li>';
              $url = $this->presenter->link('CvZnamka:novaznamka?tridac=n');
      
              echo        '<li><a href="'.$url.'">Přidat čtvrtletní klasifikaci</a></li>';
              
              
              echo        '</ul></li>';
                
                
                
                
                
                
                $url = $this->presenter->link('Seznam:ucitel');         
              
              
              echo'  <li><a><i class="fa fa-book"></i>Seznamy známek<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="'.$url.'">Seznam známek</a></li>';
              $url = $this->presenter->link('Seznam:ucitelKniha');
      
              echo        '<li><a>Seznam známek - kniha<span class="label label-success pull-right">Brzy</span></a></li>';
              
              $url = $this->presenter->link('Seznam:cvUcitel');
              echo        '<li><a href="'.$url.'">Seznam čtvrtletní klasifikace</a></li>
                    
                    </ul>
                  </li>';
              
              
              
              
               $url = $this->presenter->link('Sestavy:ucitel');         
              
              
              echo'  <li><a><i class="fa fa-book"></i>Sestavy<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="'.$url.'">Seznam známek</a></li>';
          
              
              
            }
             
            
            
            // menu admin
                   if(($user->isInRole('4')) or ($user->isInRole('3'))){
        
           echo    '<br><h3>Správa</h3><br>';        
          $url = $this->presenter->link('Prehled:portal');
          echo '   <li><a href="'.$url.'"><i class="fa fa-laptop"></i> Přehled školy</a></li>';            
                       
        
          $url = $this->presenter->link('Uvazek:seznamucitelu');
               
          
         echo '<li><a><i class="fa fa-sitemap"></i> Nastavení školy <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a>Učitelé<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="'.$url.'">Úvazky učitelů</a>
                            </li>';
                           $url = $this->presenter->link('Novy:ucitel'); 
                          echo  '<li><a href="'.$url.'">Nový učitel</a>
                            </li>';
                          
                          $url = $this->presenter->link('Users:list');
                          echo  '<li><a href="'.$url.'">Seznam učitelů</a>
                            </li>
                          </ul>
                        </li>
                     
                    <li><a>Žáci<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">';
                         
                           $url = $this->presenter->link('Novy:zak'); 
                          echo  '<li><a href="'.$url.'">Nový žák</a>
                            </li>';
                          
                          $url = $this->presenter->link('List:zaci');
                          echo  '<li><a href="'.$url.'">Seznam žáků</a>
                            </li>
                          </ul>
                        </li>
                        
                     <li><a>Třídy<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">';
                         
                           $url = $this->presenter->link('Novy:trida'); 
                          echo  '<li><a href="'.$url.'">Nová třída</a>
                            </li>';
                          
                          $url = $this->presenter->link('List:tridy');
                          echo  '<li><a href="'.$url.'">Seznam tříd</a>
                            </li>
                         
                         
                          </ul>
                        </li>



                  <li><a>Skupiny<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">';
                         
                           $url = $this->presenter->link('Novy:skupina'); 
                          echo  '<li><a href="'.$url.'">Nová skupina</a>
                            </li>';
                          
                          $url = $this->presenter->link('Skupiny:seznamskupindef'); 
                          echo  '<li><a href="'.$url.'">Seznam skupin</a>
                            </li>
                         
                         
                          </ul>
                        </li>
                        
                  <li><a>Předměty<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">';
                         
                           $url = $this->presenter->link('Novy:predmet'); 
                          echo  '<li><a href="'.$url.'">Nový předmět</a>
                            </li>';
                          
                          $url = $this->presenter->link('List:predmety'); 
                          echo  '<li><a href="'.$url.'">Seznam předmětů</a>
                            </li>
                         
                         
                          </ul>
                        </li>


                    </ul>
                  </li>';   
          
          
          
          
          
          $url = $this->presenter->link('Nastaveni:globalninastaveni');
        echo '   <li><a><i class="fa fa-cog"></i> Nastavení systému<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="'.$url.'">Hlavní nastavení</a></li>
                      <li><a>Nastavení oprávnění<span class="label label-success pull-right">Brzy</span></a></li>
                      <li><a>Nový školní rok<span class="label label-success pull-right">Brzy</span></a></li>
                    </ul>';
                   }  
                
              echo '
              </div>

            </div>';
           
        
        
       
        
        
       
       
        
        
        
       
            
          
     
           
           
        
        
        
        
    
        
        
        
        
        
    }
}