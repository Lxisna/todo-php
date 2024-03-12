<?php
namespace App\PhpTodolist\Controller;

use App\PhpTodolist\Repository\TaskRepository;

class TaskController extends AbstractController
{
    public function index()
    {
         $taskRepository =new TaskRepository();
         $tasks = $taskRepository->index();
         //search 将与index共用一条Route，如果有action search，就显示search的结果，如果没有，就显示全部task
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['search'])){
            $tasks = $taskRepository->search($_POST['search']);}
            if(isset($_POST['status'])){
            $tasks = $taskRepository->filter($_POST['status']);}
         }

        $this->render('taskpage.twig',['tasks' => $tasks,]);
    }

    public function show(int $id)
    {
        $taskRepository =new TaskRepository();
        $task = $taskRepository->find($id);
      
        $this->render('taskDetailpage.twig',
            [
                'task' => $task,
            ]);
    }

    public function add()
    {
        $taskRepository =new TaskRepository();
        $tasks = $taskRepository->index();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $taskRepository->add();
            header("Location: http://localhost:8080/todo_list/public/task/");

    }
        $this->render('taskAddPage.twig', []); //转向我们需要的页面
    }

    public function delete(int $id)
    {
       
        $taskRepository =new TaskRepository();
         $taskRepository->remove($id);
        
        header("Location: http://localhost:8080/todo_list/public/task/");
    }

    public function update(int $id)
    {
        $taskRepository =new TaskRepository();
        $task = $taskRepository->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $status = $_POST['status'];

           $taskRepository->update($id,$title,$status);

            header("Location: http://localhost:8080/todo_list/public/task/");
            die();
        }
        $this->render('taskUpdatePage.twig',
            [
                'task' => $task,
                'optionList' => ['In Progress', 'Done', 'Not Started'],
                'handlerList'=>['Yvan','Lisa','Enola']

            ]); //转向我们需要的页面
    }

}
