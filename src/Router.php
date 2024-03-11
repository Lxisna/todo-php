<?php
namespace App\PhpTodolist;

use App\PhpTodolist\Controller\TaskController;
use App\PhpTodolist\Controller\HomeController;

require "../vendor/autoload.php";

class Router
{
    public function index()
    {
// Récupérer l'URL demandée
        $url = $_SERVER['REQUEST_URI'];
        if( ($pos = strpos($url, '?')) !== false) $url = substr($url, 0, $pos);

// Trouver le controller et la méthode correspondante
        if ($url === "/todo_list/public/") {
// Instancier le contrôleur et appeler la méthode
            $controller = new HomeController();
            $controller->index();
        }

        $parts = explode('/', $url);
        if (array_key_exists(3, $parts) && $parts[3] === "task") {
            // Instancier le contrôleur et appeler la méthode
            $controller = new TaskController();

            if (array_key_exists(4, $parts)) {
                switch ($parts[4]) {
                    case "add":
                        $controller->add();
                        break;
                    case "update":
                        if (array_key_exists(5, $parts)) {
                            $controller->update((int) $parts[5]);
                        }
                        break;
                    case "delete":
                        if (array_key_exists(5, $parts)) {
                            $controller->delete((int) $parts[5]);
                        }
                        break;
                    case "search":
                        if (array_key_exists(4, $parts)) {
                            $controller->search((int) $parts[4]);
                        }
                        break;
                    default:
                        $id = (int) $parts[4];
                        if ($id > 0) {
                            $controller->show((int) $parts[4]);
                        } else {
                            $controller->index();
                        }
                        break;
                }
            } else {
                $controller->index();
            }
        }
    }
// Gérer les erreurs (par exemple, afficher une page 404)
}
