<?php
namespace App\PhpTodolist;

use App\PhpTodolist\HomeController;
use App\PhpTodolist\TaskController;

require "../vendor/autoload.php";

class Router
{
    public function index()
    {
        $routes = [
            '/' => [
                'controller' => 'HomeController@index',
                'method' => 'GET',
            ],
            '/task' => [
                'controller' => 'TaskController@index',
                'method' => 'GET',
            ],
            '/task/new' => [
                'controller' => 'TaskController@new',
                'method' => 'POST',
            ],
            '/task/:id' => [
                'controller' => 'TaskController@show',
                'method' => 'GET',
            ],
        ];
// Récupérer l'URL demandée
        $url = $_SERVER['REQUEST_URI'];
// Trouver le controller et la méthode correspondante
        if ($url === "/todo_list/public/") {
// Instancier le contrôleur et appeler la méthode
            $controller = new HomeController();
            $controller->index();

        }
        if ($url === "/todo_list/public/task/") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->index();
        }
        $parts = explode('/', $url);

        if (array_key_exists(4, $parts) && $parts[4] !== "" && $parts[3] === "task") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->show((int) $parts[4]);
        }

    }
// Gérer les erreurs (par exemple, afficher une page 404)
}
