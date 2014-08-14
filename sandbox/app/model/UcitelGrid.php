<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


use Nette\Database\Context;


class UcitelGrid extends TwiGrid\DataGrid
{
    public $database;
    public $session;

    function __construct(Nette\Http\Session $session,Context $database)
    {
        
        $this->database = $database;
         $this->session = $session;
         parent::__construct($this->session);
    }

    public function build()
    {
        
$this->addColumn('jmeno', 'Firstname');
$this->addColumn('prijmeni', 'Surname')->setSortable();
$this->setPrimaryKey('username');

$this->setDataLoader(function () {
    return $this->database->table('users')->where('trida','ucitel')->where('priorita !=','4');
});

    }
}