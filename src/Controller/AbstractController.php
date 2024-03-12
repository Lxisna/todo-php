<?php 
namespace App\PhpTodolist\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController 
{
  protected function render(string $template, array $data){
    $loader = new FilesystemLoader("../templates");
    $twig = new Environment($loader);

    echo $twig->render($template,$data);
  }
}
