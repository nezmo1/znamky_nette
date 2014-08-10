<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use 
        Nette\Application\UI\PresenterComponent,
        Nette\Security\User,
    Nette\Database\Context;         
       

class ZakladniInformace extends Nette\Database\Context
{
    
    
      private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault($username)
    {
        $this->template->info = $this->database->table('users')->get($username);
    }
}