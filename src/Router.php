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

        if ($url === "/todo_list/public/task/add") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->add();
        }

        $parts = explode('/', $url);
        if (array_key_exists(5, $parts) && $parts[5] !== "" && $parts[4] === "delete" && $parts[3] === "task") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->delete((int) $parts[5]);
        }

        $parts = explode('/', $url);
        if (array_key_exists(4, $parts) && $parts[4] !== "" && (int) $parts[4] && $parts[3] === "task") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->show((int) $parts[4]);
        }
        $parts = explode('/', $url);
        if (array_key_exists(5, $parts) && $parts[5] !== "" && $parts[4] === "update" && $parts[3] === "task") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();
            $controller->update((int) $parts[5]);
        }

    }
// Gérer les erreurs (par exemple, afficher une page 404)
}
