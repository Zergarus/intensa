<?php
namespace Core;

class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);
        
        // получаем имя контроллера
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
            if (strpos($controller_name, "?")) {
                $controller_name = substr($controller_name, 0, strpos($controller_name, '?'));
            }
        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        // добавляем префиксы
        $model_name = 'Model' . ucwords($controller_name);
        $controller_name = 'Controller' . ucwords($controller_name);
        $action_name = 'action_' . $action_name;

        // подцепляем файл с классом модели (файла модели может и не быть)

        $model_file = strtolower($model_name) . '.php';
        $model_path = "App/Models/" . $model_file;
        if (file_exists($model_path)) {
            include "App/Models/" . $model_file;
        }

        // подцепляем файл с классом контроллера
//        $controller_file = strtolower($controller_name) . '.php';
//        $controller_path = "application/Controllers/" . $controller_file;
//        if (file_exists($controller_path)) {
//            include "application/Controllers/" . $controller_file;
//        } else {
//            self::ErrorPage404();
//        }

        // создаем контроллер
        $class = '\\App\\Controllers\\'.$controller_name;
        $controller = new $class;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action();
        } else {
            self::ErrorPage404();
        }

    }

    private static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}