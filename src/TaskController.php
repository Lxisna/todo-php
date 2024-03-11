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
        echo $twig->render('taskpage.twig',
            ['tasks' => $tasks,
            ]);

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // }
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

    public function add()
    {
        $loader = new FilesystemLoader(dirname(__DIR__) . "/templates");
        $twig = new Environment($loader);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = new Database(
                "localhost",
                "todolist_php",
                "8889",
                "root",
                "root",
            );

            $task = $pdo->query(
                "INSERT INTO task (title, status) VALUES (?, ?)",
                [$_POST['title'], $_POST['status']]
            );
            header("Location: http://localhost:8080/todo_list/public/task/");
        }

        echo $twig->render('taskAddPage.twig', []); //转向我们需要的页面
    }

    public function delete(int $id)
    {
        $pdo = new Database(
            "localhost",
            "todolist_php",
            "8889",
            "root",
            "root",
        );

        $pdo->query(
            "DELETE FROM task WHERE id=" . $id);
        header("Location: http://localhost:8080/todo_list/public/task/");
    }

    public function update($id)
    {
        $loader = new FilesystemLoader(dirname(__DIR__) . "/templates");
        $twig = new Environment($loader);

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $pdo = new Database(
        //         "localhost",
        //         "todolist_php",
        //         "8889",
        //         "root",
        //         "root",
        //     );

        //     $pdo->query(
        //         "UPDATE task SET title= ?, status= ?, WHERE id=" . $id, [$_POST['title'], $_POST['status']]);
        //     header("Location: http://localhost:8080/todo_list/public/task/");
        // }
        echo $twig->render('taskUpdatePage.twig', []); //转向我们需要的页面
    }

}
