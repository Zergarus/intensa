<?php
namespace App\Controllers;
use \Core\Controller;
class Controller404 extends Controller
{

    function action_index()
    {
        $this->view->generate('404_view.php', 'template_view.php');
    }

}