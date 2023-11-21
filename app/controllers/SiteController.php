<?php

namespace App\controllers;

use Ryxo\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $this->render("home");
    }
}
