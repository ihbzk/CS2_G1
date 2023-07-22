<?php

namespace App\Controllers;

use App\Core\View;

class Main
{
    public function index()
    {

        $pseudo = "Prof";
        $view = new View("Main/index", "front");
        $view->assign("pseudo", $pseudo);
    }

    public function contact()
    {
        $view = new View("Main/contact", "front");
    }

    public function privatePolicy()
    {
        $view = new View("Main/privacy-policy", "front");
    }

    public function legalesMentions()
    {
        $view = new View("Main/legales-mentions", "front");
    }

    public function head(){
        $view = new View("Main/head", "front");
    }
}
