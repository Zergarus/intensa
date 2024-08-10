<?php
namespace App\Controllers;
use \Core\Controller;
use \Core\View;
use \App\Models\ModelUser;
use \App\Models\ModelItem;
class ControllerProduct extends Controller
{
    function __construct()
    {
        $this->model = new ModelItem();
        $this->view = new View();
    }

    function action_index(): void
    {
        if (!empty($_GET)) {

           $data = $this->model->getProductById($_GET["id"]);
           if ($res) {
               echo json_encode($res);
           }
           $this->view->generate('register_view.php', 'template_view.php');


        } else {
            $this->view->generate('register_view.php', 'template_view.php');
        }
    }

}