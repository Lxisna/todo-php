<?php
namespace App\PhpTodolist\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController
{
    public function index()
    {
        $tasks = [
            ['task' => 'faire les course', 'created' => '2024/03/06'],
            ['task' => 'finir le projet', 'created' => '2024/02/01'],
            ['task' => 'aller au cinema', 'created' => '2021/11/01'],
        ];
        $loader = new FilesystemLoader("../templates");
        //initialiser twig
        $twig = new Environment($loader);
        //rendre une vue
        echo $twig->render('homepage.twig',
            ['title' => 'Daily Tasks',
                'tasks' => $tasks,
            ]);
    }
}
