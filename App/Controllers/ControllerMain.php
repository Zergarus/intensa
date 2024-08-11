<?php
namespace App\Controllers;
use \Core\Controller;
use \Core\View;
use \App\Models\ModelItem;
class ControllerMain extends Controller
{

    function __construct()
    {
        $this->model = new ModelItem();
        $this->view = new View();
    }

    function action_index()
    {
        if (!empty($_GET)){
            $data = $this->model->getList($_GET["sort"]);
        } else {
            $data = $this->model->getList();
        }
        $this->view->generate('main_view.php', 'template_view.php', $data);
    }
}