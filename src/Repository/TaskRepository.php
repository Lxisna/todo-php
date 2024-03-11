<?php 
namespace  App\PhpTodolist\Repository;

use App\PhpTodolist\Service\Database;

class TaskRepository {
  public function index(){
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
  return $tasks;
  }

  public function find(int $id){

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
  return $task;
  }


    public function add(){
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
        return $task;
    }
  }

  public function remove(int $id){
    $pdo = new Database(
      "localhost",
      "todolist_php",
      "8889",
      "root",
      "root",
  );

  $pdo->query(
      "DELETE FROM task WHERE id=$id");
  }

  public function update(int $id, string $title, string $status){

    $pdo = new Database(
      "localhost",
      "todolist_php",
      "8889",
      "root",
      "root",
    );

    $pdo->query(
      "UPDATE task SET title= '$title', status='$status' WHERE id=$id");
  }

  public function search($value){
    $pdo = new Database(
      "localhost",
      "todolist_php",
      "8889",
      "root",
      "root",
    );

    $tasks = $pdo->selectAll("SELECT * FROM task WHERE title LIKE '%" . $value . "%' ORDER BY id");
    return $tasks;
  }
}