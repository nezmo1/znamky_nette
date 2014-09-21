<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Nette\Application\UI\PresenterComponent,
        Nette\Security\User;
       
       

class Viteze extends Nette\Application\UI\PresenterComponent
{
     public $database;
     

    public function __construct(Nette\Database\Context $database)
    {

        $this->database = $database;
       
        
    }

    function popis($stranka){
        $popis=array();
        #1 - Seznam skupin
        
        $popis[1][1]="Kliknutím na jméno skupiny definujete členy.";
        $popis[1][2]="V závorce za počtem žáků ve skupině je celkový počet žáků ve třídě.";
        $popis[1][3]="Kliknutím na tužku (editovat) můžete editovat jméno skupiny.";
        $popis[1][4]="Kliknutím na smetáček (vyčistit) vyprázdníte skupinu.";
        $popis[1][5]="Kliknutím na křížek (vymazat) vymažete celou skupinu.";
        
        #2 - Seznam úvazků
        $popis[2][1]="Seznam úvazků ještě není ve finální podobě.";
        
        #3 - Nový učitel, žák
        $popis[3][1]="E-mail není povinný."; 
        $popis[3][2]="Uživatelské jméno tvoří první tři písmena z příjmení a jména (NezAda).";
        $popis[3][3]="Pole s červenou hvězdičkou jsou povinné.";
        $popis[3][4]="Hesla se musí shodovat.";
        $popis[3][5]="Hesla musí mít minimálně 6 znaků."; 
        
         #4 - Seznam učitelů, žáků
        $popis[4][1]="Kliknutím na tužku editujete uživatele.";
        $popis[4][2]="Kliknutím na klíč změníte heslo.";
        $popis[4][3]="Kliknutím na křížek smažete uživatele.";
        
        
        #5 - Nový předmět
        $popis[5][1]=".";
        
        
      if(rand(1,25)==25){
       $popis2=array();
       
       $popis2[1][1]="Když se poprvé zasměje dítě, narodí se víla._vila";
       $popis2[1][2]="Brambory nerostou na stromech._potato";
       $popis2[1][3]="Neví se, kolik kapek tvoří moře._drop";
       $popis2[1][4]="Jaké je tajemství nesmrtelnosti?_goat";
       
       $velikost=  max(array_keys($popis2[1]));
          return $popis2[1][rand(1, $velikost)];
       
      }  
      else
      {
          $velikost=  max(array_keys($popis[$stranka]));
          return $popis[$stranka][rand(1, $velikost)];
          
      }
        
        
    }
    
    
    
    
    public function render($stranka)
    {
         $popis = $this->popis($stranka);
         $cesta = Nette\Environment::getHttpRequest()->getUrl()->getBasePath();
         $cast=explode('_',$popis);    
         if(!isset($cast[1])){
          $img='owl';   
         }
         else {
           $img=$cast[1];
           $popis=$cast[0];
         }
             
         echo "<div class='datagrid' style='width:60%;margin-left:20%; background: #396383;'>";
        echo "<table>";
     
      
         echo "<tbody>";
          echo "<tr><td class='popis' style='height:100px;vertical-align:top;padding-left:0px;padding-top:20px;color:black;'>";
          
          echo "<div><img src='".$cesta."css/viteze/".$img.".png' style='height:60px;float:left;width:80px;height:80px;padding-left:25px'></div>";
           
          echo "<div style='text-align:center;font-size:18px;font-style:italic;'>Víte že...<br></div>";
          echo "<div style='padding-left:50px;'>";
          
        //   echo "";
           
           echo "<div style='padding-left:10px;padding-right:15px;padding-top:5px;font-style:italic;text-align:center'>&nbsp;&nbsp".$popis."</div>";
          
          
          
          
           echo "</div>";
          echo "</td></tr>"; 
         echo "</tbody>";
        echo "</table>";
        echo "</div>";
        
        
        
        
    }
}