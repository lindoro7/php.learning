<?php

namespace app\controllers;
use app\models\User;
use app\services\DB;

class UserController extends Controller
{
  
  public function addAction()
  {
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
      return $this->renderer->render('userAdd');
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
      return $this->renderer->render('userAdd');
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
    return $this->renderer->render(
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
      return $this->renderer->render('userUpdate', ['user' => $user]);
    }  
    
    $user = new User(DB::getInstance());
    $user->id = $this->getId();
    $user->name = $_POST['name'];
    $user->login = $_POST['login'];
    unset($_POST);
    $user->save($user->id);
    return $this->renderer->render('userOne', ['user' => $user]);
  }
  
  public function allAction()
  {
    $users =(new User(DB::getInstance()))->getAll();
    return $this->renderer->render('userAll', ['users' => $users]);
  }

  public function delAction()
  {
    $id = $this->getId();
    $user =(new User(DB::getInstance()))->delete($id);
    return header('Location: ?c=user&a=all');
  }
}