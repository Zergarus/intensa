<?php

namespace Core;
use \Core\View;

class Controller
{

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }
    function redirect($url, $statusCode = 301)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
    function action_index()
    {
    }
}