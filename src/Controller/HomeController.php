<?php

namespace App\Controller;

use App\Core\View\View;

class HomeController
{
    public function __construct(public View $view)
    {
    }

    public function index()
    {
        echo $this->view->render('home', ['img' => '']);
    }
}