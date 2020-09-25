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

  public function oneAction()
  {
    $id = $this->getId();
    $user =(new User(DB::getInstance()))->getOne($id);
    return $this->render('userOne', ['user' => $user]);
  }

  public function allAction()
  {
    $users =(new User(DB::getInstance()))->getAll();
    return $this->render('userAll', ['users' => $users]);
  }

  public function render($template, $params = [])
  {
    $content = $this->renderTemplate($template, $params);
    return $this->renderTemplate(
      'layouts/main', 
      [
        'content' => $content
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