<?php
namespace App\PhpTodolist\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\PhpTodolist\Service\Database;
use App\PhpTodolist\Repository\TaskRepository;

class TaskController
{
    public function index()
    {
        $loader = new FilesystemLoader("../templates");
        $twig = new Environment($loader);

         $taskRepository =new TaskRepository();
         $tasks = $taskRepository->index();

        echo $twig->render('taskpage.twig',
            ['tasks' => $tasks,
            ]);
    }

    public function show(int $id)
    {
        $loader = new FilesystemLoader("../templates");
        $twig = new Environment($loader);

   
        $taskRepository =new TaskRepository();
        $task = $taskRepository->find($id);

      
        echo $twig->render('taskDetailpage.twig',
            [
                'task' => $task,
            ]);
    }

    public function add()
    {
        $loader = new FilesystemLoader("../templates");
        $twig = new Environment($loader);

        $taskRepository =new TaskRepository();
        $tasks = $taskRepository->index();

        header("Location: http://localhost:8080/todo_list/public/task/");
        echo $twig->render('taskAddPage.twig', []); //转向我们需要的页面
    }

    public function delete(int $id)
    {
       
        $taskRepository =new TaskRepository();
         $taskRepository->remove($id);
        
        header("Location: http://localhost:8080/todo_list/public/task/");
    }

    public function update(int $id)
    {
        $loader = new FilesystemLoader("../templates");
        $twig = new Environment($loader);

        $taskRepository =new TaskRepository();
        $task = $taskRepository->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $status = $_POST['status'];

           $taskRepository->update($id,$title,$status);

            header("Location: http://localhost:8080/todo_list/public/task/");
            die();
        }
        echo $twig->render('taskUpdatePage.twig',
            [
                'task' => $task,
                'optionList' => ['In Progress', 'Done', 'Not Started'],

            ]); //转向我们需要的页面
    }

    public function search(){
        $loader = new FilesystemLoader("../templates");
        $twig = new Environment($loader);

        $taskRepository =new TaskRepository();
        if (array_key_exists('q', $_GET)) {
            $tasks = $taskRepository->search($_GET['q']);
            echo $twig->render('taskSearch.twig',
            [
                'tasks' => $tasks,
            ]); //转向我们需要的页面
        }

    }

}
