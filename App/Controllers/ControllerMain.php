<?php
namespace App\Controllers;
use \Core\Controller;
class ControllerMain extends Controller
{
    function action_index()
    {
        $this->view->generate('main_view.php', 'template_view.php');
    }
}