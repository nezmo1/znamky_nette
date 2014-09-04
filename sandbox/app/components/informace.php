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
    
     public function render($user)
    {
         $username=$user->id;
         $jmeno=$this->database->table('users')
                ->where('id_users', $username)->fetch();
         
         echo "<h1>Vítejte, jste přihlášen jako <font color='yellow'>".$jmeno['jmeno']." ".$jmeno['prijmeni']."</font></h1>";
         if(($user->isInRole('1'))){
          $pos_znamka=$this->database->query('SELECT LEFT(znamka,5) as `znamka`,  predmet.zkratka_predmetu as `predmet` FROM znamky  INNER JOIN predmet on znamky.predmet=predmet.id_predmetu WHERE zak=?',$username,' ORDER BY id_znamky DESC')->fetch();
         $pocet_znamek=$this->database->query('SELECT count(znamka) AS `pocet` FROM znamky WHERE zak=?',$username)->fetch();
         
          echo "<td style='text-align:left'>";
          echo "<font color='white' >Poslední přidaná známka: <b style='color:yellow'> ".$pos_znamka['znamka']."</b> (<i>".$pos_znamka['predmet']."</i>)</font>";
          echo "<br><font color='white' >Počet známek: <b style='color:yellow'> ".$pocet_znamek['pocet']."</b></font>";
          
          echo "</td>";
          
         }
         
         if((!$user->isInRole('1'))){
          $pos_znamka=$this->database->query('SELECT LEFT(znamka,5) as `znamka`, predmet.zkratka_predmetu as `predmet` FROM znamky INNER JOIN predmet on znamky.predmet=predmet.id_predmetu WHERE ucitel=?',$username,' ORDER BY id_znamky DESC')->fetch();
         $pocet_znamek=$this->database->query('SELECT count(znamka) AS `pocet` FROM znamky WHERE ucitel=?',$username)->fetch();
         
          
          echo "<td style='text-align:left'>";
          echo "<font color='white' >Poslední přidaná známka: <b style='color:yellow'> ".$pos_znamka['znamka']."</b> (<i>".$pos_znamka['predmet']."</i>)</font>";
          echo "<br><font color='white' >Počet známek: <b style='color:yellow'> ".$pocet_znamek['pocet']."</b></font>";
          
          echo "</td>";
          
         }
    }
}