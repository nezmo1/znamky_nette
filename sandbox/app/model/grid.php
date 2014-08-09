<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Model;
use NiftyGrid\Grid;

class ArticleGrid extends Grid{

    protected $articles;

    public function __construct($articles)
    {
        parent::__construct();
        $this->articles = $articles;
    }

    protected function configure($presenter)
    {
        //Vytvoříme si zdroj dat pro Grid
        //Při výběru dat vždy vybereme id
        $source = new \NiftyGrid\DataSource\NDataSource($this->articles->select('username, CONCAT(jmeno," ",prijmeni) AS cele_jmeno, trida, mail'));
        $this->setDefaultOrder("trida DESC");
//Předáme zdroj
        $this->setDataSource($source);
        
$this->addColumn('username', 'Přihlašovací jméno', '100px');
$this->addColumn('cele_jmeno', 'Celé jméno', '100px')
->setSortable(FALSE);
$this->addColumn('trida', 'Třída', '100px');
$this->addColumn('mail', 'E-mail', '100px')
 ->setSortable(FALSE);       
    }
}