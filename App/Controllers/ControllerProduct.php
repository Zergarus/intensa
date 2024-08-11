<?php
namespace App\Controllers;
use \Core\Controller;
use \Core\View;
use \App\Models\ModelUser;
use \App\Models\ModelItem;
use \App\Models\ModelReview;
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
            $objReview = new ModelReview();
            $data["reviews"] = $objReview->getReviewsByItemId($_GET["id"]);
            if (!empty($data)) {
                $this->view->generate('product_view.php', 'template_view.php', $data);
            }
        } else {
            $this->view->generate('product_view.php', 'template_view.php');
        }
    }

}