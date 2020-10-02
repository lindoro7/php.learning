<?php

namespace app\controllers;
use app\models\User;
use app\services\DB;

class UserController
{
  protected $defaultAction = 'all';
  public function run($action)
  {
    if(empty($action))
    {
      $action = $this->defaultAction;
    }

    $action .= "Action";

    if(!method_exists($this, $action))
    {
      return '404';
    }
    return $this->$action();
  }

  public function addAction()
  {
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
      return $this->render('userAdd');
    }  
    
    if(empty($_POST['login']) || empty($_POST['password']))
    {
      $message = 'Заполните поле';
      if(empty($_POST['login']))
      {
        $message .= " login";
      }

      if(empty($_POST['password']))
      {
        $message .= " password";
      }
      if($message != 'Заполните поле')
      {
        echo $message;
      }
      return $this->render('userAdd');
    }

    $user = new User(DB::getInstance());
    $user->name = $_POST['name'];
    $user->login = $_POST['login'];
    $user->password = $_POST['password'];
    unset($_POST);
    $user->save();
    return header('Location: ?c=user&a=all');
  }
  

  public function oneAction()
  {
    $id = $this->getId();
    $user =(new User(DB::getInstance()))->getOne($id);
    return $this->render(
      'userOne', 
      [
        'user' => $user,
        'title' => "Пользователь: " . $user->login
      ]);
  }


  public function updateAction()
  {
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
      $id = $this->getId();
      $user =(new User(DB::getInstance()))->getOne($id);
      return $this->render('userUpdate', ['user' => $user]);
    }  
    
    $user = new User(DB::getInstance());
    $user->id = $this->getId();
    $user->name = $_POST['name'];
    $user->login = $_POST['login'];
    unset($_POST);
    $user->save($user->id);
    return $this->render('userOne', ['user' => $user]);
  }
  
  public function allAction()
  {
    $users =(new User(DB::getInstance()))->getAll();
    return $this->render('userAll', ['users' => $users]);
  }

  public function delAction()
  {
    $id = $this->getId();
    $user =(new User(DB::getInstance()))->delete($id);
    return header('Location: ?c=user&a=all');
  }

  public function render($template, $params = [])
  {
    $content = $this->renderTemplate($template, $params);

    $title = 'Мой магазин';
    if(!empty($params['title']))
    {
      $title = $params['title'];
    }

    return $this->renderTemplate(
      'layouts/main', 
      [
        'content' => $content,
        'title' => $title
      ]
    );
  }

  public function renderTemplate($template, $params = [])
  {
    ob_start();
    extract($params);
    include dirname(__DIR__) . '/views/' . $template . '.php';
    return ob_get_clean();
  }

  protected function getId()
  {
    if(empty($_GET['id']))
    {
      return 0;
    }
    return (int)$_GET['id'];
  }
}