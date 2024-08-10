<?php
namespace App\Controllers;
use \Core\Controller;
use \Core\View;
use \App\Models\ModelUser;
class ControllerRegister extends Controller
{
    function __construct()
    {
        $this->model = new ModelUser();
        $this->view = new View();
    }

    function action_index(): void
    {
        if (!empty($_POST)) {

           $res = $this->model->add($_POST);
           if ($res) {
               echo json_encode($res);
           }


        } else {
            $this->view->generate('register_view.php', 'template_view.php');
        }
    }

}