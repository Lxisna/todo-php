<?php
namespace App\PhpTodolist;

use App\PhpTodolist\Service\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TaskController
{
    public function index()
    {
        $loader = new FilesystemLoader(dirname(__DIR__) . "/templates");
        $twig = new Environment($loader);

        //se connecter à la base de donnée
        $pdo = new Database(
            "localhost",
            "todolist_php",
            "8889",
            "root",
            "root",
        );
        $tasks = $pdo->selectAll(
            "SELECT * FROM task"
        );
        // echo "<pre>";
        // var_dump($tasks);
        // echo "</pre>";
        echo $twig->render('taskpage.twig',
            ['tasks' => $tasks,
            ]);
    }

    public function show(int $id)
    {
        $loader = new FilesystemLoader(dirname(__DIR__) . "/templates");
        $twig = new Environment($loader);

        //se connecter à la base de donnée
        $pdo = new Database(
            "localhost",
            "todolist_php",
            "8889",
            "root",
            "root",
        );

        $task = $pdo->select(
            "SELECT * FROM task WHERE id=" . $id
        );

        // echo "<pre>";
        // var_dump($task);
        // echo "</pre>";
        echo $twig->render('taskDetailpage.twig',
            [
                'task' => $task,
            ]);
    }
}
