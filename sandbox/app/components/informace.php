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
          //$pos_znamka=$this->database->query('SELECT LEFT(znamka,5) as `znamka`, predmet.zkratka_predmetu as `predmet` FROM znamky INNER JOIN predmet on znamky.predmet=predmet.id_predmetu WHERE ucitel=?',$username,' ORDER BY id_znamky DESC')->fetch();
          $pocet_znamek=$this->database->query('SELECT count(znamka) AS `pocet` FROM znamky WHERE ucitel=?',$username)->fetch();
          $data= $this->database->query('SELECT ucitel, MAX(datum) as `datum`, DATE_FORMAT(MAX(datum),"%d-%m-%Y") as `data` FROM znamky WHERE ucitel=?',$username)->fetch();
          
          
          
        
          if(isset($data->data)){
                        $date1=date_create($data->data);
                        $date2=date_create(date("d-m-Y"));
                        $diff=date_diff($date1,$date2);
                        $pom_datum=0;
                  
                       
                        
                        switch ($diff->days) {
                            
                            case 0: $pom_datum="Dnes";
                            break;
                            case 1: $pom_datum="Včera";
                            break;
                            case 2: $pom_datum="2 dny";
                            break;
                            case 3: $pom_datum="3 dny";
                            break;
                            case 4: $pom_datum="4 dny";
                            break;
                            
                            default: $pom_datum=$diff->days." dnů";
                               
                                break;
                        } 
          }
          else $pom_datum='Nikdy';
          echo "<td style='text-align:left'>";
          echo "<font color='white' >Poslední přidaná známka: <b style='color:yellow'>".$pom_datum."</b></font>";
          echo "<br><font color='white' >Počet známek: <b style='color:yellow'> ".$pocet_znamek['pocet']."</b></font>";
          
          echo "</td>";
          
         }
    }
}